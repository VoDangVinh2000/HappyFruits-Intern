<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" ng-app="efruit" ng-controller="eFruitController as eFruit" id="ng-app" xmlns:ng="<?=ROOT_URL?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title ng-bind="<?=isset($title)?("__('".$title."') + ' - ".get_setting('site_name')."'"):get_setting('site_name')?>"><?=get_setting('site_title')?></title>

    <link rel="shortcut icon" href="<?=get_child_theme_assets_url()?>img/favicon.ico"/>
    <link rel="image_src" href="<?=get_child_theme_assets_url()?>img/main_logo.png" />
    
    <link rel="stylesheet" href="<?=SITE_URL?>css/jquery-ui.css" />
    <!-- Bootstrap core CSS -->
    <link href="<?=SITE_URL?>css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?=SITE_URL?>css/bootstrap-multiselect.css" rel="stylesheet" />
    
    <link href="<?=SITE_URL?>css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <?php  if (!empty($css)) foreach($css as $c): ?>
    <link href="<?=$c['href'].'?v='.VERSION?>" rel="stylesheet" <?=isset($c['media'])?('media="'.$c['media'].'"'):''?>  />
    <?php endforeach; ?>
    <script src="<?=SITE_URL?>js/jquery.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?=SITE_URL?>js/html5shiv.min.js"></script>
      <script src="<?=SITE_URL?>js/respond.min.js"></script>
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
      <script src="<?=SITE_URL?>js/json2.js"></script>
    <![endif]-->
    <script>
        var base_url = '<?=SITE_URL?>';
        var asset_url = '<?=get_theme_assets_url();?>';
        var version = '<?=VERSION?>';
        var default_lat = '<?=DEFAULT_LAT?>';
        var default_lng = '<?=DEFAULT_LNG?>';
        var default_saddr = default_lat + ',' + default_lng;
        var distance = 0;
        var branches = $.parseJSON('<?=json_encode($branches)?>');
        var processing_branch_index = 0;
        var default_lang = '<?=!empty($lang)?$lang:'vi'?>';
        var postback_url = base_url + 'postback.php';
        var discount_for_pre_book = <?=PRE_BOOKING_DISCOUNT?>;
        var discount_for_pre_book_2 = <?=PRE_BOOKING_DISCOUNT_2?>;
        var max_distance = <?=MAX_DISTANCE?>;
        var min_total = <?=MIN_TOTAL?>;
        var storage_key_prefix = '<?=ACTIVE_PROJECT?>_selling_';
        var domain_name = '<?=DOMAIN_NAME?>';
        <?php
        $pre_order_time = env('PREORDER_TIME', array(
            'start' => '08:00',
            'end' => '21:30'
        ));
        $pre_start = explode(':', $pre_order_time['start']);
        $pre_end = explode(':', $pre_order_time['end']);
        ?>
        var preStartHour = <?=$pre_start[0]?>;
        var preStartMinute = <?=$pre_start[1]?>;
        var preEndHour = <?=$pre_end[0]?>;
        var preEndMinute = <?=$pre_end[1]?>;
    </script>
    <?php if (!empty($extra_js)) echo "<script>$extra_js</script>";?>
  </head>
