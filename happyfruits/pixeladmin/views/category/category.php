<div id="content-wrapper">
    <div id="page-wrapper">
        <?php if ($id && !$obj):?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-warning"></i> ID nhóm hàng không đúng!!</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        <?php else:?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-edit"></i> <?=!$id?'Thêm':'Sửa thông tin'?> nhóm hàng</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <form id="frmCategory" data-toggle="validator" class="one-line" role="form" method="post" action="<?=BASE_URL?>xu-ly">
                        <div class="form-group">
                            <label for="name" class="control-label">Tên *</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Tên nhóm hàng" required="" data-error="Vui lòng nhập tên nhóm hàng" value="<?=getvalue($obj, 'name')?>" />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="english_name" class="control-label">Tên tiếng Anh *</label>
                            <input type="text" class="form-control" id="english_name" name="english_name" placeholder="Tên tiếng Anh" required="" data-error="Vui lòng nhập tên tiếng Anh" value="<?=getvalue($obj, 'english_name')?>" />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="code" class="control-label">Mã *</label>
                            <input type="text" class="form-control" id="code" name="code" placeholder="Mã" required="" data-error="Vui lòng nhập mã nhóm hàng" value="<?=getvalue($obj, 'code')?>" />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Ghi chú</label>
                            <textarea class="form-control" id="description" name="description" rows="2" cols="30"><?=getvalue($obj, 'description')?></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="type_id" class="control-label">Nhóm cha</label>
                            <?php echo html_select($all_categories, 'category_id', 'name', 'name="parent_id" id="parent_id" class="form-control"', '-- Không', getvalue($obj, 'parent_id'));?>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="sequence_number" class="control-label">Thứ tự</label>
                            <input type="text" class="form-control number normal" id="sequence_number" name="sequence_number" placeholder="Thứ tự" maxlength="3" value="<?=formatQuantity(getvalue($obj, 'sequence_number', 100))?>" />
                        </div>
                        <?php if($obj && Users::can_access('category', 'manage_images')): /* only for existed categories */?>
                            <?php /* Manage many images for a category - disable it temporary
                      <div class="form-group">
                        <label>Hình ảnh</label>
                        <div class="product_images">
                            <?php if(!empty($images)):?>
                            <?php foreach($images as $image):?>
                            <div class="thumbnail_container">
                                <a class="delete_btn thumb_btn" href="#" id="<?=$image['id']?>" title="Xóa"><i class="fa fa-trash"></i></a>
                                <a class="view_btn thumb_btn" href="<?=get_image_url($image)?>" target="_blank" title="Xem"><i class="fa fa-search"></i></a>
                                <img src="<?=get_image_url($image, 'thumbnail');?>" />
                            </div>
                            <?php endforeach;?>
                            <?php endif;?>
                        </div>
                        <label>&nbsp;</label>
                        <div class="fileupload_container">
                            <input id="fileupload" type="file" name="files[]" multiple="" />
                            <br />
                            <!-- The global progress bar -->
                            <div id="progress" class="progress" style="display: none;">
                                <div class="progress-bar progress-bar-success"></div>
                            </div>
                            <!-- The container for the uploaded files -->
                            <div id="files" class="files"></div>
                        </div>
                      </div>
                      */ ?>
                            <div class="form-group">
                                <label for="image" class="control-label">Hình ảnh</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="image" name="image" placeholder="Đường dẫn ảnh" value="<?=urldecode(getvalue($obj, 'image'))?>" />
                                    <div class="input-group-btn">
                                        <button class="btn btn-warning" id="select_image" type="button"><i class="fa fa-search"></i> Chọn</button>
                                    </div>
                                </div>
                                <div class="clear"></div><br />
                                <label>&nbsp;</label>
                                <div id="preview_image"></div>
                            </div>
                        <?php endif;?>
                        <div class="form-group">
                            <input type="checkbox" id="allow_delivery" name="allow_delivery" value="1" <?=getvalue($obj, 'allow_delivery')?'checked=""':''?> />
                            <label for="allow_delivery">Cho giao hàng</label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="enabled" name="enabled" value="1"  <?=getvalue($obj, 'enabled', 1)?'checked=""':''?>/>
                            <label for="enabled">Đang hoạt động</label>
                        </div>
                        <div class="form-group">
                            <button id="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <span>Lưu</span></button>
                            <a href="<?=BASE_URL. $URIs['categories']?>" class="btn btn-info"><i class="fa fa-reply"></i> Quay lại danh sách</a>
                            <input type="hidden" name="action" value="admin_update_category"/>
                            <input type="hidden" name="category_id" id="category_id" value="<?=$id?>"/>
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