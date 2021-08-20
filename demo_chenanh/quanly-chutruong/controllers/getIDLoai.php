<?php
    require_once '../models/database.php';
     spl_autoload_register(function($class){
          require '../models/' . $class . ".php";
     });
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $loaiModel = new loaiModel;
        $body = "";
        foreach($loaiModel->getIDLoaiInfo($id) as $array){
            $body .= "  <input type='hidden'  name='idLoai' value='".$array['ID_LoaiGiayDep']."'>
                        <p>Tên :</p><input type='text' value='".$array['TenLoai']."' name='edtTenLoai' >
                        ";
            echo $body;
        }
    }
    if(isset($_GET['idDeleteTL'])){
        $id = $_GET['idDeleteTL'];
        $loaiModel = new loaiModel;
        $body = "";
        foreach($loaiModel->getIDLoaiInfo($id) as $array){
            $body .= "  <input type='hidden'  name='idDeleteTL' value='".$array['ID_LoaiGiayDep']."'>
                        <p>Bạn có chắc chắn xóa?</p>
                        ";
            echo $body;
        }
    }
?>