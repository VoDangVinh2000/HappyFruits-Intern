<div id="fruit-free-choices-modal" class="modal fade product-modal" data-backdrop="static" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background: rgba(56,56,56,0.8);">
            <button data-dismiss="modal" class="close">×</button>
            <div class="wizard-content">
                <div class="wizard-pane">
                    <div class="col-md-12">
                        <h2 style="color: white;margin-bottom: 10px;">{{selectedItem.code}} - {{ settings.language=='en'?selectedItem.english_name:selectedItem.name }}</h2>
                    </div>
                    <div class="col-md-4">
                        <div id="cupcontainer">
                            <div class="frame">
                                <img alt="cup" ng-src="{{selectedItem.image}}" />
                            </div>
                        </div>
                        <div class="free-choice-price"><span bind-translate="Giá">Giá</span>: {{selectedItem.price*1000|efruit_money}}đ</div>
                        <div ng-show="selectedStep>=2">
                            <h3 style="color: #51bd36; margin-bottom: 5px;">{{__('Khẩu vị')}}</h3>
                            <div class="col-md-12 nopadding">
                                <select style="margin-bottom: 5px;" class="form-control" ng-model="customItem.taste">
                                    <option ng-repeat="opt in tasteOptions" value="{{ $index }}">{{__(opt)}}</option>
                                </select>
                            </div>
                            <div class="col-md-12 nopadding">
                                <input type="text" class="form-control" ng-model="customItem.description" placeholder="{{__('Ghi chú khác')}}." />
                            </div>
                            <div class="clearfix"></div>
                            <div class="input-group" style="margin-top: 5px;">
                                <span class="input-group-addon">{{__('Số lượng')}} *</span>
                                <input type="text" maxlength="3" min="0" name="quantity" ng-model="customItem.numberOfItems" only-number="" class="input-sm form-control number" value="1"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div ng-show="selectedStep==1">
                            <h3 style="color: #51bd36;">{{__('Hôm nay chúng tôi có')}}</h3><br/>
                            <p><span class="badge badge-warning" ng-repeat="sub_product in selectedItem.sub_products"  ng-if="sub_product.type == null || sub_product.type == ''">{{settings.language=='en'?sub_product.english_name:sub_product.name}}</span></p>
                            <br/>
                            <button class="btn btn-success" ng-click="goSecondStep(1)"><i class="fa"></i> {{__('Chọn đầy đủ')}}</button>
                            <button class="btn btn-success" ng-click="goSecondStep(0)"><i class="fa"></i> {{__('Tự chọn 5 loại')}}</button>
                        </div>
                        <div ng-show="selectedStep==2">
                            <div ng-show="customItem.useAllFruit==0">
                                <h3 style="color: #51bd36;">{{__('Chọn trái cây')}}</h3>
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 no-margin" ng-repeat="sub_product in selectedItem.sub_products" ng-if="sub_product.type == null || sub_product.type == ''">
                                        <div class="custom-checkbox-with-tick">
                                            <input type="checkbox" ng-checked="customItem.subItems[sub_product.product_id]" id="sub2_{{sub_product.product_id}}" ng-click="addExtra(sub_product.product_id,$event)" />
                                            <label for="sub2_{{sub_product.product_id}}">{{settings.language=='en'?sub_product.english_name:sub_product.name}}</label>
                                        </div>
                                    </div>
                                </div>
                                <br />
                            </div>
                            <h3 style="color: #51bd36; margin-bottom: 5px;">{{__('Chọn topping')}} ({{__('Miễn phí 1 loại')}})</h3>
                            <div class="row">
                                <div class="col-sm-6 col-md-4 no-margin" ng-repeat="sub_product in selectedItem.sub_products" ng-if="sub_product.type == 'topping'">
                                    <div class="custom-radio-with-tick">
                                        <input type="radio" ng-checked="customItem.subItems[sub_product.product_id]" name="toppingItem" id="sub2_{{sub_product.product_id}}" ng-value="sub_product.product_id" ng-model="customItem.toppingItem" />
                                        <label for="sub2_{{sub_product.product_id}}">{{settings.language=='en'?sub_product.english_name:sub_product.name}}</label>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <h3 style="color: #51bd36; margin-bottom: 5px;">{{__('Chọn thêm thành phần (Có phí)')}}</h3>
                            <div class="row">
                                <div class="col-md-6 no-margin" ng-repeat="sub_product in selectedItem.sub_products" ng-if="sub_product.type == 'extra' || sub_product.type == 'size'">
                                    <div class="custom-checkbox-with-tick">
                                        <input type="checkbox" ng-checked="customItem.subItems[sub_product.product_id]" id="sub2_{{sub_product.product_id}}" ng-click="addExtra(sub_product.product_id,$event)" />
                                        <label for="sub2_{{sub_product.product_id}}">{{settings.language=='en'?sub_product.english_name:sub_product.name}} <span class="small">{{sub_product.price*1000|efruit_money}}<sup>đ</sup></span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div ng-show="selectedStep>=2">
                            <br />
                            <button ng-click="preSelectedStep()" class="btn btn-info wizard-prev-step-btn"><i class="fa fa-angle-left"></i> {{__('Quay lại')}}</button>
                            <button class="btn btn-success" ng-click="saveSelectedItemToCart()"><i class="fa fa-check"></i> {{editingKey?__('Cập nhật'):__('Đặt hàng')}} +{{customItem.price*customItem.numberOfItems*1000|efruit_money}}<sup>đ</sup></button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div>
