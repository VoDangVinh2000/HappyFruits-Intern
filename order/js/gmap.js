var map = startMarker = infowindow = default_point = marker = directionsService = directionsDisplay = directionsResponse = '';
$(document).ready(function(){
    $('#get_distance').click(function(e){
        e.preventDefault();
        GetDistance();
    });
    $('#get_distance2').click(function(e){
        e.preventDefault();
        var shipping_total = $('#shipping_total').val();
        if (shipping_total.length == 0 || parseInt(shipping_total) <= 0){
            alert('Vui lòng nhập tổng đơn hàng chính xác');
            return false;
        }
        var shipping_district = $('#shipping_district').val();
        if (shipping_district.length == 0){
            alert('Vui lòng chọn quận');
            return false;
        }
        if (!map)
            initializeGmap();
        var address = $('input[name="shipping_address"]').val();
        if (address.length)
        {
            var district = $('#shipping_district').val();
            if (district && address.indexOf('Quận') == -1)
                address += ', Quận ' + district;
            if (address.indexOf('Hồ Chí Minh') == -1)
                address += ', Hồ Chí Minh';
            GetAddress2(address);
        }
        else
            alert('Vui lòng nhập địa chỉ. [E1]');
    });
    initObj();
});

function GetDistance() {
    if (!map)
        initializeGmap();
    var address = $('input[name="address"]').val();
    if (address.length)
    {
        var district = $('#district').val();
        if (district && address.indexOf('Quận') == -1)
            address += ', Quận ' + district;
        if (address.indexOf('Hồ Chí Minh') == -1)
            address += ', Hồ Chí Minh';
        GetAddress(address);
    }
    else
        alert('Vui lòng nhập địa chỉ. [E2]');
}

function GetAddress(address)
{
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'address': address }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var valid_index = -1;
            for(var i = 0; i < results.length; i++){
                var addr_components = results[i].address_components;
                for (j = 0; j < addr_components.length; ++j) {
                    if (addr_components[j].types[0] == 'administrative_area_level_2'){
                        var district = addr_components[j].long_name.replace('District', '').replace('Quận', '');
                        district = $.trim(district);
                        if ($('#district').val() == district || $('#district option:selected').attr('title') == district){
                            valid_index = i;
                            break;
                        }
                    }
                }
                if (valid_index > -1)
                    break;
            }
            if (valid_index == -1){
                valid_index = 0;
            }
            var latitude = results[valid_index].geometry.location.lat();
            var longitude = results[valid_index].geometry.location.lng();
            $('#customer_lat').val(latitude);
            $('#customer_lng').val(longitude);
            $('#customer_lat, #customer_lng').trigger('change');
            setMarkerPosition(results[valid_index].geometry.location);

            var valid_address = 0;
            $('.on-map-address').html(results[valid_index].formatted_address);
            var address_components = results[valid_index].address_components;
            for (index = 0; index < address_components.length; ++index) {
                if (address_components[index].types[0] == 'administrative_area_level_2')
                {
                    var district = address_components[index].long_name.replace('District', '').replace('Quận', '');
                    district = $.trim(district);
                    valid_address = $('#district').val() == district || $('#district option:selected').attr('title') == district;
                    break;
                }
            }
            if (!valid_address)
            {
                /* We will find the main number for address */
                var newaddress = address.split(' ');
                var street_number = newaddress[0].split('/');
                if (street_number.length >= 2)
                {
                    newaddress[0] = '';
                    GetAddress(street_number[0] + newaddress.join(' '));
                    return;
                }
            }
            findNearestBranch(new google.maps.LatLng(latitude, longitude));
        }else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
            alert('Lỗi từ google map! Vui lòng tăng giảm địa chỉ rồi thử lại.');
        }else{
            alert('Lỗi google map! Vui lòng liên hệ admin.')
        }
    });
}

