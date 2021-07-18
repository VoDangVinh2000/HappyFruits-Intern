<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseProductComponents
 * Generation date:  05/08/2019
 * Table name:       product_components
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseProductComponents extends eModel
{
    /**
     * Attribute declaration
     */
    var $id;  /* Primary key */
    var $product_id;    /* int(11) unsigned */
    var $item_id;    /* int(11) unsigned */
    var $amount;    /* decimal(8,2) */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'product_components';
        $this->primary_key = 'id';
    }

    /**
     * Getter methods
     */ 

    function get_id()
    {
        return $this->id;
    }

    function get_product_id()
    {
        return $this->product_id;
    }

    function get_item_id()
    {
        return $this->item_id;
    }

    function get_amount()
    {
        return $this->amount;
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

    function set_product_id($val)
    {
        $this->product_id =  $val;
    }

    function set_item_id($val)
    {
        $this->item_id =  $val;
    }

    function set_amount($val)
    {
        $this->amount =  $val;
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
