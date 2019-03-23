<?php if ( ! defined('BASEPATH')) exit('No esta permitido el acceso'); 

class Email {

	public function __construct()
    {
        $CI =& get_instance();
        $CI->load->model('Modelo_articulos');
        $CI->load->model('Modelo_timbrado');
    }

    function email_prueba($correo,$nombre,$uuid) 
    {
    	$this->load->helper('date');
		date_default_timezone_set('America/Monterrey');
	    $CI = & get_instance();

	    $CI->load->library('email');

        $subject         = 'Suzuki Atrum Motors de Mexico';
        $email           = $correo;
        $data['nombre']  = $nombre;
        $data['mensaje'] = "Factura Generada";
        $data['uuid']    = $uuid;
	    $msg = $CI->load->view('admin/correo/correo_factura', $data, true);

	    $CI->email
            ->from('info@suzukiatrum.com')
            ->to($email)
            ->subject($subject)
            ->message($msg)
            ->set_mailtype('html')
            ->send();
	}

}