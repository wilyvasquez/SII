<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrTimbrarNotaCredito extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Facturapi');
        $this->load->library('Funciones');
        $this->facturas = 'assets/pdf/facturas/';
        $this->load->model('Modelo_cliente');
        $this->load->model('Modelo_sucursal');
        $this->load->model('Modelo_articulos');
        $this->load->model('Modelo_inventario');
        $this->load->model('Modelo_timbrado');
        $this->load->model('Modelo_sat');
        $this->load->helper('date');
        date_default_timezone_set('America/Monterrey');
    }

    public function timbrado()
    {
        # Datos POST
        if ($this->input->post("activo") == 'true') 
        {
            if ($this->input->post("ids") && $this->input->post("id_cliente")) 
            {
                $preventa   = $this->input->post("ids");
                $id_cliente = $this->input->post("id_cliente");
                
                # Consultas productos y datos clientes
        		$datos   = $this->Modelo_timbrado->get_productosTimbrar($preventa);
        		$cliente = $this->Modelo_cliente->get_cliente($id_cliente);
        		$uuid    = $this->Modelo_timbrado->get_relacion($preventa);
                
                # comprobamos si tiene relaciones con otras facturas
                if ($datos != false && $uuid != false) 
                {  
                    $this->nota_credito($preventa,$id_cliente,$datos,$cliente,$uuid);
                }else{
                    $msg = "Error, elementos vacios.";
                    echo json_encode($this->funciones->resultado_timbrado($peticion = false, $uuid = "", $msg));
                }
            }else{
                $msg_datos = "Error, Contactar a sistemas.";
                echo json_encode($this->funciones->resultado_timbrado($peticion = false , $uuid = "", $msg_datos));
            }
        }else{
            $msg_datos = "Error, Confirmar datos de envio.";
            echo json_encode($this->funciones->resultado_timbrado($peticion = false, $uuid = "", $msg_datos));
        }
    }

    public function nota_credito($preventa,$id_cliente,$datos,$cliente,$r_uuid)
    {
        $folioSerie = $this->Modelo_timbrado->get_ultimoFolioSerie('Egreso');
        $serie      = $folioSerie->serie;
        $folio      = $folioSerie->folio_siguiente;
        # llenamos los datos de nuestro CFDI
		# crearemos un xml de prueba
		$d = array();
        # datos basicos SAT
        $d['Serie'] 			= $serie;
        $d['Folio'] 			= $folio;
        $d['Fecha'] 			= 'AUTO';
        $d['FormaPago'] 		= $cliente->forma_pago;
        $d['CondicionesDePago'] = $cliente->condicion_pago;

        $d['TipoDeComprobante'] = 'E';
        $d['MetodoPago'] 		= $cliente->metodo_pago;
        $d['LugarExpedicion'] 	= '68130';

        # opciones de personalización (opcionales)
        $d['LeyendaFolio'] 		= "NOTA DE CREDITO"; # leyenda opcional para poner a lado del folio: FACTURA, RECIBO, NOTA DE CREDITO, ETC.

        # codigo de confirmación PAC para cfdis mayores a $20 millones
		$d['Confirmacion'] = null;

		# CFDIs relacionados
		$d['CfdiRelacionadosTipoRelacion'] 		= '01'; # c_TipoRelacion (Catálogo SAT)
		if (!empty($r_uuid)) 
        {
    		$j = 0;
            foreach ($r_uuid ->result() as $uuids) 
            {
    			$d['CfdiRelacionados'][$j]['UUID'] = $uuids->uuid;
    			$j++;
    		} 
		}

        # Regimen fiscal del emisor ligado al tipo de operaciones que representa este CFDI
        $d['Emisor']['RegimenFiscal'] = '612'; # ver catálogo del SAT

        # Datos del receptor
        $d['Receptor']['Rfc']              = $cliente->rfc;
        $d['Receptor']['Nombre']           = $cliente->cliente;
        $d['Receptor']['ResidenciaFiscal'] = null; # solo se usa cuando el receptor no esté dado de alta en el SAT
        $d['Receptor']['NumRegIdTrib']     = null; # para extranjeros
        $d['Receptor']['UsoCFDI']          = $cliente->uso_cfdi; # uso que le dará el cliente al cfdi

        # Receptor -> Domicilio (OPCIONAL)
        // $d["Receptor"]["Calle"] = "Palmas";
        // $d["Receptor"]["NoExt"] = "9810";
        // $d["Receptor"]["Colonia"] = "Anahuac";
        // $d["Receptor"]["Municipio"] = "Apodaca";
        // $d["Receptor"]["Estado"] = "Nuevo Leon";
        // $d["Receptor"]["Pais"] = "México";
        // $d["Receptor"]["CodigoPostal"] = "67349";

        $subtotal  = 0;
        $descuento = 0;
        $timporte  = 0;
        $i = 0;
        if (!empty($datos)) 
        {
            foreach ($datos ->result() as $articulo) 
            {
                # >> conceptos <<
                $cantidad = $articulo->cantidad_venta;
                $d['Conceptos'][$i]['ClaveProdServ']    = $articulo->codigo_sat;
                $d['Conceptos'][$i]['NoIdentificacion'] = $articulo->codigo_interno; #codigo interno o SKU, GTIN, codigo de barras, etc.
                $d['Conceptos'][$i]['Cantidad']         = $cantidad; # numero de articulos
                $d['Conceptos'][$i]['ClaveUnidad']      = $articulo->clave_sat; # Clave SAT
                $d['Conceptos'][$i]['Unidad']           = $articulo->unidad; # Unidad de Medida
                $d['Conceptos'][$i]['Descripcion']      = $articulo->articulo; #maximo 1000 caracteres
                $d['Conceptos'][$i]['ValorUnitario']    = round($articulo->costo,2); #costo de 1 articulo
                $d['Conceptos'][$i]['Importe']          = round($articulo->importe + $articulo->descuento,2); # costo del total de todos los articulos# costo del total de todos los articulos
                $d['Conceptos'][$i]['Descuento']        = round($articulo->descuento,2); # no se permiten valores negativos

                $base      = round(($articulo->costo * $cantidad) - $articulo->descuento,2); #precio del articulo sin IVA menos descuento
                $importe   = round($base * 0.16,2); # IVA de un articulo 
                $subtotal  = round($subtotal + $base,2); # suma de todos los articulos sin IVA, menos su descuento
                $descuento = round($descuento + $articulo->descuento,2); # suma total del descuento
                $timporte  = round($timporte + $importe,2); # suma total de los IVA de los articulos

                # concepto 1 -> impuestos
                $d['Conceptos'][$i]['Impuestos']['Traslados'][0]['Base']        = round($base,2);
                $d['Conceptos'][$i]['Impuestos']['Traslados'][0]['Impuesto']    = '002'; # 001=ISR, 002=IVA, 003=IEPS
                $d['Conceptos'][$i]['Impuestos']['Traslados'][0]['TipoFactor']  = 'Tasa';
                $d['Conceptos'][$i]['Impuestos']['Traslados'][0]['TasaOCuota']  = '0.160000'; # IVA
                $d['Conceptos'][$i]['Impuestos']['Traslados'][0]['Importe']     = round($importe,2);

                $i++;
            } 
        }

        $total           = round(($subtotal + $timporte),2); # suma del total de articulos mas el total de IVA
        $d['SubTotal']   = round($subtotal + $descuento,2); 
        $d['Descuento']  = round($descuento,2); # o bien: null
        $d['Moneda']     = 'MXN';
        $d['TipoCambio'] = "1";
        $d['Total']      = round($total,2);

        # Impuestos
        #$d['Impuestos']['TotalImpuestosRetenidos'] 	= 0.000000;
        $d['Impuestos']['TotalImpuestosTrasladados'] 	= round($timporte,2);

        # Definimos a detalle las retenciones
        #$d['Impuestos']['Retenciones'][0]['Impuesto'] 	= '001'; # 001=ISR, 002=IVA, 003=IEPS
        #$d['Impuestos']['Retenciones'][0]['Importe'] 	= 0.00;

        # Definimos a detalle los traslados
        $d['Impuestos']['Traslados'][0]['Impuesto'] 	= '002'; # 001=ISR, 002=IVA, 003=IEPS
        $d['Impuestos']['Traslados'][0]['TipoFactor'] 	= 'Tasa';
        $d['Impuestos']['Traslados'][0]['TasaOCuota'] 	= '0.160000'; # 16%
        $d['Impuestos']['Traslados'][0]['Importe'] 		= round($timporte,2);; # Monto

        try {
            # llamamos al método de timbrado
            $timbrar = $this->facturapi->generar_cfdi( $d );

            # guardamos los datos del nuevo cfdi recién timbrado en nuestra base de datos
            $uuid            = $timbrar->UUID;
            $certificado     = $timbrar->NoCertificado;
            $certificado_sat = $timbrar->NoCertificadoSAT;
            $fecha_timbrado  = $timbrar->FechaTimbrado;
            $url_PDF         = $timbrar->PDF;
            $url_XML         = $timbrar->XML;

            // echo "<pre>";
            // print_r($timbrar);
            // echo "</pre>";

            $ruta_destino = $this->facturas;

            if (!empty($uuid)) 
            {
                echo json_encode($this->funciones->resultado_timbrado($peticion = true, $uuid, $msg = ""));
                $factura = $this->funciones->agregarArticulos($preventa,$uuid,$certificado,$certificado_sat,$fecha_timbrado,$url_PDF,$url_XML,$total,$tipo = "E",$serie,$folio);

                # ACTUALIZAR EL FOLIO AL SIGUIENTE
                $data = array(
                    'folio_siguiente' => $folio + 1, 
                );
                $this->Modelo_timbrado->update_serieFolio($folioSerie->id_folios,$data);

                if (!empty($r_uuid)) 
                {
                    $this->funciones->relacion_factura($factura,$r_uuid);
                }
            }

            # El PDF y el XML se pueden bajar mediante PHP a tu servidor local, utilizando la siguiente función:
            copy($url_PDF,$ruta_destino . $uuid . ".pdf");
            copy($url_XML,$ruta_destino . $uuid . ".xml");
        }catch (Exception $e) {
            echo json_encode(
                $result = array(
                    'respuesta' => 'correcto',
                    'msg'       => $e->getMessage(),
                    'url'       => ""
                )
            );
        }
    }
}