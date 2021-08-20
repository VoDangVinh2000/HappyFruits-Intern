<?php
  require_once '../models/database.php';
  spl_autoload_register(function($class){
    require '../models/' . $class . '.php';
  });
  $productModel = new productsModel;
  $trangThaiModel = new trangThaiModel;
  $loaiModel = new loaiModel;
    //trang nay chi de sua va xoas
 if(isset($_POST['submitEditGiayDep'])){
    
      $id = $_POST['idGiayDep'];
      $tenGiayDep = $_POST['editTen'];
      $fileTmp ="";$fileName ="";
      if(isset($_FILES['anhEdit']['tmp_name']) && $_FILES['anhEdit']['name']){
        $fileTmp = $_FILES['anhEdit']['tmp_name'];
         $fileName = $_FILES['anhEdit']['name'];
      }
      
      $gia = $_POST['editGia'];
      $trangThai = $_POST['editTrangThai'];
      $loai = $_POST['editLoai'];
      $xuatXu = $_POST['editXuatXu'];
      $chatLieu = $_POST['editChatLieu']; 
      if(!empty($productModel->getIDProduct($id))){
        foreach($productModel->getIDProduct($id) as $array){
          $anhHienTai = $array['Anh'];
          $anhCu = "../../public/images/" . $array['Anh'];
          if(empty($fileTmp)){
            //$id,$tenGiayDep,$anh,$gia,$trangThai,$loai,$xx,$cl
              if($productModel->updateGiayDep($id,$tenGiayDep,$anhHienTai,$gia,$trangThai,$loai,$xuatXu,$chatLieu) == true){
                echo "<script>alert('Đã sửa');window.location.href='../view/giaydep.php';</script>";
              }
              else{
                echo "<script>alert('Không sửa được');window.location.href='../view/giaydep.php';</script>";
              }
          }
          else{
              if(exif_imagetype($fileTmp)){
                  if(file_exists($anhCu)){
                    unlink($anhCu);
                  }
                  $path = "../../public/images/" . basename($fileName);
                  if($productModel->updateGiayDep($id,$tenGiayDep,$fileName,$gia,$trangThai,$loai,$xuatXu,$chatLieu) == true){
                      if(move_uploaded_file($fileTmp,$path)){
                          echo "<script>alert('Đã sửa');window.location.href='../view/giaydep.php';</script>";
                      }
                  }
                  else{
                    echo "<script>alert('Không sửa được');window.location.href='../view/giaydep.php';</script>";
                  }
              }
              else{
                  echo "<script>alert('Vui lòng chọn đúng cấu trúc file ảnh');window.location.href='../view/giaydep.php';</script>";
              }
          }
        }
    }
  }
  else if(isset($_POST['submitDeleteGD'])){
    $idDelete = $_POST['idDelete'];
     foreach($productModel->getIDProduct($idDelete) as $array){
       $path = "../../public/images/" . basename($array['Anh']);
      if($productModel->deleteGiayDep($idDelete) == true){
          if(file_exists($path)){
            unlink($path);
          }
          echo "<script>alert('Đã xóa');window.location.href='../view/giaydep.php';</script>";
      }
      else{
        echo "<script>alert('Không xóa được');window.location.href='../view/giaydep.php';</script>";
      }
    }
  }
