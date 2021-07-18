<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BasePages
 * Generation date:  02/06/2015
 * Table name:       pages
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BasePages extends eModel
{
    /**
     * Attribute declaration
     */
    var $page_id;  /* Primary key */
    var $page_code;    /* varchar(100) */
    var $page_title;    /* varchar(255) */
    var $enabled;    /* tinyint(1) */
    var $page_order;    /* int(11) */
    var $page_body;    /* text */
    var $page_template;    /* varchar(255) */
    var $meta_robots;    /* varchar(50) */
    var $extra_data;    /* text */
    var $created_by;    /* int(11) */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */
    var $deleted;    /* tinyint(1) */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'pages';
        $this->primary_key = 'page_id';
    }

    /**
     * Getter methods
     */ 

    function get_page_id()
    {
        return $this->page_id;
    }

    function get_page_code()
    {
        return $this->page_code;
    }

    function get_page_title()
    {
        return $this->page_title;
    }

    function get_enabled()
    {
        return $this->enabled;
    }

    function get_page_order()
    {
        return $this->page_order;
    }

    function get_page_body()
    {
        return $this->page_body;
    }

    function get_page_template()
    {
        return $this->page_template;
    }

    function get_meta_robots()
    {
        return $this->meta_robots;
    }

    function get_extra_data()
    {
        return $this->extra_data;
    }

    function get_created_by()
    {
        return $this->created_by;
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

    function set_page_id($val)
    {
        $this->page_id =  $val;
    }

    function set_page_code($val)
    {
        $this->page_code =  $val;
    }

    function set_page_title($val)
    {
        $this->page_title =  $val;
    }

    function set_enabled($val)
    {
        $this->enabled =  $val;
    }

    function set_page_order($val)
    {
        $this->page_order =  $val;
    }

    function set_page_body($val)
    {
        $this->page_body =  $val;
    }

    function set_page_template($val)
    {
        $this->page_template =  $val;
    }

    function set_meta_robots($val)
    {
        $this->meta_robots =  $val;
    }

    function set_extra_data($val)
    {
        $this->extra_data =  $val;
    }

    function set_created_by($val)
    {
        $this->created_by =  $val;
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
