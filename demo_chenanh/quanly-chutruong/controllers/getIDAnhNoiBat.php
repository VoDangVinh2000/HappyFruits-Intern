<?php
    require_once '../models/database.php';
     spl_autoload_register(function($class){
          require '../models/' . $class . ".php";
     });
     $anhNBModel = new anhNoiBatModel;
    if(isset($_GET['idAnhNB'])){
        $id = $_GET['idAnhNB'];
        
        $body = "";
        foreach($anhNBModel->getIDAnhNB($id) as $array){
            $body .= "  <input type='hidden'  name='idAnhNB' value='".$array['ID_Anh_Animation']."'>
                        <p>Tên :</p><input type='file' value='".$array['TenAnh']."' name='edtAnhNB' required >
                        <p>Ảnh :</p><img style='width: 90px;height:120px' src= '../../public/imagesAnhNoiBat/".$array['TenAnh']."'> 
                        ";
            echo $body;
        }
    }
    else if(isset($_GET['idDeleteAnhNB'])){
        $id = $_GET['idDeleteAnhNB'];
        $body = "";
        foreach($anhNBModel->getIDAnhNB($id) as $array){
            $body .= "  <input type='hidden'  name='idDeleteAnhNB' value='".$array['ID_Anh_Animation']."'>
                        <p>Bạn có chắc chắn xóa?</p>
                        ";
            echo $body;
        }
    }
    else if(isset($_GET['idCheckRadio'])){
        $id = $_GET['idCheckRadio'];
        $body = "";
        foreach($anhNBModel->getIDAnhNB($id) as $array){
            $body .= "  <td><input type='hidden'  name='idAfterCheckRadio' value='".$array['ID_Anh_Animation']."'></td>
                        ";
            echo $body;
        }
    }
?>