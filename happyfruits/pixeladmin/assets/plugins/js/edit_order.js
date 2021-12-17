var delivery_datetime = '';
var doneRenderFirstime = 0;
(function(){
    var is_valid = {};
    var app = angular.module('efruit', ['app.directives', 'app.filters', 'app.services']);
    app.controller('eFruitController', function($scope, myService){
        $scope.reset = function(){
            $scope.STAY_TYPE = 1;
            $scope.TAKEAWAY_TYPE = 2;
            $scope.DELIVERY_TYPE = 3;
            $scope.FOODY_TYPE = 8;

            $scope.step = 1;

            $scope.order = '';
            $scope.orderedItems = {};
            $scope.quantityInCategory = {};
            $scope.quantityOfItem = {};
            $scope.sequense = 1;
            $scope.captcha = '';
            
            $scope.subtotal = 0;
            $scope.total = 0;
            $scope.totalQuantity = 0;
            
            $scope.shipping_details = '';
            $scope.shipping_fee = 0;

            $scope.discount = 0;
            $scope.discount_rate = 0;
            $scope.discount_amount = 0;
            
            $scope.validForShipping = 0;
            $scope.description = '';
            
            $scope.is_prebook = 0;
        }
        $scope.reset();
        myService.init($scope);
        $scope.afterParseData = function(data){
            if ($.jStorage){
                var storage_customer = getStorage('customer');
                if (storage_customer){
                    $scope.customer = storage_customer;
                    storage_customer['is_remember'] = 0;
                    for(var k in $scope.customer){
                        if ($scope.customer[k]){
                            storage_customer['is_remember'] = 1;
                            break;
                        }
                    }
                }
            }
            $scope.tasteOptions = data.tasteOptions;
            if (data.customer){
                $scope.customer = data.customer;
                if (typeof data.customer.lat == 'undefined' || typeof data.customer.lng == 'undefined')
                    $scope.customer.distance = 0;
            }
                
            if (data.order){
                $scope.order = data.order;
                $scope.subtotal = data.order.subtotal;
                $scope.description = data.order.description;
                $scope.discount_amount = parseFloat(data.order.discount);
                if (data.order.promotion_code){
                    $scope.promotion_code_active = data.order.promotion_code;
                    $scope.discount_description = 'Áp dụng mã khuyến mãi';
                    $scope.strings['en'][$scope.discount_description] = 'Voucher code is applied';
                }else if ($scope.discount_amount > 0){
                    $scope.discount_description = 'Theo chương trình khuyễn mãi';
                    $scope.strings['en'][$scope.discount_description] = 'According of promotional';
                }
                $scope.discount = $scope.discount_amount/$scope.subtotal;
                $scope.discount_rate = roundNumber($scope.discount*100, 2);
                /* $scope.VAT = parseFloat(data.order.VAT); ===== 0.10 -> 0 ???? */
                if(data.order.VAT > 0){
                    if(data.order.VAT == 0.1)
                        $scope.VAT = 0.1;
                    else if(data.order.VAT == 0.05)
                        $scope.VAT = 0.05;
                    $scope.has_VAT = true;
                }
                $scope.payment_method = data.order.payment_method;
                $scope.discount_amount = parseFloat($scope.discount_amount).toFixed(3);
            }
            if (data.order_items){
                for(var i in data.order_items){
                    var item = data.order_items[i];
                    if (item.custom)
                        $scope.customItem = JSON.parse(item.custom);
                    var key = $scope.addItem(item['product_id'], formatQuantity(item['quantity']));
                    if (item.sub_items){
                        for(var j in item.sub_items){
                            var sub_item = item.sub_items[j];
                            $scope.addSubItem(key+'_'+sub_item['product_id']);
                            $scope.orderedItems[key].sub_products[sub_item['product_id']]['selected'] = 1;
                        }
                    }
                    if(item.box_items){
                        for(var k in item.box_items){
                            var box_item = item.box_items[k];
                            $scope.addBoxItem(item['product_id'], box_item);
                        }
                    }
                    $scope.orderedItems[key]['description'] = data.order_items[i].description;
                }
            }
        };
        $scope.validateDiscountRate = function(){
            $scope.updateTotal(1);
        };
        $scope.validateDiscountAmount = function(){
            $scope.updateTotal(0);
        };
        $scope.updateTotal = function(update_rate){
            if ($scope.discount_rate == '' || isNaN($scope.discount_rate)
                || $scope.discount_rate < 0 || $scope.discount_rate > 100)
                $scope.discount_rate = 0;
            if ($scope.discount_amount == '' || isNaN($scope.discount_amount)
                || $scope.discount_amount < 0 || $scope.discount_amount > parseFloat($scope.subtotal))
                $scope.discount_amount = 0;

            if (update_rate){
                $scope.discount_amount = $scope.discount_rate/100*$scope.subtotal;
            }else{
                $scope.discount_rate = $scope.discount_amount/$scope.subtotal*100;
            }
            if ($scope.order.type_id == $scope.FOODY_TYPE){
                var VAT_mount = parseFloat($scope.subtotal*$scope.VAT);
            }else{
                var VAT_mount = parseFloat($scope.subtotal - parseFloat($scope.discount_amount))*$scope.VAT;
            }

            $scope.total = parseFloat($scope.subtotal) + parseFloat($scope.shipping_fee) - parseFloat($scope.discount_amount) + VAT_mount;
            $scope.discount_amount = parseFloat($scope.discount_amount).toFixed(3);
            $scope.discount_rate = parseFloat($scope.discount_rate).toFixed(2);
            $scope.discount = $scope.discount_rate/100;
        };
        $scope.nextStep = function(){
            if ($scope.step == 2){
                pushEvent('Sửa đơn hàng', 'Lưu bước 2', ORDER_CODE);
                if (!$("#frmOrder").valid()){
                    for(var name in is_valid)
                    {
                        alert(is_valid[name]);
                        break;
                    }
                    return false;
                }
                $scope.saveOrder();
            }else{
                if ($scope.step == 1)
                    pushEvent('Sửa đơn hàng', 'Lưu bước 1', ORDER_CODE);
                $scope.step++;
                $('#change_captcha').click();
                $("#frmOrder").validate({
                    errorPlacement: function(error, element) {
                        if (!is_valid[element.attr('name')]){
                            var error_text = error.text();
                            if (element.attr('id') == 'captcha_input')
                                error_text = 'Vui lòng nhập mã bảo vệ.';
                            is_valid[element.attr('name')] = error_text;
                            element.attr('title', error_text);
                            element.tooltip();
                            element.hover(function() {changeTooltipColorTo('#ff4848')});
                        }
                    },
                    success: function(label, element) {
                        if (!$(element).hasClass('error')){
                            delete is_valid[$(element).attr('name')];
                            $(element).tooltip('destroy');
                            $(element).removeAttr('title');
                            $(element).removeAttr('data-original-title');
                        }
                    },
                    messages: {
                        mobile: {
                            minlength: "Số điện thoại phải có ít nhất 10 số"
                        },
                        email:{
                            email: "Vui lòng nhập email hợp lệ."
                        }
                    }
                });
            }
        };

        $scope.$on("doneRender",
            function() {
                $scope.bindMultiSelect();
                $(".glyphicon.glyphicon-info-sign").tooltip();
                $('.glyphicon.glyphicon-info-sign').hover(function() {changeTooltipColorTo('#6cc357')});

                if(doneRenderFirstime == 0){
                    doneRenderFirstime = 1;
                    $('#view-product-modal, #fruit-box-modal, #fruit-free-choices-modal').on('show.bs.modal', function () {
                        /* ng-model won't work when trigger event =.= */
                        //$('#customItem-quanlity-container .input-number').trigger('change');
                    });
                    $('#view-product-modal, #fruit-box-modal, #fruit-free-choices-modal').on('hidden.bs.modal', function () {
                        delete $scope.selectedItem;
                        $scope.selectedItem = '';
                        $scope.selectedStep = 1;
                        $scope.initForCustomOrder();
                        $scope.editingKey = false;
                        $scope.$apply(function (scope) {
                            scope.getTotals();
                        });
                    });
                    if ($('#datetimepicker').length){
                        delivery_datetime = $('#datetimepicker').attr('data-defaultDate');
                        $('#datetimepicker').datetimepicker({
                            sideBySide: true,
                            useCurrent: false,
                            minDate: new Date($('#datetimepicker').attr('data-minDate')*1000),
                            maxDate: new Date($('#datetimepicker').attr('data-maxDate')*1000),
                            defaultDate: new Date(delivery_datetime*1000),
                            enabledHours: typeof allowedHours != 'undefined'?allowedHours:[7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22],
                            format: 'DD/MM/YYYY HH:mm'
                        }).on("dp.change", function (e) {
                        }).on("dp.hide", function (e){
                            if(!isValidDeliveryTime(e.date.unix())){
                                alert('Thời gian giao hàng từ '+ startHour + ':' + startMinute + ' đến '+ endHour + ':' + endMinute + ' mỗi ngày. Vui lòng chọn lại.');
                            }else{
                                delivery_datetime = e.date.unix();
                                $scope.$apply(function (scope) {
                                    /* Override discount if pre-booking discount is greater than normal discount */
                                    let preorder_discount = getPreorderDiscount();
                                    if (preorder_discount && scope.discount <= discount_for_pre_book){
                                        scope.discount_rate = preorder_discount*100;
                                    }
                                    scope.updateTotal(1);
                                    scope.getTotals();
                                })
                            }
                        });
                    }
                }
            }
        );
        $scope.requestData({action: 'get_order', code: ORDER_CODE, is_local: $('#is_local').val()});
    });
})();

function formatQuantity(val){
    if (parseInt(val) == val)
        return parseInt(val);
    return val;
}

$(document).ready(function(){
    bindButtonsForNumberInput('#customItem-quanlity-container');
});