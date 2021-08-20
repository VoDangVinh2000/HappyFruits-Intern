<?php
    require_once '../models/anhNoiBatModel.php';
    if(isset($_POST['submitLuuHienThi'])){
        
        $anhNBModel = new anhNoiBatModel;
        $idGender = $_POST['gender'];
        if($anhNBModel->updateHienThi_1($idGender) == true){
            if($anhNBModel->updateHienThi_0($idGender) == true){
                echo "<script>alert('Đã lưu ảnh cần hiển thị');window.location.href='../view/giaydep.php'</script>";
            }
            else{
                echo "<script>alert('Có lỗi, vui lòng liên hệ coder');window.location.href='../view/giaydep.php'</script>";
            }
        }
        else{
            echo "<script>alert('Có lỗi, vui lòng liên hệ coder');window.location.href='../view/giaydep.php'</script>";
        }
    }
    else{
        header('location:../view/giaydep.php');
    }



?>