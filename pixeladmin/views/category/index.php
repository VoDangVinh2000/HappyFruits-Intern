    <div id="content-wrapper">
        <?php $controlerObj->load_view('elements/breadcrumb');?>
        <?php $controlerObj->load_view('elements/pageheader');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-categorylist">
                            <thead>
                                <tr>
                                    <th style="width: 60px;" class="not_filter">Thứ tự</th>
                                    <th style="width: 30px;">Mã</th>
                                    <th>Tên</th>
                                    <th style="width: 200px;">Tên tiếng Anh</th>
                                    <th style="width: 95px;" class="not_filter">Cho giao hàng</th>
                                    <th style="width: 65px;" class="not_filter">Hoạt động</th>
                                    <th style="width: 65px;" class="not_filter"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($categories): ?>
                                    <?php foreach($categories as $item):?>
                                <tr id="<?=$item['category_id']?>">
                                    <td style="max-width: 60px;"><input type="text" style="text-align: center;"  value="<?=formatQuantity($item['sequence_number'])?>" class="sequence_number" /></td>
                                    <td style="max-width: 80px;"><input type="text" value="<?=$item['code']?>" class="code" /></td>
                                    <td><input type="text" value="<?=$item['name']?>" class="name" style="width: 100%;" /></td>
                                    <td><input type="text" value="<?=$item['english_name']?>" class="english_name" /></td>
                                    <td class="center">
                                        <div class="custom-checkbox-with-tick small">
                                            <input id="allow_delivery_<?=$item['category_id']?>" type="checkbox" value="1" class="allow_delivery" <?=getvalue($item, 'allow_delivery')?'checked="checked"':''?> autocomplete="off"/>
                                            <label for="allow_delivery_<?=$item['category_id']?>">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td class="center">
                                        <div class="custom-checkbox-with-tick small">
                                            <input id="enabled_<?=$item['category_id']?>" type="checkbox" value="1" class="enabled" <?=getvalue($item, 'enabled')?'checked="checked"':''?> autocomplete="off"/>
                                            <label for="enabled_<?=$item['category_id']?>">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td class="center">
                                        <a target="_blank" href="<?=BASE_URL. $URIs['categories']?>/<?=$item['category_id']?>" class="btn btn-sm btn-warning" title="Sửa thông tin"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="delete_item btn btn-sm btn-danger" title="Xóa"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#content-wrapper -->