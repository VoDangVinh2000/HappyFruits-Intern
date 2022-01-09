    <div id="content-wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-upload fa-fw"></i> Phiếu xuất <?=$is_fruit?'trái cây':'kho'?></h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <?php
                        $msg = get_last_message();
                        if ($msg):
                    ?>
                    <div class="success col-lg-4 col-md-4"><p><?=$msg?></p></div>
                    <div class="clear"></div>
                    <?php endif;?>
                    <div id="list_container" class="table-responsive">
                        <?php $controlerObj->load_view("inventory/export/list");?>
                    </div>
                    <div class="for_datatable_filter">
                        <ul>
                            <li>Người dùng: 
                                <?php echo html_select($users, 'user_id', 'fullname', ' id="filter_member" class="form-control"', 'Tất cả'); ?>
                            </li>
                            <li>Kho: 
                                <?php echo html_select($warehouses, 'id', 'name', ' id="filter_warehouse" class="form-control"', 'Tất cả'); ?>
                            </li>
                            <li>
                                <div class="clear">&nbsp;</div>
                            </li>
                            <li>Ngày bắt đầu: 
                                <input class="form-control" style="width: 120px;" size="16" id="filter_start_date" type="text" data-date-format="dd/mm/yyyy" value="<?=date('01/m/Y')?>" readonly=""/>
                            </li>
                            <li>Ngày kết thúc: 
                                <input class="form-control" style="width: 120px;" size="16" id="filter_end_date" type="text" data-date-format="dd/mm/yyyy" value="<?=date('t/m/Y')?>" readonly=""/>
                            </li>
                            <li>
                                <a id="filter_search" class="btn btn-success"><i class="fa fa-search"></i> Tìm</a>
                            </li>
                            <li>
                                <a href="<?=BASE_URL. ($is_fruit?$URIs['inventory_export_fruits']:$URIs['inventory_export'])?>/them" class="btn btn-success"><i class="fa fa-plus"></i> Thêm phiếu xuất</a>
                            </li>
                        </ul>
                        <input type="hidden" id="current_date" value="<?=date('d/m/Y')?>" />
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