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

	function up_statusFactura($id,$data)
	{
		// $this->db->where('id_apreventa', $id);
		// $this->db->update('articulo_preventa',$data); 
		$this->db->set($data)->where("id_factura", $id)->update("factura");
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
		$this->db->where("ref_preventa", $id)->delete("articulo_preventa");
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

	function borrar_uuidRelacion($id)
	{
		$this->db->where("ref_preventa", $id)->delete("relacion_uuid");
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

	function eliminar_relacionDocto($id)
	{
		$this->db->where("ref_preventa", $id)->delete("relacion_docto");
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
		$this->db->join('relacion_factura', 'factura.id_factura = relacion_factura.factura_hijo', 'inner');
		$this->db->where('factura.uuid', $id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	function get_facturasRelacion($uuid)
	{
		$query = $this->db->get_where('factura', array('uuid' => $uuid));
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	function get_contarComprobantesPago($id)
	{
		$query = $this->db->query("SELECT COUNT(*) as numero FROM `relacion_factura` INNER JOIN factura ON relacion_factura.factura_padre = factura.id_factura WHERE relacion_factura.factura_hijo = '$id' AND factura.tipo_comprobante = 'P' ");
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	function get_comprobantesPagoTotal($id)
	{
		$this->db->select("*")->from("relacion_factura");
		$this->db->join('factura', 'relacion_factura.factura_padre = factura.id_factura', 'inner');
		$this->db->where('relacion_factura.factura_hijo', $id);
		// $this->db->where('factura.tipo_comprobante', 'P');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function agregarRelacion($datos)
	{
		$this->db->insert('relacion_factura', $datos);
		if ($this->db->affected_rows() === 1) {
            $id = $this->db->insert_id();
            return $id;
        }else {
            return false;
        }
	}

	function search_factura($id)
	{
		$query = $this->db->get_where('factura', array('id_factura' => $id));
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	# OBTENEMOS EL FOLIO SIGUIENTE PAR AGREGARLO A LA FACTURA
	function get_ultimoFolioSerie($tipo)
	{
		// $query = $this->db->query("SELECT * FROM folios_series where tipo_comprobante = '$tipo' ORDER BY id_folios desc LIMIT 1");
		$this->db->select("*")->from("folios_series");
		$this->db->where('tipo_comprobante', $tipo);
		$this->db->order_by("id_folios desc");
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	# ACTUALIZAMOS EL FOLIO PARA LA SIGUIENTE FACTURA
	function update_serieFolio($id,$data)
	{
		$this->db->set($data)->where("id_folios", $id)->update("folios_series");
		if ($this->db->trans_status() === true) {
            return true;
        }else{
            return null;
        }
	}
	/**
	 * CONSULTAS PARA CORTE DE CAJA
	 */
	function facturasEmitidas($fecha)
	{
		$query = $this->db->query("SELECT * FROM factura 
		INNER JOIN cliente ON cliente.id_cliente = factura.ref_cliente
		WHERE factura.metodo_pago = 'PUE' AND factura.tipo_comprobante = 'I'
		AND factura.fecha_timbrado BETWEEN '$fecha 01:00:00' AND '$fecha 23:00:00'");
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}
	///////////////////////////////
	function refaccionesFacturadas($fecha)
	{
		$query = $this->db->query("SELECT * FROM factura 
		INNER JOIN articulo_facturado ON articulo_facturado.ref_factura = factura.id_factura
		INNER JOIN cliente ON cliente.id_cliente = factura.ref_cliente
		WHERE factura.metodo_pago = 'PUE' AND factura.fecha_timbrado BETWEEN '$fecha 01:00:00' AND '$fecha 23:00:00'");

		// $this->db->select("*")->from("factura");
		// $this->db->join('articulo_facturado', 'articulo_facturado.ref_factura = factura.id_factura', 'inner');
		// $this->db->join('cliente', 'cliente.id_cliente = factura.ref_cliente', 'inner');
		// $this->db->where('factura.fecha_timbrado', '2019-03-21 18:15:18');
		// $query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function facturasComprobantes($fecha)
	{
		$query = $this->db->query("SELECT * FROM factura 
		-- INNER JOIN articulo_facturado ON articulo_facturado.ref_factura = factura.id_factura
		INNER JOIN cliente ON cliente.id_cliente = factura.ref_cliente
		WHERE factura.tipo_comprobante = 'P' AND factura.fecha_timbrado BETWEEN '$fecha 01:00:00' AND '$fecha 23:00:00'");
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function get_facturasCom($id)
	{
		$this->db->select("*")->from("relacion_factura");
		$this->db->join('factura', 'relacion_factura.factura_hijo = factura.id_factura', 'inner');
		$this->db->where('relacion_factura.factura_padre', $id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function get_complementosPagos($id,$fecha)
	{
		$query = $this->db->query("SELECT * FROM relacion_factura 
		INNER JOIN factura ON relacion_factura.factura_padre = factura.id_factura
		WHERE relacion_factura.factura_hijo = $id AND factura.tipo_comprobante = 'P' AND factura.fecha_timbrado BETWEEN '$fecha 12:00:00' AND '$fecha 23:59:59'");

		// $this->db->select("*")->from("relacion_factura");
		// $this->db->join('factura', 'relacion_factura.factura_padre = factura.id_factura', 'inner');
		// $this->db->where('relacion_factura.factura_hijo', $id);
		// $this->db->where('factura.tipo_comprobante', 'P');
		// $query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function datos_CanceladoCFDI($data)
	{
		$this->db->insert('cancelar_cfdi', $data);
		if ($this->db->affected_rows() === 1) {
            $id = $this->db->insert_id();
            return $id;
        }else {
            return false;
        }
	}

	function get_acuseCancelacion($uuid)
	{
		$query = $this->db->query("SELECT * FROM cancelar_cfdi WHERE folio = '$uuid' ");

		if ($query->num_rows() > 0) {
			return true;
		}else{ 
			return false;
		}
	}
}