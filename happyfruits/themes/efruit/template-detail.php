<?php if (empty($id) || empty($product)) {
    echo  "<script>window.location.href='" . frontend_url() . "'</script>";
} ?>

<?php $this->load_theme_file('page-header.php')
?>
<?php
if (isset($product['sell_price'])) {
    $oldPrice = $product['sell_price'] * 1000;
    $newPrice = $oldPrice - ($product['promotion_price'] * 1000);
} else {
    echo  "<script>window.location.href='" . frontend_url() . "'</script>";
}
?>
<div class="container mb-5">
    <div class="row">
        <div class="col-md-6">
            <div class="product-gallery">
                <div class="row g-2">
                    <?php
                    if ($product['image'] == "") {
                    ?>
                        <div class="col-12">
                            <a href="<?php echo $imageDefault ?>" title="<?php echo $product['name'] ?>"><img src="<?php echo $imageDefault ?>" alt="<?php echo $product['name'] ?>" class="img-fluid"></a>
                        </div>
                        <div class="col-3">
                            <a href="<?php echo $imageDefault ?>" title="<?php echo $product['name'] ?>"><img src="<?php echo $imageDefault ?>" alt="<?php echo $product['name'] ?>" class="img-fluid"></a>
                        </div>
                        <div class="col-3">
                            <a href="<?php echo $imageDefault ?>" title="<?php echo $product['name'] ?>"><img src="<?php echo $imageDefault ?>" alt="<?php echo $product['name'] ?>" class="img-fluid"></a>
                        </div>
                    <?php } else { ?>
                        <div class="col-12">
                            <a href="<?php echo $product['image'] ?>" title="<?php echo $product['name'] ?>"><img src="<?php echo $product['image'] ?>" alt="<?php echo $product['name'] ?>" class="img-fluid"></a>
                        </div>
                        <div class="col-3">
                            <a href="<?php echo $product['image'] ?>" title="<?php echo $product['name'] ?>"><img src="<?php echo $product['image'] ?>" alt="<?php echo $product['name'] ?>" class="img-fluid"></a>
                        </div>
                        <div class="col-3">
                            <a href="<?php echo $product['image'] ?>" title="<?php echo $product['name'] ?>"><img src="<?php echo $product['image'] ?>" alt="<?php echo $product['name'] ?>" class="img-fluid"></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-6 product-detail">
            <h1 class="product-title mb-3">
                <span class="product-name efruit-vi"><?php echo $product['name'] ?></span> <span class="product-sku"></span>
                <span class="product-name efruit-en"><?php echo $product['english_name'] ?></span> <span class="product-sku">| <?php echo $product['code'] ?></span>
            </h1>
            <div class="product-price">
                <span class="price"><?php echo $newPrice ?>₫</span>
                <span class="delete-price"><?php echo $oldPrice ?>₫</span>

            </div>
            <form action="#" method="POST">
                <div class="input-group my-3">
                    <!-- <button class="btn btn-outline-secondary" type="button" id="button-addon1">+</button>
                    <input type="text" class="form-control" placeholder="1" aria-label="1" aria-describedby="button-addon1">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon1">-</button> -->

                    <!-- <input class="minus is-form" type="button" value="-"> -->
                    <input aria-label="quantity form-control" class="input-qty" max="100" min="1" name="" type="number" value="1">
                    <!-- <input  aria-label="quantity form-control" class="input-qty" only-number name="quantity" max="100" min="1" name="" type="number" value="1" ng-model="orderItem.quantity" ng-blur="validateQuantity(orderItem.key)" ng-change="onChangeQuantity(orderItem.key)"> -->
                    <!-- <input class="plus is-form" type="button" value="+"> -->
                </div>
                <?php if (!empty($product['enabled']) && empty($product['not_deliver'])) : ?>
                        <button class="btn-shop" ng-click="saveSelectedItemToCart()">
                            <div class="button-content-wrapper" ng-click="showProduct(<?= $product['product_id'] ?>, $event)">
                                <span class="button-text efruit-vi"> THÊM GIỎ HÀNG</span>
                                <span class="button-text efruit-en"> ADD TO CARD</span>
                            </div>
                        </button>
                <?php elseif (empty($product['enabled'])) : ?>
                    <div><img alt="sold-out" src="<?= get_theme_assets_url() ?>img/sold_out.png" class="sold_out efruit-vi" /><img alt="sold-out" class="sold_out efruit-en" src="<?= get_theme_assets_url() ?>img/sold_out_en.png" /></div>
                <?php endif; ?>

                <!-- <a class="btn-shop" href="#">
                        <div class="button-content-wrapper">
                            <span class="button-text efruit-vi"> THÊM GIỎ HÀNG</span>
                            <span class="button-text efruit-en">ADD TO CARD</span>
                        </div>
                    </a> -->
            </form>
            <div class="product-description mt-3">
                <!-- <//?php echo $product['description'] ?> -->
                <p class=" efruit-vi"><?= $product['description'] ?></p>
                <p class=" efruit-en"><?= $product['description_en'] ?></p>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <h3 class="section-heading efruit-vi"><span>Sản phẩm liên quan</span></h3>
    <h3 class="section-heading efruit-en"><span>Related products</span></h3>
    <div class="row">
        <?php
        $counter = 0;
        $array_category = [
            6 => "traiCayDacSanViet", 14 => "gioTraiCay", 15 => "hopTraiCay",
            8 => "hoaTraiCay", 12 => "traiCayNhap", 7 => "sanPhamKhac"
        ];
        $category_of_page_detail = $array_category[$product['category_id']];
        if (!empty($category_of_page_detail)) :
            foreach ($$category_of_page_detail as $item) :
                $counter++;
                if ($counter >= 5) {
                    return;
                }
        ?>
                <div class="col-md-3 col-sm-3 col-6">
                    <?php $this->load_partial('product-item-box', array('item' => $item)); ?>
                </div>
        <?php
            endforeach;
        endif;
        ?>
    </div>
</div>
<!-- </div> -->

<?php
echo "footer";
//$this->load_theme_file('page-footer.php') 
?>