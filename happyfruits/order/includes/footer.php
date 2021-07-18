    <script src="<?=SITE_URL?>js/jquery-ui.js"></script>
    <script src="<?=SITE_URL?>js/jquery.validate.min.js"></script>
    <script src="<?=SITE_URL?>js/bootstrap.min.js"></script>
    <script src="<?=SITE_URL?>js/bootstrap-multiselect.js"></script>
    <script src="<?=SITE_URL?>js/angular.min.js"></script>
    <script src="<?=SITE_URL?>js/jstorage.js"></script>
    <script src="<?=SITE_URL?>js/sprintf.min.js"></script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=<?=env('GMAP_API_KEY', 'AIzaSyB4tmVxcWyfYgq2rGQZSwe7XP4PbXJ58s4')?>"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?=SITE_URL?>js/ie10-viewport-bug-workaround.js"></script>
    <!--[if IE]>
    <script src="<?=SITE_URL?>js/placeholders.min.js"></script>  
    <![endif]-->
    <script src="<?=SITE_URL?>js/bootstrap-datetimepicker/moment-with-locales.min.js"></script>
    <script src="<?=SITE_URL?>js/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
    <script src="<?=get_theme_assets_url()?>js/functions.js<?='?v='.VERSION?>"></script>
    <script src="<?=get_theme_assets_url()?>js/directives.js<?='?v='.VERSION?>"></script>
    <script src="<?=get_theme_assets_url()?>js/filters.js<?='?v='.VERSION?>"></script>
    <script src="<?=SITE_URL?>js/gmap.js<?='?v='.VERSION?>"></script>
    <script src="<?=get_theme_assets_url()?>js/lang.js<?='?v='.VERSION?>"></script>
    <script src="<?=get_theme_assets_url()?>js/services.js<?='?v='.VERSION.'-'.ASSET_UPDATED_DATE?>"></script>
    <?php if (!empty($main_js)):?>
    <script src="<?=SITE_URL?>js/<?=$main_js?>.js<?='?v='.VERSION?>"></script>
    <?php endif;?>
    <script>
        $(document).ready(function(){
            $(".glyphicon.glyphicon-info-sign").tooltip();
            $('.glyphicon.glyphicon-info-sign').hover(function() {changeTooltipColorTo('#6cc357')});
            $('.category').click(function(e){
                e.preventDefault();
                if ($(this).hasClass('open')){
                    $(this).removeClass('open');
                    $(this).next('.products').hide();
                    $(this).find('i').addClass('up');
                }else{
                    $(this).addClass('open');
                    $(this).next('.products').show();
                    $(this).find('i').removeClass('up');
                }
            });
            <?php if (!empty($is_off)):?>
            $('#notification_area a.icon').click(function(e){
                e.preventDefault();
                $('#myNotificationModal').show("scale", {}, 1000 );
            });
            $('#myNotificationModal .modal-dialog .modal-content .modal-close').click(function(e){
                e.preventDefault();
                var position = $('#notification_area').position();
                $('#myNotificationModal').hide("scale", {
                    percent: 0,
                    origin: [position.top,position.left]
                }, 1000 );
            });
            <?php endif;?>
        });
    </script>
    <?php include("includes/footer.inc.php");?>
