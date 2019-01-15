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

		$this->factura 	= 'assets/pdf/facturas/';
		$this->load->helper(array('download'));
	}
	
	public function folios()
	{
		$data["folios"]    = "active";
		$data["title"]     = "Folios y Series";
		$data["subtitle"]  = "Alta de folios";
		$data["contenido"] = "admin/folios/folios_series";
		$data["menu"]      = "admin/menu_admin";
		$data["tabla"]     = $this->load->view('admin/folios/tabla-folios',null,true);
		$this->load->view('universal/plantilla',$data);
	}

	/**
	 * VISTAS PRE FACTURA
	 */

	public function pre_factura()
	{
		$data["timbrado"]    = "active";
		$data["factura"]     = "active";
		$data["title"]       = "Factura";
		$data["subtitle"]    = "Crear Factura";
		$data["contenido"]   = "admin/factura/factura";
		$data["menu"]        = "admin/menu_admin";
		# OBTENER TODOS LOS CLIENTES REGISTRADOS
		$data['clientes']    = $this->Modelo_cliente->get_clientes();
		# OBTENEMOS LAS FORMAS DE PAGO SAT
		$data['fpagos']      = $this->Modelo_sat->get_formaPagos();
		# OBTENEMOS LOS METODOS DE PAGO SAT
		$data['mpagos']      = $this->Modelo_sat->get_metodoPagos();
		# OBTENEMOS EL USO DEL CFDI SAT
		$data['ucfdis']      = $this->Modelo_sat->get_usoCfdi();
		# VISTA DEL REGISTRO DE LOS CLIENTES PARA MOSTRAR EN LA PRE FACTURA
		$data["info"]        = $this->load->view('admin/factura/info-cliente',$data,true);
		# MODAL CLIENTE REGISTRO PRE FACTURA
		$data["mcliente"]    = $this->load->view('admin/factura/modal/modal-cliente',null,true);
		$this->load->view('universal/plantilla',$data);
	}

	/**
	 * FUNCION EN COMPROBACION SI SE ESTA UTILIZANDO
	 */
	// function ajax_cliente_uuid()
	// {
	// 	if(!$this->input->is_ajax_request())
	// 	{
	// 	 show_404();
	// 	}else{
	// 		$relacionar      = $this->input->post("relacionar");
	// 		if ($relacionar == "SI") {
	// 			$data['factura']  = $this->Modelo_cliente->get_facturas();
	// 			$data['relacion'] = $this->Modelo_sat->get_tipoRelacion();				
	// 			$this->load->view('admin/factura/ajax/referencia_uuid',$data);
	// 		}
	// 	}
	// }
	/**
	 * FUNCION EN COMPROBACION SI SE ESTA UTILIZANDO
	 */
	// function ajax_agregar_relacion()
	// {
	// 	if(!$this->input->is_ajax_request())
	// 	{
	// 	 show_404();
	// 	}else{
	// 		$data = array(
	// 			'uuid'         => $this->input->post("cfdi"), 
	// 			't_relacion'   => $this->input->post("trelacion"), 
	// 			'ref_preventa' => 1
	// 		);
	// 		$this->Modelo_timbrado->put_relacion($data);
	// 		$data["uuids"] = $this->Modelo_timbrado->get_relacion();
	// 		$this->load->view('admin/factura/tabla-relacion',$data);
	// 	}
	// }

	/*function delete_uuid()
	{
		if(!$this->input->is_ajax_request())
		{
		 show_404();
		}else{
			$id_uuid = $this->input->post("uuid");
			$id      = $this->input->post("ids");

			$this->Modelo_timbrado->delete_relacion($id_uuid);
			$data["tuuid"] = $this->Modelo_timbrado->get_relacion($id);
			$this->load->view('admin/tncredito/ajax/ajax_tuuid',$data);
		}
	}*/

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
		$this->load->view('universal/plantilla',$data);
	}

	/*public function push_articulo()
	{
		$cantidad = $this->input->post("cantidad");
		$costo    = $this->input->post("costo");
		$data = array(
			'cantidad_venta'       => $cantidad,
			'alta_apreventa'       => date("Y-m-d H:i:s"),
			'importe'              => $cantidad * $costo,
			'descuento'            => 0,
			'descripcion_preventa' => $this->input->post("descripcion"),
			'ref_articulo'         => $this->input->post("codigo"),
			'ref_pre_venta'        => $this->input->post("ids")
		);
		$url      = "ajax_tarticulos";
		$peticion = $this->Modelo_articulos->put_articulo($data);
		echo json_encode($this->resultado($peticion,$url));
	}*/

	/*public function ajax_tarticulos()
	{
		if(!$this->input->is_ajax_request())
		{
		 show_404();
		}else{
			$id   = $this->input->post("ids");
			$data["tarticulos"] = $this->Modelo_articulos->get_articulo($id);
			$this->load->view('admin/tfactura/ajax/ajax_tarticulos',$data);
		}
	}*/

	/*public function get_valorUnitario()
	{
		$codigo   = $this->input->post("codigo");
		$articulo = $this->Modelo_timbrado->get_importe($codigo);
		$result = array(
			'importe' => $articulo->costo,
			'msg'     => $articulo->descripcion,
		);
		echo json_encode($result);
	}

	public function get_importe()
	{
		$cantidad = $this->input->post("cantidad");
		$costo    = $this->input->post("costo");

		$importe = $cantidad * $costo;
		$result = array(
			'importe' => $importe,
		);
		echo json_encode($result);
	}*/
	/**
	 * FIN DEL TIMBRADO 
	 */

	/*public function eliminar_articulo()
	{
		if(!$this->input->is_ajax_request())
		{
		 show_404();
		}else{
			$id = $this->input->post("articulo");
			$this->Modelo_articulos->delete_articulo($id);
			$peticion = true;
			$url      = "ajax_tarticulos";
			echo json_encode($this->resultado($peticion,$url));
		}
	}*/

	/*public function editar_articulo()
	{
		$id       = $this->input->post("articulo");
		$costo    = $this->input->post("costo");
		$cantidad = $this->input->post("cantidad");

		$importe  = $costo * $cantidad;
		$data = array(
			'cantidad_venta' => $cantidad,
			'importe'        => $importe,
		);
		$this->Modelo_timbrado->update_preventa($id,$data);

		$articulo = $this->input->post("idArticulo");
		$datos = array(
			'descripcion' => $this->input->post("descripcion")
		);
		$this->Modelo_articulos->update_articulo($articulo,$datos);

		$peticion = true;
		$url      = "ajax_tarticulos";
		echo json_encode($this->resultado($peticion,$url));
	}*/

	/*public function ajax_precios()
	{
		if(!$this->input->is_ajax_request())
		{
		 show_404();
		}else{
			$id      = $this->input->post("ids");
			$data["precios"] = $this->precios($id);
		    $this->load->view('admin/tfactura/ajax/ajax_precio',$data);
		}	
	}*/

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
