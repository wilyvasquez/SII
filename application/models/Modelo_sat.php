<?php if ( ! defined('BASEPATH')) exit('no se permite acceso directo al scrip');

class Modelo_sat extends CI_Model
{	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function get_formaPagos()
	{
		$query = $this->db->get('forma_pago');
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function get_claveSat()
	{
		$query = $this->db->get('clave_sat');
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function get_metodoPagos()
	{
		$query = $this->db->get('metodo_pago');
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function get_usoCfdi()
	{
		$query = $this->db->get('uso_cfdi');
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}
	
	function get_tipoRelacion()
	{
		$query = $this->db->get('tipo_relacion');
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}
}
?>