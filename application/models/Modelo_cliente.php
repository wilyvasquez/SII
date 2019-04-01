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

	function update_cliente($id,$data)
	{
		$this->db->set($data)->where("id_cliente", $id)->update("cliente");
		if ($this->db->trans_status() === true) {
            return true;
        } else {
            return null;
        }
	}

	function getClientes($start,$length,$search)
	{
		$srch = "";
		if ($search) {
			$srch = "WHERE (p.cliente like '%".$search."%' OR 
							p.rfc like '%".$search."%' OR 
							p.telefono like '%".$search."%' OR 
							p.correo like '%".$search."%') ";
		}


		$qnr = "SELECT count(1) cant FROM cliente p ".$srch;
		$qnr = $this->db->query($qnr);
		$qnr = $qnr->row();
		$qnr = $qnr->cant;

		$q = "SELECT p.id_cliente, p.cliente, p.rfc, p.telefono, p.correo 
		FROM cliente p ".$srch." limit $start, $length";
		$r = $this->db->query($q);

		$retornar = array(
			'numDataTotal' => $qnr,
			'datos' => $r, 
		);

		return $retornar;
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
		$query = $this->db->get_where('factura', array('tipo_comprobante' => 'I'));
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function get_doctoTipo($tipo)
	{
		$query = $this->db->get_where('factura', array('tipo_comprobante' => $tipo));
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function get_allFacturas()
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

	# CONSULTA QUE RETORNA LAS FACTURAS 'I' DE UN CLIENTE EN ESPECIFICO Y A CREDITO
	function get_facturaCliente($id)
	{
		$query = $this->db->get_where('factura', array('ref_cliente' => $id,'tipo_comprobante' => 'I', 'condicion_pago' => 'CREDITO')); 
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function obtener_facturas($id)
	{
		// $query = $this->db->get_where('factura', array('ref_cliente' => $id,'tipo_comprobante' => 'I'));
		$query = $this->db->query("SELECT * FROM `factura` WHERE ref_cliente = '$id' AND tipo_comprobante = 'I' ORDER BY id_factura DESC");
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function global_facturas()
	{
		// $query = $this->db->get_where('factura', array('ref_cliente' => $id,'tipo_comprobante' => 'I'));
		$query = $this->db->query("SELECT * FROM `factura` WHERE tipo_comprobante = 'I' ORDER BY id_factura DESC");
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function agregar_serieFolio($datos)
	{
		$this->db->insert('folios_series', $datos);
		if ($this->db->affected_rows() === 1) {
            return true;
        }
        else {
            return false;
        }
	}

	function get_serieFolio()
	{
		$query = $this->db->get('folios_series');
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

}
?>