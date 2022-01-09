<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        BaseImagesInGallery
 * Generation date:  14/01/2016
 * Table name:       images_in_gallery
 * -------------------------------------------------------
 *
 */

require_once('eModel.php');

/**
 * Class declaration
 */
class BaseImagesInGallery extends eModel
{
    /**
     * Attribute declaration
     */
    var $id;  /* Primary key */
    var $gallery_id;    /* int(11) unsigned */
    var $image_id;    /* int(11) unsigned */
    var $sequence_number;    /* int(5) */
    var $created_dtm;    /* datetime */
    var $modified_dtm;    /* timestamp */
    var $deleted;    /* tinyint(1) */

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'images_in_gallery';
        $this->primary_key = 'id';
    }

    /**
     * Getter methods
     */ 

    function get_id()
    {
        return $this->id;
    }

    function get_gallery_id()
    {
        return $this->gallery_id;
    }

    function get_image_id()
    {
        return $this->image_id;
    }

    function get_sequence_number()
    {
        return $this->sequence_number;
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

    function set_gallery_id($val)
    {
        $this->gallery_id =  $val;
    }

    function set_image_id($val)
    {
        $this->image_id =  $val;
    }

    function set_sequence_number($val)
    {
        $this->sequence_number =  $val;
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
