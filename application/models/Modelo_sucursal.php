<?php if ( ! defined('BASEPATH')) exit('no se permite acceso directo al scrip');

class Modelo_sucursal extends CI_Model
{	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function put_sucursal($datos)
	{
		$this->db->insert('sucursal', $datos);
		if ($this->db->affected_rows() === 1) {
            return true;
        }
        else {
            return false;
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

	function update_sucursal($id,$data)
	{
		$this->db->set($data)->where("id_sucursal", $id)->update("sucursal");
		if ($this->db->trans_status() === true) {
            return true;
        } else {
            return false;
        }
	}
}
?>