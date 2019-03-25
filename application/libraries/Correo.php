<?php if ( ! defined('BASEPATH')) exit('No esta permitido el acceso'); 

class Correo {

	public function __construct()
    {
        $CI =& get_instance();
        // $CI->load->model('Modelo_articulos');
        // $CI->load->model('Modelo_timbrado');
    }

    public function correo_factura($correo,$nombre,$uuid) 
    {
        $CI = & get_instance();
        $CI->load->helper('date');
        date_default_timezone_set('America/Monterrey');
        $CI->load->helper('url');
        $CI->load->library('session');
        $CI->config->item('base_url');

        $CI->load->library('email');

        $subject        = 'Atrum Motors de Mexico SA de CV';
        $email          = $correo;
        $data['nombre'] = $nombre;
        $data['uuid']   = $uuid;
        $msg = $CI->load->view('admin/correo/correo_factura', $data, true);

        $CI->email->from('info@suzukiatrum.com', 'FACTURACION - ATRUM MOTORS DE MEXICO SA DE CV');
        $CI->email->to($correo);
        // $CI->email->cc('sistemas@suzukiatrum.com');
        $CI->email->subject($subject);
        $CI->email->message($msg);
        $CI->email->set_mailtype("html");
        $CI->email->send();
    }

}