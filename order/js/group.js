(function(){
    var is_valid = {};
    var app = angular.module('efruit', ['app.directives', 'app.filters', 'app.services']);
    app.controller('eFruitController', function($scope, myService){
        //params
        $scope.is_group_lead = 0;
        $scope.reset = function(){
            $scope.step = 1;
            $scope.orderedItems = {};
            $scope.quantityInCategory = {};
            $scope.quantityOfItem = {};
            $scope.sequense = 1;
            $scope.captcha = '';
			$scope.code = '';				 
            
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
        }
        $scope.reset();
        myService.init($scope);
        $scope.afterParseData = function(data){
            if (data.customer)
                $scope.customer = data.customer;
            else if ($.jStorage){
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
            if (data.order){
                $scope.description = data.order.description;
            }
            if (data.order_items){
                for(var i in data.order_items){
                    var item = data.order_items[i];
                    var key = $scope.addItem(item['product_id'], item['quantity']);
                    if (item.sub_items){
                        for(var j in item.sub_items){
                            var sub_item = item.sub_items[j];
                            $scope.addSubItem(key+'_'+sub_item['product_id']);
                            $scope.orderedItems[key].sub_products[sub_item['product_id']]['selected'] = 1;
                        }
                    }
                    $scope.orderedItems[key].member_name = item.member_name;
                    $scope.orderedItems[key].description = item.member_name + (item.description?' - ' + item.description:'');
                }
            }
            if(order_code)
                $scope.code = order_code;
        }        
        $scope.nextStep = function(){
            if ($scope.step == 2){
                pushEvent('Đặt hàng nhóm', 'Lưu bước 2', g_code);
                if (!$("#frmOrder").valid()){
                    for(var name in is_valid)
                    {
                        alert(is_valid[name]);
                        break;
                    }
                    return false;
                }
                var params = {action: 'save_g_order', code: g_code};
                params['ids'] = {};
                params['quantity'] = {};
                params['descriptions'] = {};
                var captcha_obj = $('#captcha_input');
                params[captcha_obj.attr('name')] = $scope.captcha;
                for(var i in $scope.orderedItems){
                    if ($scope.orderedItems[i])
                    {
                        if ($scope.orderedItems[i].quantity){
                            params['quantity'][i] = $scope.orderedItems[i].quantity;
                            if (typeof $scope.orderedItems[i].description != 'undefined')
                                params['descriptions'][i] = $scope.orderedItems[i].description;
                            else
                                params['descriptions'][i] = '';
                            var selected_sub_product_ids = [];
                            for(var j in $scope.orderedItems[i].selected_sub_products)
                                selected_sub_product_ids.push($scope.orderedItems[i].selected_sub_products[j].product_id);
                            if (selected_sub_product_ids.length)
                                params['ids'][i] = selected_sub_product_ids;
                            else
                                params['ids'][i] = '';
                        }
                    }
                }
				$scope.save_customer_info();							
                params['customer'] = $scope.customer;
                params['description'] = $scope.description;
				params['code'] = $scope.code;
                params['g_code'] = g_code;
                params['language'] = $scope.settings.language;
                //console.log(params);
                $("#loading").removeClass("hidden");
                $.post(base_url + 'postback.php', params, function(data){
                    $("#loading").addClass("hidden");
                    if (data.status == 'OK'){
                        $scope.code = data.code;
                        $scope.step++;
                        $scope.$apply();
                        pushEvent('Đặt hàng nhóm', 'Lưu thành công', g_code);
                    }else{
                        alert(data.message);
                        pushEvent('Đặt hàng nhóm', 'Lỗi', data.message);
                    }
                    $('#change_captcha').click();
                },"json");
            }else{
                if ($scope.step == 1)
                    pushEvent('Sửa đơn hàng', 'Lưu bước 1', g_code);
                $scope.step++;
                $('#change_captcha').click();
				$('#captcha_input').val('');							
                $("#frmOrder").validate({
                    errorPlacement: function(error, element) {
                        if (!is_valid[element.attr('name')]){
                            var error_text = error.text();
                            if (element.attr('id') == 'captcha_input')
                                error_text = 'Vui lòng nhập chính xác mã bảo vệ.';
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
        if ($.jStorage){
            var md5_g_code = getStorage(g_code);
            if (md5_g_code == $('#g_code').val())
                $scope.is_group_lead = 1;
            else
                $scope.step = 0;
        }
        $scope.requestData({action: 'get_g_order', g_code: g_code});
    });
})();