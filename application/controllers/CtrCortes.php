<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrCortes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Funciones');
        $this->load->library('Not_found');
        $this->load->library('Permisos');

        $this->load->model('Modelo_cliente');
        $this->load->model('Modelo_timbrado');
        $this->load->model('Modelo_sat');
        $this->permisos->redireccion();
        
        $this->load->helper('date');
        date_default_timezone_set('America/Monterrey');
    }

    public function cortes()
    {
    	$pmenu = $this->permisos->menu();
		$datos["serieFolio"] = $this->Modelo_cliente->get_serieFolio();
		$data = array(
			"corte"      => "active",
			"title"       => "Cortes Caja",
			"subtitle"    => "Reporte de caja",
			"contenido"   => "admin/cortes/cortes",
			"menu"        => $pmenu,
			"tabla"       => $this->load->view('admin/folios/tabla-folios',$datos,true),
			"archivosJS"  => $this->load->view('admin/factura/archivos/archivosJS',null,true),  # ARCHIVOS JS UTILIZADOS
			"mSerieFolio" => $this->load->view('admin/folios/modal/modal_serieFolio',null,true)  # MODAL ACTUALIZAR SERIE FOLIO
		);
		$this->load->view('universal/plantilla',$data);
    }
}