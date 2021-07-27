<?php if(empty($id) || empty($product)){echo  "<script>window.location.href='".frontend_url()."'</script>";} ?>

<?php $this->load_theme_file('page-header.php')
?>
<<<<<<< HEAD
<?php
if (isset($product['sell_price'])) {
    $oldPrice = $product['sell_price'] * 1000;
    $newPrice = $oldPrice - ($product['promotion_price'] * 1000);
} else {
    echo  "<script>window.location.href='" . frontend_url() . "'</script>";
}
=======

<?php
    $oldPrice = $product['sell_price'] * 1000;
    $newPrice = $oldPrice - ($product['promotion_price'] * 1000);
>>>>>>> b633ff4f528ef2a9c76b5d3303a3e6bc7b1356b3
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
                <span class="product-name"><?php echo $product['name'] ?></span> <span class="product-sku">| <?php echo $product['code'] ?></span>
            </h1>
            <div class="product-price">
                <span class="price"><?php echo $newPrice ?>₫</span>
                <span class="delete-price"><?php echo $oldPrice ?>₫</span>

            </div>
            <form action="#" method="POST">
                <div class="input-group my-3">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon1">+</button>
                    <input type="text" class="form-control" placeholder="1" aria-label="1" aria-describedby="button-addon1">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon1">-</button>
                </div>
                <a class="btn-shop" href="#">
                    <div class="button-content-wrapper">
                        <span class="button-text">THÊM GIỎ HÀNG</span>
                    </div>
                </a>
            </form>
            <div class="product-description mt-3">
                <?php echo $product['description'] ?>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <h3 class="section-heading"><span>Sản phẩm liên quan</span></h3>
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