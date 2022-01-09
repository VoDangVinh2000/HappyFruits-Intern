var table_name = 'shipping';
var map = startMarker = infowindow = marker = directionsService = directionsDisplay = directionsResponse = oldAddress = '';
var newAddress = '';
var processing_branch_id = 1;
$(document).ready(function(){
    //$.validator.setDefaults({ ignore: ":hidden:not(select)" });
    $('#date_time').datepicker({
        language: 'vn',
        autoclose: true
    }).on('changeDate', function(ev) {
        var date = $('#date_time').val();
        var params = {action: 'load_orders_for_adding_shipping_record', date: date};
        blockElement('#main-wrapper');
        resetForm();
        $.post(postback_url, params, function(data){
            if (data.status == 'OK'){
                if(data.customers){
                    customers = data.customers;
                    attachCustomerData();
                }
                unblockElement('#main-wrapper');
            }else{
                unblockElement('#main-wrapper');
                customers = null;
                attachCustomerData();
                alert(data.message);
            }
        },"json");
    });
    attachCustomerData();
    $("#frmShippingDetails #mobile").change(function(){
        var order_id = $(this).val();
        if (order_id == 0){
            resetForm();
            return;
        }
        var item = customers[order_id];
        $("#frmShippingDetails #customer").val(item.customer_name);
        $("#frmShippingDetails #customer_type_id").val(item.type_id);
        $("#frmShippingDetails #address").val(item.address);
        $("#frmShippingDetails #district").val(item.district);
        $("#frmShippingDetails #h_district").val(item.district);
        $("#frmShippingDetails #distance").val(item.distance);
        $("#frmShippingDetails #customer_id").val(item.customer_id);
        $("#frmShippingDetails #order_id").val(order_id);
        $("#frmShippingDetails #number_of_dishes").val(item.number_of_dishes);
        $("#frmShippingDetails #total").val(Math.round(item.total));
        $("#frmShippingDetails #branch_id").val(item.branch_id);
        processing_branch_id = item.branch_id;
        if (map){
            map.setCenter(getBranchLatLng());
            startMarker.setPosition(getBranchLatLng());
        }

        if (item.lat && item.lng)
        {
            $("#frmShippingDetails #lat").val(item.lat);
            $("#frmShippingDetails #lng").val(item.lng);
            var new_point = new google.maps.LatLng(item.lat, item.lng);
            if (parseInt(item.is_locked))
                marker.setMap(null);
            else
            {
                marker.setMap(map);
                marker.setPosition(new_point);
            }
            calcRoute(getBranchLatLng(), new_point);
            var url = "http://maps.google.com/maps?f=d&saddr="+getBranchSaddr()+"&daddr="+ item.lat+","+item.lng;
            $("#view_map").attr('href', url).show();
        }
        else
        {
            window.newAddress = item.address;
            GetDistance();
        }
        $('#frmShippingDetails').validator('validate');
    });
    $('#frmShippingDetails').submit(function(){
        var mobile = $('#frmShippingDetails #mobile').val();
        if (mobile == ''){
            alert("Vui lòng chọn số điện thoại khách hàng.");
            return false;
        }
        if (!isValidForm('frmShippingDetails'))
            return false;
        
        var params = $(this).serialize();
        $("#frmShippingDetails #submit").attr('disabled', true);
        $("#frmShippingDetails #submit span").text('Đang lưu...');
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            $("#frmShippingDetails #submit").attr('disabled', false);
            $("#frmShippingDetails #submit span").text('Lưu');
            unblockElement('#main-wrapper');
            if (data.status == 'OK')
            {
                $("#frmShippingDetails #mobile").val('').trigger("chosen:updated");;
                resetForm();
                $.growl.notice({title: "Hoàn tất", message: "Thông tin giao hàng đã được lưu." });
            }
            else
                alert(data.message);
        },"json");
        return false; 
    });
    
    $('#frmShippingDetails #address').change(function(){
        var address = $.trim($(this).val());
        if (window.oldAddress != address)
        {
            window.newAddress = address;
            GetDistance();
        }
    });
    
    /*
    $('#frmShippingDetails #district').change(function(){
        GetDistance();
    });
    */
    
    $('#get_distance').click(function(e){
        e.preventDefault();
        var address = $('#frmShippingDetails #address').val();
        if (address.length)
        {
            GetDistance();
        }
        else
            alert('Vui lòng nhập địa chỉ.');
    });

    $('#branch_id').change(function(){
        processing_branch_id = $(this).val();
        var branch_point = getBranchLatLng();
        startMarker.setPosition(branch_point);
        map.setCenter(branch_point);
        calcRoute(branch_point, marker.getPosition());
    });
    
    initObj();
    initializeGmap();
});

function resetForm(){
    $("#frmShippingDetails #customer").val('');
    $("#frmShippingDetails #customer_type_id").val('');
    $("#frmShippingDetails #address").val('');
    $("#frmShippingDetails #district").val('');
    $("#frmShippingDetails #h_district").val('');
    $("#frmShippingDetails #distance").val('');
    $("#frmShippingDetails #customer_id").val('');
    $("#frmShippingDetails #order_id").val('');
    $("#view_map").attr('href', '').hide();
    $("#frmShippingDetails #number_of_dishes").val('');
    $("#frmShippingDetails #total").val('');
    $("#frmShippingDetails #description").val('');
    $("#frmShippingDetails #lat").val(default_lat);
    $("#frmShippingDetails #lng").val(default_lng);
    $("#frmShippingDetails #branch_id").val(1);
    $("#distance_calculator .distance").html('');
    $('#route_selector').html('<option value="">Chọn đường đi</option>');
    directionsService = new google.maps.DirectionsService();
    window.directionsDisplay = new google.maps.DirectionsRenderer();
    processing_branch_id = 1;
    initializeGmap();
}

