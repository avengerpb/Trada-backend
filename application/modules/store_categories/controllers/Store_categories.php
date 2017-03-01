<?php
class Store_categories extends MX_Controller 
{

function __construct() {
    parent::__construct();
    $this->load->library(array('form_validation'));
    $this->load->module(array('site_security', 'templates'));
    $this->load->model('mdl_store_categories');
}

/*
function _get_all_sub_cates_for_dropdown()
{
    // get used on store_cate_item
    $mysql_query = "SELECT * FROM `category` WHERE `group_cate_id` != 0  ORDER BY `group_cate_id`, `category_name`";
    $query = $this->_custom_query($mysql_query);
    foreach ($query->result() as $row) {
        $group_cate_name = $this->_get_category_name($row->group_cate_id);
        $sub_categories[$row->category_id] = $category_id." > ".$row->category_name;
    }

    if (!isset($sub_categories)) {
        $sub_categories = '';
    }

    return $sub_categories;
}
*/

function _draw_top_nav($update_id)
{
    $mysql_query = "SELECT * FROM `category` WHERE `category_id` >= 0";
    $query = $this->_custom_query($mysql_query);
    foreach ($query->result() as $row) {
        $group_cate[$row->category_id] = $row->category_name;
    }

    $data['group_cate'] = $group_cate;
    $this->load->view('top_nav', $data);
}

function _get_group_cate_name($update_id)
{
    $data = $this->fetch_data_from_db($update_id);
    $category_id = $data['group_cate_id'];
    $group_cate_name = $this->_get_category_name($category_id);
    return $group_cate_name;
}

// function sort()
// {
//     $this->load->module('site_security');
//     $this->site_security->_make_sure_is_admin();

//     $number = $this->input->post('number', true);
//     for ($i=1; $i <= $number ; $i++) { 
//         $update_id = $_POST['order'.$i];
//         $data['priority'] = $i;
//         $this->_update($update_id, $data);
//     }
// }

function _draw_sortable_list()
{
    // $mysql_query = "SELECT * FROM `category` WHERE `group_cate_id` = $category_id ORDER BY `priority`";
    $mysql_query = "SELECT * FROM `category`";
    $data['query'] = $this->_custom_query($mysql_query);
    $this->load->view('sortable_list', $data);
}

function _count_items($update_id)
{
    // return the number of items, belonging to THIS category
    $this->load->database('category_item');
    $query = $this->db->query("SELECT `item_id` FROM `category_item` WHERE `category_id` = $update_id");
    $num_rows = $query->num_rows();
    return $num_rows;
}

function create()
{
    $this->site_security->_make_sure_is_admin();
    $submit = $this->input->post('submit',true);
    $update_id = $this->uri->segment(3);

    if ($submit == 'Submit') {
        // $this->form_validation->set_rules('category_id', 'Category ID', 'required');
        $this->form_validation->set_rules('category_name', 'Category Name', 'required|max_length[240]');
        // $this->form_validation->set_rules('category_description', 'Category Description', 'required');

        if ($this->form_validation->run() == true) {
            //get the variables
            $data = $this->fetch_data_from_post();

            if (is_numeric($update_id)) {
                //update the category details
                $this->_update($update_id, $data);
                $flash_msg = 'The category details were successfully updated !';
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';

                $this->session->set_flashdata('category', $value);
                redirect('index.php/store_categories/create/'.$update_id);
            } else {
                //insert a new category
                $this->_insert($data);
                $update_id = $this->get_max(); //get the ID of the new category

                $flash_msg = 'The new category were successfully added !';
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';

                $this->session->set_flashdata('category', $value);
                redirect('index.php/store_categories/create/'.$update_id);
            }
            
        }
    } elseif ($submit == 'Cancel') {
        redirect('index.php/store_categories/manage');
    }

    if ((is_numeric($update_id)) && ($submit != 'Submit')) {
        $data = $this->fetch_data_from_db($update_id);
    } else {
        $data = $this->fetch_data_from_post();
    }

    if (!is_numeric($update_id)) {
        $data['headline'] = 'Add New Category';
    } else {
        $data['headline'] = 'Update Category';
    }

    $data['options'] = $this->_get_dropdown_options($update_id);
    $data['num_dropdown_options'] = count($data['options']);
    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('category');
    $data['view_file'] = 'create';
    $this->templates->admin($data);
}

function manage()
{
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $category_id = $this->uri->segment(3);
    // if (!is_numeric($category_id)) {
    //     $category_id = 0;
    // }

    $data['flash'] = $this->session->flashdata('category');

    $post_data = $this->fetch_data_from_post();
    $data['sort_this'] = true;
    $data['category_id'] = $category_id;
    $data['query'] = $this->get_where_custom('category_id', $category_id);
    $data['view_file'] = 'manage';    
    $this->templates->admin($data);
}

function _get_dropdown_options()
{
    // if (!is_numeric($update_id)) {
    //     $update_id = 0;
    // }

    $options[''] = 'Please Select...';

    // Build an array of all categories group
    $mysql_query = "SELECT * FROM `category`";
    $query = $this->_custom_query($mysql_query);

    foreach ($query->result() as $row) {
        $options[$row->category_id] = $row->category_name;
    }
    return $options;
}

function _get_category_name($update_id)
{
    $data = $this->fetch_data_from_db($update_id);
    $category_name = $data['category_name'];
    return $category_name;
}

function get_category_id_by_category_name($category_name)
{
    $this->mdl_store_categories->get_category_id_by_category_name($category_name);
}

function fetch_data_from_post()
{
    $data['category_name'] = $this->input->post('category_name', true);
    $data['category_description'] = $this->input->post('category_description', true);
    return $data;
}

function fetch_data_from_db($update_id)
{
    if (!is_numeric($update_id)) {
        redirect('index.php/site_security/not_allowed');
    }

    $query = $this->get_where($update_id);
    foreach ($query->result() as $row) {
        $data['category_id'] = $row->category_id;
        $data['category_name'] = $row->category_name;
        $data['category_description'] = $row->category_description;
    }

    if (!isset($data)) {
        $data = '';
    }

    return $data;
}

function get($order_by)
{
    $this->load->model('mdl_store_categories');
    $query = $this->mdl_store_categories->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_categories');
    $query = $this->mdl_store_categories->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_categories');
    $query = $this->mdl_store_categories->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_store_categories');
    $query = $this->mdl_store_categories->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_store_categories');
    $this->mdl_store_categories->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_categories');
    $this->mdl_store_categories->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_categories');
    $this->mdl_store_categories->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_store_categories');
    $count = $this->mdl_store_categories->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_store_categories');
    $max_id = $this->mdl_store_categories->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_store_categories');
    $query = $this->mdl_store_categories->_custom_query($mysql_query);
    return $query;
}

}