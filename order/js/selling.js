(function(){
    var is_valid = {};
    var app = angular.module('efruit', ['app.directives', 'app.filters']);
    app.controller('eFruitController', function($scope){
        //myService.init($scope);
        
        //params
        $scope.ACTIVE = 1;
        $scope.PRINTED = 2;
        $scope.STORED = 3;
        $scope.STAY_TYPE = 1; 
        $scope.TAKEAWAY_TYPE = 2;  
        $scope.DELIVERY_TYPE = 3;
        $scope.FOODY_TYPE = 8;
        $scope.GRABFOOD_TYPE = 9;

        $scope.SHIPPING_MULTIPLIER = 5;

        $scope.shipping_fees = {};
        $scope.discount_table = {};
        $scope.diff_time = 0;
        $scope.printing_label = 0;
        
        $scope.items = {};
        $scope.itemsForAutocomplete = [];
        $scope.itemsForCustomers = {};

        $scope.itemsForCompanies = {};
        
        $scope.quantityInOrderType = {};
        $scope.orders = {};
        
        $scope.current_order = {};
        $scope.current_order_type = {};
        $scope.order_types = {};
        
        $scope.discount_description = '';
        
        $scope.settings = {
            hideSoldOut: 0
        };
        $scope.empty_customer = {
            fullname: '',
            mobile: '',
            email: '',
            address: '',
            district: '',
            distance: 0,
            id: '',
            lat: '',
            lng: '',
            is_locked: '',
            free_ship: 0,
            ex_description: '',
            building: '',
            payment: '',
            exchange_points_org: 0.0,
            exchange_points: 0.0,
            new_exchange_points: 0.0
        };
        $scope.shipping = {
            active: 0,
            address: '',
            district: '',
            lat: '',
            lng: ''
        };
        var settings = getStorage('efruit-settings');
        if (settings)
            $scope.settings = settings;
        
        $scope.toggleSoldOut = function(){
            $scope.settings.hideSoldOut = !$scope.settings.hideSoldOut;
            setStorage('efruit-settings', $scope.settings);
        }
        $scope.saveOrdersToLocal = function(){
            setStorage('efruit-orders', $scope.orders);
            setStorage('efruit-quantity-in-order-types', $scope.quantityInOrderType);
        }
        $scope.getOrdersFromLocal = function(){
            var orders = getStorage('efruit-orders');
            if (orders){
                var quantityInOrderType = getStorage('efruit-quantity-in-order-types');
                if (quantityInOrderType){
                    $scope.quantityInOrderType = quantityInOrderType;
                }
                $scope.orders = orders;
            }
            $scope.setCurrentOrder();
        }
        $scope.requestData = function(params){
            var latest_update_dtm = {'product_prices': '-1', 'order_types': '-1', 'customers': '-1', 'shipping_fees': '-1'};
            /* Always load all data for selling
            var v = getStorage('efruit-version');
            if (v == window.version){
                var dtm = getStorage('latest_update_dtm');
                if (dtm){
                    for(var i in dtm){
                        if (dtm[i])
                            latest_update_dtm[i] = dtm[i];
                    }
                }
            }else{
                setStorage('efruit-version', window.version);
                setStorage('efruit-orders', 0);
            }
            */
            params['latest_update_dtm'] = latest_update_dtm;
            var start_dt = new Date().getTime();
            $.post(base_url + 'postback.php', params, function(data_return){
                if (data_return.status == 'OK'){
                    if (typeof data_return.need_to_update.product_prices != 'undefined'){
                        if (latest_update_dtm['product_prices'] != '-1'){
                            $scope.items = getStorage('product_prices_data');
                            $scope.updateProducts(data_return.products);
                            delete data_return.products;
                        }
                        latest_update_dtm['product_prices'] = data_return.need_to_update.product_prices;
                    }else{
                        $scope.items = getStorage('product_prices_data');
                        $scope.createItemsForSearch();
                    }

                    if (typeof data_return.need_to_update.order_types != 'undefined'){
                        var data = {};
                        latest_update_dtm['order_types'] = data_return.need_to_update.order_types;
                        data.order_types = data_return.order_types;
                        setStorage('order_types_data', data);
                    }else{
                        var data = getStorage('order_types_data');
                        data_return.order_types = data.order_types;
                    }

                    if (typeof data_return.need_to_update.customers != 'undefined'){
                        if (latest_update_dtm['customers'] != '-1'){
                            $scope.itemsForCustomers = getStorage('customers_data');
                            if($scope.itemsForCustomers == null)
                                $scope.itemsForCustomers = {};
                            $scope.updateCustomers(data_return.customers);
                            delete data_return.customers;
                        }
                        latest_update_dtm['customers'] = data_return.need_to_update.customers;
                    }else{
                        $scope.itemsForCustomers = getStorage('customers_data');
                        if($scope.itemsForCustomers == null)
                            $scope.itemsForCustomers = {};

                        $scope.itemsForCompanies = getStorage('companies_data');
                        if($scope.itemsForCompanies == null)
                            $scope.itemsForCompanies = {};
                    }

                    setStorage('latest_update_dtm', latest_update_dtm);
                    $scope.parseData(data_return);
                    setStorage('product_prices_data', $scope.items);
                    setStorage('customers_data', $scope.itemsForCustomers);
                    setStorage('companies_data', $scope.itemsForCompanies);
                    /*
                    $scope.itemsForCustomers = $.map($scope.itemsForCustomers, function(value, index) {
                        return [value];
                    });
                    */
                    var end_dt = new Date().getTime();
                    $scope.diff_time = end_dt - data_return['server_dtm'] + end_dt - start_dt;
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
        $scope.updateCustomers = function(customers){
            for(var key in customers){
                var item = customers[key];
                if (item.deleted == 0){
                    $scope.itemsForCustomers[item.customer_id] = {
                        value: item.customer_name,
                        label: item.mobile + ' - ' + item.customer_name + ' - ' + item.address,
                        fullname: item.customer_name,
                        address: item.address,
                        district: item.district,
                        mobile: item.mobile,
                        email: item.email,
                        lat: item.lat,
                        lng: item.lng,
                        id: item.customer_id,
                        is_locked: item.is_locked,
                        free_ship: item.free_ship,
                        ex_description: item.description,
                        building: item.building,
                        total_paid: item.total_paid,
                        number_of_order: item.number_of_order,
                        last_order_dtm: item.last_order_dtm,
                        last_note: item.last_note,
                        company_name: item.company_name,
                        company_tax_code: item.company_tax_code,
                        company_address: item.company_address,
                        exchange_points: item.exchange_points?item.exchange_points:0.0,
                    };
                }else{
                    if (typeof $scope.itemsForCustomers[item.customer_id] != 'undefined')
                        delete $scope.itemsForCustomers[item.customer_id];
                }
                $scope.itemsForCompanies[item.company_tax_code] = {
                    value: item.company_tax_code,
                    label: item.company_tax_code + ' - ' + item.company_name + "\n" + item.company_address,
                    company_name: item.company_name,
                    company_tax_code: item.company_tax_code,
                    company_address: item.company_address
                };
            }
        }
        $scope.createItemsForSearch = function(){
            for(var key in $scope.items){
                var product = $scope.items[key];
                if (!product.enabled)
                    continue;
                var category_name = product.category_name;
                var search_key = product.code + ' ' + product.category_name + ' ' + product.name + ' ' + product.category_name_without_utf8 + ' ' + product.name_without_utf8 + ' ' + product.name.replace(/\+ /g, "")+ ' ' + product.name_without_utf8.replace(/\+ /g, "");
                $scope.itemsForAutocomplete.push({value: product.code + ' ' + product.name, label: search_key, extra: product.product_id});
            }
        }
        $scope.parseData = function(data){
            var current_category_name = '';
            var current_category_id = '';
            var category_items = {};
            var counter = 0;
            if (data.products){
                for(var key in data.products){
                    var product = data.products[key];
                    if (product.enabled == 1){
                        var search_key = product.code + ' ' + product.category_name + ' ' + product.name + ' ' + product.category_name_without_utf8 + ' ' + product.name_without_utf8 + ' ' + product.name.replace(/\+ /g, "")+ ' ' + product.name_without_utf8.replace(/\+ /g, "");
                        $scope.itemsForAutocomplete.push({value: product.code + ' ' + product.name, label: search_key, extra: product.product_id});
                    }
                    $scope.items[product.product_id] = product;
                }
            }
            if (data.customers){
                for(var m in data.customers){
                    var item = data.customers[m];
                    $scope.itemsForCustomers[item.customer_id] = {
                        value: item.customer_name,
                        label: item.mobile + ' - ' + item.customer_name + ' - ' + item.address,
                        fullname: item.customer_name,
                        address: item.address,
                        district: item.district,
                        mobile: item.mobile,
                        email: item.email,
                        description: item.description,
                        lat: item.lat,
                        lng: item.lng,
                        id: item.customer_id,
                        is_locked: item.is_locked,
                        free_ship: item.free_ship,
                        ex_description: item.description,
                        building: item.building,
                        total_paid: item.total_paid,
                        number_of_order: item.number_of_order,
                        last_order_dtm: item.last_order_dtm,
                        last_note: item.last_note,
                        company_name: item.company_name,
                        company_tax_code: item.company_tax_code,
                        company_address: item.company_address,
                        exchange_points: item.exchange_points?item.exchange_points:0.0
                    };
                    $scope.itemsForCompanies[item.company_tax_code] = {
                        value: item.company_tax_code,
                        label: item.company_tax_code + ' - ' + item.company_name + "\n" + item.company_address,
                        company_name: item.company_name,
                        company_tax_code: item.company_tax_code,
                        company_address: item.company_address
                    };
                }
            }
            if (data.shipping_fees)
                $scope.shipping_fees = data.shipping_fees;

            g_shipping_fees = $scope.shipping_fees;

            if (data.discount_details){
                $scope.discount_table = data.discount_details.table;
                $scope.discount_description = data.discount_details.description;
            }
            if (data.order_types){
                $scope.order_types = data.order_types;
                for(var m in $scope.order_types){
                    $scope.orders[m] = {};
                    if (m == $scope.STAY_TYPE){
                        $scope.current_order_type = $scope.order_types[m];
                        /*
                        for(var i = 1; i <= 12; i++){
                            var index = i;
                            if (i < 10)
                                index = '0' + index;
                            $scope.newOrder('Bàn ' + index);
                        }
                        */
                    }
                }
            }
            $scope.getOrdersFromLocal();
            $scope.$apply();
            setTimeout(function(){
                $('.navbar-fixed-top').show();
                $('.container-fluid').show();
                $('.jar_loading').hide();
                initializeGmap();
            }, 1000);
        }
        $scope.setCurrentOrder = function(){
            $scope.current_order = {};
            for(var i in $scope.orders[$scope.current_order_type.id]){
                if ($scope.orders[$scope.current_order_type.id][i].created_dtm){
                    $scope.current_order = $scope.orders[$scope.current_order_type.id][i];
                    if ($scope.current_order_type)
                    break;
                } 
            }
        }
        $scope.changeOrderType = function(type_id){
            if (type_id == 0){
                /* This is for shipping fee calculator */
                $scope.current_order_type ={
                    id: 0,
                    can_prepaid: 0,
                    need_customer_details: 0,
                    price_type: 1,
                    sequence_number: 1,
                    shipping_type: 1
                }
                $scope.current_order = {};
                $scope.shipping.active = 1;
                $('.fee-details').hide();
                $('.fees-table').html('');
            }else{
                $scope.current_order_type = $scope.order_types[type_id];
                $scope.setCurrentOrder();
                $scope.shipping.active = 0;
            }
            resetRoute();
        }

        $scope.setPaymentMedthod = function(payment_code){
            $scope.current_order.payment_method = payment_code;
        }
        
        $scope._getParameters = function(){
            var params = {action: 'save_selling_order'};
            if ($scope.current_order_type.need_customer_details == 1){
                if (!$("#frmOrder").valid()){
                    for(var name in is_valid)
                    {
                        break;
                    }
                    return false;
                }
                params['customer'] = $scope.current_order.customer;
            }else if ($scope.is3rdPartyServices() || $scope.hasExchangePointProgram()){
                params['customer'] = $scope.current_order.customer;
            }
            params['order_id'] = $scope.current_order.order_id;
            params['code'] = $scope.current_order.code;
            params['ids'] = {};
            params['quantity'] = {};
            params['descriptions'] = {};
            for(var i in $scope.current_order.orderedItems){
                if ($scope.current_order.orderedItems[i])
                {
                    if ($scope.current_order.orderedItems[i].quantity){
                        params['quantity'][i] = $scope.current_order.orderedItems[i].quantity;
                        params['descriptions'][i] = $scope.current_order.orderedItems[i].description;
                        var selected_sub_product_ids = [];
                        for(var j in $scope.current_order.orderedItems[i].selected_sub_products)
                            selected_sub_product_ids.push($scope.current_order.orderedItems[i].selected_sub_products[j].product_id);
                        if (selected_sub_product_ids.length)
                            params['ids'][i] = selected_sub_product_ids;
                        else
                            params['ids'][i] = '';
                    }
                }
            }
            params['description'] = $scope.current_order.description;
            params['key'] = $scope.current_order.key;
            params['created_dtm'] = $scope.current_order.created_dtm;
            params['order_type'] = $scope.current_order_type.id;
            params['discount_amount'] = $scope.current_order.discount_amount;
            if ($scope.isPrePaid())
                params['is_prepaid'] = 1;
            else
                params['is_prepaid'] = 0;
            params['payment_method'] = $scope.current_order.payment_method;
            params['VAT'] = $scope.current_order.VAT;
            params['shipping_in'] = $scope.current_order.shipping_in;
            params['pickup_time'] = moment($scope.current_order.pickup_time, "DD/MM/YYYY HH:mm").unix();
            params['delivery_date'] = moment($scope.current_order.delivery_date, "DD/MM/YYYY HH:mm").unix();
            if ($scope.current_order.payment_method == 'pay_later' && $scope.current_order.payment_date)
                params['payment_date'] = moment($scope.current_order.payment_date, "DD/MM/YYYY HH:mm").unix();
            if ($scope.current_order.payment_method == 'other')
                params['payment_description'] = $scope.current_order.payment_description;
            params['branch_id'] = $scope.current_order.branch_id;
            if ($scope.current_order_type.id == $scope.STAY_TYPE)
                params['table_name'] = $scope.current_order.key;
            //console.log($scope.current_order);
            //console.log(params);
            return params;
        }
        
        $scope.preSaveOrder = function(callback){
            if ($scope.current_order && $scope.current_order.totalQuantity > 0){
                var params = $scope._getParameters();
                params['pre_save'] = 1;
                $.post(base_url + 'postback.php', params, function(data){
                    if (data.status == 'OK'){
                        if (typeof $scope.orders[data.order_type_id][data.key] != 'undefined'){
                            $scope.orders[data.order_type_id][data.key].order_id = data.order_id;
                            $scope.orders[data.order_type_id][data.key].code = data.code;
                            $scope.orders[data.order_type_id][data.key].seq_no = data.seq_no;
                            $scope.saveOrdersToLocal();
                            $scope.$apply();
                        }
                        if(data.customer){
                            $scope.updateCustomers(data.customer);
                        }
                        if(typeof callback == 'function')
                            callback();
                    }else{
                        alert(data.message);
                    }
                },"json");
            }
        }
        $scope.saveOrder = function(){
            if ($scope.current_order && $scope.current_order.totalQuantity > 0 && $scope.current_order.status==$scope.PRINTED){
                $scope.current_order.status = $scope.STORED;
                var params = $scope._getParameters();
                $.post(base_url + 'postback.php', params, function(data){
                    if (data.status == 'OK'){
                        $scope.quantityInOrderType[data.order_type_id]--;
                        if ($scope.quantityInOrderType[data.order_type_id] < 0)
                            $scope.quantityInOrderType[data.order_type_id] = 0;
                        delete $scope.orders[data.order_type_id][data.key];
                        $scope.saveOrdersToLocal();
                        $scope.setCurrentOrder();
                        $scope.$apply();
                    }else{
                        alert(data.message);
                    }
                },"json");
            }
        };
        $scope._setTime = function(order){
            var nowLocal = new Date();
            var now = new Date(nowLocal.getTime() - $scope.diff_time)
            var hours = now.getHours();
            if (hours < 10)
                hours = '0' + hours;
            var minutes = now.getMinutes();
            if (minutes < 10)
                minutes = '0' + minutes;
            var seconds = now.getSeconds();
            if (seconds < 10)
                seconds = '0' + seconds;
                
            order.time = hours + ":" + minutes + ":" + seconds;
            order.created_dtm = now.getTime();
        }
        $scope.newOrder = function(key){
            var order_details = {};
            order_details.seq_no = '';
            order_details.code = '';
            order_details.order_id = 0;
            order_details.branch_id = 1; /* Main branch */
            order_details.shipping_in = 0;
            //order_details.has_VAT = false;
            order_details.payment_method = 'cod';
            order_details.payment_description = '';
            order_details.payment_date = null;
            
            order_details.type = $.extend(true, {}, $scope.current_order_type);
            order_details.orderedItems = {};
            order_details.quantityInCategory = {};
            order_details.quantityOfItem = {};
            order_details.sequense = 1;
            
            order_details.subtotal = 0;
            order_details.total = 0;
            order_details.totalQuantity = 0;
            
            order_details.shipping_details = '';
            order_details.shipping_fee = 0;

            if ($scope.isFoody())
                order_details.discount_rate = 10;
            else
                order_details.discount_rate = 0.0;
            order_details.discount_amount = 0.00;
            
            order_details.is_prepaid = 0;
            order_details.payment = 0;
            order_details.change = 0;
            
            order_details.VAT = 0;
            
            order_details.customer = $.extend(true, {}, $scope.empty_customer);

            order_details.delivery_date = moment().format("DD/MM/YYYY HH:mm");
            order_details.pickup_time = moment().format("DD/MM/YYYY HH:mm");
            
            order_details.description = '';
            
            if ($scope.current_order_type.need_customer_details)
                order_details.validForShipping = 0;
            else
                order_details.validForShipping = 1;
            
            order_details.status = $scope.ACTIVE;
            
            $scope._setTime(order_details);
            
            if (typeof key == 'undefined')
                order_details.key = order_details.created_dtm;
            else{
                order_details.created_dtm = 0;
                order_details.key = key;
            }
            order_details.point_converting = 0;
                
            if (typeof $scope.orders[$scope.current_order_type.id] == 'undefined')
                $scope.orders[$scope.current_order_type.id] = {};
            $scope.orders[$scope.current_order_type.id][order_details.key] = order_details;
            $scope.current_order = order_details;
            
            if ($scope.current_order_type.id != $scope.STAY_TYPE){
                if (typeof $scope.quantityInOrderType[$scope.current_order_type.id] != 'undefined')
                    $scope.quantityInOrderType[$scope.current_order_type.id]++;
                else
                    $scope.quantityInOrderType[$scope.current_order_type.id] = 1;
            }
            resetRoute();
        }
        $scope.resetCurrentCustomer = function(){
            $scope.current_order.customer = $.extend(true, {}, $scope.empty_customer);
            $scope.getTotals();
            resetRoute();
        }
        $scope.deleteOrder = function(force){
            if (typeof force == 'undefined')
                force = 0;
            if (!force && $scope.current_order && $scope.current_order.status==$scope.ACTIVE){
                if (confirm("Bạn có chắc muốn hủy đơn hàng này?")){
                    force = 1;
                }
            }
            if (force){
                $scope.quantityInOrderType[$scope.current_order_type.id]--;
                if ($scope.quantityInOrderType[$scope.current_order_type.id] < 0)
                    $scope.quantityInOrderType[$scope.current_order_type.id] = 0;
                delete $scope.orders[$scope.current_order_type.id][$scope.current_order.key];                
                $scope.saveOrdersToLocal();
                $scope.setCurrentOrder();
            }
        }
        $scope.switchOrder = function(order){
            $scope.current_order = order;
            resetRoute();
        }
        $scope.switchTable = function(table_key){
            if (typeof $scope.orders[$scope.current_order_type.id][table_key] == 'undefined')
                $scope.newOrder(table_key);
            $scope.current_order = $scope.orders[$scope.current_order_type.id][table_key];
        }
        $scope.canModifyOrder = function(){
            if ($scope.current_order.status != $scope.PRINTED)
                return 1;
            if ($scope.current_order_type.id != $scope.STAY_TYPE && $scope.current_order_type.id != $scope.TAKEAWAY_TYPE)
                return 1;
            return 0;
        }
        $scope.blockOrder = function(){
            if (!$scope.canModifyOrder())
            {
                /* Do not allow add/edit item if printed for stay drink orders */
                alert("Không thể chỉnh sửa hóa đơn đã in.");
                return 1;
            }
            return 0;
        }
        $scope.addItem = function(product_id, quantity) {
            if ($scope.items[product_id].enabled == 0)
                return '';
                
            if ($scope.blockOrder())
                return '';
            
            if (!$scope.current_order.key){
                if ($scope.current_order_type.id == $scope.STAY_TYPE){
                    alert("Vui lòng chọn bàn.");
                    return '';
                }
                else
                    $scope.newOrder();
            }
            if (typeof quantity == 'undefined' || !quantity)
                quantity = 1;
            var item = $.extend(true, {}, $scope.items[product_id]);
            item.product_description = item.description;
            item.description = '';
            var key = '';
            if (item){
                if ($scope.current_order.created_dtm == 0){
                    $scope._setTime($scope.current_order);
                    if (typeof $scope.quantityInOrderType[$scope.STAY_TYPE] != 'undefined')
                        $scope.quantityInOrderType[$scope.STAY_TYPE]++;
                    else
                        $scope.quantityInOrderType[$scope.STAY_TYPE] = 1;
                }
                
                var key_found = '';
                for(var i in $scope.current_order.orderedItems){
                    var id = i.split('|')[1];
                    if (id == product_id){
                        existed_item = $scope.current_order.orderedItems[i];
                        if (existed_item.total_selected_sub <= 0){
                            key_found = existed_item.key;
                            break;
                        } 
                    }
                }
                if (key_found)
                {
                    var old_quantity = $scope.current_order.orderedItems[key_found].quantity;
                    $scope.current_order.orderedItems[key_found].quantity = parseFloat(old_quantity) + quantity;
                    key = key_found;
                }
                else
                {
                    var new_key = sprintf('%04d',$scope.current_order.sequense) + '|' + product_id;
                    item['key'] = new_key;
                    item['unique_key'] = sprintf('%04d',$scope.current_order.sequense) + '_' + product_id;;
                    item['quantity'] = quantity;
                    item['description'] = '';
                    item['original_price'] = item['final_price'] = item.prices[$scope.current_order_type.price_type];
                    if (item.promotion_price > 0 && $scope.current_order_type.id <= 3)
                        item['final_price'] = parseInt(item.promotion_price);
                    item['selected_sub_products'] = {};
                    item['total_selected_sub'] = 0;
                    item['label_print'] = 1;
                    $scope.current_order.orderedItems[new_key] = item;
                    $scope.current_order.sequense++;
                    key = new_key;
                }
                pushEvent('Món - Bán hàng', item.name, 'Thêm');
                pushEvent('Nhóm hàng - Bán hàng', item.category_name, item.name);
                $scope.getTotals();
                $scope.current_order.status = $scope.ACTIVE;
            }
            return key;
        };
        $scope.toggleShow = function(cat){
            cat.hide = !cat.hide;
        };
        $scope.addSubItem = function(ids){
            if ($scope.blockOrder())
                return '';
            
            var ids = ids.split('_');
            var key = ids[0];
            var sub_product_id = ids[1];
            if ($scope.current_order.orderedItems[key])
            {
                var sub_product = $scope.current_order.orderedItems[key].sub_products[sub_product_id];
                if ($scope.current_order.orderedItems[key].selected_sub_products[sub_product_id]){
                    delete $scope.current_order.orderedItems[key].selected_sub_products[sub_product_id];
                    $scope.current_order.orderedItems[key].final_price -= sub_product.price;
                    $scope.current_order.orderedItems[key].total_selected_sub--;
                    $scope.current_order.orderedItems[key].sub_products[sub_product_id]['selected'] = 0;
                }else{
                    $scope.current_order.orderedItems[key].selected_sub_products[sub_product_id] = sub_product;
                    $scope.current_order.orderedItems[key].final_price =  parseInt($scope.current_order.orderedItems[key].final_price) + parseInt(sub_product.price);
                    $scope.current_order.orderedItems[key].total_selected_sub++;
                    pushEvent('Món - Bán hàng', $scope.current_order.orderedItems[key].name, sub_product.name);
                    $scope.current_order.orderedItems[key].sub_products[sub_product_id]['selected'] = 1;
                }
                $scope.getTotals();
                $scope.current_order.status = $scope.ACTIVE;
            }
        };
        $scope.removeItem = function(product_id, one_item){
            if ($scope.blockOrder())
                return '';
            
            var need_update = 0;
            if(one_item){
                var key_found = '';
                for(var i in $scope.current_order.orderedItems){
                    var id = i.split('|')[1];
                    if (id == product_id){
                        existed_item = $scope.current_order.orderedItems[i];
                        if (existed_item.total_selected_sub <= 0){
                            key_found = existed_item.key;
                            break;
                        }   
                    }
                }
                if (key_found){
                    var quantity = $scope.current_order.orderedItems[key_found].quantity;
                    if (quantity > 1){
                        $scope.current_order.orderedItems[key_found].quantity--;
                    }else
                        delete $scope.current_order.orderedItems[key_found];
                    need_update = 1;
                }
            }else{
                if (typeof $scope.current_order.orderedItems[product_id] != 'undefined'){
                    pushEvent('Bỏ món - Bán hàng', $scope.current_order.orderedItems[product_id].category_name, $scope.current_order.orderedItems[product_id].name);
                    delete $scope.current_order.orderedItems[product_id];
                    need_update = 1;                    
                }
            }
            if (need_update){
                $scope.getTotals();
                $scope.current_order.status = $scope.ACTIVE;
            }
        };
        $scope.validateQuantity = function(key){
            if (!$scope.canModifyOrder())
                return '';
            if ($scope.current_order.orderedItems[key].quantity == '' || parseFloat($scope.current_order.orderedItems[key].quantity) <= 0)
                $scope.current_order.orderedItems[key].quantity = 1;
            $scope.getTotals();
            $scope.current_order.status = $scope.ACTIVE;
        };
        $scope.onChangeQuantity = function(key){
            if (!$scope.canModifyOrder())
                return '';
            if ($scope.current_order.orderedItems[key].quantity != '' && parseFloat($scope.current_order.orderedItems[key].quantity) > 0)
                $scope.getTotals();
        };
        $scope.getQuantityInCategory = function(category){
            return $scope.current_order.quantityInCategory[category.name];
        };
        $scope.getQuantityOfItem = function(product_id){
            return $scope.current_order.quantityOfItem[product_id];
        };
        $scope.getTotals = function(){
            var subtotal = 0;
            var total_quantity = 0;
            var quantityItems = {};
            var quantityCategories = {};
            var new_exchange_points = 0;
            for(var i in $scope.current_order.orderedItems){
                if ($scope.current_order.orderedItems[i])
                {
                    var q = Math.round($scope.current_order.orderedItems[i].quantity*100)/100.0;
                    if (q){
                        var o_price = parseInt($scope.current_order.orderedItems[i].original_price)
                        var f_price = parseInt($scope.current_order.orderedItems[i].final_price);
                        /* If no promotion */
                        if(o_price == f_price ){
                            new_exchange_points += round(q*f_price/10, 2);
                        }

                        subtotal += q*f_price;
                        total_quantity += q;
                        
                        var product_id = i.split('|')[1];
                        if (quantityItems[product_id]){
                            quantityItems[product_id] += +(quantityItems[product_id]+q).toFixed(2);
                        }else
                            quantityItems[product_id] = q;
                        
                        var category_id = $scope.current_order.orderedItems[i].category_id;
                        if (quantityCategories[category_id])
                            quantityCategories[category_id] = +(quantityCategories[category_id]+q).toFixed(2);
                        else
                            quantityCategories[category_id] = q;
                    }else
                        $scope.current_order.orderedItems[i].quantity = '';
                }
            }
            $scope.current_order.subtotal = subtotal;
            $scope.current_order.total = subtotal;
            /*
            $scope.current_order.discount_amount = 0;
            if ($scope.discount_table){
                for(var d in $scope.discount_table){
                    var min = parseInt(d);
                    if (subtotal >= min){
                        var discount_val = parseFloat($scope.discount_table[d]);
                        if (discount_val < 1){
                            $scope.current_order.discount_rate = discount_val*100;
                            $scope.current_order.discount_amount = parseFloat(subtotal*discount_val).toFixed(3);
                        }else{
                            $scope.current_order.discount_amount = discount_val;
                            $scope.current_order.discount_rate = parseFloat(discount_val/subtotal*100).toFixed(2);
                        }
                        $scope.current_order.total -= $scope.current_order.discount_amount;
                        $scope.current_order.discount_rate = $scope.current_order.discount_rate.toFixed(2);
                        break;
                    }
                }
            }
            */
            if($scope.current_order.point_converting){
                if($scope.current_order.customer.exchange_points <= 30){
                    $scope.current_order.point_converting = 0;
                    $scope.current_order.discount_amount = 0;
                    $scope.current_order.discount_rate = 0;
                }else{
                    var d_amount = 0;
                    if($scope.current_order.customer.exchange_points >= subtotal){
                        d_amount = subtotal;
                        $scope.current_order.customer.exchange_points -= subtotal;
                    }else{
                        d_amount = $scope.current_order.customer.exchange_points;
                        $scope.current_order.customer.exchange_points = 0;
                    }
                    $scope.current_order.customer.exchange_points = round($scope.current_order.customer.exchange_points, 2);

                    if(d_amount){
                        $scope.current_order.discount_amount = parseFloat(d_amount).toFixed(3);
                        $scope.current_order.discount_rate = parseFloat(d_amount/subtotal*100).toFixed(2);
                        $scope.current_order.total -= $scope.current_order.discount_amount;
                        if($scope.current_order.description.indexOf('Đổi tích lũy: ') == -1){
                            if($scope.current_order.description.length)
                                $scope.current_order.description += "\n";
                            $scope.current_order.description += "Đổi tích lũy: " + d_amount + 'đ';
                        }
                    }
                    new_exchange_points = round(new_exchange_points, 2) - d_amount/10;
                }
            }else if ($scope.current_order.discount_rate > 0){
                $scope.current_order.discount_amount = parseFloat(subtotal*$scope.current_order.discount_rate/100).toFixed(3);
                $scope.current_order.total -= $scope.current_order.discount_amount;
                /* If has promotion, no exchange points will be added */
                new_exchange_points = 0;
            }

            $scope.current_order.customer.new_exchange_points = round(parseFloat($scope.current_order.customer.exchange_points) + round(new_exchange_points, 2), 2);

            if ($scope.is3rdPartyServices()){
                $scope.current_order.total += parseFloat($scope.current_order.subtotal*$scope.current_order.VAT);
            }else{
                $scope.current_order.total += parseFloat($scope.current_order.subtotal-$scope.current_order.discount_amount)*$scope.current_order.VAT;
            }
            total_quantity = Math.round(total_quantity*100)/100.0
            $scope.current_order.totalQuantity = total_quantity;
            $scope.current_order.quantityOfItem = quantityItems;
            $scope.current_order.quantityInCategory = quantityCategories;
                        
            $scope.saveOrdersToLocal();
            return [subtotal, total_quantity];
        };
        $scope.validateShipping = function(){
            $scope.current_order.minTotal = 0;
            $scope.current_order.freeShipFrom = 0;
            if (typeof $scope == 'undefined' || typeof $scope.current_order == 'undefined' || typeof $scope.current_order.customer == 'undefined'){
                $scope.current_order.validForShipping = $scope.current_order_type.need_customer_details == 0;
                return true;
            }
            var current_total = $scope.current_order.subtotal - $scope.current_order.discount_amount + ($scope.current_order.subtotal- $scope.current_order.discount_amount)*$scope.current_order.VAT;
            if ($scope.current_order_type.need_customer_details > 0){
                if (parseFloat($scope.current_order.customer.distance) <= 0){
                    $scope.current_order.validForShipping = 0;
                    $scope.current_order.shipping_fee = 0;
                    $scope.current_order.total = current_total;
                    return true;
                }else{
                    if (parseFloat($scope.current_order.customer.distance) > max_distance){
                        $scope.current_order.shipping_fee = 0;
                        $scope.current_order.validForShipping = 1;
                        $scope.current_order.total = current_total;
                        return false;
                    }
                    $scope.current_order.shipping_fee = $scope.calShippingFee(current_total);
                }
            }else{
                $scope.current_order.validForShipping = 1;
                return true;
            }    
            $scope.current_order.validForShipping = 1;
            $scope.current_order.total = current_total;
            if (!$scope.current_order.customer.free_ship || $scope.current_order_type.id != $scope.DELIVERY_TYPE)
                $scope.current_order.total += $scope.current_order.shipping_fee;

            return true;        
        };
        $scope.calShippingFee = function(amount){
            if ($scope.current_order_type.need_customer_details > 0){
                if(parseFloat($scope.current_order.customer.distance) > 0){
                    var distance = Math.ceil($scope.current_order.customer.distance);
                    var fee_table = $scope.shipping_fees;
                    var district = $scope.current_order.customer.district;

                    var shipping_fee = distance*$scope.SHIPPING_MULTIPLIER;
                    if(typeof fee_table[district] != 'undefined'){
                        for(var m in fee_table[district]){
                            if(fee_table[district][m] == 0)
                                $scope.current_order.freeShipFrom = m;
                            if (amount >= parseFloat(m)){
                                shipping_fee = fee_table[district][m];
                            }
                        }
                    }
                    return shipping_fee;
                }
            }
            return 0;
        }
        $scope.printBill = function(){
            if ($scope.current_order && $scope.current_order.totalQuantity > 0){
                if ($scope.current_order_type.need_customer_details == 1){
                    if (!$("#frmOrder").valid()){
                        for(var name in is_valid)
                        {
                            break;
                        }
                        return false;
                    }
                }
                $scope.preSaveOrder();
                $('#print_bill').attr('disabled', true);
                $('#bill_printing_datetime').html($scope.getCurrentTime());
                $('.printing').removeClass('printing_receipt');
                $('.printing').removeClass('printing_label');
                setTimeout(function(){
                    window.print();
                }, 500);
                $('#print_bill').attr('disabled', false);
                $scope.current_order.status = $scope.PRINTED;
                $scope.saveOrdersToLocal();
            }
        }
        $scope.orderDone = function(){
            if ($scope.current_order && $scope.current_order.totalQuantity > 0){
                if ($scope.current_order_type.need_customer_details == 1){
                    if (!$("#frmOrder").valid()){
                        for(var name in is_valid)
                        {
                            break;
                        }
                        return false;
                    }
                }
                $scope.preSaveOrder();
                $scope.saveOrdersToLocal();
                alert('Đã gửi!');
            }
        }
        $scope.printReceipt = function(){
            if ($scope.current_order && $scope.current_order.totalQuantity > 0){
                if ($scope.current_order_type.need_customer_details == 1){
                    if (!$("#frmOrder").valid()){
                        for(var name in is_valid)
                        {
                            break;
                        }
                        return false;
                    }
                }
                if($scope.current_order.code != ''){
                    $scope.preSaveOrder();
                    $('#receipt_printing_datetime').html($scope.getCurrentTime());
                    $('.printing').removeClass('printing_label');
                    $('.printing').addClass('printing_receipt');
                    $('#print_receipt').attr('disabled', true);
                    setTimeout(function(){
                        window.print();
                    }, 500);
                    $('#print_receipt').attr('disabled', false);
                }else{
                    $scope.preSaveOrder(function(){
                        $('#receipt_printing_datetime').html($scope.getCurrentTime());
                        $('.printing').removeClass('printing_label');
                        $('.printing').addClass('printing_receipt');
                        $('#print_receipt').attr('disabled', true);
                        setTimeout(function(){
                            window.print();
                        }, 500);
                        $('#print_receipt').attr('disabled', false);
                    });
                }

            }
        }
        $scope.printLabel = function(){
            if ($scope.current_order && $scope.current_order.totalQuantity > 0){
                if ($scope.current_order_type.need_customer_details == 1){
                    if (!$("#frmOrder").valid()){
                        for(var name in is_valid)
                        {
                            break;
                        }
                        return false;
                    }
                }
                if($scope.current_order.code != '') {
                    $('.printing .label-item').show();
                    $('.printing').addClass('printing_label');
                    $('.printing').removeClass('printing_receipt');
                    $('#print_label').attr('disabled', true);
                    $scope.printing_label = 1;
                    setTimeout(function () {
                        window.print();
                    }, 500);
                    $('#print_label').attr('disabled', false);
                }else{
                    $scope.printing_label = 1;
                    $scope.preSaveOrder(function(){
                        $('.printing .label-item').show();
                        $('.printing').addClass('printing_label');
                        $('.printing').removeClass('printing_receipt');
                        $('#print_label').attr('disabled', true);
                        setTimeout(function () {
                            window.print();
                        }, 500);
                        $('#print_label').attr('disabled', false);
                    });
                }
            }
        }
        $scope.printLabelCustom = function(unique_key){
            if ($scope.current_order && $scope.current_order.totalQuantity > 0){
                $('.printing').addClass('printing_label');
                $('.printing').removeClass('printing_receipt');
                $('#print_label').attr('disabled', true);
                $scope.printing_label = 1;
                setTimeout(function(){
                    $('.printing .label-item').hide();
                    $('.printing .label-item.' + unique_key).show();
                    if ($('.printing .label-item.' + unique_key).length == 1)
                        $('.printing .label-item.' + unique_key).css('height', '22mm');
                    window.print();
                    $('.printing .label-item.' + unique_key).css('height', '30mm');
                }, 500);
                $('#print_label').attr('disabled', false);
            }
        }

        $scope.toggleLabelPrint = function(unique_key){
            var label_print = 1;
            if (typeof $scope.current_order.orderedItems[unique_key] != 'undefined')
                if (typeof $scope.current_order.orderedItems[unique_key].label_print != 'undefined')
                    label_print = $scope.current_order.orderedItems[unique_key].label_print;

            $scope.current_order.orderedItems[unique_key]['label_print'] = label_print?0:1;
        }

        $scope.getCurrentTime = function(){
            var day_arr = ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'];
            var now = new Date();
            var date = now.getDate();
            if (date < 10)
                date = '0' + date.toString();
            var month = now.getMonth() + 1;
            if (month < 10)
                month = '0' + month.toString();
            var hour = now.getHours();
            if (hour < 10)
                hour = '0' + hour.toString();
            var minute = now.getMinutes();
            if (minute < 10)
                minute = '0' + minute.toString();
            /*
            var second = now.getSeconds();
            if (second < 10)
                second = '0' + second.toString();
            */
            var dt = day_arr[now.getDay()] + ' ' + date + '/' + month + '/' + now.getFullYear() + ' ' + hour + ':' + minute;
            return dt;
        }
        $scope.validateDiscountRate = function(){
            $scope.updateTotal(1);
            $scope.current_order.discount_amount = parseFloat($scope.current_order.discount_amount).toFixed(3);
            $scope.current_order.discount_rate = parseFloat($scope.current_order.discount_rate).toFixed(2);
        };
        $scope.validateDiscountAmount = function(){
            $scope.updateTotal(0);
            $scope.current_order.discount_amount = parseFloat($scope.current_order.discount_amount).toFixed(3);
            $scope.current_order.discount_rate = parseFloat($scope.current_order.discount_rate).toFixed(2);
        };
        $scope.updateTotal = function(update_rate){
            if ($scope.current_order.discount_rate == '' || isNaN($scope.current_order.discount_rate) 
                || $scope.current_order.discount_rate < 0 || $scope.current_order.discount_rate > 100)
                $scope.current_order.discount_rate = 0;
            if ($scope.current_order.discount_amount == '' || isNaN($scope.current_order.discount_amount) 
                || $scope.current_order.discount_amount < 0 || $scope.current_order.discount_amount > parseFloat($scope.current_order.subtotal))
                $scope.current_order.discount_amount = 0;
               
            if (update_rate){
                $scope.current_order.discount_amount = $scope.current_order.discount_rate/100*$scope.current_order.subtotal;
            }else{
                $scope.current_order.discount_rate = $scope.current_order.discount_amount/$scope.current_order.subtotal*100;
            }

            if ($scope.is3rdPartyServices()){
                var VAT_mount = parseFloat($scope.current_order.subtotal*$scope.current_order.VAT);
            }else{
                var VAT_mount = parseFloat($scope.current_order.subtotal - parseFloat($scope.current_order.discount_amount))*$scope.current_order.VAT;
            }

            $scope.current_order.total = parseFloat($scope.current_order.subtotal) + parseFloat($scope.current_order.shipping_fee) - parseFloat($scope.current_order.discount_amount) + VAT_mount;
            $scope.current_order.discount_amount = parseFloat($scope.current_order.discount_amount).toFixed(3);

            $scope.getTotals();
        };
        $scope.__ = function(text, id){
            return text;
        };
        $scope.swapTo = function(table_key){
            var current_table_key = $scope.current_order.key;
            if (typeof $scope.current_order == 'undefined' || typeof current_table_key == 'undefined' || $scope.current_order_type.id != $scope.STAY_TYPE)
                return;
            else{
                if (typeof $scope.orders[$scope.current_order_type.id][table_key] == 'undefined'){
                    $scope.orders[$scope.current_order_type.id][table_key] = $.extend(true, {}, $scope.orders[$scope.current_order_type.id][current_table_key]);
                    $scope.newOrder(current_table_key);
                }else{
                    var temp = $.extend(true, {}, $scope.orders[$scope.current_order_type.id][table_key]);
                    $scope.orders[$scope.current_order_type.id][table_key] = $.extend(true, {}, $scope.orders[$scope.current_order_type.id][current_table_key]);
                    $scope.orders[$scope.current_order_type.id][current_table_key] = $.extend(true, {}, temp);
                }
                $scope.orders[$scope.current_order_type.id][table_key].key = table_key;
                $scope.orders[$scope.current_order_type.id][current_table_key].key = current_table_key;
                $scope.current_order = $scope.orders[$scope.current_order_type.id][table_key];
            }
        }
        $scope.isFoody = function(){
            return $scope.current_order_type.id == $scope.FOODY_TYPE;
        }
        $scope.isGrabFood = function(){
            return $scope.current_order_type.id == $scope.GRABFOOD_TYPE;
        }
        $scope.is3rdPartyServices = function(){
            return $scope.isFoody();
        }
        $scope.isPrePaid = function(){
            return $scope.current_order.is_prepaid
                || $scope.current_order.payment_method == 'bank'
                || $scope.current_order.payment_method == 'shipnow'
                || $scope.current_order.payment_method == 'moca'
                || $scope.current_order.payment_method == 'zalopay'
                || $scope.current_order.payment_method == 'vnpay';
        }
        $scope.hasExchangePointProgram = function(){
            return $scope.current_order_type.id == $scope.STAY_TYPE || $scope.current_order_type.id == $scope.TAKEAWAY_TYPE;
        }
        $scope.convertPoint = function(){
            if($scope.current_order.customer.exchange_points >= 30){
                $scope.current_order.point_converting = 1;
                $scope.getTotals();
            }
        }

        $scope.undoConvertPoint = function(){
            $scope.current_order.discount_rate = 0;
            $scope.current_order.discount_amount = 0;
            $scope.current_order.point_converting = 0;
            $scope.current_order.customer.exchange_points = $scope.current_order.customer.exchange_points_org;
            $scope.getTotals();
        }

        $scope.$on("doneRender", 
            function() {
                $("#frmOrder").validate({
                    errorPlacement: function(error, element) {
                        var error_text = error.text();
                        if (error_text.indexOf('required') == -1){
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
                        }
                    }
                });
                $('select.multiple').not('.hidden').multiselect({
                    nonSelectedText: 'Chọn',
                    nSelectedText: 'loại',
                    numberDisplayed: 2,
                    onChange: function(option, checked) {
                        if ($scope.blockOrder())
                            return false;
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
                if ($('#deliverydatePicker').length && doneRenderFirstime == 0){
                    //console.log('First render');
                    doneRenderFirstime = 1;
                    $('#deliverydatePicker').datetimepicker({
                        showClose: true,
                        icons: {
                            close: 'closeText'
                        },
                        toolbarPlacement: 'bottom',
                        sideBySide: true,
                        useCurrent: false,
                        minDate: new Date($('#deliverydatePicker').attr('data-minDate')*1000),
                        maxDate: new Date($('#deliverydatePicker').attr('data-maxDate')*1000),
                        defaultDate: new Date($('#deliverydatePicker').attr('data-defaultDate')*1000),
                        enabledHours: [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22],
                        format: 'DD/MM/YYYY HH:mm'
                    }).on("dp.change", function (e) {

                    }).on("dp.hide", function (e){
                        var value = e.date.unix();
                        $scope.$apply(function (scope) {
                            $('#pickuptimePicker').data("DateTimePicker").date(moment($('#deliverydatePicker').val(), e.date._f).add(-30, 'minutes').format(e.date._f));
                            scope.current_order.pickup_time = $('#pickuptimePicker').val();
                            scope.current_order.delivery_date = $('#deliverydatePicker').val();
                        });
                    });
                    $('#pickuptimePicker').datetimepicker({
                        showClose: true,
                        icons: {
                            close: 'closeText'
                        },
                        toolbarPlacement: 'bottom',
                        sideBySide: true,
                        useCurrent: false,
                        minDate: new Date($('#pickuptimePicker').attr('data-minDate')*1000),
                        maxDate: new Date($('#pickuptimePicker').attr('data-maxDate')*1000),
                        defaultDate: new Date($('#pickuptimePicker').attr('data-defaultDate')*1000),
                        enabledHours: [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22],
                        format: 'DD/MM/YYYY HH:mm'
                    }).on("dp.change", function (e) {

                    }).on("dp.hide", function (e){
                        $scope.$apply(function (scope) {
                            $('#deliverydatePicker').data("DateTimePicker").date(moment($('#pickuptimePicker').val(), e.date._f).add(30, 'minutes').format(e.date._f));
                            scope.current_order.pickup_time = $('#pickuptimePicker').val();
                            scope.current_order.delivery_date = $('#deliverydatePicker').val();
                        });
                    });
                    $('#paymentdatePicker').datetimepicker({
                        showClose: true,
                        icons: {
                            close: 'closeText'
                        },
                        toolbarPlacement: 'bottom',
                        sideBySide: true,
                        useCurrent: false,
                        minDate: new Date($('#paymentdatePicker').attr('data-minDate')*1000),
                        maxDate: new Date($('#paymentdatePicker').attr('data-maxDate')*1000),
                        defaultDate: new Date($('#paymentdatePicker').attr('data-defaultDate')*1000),
                        enabledHours: [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22],
                        format: 'DD/MM/YYYY HH:mm'
                    }).on("dp.change", function (e) {

                    }).on("dp.hide", function (e){
                        var value = e.date.unix();
                        $scope.$apply(function (scope) {
                            scope.current_order.payment_date = $('#paymentdatePicker').val();
                        });
                    });
                }
            }
         );
         var isFirefox = typeof InstallTrigger !== 'undefined';   // Firefox 1.0+
         if (!isFirefox)
            alert('Vui lòng sử dụng trình duyệt Firefox.');
         else
            $scope.requestData({action:'get_selling_data'});
    });
    app.directive('autoCustomers', function($timeout) {
        return {
            restrict : 'A',
            require : 'ngModel',
            link : function(scope, iElement, iAttrs) {
                iElement.autocomplete({
                    source: function(request, response) {
                        var final_results = [];
                        //var results = $.ui.autocomplete.filter(scope.itemsForCustomers, request.term);
                        var results = $.ui.autocomplete.filterObject(scope.itemsForCustomers, request.term);
                        var limit = 10;
                        response(results.slice(0, limit));
                    },
                    select: function(event, ui) {
                        //$(this).val(ui.item.value);
                        //$("#frmOrder [name=mobile]").val(ui.item.mobile);
                        //$("#frmOrder [name=address]").val(ui.item.address);
                        //$("#frmOrder [name=district]").val(ui.item.district);
                        if (ui.item.lat && ui.item.lng)
                        {
                            //var url = "http://maps.google.com/maps?f=d&saddr=10.773170,106.671384&daddr="+ ui.item.lat+","+ui.item.lng;
                            //$("#frmOrder #view_map").attr('href', url);
                            scope.current_order.customer.lat = ui.item.lat;
                            scope.current_order.customer.lng = ui.item.lng;
                            if ($('#distance_calculator').hasClass('visible')){
                                var des = new google.maps.LatLng(ui.item.lat, ui.item.lng);
                                findNearestBranch(des);
                                $("#frmOrder .view_map").show();
                            }
                        }
                        if (parseInt(ui.item.mobile) == 0){
                            $('#frmOrder input[name="mobile"]').attr('minlength', 1);
                        }else{
                            $('#frmOrder input[name="mobile"]').attr('minlength', 10);
                        }
                        $('.total_paid').html(ui.item.total_paid?money_format(ui.item.total_paid*1000):0);
                        $('.number_of_order').html(ui.item.number_of_order?ui.item.number_of_order:0);
                        if (ui.item.last_order_dtm){
                            $('.last_order_dtm').html(ui.item.last_order_dtm);
                            var now = moment();
                            $('.number_of_days').html(now.diff(moment(ui.item.last_order_dtm, "DD/MM/YYYY"), 'days'));
                            var last_note = ui.item.last_note;
                            if (last_note && last_note.length)
                                $('.last_note').html(ui.item.last_note.replace(/(?:\r\n|\r|\n)/g,"<br/>"));
                            else
                                $('.last_note').html('-');
                        }else{
                            $('.last_note').html('-');
                            $('.last_order_dtm').html('-');
                            $('.number_of_days').html('~');
                        }
                        if(ui.item.exchange_points){
                            $('.total_point').html(ui.item.exchange_points);
                            scope.current_order.customer.exchange_points_org = ui.item.exchange_points;
                            scope.current_order.customer.exchange_points = ui.item.exchange_points;
                            scope.getTotals();
                        }else{
                            $('.total_point').html(0);
                            scope.current_order.customer.exchange_points = 0.0;
                        }


                        if ($('#frmOrder input[name="booker_mobile"]').length) {
                            scope.current_order.customer.booker_mobile = ui.item.mobile;
                            scope.current_order.customer.booker_fullname = ui.item.fullname;
                        } else {
                            scope.current_order.customer.mobile = ui.item.mobile;
                            scope.current_order.customer.fullname = ui.item.fullname;
                        }
                        scope.current_order.customer.email = ui.item.email;
                        scope.current_order.customer.district = ui.item.district;
                        if (ui.item.address) {
                            scope.current_order.customer.address = ui.item.address;
                            $('input[name="address"]').val(ui.item.address);
                            GetDistance();
                        }
                        scope.current_order.customer.id = ui.item.id;
                        scope.current_order.customer.is_locked = parseInt(ui.item.is_locked);
                        scope.current_order.customer.ex_description = ui.item.ex_description;
                        scope.current_order.customer.building = ui.item.building;
                        scope.current_order.customer.company_name = ui.item.company_name;
                        scope.current_order.customer.company_tax_code = ui.item.company_tax_code;
                        scope.current_order.customer.company_address = ui.item.company_address;
                        if (typeof ui.item.free_ship == 'undefined')
                            scope.current_order.customer.free_ship = 0;
                        else
                            scope.current_order.customer.free_ship = parseInt(ui.item.free_ship);
                        scope.$apply(function(){
                            scope.saveOrdersToLocal();
                            $("#frmOrder").validate();
                        });
                        return false;
                    },
                    change: function( event, ui ) {
                    }
                }).autocomplete("instance")._renderItem = function(ul, item) {
                    return $("<li class='each'>").append(item.mobile + ' - ' + item.fullname + "<br>" + item.address).appendTo(ul);
                };
        }
        };
    });
    app.directive('autoCompanies', function($timeout) {
        return {
            restrict : 'A',
            require : 'ngModel',
            link : function(scope, iElement, iAttrs) {
                iElement.autocomplete({
                    source: function(request, response) {
                        var final_results = [];
                        var results = $.ui.autocomplete.filterObject(scope.itemsForCompanies, request.term);
                        var limit = 10;
                        response(results.slice(0, limit));
                    },
                    select: function(event, ui) {
                        scope.current_order.customer.company_name = ui.item.company_name;
                        scope.current_order.customer.company_tax_code = ui.item.company_tax_code;
                        scope.current_order.customer.company_address = ui.item.company_address;
                        scope.$apply();
                        return false;
                    },
                    change: function( event, ui ) {
                    }
                }).autocomplete("instance")._renderItem = function(ul, item) {
                    return $("<li class='each'>")
                        .append(item.company_tax_code + "<br>" +
                            item.company_name + "<br>" +
                            item.company_address)
                        .appendTo(ul);
                };
            }
        };
    });
})();

/* efruit_money filter */
function money_format(input){
    if (isNaN(input) || input == 0) {
        return 0;
    } else {
        input = parseFloat(input).toFixed(0);
        input = input.toString();
        var s = '';
        for(var i = input.length - 1, j = 1; i >= 0; i--, j++)
        {
            s += input[i];
            if (j%3 == 0 && i > 0)
                s += '.';
        }
        var r = '';
        for(var i = s.length-1; i >= 0; i--)
            r += s[i];
        return r;
    };
}

function round(value, precision){
    if(typeof precision == 'undefined')
        precision = 2;
    return parseFloat(parseFloat(value).toFixed(precision));
}

function load_shift_data(shift_id)
{
    if (typeof shift_id == 'undefined')
        shift_id = '';
    var params = {action: 'load_shift_data'};
    params['shift_id'] = shift_id;
    params['branch_id'] = $('#finishShift #finish_branch').val();
    $('#finishShift .modal-body').html('Đang tải..');
    $('#agree_shift_data, #shift_id').attr('disabled', true);
    $.post(base_url + 'postback.php', params, function(data){
        if (data.status == 'OK'){
            var html = '';
            if (!data.total)
                data.total = 0;
            html += '<table class="shift_data" style="width:100%;"><tbody>';
            html += '<tr><th>Tổng bán</th><td style="width:150px;text-align:right;font-weight: bold;">'+numberFormat(data.total)+'đ</td></tr>';
            var total_payment = total_receipt = 0;
            if (data.vouchers){
                var payment_html = '';
                var receipt_html = '';
                for(i = 0; i < data.vouchers.length; i++){
                    if (data.vouchers[i].type == 'payment'){
                        payment_html += '<tr class="hidden_when_printing not-print"><td> - '+data.vouchers[i].description+'</td><td style="text-align:right;">-'+numberFormat(data.vouchers[i].amount)+'đ</td></tr>';
                        total_payment += parseFloat(data.vouchers[i].amount);
                    }else{
                        receipt_html += '<tr><td> - '+data.vouchers[i].description+'</td><td style="text-align:right;">'+numberFormat(data.vouchers[i].amount)+'đ</td></tr>';
                        total_receipt += parseFloat(data.vouchers[i].amount);
                    }
                }
                if (total_receipt){
                    html += '<tr><th>Tổng thu</th><td style="text-align:right;font-weight: bold;">'+numberFormat(total_receipt)+'đ</td></tr>';
                    html += receipt_html;
                } 
                if (total_payment){
                    html += '<tr><th>Tổng chi</th><td style="text-align:right;font-weight: bold;">-'+numberFormat(total_payment)+'đ</td></tr>';
                    html += payment_html;
                }
            }
            var final_total = parseFloat(data.total) + total_receipt - total_payment;
            html += '<tr><td colspan="2">&nbsp;</td></tr>';
            html += '<tr><th style="font-size: 120%;">Tổng tiền</th><td style="text-align:right;font-size: 120%;font-weight: bold;">'+numberFormat(final_total)+'đ</td></tr>';
            html += '</tbody></table>';
            $('#finishShift .modal-body').html(html);
            $('#finishShift .modal-header .modal-title.printing').html('Ca ' + data.shift + ' ngày ' + data.today + '<br/>' + data.branch_name);
            if (shift_id == '')
                $('#shift_id').val(data.shift);
            if (data.message)
                alert(data.message);
        }else{
            alert(data.message);
        }
        $('#agree_shift_data, #shift_id').removeAttr('disabled');
    },"json");
}

function blockButton($obj, text)
{
    $obj.find('span').html(text);
    $obj.attr('disabled', true);
}
function unblockButton($obj, text)
{
    $obj.find('span').html(text);
    $obj.removeAttr('disabled');
}

function checkLoginStatus()
{
    var params = {action: 'check_login_status'};
    $.post(base_url + 'postback.php', params, function(data){
        if (data && data.status == 'OK'){
            if (data.user){
                $('body').removeClass('anonymous');
                $('body').addClass('logged-users');
                if (data.can_modify_shift_data)
                    $('.can_modify_shift_data').show();
                else
                    $('.can_modify_shift_data').hide();
                if (!data.can_handle_vouchers_in_all_branches){
                    $('#payment_branch,#receipt_branch,#finish_branch').hide();
                }else{
                    $('#payment_branch,#receipt_branch,#finish_branch').show();
                }
                $('.user_fullname').html(data.user.fullname);
            }else{
                $('body').removeClass('logged-users');
                $('body').addClass('anonymous');
            }
        }
        setTimeout(function(){checkLoginStatus()}, 10000);
    },"json");
}

var doneRenderFirstime = 0;
var g_shipping_fees = null;
$(document).ready(function(){
    if (typeof RSA != 'undefined'){
        var $key = RSA.getPublicKey($pem);
        function encrypt(value) {
            return RSA.encrypt(value + new Date().getTime(), $key);
        }
    }
     $('#datetimepickerReceiptVoucher').datetimepicker({
        format: 'DD/MM/YYYY',
        minDate: new Date($('#datetimepickerReceiptVoucher').attr('data-minDate')*1000),
        maxDate: new Date($('#datetimepickerReceiptVoucher').attr('data-maxDate')*1000),
        defaultDate: new Date($('#datetimepickerReceiptVoucher').attr('data-defaultDate')*1000),
    });
    
    checkLoginStatus();
    $('#loginFrm #submitLogin').click(function(){
        var self = $(this);
        var params = {action: 'login'};
        params['username'] = $('#username').val();
        var pass = $('#password').val();
        if (typeof encrypt != 'undefined'){
            pass = encrypt(pass);
        }
        params['password'] = pass;
        blockButton(self, 'Đang xử lý..');
        $.post(base_url + 'postback.php', params, function(data){
            if (data.status == 'OK'){
                $('body').removeClass('anonymous');
                $('body').addClass('logged-users');
                if (data.can_modify_shift_data)
                    $('.can_modify_shift_data').show();
                else
                    $('.can_modify_shift_data').hide();
                $('#loginFromFrontend').modal('toggle');
                $('.user_fullname').html(data.user.fullname);
            }
            alert(data.message);
            unblockButton(self, 'Đăng nhập');
        },"json");
    });
    
    $('#logoutBtn').click(function(e){
        e.preventDefault();
        var params = {action: 'logout'};
        $.post(base_url + 'postback.php', params, function(data){
            if (data.status == 'OK'){
                $('body').removeClass('logged-users');
                $('body').addClass('anonymous');
            }
            alert(data.message);
        },"json");
    });
    
    $('#frmCreatePaymentVouchers #payment_type').change(function(){
        var payment_type = $(this).val();
        $('.for_p3, .for_p4, .for_p5, .for_p6, .for_p7, .for_p8, .second_level_option, #frmCreatePaymentVouchers #print_payment_voucher').hide();
        $('#frmCreatePaymentVouchers #savePaymentVoucher').show();
        $('#frmCreatePaymentVouchers #voucher_description').hide();
        $('#frmCreatePaymentVouchers #voucher_amount').val('');
        $('#frmCreatePaymentVouchers #order_code').val('');
        $('#frmCreatePaymentVouchers #product_name').val('');
        $('#frmCreatePaymentVouchers #member_id').val('');
        $('#frmCreatePaymentVouchers #reason').val('');
        $('#frmCreatePaymentVouchers #ship_type').val('');
        $('#frmCreatePaymentVouchers #other_ship').val('');
        $('#frmCreatePaymentVouchers #p8_reason').val('');
        switch(payment_type){
            case 'p1':
                $('#frmCreatePaymentVouchers #voucher_amount').val(16);
            break;
            case 'p2':
                $('#frmCreatePaymentVouchers #voucher_amount').val(5);
            break;
            case 'p3':
                $('.for_p3').show();
            break;
            case 'p4':
                $('.for_p4').show();
            break;
            case 'p5':
                $('.for_p5').show();
                $('#frmCreatePaymentVouchers #print_payment_voucher').show();
                $('#frmCreatePaymentVouchers #savePaymentVoucher').hide();
            break;
            case 'p6':
                $('.for_p6').show();
            break;
            case 'p7':
                $('.for_p7').show();
                break;
            case 'p8':
                $('.for_p8').show();
                break;
            case 'p10':
                $('#frmCreatePaymentVouchers #voucher_description').show();
            break;
        }
    });
    
    $('#frmCreatePaymentVouchers #reason').change(function(){
        $('.second_level_option').hide();
        var reason = $(this).val();
        $('.for_' + reason).show();
    });

    $('#frmCreatePaymentVouchers #ship_type').change(function(){
        $('.second_level_option').hide();
        var ship_type = $(this).val();
        $('.for_' + ship_type).show();
    });

    window.onafterprint = function(e){
        $('#frmCreatePaymentVouchers #print_payment_voucher').hide();
        $('#frmCreatePaymentVouchers #savePaymentVoucher').show();
        $('.printing .label-item').show();
        var scope = angular.element($('[ng-app]')).scope();
        scope.$apply(function(){
            scope.printing_label = 0;
        });
    };
    
    $('#frmCreatePaymentVouchers #print_payment_voucher').click(function(){
        var amount = $('#frmCreatePaymentVouchers #voucher_amount').val();
        if (isNaN(amount) || amount == '')
        {
            alert('Vui lòng nhập tổng tiền chính xác.');
            return false;
        }
        var member_id = $('#frmCreatePaymentVouchers #member_id').val();
        if (isNaN(member_id) || member_id == '')
        {
            alert('Vui lòng chọn nhân viên tạm ứng.');
            return false;
        }
        var member = $('#frmCreatePaymentVouchers #member_id option[value="'+member_id+'"]').html();
        $('.vouchers_data .member_name').html(member);
        $('.vouchers_data .amount').html(amount);
        window.print();
    });
    
    $('#frmCreatePaymentVouchers #reason').change(function(){
        var val = $(this).val();
        $('#frmCreatePaymentVouchers #voucher_description').hide();
        if (val == 'r10')
            $('#frmCreatePaymentVouchers #voucher_description').show();
    });
    
    $('#savePaymentVoucher').click(function(e){
        e.preventDefault();
        var self = $(this);
        var params = {action: 'save_voucher'};
        
        params['type'] = 'payment';
        params['branch_id'] = $('#frmCreatePaymentVouchers #payment_branch').val();

        var payment_type = $('#frmCreatePaymentVouchers #payment_type').val();
        if (payment_type == '')
        {
            alert('Vui lòng chọn loại phiếu chi.');
            return false;
        }
        params['payment_type'] = 'payment_type';
        var des = $.trim($('#frmCreatePaymentVouchers #voucher_description').val());
        switch(payment_type){
            case 'p1':
                params['description'] = 'Tiền nước';
            break;
            case 'p2':
                params['description'] = 'Chành xe';
            break;
            case 'p3':
                var reason_text = '';
                var order_code = $('#frmCreatePaymentVouchers #order_code').val();
                if (order_code == ''){
                    alert('Vui lòng nhập mã hóa đơn.');
                    return false;
                }
                var reason = $('#frmCreatePaymentVouchers #reason').val();
                if (reason == '' || (reason == 'r10' && des.length == 0)){
                    alert('Vui lòng chọn lý do hủy hóa đơn.');
                    return false;
                }
                if (reason == 'r10')
                    reason_text = des;
                else{
                    reason_text = $('#frmCreatePaymentVouchers #reason option[value="'+reason+'"]').html();
                    if (reason == 'r1'){
                        var order_code_2 = $('#frmCreatePaymentVouchers #order_code_2').val();
                        if (order_code_2 == ''){
                            alert('Vui lòng chọn mã hóa đơn trùng.');
                            return false;
                        }
                        var text_reason = $('#frmCreatePaymentVouchers #text_reason').val();
                        if (text_reason == ''){
                            alert('Vui lòng ghi lý do.');
                            return false;
                        }
                        reason_text += ' hóa đơn ' + order_code_2 + ' - ' + text_reason;
                    }else if(reason == 'r4'){
                        var member_id = $('#frmCreatePaymentVouchers #member_id').val();
                        if (isNaN(member_id) || member_id == '')
                        {
                            alert('Vui lòng chọn nhân viên đang giao.');
                            return false;
                        }
                        var member = $('#frmCreatePaymentVouchers #member_id option[value="'+member_id+'"]').html();
                        reason_text += ' - Nhân viên giao: ' + member;
                    }
                }  
                params['description'] = 'Hủy hóa đơn: ' + order_code + ' - Lý do: ' + reason_text;
            break;
            case 'p4':
                var product_name = $('#frmCreatePaymentVouchers #product_name').val();
                if (product_name == ''){
                    alert('Vui lòng nhập tên hàng hóa.');
                    return false;
                }
                var product_number = $('#frmCreatePaymentVouchers #product_number').val();
                if (product_number == ''){
                    alert('Vui lòng nhập số lượng hàng hóa (kg, thùng, hộp..)');
                    return false;
                }
                params['description'] = 'Nhập hàng: ' + product_name + ' - Số lượng ' + product_number;
            break;
            case 'p5':
                var member_id = $('#frmCreatePaymentVouchers #member_id').val();
                if (isNaN(member_id) || member_id == '')
                {
                    alert('Vui lòng chọn nhân viên tạm ứng.');
                    return false;
                }
                var member = $('#frmCreatePaymentVouchers #member_id option[value="'+member_id+'"]').html();
                params['description'] = 'Tạm ứng cho: ' + member;
                params['assigned_member_id'] = member_id;
                $('.vouchers_data .member_name').html(member);
                $('.vouchers_data .amount').html(params['amount']);
            break;
            case 'p6':
                var member_id = $('#frmCreatePaymentVouchers #member_id').val();
                if (isNaN(member_id) || member_id == '')
                {
                    alert('Vui lòng chọn nhân viên chi.');
                    return false;
                }
                var member = $('#frmCreatePaymentVouchers #member_id option[value="'+member_id+'"]').html();
                params['description'] = 'Chi thu mua - Nhân viên:  ' + member;
            break;
            case 'p7':
                var ship_type = $('#frmCreatePaymentVouchers #ship_type').val();
                if (ship_type == '')
                {
                    alert('Vui lòng chọn dịch vụ ship.');
                    return false;
                }
                var ship = $('#frmCreatePaymentVouchers #ship_type option[value="'+ship_type+'"]').html();
                if (ship_type == 's10'){
                    var other_ship = $('#frmCreatePaymentVouchers #other_ship').val();
                    if (other_ship == '')
                    {
                        alert('Vui lòng nhập dịch vụ ship.');
                        return false;
                    }
                    ship = other_ship;
                }
                var order_code = $('#order_code_3').val();
                if (order_code == ''){
                    alert('Vui lòng nhập mã hóa đơn.');
                    return false;
                }
                params['order_code'] = order_code;
                params['description'] = 'Tiền ship - Dịch vụ ' + ship + ' - Hóa đơn ' + order_code;
                break;
            case 'p8':
                var p8_reason = $('#frmCreatePaymentVouchers #p8_reason').val();
                if (p8_reason == '')
                {
                    alert('Vui lòng chọn lý do.');
                    return false;
                }
                var reason_txt = $('#frmCreatePaymentVouchers #p8_reason option[value="'+p8_reason+'"]').html();
                var order_code = $('#order_code_3').val();
                if (order_code == ''){
                    alert('Vui lòng nhập mã hóa đơn.');
                    return false;
                }
                params['order_code'] = order_code;
                params['description'] = 'Chi đơn hàng ' + order_code + ' - Lý do: ' + reason_txt;
                break;
            case 'p10':
                params['description'] = des;
            break;
        }
        params['amount'] = $('#frmCreatePaymentVouchers #voucher_amount').val();
        if (isNaN(params['amount']) || params['amount'] == '')
        {
            alert('Vui lòng nhập tổng tiền chính xác.');
            return false;
        }
        if (params['description'] == '')
        {
            alert('Vui lòng nhập nội dung.');
            return false;
        }
        params['shift_id'] = $('#payment_shift_id').val();
        blockButton(self, 'Đang lưu..');
        $.post(base_url + 'postback.php', params, function(data){
            if (data.status == 'OK'){
                $('#frmCreatePaymentVouchers #voucher_amount').val('');
                $('#frmCreatePaymentVouchers #order_code').val('');
                $('#frmCreatePaymentVouchers #product_name').val('');
                $('#frmCreatePaymentVouchers #member_id').val('');
                $('#frmCreatePaymentVouchers #reason').val('');
                $('#frmCreatePaymentVouchers #payment_type').val('').trigger('change');
                $('#frmCreatePaymentVouchers #order_code_2').val('');
                $('#frmCreatePaymentVouchers #text_reason').val('');
                $('#frmCreatePaymentVouchers #p8_reason').val('');
                if (data.message)
                    alert(data.message);
            }else{
                alert(data.message);
            }
            unblockButton(self, 'Lưu');
        },"json");
    });
    
    /* Receipt Vouchures */
    $('#frmCreateReceiptVouchers #receipt_type').change(function(){
        var receipt_type = $(this).val();
        $('.for_rt123, .for_rt45').hide();
        $('#frmCreateReceiptVouchers #voucher_description').hide();
        $('#frmCreateReceiptVouchers #voucher_amount').val('');
        $('#frmCreateReceiptVouchers #member_id').val('');
        switch(receipt_type){
            case 'rt1':
            case 'rt2':
            case 'rt3':
                $('.for_rt123').show();
            break;
            case 'rt4':
            case 'rt5':
                $('.for_rt45').show();
            break;
            case 'rt10':
                $('#frmCreateReceiptVouchers #voucher_description').show();
            break;
        }
    });
    
    $('#saveReceiptVoucher').click(function(e){
        e.preventDefault();
        var self = $(this);
        var params = {action: 'save_voucher'};
        
        params['type'] = 'receipt';
        params['branch_id'] = $('#frmCreateReceiptVouchers #receipt_branch').val();
        var receipt_type = $('#frmCreateReceiptVouchers #receipt_type').val();
        if (receipt_type == '')
        {
            alert('Vui lòng chọn loại phiếu thu.');
            return false;
        }
        params['amount'] = $('#frmCreateReceiptVouchers #voucher_amount').val();
        if (isNaN(params['amount']) || params['amount'] == '')
        {
            alert('Vui lòng nhập tổng tiền chính xác.');
            return false;
        }
        var des = $.trim($('#frmCreateReceiptVouchers #voucher_description').val());
        var rt = $('#frmCreateReceiptVouchers #receipt_type option[value="'+receipt_type+'"]').html();
        switch(receipt_type){
            case 'rt1':
            case 'rt2':
            case 'rt3':
                var member_id = $('#frmCreateReceiptVouchers #member_id').val();
                if (isNaN(member_id) || member_id == '')
                {
                    alert('Vui lòng chọn nhân viên xử lý hóa đơn.');
                    return false;
                }
                var member = $('#frmCreateReceiptVouchers #member_id option[value="'+member_id+'"]').html();
                params['description'] = rt + ' - Nhân viên: ' + member;
            break;
            case 'rt4':
            case 'rt5':
                var date = $('#frmCreateReceiptVouchers #datepicker_value').val();
                if (date == '')
                {
                    alert('Vui lòng chọn ngày.');
                    return false;
                }
                params['description'] = rt + ' - Ngày: ' + date;
            break;
            case 'rt10':
                params['description'] = des;
            break;
            default:
                params['description'] = rt;
                break;
        }
        if (params['description'] == '')
        {
            alert('Vui lòng nhập nội dung.');
            return false;
        }
        params['shift_id'] = $('#receipt_shift_id').val();
        blockButton(self, 'Đang lưu..');
        $.post(base_url + 'postback.php', params, function(data){
            if (data.status == 'OK'){
                $('#frmCreateReceiptVouchers #voucher_amount').val('');
                $('#frmCreateReceiptVouchers #member_id').val('');
                $('#frmCreateReceiptVouchers #receipt_type').val('').trigger('change');
                $('#datetimepickerReceiptVoucher').data("DateTimePicker").date(new Date($('#datetimepickerReceiptVoucher').attr('data-defaultDate')*1000));
                if (data.message)
                    alert(data.message);
            }else{
                alert(data.message);
            }
            unblockButton(self, 'Lưu');
        },"json");
    });
    
    $('#createPaymentVouchers').on('show.bs.modal', function () {
        $('body').addClass('creating-payment-vouchers');
    });
    $('#createPaymentVouchers').on('hide.bs.modal', function () {
        $('body').removeClass('creating-payment-vouchers');
    });
    
    $('#finishShift').on('show.bs.modal', function () {
        load_shift_data();
        $('body').addClass('viewing-shift-data');
    });
    $('#finishShift').on('hide.bs.modal', function () {
        $('body').removeClass('viewing-shift-data');
    });
    
    $('#agree_shift_data').click(function(e){
        e.preventDefault();
        if(confirm("Thông tin của ca sẽ được gửi cho bạn và quản lý qua email.")){
            var params = {action: 'agree_shift_data'};
            params['branch_id'] = $('#finish_branch').val();
            params['shift_id'] = $('#shift_id').val();
            $('#agree_shift_data span').html('Đang gửi..');
            $('#agree_shift_data, #finish_branch').attr('disabled', true);
            $('#agree_shift_data, #shift_id').attr('disabled', true);
            $.post(base_url + 'postback.php', params, function(data){
                $('#agree_shift_data span').html('Kết ca');
                $('#agree_shift_data, #finish_branch').removeAttr('disabled');
                $('#agree_shift_data, #shift_id').removeAttr('disabled');
                if (data.message)
                    alert(data.message);
            },"json");
        }
    });
    $('#shift_id, #finish_branch').change(function(){
        load_shift_data($('#shift_id').val());
    });

    $('#branch_id').change(function(){
        var selected_branch_id = $(this).val();
        for(var i in branches){
            if (branches[i].id == selected_branch_id){
                getDistanceFromBranch(branches[i].lat, branches[i].lng);
                break;
            }
        }
    });
});