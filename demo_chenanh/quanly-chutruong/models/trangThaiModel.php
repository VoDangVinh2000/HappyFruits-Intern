<?php
require_once 'database.php';
class trangThaiModel extends database{
        function getIDTrangThai($idTrangThai){
            $conn = new database;
            $query = mysqli_query($conn->conn(),"SELECT ID_TrangThai FROM trangthai WHERE ID_TrangThai = '".$idTrangThai."' ");
            $id = mysqli_fetch_assoc($query);
            return $id['ID_TrangThai'];
        }
        function getIDTrangThaiInfo($id){
            $conn = new database;
            $query = mysqli_query($conn->conn(),"SELECT * FROM trangthai WHERE ID_TrangThai = '".$id."' ");
            return $query;
        }
        function getAllTrangThai(){
            $conn = new database;
            $query = mysqli_query($conn->conn(),"SELECT * FROM trangthai");
            return $query;
        }
        function deleteTrangThai($id){
            $conn = new database;
            $query = "DELETE FROM trangthai WHERE ID_TrangThai = '".$id."' ";
            if(mysqli_query($conn->conn(),$query)){
                return true;
            }
        }
        function updateTrangThai($id,$tenTT){
            $conn = new database;
            $query = "UPDATE trangthai SET TenTrangThai = '".$tenTT."' WHERE ID_TrangThai = '".$id."' ";
            if(mysqli_query($conn->conn(),$query)){
                return true;
            }
        }
        function getRowRecord($id){
            $conn = new database;
            $query = mysqli_query($conn->conn(),"SELECT * FROM trangthai tt, giaydep gd WHERE gd.ID_TrangThai = tt.ID_TrangThai
            AND  gd.ID_TrangThai = '".$id."' ");
            return $query;
        }
}
?>