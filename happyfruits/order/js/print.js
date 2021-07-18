(function(){
    var currentDate = currentDate2 = null;
    var app = angular.module('efruit', ['app.directives', 'app.filters']);
    app.controller('eFruitController', function($scope){
        //params
        $scope.order = {};
        $scope.customer = {};
        $scope.discount_rate = 0.00;
        $scope.discount_amount = 0.00;
        $scope.need_to_save = 0;
        $scope.old_total = 0;
        $scope.printing_label = 0;
        $scope.VAT = 0;
        var loadOrder = function($scope) {
            var params = {action: 'get_order_details', code: code}
            $.post(base_url + 'postback.php', params, function(data){
                if (data.status == 'OK'){
                    setTimeout(function(){
                        $('.container-fluid').show();
                        $('.jar_loading').hide();
                    }, 1000);
                    
                    if (data.customer)
                        $scope.customer = data.customer;
                    if (data.order){
                        $scope.order = data.order;
                        if ($scope.order.is_locked == '1')
                            $scope.order.is_locked = 1
                        else
                            $scope.order.is_locked = 0;
                            
                        if (parseFloat($scope.order.VAT) > 0)
                            $scope.VAT = parseFloat($scope.order.VAT);
                        $scope.discount_amount = parseFloat($scope.order['discount']).toFixed(3);
                        $scope.discount_rate = parseFloat($scope.discount_amount/$scope.order['subtotal']*100).toFixed(2);
                        $scope.old_total = parseFloat($scope.order['total']);
                    }
                        
                    $scope.$apply();
                }else{
                    alert(data.message);
                }
            },"json");
        };
        loadOrder($scope);
        $scope.validateDiscountRate = function(){
        };
        $scope.validateDiscountAmount = function(){
        };
        $scope.updateTotal = function(update_rate){
            if ($scope.discount_rate == '' || isNaN($scope.discount_rate) 
                || $scope.discount_rate < 0 || $scope.discount_rate > 100)
                $scope.discount_rate = 0;
            if ($scope.discount_amount == '' || isNaN($scope.discount_amount) 
                || $scope.discount_amount < 0 || $scope.discount_amount > parseFloat($scope.order['subtotal']))
                $scope.discount_amount = 0;
            
            $scope.need_to_save = 1;
            if (update_rate){
                $scope.discount_amount = $scope.discount_rate/100*$scope.order.subtotal;
            }else{
                $scope.discount_rate = $scope.discount_amount/$scope.order.subtotal*100;
            }

            $scope.order.VAT = $scope.VAT;
            var VAT_mount = parseFloat($scope.order.subtotal - parseFloat($scope.discount_amount))*$scope.order.VAT;
            console.log($scope.VAT);
            $scope.order.total = parseFloat($scope.order.subtotal) + parseFloat($scope.order.shipping_fee) - parseFloat($scope.discount_amount) + VAT_mount;

            if ($scope.old_total == parseFloat($scope.order.total))
                $scope.need_to_save = 0;
            
            $scope.discount_amount = parseFloat($scope.discount_amount).toFixed(3);
            $scope.discount_rate = parseFloat($scope.discount_rate).toFixed(2);
        };
        $scope.setVAT = function(vat){
            $scope.order.VAT = $scope.VAT = vat;
            $scope.updateTotal(0);
        }
        $scope.saveOrder = function(){
            if ($scope.need_to_save){
                var params = {action: 'update_order_discount', code: code};
                params['discount_amount'] = $scope.discount_amount;
                params['VAT'] = parseFloat($scope.VAT);
                $("#loading").removeClass("hidden");
                $.post(base_url + 'postback.php', params, function(data){
                    $("#loading").addClass("hidden");
                    if (data.status == 'OK'){
                        $scope.$apply(function (scope) {
                            $scope.need_to_save = 0;
                            $scope.old_total = parseFloat($scope.order.total);
                        });
                    }else{
                        alert(data.message);
                    }
                },"json");
            }
        };
        $scope.lockOrder = function(){
            var params = {action: 'lock_order'};
            params['code'] = $scope.order['code'];
            $("#loading").removeClass("hidden");
            $.post(base_url + 'postback.php', params, function(data){
                $("#loading").addClass("hidden");
                if (data.status == 'OK'){
                    $scope.$apply(function (scope) {
                        $scope.order.is_locked = !$scope.order.is_locked;
                    });
                }else{
                    alert(data.message);
                }
            },"json");
        };
    });
})();