function GetAddress2(address)
{
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'address': address }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var valid_index = -1;
            for(var i = 0; i < results.length; i++){
                var addr_components = results[i].address_components;
                for (j = 0; j < addr_components.length; ++j) {
                    if (addr_components[j].types[0] == 'administrative_area_level_2'){
                        var district = addr_components[j].long_name.replace('District', '').replace('Quận', '');
                        district = $.trim(district);
                        if ($('#shipping_district').val() == district || $('#shipping_district option:selected').attr('title') == district){
                            valid_index = i;
                            break;
                        }
                    }
                }
                if (valid_index > -1)
                    break;
            }
            if (valid_index == -1){
                valid_index = 0;
            }
            var latitude = results[valid_index].geometry.location.lat();
            var longitude = results[valid_index].geometry.location.lng();
            $('#shipping_lat').val(latitude);
            $('#shipping_lng').val(longitude);
            setMarkerPosition(results[valid_index].geometry.location);

            var valid_address = 0;
            $('.on-map-address').html(results[valid_index].formatted_address);
            var address_components = results[valid_index].address_components;
            for (index = 0; index < address_components.length; ++index) {
                if (address_components[index].types[0] == 'administrative_area_level_2')
                {
                    var district = address_components[index].long_name.replace('District', '').replace('Quận', '');
                    district = $.trim(district);
                    valid_address = $('#shipping_district').val() == district || $('#shipping_district option:selected').attr('title') == district;
                    break;
                }
            }
            if (!valid_address)
            {
                /* We will find the main number for address */
                var newaddress = address.split(' ');
                var street_number = newaddress[0].split('/');
                if (street_number.length >= 2)
                {
                    newaddress[0] = '';
                    GetAddress2(street_number[0] + newaddress.join(' '));
                    return;
                }
            }
            findNearestBranch(new google.maps.LatLng(latitude, longitude));
        }
    });
}

function initObj(){
    if (default_point == '')
        default_point = getBranchLatLng();
    if (directionsService == '')
        directionsService = new google.maps.DirectionsService();
    if (infowindow == '')
        infowindow = new google.maps.InfoWindow({content:'<div class="popup">Xác định vị trí của bạn..</div>'});
    if (window.directionsDisplay == '')
        window.directionsDisplay = new google.maps.DirectionsRenderer();
}

function setMarkerPosition(position){
    marker.setPosition(position);
}

function resetRoute(){
    setMarkerPosition(default_point);
    directionsDisplay.setMap(null);
    map.setCenter(default_point);
}

function calcRoute(start, end){
    //get distance
    var request = {
        origin: start,
        destination: end,
        provideRouteAlternatives: true,
        travelMode: google.maps.TravelMode.DRIVING
    };
    if (directionsService == '')
        directionsService = new google.maps.DirectionsService();
    $('#loading').removeClass('hidden');
    directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            if (response.routes.length){
                var min_distance = 9999999;
                var min_route = '';
                var route_index = 0;
                for(var i = 0; i < response.routes.length; i++){
                    if (response.routes[i].legs[0].distance.value < min_distance){
                        min_distance = response.routes[i].legs[0].distance.value;
                        min_route = response.routes[i];
                        route_index = i;
                    }
                }
                if (min_route){
                    var d = min_route.legs[0].distance.value/1000;
                    distance = d.toFixed(2);
                    $('#distance').val(distance);
                    $('#distance').trigger('change');
                    $('.distance').html(distance + 'km');
                    showFees(distance);
                    var url = "http://maps.google.com/maps?f=d&saddr="+getBranchSaddr()+"&daddr="+ $('#customer_lat').val() +","+$('#customer_lng').val();
                    $("#view_map").attr('href', url);
                    window.directionsResponse = response;
                    window.directionsDisplay.setMap(map);
                    window.directionsDisplay.setDirections(window.directionsResponse);
                    window.directionsDisplay.setRouteIndex(parseInt(route_index));
                    
                    if ($('.on-map-address').length){
                        var geocoder = new google.maps.Geocoder();
                        geocoder.geocode({ 'location': end }, function (results, status) {
                            $('.on-map-address').html(results[0].formatted_address);
                        });
                    }
                }
            }
        }
        $('#loading').addClass('hidden');
    });
}

function _moneyFormat(input) {
    if (isNaN(input) || input == 0) {
        return input;
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
    }
}

