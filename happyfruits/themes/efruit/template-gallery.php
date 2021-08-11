<?php $this->load_theme_file('page-header.php') ?>
<style>
    #galleria a{text-decoration: none;}
</style>
<div class="application-body">
    <div class="y-grid">
        <div class="y-results" id="y-results">
            <?php $this->load_partial('hero-image') ?>
            <!-- </?php $this->load_partial('category-list') ?> -->
            <div class="content-container" style="background: #fff;">
                <div class="content-body" style="margin: 0 auto; padding: 40px 20px;">
                    <?php if ($images_in_gallery): ?>
                    <div class="w-gallery row">
                        <?php
                        foreach ($images_in_gallery as $image)
                        {
                            $thumb_path = get_image_url($image, 'square-small');
                            $image_path = get_image_url($image);
                            ?>
                            <li class="col-sm-3 col-xs-6" style="margin-bottom: 15px;">
                                <a class="fancybox responsivGallery-link" rel="gallery1" href="<?php echo $image_path?>">
                                    <img alt="gallery-item" src="<?=$thumb_path?>" width="500" alt="" class="responsivGallery-pic"/>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                    </div>
                    <?php else: ?>
                    <h2 class="text-center">Comming soon..</h2>
                    <?php endif; ?>
                </div>
            </div>
            <div class="clearfix"></div>
            <!-- </?php $this->load_theme_file('page-cooperators.php') ?> -->
            <?php $this->load_partial('about-us') ?>
            <?php $this->load_partial('disscount') ?>
        </div>
    </div>
</div>
<?php $this->load_theme_file('page-footer.php') ?>
