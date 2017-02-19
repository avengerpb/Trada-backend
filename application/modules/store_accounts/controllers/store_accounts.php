<?php
class store_accounts extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function manage_accounts()
{
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $data['flash'] = $this->session->flashdata('Account');

    $data['query'] = $this->get('full_name');
    $data['view_file'] = 'manage_accounts';    
    $this->load->module('templates');
    $this->templates->admin($data);
}


function get($order_by)
{
    $this->load->model('mdl_store_accounts');
    $query = $this->mdl_store_accounts->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_accounts');
    $query = $this->mdl_store_accounts->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_accounts');
    $query = $this->mdl_store_accounts->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_store_accounts');
    $query = $this->mdl_store_accounts->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_store_accounts');
    $this->mdl_store_accounts->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_accounts');
    $this->mdl_store_accounts->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_accounts');
    $this->mdl_store_accounts->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_store_accounts');
    $count = $this->mdl_store_accounts->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_store_accounts');
    $max_id = $this->mdl_store_accounts->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_store_accounts');
    $query = $this->mdl_store_accounts->_custom_query($mysql_query);
    return $query;
}

}