function attachCustomerData(){
    var details = '';
    $('#frmShippingDetails #mobile').html('<option value=""></option><option value="0">-- Không xác định --</option>');
    if (customers){
        for (var order_id in customers) {
            details = customers[order_id];
            $('#frmShippingDetails #mobile').append('<option value="'+order_id+'">'+details.mobile+' | '+details.customer_name+' | '+details.address+'</option>')
        }
    }
    $("#frmShippingDetails #mobile").chosen('destroy');
    $("#frmShippingDetails #mobile").chosen({no_results_text: "Eh, không tìm thấy!"}); 
}

function GetDistance() {
    if (!map)
        initializeGmap();
    if (window.newAddress != window.oldAddress){
        var address = $('#frmShippingDetails #address').val();
        var district = $('#frmShippingDetails #district').val();
        if (district && address.indexOf('Quận') == -1)
            address += ', ' + district;
        if (address.indexOf('Hồ Chí Minh') == -1)
            address += ', Hồ Chí Minh';
        GetAddress(address); 
    }
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

            $('#frmShippingDetails #lat').val(latitude);
            $('#frmShippingDetails #lng').val(longitude);
            marker.setPosition(results[valid_index].geometry.location);

            var valid_address = 0;
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

            calcRoute(getBranchLatLng(), new google.maps.LatLng(latitude, longitude));
        }
    });
}

function initObj(){
    if (directionsService == '')
        directionsService = new google.maps.DirectionsService();
    if (infowindow == '')
        infowindow = new google.maps.InfoWindow({content:'<div class="popup">Xác định vị trí khách hàng..</div>'});
    if (window.directionsDisplay == '')
        window.directionsDisplay = new google.maps.DirectionsRenderer();
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
    directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            if (response.routes.length){
                var min_distance = 9999999;
                var min_route = '';
                for(var i = 0; i < response.routes.length; i++){
                    if (response.routes[i].legs[0].distance.value < min_distance){
                        min_distance = response.routes[i].legs[0].distance.value;
                        min_route = response.routes[i];
                    }
                }
                if (min_route){
                    var d = min_route.legs[0].distance.value/1000;
                    distance = d.toFixed(2);
                    $('#frmShippingDetails #distance').val(distance);
                    $('#frmShippingDetails').validator('validate');
                    $('#distance_calculator .distance').html(' - ' + distance + 'km');
                    var url = "http://maps.google.com/maps?f=d&saddr="+getBranchSaddr()+"&daddr="+ $('#frmShippingDetails #lat').val() +","+$('#frmShippingDetails #lng').val();
                    $("#frmShippingDetails #view_map").attr('href', url);
                    window.directionsResponse = response;
                    window.directionsDisplay.setDirections(window.directionsResponse);
                }
            }
            /*
            var d = response.routes[0].legs[0].distance.value/1000;
            var distance = d.toFixed(2);
            $('#frmShippingDetails #distance').val(distance);
            $('#frmShippingDetails').validator('validate');
            $('#distance_calculator .distance').html(' - ' + distance + 'km');
            var url = "http://maps.google.com/maps?f=d&saddr="+getBranchSaddr()+"&daddr="+ $('#frmShippingDetails #lat').val() +","+$('#frmShippingDetails #lng').val();
            $("#frmShippingDetails #view_map").attr('href', url);
            window.directionsResponse = response;
            
            window.directionsDisplay.setDirections(window.directionsResponse);
            $('#route_selector').html('');
            if (response.routes.length == 1)
                $('#route_selector').hide();
            else
            {
                for(var i = 0; i < response.routes.length; i++){
                    var option_lbl = response.routes[i].summary + ' - ' + response.routes[i].legs[0].distance.text;
                    var option_val = i;
                    $('#route_selector').append('<option value="'+option_val+'">'+option_lbl+'</option>')
                }
                $('#route_selector').val('0');
                $('#route_selector').change(function(){
                    var route_index = $(this).val();
                    window.directionsDisplay.setRouteIndex(parseInt(route_index));
                    distance = window.directionsResponse.routes[route_index].legs[0].distance.value/1000;
                    $('#frmShippingDetails #distance').val(distance);
                    $('#frmShippingDetails').validator('validate');
                    $('#distance_calculator .distance').html(distance + 'km');
                });
            }
            */
        }
    });
}

function initializeGmap() {
    var lat = $('#frmShippingDetails #lat').val();
    var lng = $('#frmShippingDetails #lng').val();
    
    if ($('#map_canvas>div>img[src*="StaticMapService"]').length)
    {
        $('#map_canvas').html('');
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
        icon: base_url + 'assets/images/mPin.png'
    });
    window.directionsDisplay.setMap(map);
    /* Remove A and B markers */
    directionsDisplay.setOptions( { suppressMarkers: true } );
    
    var latLng = new google.maps.LatLng(lat, lng);
    marker = new google.maps.Marker({
        position: latLng,
        title: 'Vị trí khách hàng',
        map: map,
        draggable: true
    });
    
    // Add dragging event listeners.
    google.maps.event.addListener(marker, 'dragend', function() {
        var new_point = marker.getPosition();
        $('#frmShippingDetails #lat').val(new_point.lat());
        $('#frmShippingDetails #lng').val(new_point.lng());
        calcRoute(getBranchLatLng(), new_point);
        infowindow.open(map, marker);
        setTimeout(function(){infowindow.close();}, 1000);
    });
}