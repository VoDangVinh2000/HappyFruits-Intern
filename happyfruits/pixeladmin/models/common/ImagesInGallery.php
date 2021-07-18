<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        ImagesInGallery
 * Generation date:  14/01/2016
 * Baseclass:        BaseImagesInGallery
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BaseImagesInGallery.php');

/**
 * Class declaration
 */
class ImagesInGallery extends BaseImagesInGallery
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'ImagesInGallery';
    }
    
    function get_full_list($filters = array())
    {
        $sql = 'SELECT images_in_gallery.*, files.filename, files.path
                FROM images_in_gallery
                INNER JOIN files ON files.id = images_in_gallery.image_id';
        $filters['images_in_gallery.deleted'] = 0;
        if (empty($filters['order_by']))
            $filters['order_by'] = 'images_in_gallery.sequence_number';
        return self::_do_select_sql($sql, $filters);
    }
}
/* End of generated class */
