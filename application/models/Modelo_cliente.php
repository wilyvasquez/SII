<?php if ( ! defined('BASEPATH')) exit('no se permite acceso directo al scrip');

class Modelo_cliente extends CI_Model
{	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function put_cliente($datos)
	{
		$this->db->insert('cliente', $datos);
		if ($this->db->affected_rows() === 1) {
            return true;
        }
        else {
            return false;
        }
	}

	function get_clientes()
	{
		$this->db->order_by("id_cliente", "desc");
		$query = $this->db->get('cliente');
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function get_cliente($id)
	{
		$this->db->select("*")->from("cliente");
		$this->db->join('pre_venta', 'pre_venta.ref_cliente = cliente.id_cliente', 'left');
		$this->db->where('cliente.id_cliente', $id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	function datos_cliente($id)
	{
		$this->db->select("*")->from("cliente");
		$this->db->join('pre_venta', 'pre_venta.ref_cliente = cliente.id_cliente', 'inner');
		$this->db->where('pre_venta.id_preventa', $id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	function obtener_cliente($id)
	{ 
		$query = $this->db->get_where('cliente', array('id_cliente' => $id));
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
		$query = $this->db->get_where('factura', array('ref_cliente' => $id)); 
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function obtener_facturas($id)
	{
		$query = $this->db->get_where('factura', array('ref_cliente' => $id));
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

}
?>