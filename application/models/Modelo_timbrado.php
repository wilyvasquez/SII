<?php if ( ! defined('BASEPATH')) exit('no se permite acceso directo al scrip');

class Modelo_timbrado extends CI_Model
{	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function put_preventa($datos)
	{
		$this->db->insert('pre_venta', $datos);
		if ($this->db->affected_rows() === 1) {
            $id = $this->db->insert_id();
            return $id;
        }else {
            return false;
        }
	}

	function get_timbrar($id)
	{
		$query = $this->db->get_where('pre_venta', array('id_preventa' => $id));
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	function get_productosTimbrar($id)
	{
		$this->db->select("*")->from("pre_venta");
		$this->db->join('articulo_preventa', 'articulo_preventa.ref_preventa = pre_venta.id_preventa', 'inner');
		$this->db->join('articulo', 'articulo.id_articulo = articulo_preventa.ref_articulo', 'inner');
		$this->db->where('pre_venta.id_preventa',$id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function get_facturasProceso()
	{
		$this->db->select("*")->from("pre_venta");
		$this->db->join('cliente', 'cliente.id_cliente = pre_venta.ref_cliente', 'inner');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}



	function get_codigo()
	{
		$this->db->order_by("id_preventa", "desc");
		$this->db->limit(1);
		$query = $this->db->get('pre_venta');
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	function get_importe($id)
	{
		$query = $this->db->get_where('articulo', array('id_articulo' => $id));
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	function up_articuloTimbrado($id,$data)
	{
		// $this->db->where('id_apreventa', $id);
		// $this->db->update('articulo_preventa',$data); 
		$this->db->set($data)->where("id_apreventa", $id)->update("articulo_preventa");
		if ($this->db->trans_status() === true) {
            return true;
        }else{
            return null;
        }
	}

	/*function update_pre_venta($id,$data)
	{
		$this->db->set($data)->where("id_preventa", $id)->update("pre_venta");
		if ($this->db->trans_status() === true) {
            return true;
        } else {
            return null;
        }
	}*/

	function validacion($id)
	{
		$query = $this->db->get_where('pre_venta', array('id_preventa' => $id));
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	function borrar_preventa($id)
	{
		$this->db->where("id_preventa", $id)->delete("pre_venta");
        if ($this->db->trans_status() === true) {
            return true;
        }else{
            return null;
        }
	}

	function borrar_articulosPreventa($id)
	{
		$this->db->where("ref_pre_venta", $id)->delete("articulo_preventa");
        if ($this->db->trans_status() === true) {
            return true;
        }else{
            return null;
        }
 
	}

	function put_relacion($datos)
	{
		$this->db->insert('relacion_uuid', $datos);
		if ($this->db->affected_rows() === 1) {
            return true;
        }else{
            return false;
        }
	}

	function get_relacion($id)
	{
		$query = $this->db->get_where('relacion_uuid', array('ref_preventa' => $id));
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function delete_relacion($id)
	{
		$this->db->where("id_relacion", $id)->delete("relacion_uuid");
        if ($this->db->trans_status() === true) {
            return true;
        }else{
            return null;
        }
	}

	function delete_uuid($id)
	{
		$this->db->where("ref_preventa", $id)->delete("relacion_uuid");
        if ($this->db->trans_status() === true) {
            return true;
        }else{
            return null;
        }
	}

	function delete_relacionDocto($id)
	{
		$this->db->where("id_rdocto", $id)->delete("relacion_docto");
        if ($this->db->trans_status() === true) {
            return true;
        }else{
            return null;
        }
	}

	function put_documento($datos)
	{
		$this->db->insert('relacion_docto', $datos);
		if ($this->db->affected_rows() === 1) {
            $id = $this->db->insert_id();
            return $id;
        }else{
            return false;
        }
	}

	function get_relacionDocto($id)
	{
	    $this->db->select("*")->from("relacion_docto");
		$this->db->join('factura', 'factura.uuid = relacion_docto.uuid', 'inner');
		$this->db->where('relacion_docto.ref_preventa', $id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function get_factura($id)
	{
		$query = $this->db->get_where('factura', array('uuid' => $id));
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	function get_recibosPagos($id)
	{
		$this->db->select("*")->from("factura");
		$this->db->join('factura_docto', 'factura_docto.ref_factura = factura.id_factura', 'inner');
		$this->db->join('documento', 'documento.id_docto = factura_docto.ref_docto', 'inner');
		$this->db->order_by("documento.id_docto", "desc");
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

}
?>