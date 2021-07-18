(function(){
    var is_valid = {};
    var app = angular.module('efruit', ['app.directives', 'app.filters', 'app.services']);
    app.controller('eFruitController', function($scope, myService){
        //params
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
            if ($.jStorage){
                var storage_customer = getStorage('customer');
                if (storage_customer){
                    $scope.customer = storage_customer;
                    $scope.customer['is_remember'] = 0;
                    for(var k in $scope.customer){
                        if ($scope.customer[k]){
                            $scope.customer['is_remember'] = 1;
                            break;
                        }
                    }
                }
            }
            $scope.$apply();
            setTimeout(function(){
                $('.container-fluid').show();
                $('.jar_loading').hide();
            }, 1000);
        }
        $scope.nextStep = function(){
            if ($scope.step == 2){
                pushEvent('Đặt hàng', 'Đặt hàng bước 2', '2');
                if (!$("#frmOrder").valid()){
                    for(var name in is_valid)
                    {
                        alert(is_valid[name]);
                        break;
                    }
                    return false;
                }
                var params = {action: 'save_order'};
                params['ids'] = {};
                params['quantity'] = {};
                var captcha_obj = $('#captcha_input');
                params[captcha_obj.attr('name')] = $scope.captcha;
                for(var i in $scope.orderedItems){
                    if ($scope.orderedItems[i])
                    {
                        if ($scope.orderedItems[i].quantity){
                            params['quantity'][i] = $scope.orderedItems[i].quantity;
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
                params['language'] = $scope.settings.language;
                //console.log(params);
                $("#loading").removeClass("hidden");
                $.post(base_url + 'postback.php', params, function(data){
                    $("#loading").addClass("hidden");
                    if (data.status == 'OK'){
                        $scope.code = data.code;
                        $scope.step++;
                        $scope.$apply();
                        pushEvent('Đặt hàng', 'Đặt hàng thành công', $scope.code);
                    }else{
                        alert(data.message);
                        pushEvent('Đặt hàng', 'Đặt hàng lỗi', data.message);
                    }
                    $('#change_captcha').click();
                },"json");
            }else{
                if ($scope.step == 1)
                    pushEvent('Đặt hàng', 'Đặt hàng bước 1', '1');
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
         $scope.requestData({action: 'get_data'});
    });
})();