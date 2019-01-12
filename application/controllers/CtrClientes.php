<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrClientes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Facturapi');
        $this->facturas = 'assets/pdf/facturas/';
        $this->load->model('Modelo_cliente');
        $this->load->model('Modelo_sucursal');
        $this->load->model('Modelo_articulos');
        $this->load->model('Modelo_inventario');
        $this->load->model('Modelo_timbrado');
        $this->load->model('Modelo_sat');
    }

    public function cliente()
	{
		$data["cliente"]   = "active";
		$data["title"]     = "Cliente";
		$data["subtitle"]  = "Alta de Cliente";
		$data["contenido"] = "admin/cliente/cliente";
		$data["menu"]      = "admin/menu_admin";
		$data['clientes']  = $this->Modelo_cliente->get_clientes();
		$data['ucfdis']    = $this->Modelo_sat->get_usoCfdi();
		$data["tabla"]     = $this->load->view('admin/cliente/tabla-cliente',$data,true);
		$this->load->view('universal/plantilla',$data);
	}

	public function perfil_cliente($id)
	{
		$data["cliente"]   = "active";
		$data["title"]     = "Cliente";
		$data["subtitle"]  = "Datos del Cliente";
		$data["contenido"] = "admin/cliente/perfil-cliente";
		$data["menu"]      = "admin/menu_admin";
		$data['icliente']  = $this->Modelo_cliente->get_cliente($id);
		$data['ifacturas'] = $this->Modelo_cliente->obtener_facturas($id);
		$data["facturas"]  = $this->load->view('admin/cliente/facturas_cliente',$data,true);
		$data["ucliente"]  = $this->load->view('admin/cliente/update-cliente',$data,true);
		$this->load->view('universal/plantilla',$data);
	}

	public function agregar_cliente()
	{
		if(!$this->input->is_ajax_request())
		{
		 show_404();
		}else{
			$ref = $this->input->post("ref");
			$datos = array(
				"cliente"   => $this->input->post("cliente"),
				"rfc"       => $this->input->post("rfc"),
				"uso_cfdi"  => $this->input->post("ucfdi"),
				"telefono"  => $this->input->post("telefono"),
				"correo"    => $this->input->post("correo"),
				"direccion" => $this->input->post("direccion")
			);
			if ($ref == 1) 
			{
				$url = 'ajax_tcliente';
			}else{ 
				$url = 'ajax_scliente'; 
			}
			$peticion = $this->Modelo_cliente->put_cliente($datos);
			echo json_encode($this->resultado($peticion,$url));
		}
	}

	function ajax_tcliente()
	{
		if(!$this->input->is_ajax_request())
		{
		 show_404();
		}else{
			$data['clientes']  = $this->Modelo_cliente->get_clientes();
			$this->load->view('admin/cliente/ajax/ajax-tcliente',$data);
		}
	}

	function ajax_scliente()
	{
		if(!$this->input->is_ajax_request())
		{
		 show_404();
		}else{
			$data['clientes']  = $this->Modelo_cliente->get_clientes();
			$this->load->view('admin/factura/ajax/ajax_select',$data);
		}
	}
}