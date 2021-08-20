<?php
    require_once 'database.php';
    class productsModel extends database{
        function selectAllProducts(){
            $conn = new database;
                $query = mysqli_query($conn->conn(),"SELECT ID_GiayDep,tt.ID_TrangThai,lgd.ID_LoaiGiayDep, TenGiayDep,Gia,Anh,tt.TenTrangThai,lgd.TenLoai,
                ThoiGianTao,XuatXu,ChatLieu FROM `giaydep` gd,loaigiaydep lgd,
                trangthai tt WHERE gd.`ID_TrangThai` = tt.ID_TrangThai AND gd.`ID_LoaiGiayDep` = lgd.`ID_LoaiGiayDep`");
            return $query;
        }
        function getIDProduct($id){
            $conn = new database;
            // $conn = new Database();
            // $query =  mysqli_query($conn->connectDatabase(),"SELECT * FROM douong WHERE ID_Douong = '".$id."'  ");
            // return $query;
            $query =mysqli_query($conn->conn(),"SELECT gd.ID_GiayDep,tt.ID_TrangThai,lgd.ID_LoaiGiayDep, gd.TenGiayDep,gd.Gia,gd.Anh,tt.TenTrangThai,lgd.TenLoai,
            gd.ThoiGianTao,gd.XuatXu,gd.ChatLieu FROM `giaydep` gd,loaigiaydep lgd,
             trangthai tt WHERE gd.`ID_TrangThai` = tt.ID_TrangThai AND gd.`ID_LoaiGiayDep` = lgd.`ID_LoaiGiayDep`
             AND gd.ID_GiayDep = '".$id."'  ");

            return $query;
        }
        function insertProduct($tenGiayDep,$anh,$gia,$idTrangThai,$idLoai,$xuatXu,$chatLieu){
            $conn = new database();
            $date = date('Y-m-d');
            $query = "INSERT INTO giaydep VALUES(NULL,'$tenGiayDep',
            '$anh','$gia','$idTrangThai','$idLoai','$date','$xuatXu','$chatLieu')";
            if(mysqli_query($conn->conn(),$query)){
                return true;
            }   
        }
        function insertTrangThai($trangThai){
            $conn = new database();
            $query = "INSERT INTO trangthai VALUES (NULL,'$trangThai')";
            if(mysqli_query($conn->conn(),$query)){
                return true;
            }
        } 
        function insertTenLoai($tenLoai){
            $conn = new database();
            $query = "INSERT INTO loaigiaydep VALUES (NULL,'$tenLoai')";
            if(mysqli_query($conn->conn(),$query)){
                return true;
            }
        }
        function updateGiayDep($id,$tenGiayDep,$anh,$gia,$trangThai,$loai,$xx,$cl){
            $conn = new database();
            $query = "UPDATE giaydep SET TenGiayDep = '".$tenGiayDep."' , Anh = '".$anh."',Gia = '".$gia."' , ID_TrangThai = '".$trangThai."' 
            , ID_LoaiGiayDep = '".$loai."' , XuatXu = '".$xx."', ChatLieu = '".$cl."'
            WHERE ID_GiayDep = '".$id."' ";
            if(mysqli_query($conn->conn(),$query)){
                return true;
            }
        }
        function deleteGiayDep($id){
            $conn = new database();
            $query = "DELETE FROM giaydep WHERE ID_GiayDep = '".$id."' ";
            if(mysqli_query($conn->conn(),$query)){
                return true;
            }
        }
    }
?>