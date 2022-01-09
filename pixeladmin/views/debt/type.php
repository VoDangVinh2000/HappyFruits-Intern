    <div id="content-wrapper">
        <div id="page-wrapper">
            <?php if ($id && !$obj):?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-warning"></i> ID loại công nợ không đúng!!</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <?php else:?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-edit"></i> <?=!$id?'Thêm':'Sửa thông tin'?> loại công nợ</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <form id="frmMain" data-toggle="validator" class="one-line" role="form" method="post" action="<?=BASE_URL?>xu-ly">
                        <div class="form-group">
                            <label for="amount" class="control-label">Tên *</label>
	                        <input type="text" class="form-control normal inline" id="name" name="name" placeholder="Loại công nợ" required="" data-error="Vui lòng tên loại công nợ" value="<?=getvalue($obj, 'name')?>" />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Ghi chú</label>
                            <textarea class="form-control" id="description" name="description" rows="2" cols="30"><?=getvalue($obj, 'description')?></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <button id="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <span>Lưu</span></button>
                            <a href="<?=BASE_URL. $URIs['debts']?>/loai" class="btn btn-info"><i class="fa fa-reply"></i> Quay lại danh sách</a>
                            <input type="hidden" name="action" value="admin_update_debt_type"/>
                            <input type="hidden" name="debt_type_id" id="debt_type_id" value="<?=$id?>"/>
                        </div>
                    </form>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <?php endif;?>
        </div>
        <!-- /#page-wrapper -->
    </div><!-- /#content-wrapper -->