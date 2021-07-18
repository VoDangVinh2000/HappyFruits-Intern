<?php $this->load_theme_file('page-header.php') ?>
<div class="application-body">
    <div class="y-grid">
        <div class="y-results" id="y-results">
            <?php $this->load_partial('hero-image') ?>
            <?php $this->load_partial('category-list') ?>
            <?php if($obj['page_body']):?>
                <div class="content-container" style="background: #fff;">
                    <div class="content-body container">
                        <div class="col-xs-12">
                            <?php echo $obj['page_body'];?>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            <?php endif;?>
            <div id="menu-container" class="container-fluid efruitjs" style="margin-top: 20px;">
                <div class="col-sm-9 nopadding">
                    <div class="row">
                        <?php if(!empty($all_products)): foreach($all_products as $item):?>
                            <div class="col-xs-6 col-sm-3">
                                <?php $this->load_partial('product-item-box', array('item' => $item)); ?>
                            </div>
                        <?php endforeach; endif; ?>
                    </div>
                </div>
                <div class="col-sm-3 nopadding hidden-xs">
                    <?php $this->load_partial('cart') ?>
                </div>
            </div>
            <div class="clearfix"></div>
            <?php $this->load_partial('about-us') ?>
            <?php $this->load_partial('cooperators') ?>
        </div>
    </div>
</div>
<?php $this->load_theme_file('page-footer.php') ?>