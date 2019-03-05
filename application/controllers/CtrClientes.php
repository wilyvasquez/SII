<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrClientes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Funciones');
        $this->load->library('Not_found');
        $this->load->model('Modelo_cliente');
        $this->load->model('Modelo_sucursal');
        $this->load->model('Modelo_articulos');
        $this->load->model('Modelo_inventario');
        $this->load->model('Modelo_timbrado');
        $this->load->model('Modelo_sat');
        $this->load->helper('date');
        date_default_timezone_set('America/Monterrey');
    }

    public function cliente()
	{
		$data['clientes']  = $this->Modelo_cliente->get_clientes();
		$data['ucfdis']    = $this->Modelo_sat->get_usoCfdi();
		$data = array(
			"cliente"   => "active",
			"title"     => "Cliente",
			"subtitle"  => "Alta de Cliente",
			"contenido" => "admin/cliente/cliente",
			"menu"      => "admin/menu_admin",
			"tabla"     => $this->load->view('admin/cliente/tabla-cliente',$data,true),
			"archivosJS"=> $this->load->view('admin/factura/archivos/archivosJS',null,true) # ARCHIVOS JS UTILIZADOS
		);
		$this->load->view('universal/plantilla',$data);
	}

	public function perfil_cliente($id)
	{
		$datos['icliente']  = $this->Modelo_cliente->get_cliente($id);
		$datos['ifacturas'] = $this->Modelo_cliente->obtener_facturas($id);

		$data = array(
			'cliente'   => "active",
			'title'     => "Cliente",
			'subtitle'  => "Datos del cliente", 
			'contenido' => "admin/cliente/perfil-cliente",
			'menu'      => "admin/menu_admin",
			'facturas'  => $this->load->view('admin/cliente/facturas_cliente',$datos,true),
			'ucliente'  => $this->load->view('admin/cliente/update-cliente',$datos,true),
			'archivosJS'=> $this->load->view('admin/factura/archivos/archivosJS',null,true) # ARCHIVOS JS UTILIZADOS
		);
		$this->load->view('universal/plantilla',$data);
	}

	public function agregar_cliente()
	{
		if(!$this->input->is_ajax_request())
		{
			$this->not_found->not_found();
		}else{
			if ($this->input->post("cliente") && $this->input->post("rfc") && $this->input->post("ucfdi") && $this->input->post("telefono")) 
			{
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
				if ($peticion) {
					$msg = "Exito, Cliente agregado correctamente";
					echo json_encode($this->funciones->resultado($peticion,$url,$msg));
				}
			}else{
				$msg = "Error, No se han actualizado los datos";
                echo json_encode($this->funciones->resultado($peticion = false,$url = null,$msg));
			}
		}
	}

	public function update_cliente()
	{
		if ($this->input->post("activo") == "on") 
		{
			if ($this->input->post("dcliente") && $this->input->post("rfc") && $this->input->post("telefono") && $this->input->post("id_cliente"))
			{
				$id = $this->input->post("id_cliente");
				$datos = array(
					"cliente"   => $this->input->post("dcliente"),
					"rfc"       => $this->input->post("rfc"),
					"telefono"  => $this->input->post("telefono"),
					"correo"    => $this->input->post("correo"),
					"direccion" => $this->input->post("direccion")
				);	
				$peticion = $this->Modelo_cliente->update_cliente($id,$datos);
				if ($peticion) {
					$msg = "Exito, Cliente actualizado correctamente";
					echo json_encode($this->funciones->resultado($peticion,$url = null,$msg));
				}
			}else{
				$msg = "Error, No se han actualizado los datos";
	            echo json_encode($this->funciones->resultado($peticion = false,$url = null,$msg));
			}
		}else{
			$msg = "Error, Confirmar datos de envio";
            echo json_encode($this->funciones->resultado($peticion = false,$url = null,$msg));
		}
	}

	function ajax_tcliente()
	{
		if(!$this->input->is_ajax_request())
		{
			$this->not_found->not_found();
		}else{
			$data['clientes']  = $this->Modelo_cliente->get_clientes();
			$this->load->view('admin/cliente/ajax/ajax-tcliente',$data);
		}
	}

	function ajax_scliente()
	{
		if(!$this->input->is_ajax_request())
		{
			$this->not_found->not_found();
		}else{
			$data['clientes']  = $this->Modelo_cliente->get_clientes();
			$this->load->view('admin/factura/ajax/ajax_select',$data);
		}
	}

    public function getClientes()
    {
		$start      = $this->input->post("start");
		$length     = $this->input->post("length");
		$search     = $this->input->post("search")['value'];
		
		$result     = $this->Modelo_cliente->getClientes($start,$length,$search);
		$resultado  = $result['datos'];
		$totalDatos = $result['numDataTotal'];

        $datos = array();
        foreach ($resultado->result_array() as $row) {
            $array = array();
			$array['id_cliente'] = $row['id_cliente'];
			$array['cliente']    = $row['cliente'];
			$array['rfc']        = $row['rfc'];
			$array['telefono']   = $row['telefono'];
			$array['correo']     = $row['correo'];

            $datos[] = $array;
        }

        $totalDatoObtenido = $resultado->num_rows();

        $json_data = array(
            'draw'            => intval($this->input->post('draw')), 
            'recordsTotal'    => intval($totalDatoObtenido),
            'recordsFiltered' => intval($totalDatos),
            'data'            => $datos
        );
        echo json_encode($json_data);
    }

    public function add_SerieFolios()
    {
    	if(!$this->input->is_ajax_request())
		{
			$this->not_found->not_found();
		}else{
	    	$datos = array(
				"folio_inicial"    => $this->input->post("finicial"),
				"serie"            => $this->input->post("serie"),
				"tipo_comprobante" => $this->input->post("tcomprobante"),
				"folio_siguiente"  => $this->input->post("fsiguiente")
			);

			$peticion = $this->Modelo_cliente->agregar_serieFolio($datos);
			if ($peticion) {
				$msg = "Exito, Cliente actualizado correctamente";
				echo json_encode($this->funciones->resultado($peticion,$url = null,$msg));
			}else{
				$msg = "Error, No se agrego el registro";
				echo json_encode($this->funciones->resultado($peticion = false,$url = null,$msg));
			}
		}
    }

    public function update_SerieFolios()
    {
    	if(!$this->input->is_ajax_request())
		{
			$this->not_found->not_found();
		}else{
	    	$id = $this->input->post("ids");
	    	$datos = array(
				"folio_inicial"    => $this->input->post("mfinicial"),
				"serie"            => $this->input->post("mserie"),
				"folio_siguiente"  => $this->input->post("mfsiguiente")
			);
	    	$peticion = $this->Modelo_timbrado->update_serieFolio($id, $datos);
			if ($peticion) {
				$msg = "Exito, Folio actualizado correctamente";
				echo json_encode($this->funciones->resultado($peticion,$url = null,$msg));
			}else{
				$msg = "Error, No se agrego el registro";
				echo json_encode($this->funciones->resultado($peticion = false,$url = null,$msg));
			}
		}		
    }

    public function prueba()
    {
    	$data['facturas'] = $this->Modelo_cliente->get_facturaCliente(126);
    	$this->load->view('arbol',$data);
    }
}