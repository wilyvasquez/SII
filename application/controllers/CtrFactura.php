<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrFactura extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('Funciones');
		$this->load->library('Permisos');
		$this->load->library('Not_found');
		$this->load->library('session');

		$this->load->model('Modelo_cliente');
		$this->load->model('Modelo_articulos');
		$this->load->model('Modelo_timbrado');
		$this->load->model('Modelo_cotizacion');		
		$this->load->model('Modelo_sat');
		$this->permisos->redireccion();

		$this->factura 	= 'assets/pdf/facturas/';
		$this->load->helper(array('download'));
		
		$this->load->helper('date');
		date_default_timezone_set('America/Monterrey');
	}
	
	public function folios()
	{
		$pmenu = $this->permisos->menu();
		$datos["serieFolio"] = $this->Modelo_cliente->get_serieFolio();
		$data = array(
			"folios"      => "active",
			"title"       => "Folios y Series",
			"subtitle"    => "Alta de folios",
			"contenido"   => "admin/folios/folios_series",
			"menu"        => $pmenu,
			"tabla"       => $this->load->view('admin/folios/tabla-folios',$datos,true),
			"archivosJS"  => $this->load->view('admin/factura/archivos/archivosJS',null,true),  # ARCHIVOS JS UTILIZADOS
			"mSerieFolio" => $this->load->view('admin/folios/modal/modal_serieFolio',null,true)  # MODAL ACTUALIZAR SERIE FOLIO
		);
		$this->load->view('universal/plantilla',$data);
	}

	# VISTAS PRE FACTURA
	public function pre_factura()
	{		
		$pmenu = $this->permisos->menu();
		# OBTENEMOS EL USO DEL CFDI SAT
		$cfdi = array(
			'ucfdis' => $this->Modelo_sat->get_usoCfdi()
		);
		$data = array(
			'title'      => 'Factura',
			'timbrado'   => 'active',
			'factura'    => 'active',
			'subtitle'   => 'Crear Factura',
			'contenido'  => 'admin/factura/factura', 
			'menu'       => $pmenu, # MENU DE AMDIN
			'mcliente'   => $this->load->view('admin/factura/modal/modal-cliente',$cfdi,true), # MODAL CLIENTE REGISTRO PRE FACTURA
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
		$data["info"]     = $this->load->view('admin/factura/info-cliente',$datos,true);
		$data["dcliente"] = $this->load->view('admin/factura/datos_cliente',$datos,true);
		# PLANTILLA DE LAS VISTAS
		$this->load->view('universal/plantilla',$data);
	}

	public function facturas_proceso()
	{
		$pmenu = $this->permisos->menu();
		$data = array(
			'title'      => 'Factura',
			'proceso'    => 'active',
			'subtitle'   => 'Facturas en proceso',
			'contenido'  => 'admin/factura/proceso/facturas_proceso', 
			'menu'       => $pmenu, # MENU DE AMDIN
			'archivosJS' => $this->load->view('admin/factura/archivos/archivosJS',null,true),  # ARCHIVOS JS UTILIZADOS
			'prefactura' => $this->Modelo_timbrado->get_facturasProceso()
		);
		# PLANTILLA DE LAS VISTAS
		$this->load->view('universal/plantilla',$data);
	}

	public function info_procesoFacturas($id)
	{
		$pmenu = $this->permisos->menu();
		$data["permiso"]	 = $this->funciones->permisos();
		$data = array(
			'title'      => 'Factura',
			'proceso'    => 'active',
			'subtitle'   => 'Factura en proceso',
			'contenido'  => 'admin/factura/proceso/proceso', 
			'menu'       => $pmenu, # MENU DE AMDIN
			'archivosJS' => $this->load->view('admin/tfactura/archivos/archivosJS',null,true),  # ARCHIVOS JS UTILIZADOS
			'prefactura' => $this->Modelo_timbrado->get_facturasProceso(),
			'tarticulos' => $this->Modelo_articulos->get_articulo($id),
			'marticulo'  => $this->load->view('admin/tfactura/modal/modal-editar-articulo',$data,true) # MODALES
		);
		$data["id"]         = $id;
		$data['icliente']   = $this->Modelo_cliente->datos_cliente($id);
		$data["nombre"]     = $data['icliente']->cliente;
		$data["idCliente"]  = $data['icliente']->id_cliente;
		$data["opciones"]   = $this->load->view('admin/tfactura/menu_opciones',$data,true);
		# INFORMACION DEL CLIENTE
		$data["info"]       = $this->load->view('admin/factura/proceso/datos_proceso',$data,true);
		# TABLA DE LOS ARTICULOS A TIMBRAR
		$data["tarticulos"] = $this->load->view('admin/tfactura/tabla-articulos',$data,true);
		# PLANTILLA DE LAS VISTAS
		$this->load->view('universal/plantilla',$data);
	}

	public function push_prefactura()
	{
		if(!$this->input->is_ajax_request())
		{
			$this->not_found->not_found();
		}else{
			if ($this->input->post("forma") && $this->input->post("metodo") && $this->input->post("cfdi") && $this->input->post("cliente")) 
			{
				$preventa  = 1;
				$condicion = "CREDITO";
				$codigo    = $this->Modelo_timbrado->get_codigo(); # OBTENER EL ULTIMO CODIGO DE PREVENTA
				# CONDICION SOBRE SI YA EXISTE ALGUN REGISTRO (COMPROBAR SI ESTA BIEN, CREO HAY ERROR)
				if (!empty($codigo)) {
					$preventa = $codigo->id_preventa + 1; # AGREGAMOS UN UNO AL ULTIMO CODIGO
				}
				if ($this->input->post("metodo") == "PUE") { # VALIDAMOS EL TIPO DE METODO ENVIADO
					$condicion = "CONTADO";
				}
				# ARREGLO DE DATOS PARA GUARDAR
				$data = array(
					'alta_preventa'    => date("Y-m-d H:i:s"),
					'codigo_preventa'  => "001-A0000".$preventa,
					'condicion_pago'   => $condicion,
					'forma_pago'       => $this->input->post("forma"),
					'metodo_pago'      => $this->input->post("metodo"),
					'uso_cfdi'         => $this->input->post("cfdi"),
					'ref_cliente'      => $this->input->post("cliente"),
				);
				$id = $this->Modelo_timbrado->put_preventa($data); # GUADAR DATOS DE PRE NOTA DE CREDITO
				if($id){
	                echo '<a href="'.base_url().'factura/'.$id.'" class="btn btn-primary btn-sm pull-left">Agregar Articulos</a>'; 
	            }else{
	                echo '<div class="alert alert-danger" role="alert">Error, al subir datos, contactar a sistemas.</div>'; # MOSTRAR VISTA ERROR
	            }
			}else{
				echo '<div class="alert alert-danger" role="alert">Error, al generar la factura.</div>'; # MOSTRAR VISTA ERROR
			}
		}
	}
	/**
	 * VISTA Y NOMBRE DE LOS DATOS PARA FACTURAR SE AGREGARAN LOS ARTICULOS A TIMBRAR
	 */
	public function factura($id)
	{
		$this->funciones->validacion_timbrado($id,$tipo = "prefactura");
		# CONSULTA OBTENER ARTICULOS A FACTURAR
		$data['articulos']   = $this->Modelo_articulos->get_articulos();
		$data['tarticulos']  = $this->Modelo_articulos->get_articulo($id);

		# CONSULTA FACTURAS Y TIPOS DE RELACION PARA VINCULAR
        $data['facturas']    = $this->Modelo_cliente->get_facturas();
        $data['trelacion']   = $this->Modelo_sat->get_tipoRelacion();

        # CONSULTA PRA OBTENER LOS UUID VINCULADOS
        $data['tuuid']       = $this->Modelo_timbrado->get_relacion($id);

        # CONSULTA PARA VER LAS COTIZACIONES PARA CAJA
        $data['cotizacion']  = $this->Modelo_cotizacion->obtener_cotizaciones();

        # CONSULTA OBTENER DATOS DEL CLIENTE
		$data["id"]          = $id;
		$data['icliente']    = $this->Modelo_cliente->datos_cliente($id);
		$data["nombre"]      = $data['icliente']->cliente;
		$data["idCliente"]   = $data['icliente']->id_cliente;
		$data["precios"]     = $this->funciones->precios($id);
		$data["opciones"]    = $this->load->view('admin/tfactura/menu_opciones',$data,true);
		$data["permiso"]	 = $this->funciones->permisos();
		$pmenu				 = $this->permisos->menu();

		$data = array(
			'timbrado'    => "active",
			'factura'     => "active",
			'title'       => "Factura",
			'subtitle'    => "Timbrar Factura",
			'contenido'   => "admin/tfactura/tfactura",
			'menu'        => $pmenu,
			'articulo'    => $this->load->view('admin/tfactura/agregar-articulo',$data,true), # VISTA DE AGREGAR ARTICULO
			'tarticulos'  => $this->load->view('admin/tfactura/tabla-articulos',$data,true),  # VISTA TABLA ARTICULOS
			'precios'     => $this->load->view('admin/tfactura/precios',$data,true),		  # VISTA TABLA DE PRECIOS
			'tuuid'       => $this->load->view('admin/tncredito/tabla_uuid',$data,true),	  # VISTA TABLA DE UUID
			'marticulo'   => $this->load->view('admin/tfactura/modal/modal-editar-articulo',null,true),   # VISTA MODAL EDITAR ARTICULO
			'mearticulo'  => $this->load->view('admin/tfactura/modal/modal-eliminar-articulo',null,true), # VISTA MODAL ELIMAR ARTICULO
			'meuuid'      => $this->load->view('admin/tncredito/modal/modal-eliminar-uuid',$data,true),   # VISTA MODAL ELIMAR UUID
        	'mtimbrar'    => $this->load->view('admin/tncredito/modal/modal-timbrar',null,true), 		  # VISTA MODAL AGREGAR UUID
        	'cotizacion'  => $this->load->view('admin/tfactura/modal/modal_agregar_cotizacion',null,true) 		  # VISTA MODAL AGREGAR UUID
		);       		
		# ARCHIVOS JS
        $data["archivosJS"]  = $this->load->view('admin/tfactura/archivos/archivosJS',null,true);
		$this->load->view('universal/plantilla',$data);
	}
	/**
	 * DESCARGAR ARCHIVO
	 */
	public function descarga($name)
	{  
		$exists = file_exists( $this->factura.$name );
		if ($exists) {
	       	$mi_pdf = fopen ($this->factura.$name, "r");
	        if (!$mi_pdf) {
	            echo "<p>No puedo abrir el archivo para lectura</p>";
	            exit;
	        }else{
		        header('Content-type: application/pdf');
		        fpassthru($mi_pdf); // Esto hace la magia
		        fclose ($mi_pdf);              	
	        }
		}else{
			// $this->not_found->not_found();
			echo '<div style="text-align:center;padding:50px;background-color: #F19C9C;">Error, Factura (PDF) no encontrado</div>';
		}
	}

	public function descargas_xml($name)
   	{   		
   		$exists = file_exists( $this->factura.$name );
   		if ($exists) {
	       	$data = file_get_contents($this->factura.$name); 
	       	force_download($name,$data);      
       	}else{
	        echo '<div style="text-align:center;padding:50px;background-color: #F19C9C;">Error, XML no encontrado</div>';            	
        }
	}
}
