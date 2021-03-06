<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="<?= $language_code ?>" xmlns="http://www.w3.org/1999/xhtml" ng-app="efruit" ng-controller="eFruitController as eFruit" id="ng-app" xmlns:ng="<?= ROOT_URL ?>">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= isset($page_title) ? ($page_title . ' - ') : '' ?><?= get_setting('site_title') ?></title>
    <meta name="keywords" content="<?= META_KEYWORDS ?>" />
    <meta name="description" content="<?= META_DESCRIPTION ?>" />

    <meta property="og:title" content="<?= get_setting('site_title') ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= ROOT_URL_WITHOUT_SLASH ?>" />
    <meta property="og:description" content="<?= META_DESCRIPTION ?>" />
    <meta property="og:keywords" content="<?= META_KEYWORDS ?>" />
    <meta property="og:image" content="<?= get_child_theme_assets_url() ?>img/main_logo.png" />

    <link rel="shortcut icon" href="<?= get_child_theme_assets_url() ?>img/favicon.ico" />
    <link rel="image_src" href="<?= get_child_theme_assets_url() ?>img/main_logo.png" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">

    <?php
    $preload_issue_links = array(
        get_theme_assets_url() . 'fonts/UVNBaiSau_R.ttf',
        get_theme_assets_url() . 'fonts/AmericanTypewriter.woff',
        get_theme_assets_url() . 'fonts/fontawesome-webfont.woff?v=4.0.3'
    );
    foreach ($preload_issue_links as $preload_link) :
    ?>
        <link rel="preload" href="<?= $preload_link ?>" as="font" crossorigin="anonymous">
    <?php endforeach; ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="<?= get_theme_assets_url() ?>css/pixel.ef.css" rel="stylesheet" />
    <link href="<?= get_theme_assets_url() ?>css/hover.ef.css" rel="stylesheet" />
    <link href="<?= get_theme_assets_url() ?>js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <?php
    global $is_off2;
    if (!IS_LIVE) {
        $css_files = array(
            get_theme_assets_url() . 'js/plugins/owl-carousel-2.3.4/owl.carousel.min.css',
            get_theme_assets_url() . 'js/plugins/fancybox/jquery.fancybox.css',
            'custom-checkbox.css',
            'main.css'
        );
        minifyCSS($css_files, ASSET_UPDATED_DATE . '/main');
    }
    ?>
    <?php /*if (env('CHILD_THEME')) : ?>
        <link href="<?= get_child_theme_assets_url() ?>css/main.css" rel="stylesheet" />
    <?php endif;*/ ?>
    <!--Th???c t???p !-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--end!-->
    <!-- <link href="<? //= get_theme_assets_url() . ASSET_UPDATED_DATE 
                        ?>/main.min.css" rel="stylesheet" /> -->
    <link href="<?= get_theme_assets_url() ?>css/styles-all.css?v=<?= VERSION ?>" rel="stylesheet" />
    <?php if (env('CHILD_THEME')) : ?>
        <!-- <link href="<? //= get_child_theme_assets_url() 
                            ?>css/main.css?v=<?= VERSION ?>" rel="stylesheet" /> -->
        <link href="<?= get_theme_assets_url() ?>css/thuctap/header-page.css" rel="stylesheet" />
    <?php endif; ?>
    <!-- Custom styles for this template -->
    <?php if (!empty($css)) foreach ($css as $c) : ?>
        <link href="<?= (is_array($c) ? $c['href'] : $c) . '?v=' . VERSION ?>" rel="stylesheet" <?= isset($c['media']) && is_array($c) ? ('media="' . $c['media'] . '"') : '' ?> />
    <?php endforeach; ?>

    <!--Th???c t???p !-->
    <link href="<?= get_theme_assets_url() ?>css/thuctap/footer.css" rel="stylesheet" />
    <link href="<?= get_theme_assets_url() ?>css/thuctap/cart.css" rel="stylesheet" />
    <link href="<?= get_theme_assets_url() ?>css/thuctap/simpleLightbox.min.css" rel="stylesheet" />
    <link href="<?= get_theme_assets_url() ?>css/thuctap/stylePageAccount.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= get_theme_assets_url() ?>/css/thuctap/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= get_theme_assets_url() ?>/css/thuctap/owl.theme.default.css">
    <link rel="stylesheet" href="<?= get_theme_assets_url() ?>/css/thuctap/cart.css">
    <link rel="stylesheet" href="<?= get_theme_assets_url() ?>/css/thuctap/stylePageAccount.css">
    <link rel="stylesheet" href="<?= get_theme_assets_url() ?>css/thuctap/step2.css">



    <!--end!-->

    <script>
        var products = <?= !empty($products) ? json_encode($products) : '[]' ?>;
        var default_tag = <?= DEFAULT_TAG_ID ?>;
        var items_per_page = <?= NUMBER_OF_ITEMS_PER_PAGE ?>;
        var is_home = <?= $template == 'home' ? 1 : 0 ?>;
        var discount_for_pre_book = <?= PRE_BOOKING_DISCOUNT ?>;
        var discount_for_pre_book_2 = <?= PRE_BOOKING_DISCOUNT_2 ?>;
        var is_off2 = <?= $is_off2 ?>;
        var default_lang = '<?= !empty($lang) ? $lang : 'vi' ?>';
        var user_ip = '<?= get_user_ip() ?>';
        var storage_key_prefix = '<?= ACTIVE_PROJECT ?>_';
        <?php
        $pre_order_time = env('PREORDER_TIME', array(
            'start' => '08:00',
            'end' => '21:30'
        ));
        $pre_start = explode(':', $pre_order_time['start']);
        $pre_end = explode(':', $pre_order_time['end']);
        ?>
        var preStartHour = <?= $pre_start[0] ?>;
        var preStartMinute = <?= $pre_start[1] ?>;
        var preEndHour = <?= $pre_end[0] ?>;
        var preEndMinute = <?= $pre_end[1] ?>;
    </script>
    <?php $this->load_partial('global-style') ?>
    <?php $this->load_partial('officefruit-style') ?>
    <?php if (empty($is_simple_view)) : ?>
        <script async src="//code.tidio.co/<?= env('TIDIO_ID', 'oad7aakcwalvnr5sricbibisxmoja5og') ?>.js"></script>
    <?php endif; ?>
    <!-- <script data-ad-client="ca-pub-4832470232865505" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> -->

    <script src="<?= get_theme_assets_url() ?>js/thuctap/getpagescroll.js"></script>
    <style>
        .fancybox-margin {
            /* content: '';
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1001;
            background: rgb(0 0 0 /50%); */
            top: 0;
            position: fixed;
            content: "";
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1000;
        }

        .fancybox-overlay .fancybox-overlay-fixed {
            width: auto !important;
            height: 60vh !important;
            z-index: 1002 !important;
        }

        .fancybox-wrap .fancybox-desktop .fancybox-type-image .fancybox-opened {
            z-index: 1002 !important;
        }
    </style>
</head>

<!-- onscroll="getPageScroll()"  -->

<body onscroll="getPageScroll()" class="frontend views-<?= $template ?> <?= !empty($page_code) ? 'uri-' . $page_code : '' ?>" on-ready>
    <div id="loading" ng-class="{hidden:1}">
        <div>
            <img alt="logo" height="76" src="<?= get_child_theme_assets_url() ?>img/small-logo.png" />
            <div class="spinner">
                <div class="rect1"></div>
                <div class="rect2"></div>
                <div class="rect3"></div>
                <div class="rect4"></div>
                <div class="rect5"></div>
            </div>
        </div>
    </div>