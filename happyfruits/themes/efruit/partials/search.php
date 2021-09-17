<div class="container mt5">
    <div class="row">
        <?php
        $arrProducts = [];
        if (!empty($get_product_by_search_key)) {
            echo "<h3 class='efruit-en d-flex justify-content-center'>Result for search by key: {$_POST['key']} </h3>
             <h3 class='efruit-vi d-flex justify-content-center'>Kết quả tìm kiếm cho từ khóa: {$_POST['key']}</h3> ";
            $arrProducts = $get_product_by_search_key;
            foreach ($arrProducts as $value) {
                if ($value['image'] == '') {
        ?>
                    <div class="col-md-3 col-sm-6 col-6">
                        <div class="product-item">
                            <div class="product-photo">
                                <a href="/vi/detail/<?php echo $value['product_id'] . "/" . url_slug($value['name']) ?>" class="photo-link">
                                    <img src="<?php echo $imageDefault ?>" alt="<?php echo $value['code'] ?>">
                                </a>
                                <a class="btn-shop btn-cart" href="">
                                    <div class="button-content-wrapper">
                                        <span class="button-text efruit-vi">Chi tiết</span>
                                        <span class="button-text efruit-en">Detail</span>
                                    </div>
                                </a>
                                <div ng-click="showProduct(<?php echo $value['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                            </div>
                            <div class="product-info" style="margin-top: 12px;">
                                <!-- <div class="row mt-2"> -->
                                <div class="col-7 product-name">
                                    <a class=" efruit-vi" href="/vi/detail/<?php echo $value['product_id'] . "/" . url_slug($value['name'])  ?>"><?= $value['name'] ?></a>
                                    <a class=" efruit-en" href="/vi/detail/<?php echo $value['product_id'] . "/" . url_slug($value['name'])  ?>"><?= $value['english_name'] ?></a>
                                </div>
                                <div class="col-5">
                                    <div class="product-price">
                                        <?php if (empty($value['is_box'])) : ?>
                                            <?php if ($value['price'] > 0) : ?>
                                                <?php if ($value['promotion_price'] == 0) : ?>
                                                    <a href="javascript:void(0);" class="price"><?= number_format($value['price'] * 1000) ?><sup>đ</sup></a>
                                                <?php else : ?>
                                                    <a href="javascript:void(0);">
                                                        <span class="delete-price"><?= number_format($value['price'] * 1000) ?><sup>đ</sup></span>
                                                        <span class="price"><?= number_format($value['promotion_price'] * 1000) ?><sup>đ</sup></span>
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
                                <a href="/vi/detail/<?php echo $value['product_id'] . "/" . url_slug($value['name']) ?>" class="photo-link">
                                    <img src="<?php echo $value['image'] ?>" alt="<?php echo $value['code'] ?>">
                                </a>
                                <a class="btn-shop btn-cart" href="">
                                    <div class="button-content-wrapper">
                                        <span class="button-text efruit-vi">Chi tiết</span>
                                        <span class="button-text efruit-en">Detail</span>
                                    </div>
                                </a>
                                <div ng-click="showProduct(<?php echo $value['product_id'] ?>, $event)" class="btn-yum btn-wrapper add-to-cart"><span class="yum"></span></div>
                            </div>
                            <div class="product-info" style="margin-top: 12px;">
                                <!-- <div class="row mt-2"> -->
                                <div class="col-7 product-name">
                                    <a class=" efruit-vi" href="/vi/detail/<?php echo $value['product_id'] . "/" . url_slug($value['name'])  ?>"><?= $value['name'] ?></a>
                                    <a class=" efruit-en" href="/vi/detail/<?php echo $value['product_id'] . "/" . url_slug($value['name'])  ?>"><?= $value['english_name'] ?></a>
                                </div>
                                <div class="col-5">
                                    <div class="product-price">
                                        <?php if (empty($value['is_box'])) : ?>
                                            <?php if ($value['price'] > 0) : ?>
                                                <?php if ($value['promotion_price'] == 0) : ?>
                                                    <a href="javascript:void(0);" class="price"><?= number_format($value['price'] * 1000) ?><sup>đ</sup></a>
                                                <?php else : ?>
                                                    <a href="javascript:void(0);">
                                                        <span class="delete-price"><?= number_format($value['price'] * 1000) ?><sup>đ</sup></span>
                                                        <span class="price"><?= number_format($value['promotion_price'] * 1000) ?><sup>đ</sup></span>
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
        } else {
            //Nếu không có sản phẩm nào 
            echo "<h3 class='efruit-en d-flex justify-content-center'>Not found product.</h3>
             <h3 class='efruit-vi d-flex justify-content-center'>Không tìm thấy sản phẩm.</h3> ";
        }
        ?>
    </div>
</div>