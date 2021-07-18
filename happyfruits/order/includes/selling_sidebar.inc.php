<?php
$sql = "SELECT categories.category_id, IF(pc.name IS NULL, categories.name, pc.name) as `name`, IF(pc.sequence_number IS NULL, categories.sequence_number, pc.sequence_number) as cat_sequence_order, 
                products.name as product_name, products.product_id, products.enabled, products.free_choice, products.code as product_code, categories.enabled as cat_enabled 
        FROM categories
        LEFT JOIN categories pc ON pc.category_id = categories.parent_id AND categories.parent_id = 2
        INNER JOIN products ON categories.category_id = products.category_id AND products.is_additional = 0 AND products.deleted = 0";
$categories = eModel::_do_sql($sql, array(), array(), ' cat_sequence_order, products.sequence_number');
?>
<div class="col-sm-4 col-md-3 sidebar">
    <input type="text" class="form-control search-control" auto ng-model="search" placeholder="Tìm nhanh"/>
    <?php if ($categories): ?>
        <ul class="nav nav-sidebar">
        <?php
        $current_category_name = '';
        $counter = 0;
        foreach ($categories as $category):
            if (!$category['cat_enabled'])
                continue;
            $category_name = $category['name'];
            if ($current_category_name != $category_name):

                if ($counter):
                    ?>
                    </ul>
                    </li>
                <?php endif; ?>
                <?php
                $counter = 1;
                $current_category_name = $category_name;

                ?>

                <li>
                <a href="" class="category"
                   ng-class="{active:current_order.quantityInCategory[<?= $category['category_id'] ?>]}">
                    <?= $category_name ?><span class="badge"
                                               ng-show="current_order.quantityInCategory[<?= $category['category_id'] ?>]">{{current_order.quantityInCategory[<?= $category['category_id'] ?>
                        ]}}</span>
                    <i class="up"></i>
                </a>
                <ul class="products" style="display: none;">
            <?php
            else:
                $counter++;
            endif;
            ?>
            <?php if ($category['enabled']): ?>
            <li ng-click="addItem(<?= $category['product_id'] ?>)"
                ng-right-click="removeItem(<?= $category['product_id'] ?>,1)"
                ng-class="{active:quantityOfItem[<?= $category['product_id'] ?>]}" data-placement="top">
                <span class="product_name"><?= $category['product_code'] . ' - ' . $category['product_name'] ?></span>
                <span class="badge" ng-show="current_order.quantityOfItem[<?= $category['product_id'] ?>]">{{current_order.quantityOfItem[<?= $category['product_id'] ?>
                    ]}}</span>
            </li>
        <?php else: ?>
            <li class="disabled" ng-class="{hidden:settings.hideSoldOut == 1}" data-placement="top">
                <span class="product_name"><?= $category['product_code'] . ' - ' . $category['product_name'] ?></span>
                <img class="sold_out" src="<?= SITE_URL ?>images/sold_out.png"/>
            </li>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php if ($counter): ?>
                </ul>
                </li>
        <?php endif; ?>
        </ul>
    <?php endif; ?>
</div>