<div id="content-wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-sm-8">
                <table class="table table-striped table-bordered table-hover dt-responsive">
                    
                    <thead>
                        <tr>
                            <th scope="col">Mẫu</th>
                            <th scope="col">Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($all_block as $item) { ?>
                            <tr>
                                <td><?= $item['type_block'] ?></td>
                                <td>
                                    <a target="_blank" href="block-homepage/<?= $item['id'] ?>" class="btn btn-sm btn-warning" title="Sửa thông tin"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#content-wrapper -->