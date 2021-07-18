<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseInventoryitemdetails
 * Generation date:  21/01/2015
 * Table name:       inventory_item_details
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseInventoryitemdetails extends eModel
{
    /**
     * Attribute declaration
     */
    var $id;  /* Primary key */
    var $code;    /* varchar(50) */
    var $name;    /* varchar(100) */
    var $unit;    /* varchar(20) */
    var $quantity_in_details;    /* int(6) */
    var $unit_in_details;    /* varchar(20) */
    var $type_id;    /* int(11) */
    var $description;    /* text */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */
    var $deleted;    /* tinyint(1) */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'inventory_item_details';
        $this->primary_key = 'id';
    }

    /**
     * Getter methods
     */ 

    function get_id()
    {
        return $this->id;
    }

    function get_code()
    {
        return $this->code;
    }

    function get_name()
    {
        return $this->name;
    }

    function get_unit()
    {
        return $this->unit;
    }

    function get_quantity_in_details()
    {
        return $this->quantity_in_details;
    }

    function get_unit_in_details()
    {
        return $this->unit_in_details;
    }

    function get_type_id()
    {
        return $this->type_id;
    }

    function get_description()
    {
        return $this->description;
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

    function set_code($val)
    {
        $this->code =  $val;
    }

    function set_name($val)
    {
        $this->name =  $val;
    }

    function set_unit($val)
    {
        $this->unit =  $val;
    }

    function set_quantity_in_details($val)
    {
        $this->quantity_in_details =  $val;
    }

    function set_unit_in_details($val)
    {
        $this->unit_in_details =  $val;
    }

    function set_type_id($val)
    {
        $this->type_id =  $val;
    }

    function set_description($val)
    {
        $this->description =  $val;
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
