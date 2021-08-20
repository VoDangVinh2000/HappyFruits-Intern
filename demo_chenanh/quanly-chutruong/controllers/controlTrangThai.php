<?php
  require_once '../models/database.php';
  spl_autoload_register(function($class){
    require '../models/' . $class . '.php';
  });
  $trangThaiModel = new trangThaiModel;
    if(isset($_POST['submitEditTrangThai'])){
        $tenTT = $_POST['edtTenTrangThai'];
        $id = $_POST['idTrangThai'];
        if($trangThaiModel->updateTrangThai($id,$tenTT)){
            echo "<script>alert('Đã sửa');window.location.href='../view/giaydep.php';</script>";
        }
        else{
            echo "<script>alert('Không sửa được');window.location.href='../view/giaydep.php';</script>";
        }
    }
    else if(isset($_POST['submitDeleteTT'])){
        $id = $_POST['idDeleteTT'];
        $row_numbers = mysqli_num_rows($trangThaiModel->getRowRecord($id));
        if($row_numbers > 0){
            echo "<script>alert('Còn mặt hàng sử dụng trạng thái này, không thể xóa');window.location.href='../view/giaydep.php';</script>";
        }
        else{
            if($trangThaiModel->deleteTrangThai($id)){
                echo "<script>alert('Đã xóa');window.location.href='../view/giaydep.php';</script>";
            }
        }
    }


?>