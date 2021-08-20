<?php
 require_once '../models/database.php';
if(isset($_POST['submitThemTL'])){
    $tenLoai = $_POST['fillOutTenLoai'];
    if($productsModel->insertTenLoai($tenLoai) == true){
         echo "<script>alert('Đã thêm');window.location.href='../view/giaydep.php';</script>";
    }
    else{
         echo "<script>alert('Không thành công');window.location.href='../view/giaydep.php';</script>";
    }
}