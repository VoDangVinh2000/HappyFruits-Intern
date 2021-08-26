<?php
$settings = get_setting_options();
$content_1 = $settings['about_us_content1'];

?>
<!-- ABOUT US  -->

<section class="about-section email-wrapper">
    <div class="about-content">
        <?php
        $en_content = ' Fresh fruit with high quality, conscientious service. "Deliver" happiness to customers is our essential mission.';
        ?>
        <span class="efruit-vi"><b>Happy Fruits</b> - <?= $content_1 ?></span>
        <span class="efruit-en"><b>Happy Fruits</b> - <?= $en_content  ?></span>
        <!-- <b>Happy Fruits</b> - <//?= $content_1 ?> -->
    </div>
</section>