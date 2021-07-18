<?php $this->load_theme_file('page-header.php') ?>
<div class="application-body">
    <div class="y-grid">
        <div class="y-results" id="y-results">
            <?php $this->load_partial('hero-image') ?>
            <?php $this->load_partial('category-list') ?>
            <div class="content-container">
                <div class="content-body" style="background: #fff;max-width: 980px;margin: 20px auto; padding: 20px;">
                    <?php echo $obj['page_body'];?>
                    <?php if(!empty($promotions)):?>
                        <div class="promotion-items">
                            <?php foreach($promotions as $pro):?>
                                <div class="promotion-item row">
                                    <?php if ($pro['image']):?>
                                        <div class="col-md-3">
                                            <img class="promotion-image" alt="hinh-thong-bao" src="<?=valid_url($pro['image'])?>"/>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="efruit-vi"><?=$pro['content']?></div>
                                            <div class="efruit-en efruitjs"><?=$pro['content_en']?></div>
                                        </div>
                                    <?php else:?>
                                        <div class="col-md-12">
                                            <div class="efruit-vi"><?=$pro['content']?></div>
                                            <div class="efruit-en efruitjs"><?=$pro['content_en']?></div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
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