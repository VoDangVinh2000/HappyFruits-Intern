var map = infowindow = default_point = marker = directionsService = '';
var table_name = 'customers';
$(document).ready(function(){
    $('input[type=checkbox]').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'icheckbox_square-blue',
        increaseArea: '20%' // optional
    });
    $('#frmCustomer').submit(function(){
        if (!isValidForm('frmCustomer'))
            return false;
        var params = $("#frmCustomer").serialize() + '&ajax=1';
        $("#frmCustomer #submit").attr('disabled', true);
        $("#frmCustomer #submit span").text('Đang lưu...');
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            callbackSaveAction('frmCustomer', data);
        },"json");
        return false; 
    });
    
    initializeGmap();
    $('#frmCustomer #address').change(function(){
        GetLocation();
    });
    
    $('#view_route').click(function(){
        var lat = $('#frmCustomer #lat').val();
        var lng = $('#frmCustomer #lng').val();
        var address = $('#frmCustomer #address').val().replace(/ /g, '+');
        var url = "http://maps.google.com/maps?f=d&saddr="+default_saddr+"&daddr="+ +lat+","+lng;
        window.open(url);
    });
});

function GetLocation() {
    if ($('#is_locked').is(':checked'))
        return;
    var geocoder = new google.maps.Geocoder();
    var address = $('#frmCustomer #address').val();
    if (address.indexOf('Hồ Chí Minh') == -1)
        address += ', Hồ Chí Minh';
    geocoder.geocode({ 'address': address }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();
            $('#frmCustomer #lat').val(latitude);
            $('#frmCustomer #lng').val(longitude);
            var new_point = new google.maps.LatLng(latitude, longitude);
            map.setCenter(new_point);
            marker.setPosition(new_point);
            //get distance
            var request = {
                origin: default_point,
                destination: new_point,
                travelMode: google.maps.TravelMode.DRIVING
            };
            if (directionsService == '')
                directionsService = new google.maps.DirectionsService();
            directionsService.route(request, function(response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    var d = response.routes[0].legs[0].distance.value/1000;
                    $('#frmCustomer #distance').val(d.toFixed(2));
                }
            });
        }
    });
}

function initializeGmap() {
    
    if ($('#map_canvas>div>img[src*="StaticMapService"]').length)
        $('#map_canvas').html('');
    
    if (default_point == '')
        default_point = new google.maps.LatLng(default_lat, default_lng);
    if (directionsService == '')
        directionsService = new google.maps.DirectionsService();
    if (infowindow == '')
        infowindow = new google.maps.InfoWindow({content:'<div class="popup">Xác định vị trí khách hàng..</div>'});
    var lat = $('#frmCustomer #lat').val();
    var lng = $('#frmCustomer #lng').val();
    if (lat.length == 0)
        lat = default_lat;
    if (lng.length == 0)
        lng = default_lng;
    var latLng = new google.maps.LatLng(lat, lng);
    var mapOptions = {
        zoom: 16,
        center: new google.maps.LatLng(lat, lng),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        panControl : false,
        streetViewControl : false,
        mapTypeControl: false,
        overviewMapControl: false
    };
    map = new google.maps.Map(document.getElementById('map_canvas'),mapOptions);
    marker = new google.maps.Marker({
        position: latLng,
        title: 'Vị trí khách hàng',
        map: map,
        draggable: true
    });
    
    // Add dragging event listeners.
    google.maps.event.addListener(marker, 'dragend', function() {
        if ($('#is_locked').is(':checked')){
            alert('Vị trí đang bị khóa. Vui lòng mở khóa nếu muốn thay đổi.');
            marker.setPosition(latLng);
            return false;
        }
            
        var new_point = marker.getPosition();
        $('#frmCustomer #lat').val(new_point.lat());
        $('#frmCustomer #lng').val(new_point.lng());
        
        //get distance
        var request = {
            origin: default_point,
            destination: new_point,
            travelMode: google.maps.TravelMode.DRIVING
        };
        if (directionsService == '')
            directionsService = new google.maps.DirectionsService();
        directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                var d = response.routes[0].legs[0].distance.value/1000;
                $('#frmCustomer #distance').val(d.toFixed(2));
            }
        });
        
        infowindow.open(map, marker);
        setTimeout(function(){infowindow.close();}, 1000);
    });
}
