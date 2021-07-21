<header id="header" class="">
    <div class="container">
        <div class="row1">
            <div style="width: 200px;">
                <a href="/vi" accesskey="1"><img src="<?= get_child_theme_assets_url() ?>img/main_logo.png" height="80" alt="<?= get_setting('site_name') ?>"></a>
            </div>
            <div style="text-align: right;">
                <?php /*
                <div class="menu-browse ninja-menu efruitjs" id="menu-search">
                    <input type="text" class="form-control" auto ng-model="search" placeholder="{{__('Nhập từ khóa để chọn món nhanh')}}" />
                </div>
                */ ?>
                <?php
                $settings = get_setting_options();
                $hotline_1 = $settings['hotline_1'];
                $hotline_2 = $settings['hotline_2'];
                if (!empty($hotline_1) || !empty($hotline_2)) :
                ?>
                    <div class="hotline inline-block">
                        <?php if (!empty($hotline_1)) : ?>
                            <div class="hvr-icon-grow-rotate inline-block" style="color: #51bd36;">
                                <a href="tel:<?= $hotline_1 ?>"><?= $hotline_1 ?></a>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($hotline_2)) : ?>
                            <div class="hvr-icon-grow-rotate inline-block" style="color: #51bd36;">
                                <a href="tel:<?= $hotline_2 ?>"><?= $hotline_2 ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <nav class="nav-quick_links">
                    <ul>
                        <?php if (!empty($settings['facebook_link'])) : ?>
                            <li><a class="picto fb" href="<?= $settings['facebook_link'] ?>" target="_blank"><span data-width="100px">Facebook</span></a></li>
                        <?php endif; ?>
                        <?php if (!empty($settings['youtube_link'])) : ?>
                            <li><a class="picto yt" href="<?= $settings['youtube_link'] ?>" target="_blank"><span data-width="83px">Youtube</span></a></li>
                        <?php endif; ?>
                        <?php if (!empty($settings['carer_link'])) : ?>
                            <li><a class="picto jobs" href="<?= $settings['carer_link'] ?>" target="_blank"><span data-width="145px" bind-translate="Tuyển dụng">Tuyển dụng</span></a></li>
                        <?php endif; ?>
                        <?php if (!empty($settings['contact_link'])) : ?>
                            <li><a class="picto contact" href="<?= $settings['contact_link'] ?>" target="_blank"><span data-width="75px" bind-translate="Liên hệ">Liên hệ</span></a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <div class="btn-visites">
                    <a class="efruit-vi" href="javascript:void(0);" onclick="showOrderFlow()"><span>Giao hàng</span> tận nơi</a>
                    <a class="efruit-en efruitjs" href="javascript:void(0);" onclick="showOrderFlow()"><span>Door to door</span> Delivery</a>
                </div>
                <nav class="nav-languages">
                    <ul>
                        <li><a ng-click="switchLanguage('vi')" ng-class="{active:settings.language=='vi'}" href="" tabindex="-1" class="nav-vi">vi</a></li>
                        <li><a ng-click="switchLanguage('en')" ng-class="{active:settings.language=='en'}" href="" tabindex="-1" class="nav-en">en</a></li>
                    </ul>
                </nav>
                <div class="nav-cart">
                    <a id="show-cart" data-target="#ui-wizard-modal" data-toggle="modal" href="#"><span><i class="shopping-cart"></i></span><span class="badge efruitjs" ng-show="totalQuantity">{{totalQuantity}}</span></a>
                </div>
            </div>
        </div>
        <div class="row2">
            <?php if (empty($main_menu['items'])) : ?>
                <nav class="nav-main">
                    <ul>
                        <li class="nav-main-item"><a href="/vi" bind-translate="Trang chủ">Trang chủ</a></li>
                        <?php /*
					<li class="nav-main-item daddy">
						<a href="#" class="">Menu</a>
						<div><div>
							<ul class="nav-main-dropdown drop1 container nav-categories">
								<?php
                                    $cats = [];
									$css_max_width = 'style="max-width: ' . (99/count($categories)) . '%"';
									foreach($categories as $item):
                                        $cats[$item['category_id']] = $item;
								?>
								<li <?=$css_max_width?> class="picto <?=sanitize_string($item['english_name'])?>">
									<a href="<?=$template == 'home'?'javascript:void(0);':ROOT_URL.'vi/?tag=menu&cat='.sanitize_string($item['english_name'])?>" class="category">
										<img src="<?=get_image_url($item['image'], 'square-small')?>" alt="">
										<span class="efruit-vi"><?=$item['name']?></span>
										<span class="efruit-en efruitjs"><?=$item['english_name']?></span>
									</a>
								</li>
								<?php endforeach; ?>
							</ul>
						</div></div>
					</li>
                    */ ?>
                        <li class="nav-main-item"><a href="/vi/gioi-thieu"><span class="efruit-vi">Về <?= get_setting('short_site_name') ?></span><span class="efruit-en efruitjs">Về <?=get_setting('short_site_name') ?></span></a></li>
                        <li class="nav-main-item"><a href="/vi/tin-tuc" bind-translate="Tin tức">Tin tức</a></li>
                        
					<li class="nav-main-item"><a href="/blog">Blog</a></li>
					
                        <li class="nav-main-item"><a href="/vi/uu-dai-thanh-vien" bind-translate="Thành viên">Thành viên</a></li>
                    </ul>
                </nav>
            <?php else : ?>
                <nav class="nav-main">
                    <ul>
                        <?php foreach ($main_menu['items'] as $m_item) : ?>
                            <li class="nav-main-item"><a href="<?= $m_item['href'] ?>"><span class="efruit-vi"><?= $m_item['text'] ?></span><span class="efruit-en efruitjs"><?= $m_item['en_text'] ?></span></a></li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            <?php endif; ?>
            <nav class="nav-featured">
                <ul>
                    <li><a href="#modal-pre-booking" data-target="#modal-pre-booking" data-toggle="modal" data-backdrop="static" data-keyboard="false"><span class="efruit-vi">Ưu đãi<br />đặt trước</span><span class="efruit-en efruitjs">Pre-order promotion</span></a></li>
                    <li><a href="/vi/khuyen-mai" bind-translate="Khuyến mãi">Khuyến mãi</a></li>
                    <li><a data-scroll-to="#san-pham-dac-trung" href="/vi/san-pham-dac-trung"><span class="efruit-vi">Sản phẩm<br />đặc trưng</span><span class="efruit-en efruitjs">Featured<br />products</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<div class="content" id="content">
    <div class="navigation mobile-view" id="navigation">
        <div class="mobile-nav">
            <a href="#" class="menu-bar"><span class="ham"></span></a>
            <div class="menu-main-menu-container hidden">
                <ul id="menu-main-menu" class="menu">
                    <?php
                    if (!empty($tiles)) :
                        foreach ($tiles as $tile) :
                    ?>
                            <li class="menu-item">
                                <a class="efruit-vi" href="<?= $tile['href'] ?>"><?= $tile['short_text'] ?></a>
                                <a class="efruit-en efruitjs" href="<?= $tile['href'] ?>"><?= $tile['en_text'] ?></a>
                                <?php if (!empty($tile['sub_items'])) : ?>
                                    <ul class="nav-mobile-dropdown">
                                        <?php foreach ($tile['sub_items'] as $item) : ?>
                                            <li class="<?= sanitize_string($item['english_name']) ?>">
                                                <?php if (!empty($item['category_id'])) : ?>
                                                    <a data-scroll-to=".product-cat-<?= $item['category_id'] ?>" href="<?= $tile['href'] ?>#to-cat-<?= $item['category_id'] ?>">
                                                        <span class="efruit-vi"><?= $item['name'] ?></span>
                                                        <span class="efruit-en efruitjs"><?= $item['english_name'] ?></span>
                                                    </a>
                                                <?php elseif (!empty($item['tag_id'])) : ?>
                                                    <a data-scroll-to=".product-tag-<?= $item['tag_id'] ?>" href="<?= $tile['href'] ?>#to-tag-<?= $item['tag_id'] ?>">
                                                        <span class="efruit-vi"><?= $item['tag_name'] ?></span>
                                                        <span class="efruit-en efruitjs"><?= $item['english_name'] ?></span>
                                                    </a>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                    <?php
                        endforeach;
                    endif;
                    ?>
                    <li class="menu-item">
                        <a class="efruit-vi" href="javascript:void(0);" onclick="showOrderFlow()"><span>Giao hàng</span> tận nơi</a>
                        <a class="efruit-en" href="javascript:void(0);" onclick="showOrderFlow()"><span>Door to door</span> Delivery</a>
                    </li>
                    <li class="menu-item">
                        <a href="#modal-pre-booking" data-target="#modal-pre-booking" data-toggle="modal" data-backdrop="static" data-keyboard="false"><span class="efruit-vi">Ưu đãi đặt trước</span><span class="efruit-en">Pre-order promotion</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <table>
            <tbody>
                <tr>
                    <td class="logo-wrap">
                        <a class="logo" id="logo" href="/vi"><img alt="logo" height="40" src="<?= get_child_theme_assets_url() ?>img/small-logo.png" /></a>
                    </td>
                    <td class="tel-wrap">
                        <?php if (!empty($hotline_1)) : ?>
                            <div class="hvr-icon-grow-rotate" style="color: #51bd36;">
                                <a href="tel:<?= $hotline_1 ?>"><?= $hotline_1 ?></a>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($hotline_2)) : ?>
                            <?php if (!empty($hotline_1)) : ?><br /><?php endif; ?>
                            <div class="hvr-icon-grow-rotate" style="color: #51bd36;">
                                <a href="tel:<?= $hotline_2 ?>"><?= $hotline_2 ?></a>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td class="nav-wrap">
                        <a id="show-cart2" data-target="#ui-wizard-modal" data-toggle="modal" href="#"><span><i class="shopping-cart"></i></span><span class="badge efruitjs" ng-show="totalQuantity">{{totalQuantity}}</span></a>
                    </td>
                    <td class="login-state">
                        <div class="efruitjs" id="language_selector">
                            <ul>
                                <li><a ng-click="switchLanguage('vi')" class="efruit-en" href="" tabindex="-1" role="menuitem"><img alt="vi" width="35" height="20" alt="vi" src="<?= get_theme_assets_url() ?>img/flags/vi.png" class="language_flag" /></a></li>
                                <li><a ng-click="switchLanguage('en')" class="efruit-vi" href="" tabindex="-1" role="menuitem"><img alt="en" width="35" height="20" alt="en" src="<?= get_theme_assets_url() ?>img/flags/en.png" class="language_flag" /></a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
    $slide_images = !empty($obj) ? json_decode($obj['slide_images'], true) : null;
    if (empty($slide_images) && getvalue($homepage, 'slide_images'))
        $slide_images = json_decode($homepage['slide_images'], true);
    if (!empty($slide_images) && count($slide_images) > 1) :
        $c1 = 'col-md-12';
        if (!empty($promotions_with_banner))
            $c1 = 'col-md-9';

    ?>
        <div class="container-fluid no-padding">
            <div class="row">
                <div class="<?= $c1 ?>">
                    <div class="mainSlider sliderSp-list">
                        <div id="sliderSp-list" class="">
                            <?php $i = 0;
                            foreach ($slide_images as $slide) : if (empty($slide['image'])) continue; ?>
                                <div class="item <?= $i > 0 ? 'efruitjs' : '' ?>">
                                    <div class="banner-container" style="background-image:url(<?= valid_url($slide['image']) ?>);">
                                        <div class="banner-content-container">
                                            <?php if (!empty($slide['content']) || !empty($slide['url'])) : ?>
                                                <div class="featured-content featured-gradient-<?= getvalue($slide, 'color', 'green') ?>">
                                                    <?= $slide['content'] ?>
                                                    <?php if ($slide['url']) : ?>
                                                        <?php if (strstr($slide['url'], '/' . $page_code)) : ?>
                                                            <p class="more">
                                                                <a class="efruit-vi" data-scroll-to=".application-body .content-body" href="javascript:void(0);">Xem chi tiết</a>
                                                                <a class="efruit-en efruitjs" data-scroll-to=".application-body .content-body" href="javascript:void(0);">View details</a>
                                                            </p>
                                                        <?php else : ?>
                                                            <p class="more">
                                                                <a class="efruit-vi" href="<?= valid_url($slide['url']) ?>">Xem chi tiết</a>
                                                                <a class="efruit-en efruitjs" href="<?= valid_url($slide['url']) ?>">View details</a>
                                                            </p>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php $i++;
                            endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php if (!empty($promotions_with_banner)) : ?>
                    <div class="col-md-3">
                        <div id="vertical">
                            <?php foreach ($promotions_with_banner as $pro) : ?>
                                <div class="item">
                                    <a href="<?= !empty($pro['promotion_link']) ?: 'javascript:void(0);' ?>">
                                        <img style="max-height:85px;display: block;" src="<?= $pro['promotion_image'] ?>" />
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>