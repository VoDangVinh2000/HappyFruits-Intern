    	<?php if($show_nav):?>
        <div id="main-menu-bg"></div>
        <?php endif;?>
    </div> <!-- / #main-wrapper -->
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
        var frontend_url = '<?=frontend_url()?>';
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

    <!-- Pixel Admin's javascripts -->



    <script src="<?=ASSET_URL?>plugins/blockUI/jquery.blockUI.min.js"></script>
    <script src="<?=ASSET_URL?>plugins/alert/alert.js"></script>
    <script src="<?=ASSET_URL?>plugins/bootbox/bootbox.min.js"></script>
    <script src="<?=ASSET_URL?>plugins/select2/select2.full.min.js"></script>
    <script src="<?=ASSET_URL?>js/pixelmenu.js"></script>
    <script src="<?=ASSET_URL?>js/init.js?v=<?=VERSION?>"></script>
    <!-- <script src="<?=ASSET_URL?>js/demo.js"></script> -->
    <?php if (!empty($js)) foreach($js as $j):?>
    <script src="<?=$j.(strstr($j, '?')==false?'?v=':'&v=').VERSION?>"></script>
    <?php endforeach;?>
    <script type="text/javascript">
        $(document).ready(function(){
            if ($('div.error_message p').length){
                alerts.init();
                var options = {
    				type: 'danger',
                    auto_close: 10,
    				namespace: 'pa_page_alerts_default'
    			};
    			alerts.add($('div.error_message p').html(), options);
            }
            if ($('.navigation > li.active').length == 0)
            <?php 
                echo "$('.$view .navigation > li.$view').addClass('open active');";
            ?>
            
            <?php
                if (!empty($charts) && is_array($charts))
                    for($i = 0; $i < count($charts); $i++)
                        echo $charts[$i]->render("chart$i");
            ?>
        });
    </script>
</body>
</html>