<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseCustomers
 * Generation date:  18/01/2015
 * Table name:       customers
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseCustomers extends eModel
{
    /**
     * Attribute declaration
     */
    var $customer_id;  /* Primary key */
    var $customer_name;    /* varchar(255) */
    var $address;    /* varchar(255) */
    var $district;    /* varchar(100) */
    var $mobile;    /* varchar(20) */
    var $email;    /* varchar(255) */
    var $username;
    var $password;
    var $lat;    /* decimal(15,10) */
    var $lng;    /* decimal(15,10) */
    var $distance;    /* varchar(4) */
    var $description;    /* varchar(255) */
    var $type_id;    /* int(11) */
    var $total_paid;    /* int(11) */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */
    var $modified_by;    /* int(11) */
    var $deleted;    /* tinyint(1) */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'customers';
        $this->primary_key = 'customer_id';
    }

    /**
     * Getter methods
     */ 
    function get_username(){
        return $this->username;
    }
    function get_password(){
        return $this->password;
    }
    function get_customer_id()
    {
        return $this->customer_id;
    }

    function get_customer_name()
    {
        return $this->customer_name;
    }

    function get_address()
    {
        return $this->address;
    }

    function get_district()
    {
        return $this->district;
    }

    function get_mobile()
    {
        return $this->mobile;
    }

    function get_email()
    {
        return $this->email;
    }

    function get_lat()
    {
        return $this->lat;
    }

    function get_lng()
    {
        return $this->lng;
    }

    function get_distance()
    {
        return $this->distance;
    }

    function get_description()
    {
        return $this->description;
    }

    function get_type_id()
    {
        return $this->type_id;
    }

    function get_total_paid()
    {
        return $this->total_paid;
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

    function set_customer_id($val)
    {
        $this->customer_id =  $val;
    }

    function set_customer_name($val)
    {
        $this->customer_name =  $val;
    }

    function set_address($val)
    {
        $this->address =  $val;
    }

    function set_district($val)
    {
        $this->district =  $val;
    }

    function set_mobile($val)
    {
        $this->mobile =  $val;
    }

    function set_email($val)
    {
        $this->email =  $val;
    }

    function set_lat($val)
    {
        $this->lat =  $val;
    }

    function set_lng($val)
    {
        $this->lng =  $val;
    }

    function set_distance($val)
    {
        $this->distance =  $val;
    }

    function set_description($val)
    {
        $this->description =  $val;
    }

    function set_type_id($val)
    {
        $this->type_id =  $val;
    }

    function set_total_paid($val)
    {
        $this->total_paid =  $val;
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
    function set_username($val)
    {
        $this->username =  $val;
    }function set_password($val)
    {
        $this->password =  $val;
    }
}
/* End of generated class */
