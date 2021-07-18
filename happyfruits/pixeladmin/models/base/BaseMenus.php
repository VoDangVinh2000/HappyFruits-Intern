<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseMenus
 * Generation date:  26/06/2020
 * Table name:       menus
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseMenus extends eModel
{
    /**
     * Attribute declaration
     */
    var $id;  /* Primary key */
    var $name;    /* varchar(100) */
    var $code;    /* varchar(100) */
    var $description;    /* varchar(255) */
    var $position;    /* varchar(50) */
    var $items;    /* text */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'menus';
        $this->primary_key = 'id';
    }

    /**
     * Getter methods
     */ 

    function get_id()
    {
        return $this->id;
    }

    function get_name()
    {
        return $this->name;
    }

    function get_code()
    {
        return $this->code;
    }

    function get_description()
    {
        return $this->description;
    }

    function get_position()
    {
        return $this->position;
    }

    function get_items()
    {
        return $this->items;
    }

    function get_created_dtm()
    {
        return $this->created_dtm;
    }

    function get_modified_dtm()
    {
        return $this->modified_dtm;
    }

    /**
     * Setter methods
     */

    function set_id($val)
    {
        $this->id =  $val;
    }

    function set_name($val)
    {
        $this->name =  $val;
    }

    function set_code($val)
    {
        $this->code =  $val;
    }

    function set_description($val)
    {
        $this->description =  $val;
    }

    function set_position($val)
    {
        $this->position =  $val;
    }

    function set_items($val)
    {
        $this->items =  $val;
    }

    function set_created_dtm($val)
    {
        $this->created_dtm =  $val;
    }

    function set_modified_dtm($val)
    {
        $this->modified_dtm =  $val;
    }

}
/* End of generated class */
