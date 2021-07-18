<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseFiles
 * Generation date:  30/05/2015
 * Table name:       files
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseFiles extends eModel
{
    /**
     * Attribute declaration
     */
    var $id;  /* Primary key */
    var $type;    /* varchar(100) */
    var $filename;    /* varchar(100) */
    var $path;    /* varchar(255) */
    var $foreign_id;    /* int(11) */
    var $created_by;    /* int(11) */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */
    var $deleted;    /* tinyint(1) */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'files';
        $this->primary_key = 'id';
    }

    /**
     * Getter methods
     */ 

    function get_id()
    {
        return $this->id;
    }

    function get_type()
    {
        return $this->type;
    }

    function get_filename()
    {
        return $this->filename;
    }

    function get_path()
    {
        return $this->path;
    }

    function get_foreign_id()
    {
        return $this->foreign_id;
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

    function set_type($val)
    {
        $this->type =  $val;
    }

    function set_filename($val)
    {
        $this->filename =  $val;
    }

    function set_path($val)
    {
        $this->path =  $val;
    }

    function set_foreign_id($val)
    {
        $this->foreign_id =  $val;
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
