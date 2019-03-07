<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrUsuarios extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Funciones');
        $this->facturas = 'assets/pdf/facturas/';
        $this->load->model('Modelo_cliente');
        $this->load->model('Modelo_sucursal');
        $this->load->model('Modelo_articulos');
        $this->load->model('Modelo_inventario');
        $this->load->model('Modelo_timbrado');
        $this->load->model('Modelo_sat');
        $this->load->model('Modelo_usuarios');
        $this->load->helper('date');
        date_default_timezone_set('America/Monterrey');
    }

    public function usuarios()
	{
        $data = array(
    		"user"      => "active",
    		"title"     => "Usuarios",
    		"subtitle"  => "Alta de usuarios",
    		"contenido" => "admin/usuarios/usuarios",
    		"menu"      => "admin/menu_admin",
            "archivosJS"=> $this->load->view('admin/usuarios/archivos/archivoJS',null,true) # ARCHIVOS JS UTILIZADOS
        );
        $data["usuarios"] = $this->Modelo_usuarios->get_usuarios();
        $data["modalUser"] = $this->load->view('admin/usuarios/modal/modal_editarUsuarios',null,true); # ARCHIVOS JS UTILIZADOS
		$this->load->view('universal/plantilla',$data);
	}

    public function agregar_usuario()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            if ($this->input->post("nombre") && $this->input->post("usuario") && $this->input->post("contrasena") && $this->input->post("sucursal") && $this->input->post("estatus")) 
            {
                $data = array(
                    'nombre'     => $this->input->post("nombre"), 
                    'usuario'    => $this->input->post("usuario"), 
                    'contrasena' => $this->input->post("contrasena"), 
                    'telefono'   => $this->input->post("telefono"), 
                    'correo'     => $this->input->post("correo"), 
                    'direccion'  => $this->input->post("direccion"),
                    'sucursal'   => $this->input->post("sucursal"),
                    'estatus'    => $this->input->post("estatus") 
                );
                $peticion = $this->Modelo_usuarios->put_usuarios($data);
                if ($peticion) {
                    $msg = "Exito, Cliente agregado correctamente";
                    echo json_encode($this->funciones->resultado($peticion,$url = "",$msg));
                }else{
                    $msg = "Error, No se agrego el cliente";
                    echo json_encode($this->funciones->resultado($peticion = false,$url = "",$msg));
                }
            }else{
                $msg = "Error, No se agrego el cliente";
                echo json_encode($this->funciones->resultado($peticion = false,$url = "",$msg));
            }
        }
    }

    public function update_usuario()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            if ($this->input->post("mnombre") && $this->input->post("msucursal") && $this->input->post("mestatus") && $this->input->post("ids")) 
            {
                $id = $this->input->post("ids");
                $data = array(
                    'nombre'     => $this->input->post("mnombre"), 
                    'telefono'   => $this->input->post("mtelefono"), 
                    'correo'     => $this->input->post("mcorreo"), 
                    'direccion'  => $this->input->post("mdireccion"),
                    'sucursal'   => $this->input->post("msucursal"),
                    'estatus'    => $this->input->post("mestatus") 
                );
                $peticion = $this->Modelo_usuarios->update_usuarios($id,$data);
                if ($peticion) {
                    $msg = "Exito, Usuario actualizado correctamente";
                    echo json_encode($this->funciones->resultado($peticion,$url = "",$msg));
                }else{
                    $msg = "Error, No se actualizo el usuario";
                    echo json_encode($this->funciones->resultado($peticion = false,$url = "",$msg));
                }
            }else{
                $msg = "Error, No se actualizo el usuario";
                echo json_encode($this->funciones->resultado($peticion = false,$url = "",$msg));
            }
        }
    }

}