<?php
    session_start();
    spl_autoload_register(function ($class) {
        require 'quanly-chutruong/models/' . $class . '.php';
    });
    
    if(isset($_POST['submitLogin'])){
        $loginModel = new loginModel;
        $taiKhoan = $_POST['taiKhoan'];
        $matKhau = md5($_POST['matKhau']);
       
        if($loginModel->dangNhap($taiKhoan,$matKhau) == true){
            $_SESSION['taiKhoan'] = $taiKhoan;
            //xu ly qua trang quanly-chutruong
            header('location:quanly-chutruong/view/giaydep.php');
        }
        else{
            echo "<script>alert('Thông tin hoặc tài khoản hoặc mật khẩu không đúng!');window.location.href='index.php'</script>";
        }
    }
    else{
        echo "<script>window.location.href='index.php'</script>";
    }

?>