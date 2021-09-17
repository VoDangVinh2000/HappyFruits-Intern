<div class="container mt5">
    <div class="row">
        <?php
        if (!empty($choose_mega_menu)) {
            if (!empty($get_product_with_mega_menu)) {
                $arrProducts = array($get_product_with_mega_menu);
                foreach ($arrProducts as $value) {
                    for ($i = 0; $i < count($value); $i++) {
                        if ($value[$i]['image'] == "") {
        ?>
                            <div class="col-md-3 col-sm-6 col-6">
                                <div class="product-item">
                                    <div class="product-photo">
                                        <a href="/vi/detail/<?php echo $value[$i]['product_id'] . "/" . url_slug($value[$i]['name']) ?>" class="photo-link">
                                            <img src="<?php echo $imageDefault ?>" alt="<?php echo $value[$i]['code'] ?>">
                                        </a>
                                        <a class="btn-shop btn-cart" href="">
                                            <div class="button-content-wrapper">
                                                <span class="button-text efruit-vi">Chi tiết</span>
                                                <span class="button-text efruit-en">Detail</span>
                                            </div>
                                        </a>
                                        <div ng-click="showProduct(<?php echo $value[$i]['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                                    </div>
                                    <div class="product-info" style="margin-top: 12px;">
                                        <!-- <div class="row mt-2"> -->
                                        <div class="col-7 product-name">
                                            <a class=" efruit-vi" href="/vi/detail/<?php echo $value[$i]['product_id'] . "/" . url_slug($value[$i]['name'])  ?>"><?= $value[$i]['name'] ?></a>
                                            <a class=" efruit-en" href="/vi/detail/<?php echo $value[$i]['product_id'] . "/" . url_slug($value[$i]['name'])  ?>"><?= $value[$i]['english_name'] ?></a>
                                        </div>
                                        <div class="col-5">
                                            <div class="product-price">
                                                <?php if (empty($value[$i]['is_box'])) : ?>
                                                    <?php if ($value[$i]['price'] > 0) : ?>
                                                        <?php if ($value[$i]['promotion_price'] == 0) : ?>
                                                            <a href="javascript:void(0);" class="price"><?= number_format($value[$i]['price'] * 1000) ?><sup>đ</sup></a>
                                                        <?php else : ?>
                                                            <a href="javascript:void(0);">
                                                                <span class="delete-price"><?= number_format($value[$i]['price'] * 1000) ?><sup>đ</sup></span>
                                                                <span class="price"><?= number_format($value[$i]['promotion_price'] * 1000) ?><sup>đ</sup></span>
                                                            </a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="col-md-3 col-sm-6 col-6">
                                <div class="product-item">
                                    <div class="product-photo">
                                        <a href="/vi/detail/<?php echo $value[$i]['product_id'] . "/" . url_slug($value[$i]['name']) ?>" class="photo-link">
                                            <img src="<?php echo $value[$i]['image'] ?>" alt="<?php echo $value[$i]['code'] ?>">
                                        </a>
                                        <a class="btn-shop btn-cart" href="">
                                            <div class="button-content-wrapper">
                                                <span class="button-text efruit-vi">Chi tiết</span>
                                                <span class="button-text efruit-en">Detail</span>
                                            </div>
                                        </a>
                                        <div ng-click="showProduct(<?php echo $value[$i]['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                                    </div>
                                    <div class="product-info" style="margin-top: 12px;">
                                        <!-- <div class="row mt-2"> -->
                                        <div class="col-7 product-name">
                                            <a class=" efruit-vi" href="/vi/detail/<?php echo $value[$i]['product_id'] . "/" . url_slug($value[$i]['name'])  ?>"><?= $value[$i]['name'] ?></a>
                                            <a class=" efruit-en" href="/vi/detail/<?php echo $value[$i]['product_id'] . "/" . url_slug($value[$i]['name'])  ?>"><?= $value[$i]['english_name'] ?></a>
                                        </div>
                                        <div class="col-5">
                                            <div class="product-price">
                                                <?php if (empty($value[$i]['is_box'])) : ?>
                                                    <?php if ($value[$i]['price'] > 0) : ?>
                                                        <?php if ($value[$i]['promotion_price'] == 0) : ?>
                                                            <a href="javascript:void(0);" class="price"><?= number_format($value[$i]['price'] * 1000) ?><sup>đ</sup></a>
                                                        <?php else : ?>
                                                            <a href="javascript:void(0);">
                                                                <span class="delete-price"><?= number_format($value[$i]['price'] * 1000) ?><sup>đ</sup></span>
                                                                <span class="price"><?= number_format($value[$i]['promotion_price'] * 1000) ?><sup>đ</sup></span>
                                                            </a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                </div>
                            </div>
        <?php }
                    }
                }
            } else {
                //Nếu không có sản phẩm nào 
                echo "<h3 class='efruit-vi text-center'>Hiện chưa có sản phẩm tương thích.</h3>
                      <h3 class='efruit-en text-center'>There are no compatible products.</h3>
                        ";
            }
        } ?>
    </div>
</div>