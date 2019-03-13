<?php if ( ! defined('BASEPATH')) exit('no se permite acceso directo al scrip');

class Modelo_usuarios extends CI_Model
{	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function put_usuarios($datos)
	{
		$this->db->insert('usuarios', $datos);
		if ($this->db->affected_rows() === 1) {
            $id = $this->db->insert_id();
            return $id;
        }
        else {
            return false;
        }
	}

	function get_usuarios()
	{
		$query = $this->db->get('usuarios');
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function update_usuarios($id,$data)
	{
		$this->db->set($data)->where("id_usuario", $id)->update("usuarios");
		if ($this->db->trans_status() === true) {
            return true;
        } else {
            return false;
        }
	}

	function login_user($usuario,$password)
	{
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where('usuario', $usuario);
		$this->db->where('contrasena', $password);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}
}