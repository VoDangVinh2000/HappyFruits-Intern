 <?php $this->load_theme_file('page-header.php')
    ?>

 <?php
    $slide_images = !empty($obj)?json_decode($obj['slide_images'], true):null;
    if(empty($slide_images) && getvalue($homepage, 'slide_images'))
        $slide_images = json_decode($homepage['slide_images'], true);
    if(!empty($slide_images) && count($slide_images) > 1):
        $c1 = 'col-md-12';
        if(!empty($promotions_with_banner))
            $c1 = 'col-md-9';

    ?>
    <div class="container-fluid no-padding">
        <div class="row">
            <div class="<?=$c1?>">
                <div class="mainSlider sliderSp-list">
                    <div id="sliderSp-list" class="">
                        <?php $i = 0; foreach($slide_images as $slide): if(empty($slide['image'])) continue; ?>
                        <div class="item <?=$i>0?'efruitjs':''?>">
                            <div class="banner-container" style="background-image:url(<?=valid_url($slide['image'])?>);">
                                <div class="banner-content-container">
                                    <?php if(!empty($slide['content']) || !empty($slide['url'])):?>
                                    <div class="featured-content featured-gradient-<?=getvalue($slide, 'color', 'green')?>">
                                        <?=$slide['content']?>
                                        <?php if($slide['url']):?>
                                            <?php if(strstr($slide['url'], '/'.$page_code)): ?>
                                                <p class="more">
                                                    <a class="efruit-vi" data-scroll-to=".application-body .content-body" href="javascript:void(0);">Xem chi tiết</a>
                                                    <a class="efruit-en efruitjs" data-scroll-to=".application-body .content-body" href="javascript:void(0);">View details</a>
                                                </p>
                                            <?php else: ?>
                                                <p class="more">
                                                    <a class="efruit-vi" href="<?=valid_url($slide['url'])?>">Xem chi tiết</a>
                                                    <a class="efruit-en efruitjs" href="<?=valid_url($slide['url'])?>">View details</a>
                                                </p>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                        <?php $i++; endforeach;?>
                    </div>
                </div>
            </div>
            <?php if(!empty($promotions_with_banner)):?>
            <div class="col-md-3">
                <div id="vertical">
                    <?php foreach($promotions_with_banner as $pro): ?>
                    <div class="item">
                        <a href="<?=!empty($pro['promotion_link'])?:'javascript:void(0);'?>">
                            <img style="max-height:85px;display: block;" src="<?=$pro['promotion_image']?>"/>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif;?>
 <div class="application-body">
     <div class="y-grid">
         <div class="y-results" id="y-results">
             <?php $this->load_partial('category-feat') ?>
             <?php $this->load_partial('about-us') ?>
             <!-- <? //php $this->load_partial('disscount') 
                    ?> -->
         </div>
     </div>

 </div>
 <?php $this->load_theme_file('page-footer.php') ?>