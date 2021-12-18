<div id="content-wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-2">
                <h4>Chọn mẫu hiển thị</h2>
                    <select class="form-control" name="type_theme" id="chooseAvailableThemes">
                        <option selected value="1">Mẫu 1</option>
                        <option value="2">Mẫu 2</option>
                        <option value="3">Mẫu 3</option>
                        <option value="4">Mẫu 4</option>
                    </select>
                    <div>
                        <h4>Chọn loại hiển thị</h4>
                        <div class="col">
                            <select name="category_id" class="form-control">
                                <?php foreach ($menus['items'] as $item) { ?>
                                    <option value="<?= $item['cat'] ?>"><?= $item['short_text'] ?></option>
                                <?php } ?>
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
                <div class="products-selected">
                </div>
            </div>
            <input type="submit" value="Luu">
            <!-- col-md-9 !-->
        </div>
    </div>




    <form id="data-cate_pro" action="">
        <!-- categories tu database. chỉ hiện dữ liệu để lựa chọn khi, ta chọn mẫu phù hợp. -->
        <div id="categories"></div>
        <!-- products tu database. -->
        <div id="products"></div>
    </form>


    <div id="">
       
    </div>


</div>
<!-- /#page-wrapper -->
</div>
<!-- /#content-wrapper -->