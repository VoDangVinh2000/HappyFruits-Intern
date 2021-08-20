<?php
    class database{
        protected static $conn;
        function conn(){
            $kiemTra = false;
            $conn = new mysqli("localhost","root","","qly_giaydep") or die('Connection Failed' . mysqli_connect_error());
           
        
            return $conn;
        }
        

    }


?>