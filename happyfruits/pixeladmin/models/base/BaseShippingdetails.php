<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseShippingdetails
 * Generation date:  20/01/2015
 * Table name:       shipping_details
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseShippingdetails extends eModel
{
    /**
     * Attribute declaration
     */
    var $id;  /* Primary key */
    var $user_id;    /* int(11) */
    var $customer_id;    /* int(11) */
    var $date_time;    /* datetime */
    var $distance;    /* varchar(4) */
    var $number_of_dishes;    /* int(10) */
    var $total;    /* int(10) */
    var $description;    /* varchar(255) */
    var $created_by;    /* int(11) */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */
    var $ip_address;    /* varchar(20) */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'shipping_details';
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

    function get_customer_id()
    {
        return $this->customer_id;
    }

    function get_date_time()
    {
        return $this->date_time;
    }

    function get_distance()
    {
        return $this->distance;
    }

    function get_number_of_dishes()
    {
        return $this->number_of_dishes;
    }

    function get_total()
    {
        return $this->total;
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

    function get_ip_address()
    {
        return $this->ip_address;
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

    function set_customer_id($val)
    {
        $this->customer_id =  $val;
    }

    function set_date_time($val)
    {
        $this->date_time =  $val;
    }

    function set_distance($val)
    {
        $this->distance =  $val;
    }

    function set_number_of_dishes($val)
    {
        $this->number_of_dishes =  $val;
    }

    function set_total($val)
    {
        $this->total =  $val;
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

    function set_ip_address($val)
    {
        $this->ip_address =  $val;
    }

}
/* End of generated class */
