<?php

class Model_search extends CI_Model {
	public function search_item($search_phrase){
		$query_item = $this->db->query("SELECT * FROM item WHERE item_name LIKE '%".$search_phrase."%'");
		return $query_item->result();
	}
	public function search_shop($search_phrase){
		$query_shop = $this->db->query("SELECT * FROM shop WHERE shop_name LIKE '%".$search_phrase."%'");
		return $query_shop->result();
	}
	public function search_user($search_phrase){
		$query_user = $this->db->query("SELECT * FROM user WHERE user_name LIKE '%".$search_phrase."%'");
		return $query_user->result();
	}
} 