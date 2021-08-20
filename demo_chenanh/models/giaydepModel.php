<?php
    require_once 'database.php';
 class giaydepModel extends database{
   
    // function getPriceQuery_1($chooseNumber){
    //     $conn = new database;
    //     $query = "SELECT * FROM giaydep WHERE Gia <= 200000";
    //     return $query;
    // }
    function getIDProduct($id){
      $conn = new database;
      $query =mysqli_query($conn->conn(),"SELECT gd.ID_GiayDep,tt.ID_TrangThai,lgd.ID_LoaiGiayDep, gd.TenGiayDep,gd.Gia,gd.Anh,tt.TenTrangThai,lgd.TenLoai,
      gd.ThoiGianTao,gd.XuatXu,gd.ChatLieu FROM `giaydep` gd,loaigiaydep lgd,
       trangthai tt WHERE gd.`ID_TrangThai` = tt.ID_TrangThai AND gd.`ID_LoaiGiayDep` = lgd.`ID_LoaiGiayDep`
       AND gd.ID_GiayDep = '".$id."'  ");

      return $query;
  }
 }
 ?>