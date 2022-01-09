<div id="content-wrapper">
    <div id="page-wrapper">
        <div class="row">
            <form id="frmBlockHomePage" role="form" method="post" action="<?= BASE_URL ?>xu-ly">
                <!-- remember comment create the form !-->
                <?php foreach ($blockID[0] as $itemBlock) { ?>
                    <div class="col-md-2">
                        <h4>Chọn mẫu hiển thị</h2>
                            <select class="form-control" name="type_block" id="chooseAvailableThemes">
                                <option selected value="<?= $itemBlock['type_block'] ?>">Mẫu <?= $itemBlock['type_block'] ?></option>
                            </select>
                            <div>
                                <h4>Chọn loại hiển thị</h4>
                                <div class="col">
                                    <select name="category_id" class="form-control">
                                        <?php foreach ($menus['items'] as $itemMenus) {
                                                if($itemBlock['category_id'] == (int)$itemMenus['cat']){
                                            ?>
                                            <option selected value="<?= $itemMenus['cat'] ?>"><?= $itemMenus['short_text'] ?></option>
                                        <?php }else { ?>
                                            <option value="<?= $itemMenus['cat'] ?>"><?= $itemMenus['short_text'] ?></option>
                                        <?php }} ?>
                                    </select>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <h4>Chọn sản phẩm hiển thị (tối đa 4 sản phẩm)</h4>
                        <div id="page-wrapper">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive" id="list_container">
                                        <?php $controlerObj->load_view("block_homepage/tabledata_search/list_product"); ?>
                                    </div>
                                </div>
                                <!-- col-lg-12 !-->
                            </div>
                        </div>
                        <!-- page-wrapper !-->
                    </div>
                    <div class="col-md-4">
                        <h4>Các sản phẩm được chọn</h4>
                        <?php 
                            $products =explode(',',str_replace(array('"','[',']'),'',$itemBlock['products_id']));
                        ?>
                        <div class="products-selected" data-count="<?= count($blockID[1]); ?>">
                            <?php foreach($blockID[1] as $itemProducts){ 
                                    foreach($itemProducts as $value){
                                ?>
                            <div><input type="hidden" value="<?= $value['product_id'] ?>" name="product_id[]"></div>
                            <div class="sttProducts">1</div>
                            <div class="code"><?= $value['code'] ?></div>
                            <div class="name"><?= $value['name'] ?></div>
                            <button type="button" onclick="trashProduct(<?=$value['product_id'] ?>)">Xóa</button>
                            <?php }}?>
                        </div>
                    </div>
                <?php } ?>
                <input type="hidden" name="action" value="admin_save_blockhome" />
                <input type="submit" id="submit" value="Lưu" class="btn btn-submit">
                <!-- col-md-9 !-->
            </form>
        </div>
    </div>




    <form id="data-cate_pro" action="">
        <!-- categories tu database. chỉ hiện dữ liệu để lựa chọn khi, ta chọn mẫu phù hợp. -->
        <div id="categories"></div>
        <!-- products tu database. -->
        <div id="products"></div>
    </form>


    <div id="mau">

    </div>


</div>
<!-- /#page-wrapper -->
</div>
<!-- /#content-wrapper -->