<?php
    $conn = new mysqli("localhost","root","","demo_chenanh") or die('Connection Failed ' .mysqli_connect_error());// (tên serrver nôi bộ, tài khoản user, mât khâu,tên db)
    if(isset($_POST['submitChenAnh'])){
        $trangThai = $_POST['trangThai'];
        $fileUpload =$_FILES['fileUpload']['tmp_name'];
        $path = "public/images/" .  basename($_FILES['fileUpload']['name']);
        $fileName = $_FILES['fileUpload']['name'];
        if(getimagesize($fileUpload)){
            if(!file_exists($path)){
                if(move_uploaded_file($_FILES['fileUpload']['tmp_name'],$path)){
                    $query = mysqli_query($conn,"INSERT INTO anh VALUES(NULL,'$fileName','$trangThai')");
                    echo "them  thanh cong";
                }     
                else{
                    echo "Thêm không thành công";
                }
            }
            else{
                echo "Ảnh đa tồn taị";
            }
        }
        else{
            echo "Vui lòng chọn ảnh đung cấu trúc";
        }
        
    }
    // $product = new Product();
    // if(isset($_POST['submiT'])){
    //     $name = $_POST['name'];
    //     $manu = $_POST['manu_id'];
    //     $type = $_POST['type_id'];
    //     $fileName = $_FILES['fileUpload']['tmp_name'];
    //     $des = $_POST['description'];
    //     $price = $_POST['price'];
    //     $feature = $_POST['feature'];
    //     $create_at =date("Y/m/d");//xem lay ngay thang
    //     $path = "../images/" . basename($_FILES['fileUpload']['name']);
        
    //     if(getimagesize($fileName)){
    //         if(!file_exists($path)){
    //                 if($product->addProduct($name,$manu,$type,$price,$_FILES['fileUpload']['name'],$des,$feature)){
    //                     if(move_uploaded_file($_FILES['fileUpload']['tmp_name'],$path)){
    //                         echo "<script>alert('Thêm thành công')</script>";
    //                      }
    //                 }
    //                 else{
    //                     echo "<script>alert('Thêm không dc')</script>";
    //                 }
    //         }
    //         else{
    //             echo "<script>alert('Ảnh đã tồn tại')</script>";
               
    //         }
    //     }
    //     else{
    //         echo "<script>alert('Ảnh không hợp lệ')</script>";
    //     }

?>