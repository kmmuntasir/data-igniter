# data-igniter
This is a codeigniter library for building query string and returning result in response to datatable post request

Well, to be honest, we can't call it a library because we can't put it in codeigniter library and load it. Instead, we have to copy the custom functions in the `Model.php` file to the Core CI Model.

![alt text](stock_screenshot.png?raw=true "Stock Screenshot")

You can find the Core CI Model file in the following directory:
`system/core/Model.php`
I won't recommend copying and overwriting the file with the `Model.php` from this repo. Instead you should only copy the custom functions and paste them.

The files of the repo and their contents are as below:

```
Stock.php     - A sample stock controller function of an inventory software
M_stock.php   - A sample model
Model.php     - The Core CI Model file
```

Following is a sample model function which is using the `_dt()` function. You should check the `M_stock.php` file because it contains all the helpful comments.

```php
    function dt_get_all_items($is_deleted=0, $postdata=NULL) {
        if($postdata) {
            $select = "item_id, item_name, item_category_name, item_sale_price, item_quantity, admin.admin_name, item_id as it_id";
            $columns = array('item.item_id', 'item.item_name', 'item.item_category_name', 'item.item_sale_price', 'item.item_quantity', 'admin.admin_name', 'item.item_id');
            return $this->_dt($this, 'dt_get_all_items', $postdata, $columns, 'item', $select, $is_deleted);
        }
        else {
            $this->db->where('item.is_deleted', $is_deleted);
            $this->db->join('item_category', 'item.item_category_id = item_category.item_category_id');
            $this->db->join('admin', 'item.item_added_by = admin.admin_id');
        }
    }
```
