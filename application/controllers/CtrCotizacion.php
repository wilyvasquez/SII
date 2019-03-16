<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrCotizacion extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Funciones');
        $this->load->library('Permisos');
        $this->load->library('Not_found');

        $this->load->model('Modelo_usuarios');
        $this->load->model('Modelo_cotizacion');
        $this->permisos->redireccion();
        
        $this->facturas = 'assets/pdf/facturas/';

        $this->load->helper('date');
        date_default_timezone_set('America/Monterrey');
    }

    public function index()
	{
        $pmenu               = $this->permisos->menu();
        $datos["cotizacion"] = $this->Modelo_cotizacion->obtener_cotizacion($this->session->userdata('id'));
        $data = array(
			"cotizacion"  => "active",
			"gcotizacion" => "active",
			"title"       => "COTIZACION",
			"subtitle"    => "Agregar Articulos",
			"contenido"   => "admin/cotizacion/cotizacion",
			"menu"        => $pmenu,
			"archivosJS"  => $this->load->view('admin/cotizacion/archivos/archivosJS',null,true), # ARCHIVOS JS UTILIZADOS
			"tabla"       => $this->load->view('admin/cotizacion/tabla_cotizacion',null,true),
            "ctabla"      => $this->load->view('admin/cotizacion/tabla_cproductos',$datos,true),
            "modal"       => $this->load->view('admin/cotizacion/modal/agregar_articulo',null,true),
            "eliminar"    => $this->load->view('admin/cotizacion/modal/eliminar_acotizacion',null,true),
            "crear"       => $this->load->view('admin/cotizacion/modal/crear_cotizacion',null,true),
        );

		$this->load->view('universal/plantilla',$data);
	}

    public function agregar_articulo()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            $data = array(
                'articulo'        => $this->input->post("marticulo"), 
                'codigo'          => $this->input->post("mcodigo"), 
                'cantidad'        => $this->input->post("mcantidad"), 
                'costo'           => $this->input->post("mcosto"), 
                'ref_articulo'    => $this->input->post("mid"), 
                'alta_cotizacion' => date("Y-m-d H:i:s"), 
                'ref_usuario'     => $this->session->userdata('id'), 
            );
            $peticion = $this->Modelo_cotizacion->agregar_cotizacion($data);
            $url      = "";
            $msg      = "Exito, Articulo agregado correctamente";
            echo json_encode($this->funciones->resultado($peticion,$url,$msg, null));
        }
    }

    public function eliminar_articulo()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            $id       = $this->input->post("midc");
            $peticion = $this->Modelo_cotizacion->eliminarArticuloCotizacion($id);
            $url      = "";
            $msg      = "Exito, Articulo eliminado correctamente";
            echo json_encode($this->funciones->resultado($peticion,$url,$msg,null));
        }
    }

    public function generar_cotizacion()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            if ($this->input->post("activo")) 
            {
                $id        = $this->session->userdata('id');
                $articulos = $this->Modelo_cotizacion->get_cotizacion($id);
                $num       = $this->Modelo_cotizacion->get_numCotizacion();
                if (!empty($num)) {
                    $ultimo = $num->num_cotizacion + 1;
                }else{
                    $ultimo = 1;
                }

                $datos = array(
                    'cliente'          => $this->input->post("cliente"), 
                    'telefono'         => $this->input->post("telefono"), 
                    'num_cotizacion'   => $ultimo,
                    'alta_dcotizacion' => date("Y-m-d H:i:s"), 
                );
                $resul = $this->Modelo_cotizacion->agregar_dcotizacion($datos);

                if (!empty($articulos)) {
                    foreach ($articulos -> result() as $articulo) {
                        $id_articulo = $articulo->id_cotizacion;
                        $data = array(
                            'ref_dcotizacion' => $ultimo, 
                        );
                        $this->Modelo_cotizacion->update_dcotizacion($data,$id_articulo);
                    }
                }
                echo "<a href='".base_url()."dcotizacion' target='_blank'>Descargar Cotizacion</a>";
            }
        }
    }

    public function historial_cotizacion()
    {
        $pmenu         = $this->permisos->menu();
        $data = array(
            "cotizacion"  => "active",
            "historial"   => "active",
            "title"       => "TABLA COTIZACIONES",
            "subtitle"    => "Datos Cotizaciones",
            "contenido"   => "admin/cotizacion/tabla_historial",
            "menu"        => $pmenu,
            "archivosJS"  => $this->load->view('admin/cotizacion/archivos/archivosJS',null,true), # ARCHIVOS JS UTILIZADOS
            "datos"       => $this->Modelo_cotizacion->obtener_cotizaciones()
        );

        $this->load->view('universal/plantilla',$data);
    }

    public function get_datosCotizacion()
    {
        if(!$this->input->is_ajax_request())
        {
            // $this->not_found->not_found();
        }else{
            if($this->input->post("id"))
            {
                $id = $this->input->post("id");                
                $resul = $this->Modelo_cotizacion->obtener_datosCotizacion($id);
                echo json_encode(
                    $result = array(
                        'cliente'    => $resul->cliente,
                        'telefono'   => $resul->telefono,
                        'fecha'      => $resul->alta_dcotizacion,
                        'id'         => $resul->id_dcotizacion
                    )
                );
            }
        } 
    }

    public function agregar_ArticuloFacturacion()
    {
        if ($this->input->post("activo")) 
        {
            $id_dcotizacion = $this->input->post("midc");  # ID DE LOS DATOS DE LA COTIZACION
            $factura        = $this->input->post("factura"); # FACTURA EN PROCESO
            $articulos      = $this->Modelo_cotizacion->obtener_articulosCotizacion($id_dcotizacion);
            if (!empty($articulos)) {
                foreach ($articulos -> result() as $articulo) {
                    $data = array(
                        'cantidad_venta'       => $articulo->cantidad,
                        'importe'              => $articulo->cantidad * $articulo->costo, 
                        'alta_apreventa'       => date('Y-m-d H:i:s'), 
                        'descuento'            => 0, 
                        'descripcion_preventa' => $articulo->articulo,  
                        'ref_articulo'         => $articulo->ref_articulo,
                        'ref_preventa'         => $factura,
                    );
                    $peticion = $this->Modelo_articulos->put_articulo($data);
                }
                if ($peticion) {
                    $url  = "ajax_tarticulos";
                    $msg  = "Exito, Datos agregados correctamente";
                    echo json_encode($this->funciones->resultado($peticion, $url, $msg, $factura));
                }
            }
        }else{
            $url  = "";
            $msg  = "Error, validad datos";
            echo json_encode($this->funciones->resultado($peticion = false, $url, $msg, null));
        }
    }
}