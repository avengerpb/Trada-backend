<?php
class Shop extends MX_Controller 
{

function __construct() {
    parent::__construct();
    $this->load->module(array('site_security', 'templates'));
    $this->load->library(array('session', 'form_validation'));
    $this->load->model('mdl_shop');
}

function create()
{
    $data['shop_name'] = $_POST['shop_name'];
    $data['address'] = $_POST['address'];
    $data['fb_link'] = $_POST['fb_link'];
    // $data['shop_url'] = url_title($data['shop_name']);

    // if (is_numeric($update_id)) {
                //update the shop details
        // $this->_update($update_id, $data);
        // $flash_msg = 'The shop details were successfully updated !';
        // $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';

        // $this->session->set_flashdata('shop', $value);
        // redirect('index.php/shop/create/'.$update_id);
    // } else {
        //insert a new shop
        if ($this->_insert($data)){
            $shop_id = $this->mdl_shop->get_shop_id($_POST['shop_name']);
            $this->mdl_shop->shop_user_insert($shop_id);
            $data['status'] = "success";
        } else{
           $data['status'] = "failes";
        }

        echo json_encode($data);
        // $update_id = $this->get_max(); //get the ID of the new shop

        // $flash_msg = 'The shop was successfully created !';
        // $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';

        // $this->session->set_flashdata('shop', $value);
        // redirect('index.php/shop/create/'.$update_id);
    // }

    // if (!is_numeric($update_id)) {
    //     $data['headline'] = 'Create New shop';
    // } else {
    //     $data['headline'] = 'Update Shop Details';
    // }

    // $data['shop_image_url'] = $shop_image_url;
    // $data['update_id'] = $update_id;
    // $data['flash'] = $this->session->flashdata('shop');
    // $data['view_file'] = 'create';
    // $this->templates->admin($data);
}

function manage()
{
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $data['flash'] = $this->session->flashdata('shop');

    // $post_data = $this->fetch_data_from_post();
    // $shop_id = $this->mdl_shop->get_shop_id_by_shop_name($post_data['shop_name']);
    $data['query'] = $this->get('shop_name');
    // $row = $query->result();
    // echo json_encode($row);

    // if (isset($row)) {
    //     $data['edit_shop_image_url'] = base_url().'index.php/store_shops/create/'.$row['shop_id'];
    //     $data['shop_id'] = $row['shop_id'];
    //     $data['shop_id'] = $row['shop_id'];
    //     $data['shop_name'] = $row['shop_name'];
    //     $data['address'] = $row['address'];
    //     $data['shop_image_url'] = $row['shop_image_url'];
    // }


    // foreach ($query->result() as $row) {
    //     $data['edit_shop_image_url'] = base_url().'index.php/store_shops/create/'.$row->shop_id;
    //     $data['shop_id'] = $row->shop_id;
    //     $data['shop_id'] = $row->shop_id;
    //     $data['shop_name'] = $row->shop_name;
    //     $data['address'] = $row->address;
    //     $data['shop_image_url'] = $row->shop_image_url;
    // }

    $data['view_file'] = 'manage';    
    $this->templates->admin($data);
}

// function fetch_data_from_post()
// {
//     $data['shop_id'] = $this->input->post('shop_id', true);
//     $data['shop_name'] = $this->input->post('shop_name', true);
//     $data['address'] = $this->input->post('address', true);
//     return $data;
// }

function fetch_data_from_db($update_id)
{
    if (!is_numeric($update_id)) {
        redirect('index.php/site_security/not_allowed');
    }

    $query = $this->get_where($update_id);
    foreach ($query->result() as $row) {
        $data['shop_id'] = $row->shop_id;
        $data['shop_name'] = $row->shop_name;
        $data['address'] = $row->address;
        $data['shop_image_url'] = $row->shop_image_url;
        $data['fb_link'] = $row->fb_link;
    }

    if (!isset($data)) {
        $data = '';
    }

    return $data;
}

function get($order_by)
{
    $this->load->model('mdl_shop');
    $query = $this->mdl_shop->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_shop');
    $query = $this->mdl_shop->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($shop_id)
{
    if (!is_numeric($shop_id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_shop');
    $query = $this->mdl_shop->get_where($shop_id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_shop');
    $query = $this->mdl_shop->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_shop');
    if($this->mdl_shop->_insert($data))
        return true;
}

function _update($shop_id, $data)
{
    if (!is_numeric($shop_id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_shop');
    $this->mdl_shop->_update($shop_id, $data);
}

function _delete($shop_id)
{
    if (!is_numeric($shop_id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_shop');
    $this->mdl_shop->_delete($shop_id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_shop');
    $count = $this->mdl_shop->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_shop');
    $max_id = $this->mdl_shop->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_shop');
    $query = $this->mdl_shop->_custom_query($mysql_query);
    return $query;
}

function shop_check($str)
{
    $update_id = $this->uri->segment(3);
    // $shop_image_url = url_title($str);
    $mysql_query = "SELECT * FROM `shop` WHERE `shop_name`='$str'";

    if (is_numeric($update_id)) {
        //update
        $mysql_query .= " AND `shop_id`!='$update_id'";
    }

    $query = $this->_custom_query($mysql_query);
    $num_rows = $query->num_rows();
    

    if ($num_rows > 0) {
        $this->form_validation->set_message('shop_check', 'The shop name that you submitted is existed !');
        return false;
    } else {
        return true;
    }
}

function get_all_shop_from_user($user_id){
    return $this->mdl_shop->get_all_shop_from_user($user_id);
}

}