            <table class="order_summary">
                <tbody>
                    <tr ng-repeat="orderItem in orderedItems">
                        <td style="width: 70%;">{{settings.language!='en'?orderItem.name:orderItem.english_name}}
                            <div class="sub_product" ng-show="orderItem.total_selected_sub">
                                <p style="margin-bottom: 0;"><span ng-repeat="sp in orderItem.selected_sub_products">{{settings.language!='en'?sp.name:sp.english_name}}{{$last ? '' : ', '}}</span></p>
                            </div>
                            <div ng-show="orderedBoxes[orderItem.product_id]" class="sub_product">
                                <span ng-repeat="(item_id, box_item) in orderedBoxes[orderItem.product_id]">{{box_item.quantity}}{{box_item.unit}} {{ settings.language=='en'?items[item_id].english_name:items[item_id].name }}{{$last ? '' : ', '}}</span>
                            </div>
                        </td>
                        <td style="width: 10%;text-align: center;">{{orderItem.quantity}}</td>
                        <td style="text-align: right;">{{orderItem.final_price}}.000<sup>đ</sup></td>
                    </tr>
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr style="border-top: 1px solid #eee;">
                        <td class="bold">{{__('Số lượng')}}: </td>
                        <td style="text-align: center;">{{totalQuantity}}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="bold">{{__('Tổng')}}: </td>
                        <td colspan="2" style="text-align: right;">{{subtotal|efruit_money}}.000<sup>đ</sup></td>
                    </tr>
                    <tr ng-show="discount_amount">
                        <td class="bold">{{__('Chiết khấu')}}<span ng-show="discount_amount"> ({{discount_rate}}%)</span>: </td>
                        <td colspan="2" style="text-align: right;">-{{discount_amount*1000|efruit_money}}<sup>đ</sup></td>
                    </tr>
                    <tr ng-show="VAT > 0">
                        <td class="bold">VAT({{ VAT*100 }}%): </td>
                        <td colspan="2" style="text-align: right;">{{VAT*(subtotal-discount_amount)*1000|efruit_money}}<sup>đ</sup></td>
                    </tr>
                    <tr ng-show="validForShipping">
                        <td class="bold">{{__('Phí giao hàng')}} <span class="distance green-text"></span>: </td>
                        <td colspan="2" style="text-align: right;"><span ng-hide="customer.free_ship && shipping_fee > 0">{{shipping_fee*1000|efruit_money}}<sup>đ</sup></span><strike ng-show="customer.free_ship && shipping_fee > 0">{{shipping_fee*1000|efruit_money}}<sup>đ</sup></strike></td>
                    </tr>
                    <tr><td colspan="3">&nbsp;</td></tr>
                    <tr style="border-top: 1px solid #eee;" ng-show="validForShipping || discount_amount">
                        <td class="bold">{{__('Tổng cộng')}}: </td>
                        <td colspan="2" style="text-align: right;font-size: 20px;font-weight: bold;color: #6cc357;">{{total*1000|efruit_money}}<sup>đ</sup></td>
                    </tr>
                </tbody>
            </table>