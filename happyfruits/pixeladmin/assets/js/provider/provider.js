var map = infowindow = default_point = marker = '';
var table_name = 'providers';
$(document).ready(function(){
    $('input[type=checkbox]').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'icheckbox_square-blue',
        increaseArea: '20%' // optional
    });
    $('#frmProvider').submit(function(){
        if (!isValidForm('frmProvider'))
            return false;
        var params = $("#frmProvider").serialize() + '&ajax=1';
        $("#frmProvider #submit").attr('disabled', true);
        $("#frmProvider #submit span").text('Đang lưu...');
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            callbackSaveAction('frmProvider', data);
        },"json");
        return false; 
    });
    
    initializeGmap();
    $('#frmProvider #provider_address').change(function(){
        GetLocation();
    });
});

function GetLocation() {
    var geocoder = new google.maps.Geocoder();
    var address = $('#frmProvider #provider_address').val();
    if (address.indexOf('Hồ Chí Minh') == -1)
        address += ', Hồ Chí Minh';
    geocoder.geocode({ 'address': address }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();
            $('#frmProvider #lat').val(latitude);
            $('#frmProvider #lng').val(longitude);
            var new_point = new google.maps.LatLng(latitude, longitude);
            map.setCenter(new_point);
            marker.setPosition(new_point);
        }
    });
}

function initializeGmap() {
    
    if ($('#map_canvas>div>img[src*="StaticMapService"]').length)
        $('#map_canvas').html('');
    
    if (default_point == '')
        default_point = new google.maps.LatLng(default_lat, default_lng);
    if (infowindow == '')
        infowindow = new google.maps.InfoWindow({content:'<div class="popup">Xác định vị trí nhà cung cấp..</div>'});
    var lat = $('#frmProvider #lat').val();
    var lng = $('#frmProvider #lng').val();
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
        title: 'Vị trí nhà cung cấp',
        map: map,
        draggable: true
    });
    
    // Add dragging event listeners.
    google.maps.event.addListener(marker, 'dragend', function() {
        var new_point = marker.getPosition();
        $('#frmProvider #lat').val(new_point.lat());
        $('#frmProvider #lng').val(new_point.lng());
        infowindow.open(map, marker);
        setTimeout(function(){infowindow.close();}, 1000);
    });
}
