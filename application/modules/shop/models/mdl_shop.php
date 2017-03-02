<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_shop extends CI_Model
{

function __construct() {
parent::__construct();
}

function get_table() {
    $table = "shop";
    return $table;
}

function get($order_by){
    $table = $this->get_table();
    $this->db->order_by($order_by);
    $query=$this->db->get($table);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) {
    $table = $this->get_table();
    $this->db->limit($limit, $offset);
    $this->db->order_by($order_by);
    $query=$this->db->get($table);
    return $query;
}

function get_where($shop_id){
    $table = $this->get_table();
    $this->db->where('shop_id', $shop_id);
    $query=$this->db->get($table);
    return $query;
}

function get_where_custom($col, $value) {
    $table = $this->get_table();
    $this->db->where($col, $value);
    $query=$this->db->get($table);
    return $query;
}

function _insert($data){
    $table = $this->get_table();
    if($this->db->insert($table, $data))
        return true;
}

function _update($shop_id, $data){
    $table = $this->get_table();
    $this->db->where('shop_id', $shop_id);
    $this->db->update($table, $data);
}

function _delete($shop_id){
    $table = $this->get_table();
    $this->db->where('shop_id', $shop_id);
    $this->db->delete($table);
}

function count_where($column, $value) {
    $table = $this->get_table();
    $this->db->where($column, $value);
    $query=$this->db->get($table);
    $num_rows = $query->num_rows();
    return $num_rows;
}

function count_all() {
    $table = $this->get_table();
    $query=$this->db->get($table);
    $num_rows = $query->num_rows();
    return $num_rows;
}

function get_max() {
    $table = $this->get_table();
    $this->db->select_max('shop_id');
    $query = $this->db->get($table);
    $row=$query->row();
    $shop_id=$row->id;
    return $shop_id;
}

function _custom_query($mysql_query) {
    $query = $this->db->query($mysql_query);
    return $query;
}

function get_all_shop_from_user($user_id){
    // $this->db->where('user_id', $user_id);
    $query = $this->db->query('SELECT * FROM user_shop JOIN shop on user_shop.shop_id = shop.shop_id where user_id = '.$user_id);
    $result = $query->result();
    return $result;
}

function get_all_item_from_shop($shop_id){
    // $this->db->where('user_id', $user_id);
    $query = $this->db->query('SELECT * FROM item_shop JOIN item on item_shop.item_id = item.item_id where shop_id = '.$shop_id);
    $result = $query->result();
    return $result;
}

function get_shop_id($shop_name){
    $this->db->where('shop_name', $shop_name);
    $query = $this->db->get('shop');
    $row=$query->row();
    $shop_id=$row->shop_id;
    return $shop_id;
}

function shop_user_insert($shop_id){
    $user_id = $this->session->userdata('user_id');
    $data = array(
        'shop_id' => $shop_id,
        'user_id' => $user_id
    );
    $this->db->insert('user_shop', $data);
}

function add_fb_picture_url($shop_image_url, $shop_name){
    $data['shop_image_url'] = $shop_image_url;
    $this->db->where('shop_name', $shop_name);
    $this->db->update('shop', $data);
}
}