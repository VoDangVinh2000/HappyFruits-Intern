<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo $page_title;?></title>

    <link rel="shortcut icon" href="<?=get_admin_theme_assets_url()?>images/favicon.ico"/>
    <link rel="image_src" href="<?=get_admin_theme_assets_url()?>images/logo.png" />
</head> 
<body>
    <div id="main" style="max-width: 960px;margin: 0 auto;">
        <h1><?php echo $obj['name'];?></h1>
        <?php echo $content; ?>
    </div>
</body>
</html>