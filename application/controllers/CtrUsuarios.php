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
    }

    public function usuarios()
	{
		$data["user"]      = "active";
		$data["title"]     = "Usuarios";
		$data["subtitle"]  = "Alta de usuarios";
		$data["contenido"] = "admin/usuarios/usuarios";
		$data["menu"]      = "admin/menu_admin";
		$this->load->view('universal/plantilla',$data);
	}


}