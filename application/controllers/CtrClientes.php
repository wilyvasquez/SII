<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrClientes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Funciones');
        $this->load->library('Not_found');
        $this->load->library('Permisos');

        $this->load->model('Modelo_cliente');
        $this->load->model('Modelo_timbrado');
        $this->load->model('Modelo_sat');
        // $this->permisos->redireccion();
        
        $this->load->helper('date');
        date_default_timezone_set('America/Monterrey');
    }

    public function cliente()
	{
		$pmenu = $this->permisos->menu();
		$data['clientes']  = $this->Modelo_cliente->get_clientes();
		$data['ucfdis']    = $this->Modelo_sat->get_usoCfdi();
		$data = array(
			"cliente"   => "active",
			"title"     => "Cliente",
			"subtitle"  => "Alta de Cliente",
			"contenido" => "admin/cliente/cliente",
			"menu"      => $pmenu,
			"tabla"     => $this->load->view('admin/cliente/tabla-cliente',$data,true),
			"archivosJS"=> $this->load->view('admin/factura/archivos/archivosJS',null,true) # ARCHIVOS JS UTILIZADOS
		);
		$this->load->view('universal/plantilla',$data);
	}

	public function perfil_cliente($id)
	{
		$pmenu = $this->permisos->menu();
		$datos['icliente']  = $this->Modelo_cliente->get_cliente($id);
		$datos['ifacturas'] = $this->Modelo_cliente->obtener_facturas($id);

		$data = array(
			'cliente'   => "active",
			'title'     => "Cliente",
			'subtitle'  => "Datos del cliente", 
			'contenido' => "admin/cliente/perfil-cliente", 
			'menu'      => $pmenu,
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
					"cliente"      => $this->input->post("cliente"),
					"rfc"          => $this->input->post("rfc"),
					"uso_cfdi"     => $this->input->post("ucfdi"),
					"telefono"     => $this->input->post("telefono"),
					"correo"       => $this->input->post("correo"),
					"direccion"    => $this->input->post("direccion"),
					"alta_cliente" => date("Y-m-d H:i:s")
				);
				if ($ref == 1) 
				{
					$url = "";
				}else{ 
					$url = 'ajax_scliente'; 
				}
				$peticion = $this->Modelo_cliente->put_cliente($datos);
				if ($peticion) {
					$msg = "Exito, Cliente agregado correctamente";
					echo json_encode($this->funciones->resultado($peticion, $url, $msg, null));
				}
			}else{
				$msg = "Error, No se han actualizado los datos";
                echo json_encode($this->funciones->resultado($peticion = false, $url = null, $msg, null));
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
					echo json_encode($this->funciones->resultado($peticion, $url = null, $msg, null));
				}
			}else{
				$msg = "Error, No se han actualizado los datos";
	            echo json_encode($this->funciones->resultado($peticion = false, $url = null, $msg, null));
			}
		}else{
			$msg = "Error, Confirmar datos de envio";
            echo json_encode($this->funciones->resultado($peticion = false, $url = null, $msg, null));
		}
	}

	# AJAX TABLA DE CLIENTES FUE DESHABILITADA AUN EN PRUEBA
	// function ajax_tcliente()
	// {
	// 	if(!$this->input->is_ajax_request())
	// 	{
	// 		$this->not_found->not_found();
	// 	}else{
	// 		$data['clientes']  = $this->Modelo_cliente->get_clientes();
	// 		$this->load->view('admin/cliente/ajax/ajax-tcliente',$data);
	// 	}
	// }

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
			// $this->not_found->not_found();
		}else{
			if ($this->input->post("finicial") && $this->input->post("serie") && $this->input->post("tcomprobante") && $this->input->post("fsiguiente")) 
			{
		    	$datos = array(
					"folio_inicial"    => $this->input->post("finicial"),
					"serie"            => $this->input->post("serie"),
					"tipo_comprobante" => $this->input->post("tcomprobante"),
					"folio_siguiente"  => $this->input->post("fsiguiente")
				);

				$peticion = $this->Modelo_cliente->agregar_serieFolio($datos);
				if ($peticion) {
					$msg = "Exito, Cliente actualizado correctamente";
					echo json_encode($this->funciones->resultado($peticion, $url = null, $msg, null));
				}else{
					$msg = "Error, No se agrego el registro";
					echo json_encode($this->funciones->resultado($peticion = false, $url = null, $msg, null));
				}
			}else{
				$msg = "Error, No se agrego el registro";
				echo json_encode($this->funciones->resultado($peticion = false, $url = null, $msg, null));
			}
		}
    }

    public function update_SerieFolios()
    {
    	if(!$this->input->is_ajax_request())
		{
			// $this->not_found->not_found();
		}else{
			if ($this->input->post("ids") && $this->input->post("mfinicial") && $this->input->post("mserie") && $this->input->post("mfsiguiente")) 
			{
		    	$id = $this->input->post("ids");
		    	$datos = array(
					"folio_inicial"    => $this->input->post("mfinicial"),
					"serie"            => $this->input->post("mserie"),
					"folio_siguiente"  => $this->input->post("mfsiguiente")
				);
		    	$peticion = $this->Modelo_timbrado->update_serieFolio($id, $datos);
				if ($peticion) {
					$msg = "Exito, Folio actualizado correctamente";
					echo json_encode($this->funciones->resultado($peticion, $url = null, $msg, null));
				}else{
					$msg = "Error, No se agrego el registro";
					echo json_encode($this->funciones->resultado($peticion = false, $url = null, $msg, null));
				}
			}else{
				$msg = "Error, No se agrego el registro";
				echo json_encode($this->funciones->resultado($peticion = false, $url = null, $msg, null));
			}
		}		
    }
}