<?php
    require_once 'database.php';
 class loaiModel extends database{
    // function getPriceQuery_1($chooseNumber){
    //     $conn = new database;
    //     $query = "SELECT * FROM giaydep WHERE Gia <= 200000";
    //     return $query;
    // }
    function layTatCaLoai(){
         $conn = new database;
        $query = mysqli_query($conn->conn(),"SELECT * FROM loaigiaydep");
        return $query;
    }
    function layTongSoLuongLoaiQuery($id){
        $query = mysqli_query(conn(),"SELECT * FROM loaigiaydep lgd,giaydep gd
        WHERE lgd.ID_LoaiGiayDep = gd.ID_LoaiGiayDep AND gd.ID_LoaiGiayDep = '".$id."' ");
        $tongSoLuong = mysqli_num_rows($query);
        return $tongSoLuong;
    }
    function paginatorLoaiIndex($numberPageCurrent,$id){
        if(!is_numeric($numberPageCurrent)){
            $numberPageCurrent = 1;
        }
        //limit , offset, url, numberPage, numberPageCurrent
        $limit = 6;
        $totalPage = ceil($this->layTongSoLuongLoaiQuery($id) / $limit); // 8 = > 2 trang
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
        $first = "<li><a style='padding:5px;color:black;' href='loai.php?category=$id&page=1'>First</a></li>";
        $last = "<li><a style='padding:5px;color:black;' href='loai.php?category=$id&page=$totalPage'>Last</a></li>";
        $prev = "<li><a style='padding:5px;color:black;' href='loai.php?category=$id&page=$pagePrev'><<</a></li>";
        $next = "<li><a style='padding:5px;color:black;' href='loai.php?category=$id&page=$pageNext'>>></a></li>";
        for($i = 1; $i <= $totalPage; $i++){
            if($i != $numberPageCurrent){
                if($i > $numberPageCurrent - 3 && $i < $numberPageCurrent + 3){
                    $url .= "<li><a href='loai.php?category=$id&page=$i'>$i</a></li>";
                }
            }
            else{
                $url .= "<li><a style='background:dodgerblue;color:white' href='loai.php?category=$id&page=$i'>$i</a></li>";
            }
        }
        // echo ;
        if($totalPage > 0){
            echo $first . $prev . $url . $next . $last;
        }
        else{
            echo "<script>alert('Hiện chưa có sản phẩm có loại tương ứng');window.location.href='index.php'</script>";
        }
        // return true;
    }
    function paginatorLoai($numberPageCurrent,$id){
        //$totalPage = ceil($this->layTongSoLuongGiaQuery_1() / 3); // 8 = > 3 trang
        $offset = ($numberPageCurrent - 1) * 6; //
        $query = mysqli_query(conn(),"SELECT * FROM loaigiaydep lgd,giaydep gd
         WHERE lgd.ID_LoaiGiayDep = gd.ID_LoaiGiayDep AND gd.ID_LoaiGiayDep = '".$id."' LIMIT $offset,6");
        return $query;
    }
 }
 ?>