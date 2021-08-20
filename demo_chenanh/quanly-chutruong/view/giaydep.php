<?php include '../include/header.php';

?>

<?php include '../include/sidebar.php' ?>
<?php
spl_autoload_register(function ($class) {
     require '../models/' . $class . ".php";
});
?>


<?php include '../include/main.php' ?>
<?php include '../controllers/themGiayDep.php' ?>
<?php include '../controllers/controlGiayDep.php' ?>
<!-- Button trigger modal -->
<?php
$productsModel = new productsModel();
$trangThaiModel = new trangThaiModel;
$loaiModel = new loaiModel;
$paginatorModel = new paginatorModel;
$anhNBMoDel = new anhNoiBatModel;
if (!isset($_GET['page'])) {
     $pageCurrent = 1;
} else {
     $pageCurrent = $_GET['page'];
}




?>

<!-- Modal -->
<div class="modal fade" id="btnDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xóa giày</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <form action="../controllers/controlGiayDep.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body" id="modal-body-delete">

                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <input type="submit" value="Delete" class="btn btn-primary" name="submitDeleteGD">
                    </div>
               </form>
          </div>
     </div>
</div>
<div class="modal fade" id="formDeleteTrangThai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xóa Trạng Thái</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <form action="../controllers/controlTrangThai.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body" id="modal-body-deleteTT">

                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <input type="submit" value="Delete" class="btn btn-primary" name="submitDeleteTT">
                    </div>
               </form>
          </div>
     </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa thông tin giày</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <form action="../controllers/controlGiayDep.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body" id="modal-body">
                         <!-- <input type="text" name="" id="testGetValue" value="">

                              <p>Tên :</p>
                              <input type="text" name="editTenGiayDep" id="" value="">  -->
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <input type="submit" value="Edit" class="btn btn-primary" name="submitEditGiayDep">
                    </div>
               </form>
          </div>
     </div>
</div>
<div class="modal fade" id="formEditTrangThai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa thông tin trạng thái</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <form action="../controllers/controlTrangThai.php" method="post">
                    <div class="modal-body" id="modal-body-edtTrangThai">
                         <!-- <input type="text" name="" id="testGetValue" value="">

                              <p>Tên :</p>
                              <input type="text" name="editTenGiayDep" id="" value="">  -->
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <input type="submit" value="Edit" class="btn btn-primary" name="submitEditTrangThai">
                    </div>
               </form>
          </div>
     </div>
</div>
<div class="modal fade" id="formEditLoai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa thông tin Loại</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <form action="../controllers/controlLoai.php" method="post">
                    <div class="modal-body" id="modal-body-edtLoai">
                         <!-- <input type="text" name="" id="testGetValue" value="">

                              <p>Tên :</p>
                              <input type="text" name="editTenGiayDep" id="" value="">  -->
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <input type="submit" value="Edit" class="btn btn-primary" name="submitEditLoai">
                    </div>
               </form>
          </div>
     </div>
</div>
<div class="modal fade" id="formDeleteLoai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

     <div class="modal-dialog" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xóa loại</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <form action="../controllers/controlLoai.php" method="post">
                    <div class="modal-body" id="modal-body-deleteLoai">
                         <!-- <input type="text" name="" id="testGetValue" value="">

                              <p>Tên :</p>
                              <input type="text" name="editTenGiayDep" id="" value="">  -->
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <input type="submit" value="Delete" class="btn btn-primary" name="submitDeleteLoai">
                    </div>
               </form>
          </div>
     </div>
</div>
<div class="modal fade" id="formEditAnhNB" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa thông tin ảnh nổi bật</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <form action="../controllers/controlThemAnhNoiBat.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body" id="modal-body-edtAnhNB">
                         <!-- <input type="text" name="" id="testGetValue" value="">

                              <p>Tên :</p>
                              <input type="text" name="editTenGiayDep" id="" value="">  -->
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <input type="submit" value="Edit" class="btn btn-primary" name="submitEditAnhNB">
                    </div>
               </form>
          </div>
     </div>
