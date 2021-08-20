<?php
    require_once 'database.php';
    class anhNoiBatModel extends database{
        function getIDLoai($idLoai){
            $conn = new database;
            $query = mysqli_query($conn->conn(),"SELECT ID_LoaiGiayDep FROM loaigiaydep WHERE ID_LoaiGiayDep = '".$idLoai."' ");
            $id = mysqli_fetch_assoc($query);
            return $id['ID_LoaiGiayDep'];
        }
        function getAllAnhNoiBat(){
            $conn = new database;
            $query = mysqli_query($conn->conn(),"SELECT * FROM anh_animation");
            return $query;
        }
        function getIDAnhNB($id){
            $conn = new database;
            $query = mysqli_query($conn->conn(),"SELECT * FROM anh_animation WHERE ID_Anh_Animation = '".$id."' ");
            return $query;
        }
        function getIDAnhNBByName($name){
            $conn = new database;
            $query = mysqli_query($conn->conn(),"SELECT ID_Anh_Animation FROM anh_animation WHERE TenAnh = '".$name."' ");
            $res = mysqli_fetch_assoc($query);
            return $res['ID_Anh_Animation'];
        }
        function getIDAnhNBByNameInfo($id){
            $conn = new database;
            $query = mysqli_query($conn->conn(),"SELECT * FROM anh_animation WHERE ID_Anh_Animation = '".$id."' ");
            return $query;
        }
        function themAnh($tenAnh){
            $trangThai = 0;
            $conn = new database;
            $query ="INSERT INTO anh_animation VALUES(NULL,'$tenAnh','$trangThai')";
            if(mysqli_query($conn->conn(),$query)){
                return true;
            }
            else{
                return false;
            }
            return $query;
        }
        function updateAnhNB($tenAnh,$id){
            $conn = new database();
            $query = "UPDATE anh_animation SET TenAnh = '".$tenAnh."' WHERE ID_Anh_Animation = '".$id."' " ;
            if(mysqli_query($conn->conn(),$query)){
                return true;
            }
        }
        function updateHienThi_1($id){
            $trangThai = 1;
            $conn = new database();
            $query = "UPDATE anh_animation SET TrangThai = '".$trangThai."' WHERE ID_Anh_Animation = '".$id."' " ;
            if(mysqli_query($conn->conn(),$query)){
                return true;
            }
        }
        function updateHienThi_0($id){
            $trangThai = 0;
            $conn = new database();
            $query = "UPDATE anh_animation SET TrangThai = '".$trangThai."' WHERE ID_Anh_Animation != '".$id."' " ;
            if(mysqli_query($conn->conn(),$query)){
                return true;
            }
        }
        function deleteAnhNB($id){
            $conn = new database();
            $query = "DELETE FROM anh_animation WHERE ID_Anh_Animation = '".$id."' " ;
            if(mysqli_query($conn->conn(),$query)){
                return true;
            }
        }
        function getTrangThai_1(){
            $conn = new database();
            $query = mysqli_query($conn->conn(),"SELECT * FROM anh_animation WHERE TrangThai = 1 " );
            $res = mysqli_fetch_assoc($query);
            return $res['TenAnh'];
        }
     }
?>