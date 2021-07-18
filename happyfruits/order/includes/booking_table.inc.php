          <?php $logged_user = Users::get_logged_user(); ?>
		  <div class="table-responsive">
            <table class="table table-striped" ng-show="subtotal">
              <thead>
                <tr>
                  <th class="hidden-xs hidden-sm">#</th>
                  <th>{{__('Tên món')}}</th>
                  <?php if ($logged_user):?>
                  <th class="hidden-xs hidden-sm">Ghi chú</th>
                  <?php endif; ?>
                  <th class="hidden-xs hidden-sm">{{__('Tùy chọn')}}</th>
                  <th style="min-width: 50px;">{{__('SL')}}</th>
                  <th>{{__('Giá')}}</th>
                  <th class="hidden-xs hidden-sm">{{__('Thành tiền')}}</th>
                  <th style="width:90px;"></th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="orderItem in orderedItems">
                  <td class="hidden-xs hidden-sm">{{ $index+1 }}</td>
                  <td class="hidden-xs hidden-sm">
                      <a href="javascript:void(0);" ng-click="editOrderedItem(orderItem.key)" class="name-order">{{ orderItem.code }} - {{ settings.language!='en'?orderItem.name:orderItem.english_name }}</a>
                      <div ng-show="orderedBoxes[orderItem.product_id]" class="sub_product">
                          <span ng-repeat="(item_id, box_item) in orderedBoxes[orderItem.product_id]">{{box_item.quantity}}{{box_item.unit}} {{ settings.language=='en'?items[item_id].english_name:items[item_id].name }}{{$last ? '' : ', '}}</span>
                      </div>
                  </td>
                  <?php if ($logged_user):?>
                  <td class="hidden-xs hidden-sm"><input type="text" class="input-sm form-control" ng-model="orderItem.description" value="{{orderItem.description}}"/></td>
                  <?php endif; ?>
                  <td class="hidden-md hidden-lg">
                    <div ng-bind-html="settings.language!='en'?orderItem.name:orderItem.english_name|efruit_break_line"></div>
                    <div>
                        <div class="sub_product" ng-show="orderItem.total_selected_sub">
                            <p style="margin-bottom: 0;"><span ng-repeat="sp in orderItem.selected_sub_products">{{settings.language!='en'?sp.name:sp.english_name}}{{$last ? '' : ', '}}</span></p>
                        </div>
                    </div>
                  </td>
                  <td class="hidden-xs hidden-sm">
                      <div class="sub_product" ng-show="orderItem.total_selected_sub">
                          <p style="margin-bottom: 0;"><span ng-repeat="sp in orderItem.selected_sub_products">{{settings.language!='en'?sp.name:sp.english_name}}{{$last ? '' : ', '}}</span></p>
                      </div>
                  </td>
                  <td><input type="text" class="input-sm form-control float" only-float name="quantity" min="0" maxlength="6" ng-model="orderItem.quantity" ng-blur="validateQuantity(orderItem.key)" ng-change="onChangeQuantity(orderItem.key)" /></td>
                  <td>{{ orderItem.final_price*1000|efruit_money }}<span class="hidden-xs"><sup>đ</sup></span></td>
                  <td class="hidden-xs hidden-sm">{{ orderItem.final_price*orderItem.quantity*1000|efruit_money }}<sup>đ</sup></td>
                  <td>
                      <a class="btn btn-warning btn-sm inline-block" href="javascript:void(0);" ng-click="editOrderedItem(orderItem.key)"><i class="fa fa-pencil-square-o"></i></a>&nbsp;
                      <a class="btn btn-sm btn-danger inline-block" href="javascript:void(0);" ng-click="removeItem(orderItem.key)"><i class="fa fa-trash-o"></i></a>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr class="total">
                  <td class="hidden-xs hidden-sm"></td>
                  <td class="hidden-xs hidden-sm"></td>
                  <td>{{__('Tổng')}}</td>
                  <td>{{totalQuantity}}</td>
                  <td class="hidden-xs hidden-sm"></td>
                  <td colspan="2">{{subtotal*1000|efruit_money}}<sup>đ</sup></td>
                </tr>
                <?php if(empty($logged_user)):?>
                <tr class="total" ng-show="discount_description!=''">
                  <td class="hidden-xs hidden-sm"></td>
                  <td class="hidden-xs hidden-sm"></td>
                  <td>{{__('Chiết khấu')}}<span ng-show="discount_amount"> ({{discount_rate}}%)</span>&nbsp;<span style="font-size: 14px;color: #6cc357;" data-placement="right" class="hidden-xs glyphicon glyphicon-info-sign" data-original-title="{{__(discount_description)}}"></span></td>
                  <td></td>
                  <td class="hidden-xs hidden-sm"></td>
                  <td colspan="2"><span ng-show="discount_amount">-{{discount_amount*1000|efruit_money}}</span><span ng-show="discount_amount==0">0</span><sup>đ</sup></td>
                </tr>
                <?php else:?>
                <tr class="total">
	                <td class="hidden-xs hidden-sm"></td>
	                <td class="hidden-xs hidden-sm"></td>
	                <td>{{__('Chiết khấu')}}</td>
	                <td><input style="width: 45px;" maxlength="5" ng-model="discount_rate" ng-blur="validateDiscountRate()" ng-change="updateTotal(1)" only-float="" class="ng-pristine ng-valid" type="text">%</td>
	                <td class="hidden-xs hidden-sm"></td>
	                <td colspan="2"><input style="width: 80px;" ng-model="discount_amount" ng-blur="validateDiscountAmount()" ng-change="updateTotal(0)" only-float="" class="ng-pristine ng-valid" type="text">đ</td>
                </tr>
                <?php endif;?>
                <tr class="total">
                  <td class="hidden-xs hidden-sm"></td>
                  <td class="hidden-xs hidden-sm"></td>
                  <td>
                      <?php if($logged_user): /* Editing by staff */?>
                          VAT&nbsp;
                          <div class="custom-radio-with-tick inline">
                              <input type="radio" id="vat_10" ng-model="VAT" value="0.1" ng-click="updateTotal(0)">
                              <label style="cursor: pointer;font-weight: normal;" for="vat_10">10%</label>
                          </div>&nbsp;
                          <div class="custom-radio-with-tick inline">
                              <input type="radio" id="vat_5" ng-model="VAT" value="0.05" ng-click="updateTotal(0)">
                              <label style="cursor: pointer;font-weight: normal;" for="vat_5">5%</label>
                          </div>
                          &nbsp;
                          <div class="custom-radio-with-tick inline">
                              <input type="radio" id="vat_0" ng-model="VAT" value="0" ng-click="updateTotal(0)">
                              <label style="cursor: pointer;font-weight: normal;" for="vat_0">0%</label>
                          </div>
                      <?php else:?>
                          <div class="custom-checkbox-with-tick inline-block">
                              <input type="checkbox" autocomplete="off" ng-model="VAT" ng-checked="VAT>0" id="has_VAT" ng-true-value="0.1" ng-false-value="0" ng-click="updateTotal(0)"/><label for="has_VAT">VAT (+10%)</label>
                          </div>
                      <?php endif;?>
                  </td>
                  <td></td>
                  <td class="h1idden-xs hidden-sm"></td>
                  <td colspan="2">{{VAT*(subtotal-discount_amount)*1000|efruit_money}}<sup>đ</sup></td>
                </tr>
                <tr class="total" ng-show="validForShipping">
                  <td class="hidden-xs hidden-sm"></td>
                  <td class="hidden-xs hidden-sm"></td>
                  <td>{{__('Phí giao hàng')}} <span class="distance green-text"></span></td>
                  <td></td>
                  <td class="hidden-xs hidden-sm"></td>
                  <td colspan="2"><span ng-hide="customer.free_ship && shipping_fee > 0">{{shipping_fee*1000|efruit_money}}<sup>đ</sup></span><strike ng-show="customer.free_ship && shipping_fee > 0">{{shipping_fee*1000|efruit_money}}<sup>đ</sup></strike></td>
                </tr>
                <tr class="total">
                  <td class="hidden-xs hidden-sm"></td>
                  <td class="hidden-xs hidden-sm"></td>
                  <td>{{__('Tổng cộng')}}</td>
                  <td></td>
                  <td class="hidden-xs hidden-sm"></td>
                  <td colspan="2">{{total*1000|efruit_money}}<sup>đ</sup></td>
                </tr>
              </tfoot>
            </table>
          </div>