<?php

class Model_users extends CI_Model {

	public function can_log_in(){
		$this->db->where('email', $this->input->post('email'));
		$this->db->where('password', md5($this->input->post('password')));

		$query = $this->db->get('user');

		if ($query->num_rows() > 0){
			return true;
		} else {
			return false;
		}
	}

	public function registered(){
		$this->db->where('email', $this->input->post('email'));

		$query = $this->db->get('user');

		if ($query->num_rows() > 0){
			return true;
		} else {
			return false;
		}
	}

	public function add_temp_user($key){
		$data = array (
			'email' => $this->input->post('email'),
			'password' => md5($this->input->post('password')),
			'keyid' => $key

		);

		$query = $this->db->insert('temp_user', $data);
		if ($query){
			return true;
		} else {
			return false;
		}
	}

	public function is_key_valid($key){
		$this->db->where('keyid', $key);
		$query = $this->db->get('temp_user');

		if ($query->num_rows()==1){
			return true;
		} else return false;
	}

	public function add_user($key){
		$this->db->where('keyid', $key);
		$temp_user = $this->db->get('temp_user');

		if ($temp_user){
			$row = $temp_user->row();
			$data = array(
				'user_name' => $row->user_name,
				'email' => $row->email,
				'password' => $row->password
			);

			$did_add_user = $this->db->insert('user', $data);
		}

		if ($did_add_user){
			$this->db->where('keyid', $key);
			$this->db->delete('temp_user');
			return true;
		} else return false;
	}

	public function reset_password($new_password, $email){
		$this->db->where('email', $email);
		$data = array(
			'email' => $email,
			'password' => md5($new_password)
			);
		$reset = $this->db->update('users', $data);

		if ($reset){
			return true;
		} else return false;
	}
}