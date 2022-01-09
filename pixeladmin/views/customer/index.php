    <div id="content-wrapper">
        <?php $controlerObj->load_view('elements/breadcrumb');?>
        <?php $controlerObj->load_view('elements/pageheader');?>
        <div id="page-wrapper">
            <div class="col-lg-12">
                <div class="table-responsive" id="list_container">
                    <?php $controlerObj->load_view("customer/list");?>
                </div>
                <div class="for_datatable_filter">
                    <ul>
                    <?php if(!$filter_keyword):?>
                        <li>
                            Quận: <?php echo html_select_district('form-control', 'Tất cả', 'id="filter_district" name=""', false, empty($filter_array)?'':'1');?>
                        </li>
                        <li>
                            Loại:
                            <select class="form-control" id="filter_type" name="">
                                <option value="">Tất cả</option>
                                <option value="1">eFruit</option>
                                <option value="7">Foody</option>
                            </select>
                        </li>
                        <li>
                            Sản phẩm đã mua (SP1 hoặc SP2 hoặc ..): <?=html_select_optgroup($products, 'product_id', array('code', 'name'), 'category_name', 'multiple id="filter_products" style="width: 300px;" class="form-control"', 'Tất cả');?>
                        </li>
                        <?php if (Users::can_access($view, 'view_report')):?>
                        <li><a id="export_customer" class="btn btn-success"><i class="fa fa-cloud-download"></i> Xuất Excel</a></li>
                        <?php endif;?>
                    <?php else:?>
                        <li>
                            <a id="filter_search" class="btn btn-success"><i class="fa fa-search"></i>&nbsp;Tìm</a>
                        </li>
                        <li>
                            <a id="filter_back" class="btn btn-info"><i class="fa fa-undo"></i>&nbsp;Trở lại danh sách</a>
                        </li>
                    <?php endif;?>
                    </ul>
                    <input type="hidden" id="filterString" value="<?=$filter_keyword?>" />
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#content-wrapper -->
