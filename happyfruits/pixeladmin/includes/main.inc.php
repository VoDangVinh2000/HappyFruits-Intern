<?php
    require_once dirname(__FILE__). '/pre.inc.php';
    require_once ABSOLUTE_PATH. 'includes/phpexcel1.8.0/PHPExcel.php';
    require_once ABSOLUTE_PATH. 'includes/products.inc.php';
    require_once ABSOLUTE_PATH. 'includes/shipping.inc.php';
    require_once ABSOLUTE_PATH. 'includes/discount.inc.php';
    require_once ABSOLUTE_PATH. 'includes/kpi.inc.php';
    require_once ABSOLUTE_PATH. 'includes/working_time.inc.php';
    
    define("ASSET_URL", BASE_URL. 'assets/');
    
    $last_activity_time = get_session_val('LAST_ACTIVITY');
    if (IS_LIVE && $last_activity_time && (time() - $last_activity_time > 60*60*8) && empty($not_destroy_session)) {
        // last request was more than 8 hours ago
        session_unset();     // unset $_SESSION variable for the run-time 
        session_destroy();   // destroy session data in storage
    }
    set_session_val('LAST_ACTIVITY', time()); //update last activity time stamp
    
    require_once ABSOLUTE_PATH. 'includes/roles.inc.php';
    
    /* themes functtions */
    if (file_exists(EFRUIT_ABSOLUTE_PATH. 'themes/'.ACTIVE_THEME.'/functions.php'))
        require_once EFRUIT_ABSOLUTE_PATH. 'themes/'.ACTIVE_THEME.'/functions.php';
    
    require_once(ABSOLUTE_PATH. 'controllers/BaseController.php');