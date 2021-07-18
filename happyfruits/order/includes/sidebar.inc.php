<?php 
    $sql = "SELECT categories.category_id, IF(pc.name IS NULL, categories.name, pc.name) as `name`, IF(pc.english_name IS NULL, categories.english_name, pc.english_name) as english_name,
                IF(pc.sequence_number IS NULL, categories.sequence_number, pc.sequence_number) as cat_sequence_order, 
                products.code as product_code, products.name as product_name, products.english_name as product_english_name, products.product_id, products.enabled, products.free_choice, products.is_box, prices.price
            FROM categories
            LEFT JOIN categories pc ON pc.category_id = categories.parent_id AND categories.parent_id = 2
            INNER JOIN products ON categories.category_id = products.category_id AND products.is_additional = 0 AND products.is_hidden = 0 AND products.deleted = 0
            INNER JOIN prices ON prices.product_id = products.product_id AND prices.type_id = ".DELIVERY_TYPE_ID;
	$filters = array();
	if (empty($is_local_order))
		$filters['categories.allow_delivery'] = 1;
    $categories = eModel::_do_sql($sql, $filters, array(), ' cat_sequence_order, products.sequence_number');
?>
        <div class="col-sm-4 col-md-3 sidebar">
          <ul class="nav nav-sidebar">
          <?php 
            $current_category_name = '';
            $counter = 0;
            foreach($categories as $category):
                $category_name = $category['name'];
                if ($current_category_name != $category_name):
                    
                    if ($counter):
          ?>
                </ul>
            </li>
                <?php endif;?>
          <?php
                    $counter = 1;
                    $current_category_name = $category_name;
                    
          ?>
            
            <li>
                <a href="" class="category" ng-class="{active:quantityInCategory[<?=$category['category_id']?>]}">
                    <span ng-show="settings.language!='en'"><?=$category_name?></span>
                    <span ng-show="settings.language=='en'"><?=$category['english_name']?></span>
                    <span class="badge" ng-show="quantityInCategory[<?=$category['category_id']?>]">{{quantityInCategory[<?=$category['category_id']?>]}}</span>
                    <i class="up"></i>
                </a>
                <ul class="products" style="display: none;">
            <?php 
                else: 
                    $counter++;
                endif; 
            ?>
                    <?php if($category['enabled']):?>
                    <?php
                        $action = 'ng-click="addItem('.$category['product_id'].')" ng-right-click="removeItem('.$category['product_id'].',1)"';
                        if($category['is_box']){
                            $action = 'ng-click="showProduct('.$category['product_id'].')"';
                        }
                    ?>
                    <li <?=$action?> ng-class="{active:quantityOfItem[<?=$category['product_id']?>]}" data-placement="top" title="{{<?=$category['price']?> + '.000đ'}}">
                        <span class="product_name" ng-show="settings.language!='en'"><?=$category['product_code'] . ' - '. $category['product_name']?></span>
                        <span class="product_name" ng-show="settings.language=='en'"><?=$category['product_code'] . ' - '. $category['product_english_name']?></span>
                        <span class="badge" ng-show="quantityOfItem[<?=$category['product_id']?>]">{{quantityOfItem[<?=$category['product_id']?>]}}</span>
                    </li>
                    <?php else:?>
                    <li class="disabled" ng-class="{hidden:settings.hideSoldOut == 1}" data-placement="top" title="{{<?=$category['price']?> + '.000đ'}}">
                        <span class="product_name" ng-show="settings.language!='en'"><?=$category['product_code'] . ' - '. $category['product_name']?></span>
                        <span class="product_name" ng-show="settings.language=='en'"><?=$category['product_code'] . ' - '. $category['product_english_name']?></span>
	                    <span class="badge" ng-show="quantityOfItem[<?=$category['product_id']?>]">{{quantityOfItem[<?=$category['product_id']?>]}}</span>
                        <img ng-show="settings.language!='en'" class="sold_out" src="<?=SITE_URL?>images/sold_out.png" />
                        <img ng-show="settings.language=='en'" class="sold_out" src="<?=SITE_URL?>images/sold_out_en.png" />
                    </li>
                    <?php endif;?>
          <?php endforeach; ?>
          <?php if ($counter):?>
                </ul>
            </li>
          <?php endif;?>
          </ul>
        </div>
