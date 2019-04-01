<?php if ( ! defined('BASEPATH')) exit('no se permite acceso directo al scrip');

class Modelo_articulos extends CI_Model
{	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function insertarDatosTimbrado($datos)
	{
		$this->db->insert('factura', $datos);
		if ($this->db->affected_rows() === 1) {
            $id = $this->db->insert_id();
            return $id;
        }
        else {
            return false;
        }
	}

	function insertarProductoFacturado($datos)
	{
		$this->db->insert('articulo_facturado', $datos);
		if ($this->db->affected_rows() === 1) {
            return true;
        }
        else {
            return false;
        }
	}

	function get_articuloFacturado($id)
	{
		$query = $this->db->get_where('articulo_facturado', array('ref_factura' => $id));
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function get_articulo($id)
	{
		$this->db->select("*")->from("articulo_preventa");
		$this->db->join('articulo', 'articulo.id_articulo = articulo_preventa.ref_articulo', 'inner');
		$this->db->where('articulo_preventa.ref_preventa', $id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function update_articulo($id,$data)
	{
		$this->db->set($data)->where("id_articulo", $id)->update("articulo");
		if ($this->db->trans_status() === true) {
            return true;
        } else {
            return false;
        }
	}

	function get_articulosVenta($id)
	{
		$query = $this->db->get_where('articulo_preventa', array('ref_preventa' => $id));
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function delete_articulo($id)
	{
		$this->db->where("id_apreventa", $id)->delete("articulo_preventa");
        if ($this->db->trans_status() === true) {
            return true;
        }else{
            return null;
        }
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
		$this->db->insert('articulo_preventa', $datos);
		if ($this->db->affected_rows() === 1) {
            $id = $this->db->insert_id();
            return $id;
        }
        else {
            return false;
        }
	}

	function obtener_articulo($id)
	{
		$query = $this->db->get_where('articulo', array('id_articulo' => $id));
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	function get_articulosInventario()
	{
		$query = $this->db->get_where('articulo', array('ref_dfacturacion' => '0'));
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function insertarDatosFactura($datos)
	{
		$this->db->insert('datos_facturacion', $datos);
		if ($this->db->affected_rows() === 1) {
            $id = $this->db->insert_id();
            return $id;
        }
        else {
            return false;
        }	
	}

	function get_datosFacturacion($id)
	{
		$query = $this->db->get_where('datos_facturacion', array('id_dfacturacion' => $id));
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	function obtenerArticulosFactura($id)
	{
		$query = $this->db->get_where('articulo', array('ref_dfacturacion' => $id));
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function buscarArticulo($id)
	{
		$query = $this->db->get_where('articulo', array('codigo_interno' => $id));
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}
}
?>