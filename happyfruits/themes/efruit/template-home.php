 <?php $this->load_theme_file('page-header.php') 
 ?>

 <!-- slider -->
 <div id="carouselHappyFruits" class="carousel slide" data-bs-ride="carousel">
     <div class="carousel-indicators">
         <button type="button" data-bs-target="#carouselHappyFruits" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
         <button type="button" data-bs-target="#carouselHappyFruits" data-bs-slide-to="1" aria-label="Slide 2"></button>
         <button type="button" data-bs-target="#carouselHappyFruits" data-bs-slide-to="2" aria-label="Slide 3"></button>
         <button type="button" data-bs-target="#carouselHappyFruits" data-bs-slide-to="3" aria-label="Slide 4"></button>
     </div>
     <div class="carousel-inner">
         <div class="carousel-item active">
             <div class="carousel-img">
                 <!-- <img src="./public/images/slide1.jpg" class="d-block w-100" alt="..."> -->
                 <img src="<?= get_theme_assets_url() ?>img/slide1.jpg" class="d-block w-100" alt="...">
             </div>

             <div class="carousel-caption d-none d-md-block">
                 <a class="sub-caption" href="#">GIỎ TRÁI CÂY</a>
                 <h2>Gói trọn yêu thương</h2>
                 <a class="btn-shop" href="#">
                     <div class="button-content-wrapper">
                         <span class="button-text">SHOP NOW</span>
                     </div>
                 </a>
             </div>
         </div>
         <div class="carousel-item">
             <div class="carousel-img">
                 <img src="<?= get_theme_assets_url() ?>img/slide2.jpg" class="d-block w-100" alt="...">
             </div>

             <div class="carousel-caption d-none d-md-block">
                 <a class="sub-caption" href="#">GIỎ TRÁI CÂY</a>
                 <h2>Gói trọn yêu thương</h2>
                 <a class="btn-shop" href="#">
                     <div class="button-content-wrapper">
                         <span class="button-text">SHOP NOW</span>
                     </div>
                 </a>
             </div>
         </div>
         <div class="carousel-item">
             <div class="carousel-img">
                 <img src="<?= get_theme_assets_url() ?>img/slide3.jpg" class="d-block w-100" alt="...">
             </div>

             <div class="carousel-caption d-none d-md-block">
                 <a class="sub-caption" href="#">GIỎ TRÁI CÂY</a>
                 <h2>Gói trọn yêu thương</h2>
                 <a class="btn-shop" href="#">
                     <div class="button-content-wrapper">
                         <span class="button-text">SHOP NOW</span>
                     </div>
                 </a>
             </div>
         </div>
         <div class="carousel-item">
             <div class="carousel-img">
                 <img src="<?= get_theme_assets_url() ?>img/slide4.jpg" class="d-block w-100" alt="...">
             </div>

             <div class="carousel-caption d-none d-md-block">
                 <a class="sub-caption" href="#">GIỎ TRÁI CÂY</a>
                 <h2>Gói trọn yêu thương</h2>
                 <a class="btn-shop" href="#">
                     <div class="button-content-wrapper">
                         <span class="button-text">SHOP NOW</span>
                     </div>
                 </a>
             </div>
         </div>
     </div>
     <button class="carousel-control-prev" type="button" data-bs-target="#carouselHappyFruits" data-bs-slide="prev">
         <span class="carousel-control-prev-icon" aria-hidden="true"></span>
         <span class="visually-hidden">Previous</span>
     </button>
     <button class="carousel-control-next" type="button" data-bs-target="#carouselHappyFruits" data-bs-slide="next">
         <span class="carousel-control-next-icon" aria-hidden="true"></span>
         <span class="visually-hidden">Next</span>
     </button>

 </div>

 <!-- section -->
 <section class="section_col">
     <div class="section_wrap-col">

         <!-- 1 -->
         <div class="section_col-item">

             <div class="infobox">

                 <a href="#" class="infobox_link"></a>

                 <div class="infobox_wrapper">

                     <div class="icon_wrapper">
                         <svg viewBox="0 0 314 314" class="infobox_icon">
                             <path d="m157 314c86.570312 0 157-70.429688 157-157s-70.429688-157-157-157-157 70.429688-157 157 70.429688 157 157 157zm0-300c78.851562 0 143 64.148438 143 143s-64.148438 143-143 143-143-64.148438-143-143 64.148438-143 143-143zm0 0" />
                             <path d="m118.300781 142.890625c16.011719 0 28.988281-12.980469 28.988281-28.988281.003907-16.011719-12.976562-28.992188-28.988281-28.992188s-28.988281 12.980469-28.988281 28.988282c.015625 16.003906 12.984375 28.972656 28.988281 28.992187zm0-43.980469c8.277344 0 14.988281 6.710938 14.988281 14.988282.003907 8.28125-6.707031 14.992187-14.988281 14.992187-8.277343 0-14.988281-6.710937-14.988281-14.992187.007812-8.273438 6.714844-14.976563 14.988281-14.988282zm0 0" />
                             <path d="m164.953125 201.859375c0 16.011719 12.980469 28.988281 28.988281 28.988281 16.011719 0 28.992188-12.976562 28.992188-28.988281s-12.980469-28.992187-28.992188-28.992187c-16.003906.019531-28.96875 12.988281-28.988281 28.992187zm43.980469 0c0 8.277344-6.710938 14.988281-14.992188 14.988281-8.277344 0-14.988281-6.710937-14.988281-14.988281s6.710937-14.988281 14.988281-14.992187c8.277344.011718 14.980469 6.714843 14.992188 14.992187zm0 0" />
                             <path d="m103.699219 238.726562c3.238281 2.113282 7.578125 1.199219 9.6875-2.039062l98.953125-151.726562c1.371094-2.097657 1.519531-4.765626.390625-7-1.132813-2.234376-3.371094-3.695313-5.871094-3.828126-2.5-.132812-4.882813 1.078126-6.246094 3.179688l-98.953125 151.726562c-2.113281 3.242188-1.199218 7.578126 2.039063 9.6875zm0 0" />
                         </svg>
                     </div>

                     <div class="content_wrapper">
                         <div class="infobox-title">
                             <h3>Discounts</h3>
                         </div>
                         <div class="infobox-content">Best sale (Free deals) deals everyweek</div>
                     </div>

                 </div>

             </div>
         </div>

         <!-- 3 -->
         <div class="section_col-item">

             <div class="infobox">

                 <a href="#" class="infobox_link"></a>

                 <div class="infobox_wrapper">

                     <div class="icon_wrapper">
                         <svg class="infobox_icon" viewBox="0 0 373.232 373.232">
                             <path d="M187.466,0c-0.1,0.1-0.3,0.1-0.6,0.1c-101.2,0-183.5,82.3-183.5,183.5c0,41.3,14.1,81.4,39.9,113.7l-26.7,62
                       c-2.2,5.1,0.2,11,5.2,13.1c1.8,0.8,3.8,1,5.7,0.7l97.9-17.2c19.6,7.1,40.2,10.7,61,10.6c101.2,0,183.5-82.3,183.5-183.5
                       C370.066,82.1,288.366,0.1,187.466,0z M186.466,346.6c-19.3,0-38.4-3.5-56.5-10.3c-1.7-0.7-3.5-0.8-5.3-0.5l-82.4,14.4l21.8-50.7
                       c1.5-3.5,0.9-7.6-1.6-10.5c-11.8-13.7-21.2-29.3-27.8-46.2c-7.4-18.9-11.2-39-11.2-59.3c0-90.2,73.4-163.5,163.5-163.5
                       c89.9-0.2,162.9,72.5,163,162.4c0,0.2,0,0.4,0,0.6C349.966,273.3,276.566,346.6,186.466,346.6z" />
                             <path d="M178.666,146.7h-54c-5.5,0-10,4.5-10,10s4.5,10,10,10h54c5.5,0,10-4.5,10-10S184.166,146.7,178.666,146.7z" />
                             <path d="M248.666,196.7h-124c-5.5,0-10,4.5-10,10s4.5,10,10,10h124c5.5,0,10-4.5,10-10S254.166,196.7,248.666,196.7z" />
                         </svg>

                     </div>

                     <div class="content_wrapper">
                         <div class="infobox-title">
                             <h3>Support 24/7</h3>
                         </div>
                         <div class="infobox-content">Dedicated Support</div>
                     </div>

                 </div>

             </div>
         </div>

         <!-- 4 -->
         <div class="section_col-item">

             <div class="infobox">

                 <a href="#" class="infobox_link"></a>

                 <div class="infobox_wrapper">

                     <div class="icon_wrapper">
                         <svg viewBox="0 0 511.999 511.999" class="infobox_icon">
                             <circle cx="10.06" cy="500.446" r="10.06" />
                             <circle cx="267.005" cy="245.308" r="10.04" />
                             <path d="M398.479,118.032c-8.071-8.072-18.802-12.516-30.216-12.516c-11.414,0-22.146,4.446-30.216,12.516
                      c-16.661,16.662-16.661,43.772,0,60.433c8.332,8.331,19.272,12.495,30.216,12.495c10.941,0,21.886-4.166,30.216-12.495
                      C415.14,161.803,415.14,134.693,398.479,118.032z M384.282,164.266c-8.833,8.832-23.206,8.832-32.037,0
                      c-8.833-8.832-8.833-23.204,0-32.037c4.279-4.279,9.967-6.635,16.018-6.635c6.051,0,11.739,2.356,16.018,6.635
                      C393.114,141.062,393.114,155.434,384.282,164.266z" />
                             <path d="M125.409,411.45c-4.964-2.472-10.99-0.451-13.462,4.512l-11.958,24.015c-5.2,10.441-15.658,17.423-27.296,18.219
                      l-13.908,0.952c-2.351,0.157-3.897-1.014-4.612-1.729s-1.889-2.264-1.729-4.613l0.952-13.907
                      c0.797-11.637,7.779-22.096,18.219-27.296l24.014-11.958c4.964-2.472,6.984-8.499,4.512-13.462
                      c-2.471-4.963-8.498-6.984-13.462-4.512l-24.014,11.958c-16.792,8.362-28.02,25.182-29.302,43.898l-0.952,13.907
                      c-0.514,7.507,2.242,14.863,7.562,20.183c4.898,4.898,11.523,7.624,18.403,7.624c0.591,0,1.186-0.02,1.78-0.061l13.908-0.952
                      c18.716-1.281,35.536-12.508,43.898-29.302l11.958-24.014C132.392,419.948,130.372,413.922,125.409,411.45z" />
                             <path d="M505.07,8.18c-4.711-4.641-11.201-7.068-17.793-6.639l-9.348,0.596c-83.819,5.351-162.262,45.81-215.215,111.004
                      L240.71,140.23l-57.583-1.691c-0.098-0.003-0.197-0.004-0.294-0.004c-45.668,0-88.603,17.784-120.896,50.076L2.959,247.59
                      c-2.805,2.805-3.696,7-2.272,10.702c1.424,3.703,4.894,6.221,8.856,6.423l124.844,6.414l-5.09,6.267
                      c-2.565,3.159-2.971,7.553-1.026,11.127c1.956,3.596,4.006,7.135,6.144,10.617l-29.606,35.147
                      c-2.531,3.005-3.076,7.211-1.397,10.763c6.467,13.665,15.05,25.943,25.514,36.493c10.718,10.808,23.251,19.646,37.249,26.271
                      c1.368,0.648,2.835,0.965,4.293,0.965c2.261,0,4.503-0.764,6.327-2.243c6.378-5.174,13.731-11.311,20.843-17.245
                      c5.069-4.23,10.255-8.557,15.102-12.547c2.893,1.741,5.822,3.429,8.795,5.046c1.504,0.818,3.153,1.221,4.796,1.221
                      c2.186,0,4.358-0.712,6.156-2.108l6.843-5.31l6.442,125.37c0.204,3.962,2.721,7.432,6.423,8.856c1.172,0.45,2.39,0.67,3.6,0.67
                      c2.615,0,5.183-1.023,7.101-2.942l58.979-58.979c32.293-32.293,50.076-75.227,50.076-120.896v-54.995l23.267-18.055
                      c69.729-54.11,112.196-135.704,116.512-223.862l0.239-4.886C512.295,19.27,509.779,12.822,505.07,8.18z M33.123,245.822
                      l43.012-43.012c28.465-28.465,66.303-44.157,106.553-44.196l42.085,1.236l-74.71,91.98L33.123,245.822z M184.774,373.874
                      c-5.241,4.372-10.614,8.856-15.6,12.957c-9.644-5.223-18.368-11.74-25.992-19.428c-7.384-7.445-13.669-15.922-18.737-25.26
                      l21.676-25.733c6.554,8.793,13.728,17.122,21.478,24.925c0.006,0.006,0.012,0.011,0.018,0.017
                      c0.002,0.002,0.004,0.005,0.006,0.007c0.003,0.003,0.006,0.005,0.009,0.008c8.593,8.648,17.836,16.584,27.641,23.761
                      C191.811,368.002,188.264,370.962,184.774,373.874z M351.875,327.672c0,40.305-15.695,78.197-44.196,106.698l-43.012,43.012
                      l-6.002-116.792l93.209-72.33V327.672z M491.678,29.779c-4.029,82.297-43.673,158.467-108.767,208.98l-157.46,122.189
                      c-13.058-7.63-25.229-16.639-36.368-26.846l53.086-53.086c3.92-3.92,3.92-10.278,0-14.199c-3.921-3.921-10.278-3.921-14.199,0
                      l-53.036,53.036c-9.751-10.795-18.387-22.541-25.74-35.104L278.3,125.8C327.732,64.941,400.96,27.171,479.207,22.177l9.348-0.596
                      c1.225-0.076,2.045,0.532,2.423,0.904c0.377,0.371,1,1.178,0.94,2.409L491.678,29.779z" />
                         </svg>

                     </div>

                     <div class="content_wrapper">
                         <div class="infobox-title">
                             <h3>Express Delivery</h3>
                         </div>
                         <div class="infobox-content">2hr HCM City Area</div>
                     </div>

                 </div>

             </div>
         </div>

         <!-- 5 -->
         <div class="section_col-item">

             <div class="infobox">

                 <a href="#" class="infobox_link"></a>

                 <div class="infobox_wrapper">

                     <div class="icon_wrapper">
                         <svg class="infobox_icon" viewBox="0 0 511.985 511.985">
                             <path id="XMLID_2048_" d="m503.19 184.134-175.363-175.362c-11.696-11.695-30.729-11.697-42.427 0l-195.214 195.213h-60.163c-16.542 0-30 13.458-30 30v248c0 16.542 13.458 30 30 30h372c16.542 0 30-13.458 30-30v-184.257l71.167-71.167c11.696-11.697 11.697-30.729 0-42.427zm-203.647-161.219c3.899-3.9 10.244-3.898 14.142 0l22.299 22.299-158.772 158.771h-58.741zm112.48 459.07c0 5.514-4.486 10-10 10h-372c-5.514 0-10-4.486-10-10v-248c0-5.514 4.486-10 10-10h372c5.514 0 10 4.486 10 10zm77.025-269.566-57.024 57.024v-35.457c0-16.542-13.458-30-30-30h-122.989l107.86-107.86 102.152 102.151c3.899 3.899 3.899 10.243.001 14.142z" />
                             <circle id="XMLID_2067_" cx="88.231" cy="297.985" r="36" />
                             <path id="XMLID_2068_" d="m58.023 401.985h42.271c5.522 0 10-4.477 10-10s-4.478-10-10-10h-42.271c-5.522 0-10 4.477-10 10s4.478 10 10 10z" />
                             <path id="XMLID_2069_" d="m191.537 437.985h-133.514c-5.522 0-10 4.477-10 10s4.478 10 10 10h133.514c5.522 0 10-4.477 10-10s-4.478-10-10-10z" />
                             <path id="XMLID_2072_" d="m374.023 437.985h-42.271c-5.522 0-10 4.477-10 10s4.478 10 10 10h42.271c5.522 0 10-4.477 10-10s-4.477-10-10-10z" />
                             <path id="XMLID_2073_" d="m191.537 381.985h-42.271c-5.522 0-10 4.477-10 10s4.478 10 10 10h42.271c5.522 0 10-4.477 10-10s-4.478-10-10-10z" />
                             <path id="XMLID_2074_" d="m282.78 381.985h-42.27c-5.522 0-10 4.477-10 10s4.478 10 10 10h42.271c5.522 0 10-4.477 10-10s-4.478-10-10.001-10z" />
                             <path id="XMLID_2075_" d="m374.023 381.985h-42.271c-5.522 0-10 4.477-10 10s4.478 10 10 10h42.271c5.522 0 10-4.477 10-10s-4.477-10-10-10z" />
                             <path id="XMLID_2136_" d="m286.023 281.985v32c0 11.046 8.954 20 20 20h14v-72h-14c-11.045 0-20 8.955-20 20z" />
                             <path id="XMLID_2323_" d="m374.023 313.985v-32c0-11.046-8.954-20-20-20h-14v72h14c11.046 0 20-8.954 20-20z" />
                         </svg>
                     </div>

                     <div class="content_wrapper">
                         <div class="infobox-title">
                             <h3>Secure Payment</h3>
                         </div>
                         <div class="infobox-content">100% Secure payment<br>
                             <i class="fab fa-cc-visa"></i> <i class="fab fa-cc-mastercard"></i> <i class="fab fa-paypal"></i> <img src="https://img.mservice.io/momo-payment/icon/images/logo512.png" alt="" height="16"> VNPAY,...
                         </div>
                     </div>

                 </div>

             </div>
         </div>
     </div>
 </section>
 <div class="application-body">
     <div class="y-grid">
         <div class="y-results" id="y-results">


             <!-- <div class="flat">
                 <div class="marketing">
                     <div class="container">
                         <h1 class="title efruit-vi">Các sản phẩm, dịch vụ của <//?= get_setting('short_site_name') ?></h1>
                         <h1 class="title efruit-en efruitjs">Our products and services</h1>
                     </div>
                 </div>
             </div> -->


             <?php $this->load_partial('category-feat') ?>

             <div id="san-pham-dac-trung" class="container-fluid">
                 <?php //$this->load_partial('product-listing', array('heading' => 'Sản phẩm đặc trưng trong tuần', 'showMore' => 1)) ?>
             </div>
             
             <?php //$this->load_partial('cooperators') ?>

             <?php $this->load_partial('about-us') ?>

             <?php $this->load_partial('disscount') ?>
         </div>
     </div>
 </div>
 <?php $this->load_theme_file('page-footer.php') ?>
