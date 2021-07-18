<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseAnnouncements
 * Generation date:  01/01/2016
 * Table name:       announcements
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseAnnouncements extends eModel
{
    /**
     * Attribute declaration
     */
    var $id;  /* Primary key */
    var $content;    /* text */
    var $content_en;    /* text */
    var $image;    /* varchar(255) */
    var $enabled;    /* tinyint(1) */
    var $created_by;    /* int(11) */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */
    var $deleted;    /* tinyint(1) */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'announcements';
        $this->primary_key = 'id';
    }

    /**
     * Getter methods
     */ 

    function get_id()
    {
        return $this->id;
    }

    function get_content()
    {
        return $this->content;
    }

    function get_content_en()
    {
        return $this->content_en;
    }

    function get_image()
    {
        return $this->image;
    }

    function get_enabled()
    {
        return $this->enabled;
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

    function set_id($val)
    {
        $this->id =  $val;
    }

    function set_content($val)
    {
        $this->content =  $val;
    }

    function set_content_en($val)
    {
        $this->content_en =  $val;
    }

    function set_image($val)
    {
        $this->image =  $val;
    }

    function set_enabled($val)
    {
        $this->enabled =  $val;
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
