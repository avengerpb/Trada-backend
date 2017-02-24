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
		$permissions = ['public_profile', 'user_friends', 'publish_actions', 'email', 'user_about_me', 'user_birthday', 'user_location','publish_pages', 'pages_show_list','pages_manage_instant_articles','pages_manage_cta','manage_pages']; // optional
		$data['login_url'] = $helper->getLoginUrl('http://localhost/trada-backend/index.php/facebook_login/fb_callback', $permissions);
		// $data = json_encode($data['login_url']);
		$this->load->view('home',$data);
		// echo json_encode($data);
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
				array('fields' => 'picture{url},id,name,birthday,email,link,location'));


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
  			$data_session = array (
  				//'birthday' => $graphNode['birthday'],
  				'email' => $graphNode['email'],
				'user_name' => $graphNode['id'],
				'full_name' => $graphNode['name'],
				'is_logged_in' => 1,
				'user_image_url' => json_decode($graphNode['picture'])->url
			);
  			$this->session->set_userdata($data_session);

			$data_dtb = array (
  				'user_name' => $graphNode['id'],
  				//'birthday' => $graphNode['birthday'],
  				'dob' => '',
  				'email' => $graphNode['email'],
  				'fb_link' => $graphNode['link'],
				'full_name' => $graphNode['name'],
				'location' => $graphNode['location'],
				'user_image_url' => json_decode($graphNode['picture'])->url
			);
			$this->load->model('model_users');
			$this->model_users->add_fb_user($graphNode['id'], $data_dtb);

  			$data = json_encode($data_session);
  			setcookie('facebook', $data, time()+1, "/");
  			include('http://localhost/trada-frontend/index.html');
  			redirect('http://localhost/trada-frontend/index.html');
		}
	}


	public function add_page_shop(){
		$link = 'https://www.facebook.com/duonggodfanclub/?notif_t=page_user_activity&notif_id=1487652095742563';
		preg_match('/(?:http:\/\/)?(?:www.)?facebook.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[\w\-]*\/)*([\w\-]*)/',
		    $link, $matches);

		$str = strstr($matches[0], '/');
		$str = str_replace("/", "", $str);
		// print_r($str);

	  	$session = $_SESSION['facebook_access_token'];

	  	$fb = new Facebook\Facebook([
			'app_id' => '1175112432606251',
  			'app_secret' => 'f26d7b0706b3c2f1a87fe30f0be28f17',
  			'default_graph_version' => 'v2.5',
  		]);

	  	$fbApp = new Facebook\FacebookApp('1175112432606251', 'f26d7b0706b3c2f1a87fe30f0be28f17');
		$request = new Facebook\FacebookRequest($fbApp, $session, 'GET', '/'.$str, 
				array('fields' => 'picture{url},photos{images},cover')); 


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

		$data = array (
  			'picture' => json_decode($graphNode['picture'])->url,
  			//'birthday' => $graphNode['birthday'],
  			'cover' => json_decode($graphNode['cover'])->source,
  			'photos' => json_decode($graphNode['photos'])
		);
  			

  		$data = json_encode($data);
  		print_r($data);
		
	}
}
?>