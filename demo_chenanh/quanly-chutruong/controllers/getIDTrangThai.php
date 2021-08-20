<?php
    require_once '../models/database.php';
     spl_autoload_register(function($class){
          require '../models/' . $class . ".php";
     });
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $trangThaiModel = new trangThaiModel;
        $body = "";
        foreach($trangThaiModel->getIDTrangThaiInfo($id) as $array){
            $body .= "  <input type='hidden'  name='idTrangThai' value='".$array['ID_TrangThai']."'>
                        <p>Tên :</p><input type='text' value='".$array['TenTrangThai']."' name='edtTenTrangThai' >
                        ";
            echo $body;
        }
    }
    if(isset($_GET['idDeleteTT'])){
        $id = $_GET['idDeleteTT'];
        $trangThaiModel = new trangThaiModel;
        $body = "";
        foreach($trangThaiModel->getIDTrangThaiInfo($id) as $array){
            $body .= "  <input type='hidden'  name='idDeleteTT' value='".$array['ID_TrangThai']."'>
                        <p>Bạn có chắc chắn xóa?</p>
                        ";
            echo $body;
        }
    }
?>