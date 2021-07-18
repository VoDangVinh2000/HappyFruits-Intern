<?php
$slide_images = !empty($obj)?json_decode($obj['slide_images'], true):null;
if(empty($slide_images) && getvalue($homepage, 'slide_images'))
    $slide_images = json_decode($homepage['slide_images'], true);
if(!empty($slide_images) && count($slide_images) == 1):
?>
    <div class="hero-wrapper" style="position: relative; height: 200px; background-image:url('<?=valid_url($slide_images[0]['image'])?>');" ></div>
<?php endif; ?>
