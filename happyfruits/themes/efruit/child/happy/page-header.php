   <!-- HEADER -->

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
                           <a class="nav-link" style="text-transform:uppercase" href="#">Blog</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" style="text-transform:uppercase" bind-translate="Giới thiệu" href="/vi/gioi-thieu">GIỚI THIỆU</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" style="text-transform:uppercase" bind-translate="Cửa hàng" href="/vi">Cửa hàng</a>
                       </li>
                   </ul>
                   <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                       <li class="nav-item">
                           <a class="nav-link" href="/vi/lien-he/"><i class="fas fa-phone-volume"></i> 0938.70.70.15</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" href="https://www.facebook.com/happyfruitsvietnam/"><i class="fab fa-facebook-f"></i></a>
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
                           <a class="nav-link" href="/tuyen-dung" title="Tuyển dụng"><i class="fas fa-user-tie"></i></a>
                       </li>
                   </ul>
               </div>
           </div>
       </nav>

       <!-- Nav 2 -->
       <nav class="navbar navbar-expand-lg navbar-light logo-nav">
           <div class="container">
               <ul class="navbar-nav ms-auto right-main-nav sub-cart">
                   <li class="nav-item">
                       <a class="nav-link position-relative btn-cart-nav" id="show-cart" href="#">
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
                       <a class="nav-link" href="#">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                               <g transform="translate(3.52)">
                                   <path d="M29.571,13.853a4.427,4.427,0,1,1,4.471-4.427A4.461,4.461,0,0,1,29.571,13.853Zm0-7.609a3.182,3.182,0,1,0,3.214,3.182A3.2,3.2,0,0,0,29.571,6.244Z" transform="translate(-25.1 -5)"></path>
                               </g>
                               <g transform="translate(0 9.173)">
                                   <path d="M21.5,63.427H20.243c0-3.076-3.017-5.582-6.734-5.582s-6.752,2.507-6.752,5.582H5.5c0-3.769,3.591-6.827,8.009-6.827S21.5,59.658,21.5,63.427Z" transform="translate(-5.5 -56.6)"></path>
                               </g>
                           </svg>
                       </a>
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
                       <li class="nav-item main-cart-btn">
                           <a class="nav-link position-relative btn-cart-nav" id="show-cart" href="#">
                               <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 13.87 16">
                                   <path d="M15.8,5.219a.533.533,0,0,0-.533-.485H13.132V4.44A3.333,3.333,0,0,0,9.932,1a3.333,3.333,0,0,0-3.2,3.44v.293H4.6a.533.533,0,0,0-.533.485L3,16.419A.539.539,0,0,0,3.532,17h12.8a.539.539,0,0,0,.533-.581Zm-8-.779A2.267,2.267,0,0,1,9.932,2.067,2.267,2.267,0,0,1,12.065,4.44v.293H7.8ZM4.118,15.933,5.084,5.8H6.732v.683a1.067,1.067,0,1,0,1.067,0V5.8h4.267v.683a1.067,1.067,0,1,0,1.067,0V5.8H14.78l.965,10.133Z" transform="translate(-2.997 -1)"></path>
                               </svg><br>
                               <span ng-show="totalQuantity" class="position-absolute translate-middle badge rounded-pill bg-cart">
                                   {{totalQuantity}}
                                   <span class="visually-hidden">unread messages</span>
                               </span>
                           </a>
                       </li>
                   </ul>
               </div>
           </div> <!-- container-fluid.// -->
       </nav>

       <!-- Nav 3 -->
       <?php if (!empty($tiles)) { ?>
           <nav class="navbar navbar-expand-lg navbar-light main-nav">
               <div class="container">
                   <div class="collapse navbar-collapse" id="main-nav">
                       <ul class="navbar-nav mx-auto">
                           <li class="nav-item dropdown has-megamenu">
                               <?php foreach ($tiles as $tile) {
                                    if ($tile['cat'] == 14) { ?>
                                       <a class="nav-link dropdown-toggle efruit-vi px-5" href="<?= $tile['href'] ?>" data-bs-toggle="dropdown">GIỎ TRÁI CÂY</a>
                                       <a class="nav-link dropdown-toggle efruit-en px-5" href="<?= $tile['href'] ?>" data-bs-toggle="dropdown">FRUIT BASKETS</a>
                               <?php }
                                } ?>
                               <div class="dropdown-menu megamenu" role="menu">
                                   <div class="container-mega">
                                       <!--div container-mega được css này chỉnh độ rộng bao trọn megamenu !-->
                                       <div class="row g-3 response-mega">
                                           <!--response-mega đc css để responsive of device!-->
                                           <div class="col-lg-5">
                                               <div class="row">
                                                   <?php
                                                    if (!empty($megaMenu_fruits_baskets)) {
                                                        foreach ($megaMenu_fruits_baskets as $array) {
                                                    ?>
                                                           <div class="col-md-6 col-megamenu">

                                                               <ul class="list-unstyled">
                                                                   <li><a href="">
                                                                           <span class="efruit-vi"><?= $array['name'] ?></span>
                                                                           <span class="efruit-en"><?= $array['english_name'] ?></span>
                                                                       </a></li>
                                                               </ul>
                                                           </div> <!-- col-megamenu.// -->
                                                   <?php }
                                                    }
                                                    ?>
                                               </div>
                                           </div><!-- end col-3 -->
                                           <div class="col-lg-4">
                                               <div class="row">
                                                   <div class="col-megamenu col-md-12">
                                                       <ul class="list-unstyled">
                                                           <li><a href="/vi/category/gia1-14-200k-500k">200k - 500k</a></li>
                                                           <li><a href="/vi/category/gia2-14">500k - 800k</a></li>
                                                           <li><a href="/vi/category/gia3-14">800k - 1000k</a></li>
                                                           <li><a href="/vi/category/gia4-14">1100k - 1500k</a></li>
                                                           <li><a href="/vi/category/gia5-14">1600k - 2000k</a></li>
                                                           <li><a href="/vi/category/gia6-14">2000k - 2500k</a></li>
                                                           <li><a href="/vi/category/gia7-14">2600k - 4000k</a></li>
                                                       </ul>
                                                   </div><!-- col-megamenu.// -->
                                               </div>
                                           </div>
                                           <div class="col-lg-3">
                                               <div class="col-megamenu">
                                                   <p>1 sản phẩm</p>
                                               </div> <!-- col-megamenu.// -->
                                           </div>
                                       </div><!-- end row -->
                                   </div>

                               </div> <!-- dropdown-mega-menu.// -->
                           </li>
                           <li class="nav-item dropdown has-megamenu">
                               <?php foreach ($tiles as $tile) {
                                    if ($tile['cat'] == 15) { ?>
                                       <a class="nav-link dropdown-toggle efruit-vi px-5" href="" data-bs-toggle="dropdown">HỘP TRÁI CÂY</a>
                                       <a class="nav-link dropdown-toggle efruit-en px-5" href="<?= $tile['href'] ?>" data-bs-toggle="dropdown">HAMPER - BOX FRUIT</a>
                               <?php }
                                } ?>
                               <div class="dropdown-menu megamenu" role="menu">
                                   <div class="container-mega">
                                       <!--div container-mega được css này chỉnh độ rộng bao trọn megamenu !-->
                                       <div class="row g-3 response-mega">
                                           <div class="col-lg-5">
                                               <div class="col-megamenu">
                                                   <div class="row">
                                                       <?php
                                                        if (!empty($megaMenu_hamper_boxFruit)) {
                                                            foreach ($megaMenu_hamper_boxFruit as $array) {
                                                        ?>
                                                               <div class="col-md-6 col-megamenu">

                                                                   <ul class="list-unstyled">
                                                                       <li><a href="">
                                                                               <span class="efruit-vi"><?= $array['name'] ?></span>
                                                                               <span class="efruit-en"><?= $array['english_name'] ?></span>
                                                                           </a></li>
                                                                   </ul>
                                                               </div> <!-- col-megamenu.// -->
                                                       <?php }
                                                        }
                                                        ?>
                                                   </div>
                                               </div> <!-- col-megamenu.// -->
                                           </div><!-- end col-3 -->
                                           <div class="col-lg-4">
                                               <div class="row">
                                                   <div class="col-megamenu col-md-12">
                                                       <ul class="list-unstyled">
                                                           <li><a href="/vi/category/gia1-15">200k - 500k</a></li>
                                                           <li><a href="/vi/category/gia2-15">500k - 800k</a></li>
                                                           <li><a href="/vi/category/gia3-15">800k - 1000k</a></li>
                                                           <li><a href="/vi/category/gia4-15">1100k - 1500k</a></li>
                                                           <li><a href="/vi/category/gia5-15">1600k - 2000k</a></li>
                                                           <li><a href="/vi/category/gia6-15">2000k - 2500k</a></li>
                                                           <li><a href="/vi/category/gia7-15">2600k - 4000k</a></li>
                                                       </ul>
                                                   </div><!-- col-megamenu.// -->
                                               </div>
                                           </div><!-- end col-3 -->
                                           <div class="col-lg-3">
                                               <div class="col-megamenu">
                                                   <p>1 sản phẩm</p>
                                               </div> <!-- col-megamenu.// -->
                                           </div><!-- end col-3 -->
                                       </div><!-- end row -->
                                   </div>
                               </div> <!-- dropdown-mega-menu.// -->
                           </li>
                           <li class="nav-item">
                               <a class="nav-link efruit-vi px-5" href="#">HOA TRÁI CÂY</a>
                               <a class="nav-link efruit-en px-5" href="#">FRUIT BOUQUETS</a>
                           </li>
                           <li class="nav-item">
                               <a class="nav-link efruit-vi px-5" href="#">ĐẶC SẢN VIỆT</a>
                               <a class="nav-link efruit-en px-5" href="#">VIET NAM FRUIT SPECIAL</a>
                           </li>
                           <li class="nav-item">
                               <a class="nav-link efruit-vi px-5" href="#">TRÁI CÂY NHẬP</a>
                               <a class="nav-link efruit-en px-5" href="#">FRESH FRUITS</a>
                           </li>
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
                           <input id="input-search" type="text" aria-label="Recipient's username"
                           aria-describedby="button-addon2" auto ng-model="" name="key" 
                           class="form-control" placeholder="Search...">
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