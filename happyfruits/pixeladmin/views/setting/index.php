<div id="content-wrapper">
	<?php $controlerObj->load_view('elements/breadcrumb');?>
	<?php $controlerObj->load_view('elements/pageheader');?>
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<?php if ($settings): ?>
					<form id="frmSettings" data-toggle="validator" class="one-line" role="form" method="post" action="<?=BASE_URL?>xu-ly">
                        <ul class="nav nav-tabs">
                            <?php $i = 0; foreach($settings as $cat_name => $items) :?>
                            <li <?=$i==0?'class="active"':''?>><a data-toggle="tab" href="#<?=sanitize_string($cat_name)?>"><?=$cat_name?></a></li>
                            <?php $i++; endforeach; ?>
                        </ul>
                        <div class="tab-content">
                            <?php $i = 0; foreach($settings as $cat_name => $items) :?>
                            <div id="<?=sanitize_string($cat_name)?>" class="tab-pane fade <?=$i==0?'in active':''?>">
                                <?php foreach($items as $s):?>
                                    <div class="form-group">
                                        <label class="control-label" for="<?=$s['option_name']?>"><?=$s['name']?$s['name']:$s['option_name']?></label>
                                        <?php if($s['field_type'] == 'text'): ?>
                                            <textarea rows="8" class="form-control" id="<?=$s['option_name']?>" name="<?=$s['option_name']?>" ><?=$s['option_value']?></textarea>
                                            <?php if($s['has_en_option']):?>
                                            <label class="control-label text-normal" for="<?=$s['option_name']?>_en">Tiếng Anh</label>
                                            <textarea rows="8" class="form-control" id="<?=$s['option_name']?>_en" name="<?=$s['option_name']?>_en" ><?=$s['option_value_en']?></textarea>
                                            <?php endif;?>
                                        <?php elseif($s['field_type'] == 'html'): ?>
                                            <?php if($s['has_en_option']):?>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h5>Tiếng Việt</h5>
                                                    <textarea rows="8" class="form-control ckeditor" id="<?=$s['option_name']?>" name="<?=$s['option_name']?>" ><?=$s['option_value']?></textarea>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h5>Tiếng Anh</h5>
                                                    <textarea rows="8" class="form-control ckeditor" id="<?=$s['option_name']?>_en" name="<?=$s['option_name']?>_en" ><?=$s['option_value_en']?></textarea>
                                                </div>
                                            </div>
                                            <div style="margin-bottom: 20px;" class="clearfix">
                                            <?php else:?>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <textarea rows="8" class="form-control ckeditor" id="<?=$s['option_name']?>" name="<?=$s['option_name']?>" ><?=$s['option_value']?></textarea>
                                                </div>
                                            </div>
                                            <div style="margin-bottom: 20px;" class="clearfix">
                                            <?php endif;?>
                                        <?php elseif($s['field_type'] == 'boolean'): ?>
                                            <div class="custom-checkbox-with-tick inline">
                                                <input type="checkbox" autocomplete="off" id="<?=$s['option_name']?>" name="<?=$s['option_name']?>" <?=$s['option_value']==1?'checked':''?> value="1"/>
                                                <label style="margin-left: 0;" for="<?=$s['option_name']?>">&nbsp;</label>
                                            </div>
                                        <?php elseif($s['field_type'] == 'image'): ?>
                                            <div class="input-group <?=$s['option_name']?>-container">
                                                <input type="text" class="form-control image-option" id="<?=$s['option_name']?>" name="<?=$s['option_name']?>" placeholder="Ảnh" value="<?=$s['option_value']?>">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-warning select_image" data-index="<?=$s['option_name']?>" type="button">Chọn</button>
                                                </div>
                                            </div>
                                            <label class="control-label">&nbsp;</label>
                                            <div class="preview_image preview_<?=$s['option_name']?>">
                                                <?php if(!empty($s['option_value'])):?><img src="<?=$s['option_value']?>" height="110"><?php endif; ?>
                                            </div>
                                        <?php else: ?>
                                            <input type="text" class="form-control <?=$s['field_type']?>" id="<?=$s['option_name']?>" name="<?=$s['option_name']?>" value="<?=$s['option_value']?>" />
                                            <?php if($s['has_en_option']):?>
                                            <br/>
                                            <label class="control-label text-normal" for="<?=$s['option_name']?>_en">Tiếng Anh</label>
                                            <input type="text" class="form-control <?=$s['field_type']?>" id="<?=$s['option_name']?>_en" name="<?=$s['option_name']?>_en" value="<?=$s['option_value_en']?>" />
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach;?>
                            </div>
                            <?php $i++; endforeach; ?>
                        </div>
						<div class="form-group">
							<button id="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <span>Lưu</span></button>
							<input type="hidden" name="action" value="admin_update_settings"/>
						</div>
					</form>
				<?php else: ?>
					<p>Không có dữ liệu.</p>
				<?php endif;?>
			</div>
		</div>

	</div>
	<!-- /#page-wrapper -->
</div>
<!-- /#content-wrapper -->