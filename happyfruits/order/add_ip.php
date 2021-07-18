<?php 
    include("includes/order.inc.php");
    require_once(ABSOLUTE_PATH. 'models/common/Users.php');
    $user = Users::get_logged_user();
    if (!$user)
        die('Bạn chưa đăng nhập, vui lòng đăng nhập.');
    else{
        $ip = $_SERVER['REMOTE_ADDR'];
        if (eModel::_insert('allowed_ips', array('ip' => $ip, 'user_id' => $user['user_id'], 'created_dtm' => date('Y-m-d H:i:s'))))
            echo "<h2>IP của bạn ". $ip ." đã được thêm vào danh sách cho phép.</h2>";
    }
?>