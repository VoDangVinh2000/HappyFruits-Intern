<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseInventoryimport
 * Generation date:  21/01/2015
 * Table name:       inventory_import
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseInventoryimport extends eModel
{
    /**
     * Attribute declaration
     */
    var $id;  /* Primary key */
    var $import_date;    /* datetime */
    var $user_id;    /* int(11) */
    var $warehouse_id;    /* int(11) */
    var $description;    /* text */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */
    var $deleted;    /* tinyint(1) */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'inventory_import';
        $this->primary_key = 'id';
    }

    /**
     * Getter methods
     */ 

    function get_id()
    {
        return $this->id;
    }

    function get_import_date()
    {
        return $this->import_date;
    }

    function get_user_id()
    {
        return $this->user_id;
    }

    function get_warehouse_id()
    {
        return $this->warehouse_id;
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

    function set_import_date($val)
    {
        $this->import_date =  $val;
    }

    function set_user_id($val)
    {
        $this->user_id =  $val;
    }

    function set_warehouse_id($val)
    {
        $this->warehouse_id =  $val;
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
