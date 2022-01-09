<?php 
    if (!session_id())
        session_start();
    
    $ip = $_SERVER['REMOTE_ADDR'];
    $allowed_ip = eModel::_select_one('allowed_ips', array('ip' => $ip));
    
    if(!$allowed_ip)
        die('Bạn không có quyền truy cập trang này.');
    
    
    if (!empty($_SESSION['wrong_auth'])){
        unset($_SERVER['PHP_AUTH_USER']);
        unset($_SERVER['PHP_AUTH_PW']);  
        unset($_SESSION['wrong_auth']);
    }
    if (!isset($_SERVER['PHP_AUTH_USER'])) {
        header('WWW-Authenticate: Basic realm="eFruit - Selling manager"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Bạn không có quyền truy cập trang này.';
        exit;
    } else {
        if($_SERVER['PHP_AUTH_USER'] != 'banhang' || $_SERVER['PHP_AUTH_PW'] != '12345e'){
            echo 'Tên đăng nhập hoặc mật khẩu không đúng.';
            $_SESSION['wrong_auth'] = 1;
            exit;
        }
    }
?>