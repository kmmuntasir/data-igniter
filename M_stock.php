<?php

class M_stock extends Ci_model {

	function dt_get_all_items($is_deleted=0, $postdata=NULL) {
		if($postdata) {
			/*
			* Entering this "if" means the function was called from controller, 
			* by datatable post query
			* Prepare the necessary data here for the query builder
			* SELECT string contains the columns you have on the HTML markup of the datatable
			* Build the columns array, you can't just explode the SELECT string using whitespace
			* and use the result array because this is the list of columns which datatables is
			* going to search from. Besides, the SELECT string might have other items 
			* separated by space (look at the last item in the SELECT string)
			*/
			$select = "item_id, item_name, item_category_name, item_sale_price, item_quantity, admin.admin_name, item_id as it_id";
			$columns = array(
						'item.item_id', 
						'item.item_name', 
						'item.item_category_name', 
						'item.item_sale_price', 
						'item.item_quantity', 
						'admin.admin_name', 
						'item.item_id'
					);
			/*
			* $this 				The instance of this very model (M_stock)
			* 'dt_get_all_items'	The name of this very function, because 
			* 						the Core CI Model is going to call it back
			* $postdata 			$_POST array found from the controller
			* 						This is important because this is how the function is
									taking the decision whether this function was called from
									controller or the Core CI Model, by the existence of postdata
			* $columns 				The list of table columns
			* 'item'				The table name
			* $select 				The SELECT string
			* $is_deleted			Optional parameter needed for your query logic
			*/
	    	return $this->_dt($this, 'dt_get_all_items', $postdata, $columns, 'item', $select, $is_deleted);
	    }
	    else {
	    	/*
	    	* Entering this "else" means the function was called from the Core CI Model
	    	* Write all your query logics here
	    	*/
			$this->db->where('item.is_deleted', $is_deleted);
			$this->db->join('item_category', 'item.item_category_id = item_category.item_category_id');
			$this->db->join('admin', 'item.item_added_by = admin.admin_id');
	    }
	}

	function same_function_without_dt_builder($is_deleted=0) {
		// BUT this function wouldn't respond to DataTable post query
		// This would just return the traditional result
		// This function is here for helping you to understand which code is where to put

		$select = "item_id, item_name, item_category_name, item_sale_price, item_quantity, admin.admin_name, item_id as it_id";
		$this->db->where('item.is_deleted', $is_deleted);
		$this->db->join('item_category', 'item.item_category_id = item_category.item_category_id');
		$this->db->join('admin', 'item.item_added_by = admin.admin_id');
		return $this->db->get('item')->result();
	}
}
