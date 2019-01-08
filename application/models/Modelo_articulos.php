<?php if ( ! defined('BASEPATH')) exit('no se permite acceso directo al scrip');

class Modelo_articulos extends CI_Model
{	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function insert_venta($datos)
	{
		$this->db->trans_begin();
		$this->db->insert('factura', $datos);
		$id = $this->db->insert_id();
		if ($this->db->trans_status() === FALSE)
 		{
        	$msg = $this->db->trans_rollback();
        	return false;
 		}else{
 			$msg = $this->db->trans_commit();
 			return $id;
 		}
	}

	function insert_producto($datos)
	{
		$this->db->trans_begin();
		$this->db->insert('articulo_facturado', $datos);
		if ($this->db->trans_status() === FALSE)
 		{
        	$msg = $this->db->trans_rollback();
        	return false;
 		}else{
 			$msg = $this->db->trans_commit();
 			return true;
 		}
	}

	function get_articulo($id)
	{
		$query = $this->db->query("SELECT * from articulo_preventa inner join articulo on articulo.id_articulo = articulo_preventa.ref_articulo where ref_pre_venta = $id");
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function update_articulo($id,$data)
	{
		$this->db->where('id_articulo', $id);
		$this->db->update('articulo',$data); 
	}

	function get_articulosVenta($id)
	{
		$query=$this->db->query("SELECT *  FROM articulo_preventa where ref_pre_venta = $id"); 
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function delete_articulo($id)
	{
		$this->db->where('id_apreventa', $id);
		$this->db->delete('articulo_preventa'); 
	}

	function get_articulos()
	{
		$query = $this->db->get('articulo');
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function put_articulo($datos)
	{
		$this->db->trans_begin();
		$this->db->insert('articulo_preventa', $datos);
		$id = $this->db->insert_id();
		if ($this->db->trans_status() === FALSE)
 		{
        	$msg = $this->db->trans_rollback();
        	return false;
 		}else{
 			$msg = $this->db->trans_commit();
 			return $id;
 		}
	}

	function obtener_articulo($id)
	{
		$query=$this->db->query("SELECT *  FROM articulo where id_articulo = $id"); 
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}
}
?>