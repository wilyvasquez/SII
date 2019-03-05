<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrLogin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session','form_validation'));
    }

    public function login()
	{
		switch ($this->session->userdata('perfil')) 
		{
			case '':
				$data['token'] = $this->token();
				$data['titulo'] = 'Escribe tus credenciales para iniciar sesion.';
				$this->load->view('login',$data);
			break;
			case 'administrador':
				redirect(base_url().'admin');
			break;
			default: 
				$data['titulo'] = 'Error, usuario o contraseña incorrecta.';
				$this->load->view('login',$data);
			break; 
		}		
	}

	public function token()
	{
		$token = md5(uniqid(rand(),true));
		$this->session->set_userdata('token',$token);
		return $token;
	}

	public function logout_ci()
	{
		$this->session->sess_destroy();
		$this->index();
	}
}