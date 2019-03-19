<?php if ( ! defined('BASEPATH')) exit('no se permite acceso directo al scrip');

class Modelo_inventario extends CI_Model
{	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function put_inventario($datos)
	{
		$this->db->insert('articulo', $datos);
		if ($this->db->affected_rows() === 1) {
            return true;
        }
        else {
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

	function put_marca($datos)
	{
		$this->db->insert('marca', $datos);
		if ($this->db->affected_rows() === 1) {
            return true;
        }
        else {
            return false;
        }
	}

	function get_marca()
	{
		$query = $this->db->get('marca');
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function put_linea($datos)
	{
		$this->db->insert('linea', $datos);
		if ($this->db->affected_rows() === 1) {
            return true;
        }
        else {
            return false;
        }
	}

	function get_linea()
	{
		$query = $this->db->get('linea');
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function put_fabricante($datos)
	{
		$this->db->insert('fabricante', $datos);
		if ($this->db->affected_rows() === 1) {
            return true;
        }
        else {
            return false;
        }
	}

	function get_fabricante()
	{
		$query = $this->db->get('fabricante');
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function get_inventario($start,$length,$search)
	{
		$srch = "";
		if ($search) {
			$srch = "WHERE (p.articulo like '%".$search."%' OR 
							p.codigo_interno like '%".$search."%' OR 
							p.cantidad like '%".$search."%' OR 
							p.costo like '%".$search."%' OR 
							p.codigo_sat like '%".$search."%') AND
							p.ref_dfacturacion = '0'";
		}else{
			$srch = "WHERE p.ref_dfacturacion = '0'";
		}

		$qnr = "SELECT count(1) cant FROM articulo p ".$srch;
		$qnr = $this->db->query($qnr);
		$qnr = $qnr->row();
		$qnr = $qnr->cant;

		$q = "SELECT p.id_articulo, p.articulo, p.codigo_interno, p.cantidad, p.costo, p.codigo_sat, p.ref_dfacturacion 
		FROM articulo p ".$srch." limit $start, $length";
		$r = $this->db->query($q);

		$retornar = array(
			'numDataTotal' => $qnr,
			'datos' => $r, 
		);

		return $retornar;
	}

	function get_inventarios()
	{
		$this->db->select('p.id_articulo, p.articulo, p.codigo_interno, p.cantidad, p.costo, p.codigo_sat');
		$this->db->from('articulo p');

		$r = $this->db->get();

		return $r->result();
	}
}
?>