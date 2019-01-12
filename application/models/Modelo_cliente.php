<?php if ( ! defined('BASEPATH')) exit('no se permite acceso directo al scrip');

class Modelo_cliente extends CI_Model
{	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function put_cliente($datos)
	{
		$this->db->trans_begin();
		$this->db->insert('cliente', $datos);
		if ($this->db->trans_status() === FALSE)
 		{
        	$msg = $this->db->trans_rollback();
        	return false;
 		}else{
 			$msg = $this->db->trans_commit();
 			return true;
 		}
	}

	function get_clientes()
	{
		$query = $this->db->get('cliente');
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function get_cliente($id)
	{
		$query = $this->db->query("SELECT * from cliente left join pre_venta on pre_venta.ref_cliente = cliente.id_cliente where cliente.id_cliente = $id");
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	function datos_cliente($id)
	{
		$query = $this->db->query("SELECT * from cliente inner join pre_venta on pre_venta.ref_cliente = cliente.id_cliente where pre_venta.id_preventa = $id");
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	function obtener_cliente($id)
	{
		$query = $this->db->query("SELECT *  FROM cliente where id_cliente = $id"); 
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	function get_facturas()
	{
		$query = $this->db->get('factura');
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function get_factura($id)
	{
		$query = $this->db->query("SELECT *  FROM factura where ref_cliente = $id"); 
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	// function get_articulo($id)
	// {
	// 	$this->db->trans_begin();
	// 	$query = $this->db->query("SELECT * from articulo_preventa 
	// 		inner join articulo on articulo.id_articulo = articulo_preventa.ref_articulo where ref_pre_venta = $id");
	// 	if ($query->num_rows() > 0) {
	// 		return $query;
	// 	}else{ 
	// 		return false;
	// 	}
	// }

	function obtener_facturas($id)
	{
		$query = $this->db->query("SELECT *  FROM producto_facturado where ref_cliente = $id"); 
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

}
?>