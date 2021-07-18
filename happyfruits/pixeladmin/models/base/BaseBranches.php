<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseBranches
 * Generation date:  16/03/2017
 * Table name:       branches
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseBranches extends eModel
{
    /**
     * Attribute declaration
     */
    var $id;  /* Primary key */
    var $branch_name;    /* varchar(255) */
    var $branch_address;    /* varchar(255) */
    var $lat;    /* decimal(10,6) */
    var $lng;    /* decimal(10,5) */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* datetime */
    var $modified_by;    /* int(11) */
    var $deleted;    /* tinyint(1) */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'branches';
        $this->primary_key = 'id';
    }

    /**
     * Getter methods
     */ 

    function get_id()
    {
        return $this->id;
    }

    function get_branch_name()
    {
        return $this->branch_name;
    }

    function get_branch_address()
    {
        return $this->branch_address;
    }

    function get_lat()
    {
        return $this->lat;
    }

    function get_lng()
    {
        return $this->lng;
    }

    function get_created_dtm()
    {
        return $this->created_dtm;
    }

    function get_modified_dtm()
    {
        return $this->modified_dtm;
    }

    function get_modified_by()
    {
        return $this->modified_by;
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

    function set_branch_name($val)
    {
        $this->branch_name =  $val;
    }

    function set_branch_address($val)
    {
        $this->branch_address =  $val;
    }

    function set_lat($val)
    {
        $this->lat =  $val;
    }

    function set_lng($val)
    {
        $this->lng =  $val;
    }

    function set_created_dtm($val)
    {
        $this->created_dtm =  $val;
    }

    function set_modified_dtm($val)
    {
        $this->modified_dtm =  $val;
    }

    function set_modified_by($val)
    {
        $this->modified_by =  $val;
    }

    function set_deleted($val)
    {
        $this->deleted =  $val;
    }

}
/* End of generated class */
