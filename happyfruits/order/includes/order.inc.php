<?php 
    $not_destroy_session = 1;
    include("../pixeladmin/includes/main_order.inc.php");
    /*
    $domain = "";
    if((isset($_SERVER["HTTP_HOST"])) && (!empty($_SERVER["HTTP_HOST"]))) {
        $domain = $_SERVER["HTTP_HOST"];    
    } else if((isset($_SERVER["SERVER_NAME"])) && (!empty($_SERVER["SERVER_NAME"]))) {
        $domain = $_SERVER["SERVER_NAME"];    
    } else {
        die("Unable to resolve domain name");
    }
    */
    $scheme = (isset($_SERVER['HTTPS']) && 'on' === $_SERVER['HTTPS'])?'https://':'http://';
    $domain_name = strtolower($_SERVER["SERVER_NAME"]);
    $domain = $scheme.$domain_name;
    define("SITE_URL", $domain . '/order/');
    
    $logged_user = Users::get_logged_user();
    $css = array(
        array('href' => SITE_URL. 'css/booking.css'),
        array('href' => SITE_URL. 'js/bootstrap-datetimepicker/bootstrap-datetimepicker.css')
    );

    $branches = $models->branch->get_list(array('select' => 'id,branch_name,branch_address,lat,lng'));
    $main_branch = $models->branch->get_details(LHP_BRANCH_ID);

    require_once(ABSOLUTE_PATH. 'models/common/ProductComponents.php');
    $models->product_component = new ProductComponents();
?>