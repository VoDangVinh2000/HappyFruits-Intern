<?php if ($id && $obj):?>
<script>
    var inventory_items = [];
    <?php if(!empty($inventory_items)): ?>
    <?php foreach ($inventory_items as $item):?>
    inventory_items.push(
        {
            id: '<?=$item['id']?>',
            code: '<?=$item['code']?>',
            name: '<?=$item['name']?>',
            unit: '<?=$item['unit']?>',
            type_name: '<?=$item['type_name']?>',
            value: '<?=$item['name']?>',
            label: '<?=$item['code']. ' - '. $item['name']?>',
        }
    );
    <?php endforeach; ?>
    <?php endif;?>
    var box_items = [];
    <?php if(!empty($box_items)): ?>
    <?php foreach ($box_items as $item):?>
    box_items.push(
        {
            id: '<?=$item['product_id']?>',
            code: '<?=$item['code']?>',
            name: '<?=$item['name']?>',
            price: '<?=$item['price']?>',
            value: '<?=$item['name']?>',
            label: '<?=$item['code']. ' - '. $item['name']. ' - '. $item['name_without_utf8']?>',
        }
    );
    <?php endforeach; ?>
    <?php endif;?>
</script>
<?php endif; ?>
<div id="content-wrapper">
	<div id="page-wrapper">
		<?php if ($id && !$obj):?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header"><i class="fa fa-warning"></i> ID hàng hóa không đúng!!</h2>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
		<?php else:?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header"><i class="fa fa-edit"></i> <?=!$id?'Thêm':'Sửa thông tin'?> hàng hóa</h2>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row">
				<form id="frmProduct" data-toggle="validator" class="one-line" role="form" method="post" action="<?=BASE_URL?>xu-ly">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#general">Tổng quan</a></li>
                        <?php if(!empty($options)):?>
                        <li><a data-toggle="tab" href="#sub-products">Món thêm</a></li>
                        <?php endif; ?>
                        <?php if($id):?>
                            <?php if($obj['is_box']):?>
                                <li><a data-toggle="tab" href="#products-in-box">Trái cây mặc định</a></li>
                            <?php else: ?>
                                <li><a data-toggle="tab" href="#components">Thành phần</a></li>
                            <?php endif;?>
                        <?php endif;?>
                    </ul>
                    <div class="tab-content">
                        <div id="general" class="tab-pane fade in active">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="name" class="control-label">Tên *</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Tên hàng hóa" required="" data-error="Vui lòng nhập tên hàng hóa" value="<?=getvalue($obj, 'name')?>" />
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label for="english_name" class="control-label">Tên tiếng Anh *</label>
                                    <input type="text" class="form-control" id="english_name" name="english_name" placeholder="Tên tiếng Anh" required="" data-error="Vui lòng nhập tên tiếng Anh" value="<?=getvalue($obj, 'english_name')?>" />
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label for="code" class="control-label">Mã hàng hóa *</label>
                                    <input type="text" class="form-control normal" id="code" name="code" placeholder="Mã hàng hóa" required="" data-error="Vui lòng nhập mã hàng hóa" value="<?=getvalue($obj, 'code')?>" />
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label for="type_id" class="control-label">Nhóm hàng *</label>
                                    <?php echo html_select($all_categories, 'category_id', 'name', 'name="category_id" required="" id="category_id" class="form-control" data-error="Vui lòng chọn nhóm hàng"', '-- Chọn', getvalue($obj, 'category_id'));?>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label for="unit" class="control-label">Đơn vị tính</label>
                                    <input type="text" class="form-control normal" id="unit" name="unit" placeholder="Đơn vị tính" value="<?=getvalue($obj, 'unit')?>" />
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label for="base_price" class="control-label">Giá gốc (x1000)</label>
                                    <input type="text" class="form-control float normal" maxlength="6" id="base_price" name="base_price" placeholder="Giá gốc" value="<?=getvalue($obj, 'base_price')?>" />
                                    <div class="help-block with-errors"></div>
                                </div>
                                <?php if(USING_SAME_PRICE):?>
                                    <div class="form-group">
                                        <label for="sell_price" class="control-label">Giá bán (x1000)</label>
                                        <input type="text" class="form-control float normal" maxlength="6" id="sell_price" name="sell_price" placeholder="Giá bán" value="<?=getvalue($obj, 'sell_price')?>" />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                <?php endif;?>
                                <div class="form-group hide-if-box">
                                    <label for="promotion_price" class="control-label">Giá khuyến mãi (x1000)</label>
                                    <input type="text" class="form-control float normal" maxlength="6" id="promotion_price" name="promotion_price" placeholder="Giá khuyến mãi" value="<?=getvalue($obj, 'promotion_price')?>" />
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group show-if-box hidden">
                                    <label for="promotion_price" class="control-label warning-color">Tỉ lệ giảm (%)</label>
                                    <input type="text" class="form-control number normal" maxlength="2" id="box_discount_rate" name="box_discount_rate" placeholder="Tỉ lệ giảm" value="<?=getvalue($obj, 'box_discount_rate')?>" />
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label for="sequence_number" class="control-label">Thứ tự</label>
                                    <input type="text" class="form-control number normal" id="sequence_number" name="sequence_number" placeholder="Thứ tự" maxlength="3" value="<?=formatQuantity(getvalue($obj, 'sequence_number', 100))?>" />
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="description">Ghi chú</label>
                                    <textarea class="form-control" id="description" name="description" rows="6" cols="30"><?=getvalue($obj, 'description')?></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="description_en">Ghi chú tiếng Anh</label>
                                    <textarea class="form-control" id="description_en" name="description_en" rows="6" cols="30"><?=getvalue($obj, 'description_en')?></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <?php if(Users::can_access('product', 'manage_images')): ?>
                                    <?php /* Manage many images for a product - disable it temporary
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
                                <div class="form-group hidden" id="type-container">
                                    <label for="type" class="control-label">Loại</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="">-- Chọn</option>
                                        <option <?=getvalue($obj, 'type')=='size'?'selected="selected"':''?> value="size">Kích thước</option>
                                        <option <?=getvalue($obj, 'type')=='extra'?'selected="selected"':''?> value="extra">Món thêm tính tiền</option>
                                        <option <?=getvalue($obj, 'type')=='topping'?'selected="selected"':''?> value="topping">Topping</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label for="ribbon_left" class="control-label">Ruy băng trái</label>
                                    <input type="text" class="form-control" id="ribbon_left" name="ribbon_left" placeholder="" value="<?=getvalue($obj, 'ribbon_left')?>" />
                                </div>
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <input type="text" class="form-control minicolors-input ribbon normal" id="ribbon_left_color" name="ribbon_left_color" size="7" value="<?=getvalue($obj, 'ribbon_left_color', '#9BC90D')?>"  />
                                </div>
                                <div class="form-group">
                                    <label for="ribbon_right" class="control-label">Ruy băng phải</label>
                                    <input type="text" class="form-control" id="ribbon_right" name="ribbon_right" placeholder="" value="<?=getvalue($obj, 'ribbon_right')?>" />
                                </div>
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <input type="text" class="form-control minicolors-input ribbon normal" id="ribbon_right_color" name="ribbon_right_color" size="7" value="<?=getvalue($obj, 'ribbon_right_color', '#9BC90D')?>"  />
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="half-width" for="is_additional">Là món thêm</label>
                                            <div class="custom-checkbox-with-tick inline">
                                                <input id="is_additional" name="is_additional" type="checkbox" value="1" class="not-icheck product-type" <?=getvalue($obj, 'is_additional')?'checked="checked"':''?> autocomplete="off"/>
                                                <label for="is_additional">&nbsp;</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="half-width warning-color" for="free_choice">Món tự chọn</label>
                                            <div class="custom-checkbox-with-tick inline">
                                                <input id="free_choice" name="free_choice" type="checkbox" value="1" class="not-icheck product-type" <?=getvalue($obj, 'free_choice')?'checked="checked"':''?> autocomplete="off"/>
                                                <label for="free_choice">&nbsp;</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="half-width" for="can_be_added_to_box">Món thêm vào hộp tự chọn</label>
                                            <div class="custom-checkbox-with-tick inline">
                                                <input id="can_be_added_to_box" name="can_be_added_to_box" type="checkbox" value="1" class="not-icheck product-type" <?=getvalue($obj, 'can_be_added_to_box')?'checked="checked"':''?> autocomplete="off"/>
                                                <label for="can_be_added_to_box">&nbsp;</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="half-width warning-color" for="is_box">Hộp tự chọn</label>
                                            <div class="custom-checkbox-with-tick inline">
                                                <input id="is_box" name="is_box" type="checkbox" value="1" class="not-icheck product-type" <?=getvalue($obj, 'is_box')?'checked="checked"':''?> autocomplete="off"/>
                                                <label for="is_box">&nbsp;</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group hide-if-box">
                                            <label class="half-width warning-color" for="show_components_on_frontend">Hiển thị thành phần trên website</label>
                                            <div class="custom-checkbox-with-tick inline">
                                                <input id="show_components_on_frontend" name="show_components_on_frontend" type="checkbox" value="1" class="not-icheck" <?=getvalue($obj, 'show_components_on_frontend')?'checked="checked"':''?> autocomplete="off"/>
                                                <label for="show_components_on_frontend">&nbsp;</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="half-width" for="enabled">Còn bán (Enabled)</label>
                                            <div class="custom-checkbox-with-tick inline">
                                                <input id="enabled" name="enabled" type="checkbox" value="1" class="not-icheck" <?=getvalue($obj, 'enabled')?'checked="checked"':''?> autocomplete="off"/>
                                                <label for="enabled">&nbsp;</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="half-width" for="not_deliver">Không giao hàng</label>
                                            <div class="custom-checkbox-with-tick inline">
                                                <input id="not_deliver" name="not_deliver" type="checkbox" value="1" class="not-icheck" <?=getvalue($obj, 'not_deliver')?'checked="checked"':''?> autocomplete="off"/>
                                                <label for="not_deliver">&nbsp;</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="half-width" for="is_hidden">Ẩn</label>
                                            <div class="custom-checkbox-with-tick inline">
                                                <input id="is_hidden" name="is_hidden" type="checkbox" value="1" class="not-icheck" <?=getvalue($obj, 'is_hidden')?'checked="checked"':''?> autocomplete="off"/>
                                                <label for="is_hidden">&nbsp;</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <?php if(!empty($options)):?>
                        <div id="sub-products" class="tab-pane fade">
                            <div class="col-lg-12 col-md-12">
                                    <div class="row">
                                        <?php $i = 1; foreach($options as $item): ?>
                                            <div class="col-lg-6 col-md-6">
                                                <input type="checkbox" id="add_<?=$item['product_id']?>" name="add_<?=$item['product_id']?>" value="1" <?=strstr($item['belongs_to'], ','.$obj['product_id'].',')?'checked=""':''?> />
                                                <label for="add_<?=$item['product_id']?>"><?=$item['name']?></label>
                                            </div>
                                            <?php if($i%2 == 0):?>
                                                <div class="clear" style="margin-bottom: 5px;"></div>
                                            <?php endif; ?>
                                            <?php $i++; endforeach;?>
                                    </div>
                                <!-- /.row -->
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <?php endif;?>
                        <?php if($id):?>
                            <?php if($obj['is_box']):?>
                                <div id="products-in-box" class="tab-pane fade">
                                    <div class="col-lg-12 col-md-12" id="frmProductsInBox" data-toggle="validator" role="form" method="post" action="<?=BASE_URL?>xu-ly">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-components">
                                            <thead>
                                            <tr>
                                                <th style="width: 120px;">Mã *</th>
                                                <th style="width: 250px;">Tên</th>
                                                <th style="width: 90px;">Số lượng *</th>
                                                <th style="width: 90px;">Giá</th>
                                                <th style="width: 90px;">Thành tiền</th>
                                                <th style="width: 95px;">&nbsp;</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if(!empty($products_in_box)):
                                                foreach($products_in_box as $item):
                                                    ?>
                                                    <tr>
                                                        <td><input type="text" class="form-control box_item_code" name="box_item_code[]" placeholder="Mã" value="<?=getvalue($item, 'code')?>"/></td>
                                                        <td class="center"><div class="box_item_info"><?=getvalue($item, 'name')?></div></td>
                                                        <td>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control box_item_amount" name="box_item_amount[]" placeholder="Số lượng" value="<?=!empty($item['amount'])?formatQuantity($item['amount'], 2):0?>"/>
                                                            </div>
                                                        </td>
                                                        <td class="center"><div class="box_item_price"><?=number_format(getvalue($item, 'sell_price', 0)*1000, 0, '.', '.')?></div></td>
                                                        <td class="center"><div class="box_item_total"><?=number_format(getvalue($item, 'amount', 0)*getvalue($item, 'sell_price', 0)*1000, 0,  '.', '.')?></div></td>
                                                        <td>
                                                            <input type="hidden" name="box_item_id[]" class="box_item_id" value="<?=getvalue($item, 'item_id')?>"/>
                                                            <a href="#" class="remove_box_item btn btn-sm btn-danger" title="Xóa dòng"><i class="fa fa-minus"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                endforeach;
                                            endif;
                                            ?>
                                            <tr>
                                                <td><input type="text" class="form-control box_item_code" name="box_item_code[]" placeholder="Mã"/></td>
                                                <td class="center"><div class="box_item_info"></div></td>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control box_item_amount" name="box_item_amount[]" placeholder="Số lượng">
                                                    </div>
                                                </td>
                                                <td class="center"><div class="box_item_price"></div></td>
                                                <td class="center"><div class="box_item_total"></div></td>
                                                <td>
                                                    <input type="hidden" name="box_item_id[]" class="box_item_id" value=""/>
                                                    <a href="#" class="add_box_item btn btn-sm btn-success" title="Thêm"><i class="fa fa-plus"></i></a>
                                                    <a href="#" class="remove_box_item btn btn-sm btn-danger hidden" title="Xóa"><i class="fa fa-minus"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right" colspan="4"><b>Cộng</b></td>
                                                <td class="center"><div class="box_subtotal"></div></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td align="right" colspan="4"><b>Giảm (<span class="box_discount_rate"><?=getvalue($obj, 'box_discount_rate', 0)?></span>%)</b></td>
                                                <td class="center"><div class="box_discount_amount"></div></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td align="right" colspan="4"><b>Tổng cộng</b></td>
                                                <td class="center"><div class="box_total"></div></td>
                                                <td></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php else: ?>
                            <div id="components" class="tab-pane fade">
                                <div class="col-lg-12 col-md-12" id="frmComponents" data-toggle="validator" role="form" method="post" action="<?=BASE_URL?>xu-ly">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-components">
                                        <thead>
                                        <tr>
                                            <th style="width: 120px;">Mã *</th>
                                            <th style="width: 250px;">Tên</th>
                                            <th style="width: 250px;">Nhóm</th>
                                            <th style="width: 140px;">Số lượng *<br/><span class="small text-danger">Chú ý đơn vị</span></th>
                                            <th style="width: 80px;">Hoạt động</th>
                                            <th style="width: 80px;">Quan trọng</th>
                                            <th style="width: 95px;">&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(!empty($components)):
                                            foreach($components as $item):
                                                ?>
                                                <tr>
                                                    <td><input type="text" class="form-control item_code" id="item_code" name="item_code[]" placeholder="Mã hàng" value="<?=getvalue($item, 'code')?>"/></td>
                                                    <td class="center"><div class="item_info"><?=getvalue($item, 'name')?></div></td>
                                                    <td class="center"><div class="item_cat"><?=!empty($item['type_name'])?$item['type_name']:''?></div></td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="item_amount" name="item_amount[]" placeholder="Số lượng" value="<?=!empty($item['amount'])?formatQuantity($item['amount'], 2):0?>"/>
                                                            <span class="item_unit input-group-addon"><?=getvalue($item, 'unit')?></span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-checkbox-with-tick">
                                                            <input id="component_active_<?=$item['id']?>" type="checkbox" value="1" class="component_active" <?=getvalue($item, 'active')?'checked="checked"':''?> autocomplete="off"/>
                                                            <label for="component_active_<?=$item['id']?>">&nbsp;</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-checkbox-with-tick">
                                                            <input id="component_important_<?=$item['id']?>" type="checkbox" value="1" class="component_important" <?=getvalue($item, 'important')?'checked="checked"':''?> autocomplete="off"/>
                                                            <label for="component_important_<?=$item['id']?>">&nbsp;</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="item_id[]" id="item_id" value="<?=getvalue($item, 'item_id')?>"/>
                                                        <a href="#" class="remove_row btn btn-sm btn-danger" title="Xóa dòng"><i class="fa fa-minus"></i></a>
                                                    </td>
                                                </tr>
                                            <?php
                                            endforeach;
                                        endif;
                                        ?>
                                        <tr>
                                            <td><input type="text" class="form-control item_code" id="item_code" name="item_code[]" placeholder="Mã hàng"/></td>
                                            <td class="center"><div class="item_info"></div></td>
                                            <td class="center"><div class="item_cat"></div></td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="item_amount" name="item_amount[]" placeholder="Định lượng">
                                                    <span class="item_unit input-group-addon"></span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-checkbox-with-tick">
                                                    <input id="component_active_new" type="checkbox" value="1" class="component_active" autocomplete="off"/>
                                                    <label for="component_active_new">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-checkbox-with-tick">
                                                    <input id="component_important_new" type="checkbox" value="1" class="component_important" autocomplete="off"/>
                                                    <label for="component_important_new">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="hidden" name="item_id[]" id="item_id" value=""/>
                                                <a href="#" class="add_row btn btn-sm btn-success" title="Thêm dòng"><i class="fa fa-plus"></i></a>
                                                <a href="#" class="remove_row btn btn-sm btn-danger hidden" title="Xóa dòng"><i class="fa fa-minus"></i></a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php endif;?>
                        <?php endif;?>
                    </div>
                    <div class="clearfix"></div>
					<div class="col-lg-6 col-md-6">
						<div class="form-group">
							<button id="submit" type="button" class="btn btn-success"><i class="fa fa-save"></i> <span>Lưu</span></button>
							<a href="<?=BASE_URL. $URIs['products']?>" class="btn btn-info"><i class="fa fa-reply"></i> Quay lại danh sách</a>
							<input type="hidden" name="action" value="admin_update_product"/>
							<input type="hidden" name="product_id" id="product_id" value="<?=$id?>"/>
						</div>
					</div>
				</form>
			</div>
			<!-- /.row -->

		<?php endif;?>
	</div>
	<!-- /#page-wrapper -->
</div>
<!-- /#content-wrapper -->