<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_store_users extends CI_Model
{

function __construct() {
parent::__construct();
}

function get_table() {
    $table = "user";
    return $table;
}

function get_user_id_by_user_name($user_name) {
    $table = $this->get_table();
    $this->db->select('user_id');
    $this->db->where('user_name', $user_name);
    $query=$this->db->get($table);
    $query=$query->row_array();
    return $query['user_id'];
}

function get_user_name_by_user_id($user_id) {
    $table = $this->get_table();
    $this->db->select('user_name');
    $this->db->where('user_id', $user_id);
    $query=$this->db->get($table);
    $query=$query->row_array();
    return $query['user_name'];
}

function get_user_image_url($user_id) {
    $table = $this->get_table();
    $this->db->select('user_image_url');
    $this->db->where('user_id', $user_id);
    $query=$this->db->get($table);
    $query=$query->row_array();
    return $query['user_image_url'];
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

function get_where($id){
    $table = $this->get_table();
    $this->db->where('id', $id);
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
    $this->db->insert($table, $data);
}

function _update($id, $data){
    $table = $this->get_table();
    $this->db->where('id', $id);
    $this->db->update($table, $data);
}

function _delete($id){
    $table = $this->get_table();
    $this->db->where('id', $id);
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
    $this->db->select_max('id');
    $query = $this->db->get($table);
    $row=$query->row();
    $id=$row->id;
    return $id;
}

function _custom_query($mysql_query) {
    $query = $this->db->query($mysql_query);
    return $query;
}

}