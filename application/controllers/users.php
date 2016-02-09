<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function user_profile($user_id) {
		$profile = $this->user->get_user_info($user_id);
		$this->load->view("/user_profile", array("profile" => $profile));
	}
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */