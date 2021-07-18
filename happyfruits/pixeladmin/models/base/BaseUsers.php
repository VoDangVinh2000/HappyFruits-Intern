<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseUsers
 * Generation date:  15/01/2015
 * Table name:       users
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseUsers extends eModel
{
    /**
     * Attribute declaration
     */
    var $user_id;  /* Primary key */
    var $username;    /* varchar(20) */
    var $password;    /* varchar(50) */
    var $email;    /* varchar(128) */
    var $fullname;    /* varchar(128) */
    var $type_id;    /* int(11) */
    var $do_shipping;    /* tinyint(1) */
    var $rate_per_hour;    /* int(5) */
    var $enabled;    /* tinyint(1) */
    var $deleted;    /* tinyint(1) */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'users';
        $this->primary_key = 'user_id';
    }

    /**
     * Getter methods
     */ 

    function get_user_id()
    {
        return $this->user_id;
    }

    function get_username()
    {
        return $this->username;
    }

    function get_password()
    {
        return $this->password;
    }

    function get_email()
    {
        return $this->email;
    }

    function get_fullname()
    {
        return $this->fullname;
    }

    function get_type_id()
    {
        return $this->type_id;
    }

    function get_do_shipping()
    {
        return $this->do_shipping;
    }

    function get_rate_per_hour()
    {
        return $this->rate_per_hour;
    }

    function get_enabled()
    {
        return $this->enabled;
    }

    function get_deleted()
    {
        return $this->deleted;
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

    function set_user_id($val)
    {
        $this->user_id =  $val;
    }

    function set_username($val)
    {
        $this->username =  $val;
    }

    function set_password($val)
    {
        $this->password =  $val;
    }

    function set_email($val)
    {
        $this->email =  $val;
    }

    function set_fullname($val)
    {
        $this->fullname =  $val;
    }

    function set_type_id($val)
    {
        $this->type_id =  $val;
    }

    function set_do_shipping($val)
    {
        $this->do_shipping =  $val;
    }

    function set_rate_per_hour($val)
    {
        $this->rate_per_hour =  $val;
    }

    function set_enabled($val)
    {
        $this->enabled =  $val;
    }

    function set_deleted($val)
    {
        $this->deleted =  $val;
    }

    function set_created_dtm($val)
    {
        $this->created_dtm =  $val;
    }

    function set_modified_dtm($val)
    {
        $this->modified_dtm =  $val;
    }

}/* End of generated class */