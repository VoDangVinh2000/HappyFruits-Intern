<div id="content-wrapper">
    <div id="page-wrapper">
        <div class="row">

            <div class="col-sm-8">
                <ol class="list-group list-group-numbered list-type_block" style="list-style-type: space-counter;">
                    <?php foreach ($all_block  as $key => $item) { ?>
                        <li class="list-group-item" data-posid="<?= $key + 1; ?>" data-itemid='<?= $item['id'] ?>'>
                            <span class="list-count">Thứ tự hiển thị: <?= $key + 1; ?></span> |
                            <span class="list-count-id"><strong>ID: <?= $item['id'] ?></strong></span> |
                            <span class="type_block-content">Mẫu hiển thị <?= $item['type_block'] ?></span> |
                            <span class="type_block-edit">
                                [<a href="edit-block-homepage/<?= $item['id'] ?>" class="link" title="Sửa thông tin">Edit</a>]
                            </span>

                            <button data-posid="<?= $key + 1; ?>" class="btn btn-sm btn-primary move-up" data-itemid='<?= $item['id'] ?>'><i data-posid="<?= $key + 1; ?>" data-itemid='<?= $item['id'] ?>' class="fa fa-arrow-up move-up"></i></button>
                            <button data-posid="<?= $key + 1; ?>" class="btn btn-sm btn-primary move-down" data-itemid='<?= $item['id'] ?>'><i data-posid="<?= $key + 1; ?>" data-itemid='<?= $item['id'] ?>' class="fa fa-arrow-down move-down"></i></button>
                        </li>
                    <?php } ?>
                </ol>

                <form id="updatePositionBlockHomePage" role="form" method="post" action="<?= BASE_URL ?>xu-ly">
                    <p>Danh sách đã có sự thay đổi vui lòng ấn <b>Cập nhập</b> để lưu lại giá trị thay đổi!</p>
                    <input type="hidden" name="action" value="admin_update_position_blockhomepage" />
                    <input id='listIdUpdatePosition' type="hidden" name="listIdUpdatePosition" value="" />
                    <input type="submit" id="submit" value="Cập nhập" class="btn btn-submit btn-primary">
                </form>
            </div>
            <form id="addNewBlockHomePage" role="form" method="post" action="<?= BASE_URL ?>xu-ly" class="col-sm-4">
                <input type="hidden" name="action" value="admin_add_new_blockhomepage" />
                <input type="submit" id="submit" value="Thêm mới" class="btn btn-submit btn-primary">
            </form>
        </div>
    </div>
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#content-wrapper -->