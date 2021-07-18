<?php 
    include("includes/order.inc.php");
    
    $code = get('g_code');
    $active_group = eModel::_select_one('g_booking', array('g_code' => $code));
    $error_msg = $g_item_code = '';
    if (!$active_group)
        $error_msg = 'Mã nhóm không chính xác.';
    else
        $g_item_code = md5($code.time());
        
    $title = "Đặt hàng nhóm ". ($error_msg?'':$code);
    $main_js = 'group_member';
    $extra_js = "var g_code = '".$code."'; var order_code = '".$active_group['order_code']."';";
    include("includes/header.inc.php");
?>
  <body>
    <?php include("includes/language_bar.inc.php");?>
    <div class="container-fluid" <?=$error_msg?'':'style="display: none;"'?> ng-show="step==1">
      <div class="row">
        <?php if($error_msg):?>
        <div class="col-sm-12 col-md-12 main">
            <h1 class="page-header"><a href="<?=ROOT_URL?>"><img height="40" style="float: left;" src="<?=get_child_theme_assets_url()?>img/small-logo.png"/></a>&nbsp;Đơn hàng - <?=$code?></h1>
            <h4 class="sub-header"><?=$error_msg?></h4>
        </div>
        <?php 
            else:
                include("includes/sidebar.inc.php");
        ?>
        <div class="col-sm-8 col-sm-offset-4 col-md-9 col-md-offset-3 main">
        <!--
          <a class="shipping" href="" data-toggle="modal" data-target="#myModal">Chi tiết giao hàng</a>
        -->
          <div class="hidden-sm hidden-md hidden-lg"><br /></div>
          <h1 class="page-header"><a href="<?=ROOT_URL?>"><img height="40" style="float: left;" src="<?=get_child_theme_assets_url()?>img/small-logo.png"/></a>&nbsp;Đặt hàng nhóm - <?=$code?></h1>
          <div class="ie_warning" style="display: none;">Trình duyệt IE của bạn không tương thích với website, nếu có thể vui lòng nâng cấp trình duyệt hoặc chuyển sang trình duyệt khác. Xin cảm ơn.</div>
          <input type="text" class="form-control search-control" auto ng-model="search" placeholder="Nhập từ khóa để chọn món nhanh" />
          <br />
          <div class="table-responsive">
            <table class="table table-striped" ng-show="subtotal">
              <thead>
                <tr>
                  <th class="hidden-xs hidden-sm">#</th>
                  <th>Tên món</th>
                  <th class="hidden-xs hidden-sm">Ghi chú</th>
                  <th class="hidden-xs hidden-sm">Thêm</th>
                  <th style="min-width: 50px;">SL</th>
                  <th>Giá</th>
                  <th class="hidden-xs hidden-sm">Thành tiền</th>
                  <th style="width:50px;"></th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="orderItem in orderedItems">
                  <td class="hidden-xs hidden-sm">{{ $index+1 }}</td>
                  <td class="hidden-xs hidden-sm">{{ orderItem.name }}</td>
                  <td class="hidden-xs hidden-sm"><input type="text" class="input-sm form-control" ng-model="orderItem.description" value="{{orderItem.description}}"/></td>
                  <td class="hidden-md hidden-lg">
                    <div ng-bind-html="orderItem.name|efruit_break_line"></div>
                    <div>
                        <select ng-class="{hidden:orderItem.sub_products.length == 0}" class="multiple" multiple="multiple">
                            <option ng-repeat="sub_product in orderItem.sub_products" id="{{orderItem.key + '_' + sub_product.product_id}}" ng-selected="sub_product.selected">{{sub_product.name|sub_product_name}} - {{sub_product.price}}k</option>
                        </select>
                    </div>
                  </td>
                  <td class="hidden-xs hidden-sm">
                    <select ng-class="{hidden:orderItem.sub_products.length == 0}" class="multiple" multiple="multiple">
                        <option ng-repeat="sub_product in orderItem.sub_products" id="{{orderItem.key + '_' + sub_product.product_id}}" ng-selected="sub_product.selected" >{{sub_product.name|sub_product_name}} - {{sub_product.price}}k</option>
                    </select>
                  </td>
                  <td><input type="text" class="input-sm form-control number" only-number name="quantity" min="0" maxlength="3" ng-model="orderItem.quantity" ng-blur="validateQuantity(orderItem.key)" ng-change="onChangeQuantity(orderItem.key)" /></td>
                  <td>{{ orderItem.final_price }}<span class="hidden-xs">.000<sup>đ</sup></span></td>
                  <td class="hidden-xs hidden-sm">{{ orderItem.final_price*orderItem.quantity|efruit_money }}.000<sup>đ</sup></td>
                  <td><a class="btn btn-sm btn-danger" href="" ng-click="removeItem(orderItem.key)"><i class="fa fa-trash-o"></i><span class="hidden-xs hidden-sm"> Xóa</span></a></td>
                </tr>
              </tbody>
              <tfoot>
                <tr class="total">
                  <td class="hidden-xs hidden-sm"></td>
                  <td class="hidden-xs hidden-sm"></td>
                  <td>Tổng</td>
                  <td>{{totalQuantity}}</td>
                  <td class="hidden-xs hidden-sm"></td>
                  <td colspan="2">{{subtotal|efruit_money}}.000<sup>đ</sup></td>
                </tr>
                <tr class="total">
                  <td class="hidden-xs hidden-sm"></td>
                  <td class="hidden-xs hidden-sm"></td>
                  <td>Chiết khấu<span ng-show="discount_amount"> ({{discount*100}}%)</span>&nbsp;<span style="font-size: 14px;color: #6cc357;" data-placement="right" class="hidden-xs glyphicon glyphicon-info-sign" data-original-title="{{discount_description}}"></span></td>
                  <td></td>
                  <td class="hidden-xs hidden-sm"></td>
                  <td colspan="2"><span ng-show="discount_amount">-{{discount_amount*1000|efruit_money}}</span><span ng-show="discount_amount==0">0</span><sup>đ</sup></td>
                </tr>
                <tr class="total">
                  <td class="hidden-xs hidden-sm"></td>
                  <td class="hidden-xs hidden-sm"></td>
                  <td>Tổng cộng</td>
                  <td></td>
                  <td class="hidden-xs hidden-sm"></td>
                  <td colspan="2">{{(total-shipping_fee)*1000|efruit_money}}<sup>đ</sup></td>
                </tr>
              </tfoot>
            </table>
          </div>
          <h4 ng-hide="total">Vui lòng chọn món.</h4>
          <div class="col-md-6" style="padding: 0;" ng-show="total">
            <input id="member_name" type="text" class="form-control" style="margin-bottom: 5px;" ng-model="member.name" placeholder="Tên thành viên"/>
            <textarea id="member_description" class="form-control" ng-model="member.description" placeholder="Ghi chú"></textarea><br />
            <a class="btn btn-success" href="" ng-click="nextStep()"><i class="fa fa-check"></i> Lưu</a>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>
    <?php if(!$error_msg):?>
    <div class="container-fluid" ng-show="step==2" style="display: none;">
      <div class="row">
        <div class="col-sm-12 col-md-12 main">
            <h1 class="page-header"><a href="<?=ROOT_URL?>"><img height="40" style="float: left;" src="<?=get_child_theme_assets_url()?>img/small-logo.png"/></a>&nbsp;Hoàn tất</h1>
            <p>Thông tin đặt hàng của bạn đã được lưu.
            <div class="table-responsive col-md-12" style="padding: 0;">
                <table class="table table-striped" ng-show="subtotal">
                  <thead>
                    <tr>
                      <th class="hidden-xs">Nhóm hàng</th>
                      <th>Tên món</th>
                      <th>Ghi chú</th>
                      <th>SL</th>
                      <th>Giá</th>
                      <th class="hidden-xs">Thành tiền</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="orderItem in orderedItems">
                      <td class="hidden-xs">{{ orderItem.category_name }}</td>
                      <td>
                        <div ng-bind-html="orderItem.name|efruit_break_line"></div>
                        <div class="sub_product" ng-show="orderItem.total_selected_sub">
                            <p style="margin-bottom: 0;">Thêm <span ng-repeat="sp in orderItem.selected_sub_products">{{sp.name|sub_product_name}}{{$last ? '' : ', '}}</span></p>
                        </div>
                      </td>
                      <td>{{orderItem.description}}</td>
                      <td>{{orderItem.quantity}}</td>
                      <td>{{ orderItem.final_price }}<span class="hidden-xs">.000<sup>đ</sup></span></td>
                      <td class="hidden-xs">{{ orderItem.final_price*orderItem.quantity|efruit_money }}.000<sup>đ</sup></td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr class="total">
                      <td>Tổng</td>
                      <td class="hidden-xs"></td>
                      <td>{{totalQuantity}}</td>
                      <td class="hidden-xs"></td>
                      <td>{{subtotal|efruit_money}}.000<sup>đ</sup></td>
                    </tr>
                    <tr class="total">
                      <td>Chiết khấu</td>
                      <td class="hidden-xs"></td>
                      <td></td>
                      <td class="hidden-xs"></td>
                      <td><span ng-show="discount_amount">-{{discount_amount*1000|efruit_money}}</span><span ng-show="discount_amount==0">0</span><sup>đ</sup></td>
                    </tr>
                    <tr class="total">
                      <td>Tổng cộng</td>
                      <td class="hidden-xs"></td>
                      <td></td>
                      <td class="hidden-xs"></td>
                      <td colspan="2">{{(total-shipping_fee)*1000|efruit_money}}<sup>đ</sup></td>
                    </tr>
                  </tfoot>
                </table>
                <p ng-show="member.description">Ghi chú chung: {{member.description}}</p>
            </div>
            <div class="clear"></div>
            <br/>Bạn có thể xem lại đơn hàng của cả nhóm tại <a href="<?=ROOT_URL?>nhom/<?=$code?>">đây</a>.
            <br /><a class="btn btn-info" href="" ng-click="previousStep()"><i class="fa fa-edit"></i> Sửa đặt hàng</a>
        </div>
      </div>
    </div>
    <?php include("includes/shipping_details.inc.php");?>
    <?php include("includes/loading_elements.inc.php");?>
    <?php include("includes/settings_bar.inc.php");?>
    <input type="hidden" value="<?=$g_item_code?>" id="g_item_code"/>
    <?php  include("includes/footer.php");?>
    <?php else:?>
    <?php  include("includes/footer_without_angularjs.php");?>
    <?php endif; ?>
