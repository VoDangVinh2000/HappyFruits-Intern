   <!-- HEADER -->
   <?php
    $settings = get_setting_options();
    $start_year = env('START_YEAR', 2013);
    $current_year = date('Y');
    $copy_right_year = $start_year != $current_year ? $start_year . '-' . $current_year : $start_year;
    ?>
   <header class="top-header">
       <!-- Nav 1 -->
       <nav class="navbar navbar-expand-lg navbar-dark sub-nav">
           <div class="container">
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topSubNav" aria-controls="topSubNav" aria-expanded="false" aria-label="Toggle navigation">
                   <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="topSubNav">
                   <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                       <li class="nav-item">
                           <a class="nav-link" style="text-transform:uppercase" bind-translate="Trang chủ" href="/vi">TRANG CHỦ</a>
                       </li>
                       <li class="nav-item">
                           <!-- <a class="nav-link" style="text-transform:uppercase" href="#">Blog</a> -->
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" style="text-transform:uppercase" bind-translate="Giới thiệu" href="/vi/gioi-thieu">GIỚI THIỆU</a>
                       </li>
                       <li class="nav-item">
                           <!-- <a class="nav-link" style="text-transform:uppercase" bind-translate="Cửa hàng" href="/vi">Cửa hàng</a> -->
                       </li>
                   </ul>
                   <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                       <li class="nav-item">
                           <a class="nav-link" href="/vi/lien-he/"><i class="fas fa-phone-volume"></i>
                               <?= getvalue($main_branch, 'phone_number', '0938.70.70.15 - 0906.70.70.15') ?>
                           </a>
                       </li>
                       <li class="nav-item">
                           <?php if (!empty($settings['facebook_link'])) { ?>
                               <a class="nav-link" href="<?= $settings['facebook_link'] ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                           <?php } ?>
                       </li>
                       <li class="nav-item">
                           <!-- <a class="nav-link" href="#">VI</a> -->
                       <li><a ng-click="switchLanguage('vi')" ng-class="{active:settings.language=='vi'}" href="" tabindex="-1" class="nav-link">vi</a></li>
                       </li>
                       <li class="nav-item">
                           <!-- <a class="nav-link" href="#">EN</a> -->
                       <li><a ng-click="switchLanguage('en')" ng-class="{active:settings.language=='en'}" href="" tabindex="-1" class="nav-link">en</a></li>
                       </li>
                       <li class="nav-item">
                           <!-- <a class="picto shipping" href="javascript:void(0);" ><span data-width="85px" bind-translate="Giao hàng">Giao hàng</span></a> -->
                           <a class="nav-link" href="#" onclick="showOrderFlow()" title="Vận chuyển"><i class="fas fa-shipping-fast"></i></a>
                       </li>
                       <li class="nav-item">
                           <?php if (!empty($settings['carer_link'])) { ?>
                               <a class="nav-link" href="<?= $settings['carer_link']  ?>" target="_blank" title="Tuyển dụng"><i class="fas fa-user-tie"></i></a>
                           <?php } ?>
                       </li>
                   </ul>
               </div>
           </div>
       </nav>

       <!-- Nav 2 -->
       <nav class="navbar navbar-expand-lg navbar-light logo-nav scroll-nav-mobile">
           <!--scroll-nav-mobile de position khi luot xuong, jsPage.js!-->
           <div class="container ">
               <ul class="navbar-nav ms-auto right-main-nav sub-cart">
                   <li class="nav-item">
                       <a class="nav-link position-relative btn-cart-nav efruit-cart" data-toggle="modal" data-target="#exampleModal" id="show-cart" href="#">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 13.87 16">
                               <path d="M15.8,5.219a.533.533,0,0,0-.533-.485H13.132V4.44A3.333,3.333,0,0,0,9.932,1a3.333,3.333,0,0,0-3.2,3.44v.293H4.6a.533.533,0,0,0-.533.485L3,16.419A.539.539,0,0,0,3.532,17h12.8a.539.539,0,0,0,.533-.581Zm-8-.779A2.267,2.267,0,0,1,9.932,2.067,2.267,2.267,0,0,1,12.065,4.44v.293H7.8ZM4.118,15.933,5.084,5.8H6.732v.683a1.067,1.067,0,1,0,1.067,0V5.8h4.267v.683a1.067,1.067,0,1,0,1.067,0V5.8H14.78l.965,10.133Z" transform="translate(-2.997 -1)"></path>
                           </svg><br>
                           <span ng-show="totalQuantity" class="position-absolute translate-middle badge rounded-pill bg-cart">
                               {{totalQuantity}}
                               <span class="visually-hidden">unread messages</span>
                           </span>
                       </a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#searchModal">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                               <path d="M86.065,85.194a6.808,6.808,0,1,0-.871.871L89.129,90,90,89.129Zm-1.288-.422a5.583,5.583,0,1,1,1.64-3.953A5.6,5.6,0,0,1,84.777,84.772Z" transform="translate(-74 -74)"></path>
                           </svg>
                       </a>
                   </li>
                   <li class="nav-item">
                       <?php if (isset($_SESSION['user_account'])) { ?>
                           <a class="nav-link" href="/vi/profile">
                               <i class="fas fa-user" style="font-size: 20px;"></i>
                           </a>
                       <?php } else { ?>
                   <li class="nav-item">
                       <a class="nav-link" href="/vi/dang-nhap">
                           <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16">
                               <g transform="translate(3.52)">
                                   <path d="M29.571,13.853a4.427,4.427,0,1,1,4.471-4.427A4.461,4.461,0,0,1,29.571,13.853Zm0-7.609a3.182,3.182,0,1,0,3.214,3.182A3.2,3.2,0,0,0,29.571,6.244Z" transform="translate(-25.1 -5)"></path>
                               </g>
                               <g transform="translate(0 9.173)">
                                   <path d="M21.5,63.427H20.243c0-3.076-3.017-5.582-6.734-5.582s-6.752,2.507-6.752,5.582H5.5c0-3.769,3.591-6.827,8.009-6.827S21.5,59.658,21.5,63.427Z" transform="translate(-5.5 -56.6)"></path>
                               </g>
                           </svg>
                       </a>
                   </li>
               <?php } ?>
               </li>
               <li class="nav-item">
                   <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
                       <span class="navbar-toggler-icon"></span>
                   </button>
               </li>
               </ul>
               <div class="collapse navbar-collapse">
                   <ul class="navbar-nav right-main-nav">
                       <li class="nav-item">
                           <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#searchModal">
                               <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16">
                                   <path d="M86.065,85.194a6.808,6.808,0,1,0-.871.871L89.129,90,90,89.129Zm-1.288-.422a5.583,5.583,0,1,1,1.64-3.953A5.6,5.6,0,0,1,84.777,84.772Z" transform="translate(-74 -74)"></path>
                               </svg>
                           </a>
                       </li>
                   </ul>
               </div>
               <div class="navbar-brand navbar-brand-centered">
                   <a href="/vi"><img src="<?= get_theme_assets_url() ?>img/main_logo_header.png" alt="Happy Fruits logo"></a>
               </div>
               <div class="collapse navbar-collapse">
                   <ul class="navbar-nav ms-auto right-main-nav">
                       <?php if (isset($_SESSION['user_account'])) { ?>
                           <li class="nav-item">
                               <a class="nav-link" href="/vi/profile">
                                   <i class="fas fa-user" style="font-size: 20px;"></i>
                               </a>
                           </li>
                       <?php } else {
                        ?>
                           <li class="nav-item">
                               <a class="nav-link" href="/vi/dang-nhap">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16">
                                       <g transform="translate(3.52)">
                                           <path d="M29.571,13.853a4.427,4.427,0,1,1,4.471-4.427A4.461,4.461,0,0,1,29.571,13.853Zm0-7.609a3.182,3.182,0,1,0,3.214,3.182A3.2,3.2,0,0,0,29.571,6.244Z" transform="translate(-25.1 -5)"></path>
                                       </g>
                                       <g transform="translate(0 9.173)">
                                           <path d="M21.5,63.427H20.243c0-3.076-3.017-5.582-6.734-5.582s-6.752,2.507-6.752,5.582H5.5c0-3.769,3.591-6.827,8.009-6.827S21.5,59.658,21.5,63.427Z" transform="translate(-5.5 -56.6)"></path>
                                       </g>
                                   </svg>
                               </a>
                           </li>
                       <?php } ?>
                       <div class="nav-item main-cart-btn efruit-cart" style="z-index: 99999;">
                           <a class="nav-link position-relative btn-cart-nav"  data-toggle="modal" data-target="#exampleModal" id="show-cart" href="#">
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 13.87 16">
                                   <path d="M15.8,5.219a.533.533,0,0,0-.533-.485H13.132V4.44A3.333,3.333,0,0,0,9.932,1a3.333,3.333,0,0,0-3.2,3.44v.293H4.6a.533.533,0,0,0-.533.485L3,16.419A.539.539,0,0,0,3.532,17h12.8a.539.539,0,0,0,.533-.581Zm-8-.779A2.267,2.267,0,0,1,9.932,2.067,2.267,2.267,0,0,1,12.065,4.44v.293H7.8ZM4.118,15.933,5.084,5.8H6.732v.683a1.067,1.067,0,1,0,1.067,0V5.8h4.267v.683a1.067,1.067,0,1,0,1.067,0V5.8H14.78l.965,10.133Z" transform="translate(-2.997 -1)"></path>
                               </svg><br>
                               <span ng-show="totalQuantity" class="position-absolute translate-middle badge rounded-pill bg-cart">
                                   {{totalQuantity}}
                                   <span class="visually-hidden">unread messages</span>
                               </span>
                           </a>
                       </div>
                   </ul>
               </div>
           </div> <!-- container-fluid.// -->
       </nav>

       <!-- Nav 3 -->
       <?php if (!empty($tiles)) { ?>
           <nav class="navbar navbar-expand-lg navbar-light main-nav">
               <div class="container-fluid">
                   <div class="collapse navbar-collapse" id="main-nav">
                       <ul class="navbar-nav mx-auto">
                           <?php
                            foreach ($tiles as $tile) {
                            ?>
                               <!-- $tiles được tạo từ trang functions.php, nó lấy dữ liệu từ bảng menus (menu-category) !-->
                               <li class="nav-item dropdown has-megamenu">
                                   <a class="nav-link efruit-vi text-uppercase px-3" href="<?= $tile['href'] ?>"><?= $tile['short_text'] ?></a>
                                   <a class="nav-link  efruit-en text-uppercase px-3" href="<?= $tile['href'] ?>"><?= $tile['en_text'] ?></a>

                                   <?php
                                    if (!empty($tile['sub_items']) || $tile['cat'] == 14 || $tile['cat'] == 15 || $tile['cat'] == 8) { ?>
                                       <div class="dropdown-menu megamenu" role="menu">
                                           <div class="container-mega">
                                               <!--div container-mega được css này chỉnh độ rộng bao trọn megamenu !-->
                                               <div class="row g-3 response-mega text-center">

                                                   <div class="col-lg-5">
                                                       <!-- $tile['sub_items] là các nhóm menu-con !-->
                                                       <?php if (!empty($tile['sub_items'])) {
                                                            $length = count($tile['sub_items']);
                                                        ?>
                                                           <div class="row">
                                                               <?php for ($i = 0; $i < $length; $i++) { ?>
                                                                   <div class="col-md-6 col-megamenu">
                                                                       <ul class="list-unstyled">
                                                                           <li><a href="/vi/category/nhomhang-<?= $tile['sub_items'][$i]['category_id'] ?>">
                                                                                   <span class="efruit-vi"><?= $tile['sub_items'][$i]['name'] ?></span>
                                                                                   <span class="efruit-en"><?= $tile['sub_items'][$i]['english_name'] ?></span>
                                                                               </a></li>
                                                                       </ul>
                                                                   </div> <!-- col-megamenu.// -->
                                                               <?php } ?>
                                                           </div>
                                                       <?php } ?>
                                                   </div><!-- end col-3 -->

                                                   <div class="col-lg-3">
                                                       <?php if ($tile['cat'] == 14 || $tile['cat'] == 15 || $tile['cat'] == 8) { ?>
                                                           <div class="row">
                                                               <div class="col-megamenu col-md-12">
                                                                   <ul class="list-unstyled">
                                                                       <li><a href="/vi/category/gia-1-<?= $tile['cat'] ?>">Nhỏ hơn 500k</a></li>
                                                                       <li><a href="/vi/category/gia-2-<?= $tile['cat'] ?>">500k - 799k</a></li>
                                                                       <li><a href="/vi/category/gia-3-<?= $tile['cat'] ?>">800k - 999k</a></li>
                                                                       <li><a href="/vi/category/gia-4-<?= $tile['cat'] ?>">1000k - 1499k</a></li>
                                                                       <li><a href="/vi/category/gia-5-<?= $tile['cat'] ?>">1500k - 1999k</a></li>
                                                                       <li><a href="/vi/category/gia-6-<?= $tile['cat'] ?>">2000k - 2499k</a></li>
                                                                       <li><a href="/vi/category/gia-7-<?= $tile['cat'] ?>">2500k - 3499k</a></li>
                                                                       <li><a href="/vi/category/gia-8-<?= $tile['cat'] ?>">3500k trở lên</a></li>
                                                                   </ul>
                                                               </div><!-- col-megamenu.// -->
                                                           </div>
                                                       <?php } ?>
                                                   </div><!-- end col-3 -->

                                                   <div class="col-lg-3">
                                                       <div class="row">

                                                           <?php
                                                            if ($tile['cat'] == 14) {
                                                                if (!empty($gioTraiCay)) {
                                                                    $dem = 1;
                                                                    foreach ($gioTraiCay as $item) {
                                                                        if ($dem == 1) {
                                                                            $dem++; ?>
                                                                           <div style="margin-bottom: 15px;" class="product-cat-<?= $item['category_id'] ?> <?= empty($tag_id) ? '' : 'product-tag-' . $tag_id ?> y-grid-card animate has-image compact full-width" on-ready>
                                                                               <a href="/vi/detail/<?= $item['product_id'] ?>" ng-click="showProduct(<?= $item['product_id'] ?>, $event, 1)" class="y-image">
                                                                                   <img alt="<?= $item['code'] ?>" src="<?= get_image_url($item['image'], 'square-small') ?>" class="recipe-image" />
                                                                                   <img alt="gradient-background" src="<?= get_theme_assets_url() ?>img/card-gradient.png" class="gradient" />
                                                                               </a>
                                                                               <div class="y-info">
                                                                                   <h3 class="y-title"><a style="text-overflow: inherit;white-space: unset;"><?= $item['code'] ?> - <span class="product_name efruit-vi"><?= $item['name'] ?></span><span class="product_name efruit-en"><?= $item['english_name'] ?></span></a></h3>
                                                                                   <?php if (empty($item['is_box'])) : ?>
                                                                                       <?php if ($item['price'] > 0) : ?>
                                                                                           <?php if ($item['promotion_price'] == 0) : ?>
                                                                                               <a class="y-source"><?= number_format($item['price'] * 1000) ?><sup>đ</sup></a>
                                                                                           <?php else : ?>
                                                                                               <a class="y-source"><span class="old-price"><?= number_format($item['price'] * 1000) ?><sup>đ</sup></span> <span class="new-price"><?= number_format($item['promotion_price'] * 1000) ?><sup>đ</sup></span></a>
                                                                                           <?php endif; ?>
                                                                                       <?php endif; ?>
                                                                                   <?php endif; ?>
                                                                                   <?php if ($item['description']) : ?>
                                                                                       <p class="y-ingredients efruit-vi"><?= $item['description'] ?></p>
                                                                                       <p class="y-ingredients efruit-en"><?= $item['description_en'] ?></p>
                                                                                   <?php endif; ?>
                                                                               </div>
                                                                               <?php if (!empty($item['enabled']) && empty($item['not_deliver'])) : ?>
                                                                                   <div ng-click="showProduct(<?= $item['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                                                                               <?php elseif (empty($item['enabled'])) : ?>
                                                                                   <div><img alt="sold-out" src="<?= get_theme_assets_url() ?>img/sold_out.png" class="sold_out efruit-vi" /><img alt="sold-out" class="sold_out efruit-en" src="<?= get_theme_assets_url() ?>img/sold_out_en.png" /></div>
                                                                               <?php endif; ?>
                                                                               <?php $this->load_partial('product-ribbon', array('item' => $item)); ?>
                                                                           </div>

                                                           <?php
                                                                        }
                                                                    }
                                                                }
                                                            } ?>


                                                           <?php if ($tile['cat'] == 15) {
                                                                if (!empty($hopTraiCay)) {
                                                                    $dem = 1;
                                                                    foreach ($hopTraiCay as $item) {
                                                                        if ($dem == 1) {
                                                                            $dem++;
                                                            ?>
                                                                           <div style="margin-bottom: 15px;" class="product-cat-<?= $item['category_id'] ?> <?= empty($tag_id) ? '' : 'product-tag-' . $tag_id ?> y-grid-card animate has-image compact full-width" on-ready>
                                                                               <a href="/vi/detail/<?= $item['product_id'] ?>" ng-click="showProduct(<?= $item['product_id'] ?>, $event, 1)" class="y-image">
                                                                                   <img alt="<?= $item['code'] ?>" src="<?= get_image_url($item['image'], 'square-small') ?>" class="recipe-image" />
                                                                                   <img width="320" height="320" alt="gradient-background" src="<?= get_theme_assets_url() ?>img/card-gradient.png" class="gradient" />
                                                                               </a>
                                                                               <div class="y-info">
                                                                                   <h3 class="y-title"><a style="text-overflow: inherit;white-space: unset;"><?= $item['code'] ?> - <span class="product_name efruit-vi"><?= $item['name'] ?></span><span class="product_name efruit-en"><?= $item['english_name'] ?></span></a></h3>
                                                                                   <?php if (empty($item['is_box'])) : ?>
                                                                                       <?php if ($item['price'] > 0) : ?>
                                                                                           <?php if ($item['promotion_price'] == 0) : ?>
                                                                                               <a class="y-source"><?= number_format($item['price'] * 1000) ?><sup>đ</sup></a>
                                                                                           <?php else : ?>
                                                                                               <a class="y-source"><span class="old-price"><?= number_format($item['price'] * 1000) ?><sup>đ</sup></span> <span class="new-price"><?= number_format($item['promotion_price'] * 1000) ?><sup>đ</sup></span></a>
                                                                                           <?php endif; ?>
                                                                                       <?php endif; ?>
                                                                                   <?php endif; ?>
                                                                                   <?php if ($item['description']) : ?>
                                                                                       <p class="y-ingredients efruit-vi"><?= $item['description'] ?></p>
                                                                                       <p class="y-ingredients efruit-en"><?= $item['description_en'] ?></p>
                                                                                   <?php endif; ?>
                                                                               </div>
                                                                               <?php if (!empty($item['enabled']) && empty($item['not_deliver'])) : ?>
                                                                                   <div ng-click="showProduct(<?= $item['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                                                                               <?php elseif (empty($item['enabled'])) : ?>
                                                                                   <div><img alt="sold-out" src="<?= get_theme_assets_url() ?>img/sold_out.png" class="sold_out efruit-vi" /><img alt="sold-out" class="sold_out efruit-en" src="<?= get_theme_assets_url() ?>img/sold_out_en.png" /></div>
                                                                               <?php endif; ?>
                                                                               <?php $this->load_partial('product-ribbon', array('item' => $item)); ?>
                                                                           </div>
                                                           <?php }
                                                                    }
                                                                }
                                                            } ?>


                                                           <?php if ($tile['cat'] == 8) {
                                                                if (!empty($hoaTraiCay)) {
                                                                    $dem = 1;
                                                                    foreach ($hoaTraiCay as $item) {
                                                                        if ($dem == 1) {
                                                                            $dem++;
                                                            ?>
                                                                           <div style="margin-bottom: 15px;" class="product-cat-<?= $item['category_id'] ?> <?= empty($tag_id) ? '' : 'product-tag-' . $tag_id ?> y-grid-card animate has-image compact full-width" on-ready>
                                                                               <a href="/vi/detail/<?= $item['product_id'] ?>" ng-click="showProduct(<?= $item['product_id'] ?>, $event, 1)" class="y-image">
                                                                                   <img alt="<?= $item['code'] ?>" src="<?= get_image_url($item['image'], 'square-small') ?>" class="recipe-image" />
                                                                                   <img alt="gradient-background" src="<?= get_theme_assets_url() ?>img/card-gradient.png" class="gradient" />
                                                                               </a>
                                                                               <div class="y-info">
                                                                                   <h3 class="y-title"><a style="text-overflow: inherit;white-space: unset;"><?= $item['code'] ?> - <span class="product_name efruit-vi"><?= $item['name'] ?></span><span class="product_name efruit-en"><?= $item['english_name'] ?></span></a></h3>
                                                                                   <?php if (empty($item['is_box'])) : ?>
                                                                                       <?php if ($item['price'] > 0) : ?>
                                                                                           <?php if ($item['promotion_price'] == 0) : ?>
                                                                                               <a class="y-source"><?= number_format($item['price'] * 1000) ?><sup>đ</sup></a>
                                                                                           <?php else : ?>
                                                                                               <a class="y-source"><span class="old-price"><?= number_format($item['price'] * 1000) ?><sup>đ</sup></span> <span class="new-price"><?= number_format($item['promotion_price'] * 1000) ?><sup>đ</sup></span></a>
                                                                                           <?php endif; ?>
                                                                                       <?php endif; ?>
                                                                                   <?php endif; ?>
                                                                                   <?php if ($item['description']) : ?>
                                                                                       <p class="y-ingredients efruit-vi"><?= $item['description'] ?></p>
                                                                                       <p class="y-ingredients efruit-en"><?= $item['description_en'] ?></p>
                                                                                   <?php endif; ?>
                                                                               </div>
                                                                               <?php if (!empty($item['enabled']) && empty($item['not_deliver'])) : ?>
                                                                                   <div ng-click="showProduct(<?= $item['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                                                                               <?php elseif (empty($item['enabled'])) : ?>
                                                                                   <div><img alt="sold-out" src="<?= get_theme_assets_url() ?>img/sold_out.png" class="sold_out efruit-vi" /><img alt="sold-out" class="sold_out efruit-en" src="<?= get_theme_assets_url() ?>img/sold_out_en.png" /></div>
                                                                               <?php endif; ?>
                                                                               <?php $this->load_partial('product-ribbon', array('item' => $item)); ?>
                                                                           </div>
                                                           <?php }
                                                                    }
                                                                }
                                                            } ?>

                                                       </div>
                                                   </div><!-- end col-3 -->


                                               </div>
                                           </div>
                                       </div> <!-- dropdown-mega-menu.// -->

                                   <?php } ?>
                               </li>
                           <?php } ?>
                       </ul>
                   </div>
               </div>
           </nav>
       <?php } ?>
       <!-- Modal search-->
       <form action="/vi/search" method="post">
           <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="input-group input-group-lg">
                           <input id="input-search" type="text" aria-label="Recipient's username" aria-describedby="button-addon2" name="key" class="form-control" placeholder="Search...">
                           <button name="search" value="submit" class="btn btn-outline-secondary" type="submit" id="button-addon2" style="padding: 1.5em 1.8em; border-radius: 0; background: #333; border: none;">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="white">
                                   <path d="M86.065,85.194a6.808,6.808,0,1,0-.871.871L89.129,90,90,89.129Zm-1.288-.422a5.583,5.583,0,1,1,1.64-3.953A5.6,5.6,0,0,1,84.777,84.772Z" transform="translate(-74 -74)"></path>
                               </svg>
                           </button>
                       </div>
                   </div>
               </div>
           </div>
       </form>

       <!-- Cart -->

       <?php $this->load_partial('cart-navigation') ?>

       <!-- <div class="cart-modal">
           <div class="cart-lightbox"></div>
           <div class="offcanvas-cart">
               <div class="inner">
                   <div class="head">
                       <span class="title" bind-translate="Giỏ hàng">Giỏ hàng</span>
                       <button class="offcanvas-close">×</button>
                   </div>
                   <div class="customScroll">
                       <div class="cart-empty-title">
                           <h4 class="efruit-en">Your cart is currently empty.</h4>
                           <h4 class="efruit-vi">Bạn chưa chọn món.</h4>
                       </div>
                   </div>
               </div>
           </div>
       </div> -->
   </header>

   <script>
       //    const form = document.forms[0];
       //    const selectElement = form.querySelector('input[name="searchText"]');
       //    const btnSearch = document.querySelector('#button-addon2');
       //    btnSearch.addEventListener('click', () => {
       //        let valueInput = selectElement.value;
       //    })
   </script>