</div>
<div class="modal fade" id="formDeleteAnhNB" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xóa ảnh nổi bật</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <form action="../controllers/controlThemAnhNoiBat.php" method="post">
                    <div class="modal-body" id="modal-body-deleteAnhNB">
                         <!-- <input type="text" name="" id="testGetValue" value="">

                              <p>Tên :</p>
                              <input type="text" name="editTenGiayDep" id="" value="">  -->
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <input type="submit" value="Delete" class="btn btn-primary" name="submitDeleteAnhNB">
                    </div>
               </form>
          </div>
     </div>
</div>
<div class="header-main-right">
     <div class="col-md-4">
          <div class="control-themGiayDep">
               <button type="button" onclick="btnThemGiayDep()" class="btn btn-success">Thêm sản phẩm</button>
          </div>
     </div>
     <div class="col-md-4">
          <div class="control-controlGiayDep">
               <button type="button" onclick="btnThemTrangThai()" class="btn btn-success">Thêm trạng thái</button>
          </div>
     </div>
     <div class="col-md-4">
          <div class="control-xoaGiayDep">
               <button type="button" onclick="btnThemTenLoai()" class="btn btn-success">Thêm tên loại</button>
          </div>
     </div>
     <div class="col-md">
          <div class="control-themGiayDep">
               <button type="button" onclick="btnThemAnhNB()" class="btn btn-success">Thêm ảnh nổi bật</button>
          </div>
     </div>
     <div class="col-md-4">
          <div class="control-xemThanhPhanKhac">
               <button type="button" class="btn btn-success btn-hover">Xem các thành phần khác</button>
               <ul class="menu-xem-danh-sach">
                    <button type="button" class="btn btn-primary" onclick="btnXemTrangThai()">Trạng thái</button>
                    <button type="button" class="btn btn-primary" onclick="btnXemLoai()">Loại</button>
                    <button type="button" class="btn btn-primary" onclick="btnAnhNoiBat()">Ảnh nổi bật</button>
               </ul>
          </div>
     </div>
     <div class="col-md">
          <div class="control-timKiemGiayDep">
               <form action="searchgiaydep.php" method="GET">
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm">
                    <input type="submit" value="Tìm kiếm" class="btn btn-primary">
               </form>
          </div>
     </div>
