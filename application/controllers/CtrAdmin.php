<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrAdmin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Modelo_cliente');
		$this->load->model('Modelo_sucursal');
		$this->load->model('Modelo_articulos');
		$this->load->model('Modelo_inventario');
		$this->load->model('Modelo_timbrado');
		$this->load->model('Modelo_sat');

		$this->factura 	= 'assets/pdf/facturas/';
		$this->load->helper(array('download'));
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
		echo json_encode($this->resultado($peticion,$url));
	}

	public function ajax_sucursal()
	{
		$data['sucursales'] = $this->Modelo_sucursal->get_sucursal();
		$this->load->view('admin/sucursal/ajax/ajax_sucursal',$data);
	}

	/**
	 * FUNCIONES DEL CLIENTE
	 */

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

	/*FIN FUNCIONES CLIENTE*/

	/**
	 * FUNCION DE IMPRIMIR RESULTADO
	 */
	function resultado($peticion,$url)
	{
		if($peticion)
		{
			$result = array(
				'respuesta' => 'correcto',
				'msg'       => '<div class="alert alert-success" role="alert">Accion realizada Correctamente</div>',
				'url'		=> $url
			);
		}else{
			$result = array(
				'respuesta' => 'error',
				'msg'       => '<div class="alert alert-danger" role="alert">Error en la accion</div>',
				'url'		=> $url
			);
		}
		return $result;
	}
	/**
	 * FINFUNCION IMPRMIR RESULTADO
	 */

	public function usuarios()
	{
		$data["user"]      = "active";
		$data["title"]     = "Usuarios";
		$data["subtitle"]  = "Alta de usuarios";
		$data["contenido"] = "admin/usuarios/usuarios";
		$data["menu"]      = "admin/menu_admin";
		$this->load->view('universal/plantilla',$data);
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
		$data['clientes']    = $this->Modelo_cliente->get_clientes();
		$data['fpagos']      = $this->Modelo_sat->get_formaPagos();
		$data['mpagos']      = $this->Modelo_sat->get_metodoPagos();
		$data['ucfdis']      = $this->Modelo_sat->get_usoCfdi();

		$data["info"]        = $this->load->view('admin/factura/info-cliente',$data,true);
		$data["relacion"]    = $this->load->view('admin/factura/relacion-factura',null,true);
		$data["mcliente"]    = $this->load->view('admin/factura/modal/modal-cliente',null,true);
		$this->load->view('universal/plantilla',$data);
	}


	// function eliminar_uuid()
	// {
	// 	$id = 1;
	// 	$this->Modelo_timbrado->delete_uuid($id);
	// }

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

	function ajax_cliente_uuid()
	{
		if(!$this->input->is_ajax_request())
		{
		 show_404();
		}else{
			$relacionar      = $this->input->post("relacionar");
			if ($relacionar == "SI") {
				$data['factura']  = $this->Modelo_cliente->get_facturas();
				$data['relacion'] = $this->Modelo_sat->get_tipoRelacion();				
				$this->load->view('admin/factura/ajax/referencia_uuid',$data);
			}
		}
	}

	function ajax_agregar_relacion()
	{
		if(!$this->input->is_ajax_request())
		{
		 show_404();
		}else{
			$data = array(
				'uuid'         => $this->input->post("cfdi"), 
				't_relacion'   => $this->input->post("trelacion"), 
				'ref_preventa' => 1
			);
			$this->Modelo_timbrado->put_relacion($data);
			$data["uuids"] = $this->Modelo_timbrado->get_relacion();
			$this->load->view('admin/factura/tabla-relacion',$data);
		}
	}

	function delete_uuid()
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
				$preventa = $codigo->codigo_preventa + 1;
			}
			if ($this->input->post("metodo") == "PUE") {
				$condicion = "CONTADO";
			}

			$data = array(
				'alta_preventa'    => date("Y-m-d H:i:s"),
				'estatus_preventa' => "activo",
				'codigo_preventa'  => "001-A".$preventa,
				'condicion_pago'   => $condicion,
				'ref_cliente'      => $this->input->post("cliente"),
				'ref_formapago'    => $this->input->post("forma"),
				'ref_metodopago'   => $this->input->post("metodo"),
				'ref_usocfdi'      => $this->input->post("cfdi"),
				// 'relacion_uuid'    => $relacion
			);
			$id = $this->Modelo_timbrado->put_preventa($data);
			echo '<a href="'.base_url().'factura/'.$id.'" class="btn btn-primary btn-sm pull-left">Agregar Articulos</a>';
		}
	}

	/**
	 * FIN DE PRE FACTURA
	 */
	
	/**
	 * VISTA Y NOMBRE DE LOS DATOS PARA FACTURAR SE AGREGARAN LOS ARTICULOS A TIMBRAR
	 * @return [type] [description]
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
		$data["precios"]     = $this->precios($id);

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

	// public function timbrar_articulos()
	// {
	// 	$inicial = microtime(true);
	// 	$preventa = $this->input->post("venta");
	// 	sleep(5);
	// 	$final = microtime(true);
	// 	echo $final - $inicial;
	// }

	public function push_articulo()
	{
		$cantidad = $this->input->post("cantidad");
		$costo    = $this->input->post("costo");
		$data = array(
			'cantidad_venta' => $cantidad,
			'alta_apreventa' => date("Y-m-d H:i:s"),
			'importe'        => $cantidad * $costo,
			'descuento'      => 0,
			'descripcion_preventa'    => $this->input->post("descripcion"),
			'ref_articulo'   => $this->input->post("codigo"),
			'ref_pre_venta'  => $this->input->post("ids")
		);
		$url      = "ajax_tarticulos";
		$peticion = $this->Modelo_articulos->put_articulo($data);
		echo json_encode($this->resultado($peticion,$url));
	}

	public function ajax_tarticulos()
	{
		if(!$this->input->is_ajax_request())
		{
		 show_404();
		}else{
			$id   = $this->input->post("ids");
			$data["tarticulos"] = $this->Modelo_articulos->get_articulo($id);
			$this->load->view('admin/tfactura/ajax/ajax_tarticulos',$data);
		}
	}

	public function get_valorUnitario()
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
	}
	/**
	 * FIN DEL TIMBRADO 
	 */
	/**
	 * VISTA INVENTARIO
	 */
	public function put_inventario()
	{
		if(!$this->input->is_ajax_request())
		{
		 show_404();
		}else{
			$id_clave = $this->input->post("unidad");
			$clave    = $this->Modelo_sat->get_clave($id_clave);

			$data = array(
				'articulo'         => $this->input->post("articulo"),
				'codigo_sat'       => $this->input->post("clave"),
				'descripcion'      => $this->input->post("descripcion"),
				'costo'            => $this->input->post("costo"),
				'unidad'           => $clave->clave,
				'clave_sat'        => $clave->c_ClaveUnidad,
				'codigo_interno'   => $this->input->post("codigoi"),
				'cantidad'         => $this->input->post("cantidad"),
				'estatus_articulo' => "Activo",
				'ref_marca'        => $this->input->post("marca"),
				'ref_linea'        => $this->input->post("linea"),
				'ref_fabricante'   => $this->input->post("fabricante"),
				);
			$url = "";
			$peticion = $this->Modelo_inventario->put_inventario($data);
			echo json_encode($this->resultado($peticion,$url));
		}
	}

	public function inventario()
	{
		$data["inventario"] = "active";
		$data["title"]      = "Articulos";
		$data["subtitle"]   = "Alta de inventario";
		$data["contenido"]  = "admin/inventario/inventario";
		$data["menu"]       = "admin/menu_admin";
		$data['clave']      = $this->Modelo_sat->get_claveSat();
		$data['articulos']  = $this->Modelo_articulos->get_articulos();
		$data['marcas']     = $this->Modelo_inventario->get_marca();
		$data['lineas']     = $this->Modelo_inventario->get_linea();
		$data['fabricantes']= $this->Modelo_inventario->get_fabricante();
		$data["modal_f"]    = $this->load->view('admin/inventario/modal/modal-fabricante',null,true);
		$data["modal_l"]    = $this->load->view('admin/inventario/modal/modal-linea',null,true);
		$data["modal_m"]    = $this->load->view('admin/inventario/modal/modal-marca',null,true);
		$this->load->view('universal/plantilla',$data);
	}
	/**
	 * 
	 */

	public function eliminar_articulo()
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
	}

	public function editar_articulo()
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
	}

	public function ajax_precios()
	{
		if(!$this->input->is_ajax_request())
		{
		 show_404();
		}else{
			$id      = $this->input->post("ids");
			$data["precios"] = $this->precios($id);
		    $this->load->view('admin/tfactura/ajax/ajax_precio',$data);
		}	
	}

	function precios($id)
	{
		$importe   = 0;
		$subtotal  = 0;
		$iva       = 0;
		$total     = 0;
		$descuento = 0;

		$articulos = $this->Modelo_articulos->get_articulosVenta($id);
		if (!empty($articulos)) {
	      	foreach ($articulos ->result() as $articulo) 
	      	{
	      		$importe = $importe + $articulo->importe;
	      		$descuento = $descuento + $articulo->descuento;
	      	}
			$subtotal  = number_format($importe,2);
			$iva       = number_format($subtotal * 0.16,2);
			$total     = number_format($importe + $iva,2);
			$descuento = number_format($descuento,2);
      	}
      	 return array($subtotal,$iva,$descuento,$total);
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
