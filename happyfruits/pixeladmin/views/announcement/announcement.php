<div id="content-wrapper">
	<div id="page-wrapper">
		<?php if ($id && !$obj):?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header"><i class="fa fa-warning"></i> ID thông báo không đúng!!</h2>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
		<?php else:?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header"><i class="fa fa-edit"></i> <?=!$id?'Thêm thông báo':'Sửa nội dung thông báo'?></h2>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<form id="frmAnnouncement" data-toggle="validator" class="one-line" role="form" method="post" action="<?=BASE_URL?>xu-ly">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#general">Tổng quan</a></li>
                            <li><a data-toggle="tab" href="#main-content">Nội dung</a></li>
                            <li><a data-toggle="tab" href="#main-content-en">Nội dung tiếng Anh</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="general" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group col-lg-12 col-md-12">
                                            <label for="name" class="control-label">Tên *</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Tên thông báo" required="" data-error="Vui lòng nhập tên thông báo" value="<?=getvalue($obj, 'name')?>" />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12">
                                            <label for="start_dtm" class="control-label">TG bắt đầu</label>
                                            <input style="float: left;width: 100px;" class="form-control" size="16" id="start_dtm" name="start_dtm" type="text" data-date-format="dd/mm/yyyy" value="<?=getvalue($obj, 'start_dtm')?date('d/m/Y', strtotime($obj['start_dtm'])):date('d/m/Y')?>"/>
                                            <input style="float: left;width: 80px;margin-left: 10px;" id="start_time" name="start_time" type="text" class="form-control" value="<?=getvalue($obj, 'start_dtm')?date('G:i', strtotime($obj['start_dtm'])):'0:00'?>"/>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12">
                                            <label for="end_dtm" class="control-label">TG kết thúc</label>
                                            <input style="float: left;width: 100px;" class="form-control" size="16" id="end_dtm" name="end_dtm" type="text" data-date-format="dd/mm/yyyy" value="<?=getvalue($obj, 'end_dtm')?date('d/m/Y', strtotime($obj['end_dtm'])):date('d/m/Y')?>"/>
                                            <input style="float: left;width: 80px;margin-left: 10px;" id="end_time" name="end_time" type="text" class="form-control" value="<?=getvalue($obj, 'start_dtm')?date('G:i', strtotime($obj['end_dtm'])):'23:59'?>"/>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12">
                                            <input type="checkbox" id="temporary_close" name="temporary_close" value="1" <?=getvalue($obj, 'temporary_close')?'checked=""':''?> />
                                            <label class="control-label" for="temporary_close">Thông báo nghỉ</label>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12">
                                            <input type="checkbox" id="enabled" name="enabled" value="1" <?=getvalue($obj, 'enabled')?'checked=""':''?> />
                                            <label class="control-label" for="enabled">Hoạt động</label>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12">
                                            <input type="checkbox" id="has_sales_time" name="has_sales_time" value="1" <?=getvalue($obj, 'has_sales_time')?'checked=""':''?> />
                                            <label class="control-label" for="has_sales_time">Giờ vàng giảm giá</label>
                                        </div>
                                        <div class="sales-time-container" <?=!getvalue($obj, 'has_sales_time')?'style="display:none;"':''?>>
                                            <div class="form-group col-lg-12 col-md-12">
                                                <label for="start_dtm" class="control-label">Giờ bắt đầu</label>
                                                <input style="float: left;width: 80px;" id="start_sales_time" name="start_sales_time" type="text" class="form-control" value="<?=getvalue($obj, 'start_sales_time')?date('G:i', strtotime($obj['start_sales_time'])):'0:00'?>"/>
                                            </div>
                                            <div class="form-group col-lg-12 col-md-12">
                                                <label for="end_dtm" class="control-label">Giờ kết thúc</label>
                                                <input style="float: left;width: 80px;" id="end_sales_time" name="end_sales_time" type="text" class="form-control" value="<?=getvalue($obj, 'end_sales_time')?date('G:i', strtotime($obj['end_sales_time'])):'23:59'?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12">
                                            <input type="checkbox" id="is_promotion" name="is_promotion" value="1" <?=getvalue($obj, 'is_promotion')?'checked=""':''?> />
                                            <label class="control-label" for="is_promotion"> Tin khuyến mãi</label>
                                            <p class="small col-md-12">Tích chọn để thông báo được hiển thị ở trang Khuyến mãi.</p>
                                        </div>
                                        <div class="promotion-image-container" <?=!getvalue($obj, 'is_promotion')?'style="display:none;"':''?>>
                                            <div class="form-group col-lg-12 col-md-12">
                                                <label for="promotion_image" class="control-label">Banner khuyễn mãi (1280x300, 640x150)</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="promotion_image" name="promotion_image" placeholder="Đường dẫn ảnh" value="<?=getvalue($obj, 'promotion_image')?>" />
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-warning" id="select_promotion_image" type="button"><i class="fa fa-search"></i> Chọn</button>
                                                    </div>
                                                </div>
                                                <p class="small col-md-12">Banner sẽ được hiển thị ở cột bên phải ở đầu trang chủ nếu thông báo đang hoạt động.</p>
                                                <div class="clear"></div>
                                                <label for="promotion_link" class="control-label">Link</label>
                                                <input type="text" class="form-control" id="promotion_link" name="promotion_link" placeholder="Link thông báo" value="<?=getvalue($obj, 'promotion_link')?>" />
                                                <div class="clear"></div><br />
                                                <label>&nbsp;</label>
                                                <div id="preview_promotion_image"></div>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-lg-12 col-md-12">
                                            <label for="image" class="control-label">Ảnh thông báo</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="image" name="image" placeholder="Đường dẫn ảnh" value="<?=getvalue($obj, 'image')?>" />
                                                <div class="input-group-btn">
                                                    <button class="btn btn-warning select_image" id="select_image" type="button"><i class="fa fa-search"></i> Chọn</button>
                                                </div>
                                            </div>
                                            <div class="clear"></div><br />
                                            <label>&nbsp;</label>
                                            <div id="preview_image"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="main-content" class="tab-pane fade">
                                <div class="form-group col-lg-12 col-md-12">
                                    <textarea class="form-control" id="content" name="content" required="" data-error="Vui lòng nhập nội dung thông báo"><?=getvalue($obj, 'content')?></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div id="main-content-en" class="tab-pane fade">
                                <div class="form-group col-lg-12 col-md-12">
                                    <textarea class="form-control" id="content_en" name="content_en"><?=getvalue($obj, 'content_en')?></textarea>
                                </div>
                            </div>
                        </div>
						<div class="clear"></div>
						<div class="form-group col-lg-6 col-md-6">
							<button id="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <span>Lưu</span></button>
							<a href="<?=BASE_URL. $URIs['announcements']?>" class="btn btn-info"><i class="fa fa-reply"></i> Quay lại danh sách</a>
							<input type="hidden" name="action" value="admin_update_announcement"/>
							<input type="hidden" name="id" id="id" value="<?=$id?>"/>
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