<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BasePrices
 * Generation date:  21/01/2015
 * Table name:       prices
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BasePrices extends eModel
{
    /**
     * Attribute declaration
     */
    var $id;  /* Primary key */
    var $type_id;    /* int(11) */
    var $product_id;    /* int(11) */
    var $price;    /* int(10) */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */
    var $deleted;    /* tinyint(1) */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'prices';
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

    function get_product_id()
    {
        return $this->product_id;
    }

    function get_price()
    {
        return $this->price;
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

    function set_type_id($val)
    {
        $this->type_id =  $val;
    }

    function set_product_id($val)
    {
        $this->product_id =  $val;
    }

    function set_price($val)
    {
        $this->price =  $val;
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
