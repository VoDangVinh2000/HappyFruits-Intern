<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex"/>
    <title><?=!empty($page_title)?"$page_title - ":''?>Hệ thống quản lý cửa hàng - <?=get_setting('short_site_name')?></title>
    
    <link rel="shortcut icon" href="<?=get_admin_theme_assets_url()?>images/favicon.ico"/>
    <!-- Core CSS - Include with every page -->
    <link href="<?=ASSET_URL?>css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?=ASSET_URL?>css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?=ASSET_URL?>css/pixel-admin.css" rel="stylesheet" />
    <link href="<?=ASSET_URL?>css/themes.css" rel="stylesheet" />
    <link href="<?=ASSET_URL?>css/custom-checkbox.css" rel="stylesheet" />
    <link href="<?=ASSET_URL?>plugins/select2/select2.min.css" rel="stylesheet" />

    <!-- Thêm css cho các mẫu: LAV -->
    <link href="<?=ASSET_URL?>css/header-page-copy.css" rel="stylesheet" />

    
    <!--[if lt IE 9]>
		<script src="<?=ASSET_URL?>js/ie.min.js"></script>
	<![endif]-->
    
    <!-- Custom styles for each templates -->
    <?php  if (!empty($css)) foreach($css as $c): ?>
    <link href="<?=(is_array($c)?$c['href']:$c).'?v='.VERSION?>" rel="stylesheet" <?=isset($c['media'])&&is_array($c)?('media="'.$c['media'].'"'):''?>  />
    <?php endforeach; ?>
    
    <link href="<?=ASSET_URL?>css/main.css" rel="stylesheet" />
    <!--[if !IE]> -->
	<script type="text/javascript"> window.jQuery || document.write('<script src="<?=ASSET_URL?>js/jquery.min.js">'+"<"+"/script>"); </script>
    <!-- <![endif]-->
    <!--[if lte IE 9]>
	<script type="text/javascript"> window.jQuery || document.write('<script src="<?=ASSET_URL?>js/jquery.min.1.8.3.js">'+"<"+"/script>"); </script>
    <![endif]-->
    <script src="<?=ASSET_URL?>js/bootstrap.min.js"></script>
    <script src="<?=ASSET_URL?>plugins/slimscroll/slimscroll.js"></script>
</head>
<body class="theme-default <?=$view. ' '. $action?>">
    <div id="main-wrapper" <?=empty($show_nav)?'class="not-show-nav"':''?>>