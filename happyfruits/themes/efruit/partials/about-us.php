<?php
    $settings = get_setting_options();
    $content_1 = $settings['about_us_content1'];
    $content_2 = $settings['about_us_content2'];
    $content_3 = $settings['about_us_content3'];
    $content_4 = $settings['about_us_content4'];
    if (!mempty($content_1, $content_2, $content_3, $content_4)):
        $block_indexes = array();
        $counter = 0;
        for($i = 1; $i <= 4; $i++){
            $f = 'content_'.$i;
            if (!empty($$f)){
                $block_indexes[] = $i;
                $counter++;
            }
        }
        if ($counter < 4)
            $block_class = 'col-sm-'. (12/$counter);
        else
            $block_class = 'col-sm-6';
?>
<div class="flat">
    <div class="marketing">
        <div class="container">
            <h1 class="title efruit-vi"><?=$settings['about_us_heading']?></h1>
            <h1 class="title efruit-en efruitjs"><?=get_setting('about_us_heading', $settings['about_us_heading'], 'en')?></h1>
            <?php
                foreach($block_indexes as $idx):
                    $img = getvalue($settings, "about_us_content{$idx}_img");
                    $vi_content = getvalue($settings, "about_us_content".$idx);
                    $en_content = get_setting('about_us_content'.$idx, $vi_content, 'en');
            ?>
            <div class="<?=$block_class?>">
                <?php if($img):?>
                <img loading="lazy" alt="<?=pathinfo($img, PATHINFO_FILENAME)?>" src="<?=valid_url($img)?>" class="block-icon"/>
                <?php endif; ?>
                <div class="print">
                    <span class="efruit-vi"><?=$vi_content?></span>
                    <span class="efruit-en efruitjs"><?=$en_content?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>