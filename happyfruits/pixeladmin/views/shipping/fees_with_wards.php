    <style>
        .shipping_fees_for_district ul{
            list-style: outside none none;
            padding: 0;
            width: 100%;
        }
            .shipping_fees_for_district ul li{
                display: inline-block;
            }
    </style>
    <div id="content-wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><i class="fa fa-th-list"></i> Quản lý phí giao hàng</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <p class="e-note">* Đơn vị tính ở mục này là 1000đ (vd: 100 -&gt; 100.000đ)</a></p>
                    <div id="list_container" class="table-responsive">
                        <?php $controlerObj->load_view("shipping/fees_list_with_wards");?>
                    </div>
                    <div  class="for_datatable_filter">
                        <ul>
                            <li>Loại:
                                <?php echo html_select($types, 'id', 'description', 'id="filter_type" class="form-control"');?>
                            </li>
                            <li>Quận:
                                <?=html_select_district('form-control', '-- Chọn quận', 'id="filter_district" style="width: 100%;"');?>
                            </li>
                        </ul>
                    </div>
                    <div class="shipping_fees_for_district col-md-6">
                        <h3>Phí giao hàng của quận</h3>
                        <p class="e-note">* Khi không có phường thì phí giao sẽ áp dụng theo dữ liệu của quận.</a></p>
                        <ul>
                            <li>Tổng tối thiểu:
                                <input class="form-control" id="min" type="text"/>
                            </li>
                            <li>Phí giao hàng:
                                <input class="form-control" id="fee" type="text"/>
                            </li>
                            <li>Tổng giao miễn phí:
                                <input class="form-control" id="free_ship" type="text"/>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
                <div class="clear"></div>
                <br /><br />
                <div class="col-lg-6 add_ward_form_container" style="display: none;">
                    <br class="hidden-lg" />
    				<form class="panel form-horizontal" id="add_ward_form" action="">
    					<div class="panel-heading">
    						<span class="panel-title">Thêm thông tin giao hàng cho phường</span>
    					</div>
    					<div class="panel-body">
                            <input type="text" class="form-control form-group-margin required" placeholder="Tên * (1,2,3,.. cách nhau dấu ,)" name="ward_name" id="ward_name" />
                            <input type="text" maxlength="3" class="form-control form-group-margin number required" placeholder="Tổng tối thiểu *" name="ward_min" id="ward_min" />
                            <input type="text" maxlength="2" class="form-control form-group-margin number required" placeholder="Phí giao *" name="ward_fee" id="ward_fee" />
                            <input type="text" maxlength="3" class="form-control form-group-margin number required" placeholder="Tổng giao miễn phí *" name="ward_free_ship" id="ward_free_ship" />
                            <button class="btn btn-success" id="add_ward">Thêm</button>
    					</div>
    				</form>
    			</div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#content-wrapper -->