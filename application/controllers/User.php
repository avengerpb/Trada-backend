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
		$data = new stdClass();

		$data = array( 'user_name' => '', 'password' => '', 'email' => '', 'status' => '');
		$this->load->model('model_users');
		$user_name = $_POST['user_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$cpassword = $_POST['cpassword'];

		if($user_name == '' || $email == '' || $password == ''){
			$data['status'] = 'empty';
		}else{
			if($this->model_users->check_user_name_valid($user_name) == false){
				$data['user_name'] = 'inuse';
			}
			if( $email != "" && !preg_match( "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['email'] ) ) {
				$data['email'] = 'notvalid';
			}else{
				if($this->model_users->check_email_valid($email) == false){
					$data['email'] = 'inuse';
				}
			}
			if($password != $cpassword){
				$data['password'] = 'mismatch';
			}
		}


		if($data['status'] != '' || $data['user_name'] != '' || $data['email'] != '' || $data['password'] != ''){
			echo json_encode($data);
		}else{
			
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
			

			$this->email->initialize($config);

			$this->email->from('me@myweb.com', 'TraDa');
			$this->email->to($this->input->post('email'));
			$this->email->subject('Comfirm your account.');

			$message = "<p> Thanks you for signing up </p>";
			$message .="<p><a href='".base_url() ."user/register_user/$key' >Click here</a> to confirm your account</p>";

			$this->email->message($message);

			if ($this->model_users->add_temp_user($key)){
				if ($this->email->send()) {
					$data['status'] = 'ok';
					echo json_encode($data);
					/*redirect('user/attention');;*/
				} else echo "The email cant be sent";
			} else echo "problem adding to database.";
			
		}
		
	// }
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
				redirect('http://localhost/trada/');
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
				'is_logged_in' => 1,
				'user_image_url' => 'https://img.clipartfest.com/47ee79f6915758f2f4d7b33972dc8c17_blank-profile-clip-art-at-clipart-profile-pictures_600-450.png'
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

	public function profile($user_name){
		$this->load->model('model_users');
		// if($this->session->userdata('is_logged_in') == 1 && $this->session->userdata('facebook_access_token') != NULL){
		// 	$data['id'] = $this->session->userdata('id');
		// 	$data['user_name'] = $this->session->userdata('user_name');
		// 	$data['email'] = $this->session->userdata('email');
		// 	$data['link'] = $this->session->userdata('link');
		// 	$data['birthday'] = $this->session->userdata('birthday');
		// 	$data['profile_pic_link'] = $this->session->userdata('profile_pic_link');
			
		// 	$json_data['info'] = json_encode($data);

		// 	$this->load->view('profile', $json_data);
		// } else {
   		$res = $this->model_users->get_profile($user_name);
   		if($res){
   			// 	$data['is_logged_in'] = $this->session->userdata('is_logged_in');
   			// 	$data['email_user_name'] = $this->session->userdata('email/user_name');
      //   		$data['user_name'] = $res->user_name;
      //   		$data['full_name'] = $res->full_name;
      //   		$data['fb_link']   = $res->fb_link;
      //   		$data['email'] = $res->email;
      //   		$data['dob'] = $res->dob;
   				$data = json_encode($res);
        		echo $data;
   			} else {
        		echo "Fail";
    	}
    	// }
	}

	public function edit_profile($user_name){
			$this->load->view('edit_profile');

	}

	public function edit_profile_form(){
		$this->load->model('model_users');

		/*$user_name = $this->input->post('user_name');*/
		/*$user_name = $_POST['user_name'];*/

		$user_name = $this->session->userdata('user_name');

		$data = array(
			'full_name' => $_POST['full_name'],
			'dob' => $_POST['dob'],
			/*'password' => md5($this->input->post('password')),*/
			'email' => $_POST['email'],
			/*'user_image_url'=> $this->input->post('user_image_url'),*/
			'location' => $_POST['location'],
			'fb_link' => $_POST['link']
			);
		$data = array_filter($data);
		if ($this->model_users->edit_profile_data($_POST['user_name'], $data)){
			echo json_encode($data);
			/*redirect(base_url().'user/profile/'.$user_name);*/
		}
	}

	public function get_all_shop_from_user(){
		$user_id = $_POST('user_id');
		$this->load->modules('shop');
		$result = $this->shop->get_all_shop_from_user($user_id);
		echo json_decode($result);
	}

}

