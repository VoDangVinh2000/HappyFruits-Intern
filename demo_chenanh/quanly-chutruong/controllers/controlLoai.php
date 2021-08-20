<?php
  require_once '../models/database.php';
  spl_autoload_register(function($class){
    require '../models/' . $class . '.php';
  });
  $loaiModel = new loaiModel;
    if(isset($_POST['submitEditLoai'])){
        $tenLoai = $_POST['edtTenLoai'];
        $id = $_POST['idLoai'];
        if($loaiModel->updateLoai($id,$tenLoai)){
            echo "<script>alert('Đã sửa');window.location.href='../view/giaydep.php';</script>";
        }
        else{
            echo "<script>alert('Không sửa được');window.location.href='../view/giaydep.php';</script>";
        }
    }
    else if(isset($_POST['submitDeleteLoai'])){
        $id = $_POST['idDeleteTL'];
        $row_numbers = mysqli_num_rows($loaiModel->getRowRecord($id));
        if($row_numbers > 0){
            echo "<script>alert('Còn mặt hàng sử dụng trạng thái này, không thể xóa');window.location.href='../view/giaydep.php';</script>";
        }
        else{
            if($loaiModel->deleteLoai($id)){
                echo "<script>alert('Đã xóa');window.location.href='../view/giaydep.php';</script>";
            }
        }
    }


?>