<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
	public function search_result(){
		$this->load->model('Model_search');
		/*$search_phrase =  $this->input->post('search_phrase');*/
		$search_phrase = $_POST['search_phrase'];
		$result['item'] = $this->Model_search->search_item($search_phrase);
		$result['shop'] = $this->Model_search->search_shop($search_phrase);
		$result['user'] = $this->Model_search->search_user($search_phrase);
		/*$this->load->view('search_result',$result);*/
		echo json_encode($result);
		/*$data = json_encode($result);
		setcookie('search', $data, time()+1, "/");
		include('http://localhost/trada-frontend/search_result.html');
		redirect('http://localhost/trada-frontend/search_result.html');*/
	}
}