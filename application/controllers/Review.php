<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->model('model_review');
	
	}

	public function index(){

	}

	public function get_review_shop ($shop_id)
	{
		$result = json_encode($this->model_review->get_review_shop($shop_id));
		return $result;
	}

	public function get_review_id ($review_id)
	{
		$result = json_encode($this->model_review->get_review_id($review_id));
		return $result;
	}

	public function get_review_user ($user_id)
	{
		$result = json_encode($this->model_review->get_review_user($user_id));
		return $result;
	}

	public function post_review()
	{
		// $data = $_POST['ditmemay'];
		// echo ($data);
		// $data = json_decode($data);
		if($this->model_review->set_review($_POST['ditmemay'])){
			$data = array();
			echo json_encode($data);
		};
	}

	public function calculate_point_category($shop_id,$category_id){
		$count = $this->model_review->count_review_category($shop_id,$category_id);
		$total_point = $this->model_review->total_point_category($shop_id,$category_id);
		$point = int($total_point/$count);
		return $point;
	}

	public function calculate_point_shop($shop_id){
		$count = $this->model_review->count_review_shop($shop_id);
		$total_point = $this->model_review->total_point_shop($shop_id);
		$point = int($total_point/$count);
		return $point;
	}
}