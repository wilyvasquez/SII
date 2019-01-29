<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrInventario extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Funciones');
        $this->load->model('Modelo_cliente');
        $this->load->model('Modelo_sucursal');
        $this->load->model('Modelo_articulos');
        $this->load->model('Modelo_inventario');
        $this->load->model('Modelo_timbrado');
        $this->load->model('Modelo_sat');
    }

    public function inventario()
    {
        $data = array(
            "inventario" => "active",
            "title"      => "Articulos",
            "subtitle"   => "Alta de inventario",
            "contenido"  => "admin/inventario/inventario",
            "menu"       => "admin/menu_admin",
            "modal_f"    => $this->load->view('admin/inventario/modal/modal-fabricante',null,true), # AGREGAR NUEVO FABRICANTE
            "modal_l"    => $this->load->view('admin/inventario/modal/modal-linea',null,true), # AGREGAR NUEVA LINEA
            "modal_m"    => $this->load->view('admin/inventario/modal/modal-marca',null,true), # AGREGAR NUNEVA MARCA
            "archivosJS" => $this->load->view('admin/factura/archivos/archivosJS',null,true),  # ARCHIVOS JS UTILIZADOS
            "clave"      => $this->Modelo_sat->get_claveSat(),
            "articulos"  => $this->Modelo_articulos->get_articulos(),
            "marcas"     => $this->Modelo_inventario->get_marca(),
            "lineas"     => $this->Modelo_inventario->get_linea(),
            "fabricantes"=> $this->Modelo_inventario->get_fabricante()
        );
        $this->load->view('universal/plantilla',$data);
    }

    public function put_inventario()
    {
        if(!$this->input->is_ajax_request())
        {
         show_404();
        }else{
            $id_clave = $this->input->post("unidad");
            $clave    = $this->Modelo_sat->get_clave($id_clave);

            $data = array(
                'articulo'         => $this->input->post("articulo"),
                'codigo_sat'       => $this->input->post("clave"),
                'descripcion'      => $this->input->post("descripcion"),
                'costo'            => $this->input->post("costo"),
                'unidad'           => $clave->clave,
                'clave_sat'        => $clave->c_ClaveUnidad,
                'codigo_interno'   => $this->input->post("codigoi"),
                'cantidad'         => $this->input->post("cantidad"),
                'estatus_articulo' => "Activo",
                'ref_marca'        => $this->input->post("marca"),
                'ref_linea'        => $this->input->post("linea"),
                'ref_fabricante'   => $this->input->post("fabricante"),
                );
            $url      = "";
            $peticion = $this->Modelo_inventario->put_inventario($data);
            $msg      = "Exito, Articulo agregado correctamente";
            echo json_encode($this->funciones->resultado($peticion,$url,$msg));
        }
    }

    public function agregar_marca()
    {
        if(!$this->input->is_ajax_request())
        {
         show_404();
        }else{
            $data = array(
                'marca'       => $this->input->post("marca"),
                'nombre'      => $this->input->post("nombre"),
                'descripcion' => $this->input->post("observaciones")
            );
            $peticion = $this->Modelo_inventario->put_marca($data);
            $url      = "ajax_marca";
            $msg      = "Exito, Marca agregado correctamente";
            echo json_encode($this->funciones->resultado($peticion,$url,$msg));
        }
    }

    public function ajax_marca()
    {
        if(!$this->input->is_ajax_request())
        {
         show_404();
        }else{
            $data['marcas'] = $this->Modelo_inventario->get_marca();
            $this->load->view('admin/marca/ajax/ajax_marca',$data);
        }
    }

    public function agregar_linea()
    {
        if(!$this->input->is_ajax_request())
        {
         show_404();
        }else{
            $data = array(
                'linea'       => $this->input->post("linea"),
                'nombre'      => $this->input->post("nombre"),
                'descripcion' => $this->input->post("observaciones")
            );
            $peticion = $this->Modelo_inventario->put_linea($data);
            $url      = "ajax_linea";
            $msg      = "Exito, Linea agregado correctamente";
            echo json_encode($this->funciones->resultado($peticion,$url,$msg));
        }
    }

    public function ajax_linea()
    {
        if(!$this->input->is_ajax_request())
        {
         show_404();
        }else{
            $data['lineas'] = $this->Modelo_inventario->get_linea();
            $this->load->view('admin/linea/ajax/ajax_linea',$data);
        }
    }

    public function agregar_fabricante()
    {
        if(!$this->input->is_ajax_request())
        {
         show_404();
        }else{
            $data = array(
                'fabricante'  => $this->input->post("fabricante"),
                'direccion'   => $this->input->post("direccion"),
                'telefono'    => $this->input->post("telefono"),
                'rfc'         => $this->input->post("rfc"),
                'descripcion' => $this->input->post("observaciones")
            );
            $peticion = $this->Modelo_inventario->put_fabricante($data);
            $url      = "ajax_fabricante";
            $msg      = "Exito, Fabricante agregado correctamente";
            echo json_encode($this->funciones->resultado($peticion,$url,$msg));
        }
    }

    public function ajax_fabricante()
    {
        if(!$this->input->is_ajax_request())
        {
         show_404();
        }else{
            $data['fabricantes'] = $this->Modelo_inventario->get_fabricante();
            $this->load->view('admin/fabricante/ajax/ajax_fabricante',$data);
        }
    }
}