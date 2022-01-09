<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseProductsintags
 * Generation date:  18/09/2015
 * Table name:       products_in_tags
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseProductsintags extends eModel
{
    /**
     * Attribute declaration
     */
    var $id;  /* Primary key */
    var $tag_id;    /* int(11) unsigned */
    var $product_id;    /* int(11) unsigned */
    var $sequence_number;    /* int(5) */
    var $tag_name;    /* varchar(20) */
    var $description;    /* varchar(255) */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */
    var $deleted;    /* tinyint(1) */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'products_in_tags';
        $this->primary_key = 'id';
    }

    /**
     * Getter methods
     */ 

    function get_id()
    {
        return $this->id;
    }

    function get_tag_id()
    {
        return $this->tag_id;
    }

    function get_product_id()
    {
        return $this->product_id;
    }

    function get_sequence_number()
    {
        return $this->sequence_number;
    }

    function get_tag_name()
    {
        return $this->tag_name;
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

    function set_tag_id($val)
    {
        $this->tag_id =  $val;
    }

    function set_product_id($val)
    {
        $this->product_id =  $val;
    }

    function set_sequence_number($val)
    {
        $this->sequence_number =  $val;
    }

    function set_tag_name($val)
    {
        $this->tag_name =  $val;
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
