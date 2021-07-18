<?php
    $slide_images = !empty($obj['slide_images'])?json_decode($obj['slide_images'], true):null;
    $color_options = array(
        'green' => 'Xanh lá',
        'orange' => 'Cam',
        'red' => 'Đỏ',
        'yellow' => 'Vàng',
        'grey' => 'Xám'
    );
    $column_options = array(2,3,4,6);
?>
<div id="content-wrapper">
    <div id="page-wrapper">
        <?php if ($id && !$obj):?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-warning"></i> ID trang không đúng!!</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        <?php else:?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-edit"></i> <?=!$id?'Thêm trang':'Sửa nội dung trang'?></h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <form id="frmPage" data-toggle="validator" class="one-line" role="form" method="post" action="<?=BASE_URL?>xu-ly">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#general">Tổng quan</a></li>
                            <li><a data-toggle="tab" href="#slide-images">Ảnh slideshow</a></li>
                            <li><a data-toggle="tab" href="#main-content">Nội dung</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="general" class="tab-pane fade in active">
                                <div class="form-group col-lg-8 col-md-8">
                                    <label for="page_title" class="control-label">Tên *</label>
                                    <input type="text" class="form-control" id="page_title" name="page_title" placeholder="Tên trang" required="" data-error="Vui lòng nhập tên trang" value="<?=getvalue($obj, 'page_title')?>" />
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="clear"></div>
                                <div class="form-group col-lg-8 col-md-8">
                                    <label for="page_code" class="control-label">Mã</label>
                                    <input type="text" class="form-control" id="page_code" name="page_code" placeholder="Mã" value="<?=getvalue($obj, 'page_code')?>" />
                                    <div class="help-block with-errors">Hiển thị trên URL</div>
                                </div>
                                <div class="clear"></div>
                                <div class="form-group col-lg-8 col-md-8">
                                    <label class="control-label" for="page_template">Template</label>
                                    <?php echo html_select($templates, 'file', 'name', 'id="page_template" name="page_template" class="form-control select2 hide-searchbox"', '--Chọn', getvalue($obj, 'page_template'));?>
                                </div>
                                <div class="clear"></div>
                                <div class="for-category-template for-home-template hide-by-default hidden">
                                    <p class="col-md-12">Danh sách sản phẩm thuộc nhóm hàng sẽ được hiển thị trên trang.</p>
                                    <div class="form-group col-lg-8 col-md-8">
                                        <label for="product_cat_ids" class="control-label">Nhóm hàng hóa</label>
                                        <?php echo html_select($all_categories, 'category_id', 'name', 'name="product_cat_ids[]" multiple id="product_cat_ids" class="form-control select2" ', null, explode(',', $obj['product_cat_ids']));?>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="form-group col-lg-8 col-md-8">
                                        <label for="tag_id" class="control-label">Nhóm hàng tùy chọn</label>
                                        <?php echo html_select($tags, 'tag_id', 'tag_name', 'name="tag_ids[]" multiple  id="tag_ids" class="form-control select2"', null, explode(',', $obj['tag_ids']));?>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="col-lg-8 col-md-8" style="padding-left: 5px;">
                                        <label class="control-label" for="enabled">Số cột hiển thị sản phẩm</label>
                                        <?php foreach($column_options as $opt): ?>
                                            <div class="custom-radio-with-tick inline">
                                                <input type="radio" id="cols-<?=$opt?>" value="<?=$opt?>" <?=Hash::get($obj, 'config.number_of_cols_in_frontend', Pages::$configFields['number_of_cols_in_frontend'])==$opt?'checked':''?> name="config_number_of_cols_in_frontend">
                                                <label style="cursor: pointer;font-weight: normal;line-height: 25px;" for="cols-<?=$opt?>"><?=$opt?> cột</label>
                                            </div>&nbsp;
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="form-group col-lg-8 col-md-8">
                                    <label class="control-label" for="enabled">Hoạt động</label>
                                    <div class="custom-checkbox-with-tick inline">
                                        <input id="enabled" name="enabled" type="checkbox" value="1" class="not-icheck" <?=getvalue($obj, 'enabled')?'checked="checked"':''?> autocomplete="off"/>
                                        <label for="enabled">&nbsp;</label>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="form-group col-lg-8 col-md-8 for-category-template for-page-template hide-by-default hidden">
                                    <label class="control-label" for="config_has_voucher_form">Hiện form voucher</label>
                                    <div class="custom-checkbox-with-tick inline">
                                        <input id="config_has_voucher_form" name="config_has_voucher_form" type="checkbox" value="1" class="not-icheck" <?=Hash::get($obj, 'config.has_voucher_form', Pages::$configFields['has_voucher_form'])?'checked="checked"':''?> autocomplete="off"/>
                                        <label for="config_has_voucher_form">&nbsp;</label>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="form-group col-lg-8 col-md-8 for-category-template for-page-template hide-by-default hidden">
                                    <label class="control-label" for="config_has_package_form">Hiện form package</label>
                                    <div class="custom-checkbox-with-tick inline">
                                        <input id="config_has_package_form" name="config_has_package_form" type="checkbox" value="1" class="not-icheck" <?=Hash::get($obj, 'config.has_package_form', Pages::$configFields['has_package_form'])?'checked="checked"':''?> autocomplete="off"/>
                                        <label for="config_has_package_form">&nbsp;</label>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="form-group col-lg-8 col-md-8 for-category-template for-page-template hide-by-default hidden">
                                    <label class="control-label" for="config_has_company_request_form">Hiện form đặt hàng công ty</label>
                                    <div class="custom-checkbox-with-tick inline">
                                        <input id="config_has_company_request_form" name="config_has_company_request_form" type="checkbox" value="1" class="not-icheck" <?=Hash::get($obj, 'config.has_company_request_form', Pages::$configFields['has_company_request_form'])?'checked="checked"':''?> autocomplete="off"/>
                                        <label for="config_has_company_request_form">&nbsp;</label>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div id="slide-images" class="tab-pane fade">
                                <p class="col-md-12">Ảnh slideshow (1600x782, 1000x489, 790x387)</p>
                                <div class="slide-container-template" style="display: none">
                                    <div class="form-group col-lg-6 col-md-6">
                                        <label for="slide_imageINDEX" class="control-label">Ảnh LABEL</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="slide_imageINDEX" name="slide_image[]" placeholder="Ảnh" value="">
                                            <div class="input-group-btn">
                                                <button class="btn btn-warning select_image" data-index="INDEX" type="button">Chọn</button>
                                            </div>
                                        </div>
                                        <div class="clear"></div><br />
                                        <label for="slide_urlINDEX" class="control-label">URL LABEL</label>
                                        <input type="text" class="form-control" id="slide_urlINDEX" name="slide_url[]" placeholder="URL" value="" />
                                        <div class="clear"></div><br />
                                        <label>&nbsp;</label>
                                        <div class="preview_header_image"></div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <textarea class="form-control" id="slide_contentINDEX" name="slide_content[]"  placeholder="Nội dung"></textarea><br/>
                                        <?php foreach($color_options as $color_code => $name):?>
                                        <div class="custom-radio-with-tick inline">
                                            <input type="radio" id="slide_color_INDEX_<?=$color_code?>" checked="checked" value="<?=$color_code?>" name="slide_color_INDEX">
                                            <label style="cursor: pointer;font-weight: normal;line-height: 25px;" for="slide_color_INDEX_<?=$color_code?>"><?=$name?></label>
                                        </div>&nbsp;
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <?php if($slide_images): $c_slide_images = count($slide_images); ?>
                                    <?php for($i = 0; $i <= $c_slide_images; $i++):?>
                                        <div class="slide<?=$i?>-container">
                                            <div class="form-group col-lg-6 col-md-6">
                                                <label for="slide_image<?=$i?>" class="control-label">Ảnh <?=$i+1?></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="slide_image<?=$i?>" name="slide_image[]" placeholder="Ảnh" value="<?=isset($slide_images[$i])?getvalue($slide_images[$i], 'image'):''?>">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-warning select_image" data-index="<?=$i?>" type="button">Chọn</button>
                                                    </div>
                                                </div>
                                                <div class="clear"></div><br />
                                                <label for="slide_url<?=$i?>" class="control-label">URL<?=$i+1?></label>
                                                <input type="text" class="form-control" id="slide_url<?=$i?>" name="slide_url[]" placeholder="URL" value="<?=isset($slide_images[$i])?getvalue($slide_images[$i], 'url'):''?>" />
                                                <div class="clear"></div><br />
                                                <label>&nbsp;</label>
                                                <div class="preview_header_image"><?php if(isset($slide_images[$i]) && getvalue($slide_images[$i], 'image')):?><img src="<?=$slide_images[$i]['image']?>" height="110"><?php endif; ?></div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <textarea class="form-control ckeditor" id="slide_content<?=$i?>" name="slide_content[]"  placeholder="Nội dung"><?=getvalue(isset($slide_images[$i])?$slide_images[$i]:'', 'content')?></textarea><br/>
                                                <?php foreach($color_options as $color_code => $name):?>
                                                <div class="custom-radio-with-tick inline">
                                                    <input type="radio" id="slide_color_<?=$i?>_<?=$color_code?>" <?=getvalue(isset($slide_images[$i])?$slide_images[$i]:'', 'color', 'green')==$color_code?'checked="checked"':''?> value="<?=$color_code?>" name="slide_color_<?=$i?>">
                                                    <label style="cursor: pointer;font-weight: normal;line-height: 25px;" for="slide_color_<?=$i?>_<?=$color_code?>"><?=$name?></label>
                                                </div>&nbsp;
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    <?php endfor;?>
                                <?php else: $i = 0;?>
                                    <div class="slide<?=$i?>-container">
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="slide_image<?=$i?>" class="control-label">Ảnh <?=$i+1?></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="slide_image<?=$i?>" name="slide_image[]" placeholder="Ảnh" value="">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-warning select_image" data-index="<?=$i?>" type="button">Chọn</button>
                                                </div>
                                            </div>
                                            <div class="clear"></div><br />
                                            <label for="slide_url<?=$i?>" class="control-label">URL <?=$i+1?></label>
                                            <input type="text" class="form-control" id="slide_url<?=$i?>" name="slide_url[]" placeholder="URL" value="" />
                                            <div class="clear"></div><br />
                                            <label>&nbsp;</label>
                                            <div class="preview_header_image"></div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <textarea class="form-control ckeditor" id="slide_content<?=$i?>" name="slide_content[]"  placeholder="Nội dung"></textarea><br/>
                                            <?php foreach($color_options as $color_code => $name):?>
                                                <div class="custom-radio-with-tick inline">
                                                    <input type="radio" id="slide_color_<?=$i?>_<?=$color_code?>" <?=$color_code=='green'?'checked="checked"':''?> value="<?=$color_code?>" name="slide_color_<?=$i?>">
                                                    <label style="cursor: pointer;font-weight: normal;line-height: 25px;" for="slide_color_<?=$i?>_<?=$color_code?>"><?=$name?></label>
                                                </div>&nbsp;
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                <?php endif;?>
                            </div>
                            <div id="main-content" class="tab-pane fade">
                                <div class="form-group col-lg-12 col-md-12">
                                    <textarea class="form-control" id="page_body" name="page_body"><?=getvalue($obj, 'page_body')?></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group col-lg-6 col-md-6">
                            <button id="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <span>Lưu</span></button>
                            <a href="<?=BASE_URL. $URIs['pages']?>" class="btn btn-info"><i class="fa fa-reply"></i> Quay lại danh sách</a>
                            <?php if(!empty($obj['page_code'])): ?>
                                <a href="<?=ROOT_URL. 'vi/'. $obj['page_code']?>" target="_blank" class="btn btn-warning"><i class="fa fa-newspaper-o"></i> Xem</a>
                            <?php endif; ?>
                            <input type="hidden" name="action" value="admin_update_page"/>
                            <input type="hidden" name="page_id" id="page_id" value="<?=$id?>"/>
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