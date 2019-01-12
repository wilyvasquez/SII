<?php if ( ! defined('BASEPATH')) exit('no se permite acceso directo al scrip');

class Modelo_timbrado extends CI_Model
{	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function put_preventa($datos)
	{
		$this->db->trans_begin();
		$this->db->insert('pre_venta', $datos);
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

	function get_timbrar($preventa)
	{
		$query = $this->db->query("SELECT * from pre_venta where id_preventa = $preventa");
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	function productos_timbrar($preventa)
	{
		$query = $this->db->query("SELECT * from pre_venta inner join articulo_preventa on articulo_preventa.ref_pre_venta = pre_venta.id_preventa inner join articulo on articulo.id_articulo = articulo_preventa.ref_articulo where pre_venta.id_preventa = $preventa");
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function get_codigo()
	{
		$query = $this->db->query("SELECT * from pre_venta ORDER BY id_preventa desc limit 1");
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	function get_importe($id)
	{
		$query = $this->db->query("SELECT * from articulo where id_articulo = $id");
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	function update_preventa($id,$data)
	{
		$this->db->where('id_apreventa', $id);
		$this->db->update('articulo_preventa',$data); 
	}

	function update_pre_venta($id,$data)
	{
		$this->db->where('id_preventa', $id);
		$this->db->update('pre_venta',$data); 
	}

	function validacion($id)
	{
		$query = $this->db->query("SELECT *  FROM pre_venta where id_preventa = $id"); 
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	function borrar_preventa($id){
		$this->db->where('id_preventa', $id);
		$this->db->delete('pre_venta'); 
	}

	function borrar_apreventa($id)
	{
		$this->db->where('ref_pre_venta', $id);
		$this->db->delete('articulo_preventa'); 
	}

	function put_relacion($datos)
	{
		$this->db->trans_begin();
		$this->db->insert('relacion_uuid', $datos);
		if ($this->db->trans_status() === FALSE)
 		{
        	$msg = $this->db->trans_rollback();
        	return false;
 		}else{
 			$msg = $this->db->trans_commit();
 			return true;
 		}
	}

	function get_relacion($id)
	{
		$query = $this->db->query("SELECT *  FROM relacion_uuid where ref_preventa = $id"); 
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function delete_relacion($id){
		$this->db->where('id_relacion', $id);
		$this->db->delete('relacion_uuid'); 
	}

	function delete_uuid($id){
		$this->db->where('ref_preventa', $id);
		$this->db->delete('relacion_uuid'); 
	}

	function put_documento($datos)
	{
		$this->db->trans_begin();
		$this->db->insert('relacion_docto', $datos);
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

	function get_relacionDocto($id)
	{
		$query = $this->db->query("SELECT *  FROM relacion_docto inner join factura on factura.uuid = relacion_docto.uuid where relacion_docto.ref_preventa = $id"); 
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function get_recibosPagos($id)
	{
		$query = $this->db->query("SELECT * FROM factura inner join factura_docto on factura_docto.ref_factura = factura.id_factura inner join documento on documento.id_docto = factura_docto.ref_docto ORDER BY documento.id_docto desc limit 1"); 
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

}
?>