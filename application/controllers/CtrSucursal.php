<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrSucursal extends CI_Controller {

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

    public function sucursal()
    {
        $data["sucursal"]   = "active";
        $data["title"]      = "Sucursal";
        $data["subtitle"]   = "Alta de sucursal";
        $data["contenido"]  = "admin/sucursal/sucursal";
        $data["menu"]       = "admin/menu_admin";
        $data['sucursales'] = $this->Modelo_sucursal->get_sucursal();
        $this->load->view('universal/plantilla',$data);
    }

    public function agregar_sucursal()
    {
        $datos = array(
            "razon_social"     => $this->input->post("razon"),
            "sucursal"         => $this->input->post("sucursal"),
            "rfc"              => $this->input->post("rfc"),
            "direccion"        => $this->input->post("direccion"),
            "correo"           => $this->input->post("correo"),
            "telefono"         => $this->input->post("telefono"),
            "estatus_sucursal" => $this->input->post("estatus")
        );
        $peticion = $this->Modelo_sucursal->put_sucursal($datos);
        $url = "ajax_sucursal";
        $msg = "Exito, Sucursal agregado correctamente";
        echo json_encode($this->funciones->resultado($peticion,$url,$msg));
    }

    public function ajax_sucursal()
    {
        $data['sucursales'] = $this->Modelo_sucursal->get_sucursal();
        $this->load->view('admin/sucursal/ajax/ajax_sucursal',$data);
    }
}