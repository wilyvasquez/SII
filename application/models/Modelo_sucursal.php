<?php if ( ! defined('BASEPATH')) exit('no se permite acceso directo al scrip');

class Modelo_sucursal extends CI_Model
{	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function put_sucursal($datos)
	{
		$this->db->trans_begin();
		$this->db->insert('sucursal', $datos);
		if ($this->db->trans_status() === FALSE)
 		{
        	$msg = $this->db->trans_rollback();
        	return false;
 		}else{
 			$msg = $this->db->trans_commit();
 			return true;
 		}
	}

	function get_sucursal()
	{
		$query = $this->db->get('sucursal');
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}
}
?>