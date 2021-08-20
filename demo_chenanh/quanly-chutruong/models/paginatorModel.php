<?php
    require_once 'database.php';
    class paginatorModel extends database{
         //phan trang
          function layTongSoLuongGiayDep(){
            $conn = new database;
            $query = mysqli_query($conn->conn(),"SELECT * FROM giaydep");
            $tongSoLuong = mysqli_num_rows($query);
            return $tongSoLuong;
        }
         function paginatorIndexAdmin($numberPageCurrent){
            //limit , offset, url, numberPage, numberPageCurrent
            if($numberPageCurrent < 1){
                $numberPageCurrent = 1;
            }
            $limit = 3;
            $totalPage = ceil($this->layTongSoLuongGiayDep() / $limit); // 8 = > 3 trang
            $offset = ($numberPageCurrent - 1) * 3; //=>offset can hien
            $url = "";
           
            $pageNext = $numberPageCurrent + 1;
            $pagePrev = $numberPageCurrent - 1;
            if($pagePrev < 1){
                $pagePrev = 1;
            }
            else if($pageNext > $totalPage){
                $pageNext = $totalPage;
            }
            $first =  "<li><a style='padding:5px;color:black;' href='?page=1'>First</a></li>";;
            $last = "<li><a style='padding:5px;color:black;' href='?page=$totalPage'>Last</a></li>";
          
            $prev = "<li><a style='padding:5px;color:black;' href='?page=$pagePrev'><<</a></li>";
            $next = "<li><a style='padding:5px;color:black;' href='?page=$pageNext'>>></a></li>";
            //page bat dau
            for($i = 1; $i <= $totalPage; $i++){
                if($i != $numberPageCurrent){
                    if($i > $numberPageCurrent - 3 && $i < $numberPageCurrent + 3){
                        $url .= "<li><a href='?page=$i'>$i </a></li>";
                    }
                }
                else{
                    $url .= "<li><a style='background:dodgerblue;color:white' href='?page=$i'>$i </a></li>";
                }
            }
            return  $first . $prev . $url . $next . $last;
        }
        function paginatorAdmin($numberPageCurrent){
            if($numberPageCurrent < 1){
                $numberPageCurrent = 1;
            }
            $conn = new database;
            $totalPage = ceil($this->layTongSoLuongGiayDep() / 3); // 8 = > 3 trang
            $offset = ($numberPageCurrent - 1) * 3; //
            $query = mysqli_query($conn->conn(),"SELECT ID_GiayDep, TenGiayDep,Gia,Anh,tt.TenTrangThai,lgd.TenLoai,
            ThoiGianTao,XuatXu,ChatLieu FROM `giaydep` gd,loaigiaydep lgd,
             trangthai tt WHERE gd.`ID_TrangThai` = tt.ID_TrangThai AND gd.`ID_LoaiGiayDep` = lgd.`ID_LoaiGiayDep` LIMIT $offset,3");
            return $query;
        }
        /*paginator search admin*/
        function layTongSoLuongGiayDep_Query($name){
            $conn = new database;
            $query = mysqli_query($conn->conn(),"SELECT ID_GiayDep, TenGiayDep,Gia,Anh,tt.TenTrangThai,lgd.TenLoai,
            ThoiGianTao,XuatXu,ChatLieu FROM `giaydep` gd,loaigiaydep lgd,
             trangthai tt WHERE gd.`ID_TrangThai` = tt.ID_TrangThai AND gd.`ID_LoaiGiayDep` = lgd.`ID_LoaiGiayDep` AND 
             TenGiayDep LIKE '%".$name."%'");
            $tongSoLuong = mysqli_num_rows($query);
            if($tongSoLuong > 0){
                return $tongSoLuong;
            }
            else{
                echo "<script>alert('Không tìm thấy sản phẩm, hãy ghi đúng!');window.location.href='../view/giaydep.php'</script>";
            }
            
        }
        function paginatorSearchAdmin($numberPageCurrent,$name){
            if($numberPageCurrent < 1){
                $numberPageCurrent = 1;
            }
            $conn = new database;
            //$totalPage = ceil($this->layTongSoLuongGiayDep_Query($name) / 3); // 8 = > 3 trang
            $offset = ($numberPageCurrent - 1) * 3; //
            $query = mysqli_query($conn->conn(),"SELECT ID_GiayDep, TenGiayDep,Gia,Anh,tt.TenTrangThai,lgd.TenLoai,
            ThoiGianTao,XuatXu,ChatLieu FROM `giaydep` gd,loaigiaydep lgd,
             trangthai tt WHERE gd.`ID_TrangThai` = tt.ID_TrangThai AND gd.`ID_LoaiGiayDep` = lgd.`ID_LoaiGiayDep` AND 
             TenGiayDep LIKE '%".$name."%' LIMIT $offset,3");
            return $query;
        }
        function paginatorIndexAdmin_Search($numberPageCurrent,$name){
            //change the name param => replace space ( + tdc +++)
            //limit , offset, url, numberPage, numberPageCurrent
            if($numberPageCurrent < 1){
                $numberPageCurrent = 1;
            }
            $limit = 3;
            $totalPage = ceil($this->layTongSoLuongGiayDep_Query($name) / $limit); // 8 = > 3 trang
            $offset = ($numberPageCurrent - 1) * 3; //=>offset can hien
            $url = "";
           
            $pageNext = $numberPageCurrent + 1;
            $pagePrev = $numberPageCurrent - 1;
            if($pagePrev < 1){
                $pagePrev = 1;
            }
            else if($pageNext > $totalPage){
                $pageNext = $totalPage;
            }
            $first =  "<li><a style='padding:5px;color:black;' href='?search=$name&page=1'>First</a></li>";;
            $last = "<li><a style='padding:5px;color:black;' href='?search=$name&page=$totalPage'>Last</a></li>";
          
            $prev = "<li><a style='padding:5px;color:black;' href='?search=$name&page=$pagePrev'><<</a></li>";
            $next = "<li><a style='padding:5px;color:black;' href='?search=$name&page=$pageNext'>>></a></li>";
            //page bat dau
            for($i = 1; $i <= $totalPage; $i++){
                if($i != $numberPageCurrent){
                    if($i > $numberPageCurrent - 3 && $i < $numberPageCurrent + 3){
                        $url .= "<li><a href='?search=$name&page=$i'>$i </a></li>";
                    }
                }
                else{
                    $url .= "<li><a style='background:dodgerblue;color:white' href='?search=$name&page=$i'>$i </a></li>";
                }
            }
            return  $first . $prev . $url . $next . $last;
        }
    }
?>