<div id="fruit-box-modal" class="modal fade product-modal" data-backdrop="static" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close">×</button>
                <h3 class="y-title">{{selectedItem.code}} - {{ settings.language=='en'?selectedItem.english_name:selectedItem.name }}</h3>
            </div>
            <div class="modal-body">
                <div class="row" ng-show="selectedItem">
                    <div class="col-md-4 text-center">
                        <div class="product-image-container">
                            <img alt="{{selectedItem.code}} - {{ settings.language=='en'?selectedItem.english_name:selectedItem.name }}" ng-src="{{getImagePath(selectedItem, 'x-small')}}" class="product-image" />

                            <div ng-show="selectedItem.ribbon_left" class="half-circle-ribbon ribbon-left" ng-style="{'background-color': selectedItem.ribbon_left_color, 'box-shadow': '0 0 0 3px ' + selectedItem.ribbon_left_color}">{{selectedItem.ribbon_left}}</div>
                            <div ng-show="selectedItem.ribbon_right" class="half-circle-ribbon" ng-style="{'background-color': selectedItem.ribbon_right_color, 'box-shadow': '0 0 0 3px ' + selectedItem.ribbon_right_color}">{{selectedItem.ribbon_right}}</div>
                        </div>
                        <br/>
                        <div ng-show="selectedItem.enabled != 1"><img loading="lazy" width="80" alt="sold-out" src="<?=get_theme_assets_url()?>img/sold_out.png" class="sold_out efruit-vi"/><img loading="lazy" width="80" alt="sold-out" class="sold_out efruit-en" src="<?=get_theme_assets_url()?>img/sold_out_en.png" /></div>
                    </div>
                    <div class="col-md-8">
                        <p ng-show="selectedItem.description" ng-bind-html="(settings.language=='en' && selectedItem.description_en)?selectedItem.description_en:selectedItem.description|break_line"></p>
                        <p ng-show="selectedItem.show_components_on_frontend && selectedItem.components.length > 0">
                            <span bind-translate="Hôm nay chúng tôi có">Hôm nay chúng tôi có</span>
                            <span class="badge badge-success" style="margin-left: 5px;margin-bottom: 5px;background: none;color: #383838;padding: 5px 10px 3px;" ng-repeat="component in selectedItem.components">{{component.name}}</span>
                        </p>
                        <div ng-show="selectedItem.enabled" class="table-responsive" style="max-height: 400px; overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th bind-translate="Trái cây đang chọn">Trái cây đang chọn</th>
                                    <th style="min-width: 50px;"><span bind-translate="SL">SL</span></th>
                                    <th bind-translate="Giá">Giá</th>
                                    <th class="hidden-xs hidden-sm" bind-translate="Thành tiền">Thành tiền</th>
                                    <th style="width:50px;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="boxItem in customBoxItems">
                                    <td class="hidden-xs hidden-sm">{{boxItem.code}} - {{ settings.language=='en'?boxItem.english_name:boxItem.name }}</td>
                                    <td class="hidden-md hidden-lg">
                                        <div ng-bind-html="settings.language=='en'?boxItem.code + ' - ' + boxItem.english_name:boxItem.code + ' - ' + boxItem.name|efruit_break_line"></div>
                                    </td>
                                    <td><input type="text" class="input-sm form-control inline-block number" only-float name="quantity" min="0" maxlength="5" ng-model="boxItem.quantity" ng-blur="validateBoxQuantity(boxItem.product_id)" ng-change="onChangeBoxQuantity(boxItem.product_id)"/>&nbsp;<span>{{boxItem.unit}}</span></td>
                                    <td>{{ boxItem.price*1000|efruit_money }}<sup>đ</sup></td>
                                    <td class="hidden-xs hidden-sm">{{ boxItem.price*boxItem.quantity*1000|efruit_money }}<sup>đ</sup></td>
                                    <td><a class="btn btn-sm btn-danger" href="" ng-click="removeCustomBoxItem(boxItem.product_id)"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <th bind-translate="Tổng">Tổng</th>
                                    <td>{{ customItem.boxSubTotal*1000 | efruit_money }}<sup>đ</sup></td>
                                    <td></td>
                                </tr>
                                <tr ng-show="selectedItem.box_discount_rate">
                                    <td></td>
                                    <td></td>
                                    <th><span bind-translate="Giảm">Giảm</span> ({{ selectedItem.box_discount_rate }}%)</th>
                                    <td>{{ customItem.boxSubTotal*selectedItem.box_discount_rate/100*1000 | efruit_money }}<sup>đ</sup></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <th bind-translate="Tổng cộng">Tổng cộng</th>
                                    <td>{{ customItem.boxTotal*1000 | efruit_money }}<sup>đ</sup></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row" ng-show="selectedItem.enabled">
                            <div class="col-md-12">
                                <p ng-show="customItem.error_msg" style="color: red;">{{ customItem.error_msg }}</p>
                                <input type="text" class="form-control" ng-model="customItem.description" placeholder="{{__('Ghi chú')}}." />
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <div class="input-group" id="customItem-quanlity-container">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="numberOfItems">
                                            <span class="glyphicon glyphicon-minus"></span>
                                        </button>
                                    </span>
                                    <input type="text" name="numberOfItems" ng-model="customItem.numberOfItems" only-number="" class="form-control input-number" value="1" min="1" max="999">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="numberOfItems">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-9 col-xs-6">
                                <button class="btn btn-success" ng-disabled="customItem.error_msg" ng-click="saveSelectedItemToCart()">{{editingKey?__('Cập nhật'):__('Đặt hàng')}} +{{customItem.boxTotal*customItem.numberOfItems*1000|efruit_money}}<sup>đ</sup></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" ng-show="(itemsForBoxes | numkeys) > 0">
                    <div class="col-md-12">
                        <h3><span bind-translate="Bạn có thể thay đổi trái cây trong hộp bằng các loại dưới đây">Bạn có thể thay đổi trái cây trong hộp bằng các loại dưới đây</span>:</h3>
                    </div>
                    <div ng-repeat='item in itemsForBoxes' >
                        <div id="item-for-box-{{item.product_id}}" class="col-md-4" ng-class="{not_deliver:product.not_deliver==1}">
                            <div style="background: rgba(224,224,224,0.1);min-height: 345px;">
                                <div class="box-item-img" style="display: block;width: 100%;height: 200px;background-size: 100% auto;" ng-style="{'background-image': 'url(' + getImagePath(item) + ')'}"></div>
                                <div style="padding: 10px;">
                                    <div class="y-info">
                                        <h3 style="font-size: 18px;" class="y-title">{{item.code}} - {{ settings.language=='en'?item.english_name:item.name }}</h3>
                                        <a href="javascript:void(0);" class="y-source">{{item.price*1000|efruit_money}}<sup>đ</sup><span ng-show="item.enabled != 1" style="margin-left: 10px;"><img loading="lazy" alt="sold-out" ng-show="settings.language=='vi'" src="<?=get_theme_assets_url()?>img/sold_out.png" class="sold_out efruit-vi" style="max-width: 50px;"/><img loading="lazy" alt="sold-out" ng-show="settings.language=='en'" class="sold_out efruit-en" src="<?=get_theme_assets_url()?>img/sold_out_en.png" style="max-width: 50px;"/></span></a>
                                        <span class="label label-success ticket-label" ng-show="customBoxItems[item.product_id]"><i class="fa fa-check-circle"></i> {{__('Đã thêm')}}</span>
                                        <p style="font-size: 13px;margin-top: 5px;" ng-show="item.description" ng-bind-html="(settings.language=='en' && item.description_en)?item.description_en:item.description|break_line"></p>
                                    </div>
                                    <button ng-show="item.enabled && !customBoxItems[item.product_id]"  class="btn btn-warning btn-sm" ng-click="addCustomBoxItem(item.product_id, 1)">{{__('Thêm')}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix" ng-show="$index%3 == 2"></div>
                    </div>
                </div>
            </div>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div>
<div id="view-product-modal" class="modal fade product-modal" data-backdrop="static" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close">×</button>
                <h3 class="y-title">{{selectedItem.code}} - {{ settings.language=='en'?selectedItem.english_name:selectedItem.name }}</h3>
            </div>
            <div class="modal-body">
                <div class="row" ng-show="selectedItem">
                    <div class="col-md-4 text-center">
                        <div class="product-image-container">
                            <img alt="{{selectedItem.code}} - {{ settings.language=='en'?selectedItem.english_name:selectedItem.name }}" ng-src="{{getImagePath(selectedItem, 'x-small')}}" class="product-image" />
                            <div ng-show="selectedItem.ribbon_left" class="half-circle-ribbon ribbon-left" ng-style="{'background-color': selectedItem.ribbon_left_color, 'box-shadow': '0 0 0 3px ' + selectedItem.ribbon_right_color}">{{selectedItem.ribbon_left}}</div>
                            <div ng-show="selectedItem.ribbon_right" class="half-circle-ribbon" ng-style="{'background-color': selectedItem.ribbon_right_color, 'box-shadow': '0 0 0 3px ' + selectedItem.ribbon_right_color}">{{selectedItem.ribbon_right}}</div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <p ng-show="selectedItem.description" ng-bind-html="(settings.language=='en' && selectedItem.description_en)?selectedItem.description_en:selectedItem.description|break_line"></p>
                        <p ng-show="selectedItem.show_components_on_frontend && (selectedItem.components.length > 0 || (selectedItem.components | numkeys) > 0)">
                            <span bind-translate="Hôm nay chúng tôi có">Hôm nay chúng tôi có</span>
                            <span class="badge badge-success" style="margin-left: 5px;margin-bottom: 5px;background: none;color: #383838;padding: 5px 10px 3px;" ng-repeat="component in selectedItem.components">{{component.name}}</span>
                        </p>
                        <p class="product-price text-bold" style="font-size: 22px;" ng-show="selectedItem.promotion_price == 0 && selectedItem.price > 0"><span bind-translate="Giá">Giá</span>:&nbsp;{{selectedItem.price*1000|efruit_money}}<sup>đ</sup></p>
                        <p class="product-price text-bold" style="font-size: 22px;" ng-show="selectedItem.promotion_price != 0 && selectedItem.price > 0"><span bind-translate="Giá">Giá</span>:&nbsp;{{selectedItem.promotion_price*1000|efruit_money}}<sup>đ</sup>&nbsp;&nbsp;<span class="old-price">{{selectedItem.price*1000|efruit_money}}<sup>đ</sup></span></p>
                        <div class="row" ng-show="(selectedItem.sub_products | numkeys) > 0">
                            <h4 style="color: #51bd36; margin-bottom: 10px;font-size: 22px;" class="col-md-12" bind-translate="Tùy chọn thêm">Tùy chọn thêm</h4>
                            <div class="col-md-6 no-margin" ng-repeat="sub_product in selectedItem.sub_products">
                                <div class="custom-checkbox-with-tick">
                                    <input type="checkbox" ng-checked="customItem.subItems[sub_product.product_id]" id="sub_{{sub_product.product_id}}" ng-click="addExtra(sub_product.product_id,$event)" />
                                    <label for="sub_{{sub_product.product_id}}">{{settings.language=='en'?sub_product.english_name:sub_product.name}} <span class="small">{{sub_product.price*1000|efruit_money}}<sup>đ</sup></span></label>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="form-control" ng-model="customItem.description" placeholder="{{__('Ghi chú')}}." />
                            </div>
                        </div>
                        <div ng-show="selectedItem.enabled != 1"><img loading="lazy" width="80" alt="sold-out" src="<?=get_theme_assets_url()?>img/sold_out.png" class="sold_out efruit-vi"/><img loading="lazy" width="80" alt="sold-out" class="sold_out efruit-en" src="<?=get_theme_assets_url()?>img/sold_out_en.png" /></div>
                        <div class="row" ng-show="selectedItem.enabled">
                            <div class="col-md-3 col-xs-6">
                                <div class="input-group" id="customItem-quanlity-container">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="numberOfItems">
                                                <span class="glyphicon glyphicon-minus"></span>
                                            </button>
                                        </span>
                                    <input type="text" name="numberOfItems" ng-model="customItem.numberOfItems" only-number="" class="form-control input-number" value="1" min="1" max="999">
                                    <span class="input-group-btn">
                                            <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="numberOfItems">
                                                <span class="glyphicon glyphicon-plus"></span>
                                            </button>
                                        </span>
                                </div>
                            </div>
                            <div class="col-md-9 col-xs-6">
                                <button class="btn btn-success" ng-click="saveSelectedItemToCart()">{{editingKey?__('Cập nhật'):__('Đặt hàng')}} +{{customItem.price*customItem.numberOfItems*1000|efruit_money}}<sup>đ</sup></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div>