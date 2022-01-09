<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo $page_title;?></title>
    
    <link rel="shortcut icon" href="<?=get_admin_theme_assets_url()?>images/favicon.ico"/>
    <link rel="image_src" href="<?=get_admin_theme_assets_url()?>images/logo.png" />
    
    <link href="<?=ASSET_URL?>css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?=ASSET_URL?>css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?=ASSET_URL?>plugins/select2/select2.min.css" rel="stylesheet" />
    
    <!--[if !IE]> -->
	<script type="text/javascript"> window.jQuery || document.write('<script src="<?=ASSET_URL?>js/jquery.min.js">'+"<"+"/script>"); </script>
    <!-- <![endif]-->
    <!--[if lte IE 9]>
	<script type="text/javascript"> window.jQuery || document.write('<script src="<?=ASSET_URL?>js/jquery.min.1.8.3.js">'+"<"+"/script>"); </script>
    <![endif]-->
    <script src="<?=ASSET_URL?>js/bootstrap.min.js"></script>
    <script src="<?=ASSET_URL?>plugins/slimscroll/slimscroll.js"></script>
    
    <style>
        .fa{font-family: FontAwesome;font-style: normal;}
        #main-wrapper{margin: 20px;}
        #list_container{}
        #list_container .actions button{margin: 5px 0;}
        #list_container .btn{padding: 2px 6px;}
        #list_container tr.recent td{background-color: #fffacd;}
    </style>
