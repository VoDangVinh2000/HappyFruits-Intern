    <div id="content-wrapper">
        <div id="page-wrapper">
            <?php if ($id && !$obj):?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-warning"></i> ID tài liệu không đúng!!</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <?php else:?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-edit"></i> <?=!$id?'Thêm':'Sửa'?> tài liệu</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <form id="frmDocument" data-toggle="validator" class="one-line" role="form" method="post" action="<?=BASE_URL?>xu-ly">
                      <div class="form-group col-lg-6 col-md-6">
                        <label for="name" class="control-label">Tên *</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Tên tài liệu" required="" data-error="Vui lòng nhập tên tài liệu" value="<?=getvalue($obj, 'name')?>" />
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="clear"></div>
                      <div class="form-group col-lg-6 col-md-6">
                        <label for="code" class="control-label">Mã</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="Mã" value="<?=getvalue($obj, 'code')?>" />
                        <div class="help-block with-errors">Hiển thị trên URL khi xem tài liệu</div>
                      </div>
                      <div class="clear"></div>
                      <div class="form-group col-lg-6 col-md-6">
                        <label class="control-label" for="description">Mô tả</label>
                        <textarea class="form-control" id="description" name="description" rows="2" cols="30"><?=getvalue($obj, 'description')?></textarea>
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="clear"></div>
                      <label class="control-label" for="content" style="margin: 5px;">Nội dung</label>
                      <div class="form-group col-lg-12 col-md-12">
                        <textarea class="form-control" id="content" name="content"><?=$content?></textarea>
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="clear"></div>
                      <div class="form-group col-lg-6 col-md-6">
                        <button id="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <span>Lưu</span></button>
                        <a href="<?=BASE_URL. $URIs['documents']?>" class="btn btn-info"><i class="fa fa-reply"></i> Quay lại danh sách</a>
                        <input type="hidden" name="action" value="admin_update_document"/>
                        <input type="hidden" name="document_id" id="document_id" value="<?=$id?>"/>
                      </div>
                    </form>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <?php endif;?>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#content-wrapper -->