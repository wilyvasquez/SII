<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrLogin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('Form_validation');
        // $this->load->helper(array('form', 'url'));
        $this->load->model('Modelo_usuarios');
    }

    public function login()
	{
		switch ($this->session->userdata('permiso')) 
		{
			case '':
				$data['token'] = $this->token();
				$data['titulo'] = 'Escribe tus credenciales para iniciar sesion.';
				$this->load->view('login',$data);
				break;
			case 'admin':
				redirect(base_url().'home');
				break;
			case 'caja':
				redirect(base_url().'home');
				break;
			case 'refacciones':
				redirect(base_url().'home');
				break;
			default: 
				$data['titulo'] = 'Error, usuario o contraseña incorrecta.';
				$this->load->view('login',$data);
				break; 
		}		
	}

	public function verificar()
	{
		if($this->input->post('token',true) == $this->session->userdata('token',true))
		{	
			$this->form_validation->set_rules('username', 'Usuario', 'required|min_length[4]|max_length[25]|trim');
			$this->form_validation->set_rules('password', 'Password','required|min_length[4]|max_length[25]|trim');

            if ($this->form_validation->run()) 
			{		
				$username = $this->input->post('username',true);
				$password = $this->input->post('password',true);

				if(!empty($username) && !empty($password))
				{		 	
				// 	$salt = '$sautzruukmi$/';
				// 	$username = sha1(md5($salt . $username));
				// 	$password = sha1(md5($salt . $password));

					$check_user = $this->Modelo_usuarios->login_user($username,$password);
					if($check_user == TRUE)
					{
				// 		$salt = '$AtRumSuZuKi$/';
				// 		$llave = sha1(md5($salt . $password . $username));
						$data = array(
			                'is_logued_in' 	=> 		TRUE,
			                'id'		 	=> 		$check_user->id_usuario,
			                'permiso'		=>		$check_user->permiso,
			                'nombre'		=>		$check_user->nombre,
			                'sucursal' 		=> 		$check_user->sucursal,
			                'status' 		=> 		$check_user->estatus,	
		        		);		
		        		$usuario = $check_user->id_usuario;
						$this->session->set_userdata($data);
						$this->session->set_flashdata('usuario', $usuario);
						$this->login();
					}else{
						$this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos');
						redirect(base_url().'login','refresh');
					}
	   		    }else{
	         		redirect(base_url().'login','refresh');	
	   			}
			}else{
         		redirect(base_url().'login','refresh');	
         	}   	
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
		$this->login();
	}
}