<?php include '../include/header.php' ?>
<?php include '../include/sidebar.php' ?>
<?php include '../include/main.php' ?>
<?php
spl_autoload_register(function ($class) {
    require '../models/' . $class . ".php";
});
$productsModel = new productsModel();
$trangThaiModel = new trangThaiModel;
$loaiModel = new loaiModel;
$paginatorModel = new paginatorModel;
$anhNBMoDel = new anhNoiBatModel;
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $tongSoLuongGiayDep_Search = $paginatorModel->layTongSoLuongGiayDep_Query($search);
}
if (!isset($_GET['page'])) {
    $pageCurrent = 1;
} else {
    $pageCurrent = $_GET['page'];
}

?>
<div class="modal fade" id="formEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa thông tin giày</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../controllers/controlSearch.php" method="post" enctype="multipart/form-data">
                <div class="modal-body-search-edit" id="modal-body-search-edit">
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
<div class="modal fade" id="formDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <input type="submit" value="Delete" class="btn btn-primary" name="submitDeleteSearchGD">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="search-main-right">
    <div class="inside-main-search-right">
        <div class="row">
            <div class="col-md-8">
                <?php if (isset($search)) { ?>
                    <?= $paginatorModel->paginatorIndexAdmin_Search($pageCurrent, $search) ?>
                <?php } ?>
            </div>
            <div class="col-md-4">
                <form action="searchgiaydep.php" style="display: flex;" method="GET">
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm">
                    <input type="submit" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>

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
                <?php if(isset($search)){
                foreach ($paginatorModel->paginatorSearchAdmin($pageCurrent, $search) as $array) {
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
                        <td><button type="button" name="btnEdit" class="btn btn-success" data-toggle="modal" data-target="#formEdit">
                                Edit
                            </button></td>
                        <td><button type="button" name="btnDelete" class="btn btn-danger" data-toggle="modal" data-target="#formDelete">
                                Delete
                            </button></td>
                    </tr><?php }} ?>
            </tbody>
        </table>
    </div>
</div>
<?php include '../include/footer.php' ?>
<script src="../public/js/jsSearchGiayDep.js"></script>