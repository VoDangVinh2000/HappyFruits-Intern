<?php
$settings = get_setting_options();
$content_1 = $settings['about_us_content1'];
$content_2 = $settings['about_us_content2'];
$content_3 = $settings['about_us_content3'];
$content_4 = $settings['about_us_content4'];
if (!mempty($content_1, $content_2, $content_3, $content_4)) :
    $block_indexes = array();
    $counter = 0;
    for ($i = 1; $i <= 4; $i++) {
        $f = 'content_' . $i;
        if (!empty($$f)) {
            $block_indexes[] = $i;
            $counter++;
        }
    }
    if ($counter < 4)
        $block_class = 'col-sm-' . (12 / $counter);
    else
        $block_class = 'col-sm-6';
?>
<!-- <div class="flat">
    <div class="marketing">
        <div class="container">
            <h1 class="title efruit-vi"><?=$settings['about_us_heading']?></h1>
            <h1 class="title efruit-en efruitjs"><?=get_setting('about_us_heading', $settings['about_us_heading'], 'en')?></h1>
            <?php
                foreach($block_indexes as $idx):
                    $img = getvalue($settings, "about_us_content{$idx}_img");
                    $vi_content = getvalue($settings, "about_us_content" . $idx);
                    $en_content = get_setting('about_us_content' . $idx, $vi_content, 'en');
                ?>
                    <div class="<?= $block_class ?>">
                        <?php if ($img) : ?>
                            <img loading="lazy" alt="<?= pathinfo($img, PATHINFO_FILENAME) ?>" src="<?= valid_url($img) ?>" class="block-icon" />
                        <?php endif; ?>
                        <div class="print">
                            <span class="efruit-vi"><?= $vi_content ?></span>
                            <span class="efruit-en efruitjs"><?= $en_content ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div> -->



    <section class="about-section email-wrapper">
        <div class="about-content">
            <b>Happy Fruits</b> - thương hiệu cung cấp Trái cây tươi và quà tặng trái cây chuyên nghiệp tại Việt Nam, phân phối trái cây Việt đặc sản an toàn từ khắp mọi vùng miền và trái cây nhập khẩu cao cấp. Chúng tôi mong muốn mang lại sức khoẻ, hạnh phúc của khách hàng
            qua những sản phẩm, dịch vụ tận tâm.
        </div>
    </section>

    <div class="email-wrapper">
        <div class="container container-disscount">
            <div class="row">
                <div class="col-md-5 col-sm-12 col-12">
                    <div class="text-holder">
                        <h3>Get Discount 20% Off</h3>
                        <span>Subscribe to our newsletters now and stay up-to-date with new collections, the latest
                            lookbooks.</span>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-12">
                    <div class="subscribe-name-email">
                        <input type="text" name="subscribe-name" class="subscribe-name" placeholder="Your First Name">
                        <input type="text" name="subscribe-email" class="subscribe-email" placeholder="Your Email">
                        <a class="subscribe-submit" href="#">
                            <svg width="30" height="25" viewBox="0 0 448 512">
                                <path fill="#fff" d="M295.515 115.716l-19.626 19.626c-4.753 4.753-4.675 12.484.173 17.14L356.78 230H12c-6.627 0-12 5.373-12 12v28c0 6.627 5.373 12 12 12h344.78l-80.717 77.518c-4.849 4.656-4.927 12.387-.173 17.14l19.626 19.626c4.686 4.686 12.284 4.686 16.971 0l131.799-131.799c4.686-4.686 4.686-12.284 0-16.971L312.485 115.716c-4.686-4.686-12.284-4.686-16.97 0z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About -->
<!-- <section class="about-section email-wrapper">
    <div class="about-content">
        <b>Happy Fruits</b> - thương hiệu cung cấp Trái cây tươi và quà tặng trái cây chuyên nghiệp
        tại Việt Nam, phân phối trái cây Việt đặc sản an toàn từ khắp mọi vùng miền và trái cây
        nhập khẩu cao cấp. Chúng tôi mong muốn mang lại sức khoẻ, hạnh phúc của khách hàng
        qua những sản phẩm, dịch vụ tận tâm.
    </div>
</section> -->

<?php endif; ?>