<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseInventory
 * Generation date:  21/01/2015
 * Table name:       inventory
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseInventory extends eModel
{
    /**
     * Attribute declaration
     */
    var $id;  /* Primary key */
    var $warehouse_id;    /* int(11) */
    var $item_id;    /* int(11) */
    var $quantity;    /* int(11) */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */
    var $deleted;    /* tinyint(1) */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'inventory';
        $this->primary_key = 'id';
    }

    /**
     * Getter methods
     */ 

    function get_id()
    {
        return $this->id;
    }

    function get_warehouse_id()
    {
        return $this->warehouse_id;
    }

    function get_item_id()
    {
        return $this->item_id;
    }

    function get_quantity()
    {
        return $this->quantity;
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

    /**
     * Setter methods
     */

    function set_id($val)
    {
        $this->id =  $val;
    }

    function set_warehouse_id($val)
    {
        $this->warehouse_id =  $val;
    }

    function set_item_id($val)
    {
        $this->item_id =  $val;
    }

    function set_quantity($val)
    {
        $this->quantity =  $val;
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

}
/* End of generated class */
