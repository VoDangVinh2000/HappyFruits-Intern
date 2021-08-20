<?php
    function conn(){
        $conn = new mysqli("localhost","root","","qly_giaydep") or die('Connection Failed '.mysqli_connect_error());
        return $conn;
    }
    function layDuLieuAnh(){
        $conn = new mysqli("localhost","root","","qly_giaydep") or die('Connection Failed '.mysqli_connect_error());
        $query = mysqli_query($conn,"SELECT * FROM giaydep");
        return $query;
    }
    function layTongSoLuongGiayDep(){
        $query = mysqli_query(conn(),"SELECT * FROM giaydep");
        $tongSoLuong = mysqli_num_rows($query);
        return $tongSoLuong;
    }
    //phan trang
    function paginatorIndex($numberPageCurrent){
        if(!is_numeric($numberPageCurrent)){
            $numberPageCurrent = 1;
        }
        //limit , offset, url, numberPage, numberPageCurrent
        $limit = 6;
        $totalPage = ceil(layTongSoLuongGiayDep() / $limit); // 8 = > 3 trang
        //$offset = ($numberPageCurrent - 1) * 6; //=>offset can hien
        $url = "";
        $pageNext = $numberPageCurrent + 1;
        $pagePrev = $numberPageCurrent - 1;
        if($pagePrev < 1){
            $pagePrev = 1;
        }
        else if($pageNext > $totalPage){
            $pageNext = $totalPage;
        }
        $first = "<li><a style='padding:5px;color:black;' href='index.php?page=1'>First</a></li>";
        $last = "<li><a style='padding:5px;color:black;' href='index.php?page=$totalPage'>Last</a></li>";
        $prev = "<li><a style='padding:5px;color:black;' href='?page=$pagePrev'><<</a></li>";
        $next = "<li><a style='padding:5px;color:black;' href='?page=$pageNext'>>></a></li>";
      
        for($i = 1; $i <= $totalPage; $i++){
            if($numberPageCurrent != $i){
                if($i > $numberPageCurrent - 3 && $i < $numberPageCurrent + 3){
                    $url .= "<li><a href='?page=$i'>$i</a></li>";    
                }
            }
            else{
                $url .= "<li><a style='background:dodgerblue;color:white' href='?page=$i'>$i</a></li>";    
            }  
        }
        return $first . $prev . $url .$next . $last;
    }
    function paginator($numberPageCurrent){
        if(!is_numeric($numberPageCurrent)){
            $numberPageCurrent = 1;
        }
        //$totalPage = ceil(layTongSoLuongGiayDep() / 3); // 8 = > 3 trang
        $offset = ($numberPageCurrent - 1) * 6; //
        $query = mysqli_query(conn(),"SELECT * FROM giaydep LIMIT $offset,6");
        return $query;
    }
   
?>