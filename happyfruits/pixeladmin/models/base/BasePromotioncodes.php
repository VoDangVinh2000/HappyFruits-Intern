<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BasePromotioncodes
 * Generation date:  15/06/2016
 * Table name:       promotion_codes
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BasePromotioncodes extends eModel
{
    /**
     * Attribute declaration
     */
    var $id;  /* Primary key */
    var $start_date;    /* datetime */
    var $end_date;    /* datetime */
    var $code;    /* varchar(5) */
    var $discount;    /* decimal(3,2) */
    var $description;    /* varchar(255) */
    var $created_by;    /* int(11) */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'promotion_codes';
        $this->primary_key = 'id';
    }

    /**
     * Getter methods
     */ 

    function get_id()
    {
        return $this->id;
    }

    function get_start_date()
    {
        return $this->start_date;
    }

    function get_end_date()
    {
        return $this->end_date;
    }

    function get_code()
    {
        return $this->code;
    }

    function get_discount()
    {
        return $this->discount;
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

    /**
     * Setter methods
     */

    function set_id($val)
    {
        $this->id =  $val;
    }

    function set_start_date($val)
    {
        $this->start_date =  $val;
    }

    function set_end_date($val)
    {
        $this->end_date =  $val;
    }

    function set_code($val)
    {
        $this->code =  $val;
    }

    function set_discount($val)
    {
        $this->discount =  $val;
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

}
/* End of generated class */
