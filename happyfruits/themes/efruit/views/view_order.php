<?php $this->load_theme_file('page-header.php') ?>
<div class="application-body">
    <div class="y-grid">
        <div class="y-results" id="y-results">
            <?php $this->load_partial('hero-image') ?>
            <?php $this->load_partial('category-list') ?>
            <div class="content-container">
                <div class="content-body" style="background: #fff;max-width: 980px;margin: 20px auto; padding: 20px;">
                    <?php if(!empty($order)):
                        ?>

                    <div class="row">
                        <div class="col-md-10 col-xs-12 col-md-offset-1">
                            <h1 class="text-center">
                                <span class="efruit-vi">Đơn hàng #<?=$order['code']?></span>
                                <span class="efruit-en efruitjs">Order #<?=$order['code']?></span>
                            </h1>
                        </div>
                    </div>
                    <?php $this->load_partial('order_details', array('show_extra' => 1, 'show_buttons' => 1)); ?>
                    <?php else:?>
                    <div class="row">
                        <div class="col-md-8 col-xs-12 col-md-offset-2">
                            <p style="text-align:center">
                                <img alt="" src="http://www.efruit.vn/uploads/fresh-fruit-l-800gr.jpg" style="height:120px; margin:10px;" />
                                <img alt="" src="http://www.efruit.vn/uploads/meeting-fruit-l.jpg" style="height:120px; margin:10px;" />
                                <img alt="" src="http://www.efruit.vn/uploads/mixed-fruit.jpg" style="height:120px; margin:10px;" />
                                <img alt="" src="http://www.efruit.vn/uploads/phan-trai-cay-m-freshfruit-2.jpg" style="height:120px; margin:10px;" />​
                            </p>
                            <h3><span bind-translate="Mã đơn hàng không chính xác.">Mã đơn hàng không chính xác.</span></h3>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="clearfix"></div>
            <?php $this->load_partial('about-us') ?>
            <?php $this->load_partial('cooperators') ?>
        </div>
    </div>
</div>
<?php $this->load_theme_file('page-footer.php') ?>