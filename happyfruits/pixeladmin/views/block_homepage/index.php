<div id="content-wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-3">
                <h3>Chọn mẫu hiển thị</h2>
                    <select class="form-control" name="type_theme" id="chooseAvailableThemes">
                        <option selected value="1">1</option>
                        <option value="2">2</option>
                    </select>
                    <div>
                        <h3>Chọn loại hiển thị</h3>
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
                <h3>Chọn sản phẩm hiển thị (tối thiểu 4 sản phẩm)</h3>
                <div id="page-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive" id="list_container">
                                <?php $controlerObj->load_view("block_homepage/tabledata_search/list_product"); ?>
                            </div>
                            <div class="for_datatable_filter">
                                <ul>
                                    <li>Nhóm hàng:
                                        <?php echo html_select($all_categories, 'category_id', 'name', 'id="filter_category" class="form-control"', 'Tất cả'); ?>
                                    </li>
                                </ul>

                                <div class="clear"></div>
                                <input type="hidden" id="filterString" value="" />
                            </div>
                        </div>
                        <!-- col-lg-12 !-->
                    </div>
                </div>
                <!-- page-wrapper !-->
            </div>
            <!-- <div class="col-md-3">
                <h3>Các sản phẩm được chọn</h3>
            </div> -->
            <!-- col-md-9 !-->
        </div>
    </div>


    <div id="mau"></div>

    <form id="data-cate_pro" action="">
        <!-- categories tu database. chỉ hiện dữ liệu để lựa chọn khi, ta chọn mẫu phù hợp. -->
        <div id="categories"></div>
        <!-- products tu database. -->
        <div id="products"></div>
    </form>

</div>
<!-- /#page-wrapper -->
</div>
<!-- /#content-wrapper -->