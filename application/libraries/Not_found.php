<?php if ( ! defined('BASEPATH')) exit('No esta permitido el acceso'); 
//La primera línea impide el acceso directo a este script
class Not_found {

	public function __construct()
    {
        $CI =& get_instance();
        $CI->load->model('Modelo_articulos');
        $CI->load->model('Modelo_timbrado');
    }

    function not_found()
    {
        $CI =& get_instance();
        $data = array(
            "title"     => "404 Error Pagina",
            "subtitle"  => "Error",
            "contenido" => "universal/not_found",
            "menu"      => "admin/menu_admin",
            "archivosJS"=> $CI->load->view('admin/factura/archivos/archivosJS',null,true)  # ARCHIVOS JS UTILIZADOS
        );
        $CI->load->view('universal/plantilla',$data);
    }
}