<?php if ( ! defined('BASEPATH')) exit('No esta permitido el acceso'); 
//La primera línea impide el acceso directo a este script
class Funciones {

	public function __construct()
    {
        $CI =& get_instance();
        $CI->load->model('Modelo_articulos');
        $CI->load->model('Modelo_timbrado');
        $CI->load->library('session');
        $CI->load->helper('date');
        date_default_timezone_set('America/Monterrey');
    }


    public function precios($id)
    {
        $importe   = 0;
		$subtotal  = 0;
		$iva       = 0;
		$total     = 0;
		$descuento = 0;

		$CI =& get_instance();
		$articulos = $CI->Modelo_articulos->get_articulosVenta($id);
		if (!empty($articulos)) {
	      	foreach ($articulos ->result() as $articulo) 
	      	{
	      		$importe = $importe + $articulo->importe;
	      		$descuento = $descuento + $articulo->descuento;
	      	}
			$subtotal  = $importe;
			$iva       = $subtotal * 0.16;
			$total     = $importe + $iva;
			$descuento = $descuento;
      	}
      	 return array($subtotal,$iva,$descuento,$total);
    }

    function resultado($peticion,$url,$msg,$num)
	{
		if($peticion)
		{
			$result = array(
				'respuesta' => 'correcto',
				'msg'       => '<div class="alert alert-success" role="alert">'.$msg.'</div>',
				'url'		=> $url,
                'num'       => $num
			);
		}else{
			$result = array(
				'respuesta' => 'error',
				'msg'       => '<div class="alert alert-danger" role="alert">'.$msg.'</div>',
				'url'		=> $url,
                'num'       => $num,
			);
		}
		return $result;
	}

	function resultado_timbrado($peticion,$uuid,$msg)
	{
		if($peticion)
        {
            $result = array(
                'msg'   => "<div style='height: 360px'>
                              <center style='margin-top: 50px'>
                                <img src='".base_url()."assets/img/descarga.png' width='400px'><br><br><br>
                                <a href='https://app.facturadigital.com.mx/docs/pdf/".$uuid."' target='_blank'><u>Descargar Factura</u></a>
                              </center>
                            </div>",
                'btn'   => '<div style="background: #2AA755;color: white; padding: 5px;border-radius: 5px;">'.$msg.'</div>',
                'status'=> "exito"
            );
        }else{ 
            $result = array(
				'btn'    => '<div style="background: #F04E49;color: white; padding: 5px;border-radius: 5px;">'.$msg.'</div>',
				'status' => 'error'
            );
        }
        return $result;
	}

	function agregarArticulos($preventa,$uuid,$certificado,$certificado_sat,$fecha_timbrado,$url_PDF,$url_XML,$total,$tipo,$serie,$folio)
    {
    	$CI =& get_instance();
        $factura    = $CI->Modelo_timbrado->get_timbrar($preventa);
        $datos = array(                 
            'uuid'             => $uuid,
            'total_factura'    => $total,
            'pdf'              => $url_PDF,
            'xml    '          => $url_XML,
            'fecha_timbrado'   => date("Y-m-d H:i:s"), 
            'uso_cfdi'         => $factura->uso_cfdi,
            'certificado'      => $certificado, 
            'certificado_sat'  => $certificado_sat, 
            'serie'            => $serie,
            'folio'            => $folio,
            'tipo_comprobante' => $tipo,
            'condicion_pago'   => $factura->condicion_pago,
            'metodo_pago'      => $factura->metodo_pago,
            'forma_pago'       => $factura->forma_pago,
            'ref_cliente'      => $factura->ref_cliente
        );
        $id = $CI->Modelo_articulos->insertarDatosTimbrado($datos);
        ///////////////////////////////////////////////////////////////////////
        $articulos = $CI->Modelo_timbrado->get_productosTimbrar($preventa);
        if (!empty($articulos)) 
        {
            foreach ($articulos ->result() as $articulo) 
            {
               $data = array(
                'cve_producto'   => $articulo->clave_sat,
                'articulo'       => $articulo->articulo, 
                'cantidad'       => $articulo->cantidad_venta, 
                'cve_unidad'     => $articulo->unidad, 
                'descripcion'    => $articulo->descripcion_preventa, 
                'valor_unitario' => $articulo->costo, 
                'importe'        => $articulo->importe, 
                'descuento'      => $articulo->descuento,
                'tipo'           => $articulo->tipo,
                'ref_factura'    => $id
                );
                $CI->Modelo_articulos->insertarProductoFacturado($data);

                # DATOS ARTICULO ACTUALES
                $id_articulo = $articulo->id_articulo;
                $cantidad    = $articulo->cantidad;
                # DATOS FACTURADOS
                $cantidadFac = $articulo->cantidad_venta; 
                # NUEVOS DATOS
                $nuevos = array(
                    'cantidad' => $cantidad - $cantidadFac
                );

                $CI->Modelo_articulos->update_articulo($id_articulo,$nuevos);
            }            
        }
        $this->borrar_datos($factura->id_preventa);        
        return $id;
    }

    function borrar_datos($id)
    {
    	$CI =& get_instance();
        $CI->Modelo_timbrado->borrar_preventa($id);
        $CI->Modelo_timbrado->borrar_articulosPreventa($id);
        $CI->Modelo_timbrado->borrar_uuidRelacion($id);
        $CI->Modelo_timbrado->eliminar_relacionDocto($id);        
    }

    function relacion_factura($factura,$r_uuid)
    {
    	$CI =& get_instance();
        foreach ($r_uuid ->result() as $uuids) 
        {
            $result   =  $CI->Modelo_timbrado->get_factura($uuids->uuid);
            $relacion = null;
            if (!empty($uuids->t_relacion)) {
                $relacion = $uuids->t_relacion;
            }
        	$data = array(
				'factura_padre'  => $factura, 
				'factura_hijo'   => $result->id_factura,
				'c_tipoRelacion' => $relacion,
                'fechaRelacion'  => date("Y-m-d H:i:s") 
        	);            
            $CI->Modelo_timbrado->agregarRelacion($data);
        } 
    }

    function validacion_timbrado($id,$tipo)
    {
        $CI =& get_instance();
        $timbrado = $CI->Modelo_timbrado->validacion($id);
        if (!empty($timbrado)) 
        {
            $result   = $timbrado->estatus_preventa;
            $cliente  = $timbrado->ref_cliente;
            if ($result == "timbrado") {
                redirect(base_url().'pcliente/'.$cliente);
            }else if($result == "activo"){

            }           
        }else{
            redirect(base_url().$tipo);
        }
    }

    # OBTENEMOS LA RESTA DEL TOTAL DE LA FACTURA MENOS LOS COMPROBANTES DE PAGO
    function saldoRestanteCliente($uuid)
    {
        $CI =& get_instance();
        $resul        = $CI->Modelo_timbrado->get_facturasRelacion($uuid);
        $totalFactura = $resul->total_factura;
        $total        = 0;
        $resul        = $CI->Modelo_timbrado->get_recibosPagos($uuid);
        if (!empty($resul)) {
            $res   = $CI->Modelo_timbrado->get_comprobantesPagoTotal($resul->factura_hijo);
            if (!empty($res)) {
                foreach ($res -> result() as $totales) {
                    $total = $total + $totales->total_factura;
                }
            }
        }
        return $totalResultado = $totalFactura - $total;
    }


    function permisos()
    {
        $CI =& get_instance();
        if($CI->session->userdata('permiso') == "admin"){
            $permiso = "";
        }else{
            $permiso = "onfocus = 'this.blur()' ";
        }

        return $permiso;
    }

}