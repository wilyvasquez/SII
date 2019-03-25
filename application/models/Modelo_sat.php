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

	function get_clave($id)
	{
		$query = $this->db->get_where('clave_sat', array('id_clave' => $id)); 
		if ($query->num_rows() > 0) {
			return $query->row();
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

	function get_metodoPagosRP()
	{
		// $query = $this->db->get('metodo_pago');
		$query = $this->db->get_where('metodo_pago', array('c_metodoPago' => 'PUE')); 
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