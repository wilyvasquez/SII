<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();
		// $this->load->library('facturacion/ejemplo_alerta_timbres');
		// $this->load->library('facturacion/ejemplo_cancelacion');
	}

	public function index()
	{
		// $this->load->library('facturacion/ejemplo_cancelacion');
		// $this->load->library('facturacion/ejemplo_timbrado1');
		$this->load->library('facturacion/ejemplo_simple_local');
	}
}