function showFees(distance){
    distance = parseFloat(distance);
    if(typeof max_distance == 'undefined')
        max_distance = 50;
    else
        max_distance = parseFloat(max_distance);
    var out_of_service_msg = '<br/>Thương lượng phí giao hàng với khách. Lấy thông tin từ dịch vụ ship.<br/>Gợi ý <span class="green-text">5000<sup>đ</sup> x '+ distance + ' ~ ' + _moneyFormat(5000*Math.ceil(distance)) + '<sup>đ</sup></span>';
    if (typeof max_distance != 'undefined' && distance > max_distance){
        $('.fee-details').show();
        $('.min_total_msg').hide();
        $('.shipping_fee').html('Thương lượng');
        $('.freeShipFrom').html('');
        $('.freeship-container').hide();
        $('.fees-table').html(out_of_service_msg);
        return false;
    }
    if (!$('.for_shipping_fee_calculator').hasClass('active')){
        $('.min_total_msg').hide();
        return false;
    }
    $('.fee-details').show();
    var current_total = $('#shipping_total').val();
    var district = $('#shipping_district').val();
    var SHIPPING_MULTIPLIER = 5;
    var freeShipFrom = 0;
    if (current_total && typeof g_shipping_fees != 'undefined'){
        distance = Math.ceil(distance);
        var shipping_fee = distance*SHIPPING_MULTIPLIER;
        if(typeof g_shipping_fees[district] != 'undefined'){
            for(var m in g_shipping_fees[district]){
                if(g_shipping_fees[district][m] == 0)
                    freeShipFrom = m;
                if (current_total >= parseFloat(m)){
                    shipping_fee = g_shipping_fees[district][m];
                }
            }
            var list = '';
            for(var m in g_shipping_fees[district]){
                if(list == '')
                    list += '<tr><td> < '+ _moneyFormat(m*1000) +'đ</td>' + '<td>[Khoảng cách] x 5.000đ</td>';
                list += '<tr><td>'+ _moneyFormat(m*1000) +'đ</td>' + '<td>'+ _moneyFormat(g_shipping_fees[district][m]*1000) +'đ</td>';
            }
        }

        if (list.length)
            $('.fees-table').html('<br/><table><tbody><tr><th>Tổng hóa đơn</th><th>Phí</th></tr>' + list + '</tbody></table>');
        else
            $('.fees-table').html(out_of_service_msg);

        $('.shipping_fee').html(_moneyFormat(shipping_fee*1000) + '<sup>đ</sup>');
        $('.freeShipFrom').html(_moneyFormat(freeShipFrom*1000) + '<sup>đ</sup>');
        $('.freeship-container').show();
        $('.min_total_msg').hide();
    }
}


function initializeGmap() {
    
    if (map){
        return;
    }
    var mapOptions = {
        zoom: 14,
        center: getBranchLatLng(),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        panControl : false,
        streetViewControl : false,
        mapTypeControl: false,
        overviewMapControl: false
    };
    map = new google.maps.Map(document.getElementById('map_canvas'),mapOptions);
    
    startMarker = new google.maps.Marker({
        position: getBranchLatLng(),
        map: map, 
        icon: base_url + 'images/mPin.png' 
    });
    
    window.directionsDisplay.setMap(map);
    /* Remove A and B markers */
    directionsDisplay.setOptions( { suppressMarkers: true } );
    
    var lat = $('#customer_lat').val();
    var lng = $('#customer_lng').val();
    var latLng = new google.maps.LatLng(lat?lat:default_lat, lng?lng:default_lng);
    marker = new google.maps.Marker({
        position: latLng,
        title: 'Vị trí của bạn',
        map: map,
        draggable: true
    });
    
    // Add dragging event listeners.
    google.maps.event.addListener(marker, 'dragend', function() {
        var new_point = marker.getPosition();
        if (!$('.for_shipping_fee_calculator').hasClass('active')) {
            $('#customer_lat').val(new_point.lat());
            $('#customer_lng').val(new_point.lng());
            $('#customer_lat, #customer_lng').trigger('change');
        }else{
            $('#shipping_lat').val(new_point.lat());
            $('#shipping_lng').val(new_point.lng());
        }
        findNearestBranch(new_point);
        infowindow.open(map, marker);
        setTimeout(function(){infowindow.close();}, 1000);
    });
}

function findNearestBranch(customerLatLng){
    var sources = [];
    for(var i in branches){
        sources.push(new google.maps.LatLng(branches[i].lat, branches[i].lng));
    }
    var service = new google.maps.DistanceMatrixService();
    service.getDistanceMatrix(
        {
            origins: sources,
            destinations: [customerLatLng],
            travelMode: google.maps.TravelMode.DRIVING
        }, callbackGetDistanceMatrix);
}

