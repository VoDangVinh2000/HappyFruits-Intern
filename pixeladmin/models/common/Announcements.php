<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        Announcements
 * Generation date:  01/01/2016
 * Baseclass:        BaseAnnouncements
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BaseAnnouncements.php');

/**
 * Class declaration
 */
class Announcements extends BaseAnnouncements
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Announcements';
    }
}
/* End of generated class */
