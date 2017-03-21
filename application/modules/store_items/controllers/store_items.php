<?php
class Store_items extends MX_Controller 
{

function __construct() {
    parent::__construct();

    $this->load->library(array('session', 'form_validation'));
    $this->load->module(array('site_security', 'templates'));
    $this->load->model('mdl_store_items');

    $this->form_validation->CI =& $this;
}

function manage()
{
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    /*$data['flash'] = $this->session->flashdata('item');*/

    $post_data = $this->fetch_data_from_post();

    $item_id = $this->mdl_store_items->get_item_id_by_item_name($post_data['item_name']);
    $data = $this->get($item_id);
    echo json_encode($data);
    /*$data['view_file'] = 'manage';    
    $this->templates->admin($data);*/

}

function view($update_id)
{
    if (!is_numeric($update_id)) {
        redirect('index.php/site_security/not_allowed');
    }

    //fetch item details
    $data = $this->fetch_data_from_db($update_id);

    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = 'view';
    $this->templates->public_bootstrap($data);
}

function create()
{
    $this->site_security->_make_sure_is_admin();
    $submit = $this->input->post('submit',true);
    $update_id = $this->uri->segment(3);
    $item_image_url = $this->mdl_store_items->get_item_image_url($update_id);

    $this->load->module('store_categories');
    $post_data = $this->store_categories->fetch_data_from_post();
    $category_id = $this->store_categories->get_category_id_by_category_name($post_data['category_name']);


    if ($submit == 'Submit') {
        // $this->form_validation->set_rules('item_id', 'Item ID', 'required');
        $this->form_validation->set_rules('item_name', 'Item Name', 'required|max_length[240]|callback_item_check');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('category_id', 'Group Category', 'required');

        if ($this->form_validation->run() == true) {
            //get the variables
            $data = $this->fetch_data_from_post();
            $cate_id = $this->input->post('category_id');

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


                $this->db->query("INSERT INTO `category_item`(`category_id`, `item_id`) VALUES ($cate_id,$update_id)");
                $this->db->query("INSERT INTO `item_shop`(`shop_id`, `item_id`) VALUES (1, $update_id)");

                $flash_msg = 'The item was successfully added !';
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';

                $this->session->set_flashdata('item', $value);
                redirect('index.php/store_items/create/'.$update_id);
            }
            
        }
    } elseif ($submit == 'Cancel') {
        redirect('index.php/store_items/manage');
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


    $data['category_id'] = $category_id;
    $data['options'] = $this->store_categories->_get_dropdown_options($update_id);
    $data['num_dropdown_options'] = count($data['options']);
    $data['item_image_url'] = $item_image_url;
    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = 'create';
    $this->templates->admin($data);
}

function upload_image($update_id)
{
    if (!is_numeric($update_id)) {
        redirect('index.php/site_security/not_allowed');
    }
    $this->site_security->_make_sure_is_admin();

    $data['headline'] = 'Upload Image';
    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = 'upload_image';
    $this->templates->admin($data);
}

function do_upload($update_id)
{
    if (!is_numeric($update_id)) {
        redirect('index.php/site_security/not_allowed');
    }

    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $submit = $this->input->post('submit',true);
    if ($submit == 'Submit') {
        # code...
    } elseif ($submit == 'Cancel') {
        redirect('index.php/store_items/create/'.$update_id);
    }

    $config['upload_path']      = './item_images/';
    $config['allowed_types']    = 'gif|jpg|png';
    $config['max_size']         = 100;
    $config['max_width']        = 1024;
    $config['max_height']       = 768;

    $this->load->library('upload', $config);

    if (! $this->upload->do_upload('userfile')) {
        $data['error'] = array('error' => $this->upload->display_errors('<p style="color: red; !important;">', '</p>'));
        $data['headline'] = 'Upload Error';
        $data['update_id'] = $update_id;
        $data['flash'] = $this->session->flashdata('item');
        $data['view_file'] = 'upload_image';
        $this->templates->admin($data);
    } else {
        // Upload success

        $data = array('upload_data' => $this->upload->data());  

        $upload_data = $data['upload_data'];
        $file_name = $upload_data['file_name'];
        $item_image_url = base_url().'item_images/'.$file_name;

        $update_data['item_image_url'] = $item_image_url;
        $this->_update($update_id, $update_data);

        $data['headline'] = 'Upload Success';
        $data['update_id'] = $update_id;
        $data['flash'] = $this->session->flashdata('item');
        $data['view_file'] = 'upload_success';
        $this->templates->admin($data);
    }
    
}

function delete_image($update_id)
{
    if (!is_numeric($update_id)) {
        redirect('index.php/site_security/not_allowed');
    }

    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $this->fetch_data_from_db($update_id);
    $item_image_url = $data['item_image_url'];
    $file_name = basename($item_image_url);
    $file = base_url().'/item_images/'.$file_name;

    //attempt to remove the image
    if (file_exists($item_image_url)) {
        unlink($file);
    }

    //update db
    unset($data);
    $data['item_image_url'] = '';
    $this->_update($update_id, $data);
    
    $flash_msg = 'The item was successfully deleted !';
    $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
    $this->session->set_flashdata('item', $value);

    redirect('index.php/store_items/create/'.$update_id);
}

function delete($update_id)
{
    if (!is_numeric($update_id)) {
        redirect('index.php/site_security/not_allowed');
    }

    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $submit = $this->input->post('submit', true);
    if ($submit == 'Yes - Delete Item') {
        $this->_delete($update_id);
        // $this->db->query("DELETE * FROM `category_item` WHERE `item_id` = $update_id");

        $flash_msg = 'The item was successfully deleted !';
        $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
        $this->session->set_flashdata('item', $value);

        redirect('index.php/store_items/manage');
    } elseif ($submit == 'Cancel') {
        redirect('index.php/store_items/create/'.$update_id);
    }
}

function deleteconf($update_id)
{
    if (!is_numeric($update_id)) {
        redirect('index.php/site_security/not_allowed');
    }

    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $data['headline'] = 'Delete Item';
    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = 'deleteconf';
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
    if (!is_numeric($update_id)) {
        redirect('index.php/site_security/not_allowed');
    }

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
    $query = $this->mdl_store_items->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $query = $this->mdl_store_items->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($item_id)
{
    if (!is_numeric($item_id)) {
        die('Non-numeric variable!');
    }

    $query = $this->mdl_store_items->get_where($item_id);
    return $query;
}

function get_where_custom($col, $value) 
{    
    $query = $this->mdl_store_items->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{    
    $this->mdl_store_items->_insert($data);
}

function _update($item_id, $data)
{
    if (!is_numeric($item_id)) {
        die('Non-numeric variable!');
    }
    
    $this->mdl_store_items->_update($item_id, $data);
}

function _delete($item_id)
{
    if (!is_numeric($item_id)) {
        die('Non-numeric variable!');
    }
    
    $this->mdl_store_items->_delete($item_id);
}

function count_where($column, $value) 
{    
    $count = $this->mdl_store_items->count_where($column, $value);
    return $count;
}

function get_max() 
{    
    $max_id = $this->mdl_store_items->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{    
    $query = $this->mdl_store_items->_custom_query($mysql_query);
    return $query;
}

function item_check($str)
{
    $update_id = $this->uri->segment(3);
    // $item_image_url = url_title($str);
    $mysql_query = "SELECT * FROM `item` WHERE `item_name`='$str'";

    if (is_numeric($update_id)) {
        //update
        $mysql_query .= " AND `item_id`!='$update_id'";
    }

    $query = $this->_custom_query($mysql_query);
    $num_rows = $query->num_rows();
    

    if ($num_rows > 0) {
        $this->form_validation->set_message('item_check', 'The item name that you submitted is existed !');
        return false;
    } else {
        return true;
        
    }
}

}