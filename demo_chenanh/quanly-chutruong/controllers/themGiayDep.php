<?php
     spl_autoload_register(function($class){
          require '../models/' . $class . '.php';
     });
     
 if(isset($_POST['submitThem'])){
     $productsModel = new productsModel();
     $trangThaiModel = new trangThaiModel;
     $loaiModel = new loaiModel;
    $tenGiayDep = $_POST['TenGiayDep'];
    $gia = $_POST['Gia'];
    $trangThai = $_POST['trangThai'];
    $loai = $_POST['tenLoai'];
    $idTT = $trangThaiModel->getIDTrangThai($trangThai);
    $idTL = $loaiModel->getIDLoai($loai);
    $xuatXu = $_POST['xuatXu'];
    $chatLieu = $_POST['chatLieu'];
    $fileTmp = $_FILES['fileAnh']['tmp_name'];
    $pathMove = "../../public/images/" . basename($_FILES['fileAnh']['name']);
    //$tenGiayDep,$anh,$gia,$idTrangThai,$idLoai,$xuatXu,$chatLieu
    if(isset($fileTmp) || empty($fileTmp)){
         if(exif_imagetype($fileTmp)){
              if(!file_exists($pathMove)){
                   if($productsModel->insertProduct($tenGiayDep,$_FILES['fileAnh']['name'],$gia,$idTT,$idTL,$xuatXu,$chatLieu) == true){
                        if(move_uploaded_file($fileTmp,$pathMove)){
                             echo "<script>alert('Đã thêm');window.location.href='../view/giaydep.php';</script>";
                        }
                   }
              }
              else{
                   echo "<script>alert('Anh nay da ton tai, vui long chon anh khac');window.location.href='../view/giaydep.php';</script>";
              }
         }
         else{
              echo "<script>alert('Vui long chon dung cau truc file Anh');window.location.href='../view/giaydep.php';</script>";
         }
    }
    //window.location.href='../view/giaydep.php';
}
?>