<div class="main-show">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar-main">
                        <button type="button" class="btn btn-primary">Chọn giá cả</button>
                        <ul class="menu-giaca">
                            <li><a href="chooseQuery.php?Price=Full">Full giá</a></li>
                            <li><a href="chooseQuery.php?Price=1">0 vnd - 250.000 vnd</a></li>
                            <li><a href="chooseQuery.php?Price=2">250.000 vnd - 500.000 vnd</a></li>
                            <li><a href="chooseQuery.php?Price=3">500.000 vnd - 1 triệu vnd</a></li>
                            <li><a href="chooseQuery.php?Price=4">Trên 1 triệu</a></li>
                        </ul>
                        <button type="button" class="btn btn-primary">Chọn loại giày dép</button>
                        <ul class="menu-loaigiay">
                            <?php foreach ($loaiModel->layTatCaLoai() as $array) { ?>
                                <li><a href="loai.php?category=<?= $array['ID_LoaiGiayDep'] ?>"><?= $array['TenLoai'] ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>