</head> 
<body>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-4">
                <h1 style="margin: 5px 0;"><?php echo $page_title;?></h1>
            </div>
            <div class="col-md-8">
                <a style="margin: 5px 0;" id="reload" class="btn btn-success" href="#" ><i class="fa fa-refresh"></i> Tải lại trang</a>&nbsp;&nbsp;
	            <?php if(Users::can('view_all', 'order') && count($branches) > 1):?>
		            <div style="width: 160px;display: inline-block;">
			            <?php echo html_select($branches, 'id', 'branch_name', 'id="filter_branch" class="filter_branch form-control" style="margin: 5px 0;"', '-- Tất cả chi nhánh', $selected_branch_id)?>
		            </div>
	            <?php endif; ?>
	            <div style="width: 160px;display: inline-block;">
		            <?php echo html_select($order_types, 'id', 'type_name', 'id="filter_type" class="filter_type form-control" style="margin: 5px 0;"', '-- Tất cả đơn hàng')?>
	            </div>
            </div>
        </div>
        <?php if (count($b_arr) == 2):?>
        <div class="row note-container" style="margin-top: 10px;margin-bottom: 10px;" >
            <div class="col-lg-6">
                <label>Ghi chú gửi cho <?=$b_arr[LHP_BRANCH_ID]['branch_name']?></label>
	            <div id="note-in-text1" style="font-size: 1.1em"><?php echo nl2br($b_arr[LHP_BRANCH_ID]['note_on_processing_screen']); ?></div>
	            <?php if($logged_user['branch_id'] == HTC_BRANCH_ID || Users::can('edit_note', 'order')): ?>
                    <textarea autocomplete="off" rows="6" placeholder="Ghi chú gửi cho <?=$b_arr[LHP_BRANCH_ID]['branch_name']?>" class="form-control hidden" id="note1"><?=$b_arr[LHP_BRANCH_ID]['note_on_processing_screen']?></textarea>
                    <br/>
	                <button id="edit_note_1" data-branch-id="<?=$b_arr[LHP_BRANCH_ID]['id']?>" class="btn btn-warning edit-note">Sửa ghi chú</button>
                    <button id="save_note_1" data-branch-id="<?=$b_arr[LHP_BRANCH_ID]['id']?>" class="btn btn-success save-note hidden">Lưu ghi chú</button>
                    <br/><br/>
                <?php endif;?>
            </div>
            <div class="col-lg-6">
                <label>Ghi chú gửi cho <?=$b_arr[HTC_BRANCH_ID]['branch_name']?></label>
	            <div id="note-in-text2" style="font-size: 1.1em"><?php echo nl2br($b_arr[HTC_BRANCH_ID]['note_on_processing_screen']); ?></div>
	            <?php if($logged_user['branch_id'] == LHP_BRANCH_ID): ?>
                    <textarea autocomplete="off" rows="6" placeholder="Ghi chú gửi cho <?=$b_arr[HTC_BRANCH_ID]['branch_name']?>" class="form-control hidden" id="note2"><?=$b_arr[HTC_BRANCH_ID]['note_on_processing_screen']?></textarea>
                    <br/>
	                <button id="edit_note_2" data-branch-id="<?=$b_arr[HTC_BRANCH_ID]['id']?>" class="btn btn-warning edit-note">Sửa ghi chú</button>
                    <button id="save_note_2" data-branch-id="<?=$b_arr[HTC_BRANCH_ID]['id']?>" class="btn btn-success save-note hidden">Lưu ghi chú</button>
                <?php endif;?>
            </div>
        </div>
        <?php elseif(count($b_arr) == 1):?>
	    <div class="row note-container" style="margin-top: 10px;margin-bottom: 10px;" >
	        <div class="col-lg-12">
		        <label>Ghi chú</label>
		        <div id="note-in-text1" style="font-size: 1.1em"><?php echo nl2br($b_arr[LHP_BRANCH_ID]['note_on_processing_screen']); ?></div>
		        <?php if(Users::can('add_note', 'order')):?>
			        <textarea autocomplete="off" style="margin-bottom: 5px;" rows="6" placeholder="Ghi chú" class="form-control hidden" id="note1"><?=$b_arr[LHP_BRANCH_ID]['note_on_processing_screen']?></textarea>
			        <br/>
			        <button id="edit_note_1" data-branch-id="<?=$b_arr[LHP_BRANCH_ID]['id']?>" class="btn btn-warning edit-note">Sửa ghi chú</button>
			        <button id="save_note_1" data-branch-id="<?=$b_arr[LHP_BRANCH_ID]['id']?>" class="btn btn-success save-note hidden">Lưu ghi chú</button>
			        <button id="run_sound" class="btn btn-warning">Ding!</button>
		        <?php endif;?>
	        </div>
	    </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-12">
                <div id="list_container" class="table-responsive">
                    <?php $controlerObj->load_view("order/manage_list");?>
                </div>
            </div>
        </div>
	    <?php if(Users::is_super_admin()):?>
	    <div class="row">
		    <div class="col-md-8">
			    <h3 style="display: inline-block;margin: 0;">Trạng thái</h3>&nbsp;
			    <a style="margin: 5px 0;" id="overload_0" data-period="0" class="overload btn btn-success" href="#" ><i class="fa fa-check"></i> Bình thường</a>&nbsp;&nbsp;
			    <a style="margin: 5px 0;" id="overload_60" data-period="60" class="overload btn btn-warning" href="#" ><i class="fa fa-exclamation-triangle"></i> Quá tải 60p</a>&nbsp;&nbsp;
			    <a style="margin: 5px 0;" id="overload_90" data-period="90" class="overload btn btn-danger" href="#" ><i class="fa fa-exclamation-triangle"></i> Quá tải 90p</a>&nbsp;&nbsp;
			    <a style="margin: 5px 0;" id="overload_120" data-period="120" class="overload btn btn-danger" href="#" ><i class="fa fa-exclamation-triangle"></i> Quá tải 120p</a>&nbsp;&nbsp;
		    </div>
	    </div>
	    <?php endif; ?>
	    <audio id="ding" src="<?=ASSET_URL?>music/ding.ogg" type="audio/ogg"></audio>
    </div>
    <?php
        $error = get_last_error($data_return);
        if ($error):
    ?>
    <div class="error_message" style="display: none;">
		<p><?=$error?></p>
	</div>
    <?php endif;?>
    <script>
        var base_url = '<?php echo BASE_URL;?>';
        var asset_url = '<?php echo ASSET_URL;?>';
        var postback_url = base_url + 'xu-ly/';
        var default_lat = '<?=DEFAULT_LAT?>';
        var default_lng = '<?=DEFAULT_LNG?>';
        var default_saddr = default_lat + ',' + default_lng;
        <?php if (!empty($URIs) && is_array($URIs)):
            $uris_string = '';
            foreach($URIs as $page => $alias){
                if ($uris_string)
                    $uris_string .= ',';
                $uris_string .= "'$page':'$alias'";
            }
        ?>
        var URIs = {<?=$uris_string?>};
        var branches = $.parseJSON('<?=json_encode($branches_arr)?>');
        var domain_name = '<?=DOMAIN_NAME?>';
        <?php endif;?>
    </script>
    <script src="<?=ASSET_URL?>plugins/blockUI/jquery.blockUI.min.js"></script>
    <script src="<?=ASSET_URL?>plugins/alert/alert.js"></script>
    <script src="<?=ASSET_URL?>plugins/bootbox/bootbox.min.js"></script>
    <script src="<?=ASSET_URL?>plugins/select2/select2.full.min.js"></script>
    <script src="<?=ASSET_URL?>js/pixelmenu.js"></script>
    <script src="<?=ASSET_URL?>js/init.js?v=<?=VERSION?>"></script>
    <script src="<?=ASSET_URL?>js/order/manage.js"></script>
    <script type="text/javascript">
	    var make_a_ding = 0;
        $(document).ready(function(){
            if ($('div.error_message p').length){
                alerts.init();
                var options = {
    				type: 'danger',
                    auto_close: 10,
    				namespace: 'pa_page_alerts_default'
    			};
    			alerts.add($('div.error_message p').html(), options);
            };
            $('#run_sound').click(function(e){
            	e.preventDefault();
		        //$('#ding').get(0).play();
	            make_a_ding = 1;
	        });
        });
    </script>
    <script type="text/javascript"><?php loadJS('http://maps.googleapis.com/maps/api/js?key='.env('GMAP_API_KEY', 'AIzaSyB4tmVxcWyfYgq2rGQZSwe7XP4PbXJ58s4'));?></script>
</body>
</html>