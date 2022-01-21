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
            </div>
            <form id="frmBlockHomePage" role="form" method="post" action="<?= BASE_URL ?>xu-ly">
            </form>
        </div>
    </div>
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#content-wrapper -->