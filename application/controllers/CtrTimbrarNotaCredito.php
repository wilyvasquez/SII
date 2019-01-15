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
    }

    public function timbrado()
    {
        /*
        Datos POST
         */
        $preventa   = $this->input->post("ids");
        $id_cliente = $this->input->post("id_cliente");
        /**
         * Consultas productos y datos clientes
         */
		$datos   = $this->Modelo_timbrado->get_productosTimbrar($preventa);
		$cliente = $this->Modelo_cliente->get_cliente($id_cliente);
		$uuid    = $this->Modelo_timbrado->get_relacion($preventa);
        /**
         * comprobamos si tiene relaciones con otras facturas
         */
        // $referencia = $cliente->relacion_uuid;
        if ($datos != false && $uuid != false) 
        {  
            $this->nota_credito($preventa,$id_cliente,$datos,$cliente,$uuid);
        }else{
            $peticion = false;
            $uuid = "";
            $msg = "Error, elementos vacios";
            // echo json_encode($this->resultado($peticion,$uuid));
            echo json_encode($this->funciones->resultado_timbrado($peticion,$uuid,$msg));
        }
    }

    public function nota_credito($preventa,$id_cliente,$datos,$cliente,$uuid)
    // public function nota_credito()
    {
    	// $preventa   = 25;
     //    $id_cliente = 107;

  //   	$datos   = $this->Modelo_timbrado->get_productosTimbrar($preventa);
		// $cliente = $this->Modelo_cliente->get_cliente($id_cliente);
		// $uuid    = $this->Modelo_timbrado->get_relacion($preventa);
        # llenamos los datos de nuestro CFDI
		# crearemos un xml de prueba
		$d = array();
        # datos basicos SAT
        $d['Serie'] 			= 'F';
        $d['Folio'] 			= '987750';
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
		if (!empty($uuid)) {
		$j = 0;
        foreach ($uuid ->result() as $uuids) {
			$d['CfdiRelacionados'][$j]['UUID'] 		= $uuids->uuid;
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
        if (!empty($datos)) {
        foreach ($datos ->result() as $articulo) 
        {
            # >> conceptos <<
            $cantidad = $articulo->cantidad_venta;
            $d['Conceptos'][$i]['ClaveProdServ']    = $articulo->codigo_sat;
            $d['Conceptos'][$i]['NoIdentificacion'] = $articulo->codigo_interno; #codigo interno o SKU, GTIN, codigo de barras, etc.
            $d['Conceptos'][$i]['Cantidad']         = number_format($cantidad,2); # numero de articulos
            $d['Conceptos'][$i]['ClaveUnidad']      = $articulo->clave_sat; # Clave SAT
            $d['Conceptos'][$i]['Unidad']           = $articulo->unidad; # Unidad de Medida
            $d['Conceptos'][$i]['Descripcion']      = $articulo->articulo; #maximo 1000 caracteres
            $d['Conceptos'][$i]['ValorUnitario']    = number_format($articulo->costo,2); #costo de 1 articulo
            $d['Conceptos'][$i]['Importe']          = number_format($articulo->importe,2); # costo del total de todos los articulos
            $d['Conceptos'][$i]['Descuento']        = number_format($articulo->descuento,2); # no se permiten valores negativos

            $base      = number_format(($articulo->costo * $cantidad) - $articulo->descuento,2); #precio del articulo sin IVA menos descuento
            $importe   = number_format($base * 0.16,2); # IVA de un articulo 
            $subtotal  = number_format($subtotal + $base,2); # suma de todos los articulos sin IVA, menos su descuento
            $descuento = number_format($descuento + $articulo->descuento,2); # suma total del descuento
            $timporte  = number_format($timporte + $importe,2); # suma total de los IVA de los articulos

            # concepto 1 -> impuestos
            $d['Conceptos'][$i]['Impuestos']['Traslados'][0]['Base']        = number_format($base,2);
            $d['Conceptos'][$i]['Impuestos']['Traslados'][0]['Impuesto']    = '002'; # 001=ISR, 002=IVA, 003=IEPS
            $d['Conceptos'][$i]['Impuestos']['Traslados'][0]['TipoFactor']  = 'Tasa';
            $d['Conceptos'][$i]['Impuestos']['Traslados'][0]['TasaOCuota']  = '0.160000'; # IVA
            $d['Conceptos'][$i]['Impuestos']['Traslados'][0]['Importe']     = number_format($importe,2);

            $i++;
        } }

        $total           = number_format($subtotal + $timporte,2); # suma del total de articulos mas el total de IVA
        $d['SubTotal']   = number_format($subtotal,2);
        $d['Descuento']  = number_format($descuento,2); # o bien: null
        $d['Moneda']     = 'MXN';
        $d['TipoCambio'] = "1";
        $d['Total']      = number_format($total,2);

        # Impuestos
        #$d['Impuestos']['TotalImpuestosRetenidos'] 	= 0.000000;
        $d['Impuestos']['TotalImpuestosTrasladados'] 	= number_format($timporte,2);

        # Definimos a detalle las retenciones
        #$d['Impuestos']['Retenciones'][0]['Impuesto'] 	= '001'; # 001=ISR, 002=IVA, 003=IEPS
        #$d['Impuestos']['Retenciones'][0]['Importe'] 	= 0.00;

        # Definimos a detalle los traslados
        $d['Impuestos']['Traslados'][0]['Impuesto'] 	= '002'; # 001=ISR, 002=IVA, 003=IEPS
        $d['Impuestos']['Traslados'][0]['TipoFactor'] 	= 'Tasa';
        $d['Impuestos']['Traslados'][0]['TasaOCuota'] 	= '0.160000'; # 16%
        $d['Impuestos']['Traslados'][0]['Importe'] 		= number_format($timporte,2);; # Monto


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

        // if (!empty($uuid)) 
        // {
        //     echo $msg = $this->agregar_articulos($preventa,$uuid,$certificado,$certificado_sat,$fecha_timbrado,$url_PDF,$url_XML);
        // }
        $peticion = true;
        $msg = "";
        // echo json_encode($this->resultado($peticion,$uuid));
        echo json_encode($this->funciones->resultado_timbrado($peticion,$uuid,$msg));

        # El PDF y el XML se pueden bajar mediante PHP a tu servidor local, utilizando la siguiente función:
        copy($url_PDF,$ruta_destino . $uuid . ".pdf");
        copy($url_XML,$ruta_destino . $uuid . ".xml");

    }

    function resultado($peticion,$uuid)
    {
        if($peticion)
        {
            $result = array(
                'msg'   => "<center><img src='".base_url()."assets/img/correcto.jpg' width='400px'></center>",
                'btn'   => "<a href='".base_url()."descarga/".$uuid.".pdf' target='_blank'>Descargar Factura</a>",
            );
        }else{ 
            $result = array(
                'btn'  => '<div class="alert alert-danger" role="alert">Error en la accion</div>',
            );
        }
        return $result;
    }
}