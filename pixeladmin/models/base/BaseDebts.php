<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseDebts
 * Generation date:  05/07/2018
 * Table name:       debts
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseDebts extends eModel
{
    /**
     * Attribute declaration
     */
    var $id;  /* Primary key */
    var $name;    /* varchar(255) */
    var $type_id;    /* int(11) */
    var $amount;    /* decimal(8,2) */
    var $description;    /* text */
    var $user_id;    /* int(11) */
    var $payment_date;    /* datetime */
    var $status;    /* enum('pending','paid','period') */
    var $created_by;    /* int(11) */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */
    var $deleted;    /* tinyint(1) */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'debts';
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

    function get_type_id()
    {
        return $this->type_id;
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

    function get_payment_date()
    {
        return $this->payment_date;
    }

    function get_status()
    {
        return $this->status;
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

    function set_type_id($val)
    {
        $this->type_id =  $val;
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

    function set_payment_date($val)
    {
        $this->payment_date =  $val;
    }

    function set_status($val)
    {
        $this->status =  $val;
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
