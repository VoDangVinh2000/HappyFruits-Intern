<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseTags
 * Generation date:  18/09/2015
 * Table name:       tags
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseTags extends eModel
{
    /**
     * Attribute declaration
     */
    var $tag_id;  /* Primary key */
    var $tag_code;    /* varchar(100) */
    var $tag_name;    /* varchar(20) */
    var $description;    /* varchar(255) */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */
    var $deleted;    /* tinyint(1) */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'tags';
        $this->primary_key = 'tag_id';
    }

    /**
     * Getter methods
     */ 

    function get_tag_id()
    {
        return $this->tag_id;
    }

    function get_tag_code()
    {
        return $this->tag_code;
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

    function set_tag_id($val)
    {
        $this->tag_id =  $val;
    }

    function set_tag_code($val)
    {
        $this->tag_code =  $val;
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
