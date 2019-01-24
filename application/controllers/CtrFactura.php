<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrFactura extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('Funciones');
		$this->load->model('Modelo_cliente');
		$this->load->model('Modelo_sucursal');
		$this->load->model('Modelo_articulos');
		$this->load->model('Modelo_inventario');
		$this->load->model('Modelo_timbrado');
		$this->load->model('Modelo_sat');
		$this->load->library('Parser');

		$this->factura 	= 'assets/pdf/facturas/';
		$this->load->helper(array('download'));
	}
	
	public function folios()
	{
		$data = array(
			"folios"    => "active",
			"title"     => "Folios ,y Series",
			"subtitle"  => "Alta de folios",
			"contenido" => "admin/folios/folios_series",
			"menu"      => "admin/menu_admin",
			"tabla"     => $this->load->view('admin/folios/tabla-folios',null,true)
		);
		$this->load->view('universal/plantilla',$data);
	}

	/**
	 * VISTAS PRE FACTURA
	 */

	public function pre_factura()
	{
		$data = array(
			'title'      => 'Factura',
			'timbrado'   => 'active',
			'factura'    => 'active',
			'subtitle'   => 'Crear Factura',
			'contenido'  => 'admin/factura/factura', 
			'menu'       => 'admin/menu_admin', # MENU DE AMDIN
			'mcliente'   => $this->load->view('admin/factura/modal/modal-cliente',null,true), # MODAL CLIENTE REGISTRO PRE FACTURA
			'archivosJS' => $this->load->view('admin/factura/archivos/archivosJS',null,true)  # ARCHIVOS JS UTILIZADOS
		);
		$datos = array(
			'title'      => 'Factura',
			'clientes'   => $this->Modelo_cliente->get_clientes(),# OBTENER TODOS LOS CLIENTES REGISTRADOS
			'fpagos'     => $this->Modelo_sat->get_formaPagos(),  # OBTENEMOS LAS FORMAS DE PAGO SAT
			'mpagos'     => $this->Modelo_sat->get_metodoPagos(), # OBTENEMOS LOS METODOS DE PAGO SAT
			'ucfdis'     => $this->Modelo_sat->get_usoCfdi(),     # OBTENEMOS EL USO DEL CFDI SAT
		);
		# VISTA DEL REGISTRO DE LOS CLIENTES PARA MOSTRAR EN LA PRE FACTURA
		$data["info"] = $this->load->view('admin/factura/info-cliente',$datos,true);
		# PLANTILLA DE LAS VISTAS
		$this->load->view('universal/plantilla',$data);
	}

	public function facturas_proceso()
	{
		$data = array(
			'title'      => 'Factura',
			'proceso'    => 'active',
			'subtitle'   => 'Facturas en proceso',
			'contenido'  => 'admin/factura/proceso/facturas_proceso', 
			'menu'       => 'admin/menu_admin', # MENU DE AMDIN
			'archivosJS' => $this->load->view('admin/factura/archivos/archivosJS',null,true),  # ARCHIVOS JS UTILIZADOS
			'prefactura' => $this->Modelo_timbrado->get_facturasProceso()
		);
		# PLANTILLA DE LAS VISTAS
		$this->load->view('universal/plantilla',$data);
	}

	public function info_procesoFacturas($id)
	{
		$data = array(
			'title'      => 'Factura',
			'proceso'    => 'active',
			'subtitle'   => 'Factura en proceso',
			'contenido'  => 'admin/factura/proceso/proceso', 
			'menu'       => 'admin/menu_admin', # MENU DE AMDIN
			'archivosJS' => $this->load->view('admin/tfactura/archivos/archivosJS',null,true),  # ARCHIVOS JS UTILIZADOS
			'prefactura' => $this->Modelo_timbrado->get_facturasProceso(),
			'tarticulos' => $this->Modelo_articulos->get_articulo($id),
			'marticulo'  => $this->load->view('admin/tfactura/modal/modal-editar-articulo',null,true) # MODALES
		);
		$datos = array(
			'icliente' => $this->Modelo_cliente->datos_cliente($id),
			'id'       => $id
		);
		# INFORMACION DEL CLIENTE
		$data["info"]       = $this->load->view('admin/factura/proceso/datos_proceso',$datos,true);
		# TABLA DE LOS ARTICULOS A TIMBRAR
		$data["tarticulos"] = $this->load->view('admin/tfactura/tabla-articulos',$data,true);
		# PLANTILLA DE LAS VISTAS
		$this->load->view('universal/plantilla',$data);
	}

	public function push_prefactura()
	{
		if(!$this->input->is_ajax_request())
		{
		 show_404();
		}else{
			$preventa  = 1;
			$condicion = "CREDITO";
			$codigo    = $this->Modelo_timbrado->get_codigo();

			if (!empty($codigo)) {
				$preventa = $codigo->id_preventa + 1;
			}
			if ($this->input->post("metodo") == "PUE") {
				$condicion = "CONTADO";
			}

			$data = array(
				'alta_preventa'    => date("Y-m-d H:i:s"),
				'codigo_preventa'  => "001-A0000".$preventa,
				'condicion_pago'   => $condicion,
				'forma_pago'       => $this->input->post("forma"),
				'metodo_pago'      => $this->input->post("metodo"),
				'uso_cfdi'         => $this->input->post("cfdi"),
				'ref_cliente'      => $this->input->post("cliente"),
			);
			$id = $this->Modelo_timbrado->put_preventa($data);
			echo '<a href="'.base_url().'factura/'.$id.'" class="btn btn-primary btn-sm pull-left">Agregar Articulos</a>';
		}
	}
	/**
	 * VISTA Y NOMBRE DE LOS DATOS PARA FACTURAR SE AGREGARAN LOS ARTICULOS A TIMBRAR
	 */
	public function factura($id)
	{
		$this->validacion_timbrado($id);		
		$data["timbrado"]    = "active";
		$data["factura"]     = "active";
		$data["title"]       = "Factura";
		$data["subtitle"]    = "Timbrar Factura";
		$data["contenido"]   = "admin/tfactura/tfactura";
		$data["menu"]        = "admin/menu_admin";

		# CONSULTA OBTENER ARTICULAR A FACTURAR
		$data['articulos']   = $this->Modelo_articulos->get_articulos();
		$data['tarticulos']  = $this->Modelo_articulos->get_articulo($id);

		# CONSULTA FACTURAS Y TIPOS DE RELACION PARA VINCULAR
        $data['facturas']    = $this->Modelo_cliente->get_facturas();
        $data['trelacion']   = $this->Modelo_sat->get_tipoRelacion();

        # CONSULTA PRA OBTENER LOS UUID VINCULADOS
        $data['tuuid']       = $this->Modelo_timbrado->get_relacion($id);

        # CONSULTA OBTENER DATOS DEL CLIENTE
		$data["id"]          = $id;
		$data['icliente']    = $this->Modelo_cliente->datos_cliente($id);
		$data["nombre"]      = $data['icliente']->cliente;
		$data["precios"]     = $this->funciones->precios($id);

		# VISTAS FACTURAS
		$data["articulo"]    = $this->load->view('admin/tfactura/agregar-articulo',$data,true);
		$data["tarticulos"]  = $this->load->view('admin/tfactura/tabla-articulos',$data,true);
		$data["precios"]     = $this->load->view('admin/tfactura/precios',$data,true);

		# VISTAS NOTAS DE CREDITO
        $data["tuuid"]       = $this->load->view('admin/tncredito/tabla_uuid',$data,true);
        // $data["precios"]     = $this->load->view('admin/tncredito/timbrar_ncredito',$data,true);
		
		# MODALES
		$data["marticulo"]   = $this->load->view('admin/tfactura/modal/modal-editar-articulo',null,true);
		$data["mearticulo"]  = $this->load->view('admin/tfactura/modal/modal-eliminar-articulo',null,true);
		$data["meuuid"]      = $this->load->view('admin/tncredito/modal/modal-eliminar-uuid',$data,true);
        $data["mtimbrar"]    = $this->load->view('admin/tncredito/modal/modal-timbrar',null,true);
		# ARCHIVOS JS
        $data["archivosJS"]  = $this->load->view('admin/tfactura/archivos/archivosJS',null,true);
		$this->load->view('universal/plantilla',$data);
	}
	/**
	 * DESCARGAR ARCHIVO
	 */
	public function descarga($name)
	{  
       	$mi_pdf = fopen ($this->factura.$name, "r");
        if (!$mi_pdf) {
            echo "<p>No puedo abrir el archivo para lectura</p>";
            exit;
        }
        header('Content-type: application/pdf');
        fpassthru($mi_pdf); // Esto hace la magia
        fclose ($mi_pdf);      
	}

	public function descargas_xml($name)
   	{   		
       $data = file_get_contents($this->factura.$name); 
       force_download($name,$data);      
	}

	function validacion_timbrado($id)
	{
		$timbrado = $this->Modelo_timbrado->validacion($id);
		if (!empty($timbrado)) 
		{
			$result   = $timbrado->estatus_preventa;
			$cliente  = $timbrado->ref_cliente;
			if ($result == "timbrado") {
				redirect(base_url().'pcliente/'.$cliente);
			}else if($result == "activo"){

			}			
		}else{
			redirect(base_url().'prefactura');
		}
	}
}
