    <div id="content-wrapper">
        <div id="page-wrapper">
            <?php if ($id && !$obj):?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-warning"></i> ID mã khuyến mãi không đúng!!</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <?php else:?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-edit"></i> <?=!$id?'Thêm':'Sửa thông tin'?> mã khuyến mãi</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <form id="frmPromotionCodes" data-toggle="validator" class="one-line" role="form" method="post" action="<?=BASE_URL?>xu-ly">
                      <div class="form-group">
                        <label for="start_date" class="control-label">Ngày bắt đầu *</label>
                        <div class="input-group date" id="start_date_picker" data-maxDate="<?=strtotime('+1 month')?>" data-minDate="<?=strtotime(getvalue($obj, 'start_date', date('Y-m-d H:i')))?>" data-defaultDate="<?=strtotime(getvalue($obj, 'start_date', date('Y-m-d H:i')))?>" >
                            <input type="text" id="start_date" name="start_date" class="form-control"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group">
                        <label for="end_date" class="control-label">Ngày kết thúc *</label>
                        <div class="input-group date" id="end_date_picker" data-maxDate="<?=strtotime('+1 month')?>" data-minDate="<?=!$id?strtotime(date('Y-m-d H:i')):0?>" data-defaultDate="<?=strtotime(getvalue($obj, 'end_date', date('Y-m-d H:i')))?>" >
                            <input type="text" id="end_date" name="end_date" class="form-control"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group">
                        <label for="code" class="control-label">Mã *</label>
                        <input type="text" id="code" name="code" class="form-control normal" placeholder="Mã khuyến mãi" required="" data-error="Vui lòng nhập mã khuyễn mãi" value="<?=getvalue($obj, 'code')?>"/>
                        &nbsp;<a id="generate_code" href="#" class="btn btn-warning"><i class="fa fa-flash"></i> Tạo</a>
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group">
                        <label for="discount" class="control-label">Giảm % *</label>
                        <input type="text" class="form-control number normal inline" id="discount" name="discount" placeholder="Giá trị giảm" required="" data-error="Vui lòng nhập giá trị giảm" maxlength="2" min="1" max="100" value="<?=getvalue($obj, 'discount')*100?>" />
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group">
                        <label class="control-label" for="description">Ghi chú</label>
                        <textarea class="form-control" id="description" name="description" rows="2" cols="30"><?=getvalue($obj, 'description')?></textarea>
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group">
                        <button id="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <span>Lưu</span></button>
                        <a href="<?=BASE_URL. $URIs['promotion_codes']?>" class="btn btn-info"><i class="fa fa-reply"></i> Quay lại danh sách</a>
                        <input type="hidden" name="action" value="admin_update_promotion_code"/>
                        <input type="hidden" name="promotion_code_id" id="promotion_code_id" value="<?=$id?>"/>
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