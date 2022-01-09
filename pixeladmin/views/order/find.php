    <div id="content-wrapper">
        <?php $controlerObj->load_view('elements/breadcrumb');?>
        <?php $controlerObj->load_view('elements/pageheader');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div id="list_container" class="table-responsive">
                        <?php $controlerObj->load_view("order/find_list");?>
                    </div>
                    <div class="for_datatable_filter">
                        <ul>
                            <li><div class="summary"><span>Số đơn hàng: </span><span class="number_of_records"></span></div></li>
                            <li><div class="summary"><span>Tổng: </span><span class="order_total"></span>đ</div></li>
                        </ul>
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