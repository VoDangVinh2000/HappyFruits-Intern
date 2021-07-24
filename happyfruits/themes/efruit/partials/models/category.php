<?php
    class category extends database{
        //chưa sử dụng
        function getCategoriesById($id){
            $conn = new database;
            $query = mysqli_query($conn->connectDatabase(),"SELECT * FROM categories WHERE category_id = '".$id."' ");
            return $query;
        }

        function getProductByCategoryId($id){
            $conn = new database;
            $query = mysqli_query($conn->connectDatabase(),"SELECT * FROM products WHERE category_id = '".$id."' ");
            return $query;
        }

        //select table menus
        function getItemsOfMenus(){
            $conn = new database;
            $query = mysqli_query($conn->connectDatabase(),"SELECT * FROM menus ");
            return $query;
        }
        function traiCayDacSanViet(){
            $conn = new database;
            $query = mysqli_query($conn->connectDatabase(),"SELECT * FROM products WHERE category_id = '".$id."' ");
            return $query;
        }
    }
?>