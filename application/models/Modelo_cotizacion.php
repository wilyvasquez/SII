<?php if ( ! defined('BASEPATH')) exit('no se permite acceso directo al scrip');

class Modelo_cotizacion extends CI_Model
{	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function agregar_cotizacion($datos)
	{
		$this->db->insert('cotizacion', $datos);
		if ($this->db->affected_rows() === 1) {
            return true;
        }
        else {
            return false;
        }		
	}

	function obtener_cotizacion($id)
	{
		$query = $this->db->get_where('cotizacion', array('ref_usuario' => $id,'ref_dcotizacion' => '0'));
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function eliminarArticuloCotizacion($id)
	{
		$this->db->where("id_cotizacion", $id)->delete("cotizacion");
        if ($this->db->trans_status() === true) {
            return true;
        }else{
            return null;
        }
	}

	// function get_cotizacion($id)
	// {
	// 	$query = $this->db->get_where('cotizacion', array('ref_usuario' => $id,'ref_dcotizacion' => '0'));
	// 	if ($query->num_rows() > 0) {
	// 		return $query;
	// 	}else{ 
	// 		return false;
	// 	}
	// }

	function get_numCotizacion()
	{
		$query = $this->db->query("SELECT * FROM datos_cotizacion ORDER BY id_dcotizacion desc LIMIT 1");	
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	function agregar_dcotizacion($datos)
	{
		$this->db->insert('datos_cotizacion', $datos);
		if ($this->db->affected_rows() === 1) {
			 $id = $this->db->insert_id();
            return $id;
        }
        else {
            return false;
        }
	}

	function update_dcotizacion($data,$id)
	{
		$this->db->set($data)->where("id_cotizacion", $id)->update("cotizacion");
		if ($this->db->trans_status() === true) {
            return true;
        } else {
            return false;
        }
	}

	function obtener_cotizaciones()
	{
		$query = $this->db->get('datos_cotizacion');
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function obtener_datosCotizacion($id)
	{
		$query = $this->db->get_where('datos_cotizacion', array('id_dcotizacion' => $id));
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	function obtener_articulosCotizacion($id)
	{
		$query = $this->db->get_where('cotizacion', array('ref_dcotizacion' => $id));
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function eliminarCotizacion($id)
	{
		$this->db->where("id_dcotizacion", $id)->delete("datos_cotizacion");
        if ($this->db->trans_status() === true) {
            return true;
        }else{
            return null;
        }
	}
}