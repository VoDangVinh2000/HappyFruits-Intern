<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseVouchers
 * Generation date:  12/02/2015
 * Table name:       vouchers
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseVouchers extends eModel
{
    /**
     * Attribute declaration
     */
    var $id;  /* Primary key */
    var $type;    /* enum('receipt','payment') */
    var $date_time;    /* date */
    var $amount;    /* int(10) */
    var $description;    /* text */
    var $user_id;    /* int(11) */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */
    var $deleted;    /* tinyint(1) */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'vouchers';
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

    function get_date_time()
    {
        return $this->date_time;
    }

    function get_amount()
    {
        return $this->amount;
    }

    function get_description()
    {
        return $this->description;
    }

    function get_user_id()
    {
        return $this->user_id;
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

    function set_date_time($val)
    {
        $this->date_time =  $val;
    }

    function set_amount($val)
    {
        $this->amount =  $val;
    }

    function set_description($val)
    {
        $this->description =  $val;
    }

    function set_user_id($val)
    {
        $this->user_id =  $val;
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
