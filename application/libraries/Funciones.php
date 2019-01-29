<?php if ( ! defined('BASEPATH')) exit('No esta permitido el acceso'); 
//La primera línea impide el acceso directo a este script
class Funciones {

	public function __construct()
    {
        $CI =& get_instance();
        $CI->load->model('Modelo_articulos');
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

    function resultado($peticion,$url,$msg)
	{
		if($peticion)
		{
			$result = array(
				'respuesta' => 'correcto',
				'msg'       => '<div class="alert alert-success" role="alert">'.$msg.'</div>',
				'url'		=> $url
			);
		}else{
			$result = array(
				'respuesta' => 'error',
				'msg'       => '<div class="alert alert-danger" role="alert">'.$msg.'</div>',
				'url'		=> $url,
			);
		}
		return $result;
	}

	function resultado_timbrado($peticion,$uuid,$msg)
	{
		if($peticion)
        {
            $result = array(
                'msg'   => "<center><img src='".base_url()."assets/img/correcto.jpg' width='400px'></center>",
                'btn'   => "<a href='".base_url()."descarga/".$uuid.".pdf' target='_blank'>Descargar Factura</a>",
                'status'=> "exito"
            );
        }else{ 
            $result = array(
				'btn'    => '<div class="alert alert-danger" role="alert">'.$msg.'</div>',
				'status' => 'error'
            );
        }
        return $result;
	}

}