</div><br>
<div class="main-right-content-giayDep">
     <div class="inside-content-giayDep">
          <div class="showAllProduct" id="showAllProduct" style="text-align: center;">
               <?= $paginatorModel->paginatorIndexAdmin($pageCurrent) ?>
              
               <table class="table">
                    <thead>
                         <tr>
                              <th></th>
                              <th>Tên giày dép</th>
                              <th scope="1">Ảnh</th>
                              <th>Giá</th>
                              <th>Trạng thái</th>
                              <th>Loại</th>
                              <th>Thời gian tạo</th>
                              <th>Xuất xứ</th>
                              <th>Chất liệu</th>
                              <th colspan="2">Action</th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php
                         foreach ($paginatorModel->paginatorAdmin($pageCurrent) as $array) {
                         ?>
                              <tr class="">
                                   <td><input type="hidden" name="" id="idGiayDep" value="<?= $array['ID_GiayDep'] ?>"></td>
                                   <td>
                                        <p><?= $array['TenGiayDep'] ?></p>
                                   </td>
                                   <td><img style="width: 170px;height:220px" src="../../public/images/<?= $array['Anh'] ?>" alt=""></td>
                                   <td>
                                        <p><?= number_format($array['Gia']); ?></p>
                                   </td>
                                   <td>
                                        <p><?= $array['TenTrangThai'] ?></p>
                                   </td>
                                   <td>
                                        <p><?= $array['TenLoai'] ?></p>
                                   </td>
                                   <td>
                                        <p><?= $array['ThoiGianTao'] ?></p>
                                   </td>
                                   <td>
                                        <p><?= $array['XuatXu'] ?></p>
                                   </td>
                                   <td>
                                        <p><?= $array['ChatLieu'] ?></p>
                                   </td>
                                   <td><button type="button" name="btnEdit" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                             Edit
                                        </button></td>
                                   <td><button type="button" name="btnDelete" class="btn btn-danger" data-toggle="modal" data-target="#btnDelete">
                                             Delete
                                        </button></td>
                              </tr><?php } ?>
                    </tbody>
               </table>
          </div>
          <div class="form-themGiayDep" id="form-themGiayDep">
               <form action="<?= "../controllers/themGiayDep.php" ?>" method="post" enctype="multipart/form-data">
                    <div class="row-info-lable-giaydep">
                         <div class="col-label">
                              <div class="col-md-4">
                                   <label for="">Tên :</label>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group">
                                        <input type="text" class="form-control" name="TenGiayDep" required placeholder="">
                                   </div>
                              </div>
                         </div>
                         <div class="col-label">
                              <div class="col-md-4">
                                   <label for="">Chọn ảnh :</label>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group">
                                        <input class="form-control" type="file" name="fileAnh" required />
                                   </div>
                              </div>
                         </div>
                         <div class="col-label">
                              <div class="col-md-4">
                                   <label for="">Giá :</label>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group">
                                        <input type="number" class="form-control" required name="Gia">
                                   </div>
                              </div>
                         </div>
                         <div class="col-label">
                              <div class="col-md-4">
                                   <label for="">Trạng thái :</label>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group">
                                        <select class="form-control" name="trangThai" id="trangThai" required>
                                             <?php
                                             foreach ($trangThaiModel->getAllTrangThai() as $array) { ?>
                                                  <option value="<?= $array['ID_TrangThai'] ?>"><?= $array['TenTrangThai'] ?></option>
                                             <?php } ?>
                                        </select>
                                        <p id="notificationTT" style="color:red;display:none">Chưa có thông tin cho trạng thái của sản phẩm để chọn</p>
                                   </div>
                              </div>
                         </div>
                         <div class="col-label">
                              <div class="col-md-4">
                                   <label for="">Tên loại :</label>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group">
                                        <select class="form-control" name="tenLoai" id="tenLoai" required>
                                             <?php
                                             foreach ($loaiModel->getAllLoai() as $array) { ?>
                                                  <option value="<?= $array['ID_LoaiGiayDep'] ?>"><?= $array['TenLoai'] ?></option>
                                             <?php } ?>
                                        </select>
                                        <p id="notificationTL" style="color:red;display:none">Chưa có thông tin cho tên loại của sản phẩm để chọn</p>
                                   </div>
                              </div>
                         </div>
                         <div class="col-label">
                              <div class="col-md-4">
                                   <label for="">Xuất xứ :</label>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group">
                                        <input type="text" class="form-control" required name="xuatXu">
                                   </div>

                              </div>
                         </div>
                         <div class="col-label">
                              <div class="col-md-4">
                                   <label for="">Chất liệu :</label>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group">
                                        <input type="text" class="form-control-set" required name="chatLieu">
                                   </div>
                              </div>
                         </div>
                    </div>
                    <input type="submit" value="Thêm" class="btn btn-primary" name="submitThem">
               </form>
          </div>
          <div class="form-themTrangThai" id="form-themTrangThai">
               <form action="<?= "../controllers/themTrangThai.php" ?>" method="post">
                    <div class="form-group">
                         <label for="">Tên trạng thái : </label>
                         <input type="text" class="form-control" name="fillOutTenTrangThai" required>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Thêm" name="submitThemTT">
               </form>
          </div>
          <div class="form-themTenLoai" id="form-themTenLoai">
               <form action="<?= "../controllers/themLoai.php" ?>" method="post">
                    <div class="form-group">
                         <label for="">Tên loại : </label>
                         <input type="text" class="form-control" name="fillOutTenLoai">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Thêm" name="submitThemTL">
               </form>
          </div>
          <div class="form-themAnhNoiBat" id="form-themAnhNoiBat">
               <form action="<?= "../controllers/controlThemAnhNoiBat.php" ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                         <label for="">Tên ảnh : </label>
                         <input type="file" class="form-control" name="fileAnhNoiBat" required>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Thêm" name="submitThemAnhNB">
               </form>
          </div>
          <div class="form-showAllTrangThai" id="form-showAllTrangThai">
               <table class="table">
                    <thead>
                         <tr>
                              <th></th>
                              <th class="scope">Tên trạng thái</th>
                              <th colspan="2">Action</th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php foreach ($trangThaiModel->getAllTrangThai() as $array) { ?>
                              <tr>
                                   <td><input type="hidden" name="" id="idTrangThai" value="<?= $array['ID_TrangThai'] ?>"></td>
                                   <td><?= $array['TenTrangThai'] ?></td>
                                   <td><button type="button" name="btnEditTrangThai" class="btn btn-success" data-toggle="modal" data-target="#formEditTrangThai">
                                             Edit
                                        </button></td>
                                   <td><button type="button" name="btnDeleteTrangThai" class="btn btn-danger" data-toggle="modal" data-target="#formDeleteTrangThai">
                                             Delete
                                        </button></td>
                              </tr>
                         <?php } ?>
                    </tbody>
               </table>
          </div>
          <div class="form-showAllLoai" id="form-showAllLoai">
               <table class="table">
                    <thead>
                         <tr>
                              <th></th>
                              <th class="scope">Tên loại</th>
                              <th colspan="2">Action</th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php foreach ($loaiModel->getAllLoai() as $array) { ?>
                              <tr>
                                   <td><input type="hidden" name="" id="idLoai" value="<?= $array['ID_LoaiGiayDep'] ?>"></td>
                                   <td><?= $array['TenLoai'] ?></td>
                                   <td><button type="button" name="btnEditLoai" class="btn btn-success" data-toggle="modal" data-target="#formEditLoai">
                                             Edit
                                        </button></td>
                                   <td><button type="button" name="btnDeleteLoai" class="btn btn-danger" data-toggle="modal" data-target="#formDeleteLoai">
                                             Delete
                                        </button></td>
                              </tr>
                         <?php } ?>
                    </tbody>
               </table>
          </div>
          <div class="form-AnhNoiBat" id="form-AnhNoiBat">
               <table class="table">
                    <thead>
                         <tr>

                              <th></th>
                              <th class="scope">Tên Ảnh</th>
                              <th class="scope">Ảnh</th>
                              <th colspan="2">Action</th>
                              <th class="scope">Hiển thị</th>

                         </tr>
                    </thead>
                    <tbody>
                         <form action="../controllers/hienThiAnhNB.php" method="post">

                              <?php foreach ($anhNBMoDel->getAllAnhNoiBat() as $array) { ?>
                                   <tr class="showAnhNB" id="showAnhNB">
                                        <td><input type="hidden" name="idAnhNB" value="<?= $array['ID_Anh_Animation'] ?>"></td>
                                        <td><?= $array['TenAnh'] ?></td>
                                        <td><img style="width:170px;height:170px;background-size:cover" src="../../public/imagesAnhNoiBat/<?= $array['TenAnh'] ?>" alt=""></td>
                                        <td><button type="button" name="btnEditAnhNB" class="btn btn-success" data-toggle="modal" data-target="#formEditAnhNB">
                                                  Edit
                                             </button></td>
                                        <td><button type="button" name="btnDeleteAnhNB" class="btn btn-danger" data-toggle="modal" data-target="#formDeleteAnhNB">
                                                  Delete
                                             </button></td>
                                        <?php
                                        if ($array['TrangThai'] == 1) {
                                        ?>
                                             <td><input type="radio" checked value="<?= $array['ID_Anh_Animation'] ?>" name="gender"></td>
                                        <?php }else{?>
                                             <td><input type="radio" value="<?= $array['ID_Anh_Animation'] ?>" name="gender"></td>
                                             <?php }?>
                                   </tr>
                              <?php } ?>
                              <input type="submit" value="Lưu hiển thị" style="float: right;" class="btn btn-primary" name="submitLuuHienThi">
                         </form>

                    </tbody>
               </table>
          </div>

     </div>
</div>
<?php include '../include/footer.php' ?>
<script src="../public/js/jsGiayDep.js"></script>