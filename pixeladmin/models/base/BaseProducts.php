<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseProducts
 * Generation date:  20/01/2015
 * Table name:       products
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseProducts extends eModel
{
    /**
     * Attribute declaration
     */
    var $product_id;  /* Primary key */
    var $category_id;    /* int(11) */
    var $code;    /* varchar(20) */
    var $sequence_number;    /* int(5) */
    var $name;    /* varchar(255) */
    var $name_without_utf8;    /* varchar(255) */
    var $english_name;    /* varchar(255) */
    var $unit;    /* varchar(20) */
    var $belongs_to;    /* varchar(100) */
    var $enabled;    /* tinyint(1) */
    var $is_hidden;    /* tinyint(1) */
    var $description;    /* text */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */
    var $deleted;    /* tinyint(1) */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'products';
        $this->primary_key = 'product_id';
    }

    /**
     * Getter methods
     */ 

    function get_product_id()
    {
        return $this->product_id;
    }

    function get_category_id()
    {
        return $this->category_id;
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

    function get_unit()
    {
        return $this->unit;
    }

    function get_belongs_to()
    {
        return $this->belongs_to;
    }

    function get_enabled()
    {
        return $this->enabled;
    }

    function get_is_hidden()
    {
        return $this->is_hidden;
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

    function set_product_id($val)
    {
        $this->product_id =  $val;
    }

    function set_category_id($val)
    {
        $this->category_id =  $val;
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

    function set_unit($val)
    {
        $this->unit =  $val;
    }

    function set_belongs_to($val)
    {
        $this->belongs_to =  $val;
    }

    function set_enabled($val)
    {
        $this->enabled =  $val;
    }

    function set_is_hidden($val)
    {
        $this->is_hidden =  $val;
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
