    <div id="content-wrapper">
        <?php $controlerObj->load_view('elements/breadcrumb');?>
        <?php $controlerObj->load_view('elements/pageheader');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive" id="list_container">
                        <?php $controlerObj->load_view("product/manage/list");?>
                    </div>
                    <div class="for_datatable_filter">
                        <ul>
                            <li>Loại hàng: 
                                <?php echo html_select($item_types, 'id', 'type_name', 'id="filter_type_id" class="form-control"', 'Tất cả');?>
                            </li>
                        </ul>
                        <div class="clear"></div>
                        <input type="hidden" id="filterString" value="" />
                        <input type="hidden" id="is_fruit" value="<?=empty($is_fruit)?0:1?>" />
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