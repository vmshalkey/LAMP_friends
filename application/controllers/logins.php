<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logins extends CI_Controller {

	public function index() {
		$this->load->view('/login_reg');
	}
	public function login_user() {
		if($this->login->login_user($this->input->post())){
			redirect('/dashboard');
		} else {
			redirect('/');
		}
	}
	public function register_user() {
		$this->login->register_user($this->input->post());
		redirect('/');
	}

	public function show() {
		$user = $this->login->get_user_info();
		$your_friends = $this->login->get_my_friends();
		$other_users = $this->login->get_other_users();
		$this->load->view("/dashboard", array("user" => $user, "your_friends"=> $your_friends, "other_users"=> $other_users));
	}
	public function remove_friend() {
		$this->login->remove_friend($this->input->post());
		redirect('/dashboard');
	}
	public function add_friend() {
		$this->login->add_friend($this->input->post());
		redirect('/dashboard');
	}
	public function logout_user() {
		$this->session->sess_destroy();
		redirect('/');
	}
}

/* End of file logins.php */
/* Location: ./application/controllers/logins.php */