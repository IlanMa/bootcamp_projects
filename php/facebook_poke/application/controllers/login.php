<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('pokes');
	}

	public function index()
	{
		$view_data['accounts'] = $this->pokes->getAllLogins();
		$this->session->set_userdata('accounts', $view_data['accounts']);	
		if ($this->session->userdata('loggedin')){
			$this->checklogin();
		} else {
			$this->session->flashdata('tempmessage');
			$this->load->view('home', $view_data);	
		}
	}
	public function checklogin()
	{
		if ($this->input->post('action') == 'login'){
			$login['email'] = $this->input->post('email');
			$login['password'] = $this->input->post('password');
			$verify['result'] = $this->pokes->verifyAccount($login);
			if (count($verify['result']) > 0){
				$this->session->set_userdata('loggedin', true);
				$this->session->set_userdata('currentAcc', $verify['result']);
				$this->session->set_flashdata('tempmessage', "Succesfully LoggedIn");	
				redirect('/login');
			} else {
				$this->session->set_flashdata('message', "Incorrect Credentials");	
				$this->load->view('home');
			}
		} else {
			$this->load->view('welcome');
		}
	}
	public function register()
	{

		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('alias', 'Alias', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|matches[confirm_password]');
		$this->form_validation->set_rules('birth', 'Date of Birth', 'trim|required');
		if ($this->form_validation->run())
		{
			$register['name'] = $this->input->post('name');
			$register['alias'] = $this->input->post('alias');
			$register['email'] = $this->input->post('email');
			$register['password'] = $this->input->post('password');
			$register['confirm_password'] = $this->input->post('confirm_password');
			$register['birth'] = $this->input->post('birth');
			$this->pokes->addRegister($register);
			$this->session->set_flashdata('goodmessage', "Succesfully Created Account");	
			redirect('/login');
		} else {
			$this->session->set_flashdata('message', "Invalid Registering Information");	
			$this->session->set_flashdata('errors', validation_errors());	
			redirect('/login');
	}
}
	public function logout(){
		$this->pokes->changePokedSince($this->session->userdata('currentAcc')[0]['id']);
		$this->session->sess_destroy();
        redirect("/login");   
	}
	public function poke($id){
		$user['poked'] = $this->pokes->getPokedUser($id);
		$update['pokedID'] = ($user['poked'][0]['id']);
		$update['pokedAmount'] = $user['poked'][0]['poke'];
		$update['pokedAmount'] = $update['pokedAmount'] + 1;
		$update['pokedSince'] = $user['poked'][0]['pokedsince'];
		$update['pokedSince'] = $update['pokedSince'] + 1;
		$this->pokes->addPoke($update);
		redirect('/login');
	}
}
