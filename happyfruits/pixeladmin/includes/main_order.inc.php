<?php
    require_once dirname(__FILE__). '/pre.inc.php';
    require_once ABSOLUTE_PATH. 'includes/discount.inc.php';
    require_once ABSOLUTE_PATH. 'includes/shipping.inc.php';
    require_once ABSOLUTE_PATH. 'includes/working_time.inc.php';
    require_once(ABSOLUTE_PATH. 'models/common/Orders.php');
    require_once(ABSOLUTE_PATH. 'models/common/Branches.php');
    
    define("ASSET_URL", BASE_URL. 'assets/');
    
    
    $models = new stdClass;
    $models->order = new Orders();
    $models->user = new Users();
    $models->branch = new Branches();