<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Model {

	public function login_user($post) {
		// find user in db
		// VALIDATION
		$this->form_validation->set_rules("email", "Email Address", "trim|required|valid_email");
		$this->form_validation->set_rules("password", "Password", "trim|required");
		// END VALIDATION RULES
		if($this->form_validation->run() === FALSE) {
		     $this->session->set_flashdata("errors", validation_errors());
		     return FALSE;
		} else {
			$query = "SELECT * FROM users WHERE email = ? AND password = ?";
			$values = array($post['email'], $post['password']);
			$user = $this->db->query($query, $values)->row_array();
			if(empty($user)) {
				$this->session->set_flashdata("errors", "The email or password you entered is invalid.");
				return FALSE;
			} else {
				$this->session->set_userdata('id', $user['id']);
				return TRUE;
			}
		}
	}
	public function register_user($post) {
		// add user to db
		// VALIDATION
		$this->form_validation->set_rules("name", "Name", "trim|required|min_length[1]");
		$this->form_validation->set_rules("alias", "Alias", "trim|required|alpha|min_length[3]");
		$this->form_validation->set_rules("email", "Email Address", "trim|required|valid_email|is_unique[users.email]");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");
		$this->form_validation->set_rules("confirm_password", "Confirm Password", "trim|required|matches[password]");
		$this->form_validation->set_rules("birthdate", "Date of Birth", "trim|required");
		// END VALIDATION RULES
		if($this->form_validation->run() === FALSE) {
		     $this->session->set_flashdata("errors", validation_errors());
		} else {
			$query = "INSERT INTO users (name, alias, email, password, birthdate, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
			$values = array($post['name'], $post['alias'], $post['email'], $post['password'], $post['birthdate']);
			$this->db->query($query, $values);
		}
	}
	public function get_user_info() {
		$query = "SELECT alias FROM users WHERE id = ?";
		$values = $this->session->userdata('id');
		$user = $this->db->query($query, $values)->row_array();
		return $this->db->query($query, $values)->row_array();
	}
	public function get_my_friends() {
		$query = "SELECT friends.friended_id, users.alias FROM friends
					JOIN users ON friends.friended_id = users.id
					WHERE friender_id = ?";
		$values = $this->session->userdata('id');
		$your_friends = $this->db->query($query, $values)->result_array();
		return $this->db->query($query, $values)->result_array();
	}
	public function get_other_users() {
		$query = "SELECT users.id, users.alias FROM users
					WHERE users.id
					NOT IN (SELECT friended_id FROM friends WHERE friends.friender_id = ?)
					AND users.id <> ?";
		$values = array($this->session->userdata('id'), $this->session->userdata('id'));
		$other_users = $this->db->query($query, $values)->result_array();
		return $this->db->query($query, $values)->result_array();
	}
	public function remove_friend($post) {
		$query = "DELETE FROM friends WHERE friender_id = ? AND friended_id = ?";
		$values = array($this->session->userdata('id'), $post['friended_id']);
		$this->db->query($query, $values);

		$query2 = "DELETE FROM friends WHERE friender_id = ? AND friended_id = ?";
		$values2 = array($post['friended_id'], $this->session->userdata('id'));
		$this->db->query($query2, $values2);
	}
	public function add_friend($post) {
		$query = "INSERT INTO friends (friender_id, friended_id, created_at, updated_at)
					VALUES (?, ?, now(), now())";
		$values = array($this->session->userdata('id'), $post['friended_id']);
		$this->db->query($query, $values);

		$query2 = "INSERT INTO friends (friender_id, friended_id, created_at, updated_at)
					VALUES (?, ?, now(), now())";
		$values2 = array($post['friended_id'], $this->session->userdata('id'));
		$this->db->query($query2, $values2);
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */