<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseCustomerdebts
 * Generation date:  08/10/2018
 * Table name:       customer_debts
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseCustomerdebts extends eModel
{
    /**
     * Attribute declaration
     */
    var $id;  /* Primary key */
    var $name;    /* varchar(255) */
    var $type_id;    /* int(11) */
    var $description;    /* text */
    var $branch_id;    /* int(11) */
    var $user_id;    /* int(11) */
    var $amount;    /* int(11) */
    var $order_id;    /* int(11) */
    var $payment_type;    /* varchar(20) */
    var $payment_date;    /* datetime */
    var $paid_amount;    /* int(11) */
    var $status;    /* enum('pending','paid') */
    var $created_by;    /* int(11) */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */
    var $deleted;    /* tinyint(1) */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'customer_debts';
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

    function get_description()
    {
        return $this->description;
    }

    function get_branch_id()
    {
        return $this->branch_id;
    }

    function get_user_id()
    {
        return $this->user_id;
    }

    function get_amount()
    {
        return $this->amount;
    }

    function get_order_id()
    {
        return $this->order_id;
    }

    function get_payment_type()
    {
        return $this->payment_type;
    }

    function get_payment_date()
    {
        return $this->payment_date;
    }

    function get_paid_amount()
    {
        return $this->paid_amount;
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

    function set_description($val)
    {
        $this->description =  $val;
    }

    function set_branch_id($val)
    {
        $this->branch_id =  $val;
    }

    function set_user_id($val)
    {
        $this->user_id =  $val;
    }

    function set_amount($val)
    {
        $this->amount =  $val;
    }

    function set_order_id($val)
    {
        $this->order_id =  $val;
    }

    function set_payment_type($val)
    {
        $this->payment_type =  $val;
    }

    function set_payment_date($val)
    {
        $this->payment_date =  $val;
    }

    function set_paid_amount($val)
    {
        $this->paid_amount =  $val;
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