function callbackGetDistanceMatrix(response, status) {
    if (response != null && response.rows){
        var min_distance = 999999;
        var min_index = -1;
        for(var i = 0; i < response.rows.length; i++){
            var distances = response.rows[i].elements;
            for(var j = 0; j < distances.length; j++){
                var d = distances[j].distance.value;
                if (min_distance > d){
                    min_distance = d;
                    min_index = processing_branch_index = i;
                }
            }
        }
        if (min_index > -1){
            var selected_point = new google.maps.LatLng(branches[min_index].lat, branches[min_index].lng);
            $('#branch_id').val(branches[min_index].id);
            startMarker.setPosition(selected_point);
            map.setCenter(selected_point);
            calcRoute(selected_point, getCustomerPosition());
        }else{
            processing_branch_index = 0;
            $('#branch_id').val(1);
            calcRoute(getBranchLatLng(), getCustomerPosition());
        }
        setMarkerPosition(getCustomerPosition());
        $('#branch_id').trigger('change');
    }else{
        alert('Không kết nối được với Google Map. Vui lòng tải lại trang hoặc liên hệ cửa hàng qua điện thoại. Xin cám ơn.')
    }
}

function getCustomerPosition(){
    if ($('.for_shipping_fee_calculator').hasClass('active')){
        return new google.maps.LatLng(document.getElementById('shipping_lat').value, document.getElementById('shipping_lng').value);
    }
    return new google.maps.LatLng(document.getElementById('customer_lat').value, document.getElementById('customer_lng').value);
}

function getBranchLatLng(){
    if (google)
        return new google.maps.LatLng(branches[processing_branch_index].lat, branches[processing_branch_index].lng);
    return null;
}

function getBranchSaddr(){
    return branches[processing_branch_index].lat + ','+ branches[processing_branch_index].lng;
}

function getDistanceFromBranch(branch_lat, branch_lng){
    if (!map)
        initializeGmap();
    var address = $('input[name="address"]').val();
    if (address.length)
    {
        var district = $('#district').val();
        if (district && address.indexOf('Quận') == -1)
            address += ', Quận ' + district;
        if (address.indexOf('Hồ Chí Minh') == -1)
            address += ', Hồ Chí Minh';
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({ 'address': address }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var valid_index = -1;
                for(var i = 0; i < results.length; i++){
                    var addr_components = results[i].address_components;
                    for (j = 0; j < addr_components.length; ++j) {
                        if (addr_components[j].types[0] == 'administrative_area_level_2'){
                            var district = addr_components[j].long_name.replace('District', '').replace('Quận', '');
                            district = $.trim(district);
                            if ($('#district').val() == district || $('#district option:selected').attr('title') == district){
                                valid_index = i;
                                break;
                            }
                        }
                    }
                    if (valid_index > -1)
                        break;
                }
                if (valid_index == -1){
                    valid_index = 0;
                }
                var latitude = results[valid_index].geometry.location.lat();
                var longitude = results[valid_index].geometry.location.lng();
                $('#customer_lat').val(latitude);
                $('#customer_lng').val(longitude);
                $('#customer_lat, #customer_lng').trigger('change');
                setMarkerPosition(results[valid_index].geometry.location);

                var valid_address = 0;
                $('.on-map-address').html(results[valid_index].formatted_address);
                var address_components = results[valid_index].address_components;
                for (index = 0; index < address_components.length; ++index) {
                    if (address_components[index].types[0] == 'administrative_area_level_2')
                    {
                        var district = address_components[index].long_name.replace('District', '').replace('Quận', '');
                        district = $.trim(district);
                        valid_address = $('#district').val() == district || $('#district option:selected').attr('title') == district;
                        break;
                    }
                }
                if (!valid_address)
                {
                    /* We will find the main number for address */
                    var newaddress = address.split(' ');
                    var street_number = newaddress[0].split('/');
                    if (street_number.length >= 2)
                    {
                        newaddress[0] = '';
                        GetAddress(street_number[0] + newaddress.join(' '));
                        return;
                    }
                }
                var branch_point = new google.maps.LatLng(branch_lat, branch_lng);
                calcRoute(branch_point, new google.maps.LatLng(latitude, longitude));
                startMarker.setPosition(branch_point);
                map.setCenter(branch_point);
            }
        });
    }
    else
        alert('Vui lòng nhập địa chỉ. [E3]');
}