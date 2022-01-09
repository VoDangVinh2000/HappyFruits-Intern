<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseCategories
 * Generation date:  20/01/2015
 * Table name:       categories
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseCategories extends eModel
{
    /**
     * Attribute declaration
     */
    var $category_id;  /* Primary key */
    var $parent_id;    /* int(11) */
    var $code;    /* varchar(20) */
    var $sequence_number;    /* int(5) */
    var $name;    /* varchar(255) */
    var $name_without_utf8;    /* varchar(255) */
    var $english_name;    /* varchar(255) */
    var $allow_delivery;    /* tinyint(1) */
    var $enabled;    /* tinyint(1) */
    var $description;    /* text */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */
    var $deleted;    /* tinyint(1) */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'categories';
        $this->primary_key = 'category_id';
    }

    /**
     * Getter methods
     */ 

    function get_category_id()
    {
        return $this->category_id;
    }

    function get_parent_id()
    {
        return $this->parent_id;
    }

    function get_code()
    {
        return $this->code;
    }

    function get_sequence_number()
    {
        return $this->sequence_number;
    }

    function get_name()
    {
        return $this->name;
    }

    function get_name_without_utf8()
    {
        return $this->name_without_utf8;
    }

    function get_english_name()
    {
        return $this->english_name;
    }

    function get_allow_delivery()
    {
        return $this->allow_delivery;
    }

    function get_enabled()
    {
        return $this->enabled;
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

    function set_category_id($val)
    {
        $this->category_id =  $val;
    }

    function set_parent_id($val)
    {
        $this->parent_id =  $val;
    }

    function set_code($val)
    {
        $this->code =  $val;
    }

    function set_sequence_number($val)
    {
        $this->sequence_number =  $val;
    }

    function set_name($val)
    {
        $this->name =  $val;
    }

    function set_name_without_utf8($val)
    {
        $this->name_without_utf8 =  $val;
    }

    function set_english_name($val)
    {
        $this->english_name =  $val;
    }

    function set_allow_delivery($val)
    {
        $this->allow_delivery =  $val;
    }

    function set_enabled($val)
    {
        $this->enabled =  $val;
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
