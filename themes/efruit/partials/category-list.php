<?php if(!empty($tiles)): ?>
<div class="c-category-list o-color--catering">
    <div class="c-cat-nav cs-can-blur" style="background-color:#72a499;z-index:0">
        <div class="o-wrapper">
            <ul class="c-nav-category sf-js-enabled" style="touch-action: pan-y;">
                <?php foreach($tiles as $tile): $is_current_page = strstr($tile['href'], '/'.$page_code);?>
                <li class="menu-item menu-level-0 <?=$is_current_page?'current-item':''?>">
                    <a href="<?=$tile['href']?>" class="sf-with-ul">
                        <span class="efruit-vi"><?=$tile['short_text']?></span>
                        <span class="efruit-en efruitjs"><?=$tile['en_text']?></span>
                    </a>
                    <?php if(!empty($tile['sub_items'])): $length = count($tile['sub_items']); $col_length = ceil($length/3); ?>
                    <ul class="sub-menu left-align" style="display: none;">
                        <?php $counter = 0; for($idx = 1; $idx <= 3; $idx++):?>
                            <?php if($length >= $idx && $counter < $length):?>
                                <li class="menu-item menu-level-1">
                                    <ul class="sub-menu" style="display: none;">
                                        <?php for($i = $col_length*($idx-1); $i < min($col_length*$idx, $length); $i++): ?>
                                        <li class="menu-item menu-level-2 ">
                                            <?php if(!empty($tile['sub_items'][$i]['category_id'])):?>
                                                <a <?=$is_current_page?'data-scroll-to=".product-cat-'.$tile['sub_items'][$i]['category_id'].'"':''?> href="/vi/fruit-baskets#to-cat-<?=$tile['sub_items'][$i]['category_id']?>">
                                                    <span class="efruit-vi"><?=$tile['sub_items'][$i]['name']?></span>
                                                    <span class="efruit-en efruitjs"><?=$tile['sub_items'][$i]['english_name']?></span>
                                                </a>
                                            <?php elseif(!empty($tile['sub_items'][$i]['tag_id'])):?>
                                                <a <?=$is_current_page?'data-scroll-to=".product-tag-'.$tile['sub_items'][$i]['tag_id'].'"':''?> href="/vi/hamper-box-fruits#to-tag-<?=$tile['sub_items'][$i]['tag_id']?>">
                                                    <span class="efruit-vi"><?=$tile['sub_items'][$i]['tag_name']?></span>
                                                    <span class="efruit-en efruitjs"><?=$tile['sub_items'][$i]['english_name']?></span>
                                                </a>
                                            <?php endif;?>
                                        </li>
                                        <?php $counter++; endfor; ?>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        <?php endfor;?>
                    </ul>
                    <?php endif; ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<?php endif; ?>