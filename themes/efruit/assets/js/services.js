var startHour = (typeof preStartHour == 'undefined'?8:parseInt(preStartHour));
var startMinute = (typeof preStartMinute == 'undefined'?0:parseInt(preStartMinute));
var endHour = (typeof preEndHour == 'undefined'?21:parseInt(preEndHour));
var endMinute = (typeof preEndMinute == 'undefined'?0:parseInt(preEndMinute));
var allowedHours = [];
for (var h = startHour; h <= endHour; h++) {
    allowedHours.push(h);
}
var frmOrderValidator = null;
var edebug = '';

function getStorage(key){
    if(typeof storage_key_prefix == 'undefined')
        storage_key_prefix = 'e';
    if (typeof $.jStorage != "undefined" && $.jStorage){
        return $.jStorage.get(storage_key_prefix + key)
    }
    return null;
}

function setStorage(key, value){
    if(typeof storage_key_prefix == 'undefined')
        storage_key_prefix = 'e';
    if (typeof $.jStorage != "undefined" && $.jStorage){
        return $.jStorage.set(storage_key_prefix + key, value)
    }
    return false;
}

function isValidDeliveryTime(datetime){
    if (datetime == '')
        return false;
    let minDatetime = parseInt($('#datetimepicker').attr('data-minDate'));
    if(datetime < minDatetime)
        return false;
    let d = moment(datetime*1000);
    let hour = parseInt(d.format('HH'));
    let minute = parseInt(d.format('mm'));
    console.log(hour);
    console.log(minute);
    console.log(startMinute);
    if (hour < startHour)
        return false;
    else if(hour == startHour && minute < startMinute)
        return false;
    else if(hour > endHour)
        return false;
    else if(hour == endHour && minute > endMinute)
        return false;
    return true;
}

function getPreorderDiscount(datetime){
    if (datetime == '')
        return 0;
    let minDatetime = parseInt($('#datetimepicker').attr('data-minDate'));
    if(datetime < minDatetime)
        return 0;
    let d = moment(datetime*1000);
    let hour = parseInt(d.format('HH'));
    let minute = parseInt(d.format('mm'));
    if (hour < startHour)
        return 0;
    else if(hour == startHour && minute < startMinute)
        return 0;
    else if(hour > endHour)
        return 0;
    else if(hour == endHour && minute > endMinute)
        return 0;

    /* 2 days pre-order */
    if(datetime >= (minDatetime + 3600*24))
        return discount_for_pre_book;
    return discount_for_pre_book_2;
}

