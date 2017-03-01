<?php
class Perfectcontroller extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function index()
{
    //attempt to load content
    $last_bit = trim($this->uri->segment(3));

    $this->load->module('shop');
    $query = $this->shop->get_where_custom('shop_id', $last_bit);
    $num_rows = $query->num_rows();

    if ($num_rows > 0) {
    	// if found a shop
    	foreach ($query->result as $row) {
    		$data['shop_name'] = $row->shop_name;
    		$data['address'] = $row->address;
    		$data['fb_link'] = $row->fb_link;
    	}
    } else {
    	//no shop
    	$this->load->module('site_settings');
    	$data = $this->site_settings->_get_page_not_found_msg();
    }

    $this->load->module('templates');
    $this->templates->public_bootstrap($data);    
}

}