    <div id="content-wrapper">
        <?php $controlerObj->load_view('elements/breadcrumb');?>
        <?php $controlerObj->load_view('elements/pageheader');?>
		<div class="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div id="list_container" class="table-responsive">
                        <?php $controlerObj->load_view("salary_advance/list");?>
                    </div>
                    <div class="for_datatable_filter">
                        <ul>
                            <li>Ngày bắt đầu: 
                                <input class="form-control" style="width: 120px;" size="16" id="filter_start_date" type="text" data-date-format="dd/mm/yyyy" value="<?=date('01/m/Y')?>" readonly=""/>
                            </li>
                            <li>Ngày kết thúc: 
                                <input class="form-control" style="width: 120px;" size="16" id="filter_end_date" type="text" data-date-format="dd/mm/yyyy" value="<?=date('d/m/Y')?>" readonly=""/>
                            </li>
                            <li>
                                <a id="filter_search" class="btn btn-success"><i class="fa fa-search"></i> Tìm</a>
                            </li>
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
    </div><!-- /#content-wrapper -->
