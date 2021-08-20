<?php
    require_once 'database.php';
    class loaiModel extends database{
        function getIDLoai($idLoai){
            $conn = new database;
            $query = mysqli_query($conn->conn(),"SELECT ID_LoaiGiayDep FROM loaigiaydep WHERE ID_LoaiGiayDep = '".$idLoai."' ");
            $id = mysqli_fetch_assoc($query);
            return $id['ID_LoaiGiayDep'];
        }
        function getAllLoai(){
            $conn = new database;
            $query = mysqli_query($conn->conn(),"SELECT * FROM loaigiaydep");
            return $query;
        }
        function getIDLoaiInfo($id){
            $conn = new database;
            $query = mysqli_query($conn->conn(),"SELECT * FROM loaigiaydep WHERE ID_LoaiGiayDep = '".$id."' ");
            return $query;
        }
        function updateLoai($id,$tenTL){
            $conn = new database;
            $query = "UPDATE loaigiaydep SET TenLoai = '".$tenTL."' WHERE ID_LoaiGiayDep = '".$id."' ";
            if(mysqli_query($conn->conn(),$query)){
                return true;
            }
        }
        function getRowRecord($id){
            $conn = new database;
            $query = mysqli_query($conn->conn(),"SELECT * FROM loaigiaydep lgd, giaydep gd WHERE gd.ID_LoaiGiayDep
             = lgd.ID_LoaiGiayDep AND  gd.ID_LoaiGiayDep = '".$id."' ");
            return $query;
        }
        function deleteLoai($id){
            $conn = new database;
            $query = "DELETE FROM loaigiaydep WHERE ID_LoaiGiayDep = '".$id."' ";
            if(mysqli_query($conn->conn(),$query)){
                return true;
            }
        }
     }
?>