<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseSalaryadvances
 * Generation date:  19/04/2016
 * Table name:       salary_advances
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseSalaryadvances extends eModel
{
    /**
     * Attribute declaration
     */
    var $id;  /* Primary key */
    var $user_id;    /* int(11) */
    var $amount;    /* decimal(5,2) */
    var $description;    /* varchar(255) */
    var $created_by;    /* int(11) */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'salary_advances';
        $this->primary_key = 'id';
    }

    /**
     * Getter methods
     */ 

    function get_id()
    {
        return $this->id;
    }

    function get_user_id()
    {
        return $this->user_id;
    }

    function get_amount()
    {
        return $this->amount;
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

    function set_user_id($val)
    {
        $this->user_id =  $val;
    }

    function set_amount($val)
    {
        $this->amount =  $val;
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
