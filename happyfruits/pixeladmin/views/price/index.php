    <div id="content-wrapper">
        <?php $controlerObj->load_view('elements/breadcrumb');?>
        <?php $controlerObj->load_view('elements/pageheader');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive" id="list_container">
                        <?php $controlerObj->load_view("price/list");?>
                    </div>
                    <div class="for_datatable_filter">
                        <ul>
                            <li>Nhóm hàng: 
                                <?php echo html_select($all_categories, 'category_id', 'name', 'id="filter_category" class="form-control"', 'Tất cả', FRUIT_FREE_CHOICES_CAT_ID);?>
                            </li>
                        </ul>
                        <div class="clear"></div>
                        <input type="hidden" id="filterString" value="" />
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#content-wrapper -->