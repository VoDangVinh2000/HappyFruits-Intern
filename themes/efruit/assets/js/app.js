var tag_id = get_parameter_from_url('tag');

(function(){
    var is_valid = {};
    var msg = '';
    var app = angular.module('efruit', ['app.directives', 'app.filters', 'app.services', 'wu.masonry']);
    var delivery_datetime = '';
    app.controller('eFruitController', function($scope, myService){
        $scope.no_more_page = {};
        $scope.is_loading = 0;
        $scope.page = {};
        $scope.items_per_page = items_per_page;
        $scope.current_tag = tag_id?tag_id:'menu';
        $scope.products = {};
        $scope.loaded_pages = [];
        $scope.your_district = "";

        myService.init($scope);

        $scope.page[$scope.current_tag] = 1;
        $scope.no_more_page[$scope.current_tag] = 0;
        $scope.products[$scope.current_tag] = products;
        $scope.loadMore = function(force) {
            if ($scope.current_tag == 'menu' || $scope.is_loading)
                return;
            if (typeof force == 'undefined' && $scope.page[$scope.current_tag] >= 3)
                return;
            if (typeof $scope.no_more_page[$scope.current_tag] == 'undefined')
                $scope.no_more_page[$scope.current_tag] = 0
            else if ($scope.no_more_page[$scope.current_tag])
                return;
            $scope.loading();
            if (typeof $scope.page[$scope.current_tag] == 'undefined')
                $scope.page[$scope.current_tag] = 0;
            if (typeof $scope.products[$scope.current_tag] == 'undefined')
                $scope.products[$scope.current_tag] = [];
            var next_page = parseInt($scope.page[$scope.current_tag]) + 1;

            var loadingObj = 'p' + $scope.current_tag + '-' + next_page;
            var loaded = 0;
            for(var i = 0; i < $scope.loaded_pages.length; i++){
                if ($scope.loaded_pages[i] == loadingObj){
                    loaded = 1;
                }
            }
            if (loaded){
                $scope.loaded();
                return;
            }else
                $scope.loaded_pages.push(loadingObj);

            var params = {action: 'load_products', page: next_page, tag_id: $scope.current_tag};
            $.post(postback_url, params, function(data_return){
                if (data_return.status == 'OK'){
                    if (data_return.products){
                        $scope.page[data_return.tag_id] = data_return.page;
                        var j = 0;
                        for(var i in data_return.products){
                            $scope.products[data_return.tag_id].push(data_return.products[i]);
                            j++;
                        }

                        if (j < $scope.items_per_page)
                            $scope.no_more_page[data_return.tag_id] = 1;
                        $scope.$apply();
                    }else{
                        $scope.no_more_page[data_return.tag_id] = 1;
                        $scope.is_loading = 0;
                        $scope.$apply();
                    }
                }else{
                    alert(data_return.message);
                }
                $scope.loaded();
                $scope.loadMore();
            },"json");
        };

        $scope.loading = function(){
            //$scope.is_loading = 1;
        };
        $scope.loaded = function(){
            if (typeof $scope.page[$scope.current_tag] == 'undefined')
                $scope.page[$scope.current_tag] = 0;
            $scope.is_loading = 0;
        };
        $scope.setTag = function(tag_id, image_url){
            if ($scope.current_tag == tag_id){
                if(tag_id != 'menu')
                    scrollToTop(parseInt($('.application-body').offset().top));
                return;
            }
            if (typeof tag_id != 'undefined'){
                $scope.current_tag = tag_id;
                setTimeout(function(){
                    if($scope.current_tag == 'menu' && $scope.layout == 0){
                        $('.menu-items').masonry({
                            itemSelector: '.y-grid-card',
                        });
                    }
                }, 1000);
            }
            if (typeof image_url != 'undefined' && image_url.length){
                $('.hero-wrapper').addClass('mutil-background');
                $('.hero-wrapper span').attr('style', "background:#fff url('"+image_url+"') no-repeat scroll center center/100%;");
            }else{
                $('.hero-wrapper').removeClass('mutil-background');
                //$('.hero-wrapper span').removeAttr('style');
            }
            scrollToTop(parseInt($('.application-body').offset().top));
            $scope.loaded();
            $scope.loadMore();
        };
        $scope.loadProductsInTag = function(){
            if ($scope.current_tag == 'menu')
                return;
            $scope.no_more_page[$scope.current_tag] = 0;
            $scope.loading();
            var params = {action: 'load_products', page: 1, tag_id: $scope.current_tag};
            $.post(postback_url, params, function(data_return){
                if (data_return.status == 'OK'){
                    if (data_return.products){
                        $scope.products = [];
                        if (typeof $scope.page[$scope.current_tag] == 'undefined')
                            $scope.page[$scope.current_tag] = 1;
                        var j = 0;
                        for(var i in data_return.products){
                            $scope.products[$scope.current_tag].push(data_return.products[i]);
                            j++;
                        }
                        if (j < $scope.items_per_page)
                            $scope.no_more_page = 1;
                        $scope.$apply();
                    }else{
                        $scope.no_more_page = 1;
                    }
                }else{
                    alert(data_return.message);
                }
                $scope.loaded();
            },"json");
        };
        $scope.showCategory = function(cat_arr){
            $scope.setTag('menu');
            if(typeof cat_arr == "undefined"){
                $('[class^=product-cat-]').removeClass('hidden');
                return;
            }
            var excl_classes = [];
            for(var i in cat_arr){
                excl_classes.push('.product-cat-' + cat_arr[i]);
            }
            if(excl_classes.length){
                var _class = excl_classes.join(',');
                $('[class^=product-cat-]').not(_class).addClass('hidden');
                $(_class).removeClass('hidden');
            }
            setTimeout(function(){
                if($scope.layout == 0){
                    $('.menu-items').masonry({
                        itemSelector: '.y-grid-card',
                    });
                }
            }, 1000);
        };
        $scope.afterParseData = function(data){
            if ($.jStorage && !$scope.isEditing){
                var storage_customer = getStorage('customer');
                if (storage_customer){
                    //$scope.customer = storage_customer;
                    $scope.customer['is_remember'] = 0;
                    for(var k in $scope.customer){
                        if (typeof storage_customer[k] != 'undefined'){
                            $scope.customer[k] = storage_customer[k];
                            $scope.customer['is_remember'] = 1;
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
                $scope.VAT = parseFloat(data.order.VAT);
                if($scope.VAT)
                    $scope.has_VAT = true;
                $scope.payment_method = data.order.payment_method;
                $scope.discount_amount = parseFloat($scope.discount_amount).toFixed(3);
            }
            if (data.order_items){
                for(var i in data.order_items){
                    var item = data.order_items[i];
                    if (item.custom)
                        $scope.customItem = JSON.parse(item.custom);
                    var key = $scope.addItem(item.product_id, formatQuantity(item.quantity));
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
                    $scope.orderedItems[key]['description'] = item.description;
                }
            }
            $scope.getTotals();
            //$scope.$apply();
        };
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
                $scope.saveOrder();
            }else{
                $scope.showPopupStep2();
            }
        };
        $scope.showPopupStep2 = function(){
            $scope.step = 2;
            frmOrderValidator = $("#frmOrder").validate({
                messages: {
                    mobile: {
                        minlength: $scope.__("Vui lòng nhập ít nhất {0} số")
                    },
                    email:{
                        email: $scope.__("Vui lòng nhập email hợp lệ")
                    },
                    company_tax_code:{
                        minlength: $scope.__("Vui lòng nhập ít nhất {0} số")
                    },
                    required: $scope.__("Vui lòng nhập thông tin hợp lệ")
                }
            });

            var window_width = $(window).width();
            if (window_width < 380 ){
                $('.wizard-steps li').eq(0).css('margin-left', -$('.wizard-steps li').eq(0).outerWidth() + 'px');
            }
        };
        $scope.bookNewOrder = function(){
            if(typeof ORDER_CODE != 'undefined'){
                window.location.href = base_url;
            }else{
                $('#ui-wizard-modal').modal('hide');
                $scope.reset();
            }
        };

        $scope.setPreBookDate = function(){
            $scope.delivery_datetime = delivery_datetime;
            $scope.discount_description = 'Ưu đãi khi đặt trước';
            $scope.strings['en'][$scope.discount_description] = 'Discount when pre-ordering';
            $('#modal-pre-booking').modal('hide');
            if ($('#categories').length)
                scrollToTop(parseInt($('#categories').offset().top) - 120);
            $scope.getTotals();
            /*
            if (is_home == 1)
                $scope.setTag('menu');
            else{
                window.location.href = base_url + 'vi/?tag=menu';
            }
            */
        };

        $scope.generateRibbonBackground = function(color){
            if(color == null)
                return '';
            return 'linear-gradient('+ color +' 0%, '+ lightenDarkenColor(color, 20) +' 100%)';
        };

        $scope.clearPreBookDate = function(){
            $scope.delivery_datetime = '';
            if ($scope.discount_details){
                $scope.discount_description = $scope.discount_details.description;
                $scope.strings['en'][$scope.discount_description] = $scope.discount_details.en_description;
            }else{
                $scope.discount_description = '';
                $scope.strings['en'][$scope.discount_description] = '';
            }

            $('#modal-pre-booking').modal('hide');
            $scope.getTotals();
        };

        $scope.onReady = function ($element, $attributes){
            if ($element.hasClass('y-grid-card') && $element.hasClass('compact')){
                $element.unbind('hover');
                $element.unbind('click');
                var windowWidth = $(window).width();
                if (windowWidth >= 768){
                    $element.hover(function(){
                        $(this).find(".y-ingredients").css({maxHeight:"400px"});
                    },function(){
                        $(this).find(".y-ingredients").css({maxHeight:"0px"})
                    });
                }else{
                    $element.click(function(){
                        if ($(this).find(".y-ingredients").html().length == 0)
                            return;
                        if ($(this).hasClass('open')){
                            $(this).removeClass('open');
                            $(this).find(".y-ingredients").css({maxHeight:"0px"})
                        }else{
                            $(this).addClass('open');
                            $(this).find(".y-ingredients").css({maxHeight:"400px"});
                        }
                    });
                }
            }else if($element.is($('body'))){
                $scope.switchLanguage($scope.settings['language']);
                $('.efruitjs').removeClass('efruitjs');
                $('.search-more').removeClass('hidden');
                $scope.loaded();

                $('#ui-wizard-modal').on('hidden.bs.modal', function () {
                    if ($scope.step == 3)
                    {
                        $scope.reset();
                        $scope.$apply();
                    }
                    //$scope.step = 1;
                    $('.datetimepicker2').each(function(){
                        $(this).data("DateTimePicker").hide();
                    });
                });

                $('#ui-wizard-modal').on('show.bs.modal', function () {
                    $scope.bindMultiSelect();
                    if ($scope.delivery_datetime != ''){
                        var d = moment($scope.delivery_datetime*1000);
                        $('span.delivery_datetime').html(' - ' + $scope.__('Thời gian giao') + ' ' + d.format('HH:mm dddd DD/MM'));
                        $('.datetimepicker2').show();
                        if ($scope.delivery_datetime != ''){
                            $('.datetimepicker2').each(function(){
                                $(this).data("DateTimePicker").locale($scope.settings.language == 'vi'?'vn':'en');
                                $(this).data("DateTimePicker").date(new moment($scope.delivery_datetime*1000));
                            });
                        }
                    }else{
                        $('span.delivery_datetime').html('');
                        $('.datetimepicker2').hide();
                    }
                });
                $('#view-product-modal, #fruit-box-modal, #fruit-free-choices-modal').on('show.bs.modal', function () {
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

                $('#modal-pre-booking').on('hidden.bs.modal', function () {
                    $('html').removeClass('no-overflow');
                });
                $('#modal-pre-booking').on('shown.bs.modal', function() {
                    $('html').removeClass('no-overflow');
                    $('#datetimepicker').data("DateTimePicker").locale($scope.settings.language == 'vi'?'vn':'en');
                    if ($scope.delivery_datetime != ''){
                        $('#datetimepicker').data("DateTimePicker").date(new moment($scope.delivery_datetime*1000));
                    }
                });
                if ($scope.delivery_datetime != ''){
                    if (isValidDeliveryTime($scope.delivery_datetime)){
                        delivery_datetime = $scope.delivery_datetime;
                        $scope.discount_description = 'Ưu đãi khi đặt trước';
                        $scope.strings['en'][$scope.discount_description] = 'Discount when pre-ordering';
                        $('#setPreBookDate').removeAttr('disabled');
                    }else{
                        $scope.delivery_datetime = '';
                        delivery_datetime = $('#datetimepicker').attr('data-defaultDate');
                    }
                }else{
                    delivery_datetime = $('#datetimepicker').attr('data-defaultDate');
                }
                $('#datetimepicker').datetimepicker({
                    showClose: true,
                    icons: {
                        close: 'closeText'
                    },
                    toolbarPlacement: 'bottom',
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
                        $('#setPreBookDate').attr('disabled', true);
                        showAlertError($scope.printf($scope.__('Thời gian giao hàng từ %02d:%02d đến %02d:%02d mỗi ngày. Vui lòng chọn lại.'), startHour, startMinute, endHour, endMinute));
                        $('.datetimepicker2').each(function(){
                            $(this).data("DateTimePicker").date(new moment(delivery_datetime*1000));
                        });
                    }else{
                        delivery_datetime = e.date.unix();
                        $('#setPreBookDate').removeAttr('disabled');
                    }
                });
                $('.datetimepicker2').each(function(){
                    $(this).datetimepicker({
                        showClose: true,
                        icons: {
                            close: 'closeText'
                        },
                        toolbarPlacement: 'bottom',
                        sideBySide: true,
                        useCurrent: false,
                        minDate: new Date($('.datetimepicker2').eq(0).attr('data-minDate')*1000),
                        maxDate: new Date($('.datetimepicker2').eq(0).attr('data-maxDate')*1000),
                        defaultDate: new Date(delivery_datetime*1000),
                        enabledHours: typeof allowedHours != 'undefined'?allowedHours:[7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22],
                        format: 'DD/MM/YYYY HH:mm'
                    }).on("dp.change", function (e) {
                    }).on("dp.show", function (e){
                        $(this).find('.input-group-addon span').html('OK');
                    }).on("dp.hide", function (e){
                        $(this).find('.input-group-addon span').html($scope.__('Thay đổi'));
                        if(!isValidDeliveryTime(e.date.unix())){
                            showAlertError($scope.printf($scope.__('Thời gian giao hàng từ %02d:%02d đến %02d:%02d mỗi ngày. Vui lòng chọn lại.'), startHour, startMinute, endHour, endMinute));
                            $('.datetimepicker2').data("DateTimePicker").date(new moment(delivery_datetime*1000));
                        }else{
                            $scope.delivery_datetime = delivery_datetime = e.date.unix();
                            var d = moment(delivery_datetime*1000);
                            $('span.delivery_datetime').html(' - ' + $scope.__('Thời gian giao') + ' ' + d.format('HH:mm dddd DD/MM'));
                            $scope.$apply(function (scope) {
                                scope.getTotals();
                            });
                        }
                    });
                })

                $(".glyphicon.glyphicon-info-sign").tooltip();
                $('.glyphicon.glyphicon-info-sign').hover(function() {changeTooltipColorTo('#6cc357')});


                $('.nav-categories li.picto, .nav-mobile-dropdown > li, .link-to-category > a[class]').click(function(){
                    var cat = $(this).attr('class').replace('picto', '').replace(' ','');
                    $('.nav-sidebar li.cat-'+cat).find('a').click();
                    $scope.setTag('menu');
                    $scope.$apply();
                    if (!$(this).hasClass('picto'))
                        $('.mobile-nav a.menu-bar').click();
                });

                $(window).unload(function() {
                    if ($scope.step == 3)
                    {
                        $scope.reset();
                    }
                    if ($.jStorage && !$scope.isEditing){
                        setStorage('orderedItems', $scope.orderedItems);
                        setStorage('orderedBoxes', $scope.orderedBoxes);
                        setStorage('quantityInCategory', $scope.quantityInCategory);
                        setStorage('quantityOfItem', $scope.quantityOfItem);
                        setStorage('deliveryDate', $scope.delivery_datetime);
                        $scope.save_customer_info();
                    }

                });
                /*
                if ($('body.views-home').length)
                    $scope.loadMore();
                else
                    $scope.loaded();
                */
                $scope.loaded();

                if (typeof onAngularLoaded == 'function')
                    onAngularLoaded();
            }
        };

        var request_params = {action: 'get_data'};
        if(typeof ORDER_CODE != 'undefined'){
            $scope.code = ORDER_CODE;
            request_params = {action: 'get_order', code: ORDER_CODE};
        }else{

        }
        $scope.requestData(request_params);
        if (tag_id)
            $scope.setTag(tag_id);
    });
})();

$(document).ready(function(){
    $('#info-email').attr('href', 'mailto:info@' + getDomain());
    $('#info-email').html('info@' + getDomain());
    $('#cskh-email').attr('href', 'mailto:cskh@' + getDomain());
    $('#cskh-email').html('cskh@' + getDomain());
    if($("#sliderSp-list").length){
        $("#sliderSp-list").addClass('owl-carousel owl-theme');
        $("#sliderSp-list").owlCarousel({
            autoplay: true,
            autoplaySpeed: 4000,
            dotsSpeed: 1500,
            navSpeed: 1500,
            loop: true,
            dots: false,
            nav: true,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            items: 1
        });
    }
    bindButtonsForNumberInput('#customItem-quanlity-container');
});

