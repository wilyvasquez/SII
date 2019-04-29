<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrSucursal extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Facturapi');
        $this->load->library('Funciones');
        $this->load->library('Not_found');
        $this->load->library('Permisos');
        
        $this->load->model('Modelo_sucursal');
        $this->permisos->redireccion();
        
        $this->load->helper('date');
        date_default_timezone_set('America/Monterrey');
    }

    public function sucursal()
    {
        $pmenu = $this->permisos->menu();
        $data = array(
            "madmin"     => "active",
            "sucursal"   => "active",
            "title"      => "Sucursal",
            "subtitle"   => "Alta de sucursal",
            "contenido"  => "admin/sucursal/sucursal",
            "menu"       => $pmenu,
            "tcreditos"  => $this->facturapi->consultarCreditos(),
            "modal_s"    => $this->load->view('admin/sucursal/modal/modal-sucursal',null,true), # AGREGAR NUNEVA MARCA
            "sucursales" => $this->Modelo_sucursal->get_sucursal(),
            "archivosJS" => $this->load->view('admin/factura/archivos/archivosJS',null,true) # ARCHIVOS JS UTILIZADOS
        );
        $this->load->view('universal/plantilla',$data);
    }

    public function agregar_sucursal()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            if ($this->input->post("razon") && $this->input->post("sucursal") && $this->input->post("rfc") && $this->input->post("direccion")) 
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
                if($peticion) {
                    $url = "ajax_sucursal";
                    $msg = "Exito, Sucursal agregado correctamente";
                    echo json_encode($this->funciones->resultado($peticion,$url,$msg,null));
                }
            }else{
                $msg = "Error, No se han actualizado los datos";
                echo json_encode($this->funciones->resultado($peticion = false,$url = null,$msg,null));
            }
        }
    }

    public function ajax_sucursal()
    {
        if(!$this->input->is_ajax_request())
        {
             $this->not_found->not_found();
        }else{
            $data['sucursales'] = $this->Modelo_sucursal->get_sucursal();
            $this->load->view('admin/sucursal/ajax/ajax_sucursal',$data);
        }
    }

    public function up_sucursal()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            $id = $this->input->post("mid");
            $data = array(
                'razon_social'     => $this->input->post("rsocial"),
                'rfc'              => $this->input->post("mrfc"),
                'correo'           => $this->input->post("mcorreo"),
                'telefono'         => $this->input->post("mtelefono"),
                'estatus_sucursal' => $this->input->post("mestatus")
            );
            $peticion = $this->Modelo_sucursal->update_sucursal($id,$data);
            if ($peticion) {
                $msg = "Exito, Actualizado correctamente";
                echo json_encode($this->funciones->resultado($peticion, $url = "", $msg,null));
            }else{
                $msg = "Error, Accion no ejecutada";
                echo json_encode($this->funciones->resultado($peticion, $url = "", $msg,null));
            }
        }
    }
}