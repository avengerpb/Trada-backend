<?php

class Model_users extends CI_Model {

	public function can_log_in($user_name, $password){
		$this->db->where('email', $user_name);
		$this->db->where('password', md5($password));

		$query = $this->db->get('user');

		if ($query->num_rows() > 0){
			return true;
		} else {
			$this->db->where('user_name', $user_name);
			$this->db->where('password', md5($password));

			$query = $this->db->get('user');

			if ($query->num_rows() > 0){
				return true;
			} else {
				return false;
			}
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

	public function get_info($temp){
		$query= $this->db->query('select * From user where email = "'.$temp.'";');
			if ($query){
				return $query->row()->user_name;
			} else {
				return $temp;
			}
	}

	public function add_temp_user($key){
		$data = array (
			'email' => $_POST['email'],
			'password' => md5($_POST['password']),
			'user_name' =>  $_POST['user_name'],
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
				'full_name' => $row->user_name,
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

	public function add_fb_user($user_name, $data){
		$this->db->where('user_name', $user_name);
		$exist = $this->db->get('user');
		if($exist->num_rows()==0){
			$query = $this->db->insert('user', $data);
			if ($query){
				return true;
			} else {
				return false;
			}
		}
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

	public function check_email_or_username($user_name){
		$this->db->where('email', $user_name);
		$query = $this->db->get('user');
		if ($query->num_rows() > 0){
			return 'email';
		} else {
			$this->db->where('user_name', $user_name);
			$query = $this->db->get('user');
			if ($query->num_rows() > 0){       
    			return 'user_name';
			} else {
				return NULL;
			}
		}
	}

	public function get_profile($user_name){
		$type = $this->model_users->check_email_or_username($user_name);
		$this->db->where($type, $user_name);
		$query = $this->db->get('user');
		if ($query->num_rows() > 0){
			$res   = $query->row();        
    		return $res;
		} else {
				return NULL;
		}
	}

	public function edit_profile_data($user_name, $data){
		$type = $this->model_users->check_email_or_username($user_name);
		$this->db->where($type, $user_name);
		$query = $this->db->get('user');
		if ($query->num_rows() > 0){
			$this->db->where('email', $_POST['email']);
			$query1 = $this->db->update('user', $data);      
    		if ($query1){
    			return true;
    		} else return false;
		}
		else{
			$this->db->insert('user', $data);
		}
	}

}