<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 * 
 * @extends CI_Controller
 */
class User extends CI_Controller {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->model('model_users');
		$this->load->
	}
	
	
	public function index() {
		$data['user_name'] = $this->session->userdata('user_name');
		$data['is_logged_in'] = $this->session->userdata('is_logged_in');
		$this->load->view('index', $data);		
	}

	public function reset_pw(){
		$this->load->view('reset_pw');
	}

	public function restricted(){
		$this->load->view('restricted');
	}
	
	/**
	 * signup function.
	 * 
	 * @access public
	 * @return void
	 */
	public function signup() {
		if ($this->session->userdata('admin') == 1){
		redirect("/");
		}
		else {
		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// set validation rules
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('user_name', 'User Name', 'required|trim|is_unique[user.user_name]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('cpassword', 'Comfirm Password', 'required|trim|matches[password]');

		$this->form_validation->set_message('is_unique', 'The Email/UserName you entered already existed');
		
		if ($this->form_validation->run() === false) {
			
			// validation not ok, send validation errors to the view
			$this->load->view('signup');
		} else {
			
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
			
		}
		
	}
}	

public function validate_credentials(){
		$this->load->model('model_users');
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
		if ($this->model_users->can_log_in($user_name, $password)){
			return true;
		} else {
			$this->form_validation->set_message('validate_credentials', 'Incorrect email/username/password.');
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




	/**
	 * login function.
	 * 
	 * @access public
	 * @return void
	 */

	public function login() {
		// if ($_SESSION['logged_in'] === FALSE) {
		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// set validation rules

		if ($this->validate_credentials() == false) {
			
			// validation not ok, send validation errors to the view
			$data = array();
			echo json_encode($data);
			
		} else {
			
			// set variables from the form
			// $user_name = $this->model_users->get_info($_POST['user_name']);
			$res = $this->model_users->get_profile($_POST['user_name']);
			$data = array (
				'user_name' => $res->user_name,
				'email' => $res->email,
				'full_name' => $res->full_name,
				'is_logged_in' => 1
			);

			$this->session->set_userdata($data);
			echo json_encode($data);
				// user login ok
    			}

				
		}
		
	// else {
	// 	redirect('/');
	// 	}
	// }
	
	/**
	 * logout function.
	 * 
	 * @access public
	 * @return void
	 */
	public function logout() {
		$this->session->sess_destroy();
	}

	function manage()
	{
    	$this->load->module('site_security');
    	$this->site_security->_make_sure_is_admin();
	
    	$data['flash'] = $this->session->flashdata('item');
	
    	$data['query'] = $this->get('full_name');
    	$data['view_file'] = 'manage';    
    	$this->load->module('templates');
    	$this->templates->admin($data);
	}
	
	public function profile($user_name){
		$this->load->model('model_users');
		if($this->session->userdata('is_logged_in') == 1 && $this->session->userdata('facebook_access_token') != NULL){
			$data['id'] = $this->session->userdata('id');
			$data['user_name'] = $this->session->userdata('user_name');
			$data['email'] = $this->session->userdata('email');
			$data['link'] = $this->session->userdata('link');
			$data['birthday'] = $this->session->userdata('birthday');
			$data['profile_pic_link'] = $this->session->userdata('profile_pic_link');
			
			$json_data['info'] = json_encode($data);

			$this->load->view('profile', $json_data);
		} else {
   		$res = $this->model_users->get_profile($user_name);
   		if($res){
   			// 	$data['is_logged_in'] = $this->session->userdata('is_logged_in');
   			// 	$data['email_user_name'] = $this->session->userdata('email/user_name');
      //   		$data['user_name'] = $res->user_name;
      //   		$data['full_name'] = $res->full_name;
      //   		$data['fb_link']   = $res->fb_link;
      //   		$data['email'] = $res->email;
      //   		$data['dob'] = $res->dob;
   				$data['info'] = json_encode($res);
        		$this->load->view('profile', $data);
   			} else {
        		echo "Fail";
    		}
    	}
	}

	public function edit_profile($user_name){
		if ($user_name != $this->session->userdata('email/user_name')){
			echo 'you did not logged in as this user!';
		} else {
			$this->load->view('edit_profile');
		}
	}

	public function edit_profile_form(){
		$this->load->model('model_users');
		$user_name = $this->input->post('user_name');
		$user_name = $this->session->userdata('email/user_name');
		$data = array(
			'full_name' => $this->input->post('full_name'),
			'dob' => $this->input->post('dob'),
			'password' => md5($this->input->post('password')),
			'user_image_url'=> $this->input->post('user_image_url'),
			'fb_link' => $this->input->post('fb_link')
			);
		$data = array_filter($data);
		if ($this->model_users->edit_profile_data($user_name, $data)){
			echo "Success";
			redirect(base_url().'user/profile/'.$user_name);
		} else echo "failed";
	}

}

