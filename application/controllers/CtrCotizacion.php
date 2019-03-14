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
        $this->permisos->redireccion();
        
        $this->facturas = 'assets/pdf/facturas/';

        $this->load->helper('date');
        date_default_timezone_set('America/Monterrey');
    }

    public function index()
	{
        $pmenu = $this->permisos->menu();
        $data = array(
			"cotizacion"  => "active",
			"gcotizacion" => "active",
			"title"       => "Usuarios",
			"subtitle"    => "Alta de usuarios",
			"contenido"   => "admin/cotizacion/cotizacion",
			"menu"        => $pmenu,
			"archivosJS"  => $this->load->view('admin/usuarios/archivos/archivoJS',null,true), # ARCHIVOS JS UTILIZADOS
			"tabla"       => $this->load->view('admin/cotizacion/tabla_cotizacion',null,true),
        );

		$this->load->view('universal/plantilla',$data);
	}
}