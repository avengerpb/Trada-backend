<?php
class Store_items extends MX_Controller 
{

function __construct() {
    parent::__construct();

    $this->load->library('session');
    $this->load->module('site_security');
    $this->load->library('form_validation');
}

function create()
{
    $this->site_security->_make_sure_is_admin();

    $update_id = $this->uri->segment(3);
    $submit = $this->input->post('submit',true);

    if ($submit == 'Submit') {
        $this->form_validation->set_rules('item_id', 'Item ID', 'required');
        $this->form_validation->set_rules('item_name', 'Item Name', 'required|max_length[240]');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');

        if ($this->form_validation->run() == true) {
            //get the variables
            $data = $this->fetch_data_from_post();

            if (is_numeric($update_id)) {
                //update the item details
                $this->_update($update_id, $data);
                $flash_msg = 'The item details were successfully updated !';
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';

                $this->session->set_flashdata('item', $value);
                redirect('index.php/store_items/create/'.$update_id);
            } else {
                //insert a new item
                $this->_insert($data);
                $update_id = $this->get_max(); //get the ID of the new item

                $flash_msg = 'The item was successfully added !';
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';

                $this->session->set_flashdata('item', $value);
                redirect('index.php/store_items/create/'.$update_id);
            }
            
        }
    }

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

    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
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

function get_where($item_id)
{
    if (!is_numeric($item_id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->get_where($item_id);
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

function _update($item_id, $data)
{
    if (!is_numeric($item_id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_items');
    $this->mdl_store_items->_update($item_id, $data);
}

function _delete($item_id)
{
    if (!is_numeric($item_id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_items');
    $this->mdl_store_items->_delete($item_id);
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