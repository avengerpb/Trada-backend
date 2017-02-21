<?php
class Store_users extends MX_Controller 
{

function __construct() {
    parent::__construct();
    $this->load->module(array('site_security', 'templates'));
    $this->load->model('mdl_store_users');
    $this->load->helper(array('security', 'url', 'form'));
    $this->load->library(array('form_validation'));
}

function autogen()
{
    $mysql_query = "show columns from `user`";
    $query = $this->_custom_query($mysql_query);

    /*
    foreach ($query->result() as $row) {
        $column_name = $row->Field;

        if ($column_name != 'user_id') {
            echo '$data[\''.$column_name.'\'] = $this->input->post(\''.$column_name.'\', true);<br/>';
        }
    }

    echo "<hr>";

    foreach ($query->result() as $row) {
        $column_name = $row->Field;

        if ($column_name != 'user_id') {
            echo '$data[\''.$column_name.'\'] = $row->'.$column_name.';<br/>';
        }
    }

    echo "<hr>";

    foreach ($query->result() as $row) {
        $column_name = $row->Field;

        if ($column_name != 'user_id') {
            $var = '<div class="control-group">
                          <label class="control-label" for="typeahead">'.ucfirst($column_name).' </label>
                          <div class="controls">
                            <input type="text" class="span6" name="'.$column_name.'" value="<?= $'.$column_name.' ?>">
                          </div>
                        </div>';

            echo htmlentities($var);
            echo "<br>";
        }
    }
    */
}

function manage_users()
{
    $this->site_security->_make_sure_is_admin();

    $data['flash'] = $this->session->flashdata('user');

    $data['query'] = $this->get('user_id');
    $data['view_file'] = 'manage_users';    
    $this->load->module('templates');
    $this->templates->admin($data);
}

function create_users()
{
    $this->site_security->_make_sure_is_admin();
    $submit = $this->input->post('submit',true);
    $update_id = $this->uri->segment(3);
    $user_image_url = $this->mdl_store_users->get_user_image_url($update_id);

    if ($submit == 'Submit') {
        // $this->form_validation->set_rules('user_id', 'User ID', 'required');
        $this->form_validation->set_rules('full_name', 'Full Name', 'required');
        $this->form_validation->set_rules('email', 'Email',  'trim|required|valid_email');
        $this->form_validation->set_rules('fb_link', 'Fb Link', 'trim|required|xss_clean');
        $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|alpha_dash|min_length[3]|xss_clean'); 
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[20]|xss_clean');        
        $this->form_validation->set_rules('level', 'Level', 'trim|required|xss_clean');
        $this->form_validation->set_rules('admin', 'Admin', 'trim|required|xss_clean');
        $this->form_validation->set_rules('reg[dob]', 'Date of birth', 'regex_match[/^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$/]');
        $this->form_validation->set_rules('location', 'Location', 'required|xss_clean');
        $this->form_validation->set_rules('user_image_url', 'User Image Url', 'trim|required|xss_clean');
        

        if ($this->form_validation->run() == true) {
            //get the variables
            $data = $this->fetch_data_from_post();

            if (is_numeric($update_id)) {
                //update the user details
                $this->_update($update_id, $data);
                $flash_msg = 'The user details were successfully updated !';
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';

                $this->session->set_flashdata('user', $value);
                redirect('index.php/store_users/create_users/'.$update_id);
            } else {
                //insert a new user
                $this->_insert($data);
                $update_id = $this->get_max(); //get the ID of the new user

                $flash_msg = 'The user was successfully added !';
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';

                $this->session->set_flashdata('user', $value);
                redirect('index.php/store_users/create_users/'.$update_id);
            }
            
        }
    } elseif ($submit == 'Cancel') {
        redirect('index.php/store_users/manage_users');
    }

    if ((is_numeric($update_id)) && ($submit != 'Submit')) {
        $data = $this->fetch_data_from_db($update_id);
    } else {
        $data = $this->fetch_data_from_post();
    }

    if (!is_numeric($update_id)) {
        $data['headline'] = 'Add New User';
    } else {
        $data['headline'] = 'Update User Details';
    }

    $data['user_image_url'] = $user_image_url;
    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('user');
    $data['view_file'] = 'create_users';
    $this->templates->admin($data);
}

function fetch_data_from_post()
{
    $data['full_name'] = $this->input->post('full_name', true);
    $data['email'] = $this->input->post('email', true);
    $data['fb_link'] = $this->input->post('fb_link', true);
    $data['user_name'] = $this->input->post('user_name', true);
    $data['password'] = $this->input->post('password', true);
    $data['level'] = $this->input->post('level', true);
    $data['admin'] = $this->input->post('admin', true);
    $data['dob'] = $this->input->post('dob', true);
    $data['location'] = $this->input->post('location', true);
    $data['user_image_url'] = $this->input->post('user_image_url', true);
    return $data;
}

function fetch_data_from_db($update_id)
{
    if (!is_numeric($update_id)) {
        redirect('index.php/site_security/not_allowed');
    }

    $query = $this->get_where($update_id);
    foreach ($query->result() as $row) {
        $data['full_name'] = $row->full_name;
        $data['email'] = $row->email;
        $data['fb_link'] = $row->fb_link;
        $data['user_name'] = $row->user_name;
        // $data['password'] = $row->password;
        $data['level'] = $row->level;
        $data['admin'] = $row->admin;
        $data['dob'] = $row->dob;
        $data['location'] = $row->location;
        $data['user_image_url'] = $row->user_image_url;
    }

    if (!isset($data)) {
        $data = '';
    }

    return $data;
}

function get($order_by)
{
    $this->load->model('mdl_store_users');
    $query = $this->mdl_store_users->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_users');
    $query = $this->mdl_store_users->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_users');
    $query = $this->mdl_store_users->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_store_users');
    $query = $this->mdl_store_users->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_store_users');
    $this->mdl_store_users->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_users');
    $this->mdl_store_users->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_users');
    $this->mdl_store_users->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_store_users');
    $count = $this->mdl_store_users->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_store_users');
    $max_id = $this->mdl_store_users->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_store_users');
    $query = $this->mdl_store_users->_custom_query($mysql_query);
    return $query;
}

}