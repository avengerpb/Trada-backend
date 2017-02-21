<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->model('Model_review');
	
	}

	public function index(){

	}

	public function get_review_shop ($shop_id)
	{
		$result = json_encode($this->Model_review->get_review_shop($shop_id));
		return $result;
	}

	public function get_review_id ($review_id)
	{
		$result = json_encode($this->Model_review->get_review_id($review_id));
		return $result;
	}

	public function get_review_user ($user_id)
	{
		$result = json_encode($this->Model_review->get_review_user($user_id));
		return $result;
	}

	public function review()
	{
		$data = $_POST;
		$data = json_decode($data);
		$this->Model_review->set_review($data);
	}

	public function calculate_point_category($shop_id,$category_id){
		$count = $this->Model_review->count_review_category($shop_id,$category_id);
		$total_point = $this->Model_review->total_point_category($shop_id,$category_id);
		$point = int($total_point/$count);
		return $point;
	}

	public function calculate_point_shop($shop_id){
		$count = $this->Model_review->count_review_shop($shop_id);
		$total_point = $this->Model_review->total_point_shop($shop_id);
		$point = int($total_point/$count);
		return $point;
	}
}