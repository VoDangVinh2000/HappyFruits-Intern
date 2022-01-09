    <div id="content-wrapper">
        <?php $controlerObj->load_view('elements/breadcrumb');?>
        <?php $controlerObj->load_view('elements/pageheader');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div id="list_container" class="table-responsive">
                        <?php $controlerObj->load_view("order/list");?>
                    </div>
                    <div class="for_datatable_filter">
                        <ul>
                            <li>Loại đơn hàng: 
                                <?php echo html_select($order_types, 'id', 'type_name', 'id="filter_type" class="form-control"', 'Tất cả');?>
                            </li>
                            <?php /*
                            <li>Loại thanh toán: 
                                <select id="filter_payment_type" class="form-control">
                                    <option value="">Tất cả</option>
                                    <option value="is_prepaid">Thanh toán trước</option>
                                </select>
                            </li> */ ?>
                            <?php if (Users::can('filter', 'order')):?>
                                <?php if(Users::can('view_all', 'order') && count($branches) > 1):?>
                            <li>Cửa hàng:
                                <?php echo html_select($branches, 'id', 'branch_name', 'id="filter_branch" class="form-control"', 'Tất cả');?>
                            </li>
                                <?php endif; ?>
                            <li>Ca: 
                                <select id="filter_shift" class="form-control">
                                    <option value="">Tất cả</option>
                                    <option value="1">Ca ngày</option>
                                    <option value="2">Ca tối</option>
                                </select>
                            </li>
                            <li>VAT:
                                <select id="filter_vat" class="form-control">
                                    <option value="">Tất cả</option>
                                    <option value="1">Có</option>
                                    <option value="0">Không</option>
                                </select>
                            </li>
                            <li><div class="clear"></div></li>
                                <?php if(Users::can('filter_all_dates', 'order')):?>
                            <li>Ngày bắt đầu: 
                                <input class="form-control" style="width: 120px;" size="16" id="filter_start_date" type="text" data-date-format="dd/mm/yyyy" value="<?=date('d/m/Y')?>" readonly=""/>
                            </li>
                            <li>Ngày kết thúc: 
                                <input class="form-control" style="width: 120px;" size="16" id="filter_end_date" type="text" data-date-format="dd/mm/yyyy" value="<?=date('d/m/Y')?>" readonly=""/>
                            </li>
                                <?php else:?>
                            <li>Ngày bắt đầu:
                                <input class="form-control" style="width: 120px;" size="16" id="filter_start_date" type="text" data-date-startdate="<?=date('d/m/Y', strtotime('-7 days'))?>" data-date-format="dd/mm/yyyy" value="<?=date('d/m/Y')?>" readonly=""/>
                            </li>
                            <li>Ngày kết thúc:
                                <input class="form-control" style="width: 120px;" size="16" id="filter_end_date" type="text" data-date-enddate="<?=date('d/m/Y', strtotime('+7 days'))?>" data-date-format="dd/mm/yyyy" value="<?=date('d/m/Y')?>" readonly=""/>
                            </li>
                                <?php endif; ?>
                            <li>
                                <a id="filter_search" class="btn btn-success"><i class="fa fa-search"></i>&nbsp;Tìm</a>
                            </li>
                            <?php endif;?>
                            <?php if (Users::can('view_summary', 'order')):?>
                            <li><div class="summary"><span>Số đơn hàng: </span><span class="number_of_records"></span></div></li>
                            <li><div class="summary"><span>Tổng: </span><span class="order_total"></span>đ</div></li>
                            <?php endif;?>
                        </ul>
                        <input type="hidden" id="current_date" value="<?=date('d/m/Y')?>" />
                        <input type="hidden" id="filterString" value="" />
                        <?php if (!Users::is_super_admin() && Users::can('filter', 'order')):?>
                            <?php if(Users::can('filter_all_dates', 'order')):?>
                                <?php if(Users::can('filter_all_dates_in_3_months', 'order')):?>
                        <input type="hidden" id="min_date" value="<?=date('d/m/Y', strtotime('-3 month'))?>" />
                                <?php else:?>
                        <input type="hidden" id="min_date" value="<?=date('d/m/Y', strtotime('-1 month'))?>" />
                                <?php endif; ?>
                            <?php else:?>
                        <input type="hidden" id="min_date" value="<?=date('d/m/Y', strtotime('-7 days'))?>" />
                            <?php endif; ?>
                        <?php endif; ?>
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