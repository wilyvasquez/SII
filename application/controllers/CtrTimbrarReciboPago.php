<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrTimbrarReciboPago extends CI_Controller {

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
        $fecha      = $this->input->post("fecha")."".date('\TH:i:s');

        // $preventa   = 88;
        // $id_cliente  = 110;
        // $fecha      = date("Y-m-d")."".date('\TH:i:s');
        /**
         * Consultas productos y datos clientes
         */
        $datos   = $this->Modelo_timbrado->get_relacionDocto($preventa);
        $cliente = $this->Modelo_cliente->get_cliente($id_cliente);
        // $uuid    = $this->Modelo_timbrado->get_relacion($preventa);
        /**
         * comprobamos si tiene relaciones con otras facturas
         */
        // $referencia = $cliente->relacion_uuid;
        if ($datos != false) 
        {  
            $this->complemento($cliente,$datos,$fecha);
        }else{
            $peticion = false;
            $uuid     = "";
            $msg      = "Error, elementos vacios";
            // echo json_encode($this->resultado($peticion,$uuid));
            echo json_encode($this->funciones->resultado_timbrado($peticion,$uuid,$msg));
        }
    }

    public function complemento($cliente,$datos,$fecha)
    {
        # llenamos los datos de nuestro CFDI
        # crearemos un xml de prueba
        $d = array();

        # datos basicos SAT
        $d['Serie']             = 'PYMNT';
        $d['Folio']             = rand(101,9999);  #'101';
        $d['Fecha']             = 'AUTO';
        $d['SubTotal']          = '0';
        $d['Moneda']            = 'XXX';
        $d['Total']             = '0';
        $d['TipoDeComprobante'] = 'P';
        $d['LugarExpedicion']   = '68130';

        # opciones de personalización (opcionales)
        $d['LeyendaFolio']      = "RECIBO DE PAGO"; # leyenda opcional para poner a lado del folio: FACTURA, RECIBO, NOTA DE CREDITO, ETC.

        # Regimen fiscal del emisor ligado al tipo de operaciones que representa este CFDI
        $d['Emisor']['RegimenFiscal'] = '612'; # ver catálogo del SAT

        # Datos del receptor
        $d['Receptor']['Rfc']              = $cliente->rfc;
        $d['Receptor']['Nombre']           = $cliente->cliente;
        $d['Receptor']['ResidenciaFiscal'] = null; # solo se usa cuando el receptor no esté dado de alta en el SAT
        $d['Receptor']['NumRegIdTrib']     = null; # para extranjeros
        $d['Receptor']['UsoCFDI']          = "P01"; # uso que le dará el cliente al cfdi


        # Receptor -> Domicilio (OPCIONAL)
        // $d["Receptor"]["Calle"] = "Palmas";
        // $d["Receptor"]["NoExt"] = "9810";
        // $d["Receptor"]["NoInt"] = null;
        // $d["Receptor"]["Colonia"] = "Anahuac";
        // $d["Receptor"]["Municipio"] = "Apodaca";
        // $d["Receptor"]["Estado"] = "Nuevo Leon";
        // $d["Receptor"]["Pais"] = "México";
        // $d["Receptor"]["CodigoPostal"] = "67349";

        # Inicia definición de conceptos
        # Conceptos --> concepto #1
        $d['Conceptos'][0]['ClaveProdServ'] = "84111506";
        $d['Conceptos'][0]['Cantidad']      = "1";
        $d['Conceptos'][0]['ClaveUnidad']   = "ACT"; # Clave SAT
        $d['Conceptos'][0]['Descripcion']   = 'Pago'; #maximo 1000 caracteres
        $d['Conceptos'][0]['ValorUnitario'] = '0';
        $d['Conceptos'][0]['Importe']       = '0';
        $d['Concepto'][0]['Descuento']      = null; # no se permiten valores negativos


        # Inicia Complemento de Recepcion de Pagos
        # PAGO 1:
        $d['Complemento']['Pagos'][0]['FechaPago']          = $fecha; # ver Fecha Pago
        $d['Complemento']['Pagos'][0]['FormaDePagoP']       = $cliente->forma_pago;  # ver catálogo  c_FormaPago
        $d['Complemento']['Pagos'][0]['MonedaP']            = 'MXN';
        // $d['Complemento']['Pagos'][0]['TipoCambioP']     = ''; # opcional
        // $d['Complemento']['Pagos'][0]['Monto']              = number_format($total,2);
        // $d['Complemento']['Pagos'][0]['NumOperacion']    = ''; # opcional
        // $d['Complemento']['Pagos'][0]['RfcEmisorCtaOrd'] = ''; # opcional
        // $d['Complemento']['Pagos'][0]['NomBancoOrdExt']  = ''; # opcional
        // $d['Complemento']['Pagos'][0]['CtaOrdenante']    = ''; # opcional
        // $d['Complemento']['Pagos'][0]['RfcEmisorCtaBen'] = ''; # opcional
        // $d['Complemento']['Pagos'][0]['CtaBeneficiario'] = ''; # opcional
        // $d['Complemento']['Pagos'][0]['TipoCadPago']     = ''; # opcional
        // $d['Complemento']['Pagos'][0]['CertPago']        = ''; # opcional
        // $d['Complemento']['Pagos'][0]['CadPago']         = ''; # opcional
        // $d['Complemento']['Pagos'][0]['SelloPago']       = ''; # opcional

        # complemento pagos --> documentos relacionados
        # PAGO 1 --> DOCUMENTO RELACIONADO 1
        if (!empty($datos)) {
        $i = 0;
        $total = 0;
        foreach ($datos ->result() as $articulo) {
            $d['Complemento']['Pagos'][0]['DoctoRelacionado'][$i]['IdDocumento']      = $articulo->uuid; # UUID documento 
            $d['Complemento']['Pagos'][0]['DoctoRelacionado'][$i]['Serie']            = "RO";
            $d['Complemento']['Pagos'][0]['DoctoRelacionado'][$i]['Folio']            = $articulo->folio;
            $d['Complemento']['Pagos'][0]['DoctoRelacionado'][$i]['MonedaDR']         = "MXN"; 
            $d['Complemento']['Pagos'][0]['DoctoRelacionado'][$i]['TipoCambioDR']     = "";
            $d['Complemento']['Pagos'][0]['DoctoRelacionado'][$i]['MetodoDePagoDR']   = $articulo->metodo_pago;
            $d['Complemento']['Pagos'][0]['DoctoRelacionado'][$i]['NumParcialidad']   = $articulo->parcialidad;
            $d['Complemento']['Pagos'][0]['DoctoRelacionado'][$i]['ImpSaldoAnt']      = $articulo->total_factura; # ultimo saldo (antes de recibir este pago)
            $d['Complemento']['Pagos'][0]['DoctoRelacionado'][$i]['ImpPagado']        = $articulo->monto; # importe pagado
            $d['Complemento']['Pagos'][0]['DoctoRelacionado'][$i]['ImpSaldoInsoluto'] = $articulo->total_factura - $articulo->monto; # saldo restante despues de haber recibido este pago
            $i++;
            $total = $total + $articulo->monto;
            }
            $d['Complemento']['Pagos'][0]['Monto'] = number_format($total,2);
        }

        # PAGO 1 --> IMPUESTOS
        #$d['Complemento']['Pagos'][0]['Impuestos']['TotalImpuestosRetenidos'] = "50.00";
        #$d['Complemento']['Pagos'][0]['Impuestos']['TotalImpuestosTrasladados'] = "80.00";

        # PAGO 1 --> IMPUESTOS --> RETENCIONES
        #$d['Complemento']['Pagos'][0]['Impuestos']['Retenciones'][0]['Impuesto'] = "001";
        #$d['Complemento']['Pagos'][0]['Impuestos']['Retenciones'][0]['Importe'] = "50.00";

        # PAGO 1 --> IMPUESTOS --> TRASLADOS
        #$d['Complemento']['Pagos'][0]['Impuestos']['Traslados'][0]['Impuesto'] = "001";
        #$d['Complemento']['Pagos'][0]['Impuestos']['Traslados'][0]['TipoFactor'] = "Tasa";
        #$d['Complemento']['Pagos'][0]['Impuestos']['Traslados'][0]['TasaOCuota'] = "0.160000";
        #$d['Complemento']['Pagos'][0]['Impuestos']['Traslados'][0]['Importe'] = "16.00";

        #$d['printxml'] = true; # imprimirá el XML generado en la respuesta, antes de ser enviado al SAT

        // echo "<pre>";
        // print_r( json_encode($d) );
        // echo "</pre>";

        # llamamos al método de timbrado
        $timbrar = $this->facturapi->generar_cfdi( $d );

        # guardamos los datos del nuevo cfdi recién timbrado en nuestra base de datos
        $uuid    = $timbrar->UUID;
        $url_PDF = $timbrar->PDF;
        $url_XML = $timbrar->XML;

        $ruta_destino = $this->facturas;

        # El PDF y el XML se pueden bajar mediante PHP a tu servidor local, utilizando la siguiente función:
        copy($url_PDF,$ruta_destino . $uuid . ".pdf");
        copy($url_XML,$ruta_destino . $uuid . ".xml");

        $peticion = true;
        echo json_encode($this->resultado($peticion, $uuid));

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