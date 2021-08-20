<?php
    require_once 'database.php';
 class loginModel{
     function dangNhap($taiKhoan,$matKhau){
        $conn = new database;
        $query = mysqli_query($conn->conn(),"SELECT * FROM admin WHERE BINARY(TaiKhoan) = '".$taiKhoan."' AND BINARY(MatKhau) = '".$matKhau."' ");
        if(mysqli_num_rows($query) > 0){
            return true;
        }
     }
 }


?>