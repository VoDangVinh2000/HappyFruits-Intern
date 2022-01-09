<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseDocuments
 * Generation date:  22/05/2015
 * Table name:       documents
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseDocuments extends eModel
{
    /**
     * Attribute declaration
     */
    var $id;  /* Primary key */
    var $name;    /* varchar(100) */
    var $code;    /* varchar(100) */
    var $filename;    /* varchar(100) */
    var $description;    /* text */
    var $created_by;    /* int(11) */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */
    var $deleted;    /* tinyint(1) */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'documents';
        $this->primary_key = 'id';
    }

    /**
     * Getter methods
     */ 

    function get_id()
    {
        return $this->id;
    }

    function get_name()
    {
        return $this->name;
    }

    function get_code()
    {
        return $this->code;
    }

    function get_filename()
    {
        return $this->filename;
    }

    function get_description()
    {
        return $this->description;
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

    function set_name($val)
    {
        $this->name =  $val;
    }

    function set_code($val)
    {
        $this->code =  $val;
    }

    function set_filename($val)
    {
        $this->filename =  $val;
    }

    function set_description($val)
    {
        $this->description =  $val;
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
