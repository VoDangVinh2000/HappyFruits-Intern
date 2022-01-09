<?php
    class database{
        //chưa sử dụng
        protected $conn;
        function connectDatabase(){
            $this->conn = new mysqli("localhost","efruit_db","x7VsY7uC27QL","happyfruit_db") or die('Connection Failed :' .mysqli_connect_error());
            return $this->conn; 
        }
    }
?>