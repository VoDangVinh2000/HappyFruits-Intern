<?php 
    include("includes/order.inc.php");
    $g_code = 'e'. random_string();
    $g_existed = eModel::_select_one('g_order_items', array('g_code' => $g_code));
    while($g_existed)
    {
        $g_code = 'e'. random_string();
        $g_existed = eModel::_select_one('g_order_items', array('g_code' => $g_code));
    }
    eModel::_insert('g_booking', array('g_code' => $g_code));
    $title = "Đặt hàng nhóm $g_code";
    include("includes/header.inc.php");
?>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 col-md-12 main">
            <h1 class="page-header"><a href="<?=ROOT_URL?>"><img height="40" style="float: left;" src="<?=get_child_theme_assets_url()?>img/small-logo.png"/></a>&nbsp;Đặt hàng nhóm</h1>
            <p>Mã đơn hàng của nhóm bạn là: <span style="font-weight: bold; font-size: 150%;"><?=$g_code?></span>.
            <br/>Vui lòng chia sẻ đường link dưới đây cho các thành viên trong nhóm để đặt hàng<br />
            <a href="<?=ROOT_URL?>dat-hang-nhom/<?=$g_code?>" target="_blank"><?=ROOT_URL?>dat-hang-nhom/<?=$g_code?></a>.
            <div>
                <p class="publishing"><a href="#" class="btn btn-info copy" id="copy_btn">Copy</a><a href="mailto:?subject=Đặt hàng tại <?=get_setting('short_site_name')?> - <?=$g_code?>&body=Vui lòng đặt hàng qua link sau: <?=ROOT_URL?>dat-hang-nhom/<?=$g_code?>" id="email_btn" class="btn btn-success email">Email</a></p>
                <p class="publishing">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=http://efruit.loc/dat-hang-nhom/<?=$g_code?>" target="_blank" class="social-icons facebook">&nbsp;</a>
                    <a href="https://twitter.com/home?status=http://efruit.loc/dat-hang-nhom/<?=$g_code?>" target="_blank" class="social-icons twitter">&nbsp;</a>
                    <a href="https://plus.google.com/share?url=http://efruit.loc/dat-hang-nhom/<?=$g_code?>" target="_blank" class="social-icons googleplus">&nbsp;</a>
                </p>
            </div>
            <br />Bạn có thể xem thông tin đặt hàng của nhóm tại <a target="_blank" href="<?=ROOT_URL?>nhom/<?=$g_code?>">đây</a>.
            <br />Cám ơn bạn đã đặt hàng.
            </p>
        </div>
      </div>
    </div>
    <input type="hidden" id="referer" value="<?php echo isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:''?>"/>
    <script src="<?=SITE_URL?>/js/jquery.zclip.js"></script>
    <script src="<?=SITE_URL?>js/jstorage.js"></script>
    <script>
        $(document).ready(function(){
            var hasFlash = false;
            try {
              var fo = new ActiveXObject('ShockwaveFlash.ShockwaveFlash');
              if (fo) {
                hasFlash = true;
              }
            } catch (e) {
              if (navigator.mimeTypes
                    && navigator.mimeTypes['application/x-shockwave-flash'] != undefined
                    && navigator.mimeTypes['application/x-shockwave-flash'].enabledPlugin) {
                hasFlash = true;
              }
            }
            if (hasFlash){
                if ($('div.zclip').length == 0){
                    $('a#copy_btn').zclip({
                        path: '<?=SITE_URL?>js/ZeroClipboard.swf',
                        copy:function(){return '<?=ROOT_URL?>dat-hang-nhom/<?=$g_code?>';}
                    });
                }
            }else{
                $('a#copy_btn').hide();
            }
            
            if ($.jStorage){
                $.jStorage.set('<?=$g_code?>', '<?=md5($g_code)?>');
            }
        });
    </script>
    <?php  include("includes/footer.php");?>