$(document).ready(function(){
    if ($('#datetimepicker').length){
        currentDate = $('#datetimepicker').attr('data-defaultDate');
        $('#datetimepicker').datetimepicker({
            sideBySide: true,
            useCurrent: false,
            minDate: new Date($('#datetimepicker').attr('data-minDate')*1000),
            maxDate: new Date($('#datetimepicker').attr('data-maxDate')*1000),
            defaultDate: new Date($('#datetimepicker').attr('data-defaultDate')*1000),
            enabledHours: [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22],
            format: 'DD/MM/YYYY HH:mm'
        }).on("dp.change", function (e) {
            
        }).on("dp.hide", function (e){
            var value = e.date.unix();
            if(value && value != currentDate)
            {
                $('#datetimepicker2').data("DateTimePicker").date(moment($('#datetimepicker').val(), e.date._f).add(-30, 'minutes').format(e.date._f));
                currentDate = value;
                var params = {action: 'update_order_delivery_date', code: code};
                params['delivery_date'] = value;
                $("#loading").removeClass("hidden");
                $.post(base_url + 'postback.php', params, function(data){
                    $("#loading").addClass("hidden");
                    alert(data.message);
                },"json");

                var pickup_time = moment($('#datetimepicker').val(), e.date._f).add(-30, 'minutes').format(e.date._f);
                var scope = angular.element($('[ng-app]')).scope();
                scope.$apply(function(){
                    scope.printing_label = 1;
                    setTimeout(function(){
                        $('.delivery_datetime').html($('#datetimepicker').val());
                        $('.pickup_time').html(pickup_time);
                        scope.printing_label = 0;
                    }, 500);
                });
            }
        });
    }
    if ($('#datetimepicker2').length){
        currentDate2 = $('#datetimepicker2').attr('data-defaultDate');
        $('#datetimepicker2').datetimepicker({
            sideBySide: true,
            useCurrent: false,
            minDate: new Date($('#datetimepicker2').attr('data-minDate')*1000),
            maxDate: new Date($('#datetimepicker2').attr('data-maxDate')*1000),
            defaultDate: new Date($('#datetimepicker2').attr('data-defaultDate')*1000),
            enabledHours: [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22],
            format: 'DD/MM/YYYY HH:mm'
        }).on("dp.change", function (e) {

        }).on("dp.hide", function (e){
            var value = e.date.unix();
            if(value && value != currentDate2)
            {
                $('#datetimepicker').data("DateTimePicker").date(moment($('#datetimepicker2').val(), e.date._f).add(30, 'minutes').format(e.date._f));
                currentDate2 = value;
                var params = {action: 'update_order_pickup_time', code: code};
                params['pickup_time'] = value;
                $("#loading").removeClass("hidden");
                $.post(base_url + 'postback.php', params, function(data){
                    $("#loading").addClass("hidden");
                    alert(data.message);
                },"json");

                var delivery_time = moment($('#datetimepicker2').val(), e.date._f).add(30, 'minutes').format(e.date._f);
                var scope = angular.element($('[ng-app]')).scope();
                scope.$apply(function(){
                    scope.printing_label = 1;
                    setTimeout(function(){
                        $('.delivery_datetime').html(delivery_time);
                        $('.pickup_time').html($('#datetimepicker2').val());
                        scope.printing_label = 0;
                    }, 500);
                });
            }
        });
    }
    $('#order_status').change(function(){
        var params = {action: 'update_order_status', code: code};
        params['status'] = $(this).val();
        $("#loading").removeClass("hidden");
        $.post(base_url + 'postback.php', params, function(data){
            $("#loading").addClass("hidden");
            alert(data.message);
        },"json");
    });

    $('.no-print').click(function(e){
        e.preventDefault();
        var order_item_id = $(this).attr('data-item-id');
        if ($(this).hasClass('btn-info')){
            $(this).removeClass('btn-info');
            $(this).addClass('btn-danger');
            $('.printing .label-item.item-'+order_item_id).addClass('no-print');
        }else{
            $(this).removeClass('btn-danger');
            $(this).addClass('btn-info');
            $('.printing .label-item.item-'+order_item_id).removeClass('no-print');
        }
    });
});