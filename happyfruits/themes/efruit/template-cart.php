 <?php $this->load_theme_file('page-header.php')?>
 <div class="main">
        <!--Banner -->
        <div class="bread-section">
            <div class="inside-bread-section">
                <div class="container-section">
                    <div class="title">
                        <h1>Cart</h1>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><span>Cart</span></li>
                        </ul>
                    </div>
                    <div class="section-img">
                        <img src="<?= get_theme_assets_url() ?>img/banner-account/6165.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    <?php $this->load_partial('cart') ?>
        
 <?php $this->load_theme_file('page-footer.php') ?>