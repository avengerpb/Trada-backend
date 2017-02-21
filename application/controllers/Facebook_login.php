<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once __DIR__ . '\php-graph-sdk-5.4\src\Facebook\autoload.php';

class Facebook_login extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->model('model_users');
	
	}

	public function fb_login(){
		
		$fb = new Facebook\Facebook([
  			'app_id' => '1175112432606251',
  			'app_secret' => 'f26d7b0706b3c2f1a87fe30f0be28f17',
  			'default_graph_version' => 'v2.5',
		]);

		$helper = $fb->getRedirectLoginHelper();
		$permissions = ['public_profile', 'user_friends', 'publish_actions', 'email', 'user_about_me', 'user_birthday']; // optional
		$data['login_url'] = $helper->getLoginUrl('http://localhost/trada-backend/index.php/facebook_login/fb_callback', $permissions);
		// $data = json_encode($data['login_url']);
		/*$this->load->view('home',$data);*/
		echo json_encode($data);
		// echo $data;
	}


	public function fb_callback(){
		$fb = new Facebook\Facebook([
			'app_id' => '1175112432606251',
  			'app_secret' => 'f26d7b0706b3c2f1a87fe30f0be28f17',
  			'default_graph_version' => 'v2.5',
  		]);

		$helper = $fb->getRedirectLoginHelper();
		try {
  			$accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
  			// When Graph returns an error
  			echo 'Graph returned an error: ' . $e->getMessage();
  			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
  			// When validation fails or other local issues
  			echo 'Facebook SDK returned an error: ' . $e->getMessage();
  			exit;
			}

		if (isset($accessToken)) {
  			// Logged in!
  			$_SESSION['facebook_access_token'] = (string) $accessToken;
  			$session = $_SESSION['facebook_access_token'];

  			$fbApp = new Facebook\FacebookApp('1175112432606251', 'f26d7b0706b3c2f1a87fe30f0be28f17');
			$request = new Facebook\FacebookRequest($fbApp, $accessToken, 'GET', '/me', 
				array('fields' => 'picture{url},id,name,birthday,email,link'));


			try {
  				$response = $fb->getClient()->sendRequest($request);
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
  			// When Graph returns an error
  			echo 'Graph returned an error: ' . $e->getMessage();
  			exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
  			// When validation fails or other local issues
  			echo 'Facebook SDK returned an error: ' . $e->getMessage();
  			exit;
			}

			$graphNode = $response->getGraphNode();
			/* handle the result */
  	// 		$message = 'User name: ' . $graphNode['name'];
  			$data = array (
  				'id' => $graphNode['id'],
  				//'birthday' => $graphNode['birthday'],
  				'birthday' => '',
  				'email' => $graphNode['email'],
  				'link' => $graphNode['link'],
				'user_name' => $graphNode['name'],
				'is_logged_in' => 1,
				'profile_pic_link' => json_decode($graphNode['picture'])->url
			);

  			$this->session->set_userdata($data);
  			/*redirect(base_url().'user/index');*/
  			 /*echo json_encode($data);*/
  			/*$cookie = setcookie('json', $data);*/
  			// Now you can redirect to another page and use the
  			// access token from $_SESSION['facebook_access_token']
  			$data = json_encode($data);
  			setcookie('facebook', $data, time()+1, "/");
  			include('http://localhost/trada-frontend/index.html');
  			redirect('http://localhost/trada-frontend/index.html');
  			/*redirect('http://localhost/trada-frontend/index.html', $_COOKIE['facebook']);*/
		}
	}

}
?>