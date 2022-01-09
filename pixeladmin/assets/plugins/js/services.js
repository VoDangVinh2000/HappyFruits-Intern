(function(){
    angular.module('app.services', [])
        .service('myService', function() {
            this.scope = '';
            this.init = function($scope){
                this.scope = $scope;
                $scope.SHIPPING_MULTIPLIER = 5;
                $scope.shipping_table = {};
                $scope.discount_table = {};
                $scope.items = {};
                $scope.itemsForAutocomplete = [];
                $scope.itemsForAutocompleteEn = [];
                $scope.customer = {
                    fullname: '',
                    mobile: '',
                    email: '',
                    address: '',
                    district: '',
                    distance: 0,
                    free_ship: 0,
                    lat: '',
                    lng: ''
                };
                $scope.discount_description = '';
                $scope.promotion_code_active = 0;
                $scope.VAT = 0;
                $scope.show_settings = 0;
                $scope.settings = {
                    hideSoldOut: 0,
                    language: 'vn'
                };
                $scope.strings = {
                    'en' : {
                        'Trái cây eFruit': 'eFruit',
                        'Đặt hàng': 'Place order',
                        'Nhấn chuột vào menu để chọn món': 'You can order items in the menu on the left',
                        'Trình duyệt IE của bạn không tương thích với website, nếu có thể vui lòng nâng cấp trình duyệt hoặc chuyển sang trình duyệt khác. Xin cảm ơn.': 'IE is not compatible with our website, if possible, please upgrade your browser or switch to another browser. Thank you.',
                        'Nhập từ khóa để chọn món nhanh': 'Enter keywords for quick search',
                        'Đơn hàng': 'Your Order',
                        'Vui lòng chọn món.': 'Your cart is empty.',
                        'Ghi chú khi pha chế': 'Notes for ordered items, e.g. sweet, no sugar, ..',
                        'Tên món': 'Name',
                        'Tùy chọn': 'Options',
                        'SL': 'Qty',
                        'Giá': 'Price',
                        'Thành tiền': 'Total amount',
                        'Xóa': 'Del',
                        'Tổng': 'Subtotal',
                        'Chiết khấu': 'Discount',
                        'Tổng cộng': 'Total',
                        'Thêm2': 'With',
                        'Thêm ': 'With ',
                        'loại': 'kinds',
                        'Chọn': 'Select',
                        'Số lượng': 'Quantity',
                        'Phí giao hàng': 'Shipping fee',
                        'Thông tin giao hàng': 'Shipping details',
                        'Tổng đơn hàng thấp nhất để giao hàng ở địa chỉ của bạn là': 'The minimum total for shipping to your location is',
                        'Tổng đơn hàng thấp nhất có thể phục vụ ở': 'The minimum total for',
                        'Tổng đơn hàng thấp nhất để giao hàng với khoảng cách': 'The minimum total for shipping in distance',
                        'là': 'is',
                        'Vui lòng đặt hàng thêm': 'Please order more',
                        'Họ tên': 'Fullname',
                        'Số điện thoại': 'Mobile number',
                        'Địa chỉ': 'Address',
                        'Quận': 'District',
                        'quận': 'district',
                        'Quận Gò Vấp': 'Go Vap district',
                        'Huyện Bình Chánh': 'Binh Chanh district',
                        'Quận Bình Thạnh': 'Binh Thanh district',
                        'Quận Tân Bình': 'Tan Binh district',
                        'Quận Tân Phú': 'Tan Phu district',
                        'Quận Bình Tân': 'Binh Tan district',
                        'Quận Phú Nhuận': 'Phu Nhuan district',
                        'Phường': 'Ward',
                        'phường': 'ward',
                        'Ghi chú khi giao hàng': 'Notes when shipping',
                        'Ghi nhớ thông tin': 'Remember me',
                        'Thông tin giao hàng sẽ được lưu lại trên trình duyệt, bạn không phải nhập lại vào lần đặt hàng sau.': 'Delivery information will be stored on your browser, you will not have to enter again in future.',
                        'Đổi mã bảo vệ.': 'Change captcha',
                        'Mã bảo vệ': 'Captcha',
                        'Quay lại': 'Back',
                        'Quý khách vui lòng nhập đủ thông tin và chính xác để hệ thống lưu vào chương trình tích điểm, xin cảm ơn.': 'Please enter accurate information, eFruit will use it for the point accumulation. Thank you.',
                        'Quý khách vui lòng nhập đủ thông tin và vị trí giao hàng chính xác, xin cảm ơn.': 'Please enter accurate information and location. Thank you.',
                        'Hoàn tất': 'Order placed successfully',
                        'Mã đơn hàng của bạn là:': 'Your order code is:',
                        'Bạn có thể xem lại đơn hàng tại': 'You can review your order at',
                        'Vui lòng gọi điện thoại đến eFruit (0938.70.70.15 hoặc 0906.70.70.15) để được phục vụ nhanh nhất': 'Please call to eFruit (0938.70.70.15 or 0906.70.70.15) for the fatest service',
                        'Đặt hàng mới': 'New Order',
                        'Sửa đơn hàng': 'Edit this order',
                        'Ngày lập': 'Created date',
                        'Ngày cập nhật': 'Updated date',
                        'Đổi món': 'Edit order',
                        'Mã đơn hàng không chính xác.': 'Your order code is invalid.',
                        'Dữ liệu bị lỗi. Vui lòng liên hệ eFruit.': 'Data error. Please contact to eFruit. Sorry for the inconvenience.',
                        'Tên khách hàng': 'Name',
                        'Số điện thoại': 'Mobile number',
                        'Địa chỉ': 'Address',
                        'Khu vực': 'Area',
                        'Thời gian giao hàng': 'Delivery Time',
                        'Nhóm hàng': 'Category',
                        'Đơn hàng đã được giao.': 'Your order is delivered.',
                        'Đơn hàng đã khóa. Vui lòng liên hệ eFruit (0938.70.70.15 hoặc 0906.70.70.15)': 'Your order is locked. Please contact to eFruit (0938.70.70.15 or 0906.70.70.15)',
                        'Sửa đơn hàng': 'Edit order',
                        'Lưu': 'Save changes',
                        'Đơn hàng của bạn đã được sửa.': 'Your changes has been stored.',
                        'Cài đặt': 'Settings',
                        'Hiển thị món tạm hết': 'Show the sold-out items',
                        'Ẩn': 'No',
                        'Hiện': 'Yes',
                        'Hiện cửa hàng đã tạm nghỉ.': 'We are closed.',
                        'Giờ mở cửa:': 'Opening hours:',
                        '9h - 22h (Thứ 2 - Thứ 7)': '9h - 22h (Monday - Saturday)',
                        '12h - 22h (Chủ nhật)': '12h - 22h (Sunday)',
                        'Quý khách có nhu cầu đặt online vui lòng ghi chú giờ hẹn giao đến.': 'Please specify the shipping time when you book online.',
                        'Chúng tôi sẽ kiểm tra và liên lạc sớm nhất.': 'We will check the order and contact you ASAP.',
                        'Chân thành cảm ơn.': 'Thank you very much.',
                        'Giờ giao': 'Delivery time',
                        'Kéo dấu đỏ để chọn lại vị trí của bạn': 'Drag the red mark to correct your location',
                        'Tìm': 'Find',
                        'Giờ giao hàng không phù hợp. Vui lòng chọn lại.': 'Your delivery time is not valid with our policy. Please change the time.',
                        'Xem đường đi': 'View on map',
                        'Khoảng cách': 'Distance',
                        'Giao miễn phí từ': 'Free ship from',
                        'KM': 'DIS',
                        'Bạn có mã giảm giá?': 'Have voucher code?',
                        'Áp dụng': 'Apply',
                        'Nhập mã khuyến mãi': 'Enter voucher here',
                        'Mã không hợp lệ': 'Invalid voucher code',
                        'Mã khuyến mãi không chính xác.': 'Your voucher code is not correct.',
                        'Mã khuyến mãi của bạn chưa tới thời gian áp dụng.': 'It is early to use this code.',
                        'Mã khuyến mãi của bạn đã hết thời hạn sử dụng.': 'Your voucher code is expired.',
                        'Mã khuyến mãi đã được sử dụng cho SĐT này.': 'The voucher code is already used with your mobile number.',
                        'Mã khuyến mãi áp dụng thành công.': 'Your voucher code is applied successfully.',
                        'Áp dụng mã KM': 'Voucher is applied',
                        'Thời gian giao hàng từ 8h30 đến 21h mỗi ngày. Vui lòng chọn lại.': 'Shipping time is from 8h30 to 21h. Please choose delivery date again.',
                        'Tòa nhà': 'Building',
                        'Mệnh giá thanh toán': 'Pay with (e.g. 500,000)'
                    }
                };
                if ($.jStorage){
                    var settings = $.jStorage.get('efruit_settings');
                    if (settings){
                        for(var s in settings){
                            $scope.settings[s] = settings[s];
                        }
                    }
                }
                
                $scope.requestData = function(params){
                    var latest_update_dtm = {'product_price_for_delivery': '-1', 'shipping_fees': '-1'};
                    if ($.jStorage){
                        var v = $.jStorage.get('efruit_version');
                        if (v == window.version){
                            dtm = $.jStorage.get('latest_update_dtm_for_delivery');
                            if (dtm){
                                for(var i in dtm){
                                    if (dtm[i])
                                        latest_update_dtm[i] = dtm[i];
                                }
                            }
                        }else
                            $.jStorage.set('efruit_version', window.version);
                    }
                    params['latest_update_dtm'] = latest_update_dtm;
                    $.post(base_url + 'postback.php', params, function(data_return){
                        if (data_return.status == 'OK'){
                            if ($.jStorage){
                                if (typeof data_return.need_to_update.product_price_for_delivery != 'undefined'){
                                    if (latest_update_dtm['product_price_for_delivery'] != '-1'){
                                        $scope.items = $.jStorage.get('product_price_for_delivery_data');
                                        if($scope.items == null)
                                            $scope.items = {};
                                        $scope.updateProducts(data_return.products);
                                        delete data_return.products;
                                    }
                                    latest_update_dtm['product_price_for_delivery'] = data_return.need_to_update.product_price_for_delivery;
                                }else{
                                    $scope.items = $.jStorage.get('product_price_for_delivery_data');
                                    $scope.createItemsForSearch();
                                }
                                
                                /*
                                if (typeof data_return.need_to_update.shipping_fees != 'undefined'){
                                    var data = {};
                                    latest_update_dtm['shipping_fees'] = data_return.need_to_update.shipping_fees;
                                    data.shipping_fees = data_return.shipping_fees;
                                    $.jStorage.set('shipping_fees_data', data);
                                }else{
                                    var data = $.jStorage.get('shipping_fees_data');
                                    data_return.shipping_fees = data.shipping_fees;
                                }
                                */
                                
                                $.jStorage.set('latest_update_dtm_for_delivery', latest_update_dtm);
                            }
                            $scope.parseData(data_return);
                            if ($.jStorage){
                                $.jStorage.set('product_price_for_delivery_data', $scope.items);
                            }
                            $scope.afterParseData(data_return);
                            $scope.$apply();
                            setTimeout(function(){
                                $('.container-fluid').show();
                                $('.jar_loading').hide();
                                $('#live-settings').show();
                                $('#language_selector').show();
                                $('#notification_area').show();
                                var referer = $('#referer').val();
                                if (typeof referer != 'undefined' && referer.indexOf(getDomain() + '/') == -1)
                                    $('#myNotificationModal').show("scale", {}, 1000 );
                            }, 1000);
                        }else{
                            alert(data_return.message);
                        }
                    },"json");
                }
                $scope.updateProducts = function(products){
                    for(var key in products){
                        var product = products[key];
                        $scope.items[product.product_id] = product;
                    }
                    $scope.createItemsForSearch();
                }
                $scope.createItemsForSearch = function(){
                    for(var key in $scope.items){
                        var product = $scope.items[key];
                        if (!product.enabled)
                            continue;
                        var category_name = product.category_name;
                        var search_key = product.code + ' ' + product.category_name + ' ' + product.name + ' ' + product.category_name_without_utf8 + ' ' + product.name_without_utf8 + ' ' + product.name.replace(/\+ /g, "")+ ' ' + product.name_without_utf8.replace(/\+ /g, "");
                        $scope.itemsForAutocomplete.push({value: product.code + ' - ' + product.name, label: search_key, extra: product.product_id});
                        $scope.itemsForAutocompleteEn.push({value: product.code + ' - ' + product.english_name, label: product.category_english_name + ' ' + product.english_name, extra: product.product_id});
                    }
                }
                $scope.parseData = function(data){
                    if (data.products){
                        for(var key in data.products){
                            var product = data.products[key];
                            var search_key = product.code + ' ' + product.category_name + ' ' + product.name + ' ' + product.category_name_without_utf8 + ' ' + product.name_without_utf8 + ' ' + product.name.replace(/\+ /g, "")+ ' ' + product.name_without_utf8.replace(/\+ /g, "");
                            $scope.itemsForAutocomplete.push({value: product.code + ' - ' + product.name, label: search_key, extra: product.product_id});
                            $scope.itemsForAutocompleteEn.push({value: product.code + ' - ' + product.english_name, label: product.category_english_name + ' ' + product.english_name, extra: product.product_id});
                            $scope.items[product.product_id] = product;
                        }
                    }
                    $scope.shipping_table = data.shipping_fees;
                    if (data.discount_details){
                        $scope.discount_table = data.discount_details.table;
                        $scope.discount_description = data.discount_details.description;
                        $scope.strings['en'][$scope.discount_description] = data.discount_details.en_description;
                        $scope.is_prebook = data.discount_details.is_prebook?1:0;
                    }
                }
                $scope.afterParseData = function(data){
                    //You can override this function in controllers
                    
                }
                $scope.addItem = function(product_id, quantity) {
                    if ($scope.items[product_id].enabled == 0 && typeof order_code == 'undefined')
                        return '';
                    if (typeof quantity == 'undefined' || !quantity)
                        quantity = 1;
                    var item = $.extend(true, {}, $scope.items[product_id]);
                    item.description = '';
                    var key = '';
                    if (item){
                        var key_found = '';
                        for(var i in $scope.orderedItems){
                            var id = i.split('|')[1];
                            if (id == product_id){
                                existed_item = $scope.orderedItems[i];
                                if (existed_item.total_selected_sub <= 0){
                                    key_found = existed_item.key;
                                    break;
                                } 
                            }
                        }
                        if (key_found)
                        {
                            var old_quantity = $scope.orderedItems[key_found].quantity;
                            $scope.orderedItems[key_found].quantity = parseFloat(old_quantity) + quantity;
                            key = key_found;
                        }
                        else
                        {
                            var new_key = sprintf('%04d',$scope.sequense) + '|' + product_id;
                            item['key'] = new_key;
                            item['quantity'] = quantity;
                            if (item.promotion_price > 0)
                                item['final_price'] = item.promotion_price;
                            else
                                item['final_price'] = item.price;
                            item['selected_sub_products'] = {};
                            item['total_selected_sub'] = 0;
                            $scope.orderedItems[new_key] = item;
                            $scope.sequense++;
                            key = new_key;
                        }
                        pushEvent('Món', item.name, 'Thêm');
                        pushEvent('Nhóm hàng', item.category_name, item.name);
                        $scope.getTotals();
                    }
                    return key;
                };
                $scope.addSubItem = function(ids){
                    var ids = ids.split('_');
                    var key = ids[0];
                    var sub_product_id = ids[1];
                    if ($scope.orderedItems[key])
                    {
                        var sub_product = $scope.orderedItems[key].sub_products[sub_product_id];
                        if ($scope.orderedItems[key].selected_sub_products[sub_product_id]){
                            delete $scope.orderedItems[key].selected_sub_products[sub_product_id];
                            $scope.orderedItems[key].final_price -= sub_product.price;
                            $scope.orderedItems[key].total_selected_sub--;
                        }else{
                            $scope.orderedItems[key].selected_sub_products[sub_product_id] = sub_product;
                            $scope.orderedItems[key].final_price =  parseInt($scope.orderedItems[key].final_price) + parseInt(sub_product.price);
                            $scope.orderedItems[key].total_selected_sub++;
                            pushEvent('Món', $scope.orderedItems[key].name, sub_product.name);
                        }
                        $scope.getTotals();
                    }
                };
                $scope.removeItem = function(product_id, one_item){
                    var need_update = 0;
                    if(one_item){
                        var key_found = '';
                        for(var i in $scope.orderedItems){
                            var id = i.split('|')[1];
                            if (id == product_id){
                                existed_item = $scope.orderedItems[i];
                                if (existed_item.total_selected_sub <= 0){
                                    key_found = existed_item.key;
                                    break;
                                }   
                            }
                        }
                        if (key_found){
                            var quantity = $scope.orderedItems[key_found].quantity;
                            if (quantity > 1){
                                $scope.orderedItems[key_found].quantity--;
                            }else
                                delete $scope.orderedItems[key_found];
                            need_update = 1;
                        }
                        
                    }else{
                        if (typeof $scope.orderedItems[product_id] != 'undefined'){
                            pushEvent('Bỏ món', $scope.orderedItems[product_id].category_name, $scope.orderedItems[product_id].name);
                            delete $scope.orderedItems[product_id];
                            need_update = 1;
                        }
                    }
                    if (need_update)
                        $scope.getTotals();
                };
                $scope.validateQuantity = function(key){
                    if ($scope.orderedItems[key].quantity == '' || parseFloat($scope.orderedItems[key].quantity) <= 0)
                        $scope.orderedItems[key].quantity = 1;
                    $scope.getTotals();
                };
                $scope.onChangeQuantity = function(key){
                    if ($scope.orderedItems[key].quantity != '' && parseFloat($scope.orderedItems[key].quantity) > 0)
                        $scope.getTotals();
                };
                $scope.getQuantityInCategory = function(category_id){
                    return $scope.quantityInCategory[category_id];
                };
                $scope.getQuantityOfItem = function(product_id){
                    return $scope.quantityOfItem[product_id];
                };
                $scope.getTotals = function(){
                    var subtotal = 0;
                    var total_quantity = 0;
                    var quantityItems = {};
                    var quantityCategories = {};
                    for(var i in $scope.orderedItems){
                        if ($scope.orderedItems[i])
                        {
                            var quantity = Math.round($scope.orderedItems[i].quantity*100)/100.0;
                            if (quantity){
                                subtotal += quantity*parseInt($scope.orderedItems[i].final_price);
                                total_quantity += quantity;
                                
                                var product_id = i.split('|')[1];
                                if (quantityItems[product_id]){
                                    quantityItems[product_id] = +(quantityItems[product_id] + quantity).toFixed(2);
                                }else
                                    quantityItems[product_id] = quantity;
                                
                                var category_id = $scope.orderedItems[i].category_id;
                                if (quantityCategories[category_id])
                                    quantityCategories[category_id] = +(quantityCategories[category_id]+quantity).toFixed(2);
                                else
                                    quantityCategories[category_id] = quantity;
                            }else
                                $scope.orderedItems[i].quantity = '';
                        }
                    }
                    $scope.subtotal = subtotal;
                    $scope.total = subtotal;
                    
                    if ($scope.promotion_code_active == 0 && $scope.discount == 0){
                        $scope.discount = $scope.discount_amount = 0;
                    }else{
                        $scope.discount_amount = parseFloat(subtotal*$scope.discount).toFixed(2);
                    }

                    /* Override discount if pre-booking discount is greater than normal discount */
                    var preorder_discount = getPreorderDiscount();
                    if (preorder_discount && $scope.discount <= discount_for_pre_book){
                        $scope.discount = preorder_discount;
                        $scope.discount_amount = parseFloat(subtotal*$scope.discount).toFixed(2);
                    }
                    
                    $scope.total -= $scope.discount_amount;
                    $scope.total += parseFloat($scope.subtotal-$scope.discount_amount)*$scope.VAT;
                    total_quantity = Math.round(total_quantity*100)/100.0
                    $scope.totalQuantity = total_quantity;
                    $scope.quantityOfItem = quantityItems;
                    $scope.quantityInCategory = quantityCategories;
                    return [subtotal, total_quantity];
                };
                $scope.save_customer_info = function(){
                    if (!$.jStorage)
                        return;
                    if ($('#remember_info').is(':checked'))
                        $.jStorage.set('customer', $scope.customer);
                    else{
                        $.jStorage.set('customer', null);
                    }
                };
                $scope.previousStep = function(){
                    $scope.step--;
                };
                $scope.validateShipping = function(){
                    $scope.minTotal = 0;
                    $scope.freeShipFrom = 0;
                    if (typeof $scope == 'undefined')
                        return false;
                    var total = $scope.subtotal - $scope.discount_amount + parseFloat($scope.subtotal - $scope.discount_amount)*$scope.VAT;
                    if ($scope.customer.distance <= 0){
                        $scope.validForShipping = 0;
                        $scope.minTotalError = 0;
                        $scope.shipping_fee = 0;
                        $scope.total = total;
                        return true;
                    }else{
                        $scope.shipping_fee = $scope.calShippingFee(total);
                        $scope.validForShipping = 1;
                        $scope.total = total;
                        if (!$scope.customer.free_ship)
                            $scope.total += $scope.shipping_fee;
                        $scope.minTotalError = 0;
                        return true;
                    }
                };
                $scope.calShippingFee = function(amount){
                    if(parseFloat($scope.customer.distance) > 0){
                        var distance = Math.ceil($scope.customer.distance);
                        var fee_table = $scope.shipping_table;
                        var district = $scope.customer.district;

                        var shipping_fee = distance*$scope.SHIPPING_MULTIPLIER;
                        if(typeof fee_table[district] != 'undefined'){
                            for(var min_total in fee_table[district]){
                                if(fee_table[district][min_total] == 0)
                                    $scope.freeShipFrom = min_total;
                                if (amount >= parseFloat(min_total)){
                                    shipping_fee = fee_table[district][min_total];
                                }
                            }
                        }
                        return shipping_fee;
                    }
                }
                $scope.checkShippingFee = function(){
                    var params = {action: 'is_free_ship'};
                    params['mobile'] = $scope.customer.mobile;
                    $.post(base_url + 'postback.php', params, function(data){
                        if (data.status == 'OK'){
                            if (data.free_ship)
                                $scope.customer.free_ship = 1;
                            else
                                $scope.customer.free_ship = 0;
                            $scope.$apply();
                        }else{
                            alert(data.message);
                        }
                    },"json");
                }
                $scope.toggleSettings = function(){
                    $scope.show_settings = !$scope.show_settings;
                }
                $scope.saveSettingsToLocal = function(){
                    if ($.jStorage){
                        $.jStorage.set('efruit_settings', $scope.settings);
                    }
                }
                $scope.toggleSettingSoldOut = function(value){
                    $scope.settings.hideSoldOut = !$scope.settings.hideSoldOut;
                    $scope.saveSettingsToLocal();
                }
                $scope.setSettingSoldOut = function(value){
                    $scope.settings.hideSoldOut = value;
                    $scope.saveSettingsToLocal();
                }
                $scope.switchLanguage = function(lang_code){
                    $scope.settings.language = lang_code;
                    $scope.saveSettingsToLocal();
                    $('.glyphicon.glyphicon-info-sign').tooltip('destroy');
                    $('html').attr('lang', lang_code);
                    $('html').attr('class', 'ng-scope ' + lang_code);                                                            
                    $scope.bindMultiSelect();
                }
                $scope.__ = function(text, id){
                    if ($scope.settings.language == 'vn')
                        return text;
                    else{
                        var key = text;
                        if (typeof id != 'undefined')
                            key += id;
                        if (typeof $scope.strings[$scope.settings.language] != 'undefined' && $scope.strings[$scope.settings.language][key])
                            return $scope.strings[$scope.settings.language][key];
                        else
                            return text;
                    }
                }
                
                $scope.bindMultiSelect = function(){
                    $('select.multiple').not('.hidden').multiselect("destroy");
                    $('select.multiple').not('.hidden').multiselect({
                        nonSelectedText: $scope.__('Chọn'),
                        nSelectedText: $scope.__('loại'),
                        numberDisplayed: 2,
                        onChange: function(option, checked) {
                            $scope.$apply(function (scope) {
                                scope.addSubItem(option.attr('id'));
                            });
                        },
                        buttonText: function(options, select) {
                            if (options.length === 0) {
                                return this.nonSelectedText + ' <b class="caret"></b>';
                            }
                            else {
                                if (options.length > this.numberDisplayed) {
                                    return options.length + ' ' + this.nSelectedText + ' <b class="caret"></b>';
                                }
                                else {
                                    var selected = '';
                                    options.each(function() {
                                        var label = ($(this).attr('label') !== undefined) ? $(this).attr('label') : $(this).html();
                                        var i = label.indexOf('-');
                                        label = label.substring(0, i-1);
                                        selected += label + ', ';
                                    });
                                    return selected.substr(0, selected.length - 2) + ' <b class="caret"></b>';
                                }
                            }
                        }
                    });
                }
                
                $scope.$on("doneRender", 
                    function() {         
                        $scope.bindMultiSelect();
                        $(".glyphicon.glyphicon-info-sign").tooltip();
                        $('.glyphicon.glyphicon-info-sign').hover(function() {changeTooltipColorTo('#6cc357')});
                    }
                 );
            }
        });
})();