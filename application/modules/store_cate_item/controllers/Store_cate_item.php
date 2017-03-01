<?php
class Store_cate_item extends MX_Controller 
{

function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->module(array('site_security', 'store_categories'));
}

function delete($update_id)
{
    if (!is_numeric($update_id)) {
        redirect('index.php/site_security/not_allowed');
    }
    $this->site_security->_make_sure_is_admin();

    // fetch the item id
    $query = $this->get_where($update_id);
    foreach ($query->result() as $row) {
        $item_id = $row->item_id;
    }
    $this->_delete($update_id);

    $flash_msg = 'The option was successfully deleted !';
    $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
    $this->session->set_flashdata('item', $value);

    redirect('index.php/store_cate_item/delete/'.$item_id);
}

function submit($item_id)
{
    if (!is_numeric($item_id)) {
        redirect('index.php/site_security/not_allowed');
    }
    $this->site_security->_make_sure_is_admin();

    $submit = $this->input->post('submit', true);
    $category_id = $this->input->post('category_id', true);

    if ($submit == 'Finish') {
        redirect('index.php/store_items/create/'.$item_id);
    } elseif ($submit == 'Submit') {
        //attempt an insert
        if ($category_id != '') {
            $data['item_id'] = $item_id;
            $data['category_id'] = $category_id;
            $this->_insert($data);

            $this->store_categories->_get_category_name($category_id);

            $flash_msg = 'The item was successfully assigned to the '.$category_name.' category.';
            $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
            $this->session->set_flashdata('item', $value);
        }
    }
    redirect('index.php/Store_cate_item/update/'.$item_id);
}

function update($item_id)
{

    if (!is_numeric($item_id)) {
        redirect('index.php/site_security/not_allowed');
    }
    $this->site_security->_make_sure_is_admin();


    // get array of all categories
    $query = $this->db->query("SELECT * FROM `category`");
    foreach ($query->result() as $row) {
        $categories[$row->category_id] = $row->category_name;
    }

    // get array of all assigned categories
    $query = $this->get_where_custom('item_id', $item_id);
    $data['query'] = $query;
    $data['num_rows'] = $query->num_rows();
    foreach ($query->result() as $row) {
        $category_name = $this->store_categories->_get_category_name($row->category_id);
        // $group_cate_name = $this->store_categories->_get_group_cate_name($row->category_id);
        // $assigned_categories[$row->category_id] = $group_cate_name." > ".$category_name;
    }

    // the item has been assigned to at least one category
    $categories = array_diff($categories, $assigned_categories);

    $data['options'] = $categories;
    $data['group_cate_id'] = $this->input->post('group_cate_id', true);

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