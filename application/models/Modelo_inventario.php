<?php if ( ! defined('BASEPATH')) exit('no se permite acceso directo al scrip');

class Modelo_inventario extends CI_Model
{	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function put_inventario($datos)
	{
		$this->db->trans_begin();
		$this->db->insert('articulo', $datos);
		if ($this->db->trans_status() === FALSE)
 		{
        	$msg = $this->db->trans_rollback();
        	return false;
 		}else{
 			$msg = $this->db->trans_commit();
 			return true;
 		}
	}

	function get_timbrar($preventa)
	{
		$query = $this->db->query("SELECT * from pre_venta where id_preventa = $preventa");
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}


}
?>