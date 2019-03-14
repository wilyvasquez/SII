<?php if ( ! defined('BASEPATH')) exit('No esta permitido el acceso'); 

class Permisos {

	public function __construct()
    {
        $CI =& get_instance();
        $CI->load->model('Modelo_articulos');
        $CI->load->model('Modelo_timbrado');
    }

    function menu()
    {
        $CI =& get_instance();
        $permiso = $CI->session->userdata('permiso');
        if ($permiso == "caja") {
        	$pmenu = "admin/menu/menu_caja";
        }
        if ($permiso == "admin") {
        	$pmenu = "admin/menu_admin";
        }
        else if ($permiso == "refacciones") {
            $pmenu = "admin/menu/menu_refacc";
        }
        
        return $pmenu;
    }

    function redireccion()
    {
        $CI =& get_instance();
        $permiso = $CI->session->userdata('permiso');
        if($permiso == FALSE || ( $permiso != "admin" && $permiso != 'caja' && $permiso != 'refacciones') )
        {
            redirect(base_url().'login');
        }
    }
}