<?php if(!empty($item['ribbon_left'])):?>
    <div class="half-circle-ribbon ribbon-left" <?=$item['ribbon_left_color']?'style="background: '.$item['ribbon_left_color'].';box-shadow: 0 0 0 3px '.$item['ribbon_left_color'].';"':''?>><?=$item['ribbon_left']?></div>
<?php endif; ?>
<?php if(!empty($item['ribbon_right'])):?>
    <div class="half-circle-ribbon"<?=$item['ribbon_right_color']?'style="background: '.$item['ribbon_right_color'].';box-shadow: 0 0 0 3px '.$item['ribbon_right_color'].';"':''?>><?=$item['ribbon_right']?></div>
<?php endif; ?>