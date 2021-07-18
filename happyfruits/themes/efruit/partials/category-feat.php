<?php if(!empty($tiles)): ?>
<div class="c-home__cat-feat" id="categories">
    <div class="o-wrapper">
        <div class="o-layout o-layout--large">
            <?php foreach($tiles as $tile):?>
            <div class="o-layout__item u-lap-wide-one-third u-lap-one-half c-product-feat o-color--milk">
                <a href="<?=$tile['href']?>" class="c-product-feat__container">
                    <div class="c-product-feat__bg" style="background-image: url(<?=get_image_url($tile['image'], 'medium')?>)"></div>
                    <div class="c-product-feat__icon hidden-xs">
                        <h3 class="efruit-vi"><?=$tile['short_text']?></h3>
                        <h3 class="efruit-en efruitjs"><?=$tile['en_text']?></h3>
                    </div>
                    <div class="c-product-feat__bg-over o-color-bgt-20"></div>
                    <div class="c-product-feat__content">
                        <h3><?=$tile['en_text']?></h3>
                        <p><?=$tile['description']?></p>
                        <span class="o-btn efruit-vi">Xem menu</span>
                        <span class="o-btn efruit-en">Learn more</span>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>