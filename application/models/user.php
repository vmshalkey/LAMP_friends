<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {

	public function get_user_info($user_id) {
		$query = "SELECT alias, name, email FROM users WHERE id = ?";
		$values = $user_id;
		$profile = $this->db->query($query, $values)->row_array();
		return $this->db->query($query, $values)->row_array();
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */