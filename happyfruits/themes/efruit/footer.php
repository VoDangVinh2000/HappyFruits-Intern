    </div> <!-- / .content -->
    <?php $this->load_theme_file('page-modals.php') ?>
    <input type="hidden" id="referer" value="<?php echo isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:''?>"/>
    <?php $this->load_theme_file('page-subscribe') ?>
    <script src="<?=get_theme_assets_url()?>js/jquery.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<//?=get_theme_assets_url()?>js/html5shiv.min.js"></script>
      <script src="<//?=get_theme_assets_url()?>js/respond.min.js"></script>
    <![endif]-->
    <!--[if lte IE 8]>
      <script>
        document.createElement('ng-include');
        document.createElement('ng-pluralize');
        document.createElement('ng-view');

        // Optionally these for CSS
        document.createElement('ng:include');
        document.createElement('ng:pluralize');
        document.createElement('ng:view');
      </script>
    <![endif]-->
    <!--[if lte IE 7]>
      <script src="<//?=get_theme_assets_url()?>js/json2.js"></script>
    <![endif]-->
    <!--[if IE]>
      <script src="<//?=get_theme_assets_url()?>js/placeholders.min.js"></script>  
    <![endif]-->
    <script>
        document.addEventListener('touchstart', function(){}, {passive: true});
        var base_url = '<?=ROOT_URL?>';
        var version = '<?=VERSION?>';
        var asset_url = '<?=get_theme_assets_url();?>';
        var postback_url = base_url + 'frontend/';
        <?php if (!empty($branches)): ?>
        var branches = $.parseJSON('<?=json_encode($branches)?>');
        <?php endif; ?>
        var default_lat = '<?=DEFAULT_LAT?>';
        var default_lng = '<?=DEFAULT_LNG?>';
        var distance = 0;
        var max_distance = <?=MAX_DISTANCE?>;
        var min_total = <?=MIN_TOTAL?>;
        var domain_name = '<?=DOMAIN_NAME?>';
    </script>
<?php if(!empty($pre_js)): foreach($pre_js as $j):?>
    <script src="<?=$j?>"></script>
<?php endforeach; endif;?>
    <script src="<?=get_theme_assets_url()?>js/plugins/bootstrap-datetimepicker/moment-with-locales.min.js"></script>
    <?php 
        /* Merge all js files to one */
        if(IS_LOCAL)
        {
            $js_file = array(
                'jquery-ui.js',
                'jquery.validate.min.js',
                'bootstrap.min.js',
                'bootstrap-multiselect.js',
                'angular.min.js',
                'jstorage.js',
                'sprintf.min.js',
                'lang.js',
                'functions.js',
                'directives.js',
                'filters.js',
                'services.js',
                'plugins/bootbox.min.js',
                'plugins/parallax.js',
                'plugins/jquery.backstretch.min.js',
                'plugins/jquery.ui.totop.js',
                'masonry/masonry.ef.js',
                'masonry/angular-masonry.min.js',
                'plugins/select2.js',
                'plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js',
	            'plugins/jquery.countdown/jquery.countdown.min.js',
                'plugins/owl-carousel-2.3.4/owl.carousel.min.js',
                'plugins/qrcode/jquery-qrcode-0.17.0.min.js',
                'plugins/localscroll/jquery.localscroll-1.2.7.js',
                'plugins/superfish/hoverIntent.js',
                'plugins/superfish/superfish.min.js',
                'plugins/fancybox/jquery.mousewheel-3.0.6.pack.js',
                'plugins/fancybox/jquery.fancybox.pack.js',
                'forms.js',
                'gmap.js',
                'app.js',
                'main.js'
            );
            minifyJS($js_file, ASSET_UPDATED_DATE.'/e');
        }
    ?>
    <script src="<?=get_theme_assets_url().ASSET_UPDATED_DATE?>/e.min.js?v=<?=VERSION?>"></script>
    <?php
        $target_filename = 'e'.$template;
        if (IS_LOCAL)
        {
        	if (!empty($js))
                minifyJS($js, ASSET_UPDATED_DATE.'/'.$target_filename);
        }
    ?>
    <?php if (!empty($js)):?>
    <script src="<?=get_theme_assets_url().ASSET_UPDATED_DATE.'/'.$target_filename?>.min.js?v=<?=VERSION?>"></script>
    <?php endif; ?>
    <?php if(IS_LIVE ):?>
    <script type="text/javascript">
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)
                [0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
        if (typeof ga != 'undefined') {
            ga('create', '<?=GA_ID?>', 'auto');
            ga('send', 'pageview');
        } else {
            window.setTimeout( function() {
                ga('create', '<?=GA_ID?>', 'auto');
                ga('send', 'pageview');
            }, 500 );
        }

    </script>
    
    <?php endif;?>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?=env('GMAP_API_KEY', 'AIzaSyB4tmVxcWyfYgq2rGQZSwe7XP4PbXJ58s4')?>&libraries=places&sensor=false&language=vi"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="<?=get_theme_assets_url()?>js/sitescripts.js"></script>
    <script src="<?=get_theme_assets_url()?>js/simpleLightbox.min.js"></script>

</body>
</html>