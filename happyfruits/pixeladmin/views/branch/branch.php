    <div id="content-wrapper">
        <div id="page-wrapper">
            <?php if ($id && !$obj):?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-warning"></i> ID chi nhánh không đúng!!</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <?php else:?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-edit"></i> <?=!$id?'Thêm':'Sửa thông tin'?> chi nhánh</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <form id="frmBranch" data-toggle="validator" class="one-line" role="form" method="post" action="<?=BASE_URL?>xu-ly">
                        <div class="form-group">
                            <label for="customer_name" class="control-label">Tên *</label>
                            <input type="text" class="form-control" id="branch_name" name="branch_name" placeholder="Họ Tên" required="" data-error="Vui lòng nhập tên chi nhánh" value="<?=getvalue($obj, 'branch_name')?>" />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="branch_address" class="control-label">Địa chỉ *</label>
                            <input type="text" class="form-control" id="branch_address" name="branch_address" placeholder="Địa chỉ" required="" data-error="Vui lòng nhập địa chỉ" value="<?=getvalue($obj, 'branch_address')?>" />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="short_address" class="control-label">Địa chỉ ngắn gọn*</label>
                            <input type="text" class="form-control" id="short_address" name="short_address" placeholder="Địa chỉ ngắn gọn" required="" data-error="Vui lòng nhập địa chỉ ngắn gọn" value="<?=getvalue($obj, 'short_address')?>" />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="en_address" class="control-label">Địa chỉ tiếng Anh*</label>
                            <input type="text" class="form-control" id="en_address" name="en_address" placeholder="Địa chỉ tiếng Anh" required="" data-error="Vui lòng nhập địa chỉ tiếng Anh" value="<?=getvalue($obj, 'en_address')?>" />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="phone_number" class="control-label">Số điện thoại*</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Số điện thoại" required="" data-error="Vui lòng nhập số điện thoại" value="<?=getvalue($obj, 'phone_number')?>" />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="lat" class="control-label">Latitude *</label>
                            <input type="text" class="form-control float" id="lat" name="lat" placeholder="Latitude" required="" data-error="Vui lòng nhập tọa độ latitude" value="<?=getvalue($obj, 'lat')?>" />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="lng" class="control-label">Longitude *</label>
                            <input type="text" class="form-control float" id="lng" name="lng" placeholder="Longitude" required="" data-error="Vui lòng nhập tọa độ longitude" value="<?=getvalue($obj, 'lng')?>" />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="enabled" name="enabled" value="1"  <?=getvalue($obj, 'enabled')?'checked=""':''?>/>
                            <label for="enabled">Hoạt động</label>
                        </div>
                        <div class="form-group">
                            <button id="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <span>Lưu</span></button>
                            <a href="<?=BASE_URL. $URIs['branches']?>" class="btn btn-info"><i class="fa fa-reply"></i> Quay lại danh sách</a>
                            <input type="hidden" name="action" value="admin_update_branch"/>
                            <input type="hidden" name="branch_id" id="branch_id" value="<?=$id?>"/>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div id="map_canvas" style="height: 450px;"></div>
                    <br />
                    <button id="view_in_large_map" type="button" class="btn btn-warning">Bản đồ lớn</button>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <?php endif;?>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#content-wrapper -->
