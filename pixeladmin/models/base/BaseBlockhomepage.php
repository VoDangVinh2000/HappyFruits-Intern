<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseBlockhomepage
 * Generation date:  21/12/2021
 * Table name:       block_homepage
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseBlockhomepage extends eModel
{
    /**
     * Attribute declaration
     */
    var $id;  /* Primary key */
    var $type_block;    /* tinyint(4) */
    var $category_id;    /* tinyint(4) */
    var $products_id;    /* text */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'block_homepage';
        $this->primary_key = 'id';
    }

    /**
     * Getter methods
     */ 

    function get_id()
    {
        return $this->id;
    }

    function get_type_block()
    {
        return $this->type_block;
    }

    function get_category_id()
    {
        return $this->category_id;
    }

    function get_products_id()
    {
        return $this->products_id;
    }

    /**
     * Setter methods
     */

    function set_id($val)
    {
        $this->id =  $val;
    }

    function set_products_id($val)
    {
        $this->products_id =  $val;
    }

    function set_category_id($val)
    {
        $this->category_id =  $val;
    }

    function set_type_block($val){
        $this->type_block = $val;
    }
}
/* End of generated class */
