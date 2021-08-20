<?php 
    session_start();
    if(isset($_POST['submitDangXuat'])){
        unset($_SESSION['taiKhoan']);
        echo "<script>window.location.href='../login.php'</script>";
    }
    else{
        echo "<script>window.location.href='../login.php'</script>";
    }


?>