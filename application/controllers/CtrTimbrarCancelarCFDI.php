<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrTimbrarCancelarCFDI extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Facturapi');
        $this->load->library('Funciones');
        $this->load->library('Not_found');
        $this->load->library('Permisos');

        $this->load->model('Modelo_cliente');
        $this->load->model('Modelo_timbrado');
        $this->load->model('Modelo_sat');

        $this->facturas = 'assets/pdf/facturas/';
        $this->permisos->redireccion();
        
        $this->load->helper('date');
        date_default_timezone_set('America/Monterrey');
    }

    public function cancelarCFDI()
    {	
		if (!empty($this->input->post("activo")))
		{
			$uuid = $this->input->post("uuid");
			$id   = $this->input->post("ids");
	    	if (!empty($uuid)) {
				try {
					$cancelar = $this->facturapi->cancelar_cfdi( $uuid );
					// echo "<pre>";
			  		//print_r($cancelar);
			  		//echo "</pre>";

					$data = array(
						'codigo'             => $cancelar->codigo, 
						'acuse'              => $cancelar->acuse, 
						'fecha'              => $cancelar->Fecha, 
						'folio'              => $cancelar->FoliosUUID, 
						'codigoEstatus'      => $cancelar->CodigoEstatus, 
						'esCancelable'       => $cancelar->EsCancelable, 
						'estado'             => $cancelar->Estado,  
						'estatusCancelacion' => $cancelar->EstatusCancelacion, 
						'ref_cfdi'           => $id, 
					);
					$peticion = $this->Modelo_timbrado->datos_CanceladoCFDI($data);
					$dato = array(
						'status_factura' => "CANCELADO" 
					);
					$this->Modelo_timbrado->up_statusFactura($id,$dato);

					$mi_acuse = base64_decode($cancelar->acuse);
					echo "<pre>";
			  		print_r($cancelar);
			  		echo "</pre>";
			  		// echo "<pre>";
			  		// print_r($mi_acuse);
			  		// echo "</pre>";

					if($peticion){
						echo '<div class="alert alert-success" role="alert">Cancelado con Exito</div>';
					}else{
						echo '<div class="alert alert-warning" role="alert">Error al Cancelar</div>';
					}
		        } catch (Exception $e) {
					echo $e->getMessage();
				}
	    	}			
		}else{
			echo '<div class="alert alert-warning" role="alert">Validar datos de envio</div>';
		}
    }
}