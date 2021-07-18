<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseProviders
 * Generation date:  23/04/2017
 * Table name:       providers
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseProviders extends eModel
{
    /**
     * Attribute declaration
     */
    var $id;  /* Primary key */
    var $provider_name;    /* varchar(255) */
    var $provider_address;    /* varchar(255) */
    var $provider_lat;    /* decimal(10,6) */
    var $provider_lng;    /* decimal(10,5) */
    var $description;    /* varchar(255) */
    var $foreign_type;    /* varchar(50) */
    var $foreign_id;    /* int(11) */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* datetime */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'providers';
        $this->primary_key = 'id';
    }

    /**
     * Getter methods
     */ 

    function get_id()
    {
        return $this->id;
    }

    function get_provider_name()
    {
        return $this->provider_name;
    }

    function get_provider_address()
    {
        return $this->provider_address;
    }

    function get_provider_lat()
    {
        return $this->provider_lat;
    }

    function get_provider_lng()
    {
        return $this->provider_lng;
    }

    function get_description()
    {
        return $this->description;
    }

    function get_foreign_type()
    {
        return $this->foreign_type;
    }

    function get_foreign_id()
    {
        return $this->foreign_id;
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

    function set_provider_name($val)
    {
        $this->provider_name =  $val;
    }

    function set_provider_address($val)
    {
        $this->provider_address =  $val;
    }

    function set_provider_lat($val)
    {
        $this->provider_lat =  $val;
    }

    function set_provider_lng($val)
    {
        $this->provider_lng =  $val;
    }

    function set_description($val)
    {
        $this->description =  $val;
    }

    function set_foreign_type($val)
    {
        $this->foreign_type =  $val;
    }

    function set_foreign_id($val)
    {
        $this->foreign_id =  $val;
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
