<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseProductsInBoxes
 * Generation date:  10/05/2020
 * Table name:       products_in_boxes
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseProductsInBoxes extends eModel
{
    /**
     * Attribute declaration
     */
    var $id;  /* Primary key */
    var $box_id;    /* int(11) unsigned */
    var $item_id;    /* int(11) unsigned */
    var $amount;    /* decimal(8,2) */
    var $active;    /* tinyint(1) */
    var $important;    /* tinyint(1) */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'products_in_boxes';
        $this->primary_key = 'id';
    }

    /**
     * Getter methods
     */ 

    function get_id()
    {
        return $this->id;
    }

    function get_box_id()
    {
        return $this->box_id;
    }

    function get_item_id()
    {
        return $this->item_id;
    }

    function get_amount()
    {
        return $this->amount;
    }

    function get_active()
    {
        return $this->active;
    }

    function get_important()
    {
        return $this->important;
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

    function set_box_id($val)
    {
        $this->box_id =  $val;
    }

    function set_item_id($val)
    {
        $this->item_id =  $val;
    }

    function set_amount($val)
    {
        $this->amount =  $val;
    }

    function set_active($val)
    {
        $this->active =  $val;
    }

    function set_important($val)
    {
        $this->important =  $val;
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
