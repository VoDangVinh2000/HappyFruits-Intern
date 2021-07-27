<?php $this->load_theme_file('page-header.php') ?>
<div class="application-body">
    <div class="y-grid">
        <div class="y-results" id="y-results">
            <?php $this->load_partial('hero-image') ?>
            <!-- <?//php $this->load_partial('category-list') ?> -->
            <?php if(!empty($cat_products) || !empty($products_in_tags)):?>
                <?php if($obj['page_body']):?>
                    <div class="content-container" style="background: #fff;">
                        <?php if(Hash::get($obj, 'config.has_voucher_form')):?>
                        <div class="content-body container-fluid">
                            <div class="col-sm-9 nopadding col-xs-12">
                                <?php echo $obj['page_body'];?>
                            </div>
                            <div class="col-sm-3 nopadding col-xs-12">
                                <?php $this->load_theme_file('forms/voucher'); ?>
                            </div>
                        </div>
                        <?php else: ?>
                            <div class="content-body container">
                                <div class="col-xs-12">
                                    <?php echo $obj['page_body'];?>
                                </div>
                            </div>
                        <?php endif;?>
                    </div>
                    <div class="clearfix"></div>
                <?php endif;?>
                <div id="menu-container" class="container-fluid" style="margin-top: 20px;">
                    <div class="col-sm-12 nopadding">
                        <!-- <//?php $this->load_partial('product-listing') ?> -->
                        <?php $this->load_partial('product-listing', array('heading' => '', 'showMore' => 1)) ?>
                    </div>
                    <!-- <div class="col-sm-3 nopadding hidden-xs">
                        <?//php $this->load_partial('cart') ?>
                    </div> -->
                </div>
            <?php else:?>
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
            <?php endif; ?>
            <div class="clearfix"></div>
            <?php $this->load_partial('about-us') ?>
            <?php $this->load_partial('disscount') ?>
            <!-- <//?php $this->load_partial('cooperators') ?> -->
        </div>
    </div>
</div>
<?php $this->load_theme_file('page-footer.php') ?>