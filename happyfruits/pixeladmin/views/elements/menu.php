<?php

/**
		Main menu
		
		Notes:
 * to make the menu item active, add a class 'active' to the <li>
		  example: <li class="active">...</li>
 * multilevel submenu example:
			<li class="mm-dropdown">
			  <a href="#"><span class="mm-text">Submenu item text 1</span></a>
			  <ul>
				<li>...</li>
				<li class="mm-dropdown">
				  <a href="#"><span class="mm-text">Submenu item text 2</span></a>
				  <ul>
					<li>...</li>
					...
				  </ul>
				</li>
				...
			  </ul>
			</li>
 */ ?>
<div id="main-menu" role="navigation">
    <div style="overflow: hidden; width: auto; height: 100%;" id="main-menu-inner">
        <div class="menu-content top animated fadeIn" id="menu-account-profile">
            <div>
                <div class="text-bg"><span class="text-slim">Chào </span> <span class="text-semibold"><?= $logged_user['username'] ?></span></div>
                <img src="<?= ASSET_URL ?>images/profile.jpg" alt="" class="" />
                <div class="btn-group">
                    <?php if (Users::can_access('user', 'profile')) : ?>
                        <a href="<?= BASE_URL . $URIs['profile'] ?>" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-user"></i></a>
                    <?php endif; ?>
                    <a href="<?= BASE_URL ?>dang-xuat" class="btn btn-xs btn-danger btn-outline dark"><i class="fa fa-power-off"></i></a>
                </div>
                <a href="#" class="close">×</a>
            </div>
        </div>
        <ul class="navigation">
            <li class="tag active">
                <a target="blank" href="<?= BASE_URL ?>block-homepage"><i class="menu-icon fa fa-tags"></i><span class="mm-text mmc-dropdown-delay animated fadeIn">Quản lý block home page</span></a>
            </li>

            <?php
            if ($menu_items) :
                $is_frontend = get_session_val('is_frontend');
                $menu_type = get_session_val('menu_type', 'general');
            ?>
                <?php foreach ($menu_items as $key => $item) :
                    if (!empty($item['not_show']))
                        continue;
                    $has_sub_menu = !empty($item['sub_menu_items']) && is_array($item['sub_menu_items']);
                    if (!Users::can_access($key, 'index'))
                        continue;

                    if (Users::is_super_admin()) {
                        if ($menu_type != $item['menu_type'])
                            continue;
                    } else if (
                        $is_frontend && empty($item['frontend']) ||
                        !$is_frontend && !empty($item['frontend'])
                    )
                        continue;

                ?>
                    <li class="<?= $key . ($has_sub_menu ? ' mm-dropdown mm-dropdown-root' : '') ?>">
                        <a href="<?= $item['url'] ?>" <?= !empty($item['target']) ? ('target="' . $item['target'] . '"') : '' ?>><i class="menu-icon fa <?= $item['icon_class'] ?>"></i><span class="mm-text mmc-dropdown-delay animated fadeIn"><?= $item['label'] ?></span></a>
                        <?php if ($has_sub_menu) : ?>
                            <ul class="mmc-dropdown-delay animated fadeInLeft">
                                <?php
                                foreach ($item['sub_menu_items'] as $s_key => $s_item) :
                                    if (!Users::can_access($key, $s_key))
                                        continue;
                                ?>
                                    <li class="<?= $s_key ?>"><a tabindex="-1" href="<?= $s_item['url'] ?>" <?= !empty($s_item['target']) ? ('target="' . $s_item['target'] . '"') : '' ?>><i class="menu-icon fa <?= $s_item['icon_class'] ?>"></i><span class="mm-text"><?= $s_item['label'] ?></span></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul> <!-- / .navigation -->
    </div><!-- / #main-menu-inner -->
</div> <!-- / #main-menu -->
<?php /** END_MAIN_MENU */ ?>