(function(){
    var app = angular.module('efruit', ['app.directives', 'app.filters', 'app.services']);
    app.controller('eFruitController', function($scope, myService){
        //params
        $scope.member = {
            name: '',
            description: ''
        };
        $scope.reset = function(){
            $scope.step = 1;
            $scope.orderedItems = {};
            $scope.quantityInCategory = {};
            $scope.quantityOfItem = {};
            $scope.sequense = 1;
            
            $scope.subtotal = 0;
            $scope.total = 0;
            $scope.totalQuantity = 0;
            
            $scope.discount = 0;
            $scope.discount_amount = 0;
        }
        $scope.reset();
        myService.init($scope);
        $scope.afterParseData = function(data){
            if (data.order_items){
                for(var i in data.order_items){
                    var item = data.order_items[i];
                    if ($scope.member.name == '')
                        $scope.member.name = item.member_name;
                    if ($scope.member.description == '')
                        $scope.member.description = item.member_description;
                    var key = $scope.addItem(item['product_id'], item['quantity']);
                    if(item.description)
                        $scope.orderedItems[key].description = item.description;
                    if (item.sub_items){
                        for(var j in item.sub_items){
                            var sub_item = item.sub_items[j];
                            $scope.addSubItem(key+'_'+sub_item['product_id']);
                            $scope.orderedItems[key].sub_products[sub_item['product_id']]['selected'] = 1;
                        }
                    }
                }
            }
        }
        $scope.nextStep = function(){
            if ($scope.step == 1){
                pushEvent('Đặt hàng', 'Đặt hàng nhóm bước 1', '1');
                if ($scope.member.name == '')
                {
                    $('#member_name').css('box-shadow', '0 0 2px #ff4848');
                    $('#member_name').attr('title', 'Vui lòng nhập tên');
                    $('#member_name').tooltip();
                    $('#member_name').hover(function() {changeTooltipColorTo('#ff4848')});
                    $('#member_name').change(function(){
                        var val = $.trim($(this).val());
                        if (val.length){
                            $(this).css('box-shadow', 'none');
                            $(this).tooltip('destroy');
                            $(this).removeAttr('title');
                            $(this).removeAttr('data-original-title');
                        }else{
                            $(this).css('box-shadow', '0 0 2px #ff4848');
                            $(this).attr('title', 'Vui lòng nhập tên');
                            $(this).tooltip();
                            $(this).hover(function() {changeTooltipColorTo('#ff4848')});
                        }
                    });
                    return false;
                }
                var params = {action: 'save_g_order_item'};
                params['ids'] = {};
                params['quantity'] = {};
                params['descriptions'] = {};
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
                params['member'] = $scope.member;
                params['g_code'] = window.g_code;
                params['g_item_code'] = $scope.g_item_code;
                $("#loading").removeClass("hidden");
                $.post(base_url + 'postback.php', params, function(data){
                    $("#loading").addClass("hidden");
                    if (data.status == 'OK'){
                        $scope.step++;
                        $scope.$apply();
                        pushEvent('Đặt hàng nhóm', 'Đặt hàng thành công', window.g_code);
                    }else{
                        alert(data.message);
                        pushEvent('Đặt hàng nhóm', 'Đặt hàng lỗi', data.message);
                    }
                },"json");
            }
        };
        var g_item_code = '';
        if ($.jStorage){
            g_item_code = getStorage(window.g_code);
            if (!g_item_code){
                g_item_code = $('#g_item_code').val();
                setStorage(window.g_code, g_item_code);
            }
            $scope.g_item_code = g_item_code;
        }
        $scope.requestData({action: 'get_g_order_items', g_item_code: g_item_code});
    });
})();