    <!-- HEADER -->
    <header class="top-header">
        <!-- Nav 1 -->
        <nav class="navbar navbar-expand-lg navbar-light sub-nav">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topSubNav" aria-controls="topSubNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="topSubNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">BLOG</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">GIỚI THIỆU</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">SHOP</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-phone-volume"></i> 0938.70.70.15</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">VI</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">EN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" title="Vận chuyển"><i class="fas fa-shipping-fast"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" title="Tuyển dụng"><i class="fas fa-user-tie"></i></a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- Nav 2 -->
        <nav class="navbar navbar-expand-lg navbar-light main-nav">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <!-- <img src="./public/images/main_logo.png" alt="Happy Fruits logo"> -->
                    <img src="<?= get_child_theme_assets_url() ?>img/main_logo.png" alt="Happy Fruits logo">
                </a>
                <ul class="navbar-nav ms-auto right-main-nav sub-cart">
                    <li class="nav-item">
                        <a class="nav-link position-relative btn-cart-nav" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13.87" height="16" viewBox="0 0 13.87 16">
                                <path d="M15.8,5.219a.533.533,0,0,0-.533-.485H13.132V4.44A3.333,3.333,0,0,0,9.932,1a3.333,3.333,0,0,0-3.2,3.44v.293H4.6a.533.533,0,0,0-.533.485L3,16.419A.539.539,0,0,0,3.532,17h12.8a.539.539,0,0,0,.533-.581Zm-8-.779A2.267,2.267,0,0,1,9.932,2.067,2.267,2.267,0,0,1,12.065,4.44v.293H7.8ZM4.118,15.933,5.084,5.8H6.732v.683a1.067,1.067,0,1,0,1.067,0V5.8h4.267v.683a1.067,1.067,0,1,0,1.067,0V5.8H14.78l.965,10.133Z" transform="translate(-2.997 -1)"></path>
                            </svg><br>
                            <span class="position-absolute translate-middle badge rounded-pill bg-cart">
                                0
                                <span class="visually-hidden">unread messages</span>
                            </span>
                            <small>GIỎ HÀNG</small>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse" id="main_nav">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown has-megamenu">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">GIỎ TRÁI CÂY</a>
                            <div class="dropdown-menu megamenu" role="menu">
                                <div class="row g-3">
                                    <div class="col-lg-3 col-6">
                                        <div class="col-megamenu">
                                            <h6 class="title">Title Menu One</h6>
                                            <ul class="list-unstyled">
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                            </ul>
                                        </div> <!-- col-megamenu.// -->
                                    </div><!-- end col-3 -->
                                    <div class="col-lg-3 col-6">
                                        <div class="col-megamenu">
                                            <h6 class="title">Title Menu Two</h6>
                                            <ul class="list-unstyled">
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                            </ul>
                                        </div> <!-- col-megamenu.// -->
                                    </div><!-- end col-3 -->
                                    <div class="col-lg-3 col-6">
                                        <div class="col-megamenu">
                                            <h6 class="title">Title Menu Three</h6>
                                            <ul class="list-unstyled">
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                            </ul>
                                        </div> <!-- col-megamenu.// -->
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <div class="col-megamenu">
                                            <h6 class="title">Title Menu Four</h6>
                                            <ul class="list-unstyled">
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                            </ul>
                                        </div> <!-- col-megamenu.// -->
                                    </div><!-- end col-3 -->
                                </div><!-- end row -->
                            </div> <!-- dropdown-mega-menu.// -->
                        </li>
                        <li class="nav-item dropdown has-megamenu">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">HỘP TRÁI CÂY</a>
                            <div class="dropdown-menu megamenu" role="menu">
                                <div class="row g-3">
                                    <div class="col-lg-3 col-6">
                                        <div class="col-megamenu">
                                            <h6 class="title">Title Menu One</h6>
                                            <ul class="list-unstyled">
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                            </ul>
                                        </div> <!-- col-megamenu.// -->
                                    </div><!-- end col-3 -->
                                    <div class="col-lg-3 col-6">
                                        <div class="col-megamenu">
                                            <h6 class="title">Title Menu Two</h6>
                                            <ul class="list-unstyled">
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                            </ul>
                                        </div> <!-- col-megamenu.// -->
                                    </div><!-- end col-3 -->
                                    <div class="col-lg-3 col-6">
                                        <div class="col-megamenu">
                                            <h6 class="title">Title Menu Three</h6>
                                            <ul class="list-unstyled">
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                            </ul>
                                        </div> <!-- col-megamenu.// -->
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <div class="col-megamenu">
                                            <h6 class="title">Title Menu Four</h6>
                                            <ul class="list-unstyled">
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                            </ul>
                                        </div> <!-- col-megamenu.// -->
                                    </div><!-- end col-3 -->
                                </div><!-- end row -->
                            </div> <!-- dropdown-mega-menu.// -->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">HOA TRÁI CÂY</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">ĐẶC SẢN VIỆT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">TRÁI CÂY NHẬP</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto right-main-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#searchModal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                    <path d="M86.065,85.194a6.808,6.808,0,1,0-.871.871L89.129,90,90,89.129Zm-1.288-.422a5.583,5.583,0,1,1,1.64-3.953A5.6,5.6,0,0,1,84.777,84.772Z" transform="translate(-74 -74)"></path>
                                </svg><br>
                                <small>SEARCH</small>
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
                                </svg><br>
                                <small>ĐĂNG NHẬP</small>
                            </a>
                        </li>
                        <li class="nav-item main-cart-btn">
                            <a class="nav-link position-relative btn-cart-nav" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13.87" height="16" viewBox="0 0 13.87 16">
                                    <path d="M15.8,5.219a.533.533,0,0,0-.533-.485H13.132V4.44A3.333,3.333,0,0,0,9.932,1a3.333,3.333,0,0,0-3.2,3.44v.293H4.6a.533.533,0,0,0-.533.485L3,16.419A.539.539,0,0,0,3.532,17h12.8a.539.539,0,0,0,.533-.581Zm-8-.779A2.267,2.267,0,0,1,9.932,2.067,2.267,2.267,0,0,1,12.065,4.44v.293H7.8ZM4.118,15.933,5.084,5.8H6.732v.683a1.067,1.067,0,1,0,1.067,0V5.8h4.267v.683a1.067,1.067,0,1,0,1.067,0V5.8H14.78l.965,10.133Z" transform="translate(-2.997 -1)"></path>
                                </svg><br>
                                <span class="position-absolute translate-middle badge rounded-pill bg-cart">
                                    0
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                                <small>GIỎ HÀNG</small>
                            </a>
                        </li>
                    </ul>
                </div> <!-- navbar-collapse.// -->
            </div> <!-- container-fluid.// -->
        </nav>
        <!-- Modal search-->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control" placeholder="Search..." aria-label="Recipient's username" aria-describedby="button-addon2" style="padding: 1.5em; border-radius: 0; border: none">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" style="padding: 1.5em 1.8em; border-radius: 0; background: #333; border: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="white">
                                <path d="M86.065,85.194a6.808,6.808,0,1,0-.871.871L89.129,90,90,89.129Zm-1.288-.422a5.583,5.583,0,1,1,1.64-3.953A5.6,5.6,0,0,1,84.777,84.772Z" transform="translate(-74 -74)"></path>
                            </svg></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cart -->
        <div class="cart-modal">
            <div class="cart-lightbox"></div>
            <div class="offcanvas-cart">
                <div class="inner">
                    <div class="head">
                        <span class="title">Cart</span>
                        <button class="offcanvas-close">×</button>
                    </div>
                    <div class="customScroll">
                        <div class="cart-empty-title">
                            <h4>Your cart is currently empty.</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>