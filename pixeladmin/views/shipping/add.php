<script>
    var customers = {};
    <?php if(!empty($customers)): ?>
    <?php foreach ($customers as $item):
    $customer_name = $item['customer_name'];
    $address = $item['address'];
    $district = $item['district'];
    $distance = $item['distance'];
    $lat = $item['lat'];
    $lng = $item['lng'];;
    $shipping_info = json_decode($item['shipping_info']);
    if ($shipping_info)
    {
        $lat = getValue($shipping_info, 'lat', '');
        $lng = getValue($shipping_info, 'lng', '');
        if ($shipping_info->address != $address)
        {
            $address = $shipping_info->address;
            $distance = getValue($shipping_info, 'distance', '');
        }
        if ($shipping_info->district != $district)
        {
            $district = $shipping_info->district;
            $distance = getValue($shipping_info, 'distance', '');
        }
        if ($shipping_info->fullname != $customer_name)
            $customer_name = $shipping_info->fullname;
    }
    ?>
    customers['<?=$item['order_id']?>'] = {
        mobile: "<?php echo $item['mobile'];?>",
        address: "<?php echo $address;?>",
        district: "<?php echo $district;?>",
        customer_name: "<?php echo $customer_name;?>",
        customer_id: "<?php echo $item['customer_id'];?>",
        distance: "<?php echo $distance;?>",
        lat: "<?php echo $lat;?>",
        lng: "<?php echo $lng;?>",
        type_id: "<?php echo $item['type_id'];?>",
        is_locked: "<?php echo $item['is_locked'];?>",
        number_of_dishes: "<?php echo $item['quantity'];?>",
        total: "<?php echo $item['total'];?>",
        branch_id: "<?php echo $item['branch_id'];?>"
    }
    <?php endforeach; ?>
    <?php endif;?>
</script>
<div id="content-wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header"><i class="fa fa-plus"></i> Thêm thông tin giao hàng</h2>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <form id="frmShippingDetails" data-toggle="validator" class="one-line" role="form" method="post" action="<?=BASE_URL?>xu-ly">
                    <div class="form-group">
                        <label for="date_time" class="control-label">Ngày *</label>
                        <input class="form-control" size="16" id="date_time" name="date_time" type="text" data-date-format="dd/mm/yyyy" data-date-startdate="<?=Users::is_super_admin()?date('d/m/Y', strtotime('-1 month')):date('d/m/Y', strtotime('-7 days'))?>" data-date-enddate="<?=date('d/m/Y')?>" value="<?=date('d/m/Y')?>" readonly=""/>
                        <div class="help-block with-errors"></div>
                    </div>
                    <?php if (Users::can_access($view, 'add_new_for_member')):?>
                        <div class="form-group">
                            <label for="user_id" class="control-label">Nhân viên *</label>
                            <?php echo html_select($members, 'user_id', 'fullname', ' id="user_id" name="user_id" class="form-control" required="" data-error="Vui lòng chọn nhân viên"', '--Chọn'); ?>
                            <div class="help-block with-errors"></div>
                        </div>
                    <?php else:?>
                        <div class="form-group">
                            <label class="control-label">Nhân viên</label>
                            <input class="form-control" size="16" value="<?=$logged_user['fullname']?>" readonly=""/>
                            <input type="hidden" value="<?=$logged_user['user_id']?>" name="user_id"/>
                            <div class="help-block with-errors"></div>
                        </div>
                    <?php endif;?>
                    <div class="form-group">
                        <label for="mobile" class="control-label">Số điện thoại *</label>
                        <select name="mobile" id="mobile" data-placeholder="Chọn SĐT khách hàng" class="form-control">
                            <option value=""></option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="customer" class="control-label">Tên khách hàng</label>
                        <input type="text" class="form-control" id="customer" name="customer" placeholder="Tên khách hàng" />
                    </div>
                    <div class="form-group">
                        <label for="district" class="control-label">Quận *</label>
                        <?php echo html_select_district('form-control', '--Chọn', 'required="" data-error="Vui lòng chọn quận"');?>
                        <div class="help-block with-errors"></div>
                        <input type="hidden" id="h_district" name="h_district" value="" />
                    </div>
                    <div class="form-group">
                        <label for="address" class="control-label">Địa chỉ *</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ" required="" data-error="Vui lòng nhập địa chỉ" />
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="type_id" class="control-label">Nguồn *</label>
                        <?php echo html_select($customer_types, 'type_id', 'long_name', 'name="customer_type_id" required="" class="form-control" id="customer_type_id"');?>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="branch_id" class="control-label">Từ cửa hàng *</label>
                        <?php echo html_select($branches, 'id', 'branch_name', 'id="branch_id" name="branch_id" class="form-control" required=""', null);?>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="distance" class="control-label">Khoảng cách (km) *</label>
                        <input type="text" class="form-control float" id="distance" name="distance" placeholder="Khoảng cách" required="" data-error="Vui lòng nhập khoảng cách" maxlength="6" />
                        <div class="help-block with-errors"></div>
                    </div>
                    <p><b>Ghi chú:</b> Nhập số phần là 1 để được tính phí ship theo giá trị hộp/giỏ quà.</p>
                    <div class="form-group">
                        <label for="number_of_dishes" class="control-label">Số phần *</label>
                        <input type="text" class="form-control number" id="number_of_dishes" name="number_of_dishes" placeholder="Số phần" required="" data-error="Vui lòng nhập số phần" maxlength="3" />
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="total" class="control-label">Tổng hóa đơn *</label>
                        <input type="text" class="form-control number normal inline" id="total" name="total" placeholder="Tổng hóa đơn" required="" data-error="Vui lòng nhập tổng hóa đơn" maxlength="5" /><span class="form-currency" style="float: left;margin-top:7px;">.000đ</span>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="description">Ghi chú</label>
                        <textarea class="form-control" id="description" name="description" rows="2" cols="30"></textarea>
                    </div>
                    <div class="form-group">
                        <button id="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <span>Lưu</span></button>
                        <a href="<?=BASE_URL. $URIs['shipping_details']?>" class="btn btn-info"><i class="fa fa-reply"></i> Quay lại danh sách</a>
                        <input type="hidden" name="action" value="create_shipping_record"/>
                        <input type="hidden" name="customer_id" id="customer_id" value=""/>
                        <input type="hidden" name="order_id" id="order_id" value=""/>
                        <input type="hidden" name="lat" id="lat" value="<?=DEFAULT_LAT?>"/>
                        <input type="hidden" name="lng" id="lng" value="<?=DEFAULT_LNG?>"/>
                        <input type="hidden" id="index" value=""/>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 col-md-6" id="distance_calculator">
                <p class="header" style="padding-bottom: 10px;">Kéo dấu đỏ để chọn lại vị trí khách hàng <span class="distance"></span></p>
                <select id="route_selector" style="position: absolute; top: 0px; right: 20px;max-width: 250px;padding: 5px 0;display: none;">
                    <option value="">Chọn đường đi</option>
                </select>
                <div id="map_canvas" style="height: 450px;"></div><br />
                <a id="get_distance" class="btn btn-warning" href="">Tính khoảng cách</a>
                <a id="view_map" style="display: none;" target="_blank" class="btn btn-info"  href="">Chuyển sang Google map</a>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#content-wrapper -->