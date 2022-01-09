    <div id="content-wrapper">
        <?php $controlerObj->load_view('elements/breadcrumb');?>
        <?php $controlerObj->load_view('elements/pageheader');?>
        <div id="page-wrapper">
            <iframe src ="<?php echo BASE_URL.'thong-ke/bieu-do'?>" id="report_charts" frameborder="0" width="100%">
                <p>Your browser does not support iframes.</p>
            </iframe>
            <div class="row">
                <div class="col-lg-12">
                    <div id="list_container" class="table-responsive">
                        <?php $controlerObj->load_view("statistics/list");?>
                    </div>
                    <div class="for_datatable_filter">
                        <ul>
                            <li>Nhóm hàng: 
                                <?php echo html_select($all_categories, 'category_id', 'name', 'id="filter_category" class="form-control"', 'Tất cả');?>
                            </li>
                            <li>Cửa hàng:
                                <?php echo html_select($branches, 'id', 'branch_name', 'id="filter_branch" class="form-control"', 'Tất cả');?>
                            </li>
                            <li>Ca: 
                                <select id="filter_shift" class="form-control">
                                    <option value="">Tất cả</option>
                                    <option value="1">Ca ngày</option>
                                    <option value="2">Ca tối</option>
                                </select>
                            </li>
                            <li><div class="clear"></div></li>
                            <li>Ngày bắt đầu: 
                                <input class="form-control" style="width: 120px;" size="16" id="filter_start_date" type="text" data-date-format="dd/mm/yyyy" value="<?=date('d/m/Y')?>" readonly=""/>
                            </li>
                            <li>Ngày kết thúc: 
                                <input class="form-control" style="width: 120px;" size="16" id="filter_end_date" type="text" data-date-format="dd/mm/yyyy" value="<?=date('d/m/Y')?>" readonly=""/>
                            </li>
                            <li>
                                <a id="filter_search" class="btn btn-success"><i class="fa fa-search"></i> Tìm</a>
                            </li>
                            <?php if (Users::can_access($view, 'view_report')):?>
                                <li><a id="export_statistic_data" class="btn btn-success"><i class="fa fa-cloud-download"></i> Xuất Excel</a></li>
                            <?php endif;?>
                        </ul>
                        <input type="hidden" id="current_date" value="<?=date('d/m/Y')?>" />
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