(function(){
    var shaking = 0;
    angular.module('app.services', [])
        .service('myService', function() {
            this.scope = '';

            this.init = function($scope){
                this.scope = edebug = $scope;
                $scope.STAY_TYPE = 1;
                $scope.TAKEAWAY_TYPE = 2;
                $scope.DELIVERY_TYPE = 3;
                $scope.FOODY_TYPE = 8;

                $scope.SINH_TO_CAT_ID = 6;
                $scope.NUOC_EP_LY_CAT_ID = 7;
                $scope.NUOC_EP_CHAI_CAT_ID = 8;
                $scope.CAFE_CAT_ID = 10;
                $scope.TRAI_CAY_KG_CAT_ID = 12;
                $scope.MIXED_FRUIT_CAT_ID = 14;
                $scope.TRAI_CAY_VP_CAT_ID = 15;
                $scope.SINH_TO_MIXED_CAT_ID = 15;
                $scope.HOP_TRAI_CAY_CAT_ID = 19;
                $scope.BANH_CAT_ID = 20;

                $scope.reset = function(){
                    $scope.step = 1;
                    $scope.accept_terms = true;
                    $scope.orderedItems = {};
                    $scope.quantityInCategory = {};
                    $scope.quantityOfItem = {};
                    $scope.orderedBoxes = {};
                    $scope.selectedItem = '';
                    $scope.selectedStep = 1;
                    $scope.maxItems = 5;
                    $scope.customBoxItems = '';
                    $scope.sequense = 1;
                    $scope.code = '';
                    $scope.subtotal = 0;
                    $scope.total = 0;
                    $scope.totalQuantity = 0;
                    $scope.shipping_details = '';
                    $scope.shipping_fee = 0;
                    $scope.discount = 0;
                    $scope.discount_amount = 0;
                    $scope.delivery_datetime = '';
                    $scope.validForShipping = 0;
                    $scope.description = '';
                    $scope.shipping_description = '';
                    $scope.is_prebook = 0;
                    $scope.promotion_code_active = 0;
                    $scope.selectedProduct = null;
                    $scope.layout = 1;
                    $scope.has_VAT = false;
                    $scope.VAT = 0;
                    $scope.payment_method = 'cod';
                    $scope.isEditing = 0;
                    $scope.btnBookOrEditLabel = translate('Đặt hàng');
                    $scope.customItem = {
                        useAllFruit: 1,
                        numberOfItems: 1,
                        subItems: {},
                        numberOfSubItems: 0,
                        price: 0,
                        extraItems: [],
                        taste: '',
                        description: '',
                        toppingItem: '',
                        useBottle: 0,
                        boxSubTotal: 0,
                        boxTotal: 0,
                        error_msg: ''
                    };
                    $scope.editingKey = false;
                    $('.wizard-steps li').eq(0).css('margin-left', '0px');
                };
                $scope.reset();
                $scope.tasteOptions = {};
                if (typeof ORDER_CODE != 'undefined'){
                    $scope.isEditing = 1;
                    $scope.code = ORDER_CODE;
                    $scope.btnBookOrEditLabel = translate('Sửa đơn hàng');
                }
                if ($.jStorage && !$scope.isEditing){
                    var orderedItems = getStorage('orderedItems');
                    if (orderedItems)
                        $scope.orderedItems = orderedItems;
                    var orderedBoxes = getStorage('orderedBoxes');
                    if (orderedBoxes)
                        $scope.orderedBoxes = orderedBoxes;
                    var quantityInCategory = getStorage('quantityInCategory');
                    if (quantityInCategory)
                        $scope.quantityInCategory = quantityInCategory;
                    var quantityOfItem = getStorage('quantityOfItem');
                    if (quantityOfItem)
                        $scope.quantityOfItem = quantityOfItem;
                    var dd = getStorage('deliveryDate');
                    if (dd){
                        $scope.delivery_datetime = dd;
                    }
                }

                $scope.SHIPPING_MULTIPLIER = 5;
                $scope.shipping_table = {};
                $scope.discount_details = '';
                $scope.discount_table = {};
                $scope.items = {};
                $scope.itemsForAutocomplete = [];
                $scope.itemsForAutocompleteEn = [];
                $scope.itemsForBoxes = {};
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
                $scope.show_settings = 0;
                $scope.settings = {
                    hideSoldOut: 0,
                    language: default_lang
                };
                $scope.strings = lang_table;
                var settings = getStorage('efruit_settings');
                if (settings){
                    for(var s in settings){
                        if (s == 'language' && settings[s] == 'vn')
                            settings[s] = 'vi';
                        $scope.settings[s] = settings[s];
                    }
                }
                $scope.requestData = function(params){
                    var latest_update_dtm = {'product_price_for_delivery': '-1', 'shipping_fees': '-1'};
                    var v = getStorage('efruit_version');
                    if (v == window.version){
                        dtm = getStorage('latest_update_dtm_for_delivery');
                        if (dtm){
                            for(var i in dtm){
                                if (dtm[i])
                                    latest_update_dtm[i] = dtm[i];
                            }
                        }
                    }else
                        setStorage('efruit_version', window.version);
                    params['latest_update_dtm'] = latest_update_dtm;
                    $.post(postback_url, params, function(data_return){
                        if (data_return.status == 'OK'){
                            if (typeof data_return.need_to_update.product_price_for_delivery != 'undefined'){
                                if (latest_update_dtm['product_price_for_delivery'] != '-1'){
                                    $scope.items = getStorage('product_price_for_delivery_data');
                                    if($scope.items == null)
                                        $scope.items = {};
                                    $scope.updateProducts(data_return.products);
                                    delete data_return.products;
                                }
                                latest_update_dtm['product_price_for_delivery'] = data_return.need_to_update.product_price_for_delivery;
                            }else{
                                $scope.items = getStorage('product_price_for_delivery_data');
                                $scope.createItemsForSearch();
                            }

                            /*
                            if (typeof data_return.need_to_update.shipping_fees != 'undefined'){
                                var data = {};
                                latest_update_dtm['shipping_fees'] = data_return.need_to_update.shipping_fees;
                                data.shipping_fees = data_return.shipping_fees;
                                setStorage('shipping_fees_data', data);
                            }else{
                                var data = getStorage('shipping_fees_data');
                                data_return.shipping_fees = data.shipping_fees;
                            }
                            */

                            setStorage('latest_update_dtm_for_delivery', latest_update_dtm);
                            $scope.parseData(data_return);
                            setStorage('product_price_for_delivery_data', $scope.items);
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
                            alert($scope.__(data_return.message));
                        }
                    },"json");
                };
                $scope.updateProducts = function(products){
                    for(var key in products){
                        var product = products[key];
                        $scope.items[product.product_id] = product;
                    }
                    $scope.createItemsForSearch();
                };
                $scope.createItemsForSearch = function(){
                    for(var key in $scope.items){
                        var product = $scope.items[key];
                        if (!product.enabled)
                            continue;
                        var search_key = product.code + ' ' + product.category_name + ' ' + product.name + ' ' + product.category_name_without_utf8 + ' ' + product.name_without_utf8 + ' ' + product.name.replace(/\+ /g, "")+ ' ' + product.name_without_utf8.replace(/\+ /g, "");
                        if (product.promotion_price > 0)
                            var item_price = ' - ' + product.promotion_price + 'k';
                        else
                            var item_price = ' - ' + product.price + 'k';
                        $scope.itemsForAutocomplete.push({value: product.code + ' - ' + product.name + item_price, label: search_key, extra: product.product_id, can_be_added_to_box: product.can_be_added_to_box});
                        $scope.itemsForAutocompleteEn.push({value: product.code + ' - ' + product.english_name + item_price, label: product.category_english_name + ' ' + product.english_name, extra: product.product_id, can_be_added_to_box: product.can_be_added_to_box});
                        if(product.can_be_added_to_box)
                            $scope.itemsForBoxes[product.product_id] = product;
                    }
                };
                $scope.parseData = function(data){
                    if (data.products){
                        for(var key in data.products){
                            var product = data.products[key];
                            var search_key = product.code + ' ' + product.category_name + ' ' + product.name + ' ' + product.category_name_without_utf8 + ' ' + product.name_without_utf8 + ' ' + product.name.replace(/\+ /g, "")+ ' ' + product.name_without_utf8.replace(/\+ /g, "");
                            if (product.promotion_price > 0)
                                var item_price = ' - ' + product.promotion_price + 'k';
                            else
                                var item_price = ' - ' + product.price + 'k';
                            $scope.itemsForAutocomplete.push({value: product.code + ' - ' + product.name + item_price, label: search_key, extra: product.product_id, can_be_added_to_box: product.can_be_added_to_box});
                            $scope.itemsForAutocompleteEn.push({value: product.code + ' - ' + product.english_name + item_price, label: product.category_english_name + ' ' + product.english_name, extra: product.product_id, can_be_added_to_box: product.can_be_added_to_box});
                            $scope.items[product.product_id] = product;
                            if(product.can_be_added_to_box)
                                $scope.itemsForBoxes[product.product_id] = product;
                        }
                    }
                    $scope.shipping_table = data.shipping_fees;
                    if (data.discount_details){
                        $scope.discount_details = data.discount_details;
                        $scope.discount_table = data.discount_details.table;
                        $scope.discount_description = data.discount_details.description;
                        $scope.strings['en'][$scope.discount_description] = data.discount_details.en_description;
                        $scope.is_prebook = data.discount_details.is_prebook?1:0;
                    }
                    //$scope.efruit_delivery_fees_in_short = data.efruit_delivery_fees_in_short;
                };
                $scope.afterParseData = function(data){
                    //You can override this function in controllers

                };
                $scope.addItem = function(product_id, quantity, $event) {
                    if ($scope.items[product_id].enabled == 0)
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
                                if ($scope.orderedItems[i].total_selected_sub <= 0){
                                    key_found = $scope.orderedItems[i].key;
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
                            item['custom'] = '';
                            if (typeof $scope.customItem != 'undefined' && $scope.customItem.price > 0){
                                item['custom'] = $.extend(true, {}, $scope.customItem);
                                /* If fruit box, using box total as final price */
                                if(item.is_box)
                                    item['final_price'] = $scope.customItem.boxTotal;
                            }
                            $scope.orderedItems[new_key] = item;
                            $scope.sequense++;
                            key = new_key;
                        }
                        pushEvent('Món', item.name, 'Thêm');
                        pushEvent('Nhóm hàng', item.category_name, item.name);
                        $scope.getTotals();

                        if (typeof $event != 'undefined' && $event)
                            $scope.shakeCart($event.currentTarget);
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
                            $scope.orderedItems[key].sub_products[sub_product_id]['selected'] = 0;
                        }else{
                            $scope.orderedItems[key].selected_sub_products[sub_product_id] = sub_product;
                            $scope.orderedItems[key].final_price =  parseInt($scope.orderedItems[key].final_price) + parseInt(sub_product.price);
                            $scope.orderedItems[key].total_selected_sub++;
                            $scope.orderedItems[key].sub_products[sub_product_id]['selected'] = 1;
                            pushEvent('Món', $scope.orderedItems[key].name, sub_product.name);
                        }
                        $scope.getTotals();
                    }
                };
                $scope.removeSubItem = function(ids){
                    $scope.addSubItem(ids);
                };
                $scope.removeItem = function(key, remove_one_by_product_id){
                    var need_update = 0;
                    if(typeof remove_one_by_product_id == 'undefined')
                        remove_one_by_product_id = 0;
                    if(remove_one_by_product_id){
                        var key_found = '';
                        for(var i in $scope.orderedItems){
                            var id = i.split('|')[1];
                            if (id == key){
                                if ($scope.orderedItems[i].total_selected_sub <= 0){
                                    key_found = $scope.orderedItems[i].key;
                                    break;
                                }
                            }
                        }
                        if (key_found){
                            var quantity = $scope.orderedItems[key_found].quantity;
                            if (quantity > 1){
                                $scope.orderedItems[key_found].quantity--;
                            }else{
                                delete $scope.orderedItems[key_found];
                                /* key is product/box id */
                                if (typeof $scope.orderedBoxes[key] != 'undefined')
                                    delete $scope.orderedBoxes[key];
                            }

                            need_update = 1;
                        }

                    }else{
                        if (typeof $scope.orderedItems[key] != 'undefined'){
                            pushEvent('Bỏ món', $scope.orderedItems[key].category_name, $scope.orderedItems[key].name);
                            delete $scope.orderedItems[key];
                            need_update = 1;
                        }
                        var box_id = key.split('|')[1];
                        if (typeof $scope.orderedBoxes[box_id] != 'undefined')
                            delete $scope.orderedBoxes[box_id];
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
                $scope.increaseQuantity = function(key){
                    if (typeof $scope.orderedItems[key] != 'undefined' && $scope.orderedItems[key].quantity > 0){
                        $scope.orderedItems[key].quantity++;
                        $scope.getTotals();
                    }
                };
                $scope.decreaseQuantity = function(key){
                    if (typeof $scope.orderedItems[key] != 'undefined' && $scope.orderedItems[key].quantity > 0){
                        var quantity = $scope.orderedItems[key].quantity;
                        if (quantity > 1){
                            $scope.orderedItems[key].quantity--;
                        }else{
                            $scope.removeItem(key, 0);
                        }
                        $scope.getTotals();
                    }
                };
                $scope.getQuantityInCategory = function(category_id){
                    return $scope.quantityInCategory[category_id];
                };
                $scope.getQuantityOfItem = function(product_id){
                    return $scope.quantityOfItem[product_id];
                };
                $scope.checkVAT = function(){
                    $scope.VAT = $scope.has_VAT?0.1:0;
                };
                $scope.getTotals = function(){
                    var subtotal = 0;
                    var total_quantity = 0;
                    var quantityItems = {};
                    var quantityCategories = {};
                    for(var i in $scope.orderedItems){
                        if ($scope.orderedItems[i])
                        {
                            if ($scope.orderedItems[i].quantity){
                                var quantity = formatQuantity(parseFloat($scope.orderedItems[i].quantity));
                                subtotal += quantity*parseInt($scope.orderedItems[i].final_price);
                                total_quantity += quantity;

                                var product_id = i.split('|')[1];
                                if (quantityItems[product_id]){
                                    quantityItems[product_id] += quantity;
                                }else
                                    quantityItems[product_id] = quantity;

                                var category_id = $scope.orderedItems[i].category_id;
                                if (quantityCategories[category_id])
                                    quantityCategories[category_id] += quantity;
                                else
                                    quantityCategories[category_id] = quantity;
                            }else
                                $scope.orderedItems[i].quantity = '';
                        }
                    }
                    $scope.subtotal = subtotal;
                    $scope.total = subtotal;

                    if ($scope.discount == 0){
                        $scope.discount = $scope.discount_amount = 0;
                    }else{
                        $scope.discount_amount = parseFloat(subtotal*$scope.discount).toFixed(2);
                    }
                    /* Override discount if pre-booking discount is greater than normal discount */
                    let preorder_discount = getPreorderDiscount($scope.delivery_datetime);
                    if (preorder_discount && $scope.discount <= discount_for_pre_book){
                        $scope.discount = preorder_discount;
                        $scope.discount_amount = parseFloat(subtotal*$scope.discount).toFixed(2);
                    }
                    $scope.total -= $scope.discount_amount;
                    $scope.VAT = $scope.has_VAT?0.1:0;
                    $scope.total += parseFloat($scope.subtotal-$scope.discount_amount)*$scope.VAT;

                    $scope.totalQuantity = total_quantity;
                    $scope.quantityOfItem = quantityItems;
                    $scope.quantityInCategory = quantityCategories;
                    return [subtotal, total_quantity];
                };
                $scope.save_customer_info = function(){
                    if (!$.jStorage || $scope.isEditing)
                        return;
                    if ($('#remember_info').is(':checked'))
                        setStorage('customer', $scope.customer);
                    else{
                        setStorage('customer', null);
                    }
                };
                $scope.previousStep = function(){
                    $scope.step--;
                    $('.wizard-steps li').eq(0).css('margin-left', '0px');
                };
                $scope.validateShipping = function(){
                    $scope.minTotal = 0;
                    $scope.freeShipFrom = 0;
                    if (typeof $scope == 'undefined')
                        return false;
                    var total = $scope.subtotal - $scope.discount_amount  + ($scope.subtotal- $scope.discount_amount)*$scope.VAT;

                    if ($scope.customer.distance <= 0){
                        $scope.validForShipping = 0;
                        $scope.minTotalError = 0;
                        $scope.shipping_fee = 0;
                        $scope.total = total;
                        return true;
                    }else{
                        if ($scope.customer.distance > max_distance){
                            $scope.shipping_fee = 0;
                            $scope.validForShipping = 0;
                            $scope.minTotalError = 1;
                            $scope.total = total;
                            return false;
                        }else if(total < min_total){
                            $scope.shipping_fee = 0;
                            $scope.validForShipping = 0;
                            $scope.minTotalError = 1;
                            $scope.total = total;
                            return false;
                        }

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
                            for(var m in fee_table[district]){
                                if(fee_table[district][m] == 0)
                                    $scope.freeShipFrom = m;
                                if (amount >= parseFloat(m)){
                                    shipping_fee = fee_table[district][m];
                                }
                            }
                        }
                        return shipping_fee;
                    }
                };
                $scope.toggleSettings = function(){
                    $scope.show_settings = !$scope.show_settings;
                };
                $scope.saveSettingsToLocal = function(){
                    setStorage('efruit_settings', $scope.settings);
                };
                $scope.toggleSettingSoldOut = function(value){
                    $scope.settings.hideSoldOut = !$scope.settings.hideSoldOut;
                    $scope.saveSettingsToLocal();
                };
                $scope.setSettingSoldOut = function(value){
                    $scope.settings.hideSoldOut = value;
                    $scope.saveSettingsToLocal();
                };
                $scope.switchLanguage = function(lang_code){
                    $scope.settings.language = lang_code;
                    if (lang_code == 'vi')
                        moment.locale('vn');
                    else
                        moment.locale('en');
                    $scope.saveSettingsToLocal();
                    $('html').attr('lang', lang_code);
                    $('html').attr('class', 'ng-scope ' + lang_code);
                    $scope.bindMultiSelect();
                    $scope.onLanguageChange();
                };
                $scope.__ = function(text, id){
                    return translate(text, id, $scope.settings.language);
                };
                $scope.printf = function() {
                    var params = [];
                    var text = arguments[0];
                    for (var i = 1; i < arguments.length; i++) {
                        params.push(arguments[i])
                    }
                    return vsprintf(text, params);
                };
                $scope.getImagePath = function(product, type){
                    if (typeof product != 'undefined')
                    {
                        if (typeof type == 'undefined')
                            type = 'x-small';
                        if (product.image){
                            var original_path = product.image;
                            var filename = original_path.split(/(\\|\/)/g).pop();

                            if (original_path.indexOf('http') != -1){
                                if (base_url.indexOf('https') != -1 && original_path.indexOf('https') == -1){
                                    original_path = original_path.replace('http', 'https');
                                }
                                return original_path.replace(filename, '') + type + '/' + filename;
                            }

                            return base_url + original_path.replace(filename, '') + type + '/' + filename;
                        }
                    }
                    return asset_url + 'img/default-product-image.png';
                };
                $scope.getIndexString = function(arrayObj, obj){
                    if (typeof arrayObj == 'undefined' || arrayObj.length == 0 || typeof obj == 'undefined' || obj.length == 0)
                        return null;
                    for(var i in arrayObj){
                        if (arrayObj[i] == obj)
                            return i;
                    }
                    return null;
                };
                $scope.shakeCart = function(obj, imgObj){
                    if($('.shopping-cart:visible').length)
                        var cart = $('.shopping-cart:visible');
                    else
                        var cart = $('.efruit-cart:visible');
                    if(typeof cart == 'undefined' || !cart || cart.length == 0)
                        return;
                    if (typeof imgObj == 'undefined'){
                        if ($(obj).parent('.y-grid-card').length)
                            var itemtodrag = $(obj).parent('.y-grid-card').find(".y-image img").eq(0);
                        else{
                            if ($(obj).hasClass('btn-booking') || $(obj).hasClass('product-info')){
                                var itemtodrag = $(obj).parents('tr').eq(0).find('.product-image');
                            }else{
                                var itemtodrag = $(obj);
                            }
                        }

                    }
                    else
                        var itemtodrag = $(imgObj);
                    if (itemtodrag) {
                        var imgclone = itemtodrag.clone().offset({
                            top: itemtodrag.offset().top,
                            left: itemtodrag.offset().left
                        }).css({
                                'opacity': '0.5',
                                'position': 'absolute',
                                'height': 'auto',
                                'width': '150px',
                                'z-index': '9999'
                        }).appendTo($('body')).animate({
                            'top': cart.offset().top + 10,
                            'left': cart.offset().left + 10,
                            'width': 75,
                            'height': 'auto'
                        }, 1000, 'easeInOutExpo');

                        if (shaking == 0){
                            shaking = 1;
                            setTimeout(function () {
                                cart.effect("shake", {
                                    times: 1
                                }, 200);
                                shaking = 0;
                            }, 1500);
                        }

                        imgclone.animate({
                            'width': 0,
                            'height': 0
                        }, function () {
                            $(this).detach()
                        });
                    }
                };
                $scope.animationToCart = function(obj){
                    var cart = $('#cupcontainer');
                    var fruit = $(obj);
                    if (fruit) {
                        var fruitclone = fruit.clone();
                        fruitclone.find('span').remove();
                        fruitclone.offset({
                            top: fruit.position().top,
                            left: fruit.offset().left
                        }).css({
                                'opacity': '0.5',
                                'position': 'absolute',
                                'height': '50px',
                                'width': '50px',
                                'z-index': '100'
                        }).appendTo($('#fruit-free-choices-modal')).animate({
                            'top': cart.position().top + 100,
                            'left': cart.offset().left + 50,
                            'width': 75,
                            'height': 75
                        }, 1000, 'easeInOutExpo');

                        if (shaking == 0){
                            shaking = 1;
                            setTimeout(function () {
                                cart.effect("shake", {
                                    times: 1
                                }, 200);
                                shaking = 0;
                            }, 1500);
                        }

                        fruitclone.animate({
                            'width': 0,
                            'height': 0
                        }, function () {
                            $(this).detach()
                        });
                    }
                };
                $scope.initForCustomOrder = function(){
                    $scope.customItem = {
                        numberOfItems: 1,
                        subItems: {},
                        numberOfSubItems: 0,
                        price: 0,
                        extraItems: [],
                        taste: '',
                        description: '',
                        toppingItem: '',
                        useBottle: 0,
                        boxSubTotal: 0,
                        boxTotal: 0,
                        error_msg: ''
                    };
                    $scope.getPrice();
                };
                $scope.addCustomBoxItem = function(item_id, quantity){
                    if (typeof $scope.items[item_id] == 'undefined')
                        return false;
                    if ($scope.items[item_id].enabled == 0)
                        return false;
                    if (typeof quantity == 'undefined' || !quantity)
                        quantity = 1.0;
                    else
                        quantity = parseFloat(quantity);
                    var item = $.extend(true, {}, $scope.items[item_id]);
                    if (item){
                        if (typeof $scope.customBoxItems[item_id] != 'undefined')
                        {
                            var old_quantity = $scope.customBoxItems[item_id].quantity;
                            $scope.customBoxItems[item_id].quantity = parseFloat(old_quantity) + quantity;
                        }
                        else
                        {
                            item['quantity'] = quantity;
                            $scope.customBoxItems[item_id] = item;
                        }
                        $scope.checkCustomBoxTotal();
                    }
                    return item;
                };
                $scope.removeCustomBoxItem = function(item_id){
                    if(typeof $scope.customBoxItems[item_id] != 'undefined'){
                        delete $scope.customBoxItems[item_id];
                        $scope.checkCustomBoxTotal();
                    }
                };
                $scope.checkCustomBoxTotal = function(){
                    $scope.customItem.boxSubTotal = 0;
                    $scope.customItem.boxTotal = 0;
                    if($scope.customBoxItems){
                        for(var i in $scope.customBoxItems){
                            $scope.customItem.boxSubTotal += parseFloat($scope.customBoxItems[i].quantity) * parseFloat($scope.customBoxItems[i].price);
                        }
                    }
                    $scope.customItem.boxTotal = $scope.customItem.boxSubTotal*(100-$scope.selectedItem.box_discount_rate)/100;
                    /*
                    if($scope.customItem.boxTotal < $scope.selectedItem.price*0.9){
                        $scope.customItem.error_msg = 'Giá trị của hộp phải lớn hơn ' + numberFormat($scope.selectedItem.price*0.9*1000) + 'đ. Vui lòng điều chỉnh lại giỏ hàng.';
                    }else{
                        $scope.customItem.error_msg = '';
                    }
                    */
                };
                $scope.validateBoxQuantity = function(key){
                    if ($scope.customBoxItems[key].quantity == '' || parseFloat($scope.customBoxItems[key].quantity) <= 0)
                        $scope.customBoxItems[key].quantity = 1;
                    $scope.checkCustomBoxTotal();
                };
                $scope.onChangeBoxQuantity = function(key){
                    if ($scope.customBoxItems[key].quantity != '' && parseFloat($scope.customBoxItems[key].quantity) > 0)
                        $scope.checkCustomBoxTotal();
                };
                $scope.saveOrder = function(){
                    var params = {action: 'save_order'};
                    params['ids'] = {};
                    params['quantity'] = {};
                    if($('#is_local').length){
                        params['is_local'] = $('#is_local').val();
                        if (params['is_local'] == 0){
                            var captcha_obj = $('#captcha_input');
                            params[captcha_obj.attr('name')] = $scope.captcha;
                        }
                    }
                    params['descriptions'] = {};
                    params['custom'] = {};
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

                                params['custom'][i] = $scope.orderedItems[i].custom;
                            }
                        }
                    }
                    params['boxes'] = {};
                    for(var box_id in $scope.orderedBoxes){
                        if ($scope.orderedBoxes[box_id])
                        {
                            params['boxes'][box_id] = {};
                            for(var item_id in $scope.orderedBoxes[box_id]){
                                if(!item_id || item_id == 'undefined')
                                    continue;
                                var box_item = $scope.orderedBoxes[box_id][item_id];
                                if (box_item.quantity){
                                    params['boxes'][box_id][item_id] = {
                                        'quantity': box_item.quantity,
                                        'price': box_item.price,
                                        'unit': box_item.unit
                                    };
                                }
                            }
                        }
                    }
                    $scope.save_customer_info();
                    if($('#need_customer_details').length)
                        params['customer'] = parseInt($('#need_customer_details').val())?$scope.customer:{};
                    else
                        params['customer'] = $scope.customer;
                    params['description'] = $scope.description;
                    params['code'] = $scope.code;
                    params['language'] = $scope.settings.language;
                    params['shipping_description'] = $scope.shipping_description;
                    params['delivery_datetime'] = $scope.delivery_datetime;
                    params['promotion_code'] = $scope.promotion_code_active;
                    params['payment_method'] = $scope.payment_method;
                    params['branch_id'] = $('#branch_id').val();
                    params['VAT'] = $scope.VAT;
                    params['discount_amount'] = $scope.discount_amount;
                    $("#loading").removeClass("hidden");
                    $.post(postback_url, params, function(data){
                        $("#loading").addClass("hidden");
                        if (data.status == 'OK'){
                            $scope.code = data.code;
                            $scope.step++;
                            $scope.$apply();
                            pushEvent('Đặt hàng', 'Đặt hàng thành công', $scope.code);
                        }else{
                            showAlertError(translate(data.message));
                            pushEvent('Đặt hàng', 'Đặt hàng lỗi', data.message);
                        }
                    },"json");
                };
                $scope.onLanguageChange = function(){
                    /*
                    var validator = $("#subscribe-form").validate({
                        errorPlacement: function(error, element) {
                            if (msg == '')
                                msg = error.text();
                        },
                        messages: {
                            email: {
                                required: $scope.__("Vui lòng nhập địa chỉ email"),
                                email: $scope.__("Vui lòng nhập địa chỉ email hợp lệ")
                            }
                        }
                    });
                    validator.settings.messages.email.required = $scope.__("Vui lòng nhập địa chỉ email");
                    validator.settings.messages.email.email = $scope.__("Vui lòng nhập địa chỉ email hợp lệ");


                    $(".glyphicon.glyphicon-info-sign").tooltip();
                    $('.glyphicon.glyphicon-info-sign').hover(function() {changeTooltipColorTo('#6cc357')});

                    $('#subscribe-form').unbind('submit');
                    $('#subscribe-form').submit(function(){
                        if (!$("#subscribe-form").valid()){
                            showAlertError(msg);
                            msg = '';
                            return false;
                        }
                        var params = $(this).serialize();
                        $("#subscribe-form #subscribe").attr('disabled', true);
                        $("#subscribe-form #subscribe").val($scope.__('Đang lưu...'));
                        pushEvent('Newsletter Button Clicked', 'Form Submit', 'Click');
                        $("#loading").removeClass("hidden");
                        $.post(postback_url, params, function(data){
                            $("#loading").addClass("hidden");
                            $("#subscribe-form #subscribe").removeAttr('disabled');
                            $("#subscribe-form #subscribe").val($scope.__('Đăng ký'));
                            showAlertError(data.message);
                            if (data.status == 'OK')
                            {
                                $("#subscribe-form #email").val('');
                                $('#modal-subscribe').modal('toggle');
                            }
                        },"json");
                        return false;
                    });
                    */
                    if(frmOrderValidator){
                        $.validator.messages.required = $scope.__('Vui lòng nhập thông tin hợp lệ');
                        frmOrderValidator.settings.messages.mobile.minlength = $scope.__("Vui lòng nhập ít nhất {0} số");
                        frmOrderValidator.settings.messages.email.email = $scope.__("Vui lòng nhập địa chỉ email hợp lệ");
                        frmOrderValidator.settings.messages.company_tax_code.minlength = $scope.__("Vui lòng nhập ít nhất {0} số");
                    }
                };
                $scope.showProduct = function(product_id, $event, force_popup){
                    if(typeof force_popup == 'undefined')
                        force_popup = 0;
                    if($scope.items[product_id].not_deliver == 1){
                        return;
                    }
                    $scope.initForCustomOrder();
                    $scope.customItem.taste = 6;
                    var item = $scope.items[product_id];
                    if(Object.keys(item.sub_products).length == 0 && force_popup == 0
                        && item.show_components_on_frontend == 0
                        && item.is_box == 0){
                        $scope.addItem(product_id, 1, $event);
                        return;
                    }
                    $scope.selectedItem = $.extend(true, {}, item);
                    $scope.getPrice();
                    if($scope.selectedItem.free_choice == 1 && $scope.selectedItem.enabled)
                        $('#fruit-free-choices-modal').modal();
                    else if($scope.selectedItem.is_box == 1){
                        delete $scope.customBoxItems;
                        $scope.customBoxItems = {};
                        for(var i in $scope.selectedItem.box_items){
                            if(typeof $scope.selectedItem.box_items[i]['item_id'] != 'undefined')
                                $scope.addCustomBoxItem($scope.selectedItem.box_items[i].item_id, $scope.selectedItem.box_items[i].amount);
                        }
                        $('#fruit-box-modal').modal();
                    }
                    else
                        $('#view-product-modal').modal();
                };
                $scope.editOrderedItem = function (key) {
                    /* Key is 2 parts: sequence number and product id */
                    var orderedItem = $scope.orderedItems[key];
                    var product_id = key.split('|')[1];
                    $scope.selectedItem = $.extend(true, {}, $scope.items[product_id]);
                    $scope.initForCustomOrder();
                    $scope.customItem.taste = 6;
                    if(orderedItem.custom){
                        $scope.customItem = $.extend(true, $scope.customItem, orderedItem.custom);;
                        if ($scope.customItem.subItems) {
                            for (var sub_product_id in $scope.customItem.subItems) {
                                $scope.addFruit(sub_product_id, false);
                            }
                            $scope.getPrice();
                        }
                    }
                    $scope.customItem.numberOfItems = orderedItem.quantity;
                    if ($scope.selectedItem.free_choice == 1 && $scope.selectedItem.enabled) {
                        $scope.selectedStep = 2;
                        $('#fruit-free-choices-modal').modal();
                    } else if ($scope.selectedItem.is_box == 1) {
                        delete $scope.customBoxItems;
                        $scope.customBoxItems = {};
                        if (typeof $scope.orderedBoxes[product_id] != "undefined") {
                            for (var box_item_id in $scope.orderedBoxes[product_id]) {
                                $scope.addCustomBoxItem(box_item_id, $scope.orderedBoxes[product_id][box_item_id].quantity);
                            }
                        }
                        /*
                        for(var i in $scope.selectedItem.box_items){
                            if($scope.selectedItem.box_items[i]['item_id'])
                                $scope.addCustomBoxItem($scope.selectedItem.box_items[i]['item_id'], $scope.selectedItem.box_items[i]['amount']);
                        }
                        */
                        $('#fruit-box-modal').modal();
                    }
                    else
                        $('#view-product-modal').modal();
                    $scope.editingKey = key;
                };
                $scope.addExtra = function(sub_product_id, $event){
                    if($($event.currentTarget).is(':checked')){
                        $scope.addFruit(sub_product_id, $event);
                    }else{
                        $scope.removeFruit(sub_product_id, $event);
                    }
                    $scope.getPrice();
                };
                $scope.addFruit = function(sub_product_id, $event){
                    if ($scope.customItem.subItems[sub_product_id] == 1)
                        return true;

                    if($scope.customItem.useBottle == 1 || (sub_product_id == 247 && Object.keys($scope.customItem.subItems).length)){
                        if($event && $($event.currentTarget).is('input'))
                            $($event.currentTarget).prop('checked', false);
                        showAlertError($scope.__('Bạn không thể sử dụng thành phần khác cùng với chai thủy tinh'));
                        return;
                    }

                    if ($scope.selectedItem.sub_products[sub_product_id].price == 0){

                        if($scope.selectedItem.free_choice == 1){
                            if ($scope.customItem.numberOfSubItems >= $scope.maxItems && $scope.selectedItem.sub_products[sub_product_id].type != 'topping'){
                                if($event && $($event.currentTarget).is('input'))
                                    $($event.currentTarget).prop('checked', false);
                                showAlertError($scope.__('Để được phục vụ tốt nhất, vui lòng chỉ chọn 5 loại trái cây yêu thích. Hoặc chọn phần đầy đủ, ghi chú lại 1 đến 2 loại ko lấy.'));
                                return;
                            }
                        }

                        if (typeof $scope.customItem.subItems[sub_product_id] == 'undefined'){
                            $scope.customItem.subItems[sub_product_id] = 0;
                        }
                        $scope.customItem.subItems[sub_product_id] += 1;
                        if ($scope.selectedItem.sub_products[sub_product_id].type != 'topping')
                            $scope.customItem.numberOfSubItems++;

                    }else{
                        $scope.customItem.subItems[sub_product_id] = 1;
                    }

                    /* Bottle code for smoothies */
                    if(sub_product_id == 247){
                        $scope.customItem.useBottle = 1;
                    }
                };
                $scope.removeFruit = function(sub_product_id){
                    if (typeof $scope.customItem.subItems[sub_product_id] == 'undefined' ||
                        $scope.customItem.subItems[sub_product_id] == 0){
                        return;
                    }
                    $scope.customItem.subItems[sub_product_id] -= 1;
                    if($scope.customItem.subItems[sub_product_id] == 0)
                        delete $scope.customItem.subItems[sub_product_id];
                    if ($scope.selectedItem.sub_products[sub_product_id].price == 0 && $scope.selectedItem.sub_products[sub_product_id].type != 'topping')
                        $scope.customItem.numberOfSubItems--;
                    if ($scope.customItem.numberOfSubItems < 0)
                        $scope.customItem.numberOfSubItems = 0;

                    if(sub_product_id == 247){
                        $scope.customItem.useBottle = 0;
                    }
                };
                $scope.getPrice = function(){
                    if ($scope.selectedItem.promotion_price > 0)
                        var itemPrice = $scope.selectedItem.promotion_price;
                    else
                        var itemPrice = $scope.selectedItem.price;
                    $scope.customItem.price = parseInt(itemPrice);
                    for(var id in $scope.customItem.subItems){
                        if($scope.customItem.subItems[id] > 0)
                            $scope.customItem.price += parseInt($scope.selectedItem.sub_products[id].price);
                    }
                    for(var i in $scope.customItem.extraItems){
                        $scope.customItem.price += parseInt($scope.selectedItem.sub_products[$scope.customItem.extraItems[i]].price);
                    }
                };
                $scope._preSelectedItemToCart = function () {
                    var key = '';
                    if($scope.editingKey){
                        key = $scope.editingKey;
                        $scope.orderedItems[key].quantity = $scope.customItem.numberOfItems;
                        if ($scope.orderedItems[key].promotion_price > 0)
                            $scope.orderedItems[key]['final_price'] = $scope.orderedItems[key].promotion_price;
                        else
                            $scope.orderedItems[key]['final_price'] = $scope.orderedItems[key].price;
                        /* Reset sub items */
                        $scope.orderedItems[key].selected_sub_products = {};
                        $scope.orderedItems[key].total_selected_sub = 0;
                        $scope.orderedItems[key].custom = '';
                        if (typeof $scope.customItem != 'undefined' && $scope.customItem.price > 0){
                            $scope.orderedItems[key].custom = $.extend(true, {}, $scope.customItem);
                            /* If fruit box, using box total as final price */
                            if($scope.orderedItems[key].is_box)
                                $scope.orderedItems[key].final_price = $scope.customItem.boxTotal;
                        }
                    }else{
                        key = $scope.addItem($scope.selectedItem.product_id, $scope.customItem.numberOfItems);
                    }
                    return key;
                };
                $scope.saveSelectedItemToCart = function(){
                    if($scope.selectedItem.free_choice == 1 && $scope.selectedItem.enabled){
                        if ($scope.customItem.useAllFruit == 0 && $scope.customItem.numberOfSubItems == 0){
                            showAlertError($scope.__('Vui lòng chọn loại trái cây bạn muốn dùng.'));
                            return;
                        }else if($scope.customItem.numberOfSubItems > $scope.maxItems){
                            showAlertError($scope.__('Để được phục vụ tốt nhất, vui lòng chỉ chọn 5 loại trái cây yêu thích. Hoặc chọn phần đầy đủ, ghi chú lại 1 đến 2 loại ko lấy.'));
                            return;
                        }
                        if ($scope.selectedStep < 2)
                        {
                            $scope.selectedStep++;
                        }
                        else if ($scope.selectedStep == 2)
                        {
                            var key = $scope._preSelectedItemToCart();

                            for(var id in $scope.customItem.subItems){
                                if ($scope.customItem.subItems[id] > 0)
                                    $scope.addSubItem(key + '_' + id);
                            }
                            for(var i in $scope.customItem.extraItems){
                                $scope.addSubItem(key + '_' + $scope.customItem.extraItems[i]);
                            }
                            if($scope.customItem.toppingItem){
                                $scope.addSubItem(key + '_' + $scope.customItem.toppingItem);
                            }
                            $('#fruit-free-choices-modal').modal('hide');
                            $scope.shakeCart('', $('#cupcontainer'));
                        }
                    }else{
                        var key = $scope._preSelectedItemToCart();

                        if($scope.selectedItem.is_box == 1){
                            if ($scope.editingKey) {
                                /* Reset box items */
                                $scope.orderedBoxes[$scope.selectedItem.product_id] = {};
                            }
                            for(var i in $scope.customBoxItems){
                                $scope.addBoxItem($scope.selectedItem.product_id, $scope.customBoxItems[i]);
                            }
                            $('#fruit-box-modal').modal('hide');
                            $scope.shakeCart('', $('#fruit-box-modal .product-image'));
                        }else{
                            for(var id in $scope.customItem.subItems){
                                if ($scope.customItem.subItems[id] > 0)
                                    $scope.addSubItem(key + '_' + id);
                            }
                            for(var i in $scope.customItem.extraItems){
                                $scope.addSubItem(key + '_' + $scope.customItem.extraItems[i]);
                            }
                            $('#view-product-modal').modal('hide');
                            $scope.shakeCart('', $('#view-product-modal .product-image'));
                        }
                    }
                    $scope.editingKey = false;
                };
                $scope.addBoxItem = function(box_id, item) {
                    if ($scope.items[box_id].enabled == 0)
                        return '';
                    if (typeof item.quantity == 'undefined' || !item.quantity)
                        item.quantity = 1;
                    if(typeof $scope.orderedBoxes[box_id] == 'undefined')
                        $scope.orderedBoxes[box_id] = {};
                    if(typeof $scope.orderedBoxes[box_id][item.product_id] != 'undefined'){
                        delete $scope.orderedBoxes[box_id][item.product_id];
                    }
                    $scope.orderedBoxes[box_id][item.product_id] = {
                        'quantity': item.quantity,
                        'price': item.price,
                        'unit': item.unit
                    };
                };
                $scope.checkShippingFee = function(){
                    var params = {action: 'is_free_ship'};
                    if (typeof $scope.customer.booker_mobile != 'undefined')
                        params['mobile'] = $scope.customer.booker_mobile;
                    else
                        params['mobile'] = $scope.customer.mobile;
                    $.post(postback_url, params, function(data){
                        if (data.status == 'OK'){
                            if (data.free_ship)
                                $scope.customer.free_ship = 1;
                            else
                                $scope.customer.free_ship = 0;
                            $scope.$apply();
                        }else{
                            showAlertError(data.message);
                        }
                    },"json");
                };
                $scope.preSelectedStep = function(){
                    $scope.selectedStep--;
                    if ($scope.selectedStep < 1)
                        $scope.selectedStep = 1;
                };
                $scope.goSecondStep = function(full_fruit){
                    $scope.customItem.useAllFruit = full_fruit;
                    $scope.selectedStep = 2;
                };
                $scope.bindMultiSelect = function(){
                    $('select.normal-choices.multiple').not('.hidden').multiselect("destroy");
                    $('select.normal-choices.multiple').not('.hidden').multiselect({
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
                                        if (i > 0){
                                            label = label.substring(0, i-1);
                                        }
                                        selected += label + ', ';
                                    });
                                    return selected.substr(0, selected.length - 2) + ' <b class="caret"></b>';
                                }
                            }
                        }
                    });
                };
                $scope.checkPromotionCode = function($event){
                    if(typeof $event == 'undefined' || !$event)
                        return;
                    var currentTarget = $event.currentTarget;
                    if(!$(currentTarget).prev().is(':visible')){
                        $('.promotion_code_text').hide();
                        $('.promotion_code_input').css('display', 'inline');
                        return;
                    }

                    var promotion_code = $.trim($scope.promotion_code);
                    if (promotion_code.length == 0){
                        alert(translate('Mã không hợp lệ'));
                        return;
                    }
                    $("#loading").removeClass("hidden");
                    var params = {action: 'check_promotion_code', promotion_code: promotion_code, mobile: $scope.customer.mobile}
                    $.post(postback_url, params, function(data_return){
                        $("#loading").addClass("hidden");
                        if (data_return.status == 'OK'){
                            $scope.promotion_code_active = data_return.promotion_code;
                            $scope.discount = data_return.discount;
                            $scope.discount_description = 'Áp dụng mã khuyến mãi ' + data_return.promotion_code;
                            $scope.strings['en'][$scope.discount_description] = 'Voucher code is applied ' + data_return.promotion_code;
                            $scope.$apply(function (scope) {
                                scope.getTotals();
                            });
                            alert(translate('Mã khuyến mãi áp dụng thành công.'));
                        }else{
                            alert(translate(data_return.message));
                        }
                    },"json");
                };
                $scope.switchProductListLayout = function(layout){
                    $scope.layout = layout;
                    if(typeof prepareForLocalScroll == 'function'){
                        setTimeout(function(){
                            prepareForLocalScroll(layout==0);
                        }, 1000);
                    }

                }
            }
        });
})();