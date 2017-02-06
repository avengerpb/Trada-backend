<?php 
	/**
	* 
	*/
	class Store_items extends MX_Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function create()
		{
			// $this->load->module('site_security');
			// $this->site_security->_make_sure_is_admin();

			$data['view_module'] = 'store_items';
			$data['view_file'] = 'create';
			$this->load->module('templates');
			$this->templates->admin($data);
		}

		function manage()
		{
			// $this->load->module('site_security');
			// $this->site_security->_make_sure_is_admin();

			$data['query'] = $this->get('item_id');

			$data['view_module'] = 'store_items';
			$data['view_file'] = 'manage';
			$this->load->module('templates');
			$this->templates->admin($data);
		}

		function get($order_by)
		{
			$this->load->model('mdl_store_items');
			$query = $this->mdl_store_items->get($order_by);
			return $query;
		}

		function get_with_limit($limit, $offset, $order_by)
		{
			$this->load->model('mdl_store_items');
			$query = $this->mdl_store_items->get_with_limit($limit, $offset, $order_by);
			return $query;			
		}

		function get_where($id)
		{
			$this->load->model('mdl_store_items');
			$query = $this->mdl_store_items->get_where($id);
			return $query;
		}

		function get_where_custom($col, $value)
		{
			$this->load->model('mdl_store_items');
			$query = $this->mdl_store_items->get_where_custom($col, $value);
			return $query;
		}
	}
?>