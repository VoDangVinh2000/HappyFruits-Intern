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
                        <?php $controlerObj->load_view("shipping/fees_list");?>
                    </div>
                    <div  class="for_datatable_filter">
                        <ul>
                            <li>Quận:
                                <?=html_select_district('form-control', '-- Chọn quận', 'id="filter_district" style="width: 100%;"');?>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="shipping_fees_for_district col-md-12">
                    <h3>Thêm phí giao hàng</h3>
                    <ul>
                        <li>Quận:<br/>
                            <?=html_select_district('form-control select2', '-- Chọn quận', 'id="district" multiple style="width: 300px;"');?>
                        </li>
                        <li>Tổng tối thiểu:
                            <input class="form-control number" id="min" type="text"/>
                        </li>
                        <li>Phí giao hàng:
                            <input class="form-control number" id="fee" type="text"/>
                        </li>
                        <li>
                            <button id="add_fee" type="button" class="btn btn-success"><i class="fa fa-plus"></i> <span>Thêm</span></button>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#content-wrapper -->