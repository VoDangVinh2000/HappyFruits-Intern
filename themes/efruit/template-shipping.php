 <?php $this->load_theme_file('page-header.php') ?>
 <div class="main">
     <!--Banner -->
     <div class="bread-section">
         <div class="inside-bread-section">
             <div class="container-section">
                 <div class="title">
                     <h1 class="efruit-vi">Giao hàng</h1>
                     <h1 class="efruit-en">Shipping</h1>
                     <ul>
                         <li>
                             <a class="efruit-vi" href="/vi">Trang chủ</a>
                             <a class="efruit-en" href="/vi">Home</a>
                         </li>
                         
                         <li>
                             <span class="efruit-vi">Giao hàng</span>
                             <span class="efruit-en">Shipping</span>
                         </li>
                     </ul>
                 </div>
                 <div class="section-img">
                     <img src="<?= get_theme_assets_url() ?>img/banner-account/6165.jpg" alt="">
                 </div>
             </div>
         </div>
     </div>
     <?php $this->load_partial('shipping') ?>

     <?php $this->load_theme_file('page-footer.php') ?>