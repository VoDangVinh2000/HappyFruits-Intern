<?php
    require_once 'database.php';
    class paginatorModel extends database{
          //chọn theo giá nên phải phân trang cho từng loại giá vì phải query theo giá
          //paginator query gia chooose = full
          
           //paginator query gia choose = 1
        function layTongSoLuongGiaQuery_1(){
            $query = mysqli_query(conn(),"SELECT * FROM giaydep WHERE Gia BETWEEN 0 AND 250000");
            $tongSoLuong = mysqli_num_rows($query);
            return $tongSoLuong;
        }
        function paginatorIndex_1($numberPageCurrent){
            if($numberPageCurrent < 1){
                $numberPageCurrent = 1;
            }
            //limit , offset, url, numberPage, numberPageCurrent
            $limit = 6;
            $totalPage = ceil($this->layTongSoLuongGiaQuery_1() / $limit); // 8 = > 2 trang
            //$offset = ($numberPageCurrent - 1) * 6; //=>offset can hien
            $url = "";
            $pageNext = $numberPageCurrent + 1;
            $pagePrev = $numberPageCurrent - 1;
            if($pagePrev < 1){
                $pagePrev = 1;
            }
             if($pageNext > $totalPage){
                $pageNext = $totalPage;
            }
            $first =  "<li><a style='padding:5px;color:black;' href='chooseQuery.php?Price=1&page=1'>First</a></li>";;
            $last = "<li><a style='padding:5px;color:black;' href='chooseQuery.php?Price=1&page=$totalPage'>Last</a></li>";;
            $prev = "<li><a style='padding:5px;color:black;' href='chooseQuery.php?Price=1&page=$pagePrev'><<</a></li>";
            $next = "<li><a style='padding:5px;color:black;' href='chooseQuery.php?Price=1&page=$pageNext'>>></a></li>";
            for($i = 1; $i <= $totalPage; $i++){
                if($numberPageCurrent != $i){
                    if($i > $numberPageCurrent - 3 && $i < $numberPageCurrent + 3){
                        $url .= "<li><a href='chooseQuery.php?Price=1&page=$i'>$i</a></li>";
                    }
                }
                else{
                    $url .= "<li><a style='background:dodgerblue;color:white' href='chooseQuery.php?Price=1&page=$i'>$i</a></li>";
                }
            }
            // echo ;
            if($totalPage > 0){
                echo $first . $prev . $url . $next . $last;
            }
            else{
                echo "<script>alert('Hiện chưa có sản phẩm có giá tương ứng');window.location.href='index.php'</script>";
            }
            // return true;
        }
        function paginator_1($numberPageCurrent){
            if($numberPageCurrent < 1){
                $numberPageCurrent = 1;
            }
            //$totalPage = ceil($this->layTongSoLuongGiaQuery_1() / 3); // 8 = > 3 trang
            $offset = ($numberPageCurrent - 1) * 6; //
            $query = mysqli_query(conn(),"SELECT * FROM giaydep WHERE Gia BETWEEN 0 AND 250000 LIMIT $offset,6");
            return $query;
        }
        //paginator query gia choose = 2
        function layTongSoLuongGiaQuery_2(){
            $query = mysqli_query(conn(),"SELECT * FROM giaydep WHERE Gia BETWEEN 250000 AND 500000");
            $tongSoLuong = mysqli_num_rows($query);
            return $tongSoLuong;
        }
        function paginatorIndex_2($numberPageCurrent){
            if($numberPageCurrent < 1){
                $numberPageCurrent = 1;
            }
            //limit , offset, url, numberPage, numberPageCurrent
            $limit = 6;
            $totalPage = ceil($this->layTongSoLuongGiaQuery_2() / $limit); // 8 = > 3 trang
            //$offset = ($numberPageCurrent - 1) * 3; //=>offset can hien
            $url = "";
            $pageNext = $numberPageCurrent + 1;
            $pagePrev = $numberPageCurrent - 1;
            if($pagePrev < 1){
                $pagePrev = 1;
            }
             if($pageNext > $totalPage){
                $pageNext = $totalPage;
            }
            $first =  "<li><a style='padding:5px;color:black;' href='chooseQuery.php?Price=2&page=1'>First</a></li>";;
            $last = "<li><a style='padding:5px;color:black;' href='chooseQuery.php?Price=2&page=$totalPage'>Last</a></li>";;
            $prev = "<li><a style='padding:5px;color:black;' href='chooseQuery.php?Price=2&page=$pagePrev'><<</a></li>";
            $next = "<li><a style='padding:5px;color:black;' href='chooseQuery.php?Price=2&page=$pageNext'>>></a></li>";
            for($i = 1; $i <= $totalPage; $i++){
                if($numberPageCurrent != $i){
                    if($i > $numberPageCurrent - 3 && $i < $numberPageCurrent + 3){
                        $url .= "<li><a href='chooseQuery.php?Price=2&page=$i'>$i</a></li>";
                    }
                }
                else{
                    $url .= "<li><a style='background:dodgerblue;color:white' href='chooseQuery.php?Price=2&page=$i'>$i</a></li>";
                }    
            }
            if($totalPage > 0){
                echo $first . $prev . $url . $next . $last;
            }
            else{
                echo "<script>alert('Hiện chưa có sản phẩm có giá tương ứng');window.location.href='index.php'</script>";
            }
        }
        function paginator_2($numberPageCurrent){
            if($numberPageCurrent < 1){
                $numberPageCurrent = 1;
            }
            //$totalPage = ceil($this->layTongSoLuongGiaQuery_2() / 3); // 8 = > 3 trang
            $offset = ($numberPageCurrent - 1) * 6; //
            $query = mysqli_query(conn(),"SELECT * FROM giaydep WHERE Gia BETWEEN 250000 AND 500000 LIMIT $offset,6");
            return $query;
        }
        //pginator query gia choose = 3
        function layTongSoLuongGiaQuery_3(){
            $query = mysqli_query(conn(),"SELECT * FROM giaydep WHERE Gia BETWEEN 500000 AND 1000000");
            $tongSoLuong = mysqli_num_rows($query);
            return $tongSoLuong;
        }
        function paginatorIndex_3($numberPageCurrent){
            $limit = 6;
            
            $offset = ($numberPageCurrent - 1) * 3; //=>offset can hien
            $url = "";
            $totalPage = ceil($this->layTongSoLuongGiaQuery_3() / $limit); // 8 = > 2 trang
            if($numberPageCurrent < 1){
                $numberPageCurrent = 1;
            }
            //limit , offset, url, numberPage, numberPageCurrent
           
            $pageNext = $numberPageCurrent + 1;
            $pagePrev = $numberPageCurrent - 1;
            if($pagePrev < 1){
                $pagePrev = 1;
            }
            if($pageNext > $totalPage){
                $pageNext = $totalPage;
            }
            $first =  "<li><a style='padding:5px;color:black;' href='chooseQuery.php?Price=3&page=1'>First</a></li>";;
            $last = "<li><a style='padding:5px;color:black;' href='chooseQuery.php?Price=3&page=$totalPage'>Last</a></li>";;
            $prev = "<li><a style='padding:5px;color:black;' href='chooseQuery.php?Price=3&page=$pagePrev'><<</a></li>";
            $next = "<li><a style='padding:5px;color:black;' href='chooseQuery.php?Price=3&page=$pageNext'>>></a></li>";
            for($i = 1; $i <= $totalPage; $i++){
                if($numberPageCurrent != $i){
                    if($i > $numberPageCurrent - 3 && $i < $numberPageCurrent + 3){
                        $url .= "<li><a href='chooseQuery.php?Price=3&page=$i'>$i</a></li>";
                    }
                }
                else{
                    $url .= "<li><a style='background:dodgerblue;color:white' href='chooseQuery.php?Price=3&page=$i'>$i</a></li>";
                }   
            }
            if($totalPage > 0){
                echo $first . $prev . $url . $next . $last;
            }
            else{
                echo "<script>alert('Hiện chưa có sản phẩm có giá tương ứng');window.location.href='index.php'</script>";
            }
        }
        function paginator_3($numberPageCurrent){
            //$totalPage = ceil($this->layTongSoLuongGiaQuery_3() / 3); // 8 = > 2 trang
            $offset = ($numberPageCurrent - 1) * 6; //
            $query = mysqli_query(conn(),"SELECT * FROM giaydep WHERE Gia BETWEEN 500000 AND 1000000 LIMIT $offset,6");
            return $query;
        }
        //paginator query gia choose = 4
        function layTongSoLuongGiaQuery_4(){
            $query = mysqli_query(conn(),"SELECT * FROM giaydep WHERE Gia > 1000000");
            $tongSoLuong = mysqli_num_rows($query);
            return $tongSoLuong;
        }
        function paginatorIndex_4($numberPageCurrent){
            if($numberPageCurrent < 1){
                $numberPageCurrent = 1;
            }
            //limit , offset, url, numberPage, numberPageCurrent
            $limit = 6;
            $totalPage = ceil($this->layTongSoLuongGiaQuery_4() / $limit); // 8 = > 2 trang
            //$offset = ($numberPageCurrent - 1) * 3; //=>offset can hien
            $url = "";
            $pageNext = $numberPageCurrent + 1;
            $pagePrev = $numberPageCurrent - 1;
            if($pagePrev < 1){
                $pagePrev = 1;
            }
             if($pageNext > $totalPage){
                $pageNext = $totalPage;
            }
            $first =  "<li><a style='padding:5px;color:black;' href='chooseQuery.php?Price=4&page=1'>First</a></li>";;
            $last = "<li><a style='padding:5px;color:black;' href='chooseQuery.php?Price=4&page=$totalPage'>Last</a></li>";;
            $prev = "<li><a style='padding:5px;color:black;' href='chooseQuery.php?Price=4&page=$pagePrev'><<</a></li>";
            $next = "<li><a style='padding:5px;color:black;' href='chooseQuery.php?Price=4&page=$pageNext'>>></a></li>";
            for($i = 1; $i <= $totalPage; $i++){
                if($numberPageCurrent != $i){
                    if($i > $numberPageCurrent - 3 && $i < $numberPageCurrent + 3){
                        $url .= "<li><a href='chooseQuery.php?Price=4&page=$i'>$i</a></li>";
                    }
                }
                else{
                    $url .= "<li><a style='background:dodgerblue;color:white' href='chooseQuery.php?Price=4&page=$i'>$i</a></li>";
                }
            }
            if($totalPage > 0){
                echo $first . $prev . $url . $next . $last;
            }
            else{
                echo "<script>alert('Hiện chưa có sản phẩm có giá tương ứng');window.location.href='index.php'</script>";
            }
        }
        function paginator_4($numberPageCurrent){
            if($numberPageCurrent < 1){
                $numberPageCurrent = 1;
            }
            //$totalPage = ceil($this->layTongSoLuongGiaQuery_4() / 3); // 8 = > 2 trang
            $offset = ($numberPageCurrent - 1) * 6; //
            $query = mysqli_query(conn(),"SELECT * FROM giaydep WHERE Gia > 1000000 LIMIT $offset,6");
            return $query;
        }
        //paginator search customer
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
                echo "<script>window.location.href='index.php';</script>";
            }
        }
        function paginatorSearch_Customer($numberPageCurrent,$name){
            if($numberPageCurrent < 1){
                $numberPageCurrent = 1;
            }
            $conn = new database;
            //$totalPage = ceil($this->layTongSoLuongGiayDep_Query($name) / 3); // 8 = > 3 trang
            $offset = ($numberPageCurrent - 1) * 6; //
            $query = mysqli_query($conn->conn(),"SELECT ID_GiayDep, TenGiayDep,Gia,Anh,tt.TenTrangThai,lgd.TenLoai,
            ThoiGianTao,XuatXu,ChatLieu FROM `giaydep` gd,loaigiaydep lgd,
             trangthai tt WHERE gd.`ID_TrangThai` = tt.ID_TrangThai AND gd.`ID_LoaiGiayDep` = lgd.`ID_LoaiGiayDep` AND 
             TenGiayDep LIKE '%".$name."%' LIMIT $offset,6");
            return $query;
        }
        function paginatorIndexCustomer_Search($numberPageCurrent,$name){
            //change the name param => replace space ( + tdc +++)
            //limit , offset, url, numberPage, numberPageCurrent
            if($numberPageCurrent < 1){
                $numberPageCurrent = 1;
            }
            $limit = 3;
            $totalPage = ceil($this->layTongSoLuongGiayDep_Query($name) / $limit); // 8 = > 3 trang
            $offset = ($numberPageCurrent - 1) * 6; //=>offset can hien
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