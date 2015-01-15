<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('registering');
	}

	public function index()
	{
		if ($this->session->userdata('loggedin')){
			$this->checklogin();
		} else {
			$view_data['accounts'] = $this->registering->getAllLogins();
			$this->session->set_userdata('accounts', $view_data['accounts']);
			$this->session->flashdata('tempmessage');
			$this->load->view('home', $view_data);	
		}
	}
	public function checklogin()
	{
		if ($this->input->post('action') == 'login'){
			$login['email'] = $this->input->post('email');
			$login['password'] = $this->input->post('password');
			$verify['result'] = $this->registering->verifyAccount($login);
			if (count($verify['result']) > 0){
				$this->session->set_userdata('loggedin', true);
				$this->session->set_userdata('sessionAcc', $verify['result']);
				$this->session->set_flashdata('tempmessage', "Succesfully LoggedIn");	
				redirect('/login');

			} else {
				$this->session->set_flashdata('message', "Incorrect Credentials");	
				redirect('/login');
			}
		} else {
		$this->load->view('welcome');
		}
	}
	public function register()
	{

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('first_name', 'First name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last name', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|matches[confirm_password]');
		if ($this->form_validation->run())
		{
			$register['first_name'] = $this->input->post('first_name');
			$register['last_name'] = $this->input->post('last_name');
			$register['email'] = $this->input->post('email');
			$register['password'] = $this->input->post('password');
			$register['confirm_password'] = $this->input->post('confirm_password');
			$this->registering->addRegister($register);
			$this->session->set_flashdata('goodmessage', "Succesfully Created Account");	
			redirect('/login');
		} else {
			$this->session->set_flashdata('message', "Invalid Registering Information");	
			$this->session->set_userdata('errors', validation_errors());	
			redirect('/login');
	}
}
	public function logout(){
		$this->session->sess_destroy();
        redirect("/login");   
	}
}
