<div class="container mt5">
    <div class="row">
        <?php
        if (!empty($gia)) {
            if (!empty($get_product_with_sell_price)) {
                $arrProducts = array($get_product_with_sell_price);
                foreach ($arrProducts as $value) {
                    for ($i = 0; $i < count($value); $i++) {
                        if ($value[$i]['image'] == "") {
        ?>
                            <div class="col-md-3 col-sm-3">
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
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12 col-lg-8 col-8 product-name">
                                            <a class=" efruit-vi" href="/vi/detail/<?php echo $value[$i]['product_id'] ?>"><?= $value[$i]['name'] ?></a>
                                            <a class=" efruit-en" href="/vi/detail/<?php echo $value[$i]['product_id'] ?>"><?= $value[$i]['english_name'] ?></a>
                                        </div>
                                        <div class="col-md-12 col-lg-4 col-4">
                                            <div class="product-price">
                                                <span class="price"><?= number_format($value[$i]['price'] * 1000) . '<sup>đ</sup>' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="col-md-3 col-sm-3">
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
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12 col-lg-8 col-8 product-name">
                                            <a class=" efruit-vi" href="/vi/detail/<?php echo $value[$i]['product_id'] ?>"><?= $value[$i]['name'] ?></a>
                                            <a class=" efruit-en" href="/vi/detail/<?php echo $value[$i]['product_id'] ?>"><?= $value[$i]['english_name'] ?></a>
                                        </div>
                                        <div class="col-md-12 col-lg-4 col-4">
                                            <div class="product-price">
                                                <span class="price"><?= number_format($value[$i]['price'] * 1000) . '<sup>đ</sup>' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        <?php }
                    }
                }
            }
            else{
                //Nếu không có sản phẩm nào 
                echo "<script>alert('Hiện chưa có sản phẩm nào cho mức giá này !');window.location.href='/vi'</script>";
            }
        } ?>
    </div>
</div>