<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseOrders
 * Generation date:  20/01/2015
 * Table name:       orders
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseOrders extends eModel
{
    /**
     * Attribute declaration
     */
    var $id;  /* Primary key */
    var $type_id;    /* int(11) */
    var $customer_id;    /* int(11) */
    var $subtotal;    /* int(5) */
    var $shipping_fee;    /* int(5) */
    var $shipping_info;    /* text */
    var $discount;    /* decimal(5,2) */
    var $quantity;    /* int(5) */
    var $total;    /* decimal(8,2) */
    var $description;    /* text */
    var $code;    /* varchar(20) */
    var $g_code;    /* varchar(20) */
    var $table_name;    /* varchar(20) */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */
    var $deleted;    /* tinyint(1) */
    var $is_shipped;    /* tinyint(1) */
    var $is_locked;    /* tinyint(1) */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'orders';
        $this->primary_key = 'id';
    }

    /**
     * Getter methods
     */ 

    function get_id()
    {
        return $this->id;
    }

    function get_type_id()
    {
        return $this->type_id;
    }

    function get_customer_id()
    {
        return $this->customer_id;
    }

    function get_subtotal()
    {
        return $this->subtotal;
    }

    function get_shipping_fee()
    {
        return $this->shipping_fee;
    }

    function get_shipping_info()
    {
        return $this->shipping_info;
    }

    function get_discount()
    {
        return $this->discount;
    }

    function get_quantity()
    {
        return $this->quantity;
    }

    function get_total()
    {
        return $this->total;
    }

    function get_description()
    {
        return $this->description;
    }

    function get_code()
    {
        return $this->code;
    }

    function get_g_code()
    {
        return $this->g_code;
    }

    function get_table_name()
    {
        return $this->table_name;
    }

    function get_created_dtm()
    {
        return $this->created_dtm;
    }

    function get_modified_dtm()
    {
        return $this->modified_dtm;
    }

    function get_deleted()
    {
        return $this->deleted;
    }

    function get_is_shipped()
    {
        return $this->is_shipped;
    }

    function get_is_locked()
    {
        return $this->is_locked;
    }

    /**
     * Setter methods
     */

    function set_id($val)
    {
        $this->id =  $val;
    }

    function set_type_id($val)
    {
        $this->type_id =  $val;
    }

    function set_customer_id($val)
    {
        $this->customer_id =  $val;
    }

    function set_subtotal($val)
    {
        $this->subtotal =  $val;
    }

    function set_shipping_fee($val)
    {
        $this->shipping_fee =  $val;
    }

    function set_shipping_info($val)
    {
        $this->shipping_info =  $val;
    }

    function set_discount($val)
    {
        $this->discount =  $val;
    }

    function set_quantity($val)
    {
        $this->quantity =  $val;
    }

    function set_total($val)
    {
        $this->total =  $val;
    }

    function set_description($val)
    {
        $this->description =  $val;
    }

    function set_code($val)
    {
        $this->code =  $val;
    }

    function set_g_code($val)
    {
        $this->g_code =  $val;
    }

    function set_table_name($val)
    {
        $this->table_name =  $val;
    }

    function set_created_dtm($val)
    {
        $this->created_dtm =  $val;
    }

    function set_modified_dtm($val)
    {
        $this->modified_dtm =  $val;
    }

    function set_deleted($val)
    {
        $this->deleted =  $val;
    }

    function set_is_shipped($val)
    {
        $this->is_shipped =  $val;
    }

    function set_is_locked($val)
    {
        $this->is_locked =  $val;
    }

}
/* End of generated class */
