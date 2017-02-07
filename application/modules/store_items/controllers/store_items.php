<?php
class Store_items extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function create()
{

    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $update_id = $this->uri->segment(3);
    $submit = $this->input->post('submit',true);

    if ((is_numeric($update_id)) && ($submit != 'Submit')) {
        $data = $this->fetch_data_from_db($update_id);
    } else {
        $data = $this->fetch_data_from_post();
    }

    if (!is_numeric($update_id)) {
        $data['headline'] = 'Add New Item';
    } else {
        $data['headline'] = 'Update Item Details';
    }

    $data['view_module'] = 'store_items';
    $data['view_file'] = 'create';
    $this->load->module('templates');
    $this->templates->admin($data);
}

function manage()
{
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $data['view_module'] = 'store_items';
    $data['view_file'] = 'manage';
    $this->load->module('templates');
    $this->templates->admin($data);
}

function fetch_data_from_post()
{
    $data['item_id'] = $this->input->post('item_id', true);
    $data['item_name'] = $this->input->post('item_name', true);
    $data['price'] = $this->input->post('price', true);
    return $data;
}

function fetch_data_from_db($update_id)
{
    $query = $this->get_where($update_id);
    foreach ($query->result() as $row) {
        $data['item_id'] = $row->item_id;
        $data['shop_id'] = $row->shop_id;
        $data['item_name'] = $row->item_name;
        $data['price'] = $row->price;
        $data['item_image_url'] = $row->item_image_url;
    }

    if (!isset($data)) {
        $data = '';
    }

    return $data;
}

function get($order_by)
{
    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_store_items');
    $this->mdl_store_items->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_items');
    $this->mdl_store_items->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_items');
    $this->mdl_store_items->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_store_items');
    $count = $this->mdl_store_items->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_store_items');
    $max_id = $this->mdl_store_items->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->_custom_query($mysql_query);
    return $query;
}

}