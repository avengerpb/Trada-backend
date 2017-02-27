<?php
class Store_cate_item extends MX_Controller 
{

function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->module('site_security');
}

function update($item_id)
{

    if (!is_numeric($item_id)) {
        redirect('index.php/site_security/not_allowed');
    }
    $this->site_security->_make_sure_is_admin();


    // get array of all categories
    $this->load->module('store_categories');
    $query = $this->store_categories->get_where_custom('group_cate_id !=', '0');
    foreach ($query->result() as $row) {
        $categories[$row->category_id] = $row->category_name;
    }

    // get array of all assigned categories
    $query = $this->get_where_custom('item_id', $item_id);
    $data['num_rows'] = $query->num_rows();
    foreach ($query->result() as $row) {
        $assigned_categories[$row->category_id] = $row->category_name;
    }

    if (!isset($assigned_categories)) {
        $assigned_categories = '';
    }

    $data['options'] = $categories;
    $data['category_id'] = $this->input->post('category_id', true);

    $data['headline'] = 'Category Assign';
    $data['item_id'] = $item_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = 'update';
    $this->templates->admin($data);
}

function get($order_by)
{
    $this->load->model('mdl_store_cate_item');
    $query = $this->mdl_store_cate_item->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_cate_item');
    $query = $this->mdl_store_cate_item->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_cate_item');
    $query = $this->mdl_store_cate_item->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_store_cate_item');
    $query = $this->mdl_store_cate_item->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_store_cate_item');
    $this->mdl_store_cate_item->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_cate_item');
    $this->mdl_store_cate_item->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_cate_item');
    $this->mdl_store_cate_item->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_store_cate_item');
    $count = $this->mdl_store_cate_item->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_store_cate_item');
    $max_id = $this->mdl_store_cate_item->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_store_cate_item');
    $query = $this->mdl_store_cate_item->_custom_query($mysql_query);
    return $query;
}

}