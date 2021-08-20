<?php

spl_autoload_register(function ($class) {
    require '../models/' . $class . '.php';
});
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $giayDepModel = new giaydepModel;
    $body = "";
    foreach($giayDepModel->getIDProduct($id) as $array){
        $body .= "
                  <table class='table'>
                    <thead>
                        <tr>
                            <th scope='col'>Tên sản phẩm</th>
                            <th scope='col'>Ảnh</th>
                            <th scope='col'>Giá</th>
                            <th scope='col'>Trạng thái</th>
                            <th scope='col'> Loại</th>
                            <th scope='col'> Xuất xứ</th>
                            <th scope='col'> Chất liệu</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td class='detail'><p>".$array['TenGiayDep']."</p></td>
                                <td class='detail'><img style='width:120px;height:160px' src='public/images/".$array['Anh']."'></td>
                                <td class='detail'><p>".number_format($array['Gia'])."</p></td>
                                <td class='detail'><p>".$array['TenTrangThai']."</p></td>
                                <td class='detail'><p>".$array['TenLoai']."</p></td>
                                <td class='detail'><p>".$array['XuatXu']."</p></td>
                                <td class='detail'><p>".$array['ChatLieu']."</p></td>
                            </tr>
                    </tbody>
                  </table>
                  ";
    } 
    echo $body;
}
else{
    header('location:../index.php');
}