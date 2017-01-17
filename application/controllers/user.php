<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller {

	public function index(){
		$this->load->view('index');
	}

	public function login()
	{
		$this->load->view('login');
	}

	public function signup(){
		$this->load->view('signup');
	}

	public function reset_pw(){
		$this->load->view('reset_pw');
	}

	public function restricted(){
		$this->load->view('restricted');
	}

	public function login_validation() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'required|trim|callback_validate_credentials');
		$this->form_validation->set_rules('password', 'Password', 'required|md5|trim');

		if($this->form_validation->run()) {
			$email = $this->input->post('email');
			$data = array (
				'email' => $this->input->post('email'),
				'is_logged_in' => 1
			);
			$this->session->set_userdata($data);
			redirect('user/index');
		} else {
			$this->load->view('login');
		}
	}

	public function signup_validation(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('user_name', 'User Name', 'required|trim|is_unique[user.user_name]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('cpassword', 'Comfirm Password', 'required|trim|matches[password]');

		$this->form_validation->set_message('is_unique', 'The Email/UserName you entered already existed');
		

		if($this->form_validation->run() ){
			$key = md5(uniqid());

			$config['useragent']    = 'CodeIgniter';
			$config['protocol']     = 'smtp';
			$config['smtp_host']    = 'ssl://smtp.googlemail.com';
			$config['smtp_user']    = 'ictlab.usth@gmail.com'; // Your gmail id
			$config['smtp_pass']    = 'ict12345'; // Your gmail Password
			$config['smtp_port']    = 465;
			$config['wordwrap']     = TRUE;    
			$config['wrapchars']    = 76;
			$config['mailtype']     = 'html';
			$config['charset']      = 'iso-8859-1';
			$config['validate']     = FALSE;
			$config['priority']     = 3;
			$config['newline']      = "\r\n";
			$config['crlf']         = "\r\n";


			$this->load->library('email', array('mailtype'=>'html'));
			$this->load->model('model_users');

			$this->email->initialize($config);

			$this->email->from('me@myweb.com', 'TraDa');
			$this->email->to($this->input->post('email'));
			$this->email->subject('Comfirm your account.');

			$message = "<p> Thanks you for signing up </p>";
			$message .="<p><a href='".base_url() ."user/register_user/$key' >Click here</a> to confirm your account</p>";

			$this->email->message($message);

			if ($this->model_users->add_temp_user($key)){
				if ($this->email->send()) {
					redirect('user/attention');;
				} else echo "The email cant be sent";
			} else echo "problem adding to database.";

		} else {
			$this->load->view('signup');
		}
	}

	public function validate_credentials(){
		$this->load->model('model_users');

		if ($this->model_users->can_log_in()){
			return true;
		} else {
			$this->form_validation->set_message('validate_credentials', 'Incorrect email/password.');
			return false;
		}
	}

	public function validate_email(){
		$this->load->model('model_users');

		if ($this->model_users->registered()){
			return true;
		} else {
			$this->form_validation->set_message('validate_email', 'Incorrect email, please try again.');
			return false;
		}
	}

	public function attention(){
		$this->load->view('attention');
	}

	public function register_user($key){
		$this->load->model('model_users');

		if ($this->model_users->is_key_valid($key)){
			if ($newemail = $this->model_users->add_user($key)){
				$data = array(
					'email' => $newemail,
					'is_logged_in' => 1
				);

				$this->session->set_userdata($data);
				redirect('user/login');
			} else "Failed to add user, please try again.";
		} else echo "invalid key";
	}

	public function reset_password_validation(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|callback_validate_email');

		if($this->form_validation->run()) {

			$email = $this->input->post('email');

			$this->load->helper('string');
			$new_password = random_string('alnum', 8);

			$config['useragent']    = 'CodeIgniter';
			$config['protocol']     = 'smtp';
			$config['smtp_host']    = 'ssl://smtp.googlemail.com';
			$config['smtp_user']    = 'ictlab.usth@gmail.com'; // Your gmail id
			$config['smtp_pass']    = 'ict12345'; // Your gmail Password
			$config['smtp_port']    = 465;
			$config['wordwrap']     = TRUE;    
			$config['wrapchars']    = 76;
			$config['mailtype']     = 'html';
			$config['charset']      = 'iso-8859-1';
			$config['validate']     = FALSE;
			$config['priority']     = 3;
			$config['newline']      = "\r\n";
			$config['crlf']         = "\r\n";


			$this->load->library('email', array('mailtype'=>'html'));
			$this->load->model('model_users');

			$this->email->initialize($config);

			$this->email->from('me@myweb.com', 'TraDa');
			$this->email->to($this->input->post('email'));
			$this->email->subject('Reset your password.');

			$message = "<p> Your password has been changed to</p>" .$new_password;

			$this->email->message($message);

			if ($this->model_users->reset_password($new_password, $email)){
				if ($this->email->send()) {
					redirect('user/attention');;
				} else echo "The email cant be sent";
			} else echo "problem adding to database.";
			

		} else {
			$this->load->view('reset_pw');
		}
	}
}
