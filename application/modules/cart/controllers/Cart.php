<?php
class Cart extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function _draw_add_to_cart($item_id)
{
    $data['item_id'] = $item_id;
    $this->load->view('add_to_cart', $data);
}

}