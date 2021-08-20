<?php
require_once '../models/database.php';
spl_autoload_register(function ($class) {
    require '../models/' . $class . '.php';
});
$anhNoiBatModel = new anhNoiBatModel;
if (isset($_POST['submitThemAnhNB'])) {
    $file = $_FILES['fileAnhNoiBat']['tmp_name'];
    $pathMove = "../../public/imagesAnhNoiBat/" . basename($_FILES['fileAnhNoiBat']['name']);
    if (isset($file) || empty($file)) {
        if (exif_imagetype($file)) {
            if (!file_exists($pathMove)) {
                if ($anhNoiBatModel->themAnh($_FILES['fileAnhNoiBat']['name']) == true) {
                    if (move_uploaded_file($file, $pathMove)) {
                        echo "<script>alert('Đã thêm');window.location.href='../view/giaydep.php';</script>";
                    }
                }
            } else {
                echo "<script>alert('Ảnh này đã tồn tại, vui lòng chọn ảnh khác');window.location.href='../view/giaydep.php';</script>";
            }
        } else {
            echo "<script>alert('Vui lòng chọn đúng cấu trúc file ảnh');window.location.href='../view/giaydep.php';</script>";
        }
    }
}
//submitEditAnhNB
else if (isset($_POST['submitEditAnhNB'])) {
    $file = $_FILES['edtAnhNB']['tmp_name'];
    $pathMove = "../../public/imagesAnhNoiBat/" . basename($_FILES['edtAnhNB']['name']);
    $idAnh = $_POST['idAnhNB'];
    //echo $_FILES['edtAnhNB']['name'];
    foreach ($anhNoiBatModel->getIDAnhNBByNameInfo($idAnh) as $array) {
        $anhHienTai = $array['TenAnh'];
        $anhCu = "../../public/imagesAnhNoiBat/" . $array['TenAnh'];
        if (exif_imagetype($file)) {
            if (file_exists($anhCu)) {
                unlink($anhCu);
            }
            $path = "../../public/imagesAnhNoiBat/" . basename($_FILES['edtAnhNB']['name']);
            if ($anhNoiBatModel->updateAnhNB($_FILES['edtAnhNB']['name'], $idAnh) == true) {
                if (move_uploaded_file($file, $path)) {
                    echo "<script>alert('Đã sửa');window.location.href='../view/giaydep.php';</script>";
                }
            } else {
                echo "<script>alert('Không sửa được');window.location.href='../view/giaydep.php';</script>";
            }
        } else {
            echo "<script>alert('Vui lòng chọn đúng cấu trúc file ảnh');window.location.href='../view/giaydep.php';</script>";
        }
    }
}

else if (isset($_POST['submitDeleteAnhNB'])) {
    $id = $_POST['idDeleteAnhNB'];
    foreach($anhNoiBatModel->getIDAnhNB($id) as $array){
        $anhHienTai = "../../public/imagesAnhNoiBat/" . $array['TenAnh'];
        if(file_exists($anhHienTai)){
            unlink($anhHienTai);
        }
        if($anhNoiBatModel->deleteAnhNB($id) == true){
            echo "<script>alert('Đã xóa');window.location.href='../view/giaydep.php';</script>";
        }
        else{
            echo "<script>alert('Không thể xóa');window.location.href='../view/giaydep.php';</script>";
        }
    }
    
}
