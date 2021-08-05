var map = startMarker = infowindow = default_point = marker = directionsService = directionsDisplay = directionsResponse = '';
$(document).ready(function(){    
    $('#get_distance').click(function(e){
        e.preventDefault();
        GetDistance();
    });
/*
    $('#frmOrder #customer_address').blur(function(){
        if ($(this).val())
            GetDistance();
    });
*/
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
    else{
        alert('Vui lòng nhập địa chỉ.');
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
            $('#customer_lat').val(latitude);
            $('#customer_lng').val(longitude);
            $('#customer_lat, #customer_lng').trigger('change');
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
            findNearestBranch(new google.maps.LatLng(latitude, longitude));
        }
    });
}

function initObj(){
    if (default_point == '')
        default_point = new google.maps.LatLng(default_lat, default_lng);
    if (directionsService == '')
        directionsService = new google.maps.DirectionsService();
    if (infowindow == '')
        infowindow = new google.maps.InfoWindow({content:'<div class="popup">Xác định vị trí của bạn..</div>'});
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
    $('#loading').removeClass('hidden');
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
                    $('#distance').val(distance);
                    $('#distance').trigger('change');
                    $('.distance').html(distance + 'km');
                    window.directionsResponse = response;
                    window.directionsDisplay.setMap(map);
                    window.directionsDisplay.setDirections(window.directionsResponse);
                }
            }
        }
        $('#loading').addClass('hidden');
    });
}

function initializeGmap() {
    if (map){
        return;
    }
    var mapOptions = {
        zoom: 14,
        center: default_point,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        panControl : false,
        streetViewControl : false,
        mapTypeControl: false,
        overviewMapControl: false
    };
    map = new google.maps.Map(document.getElementById('map_canvas'),mapOptions);
    
    startMarker = new google.maps.Marker({
        position: default_point, 
        map: map, 
        icon: asset_url + 'img/mPin.png' 
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
        $('#customer_lat').val(new_point.lat());
        $('#customer_lng').val(new_point.lng());
        $('#customer_lat, #customer_lng').trigger('change');
        findNearestBranch(new_point);
        infowindow.open(map, marker);
        setTimeout(function(){infowindow.close();}, 1000);
    });

    // Bind autocomplete to address input
    var autocomplete = new google.maps.places.Autocomplete(document.getElementById('customer_address'));
    // Set initial restrict to the greater list of countries.
    autocomplete.setComponentRestrictions({'country': 'VN'});

    // Specify only the data fields that are needed.
    autocomplete.setFields(
        ['address_components', 'geometry', 'icon', 'name']);

    var infowindowAuto = new google.maps.InfoWindow({content:'<div class="popup"><span id="place-address"></span></div>'});
    autocomplete.addListener('place_changed', function() {
        infowindowAuto.close();
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            $('#district').val('');
            $('#customer_lat').val('');
            $('#customer_lng').val('');
            $('#district').trigger('change');
            $('.district-container').removeClass('hidden');
            $('.district-container #district_selector').attr('required', 'required');
            window.alert("Không tìm thấy thông tin cho địa chỉ: '" + place.name + "'. Vui lòng chọn thêm quận");
            return;
        }
        $('.district-container').addClass('hidden');
        $('.district-container #district_selector').removeAttr('required');
        var address = '';
        var district = '';
        if (place.address_components) {
            var addr_components = place.address_components;
            for (j = 0; j < addr_components.length; ++j) {
                if (addr_components[j].types[0] == 'administrative_area_level_2'){
                    district = addr_components[j].long_name.replace('District', '').replace('Quận', '');
                    district = $.trim(district);
                    break;
                }
            }
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }
        if(district){
            $('#district').val(district);
            $('#district').trigger('change');
        }else{
            $('#district').val('');
            $('#district').trigger('change');
            window.alert("Google không thể lấy thông tin quận cho địa chỉ: '" + place.name + "'. Vui lòng chọn thêm quận");
            $('.district-container').addClass('hidden');
            $('.district-container #district_selector').attr('required', 'required');
        }
        $('#customer_lat').val(place.geometry.location.lat());
        $('#customer_lng').val(place.geometry.location.lng());
        $('#customer_lat, #customer_lng, #customer_address').trigger('change');
        findNearestBranch(place.geometry.location);
        infowindowAuto.setContent('<div class="popup">'+ address +'</div>');
        infowindowAuto.open(map, marker);
    });

    // Trigger search on blur
    $("#customer_address").on('blur', function() {
        if ($('.pac-item:hover').length === 0 ) {
            google.maps.event.trigger(this, 'focus', {});
            google.maps.event.trigger(this, 'keydown', {
                keyCode: 13
            });
        }
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
                    min_index = i;
                }
            }
        }
        if ((typeof is_off2 != 'undefined' && is_off2) || min_index == -1){
            $('#branch_id').val(1);
            calcRoute(default_point, getCustomerPosition());
        }else{
            var selected_point = new google.maps.LatLng(branches[min_index].lat, branches[min_index].lng);
            $('#branch_id').val(branches[min_index].id);
            startMarker.setPosition(selected_point);
            map.setCenter(selected_point);
            calcRoute(selected_point, getCustomerPosition());
        }
        setMarkerPosition(getCustomerPosition());
    }else{
        alert('Không kết nối được với Google Map. Vui lòng tải lại trang hoặc liên hệ cửa hàng qua điện thoại. Xin cám ơn.')
    }
}

function setMarkerPosition(position){
    marker.setPosition(position);
}

function getCustomerPosition(){
    return new google.maps.LatLng(document.getElementById('customer_lat').value, document.getElementById('customer_lng').value);
}
