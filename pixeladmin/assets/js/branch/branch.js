var map = infowindow = default_point = marker = '';
var table_name = 'branches';
$(document).ready(function(){
    $('input[type=checkbox]').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'icheckbox_square-blue',
        increaseArea: '20%' // optional
    });
    $('#frmBranch').submit(function(){
        if (!isValidForm('frmBranch'))
            return false;
        var params = $("#frmBranch").serialize() + '&ajax=1';
        $("#frmBranch #submit").attr('disabled', true);
        $("#frmBranch #submit span").text('Đang lưu...');
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            callbackSaveAction('frmBranch', data);
        },"json");
        return false; 
    });

    initializeGmap();
    $('#frmBranch #branch_address').change(function(){
        GetLocation();
    });
    
    $('#view_in_large_map').click(function(){
        var lat = $('#frmBranch #lat').val();
        var lng = $('#frmBranch #lng').val();
        var url = "http://maps.google.com/maps?z=12&t=m&q=loc:"+lat+"+"+lng;
        window.open(url);
    });
});

function GetLocation() {
    var geocoder = new google.maps.Geocoder();
    var address = $('#frmBranch #branch_address').val();
    if (address.indexOf('Hồ Chí Minh') == -1)
        address += ', Hồ Chí Minh';
    geocoder.geocode({ 'address': address }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();
            $('#frmBranch #lat').val(latitude);
            $('#frmBranch #lng').val(longitude);
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
        infowindow = new google.maps.InfoWindow({content:'<div class="popup">Xác định vị trí chi nhánh..</div>'});
    var lat = $('#frmBranch #lat').val();
    var lng = $('#frmBranch #lng').val();
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
    console.log(map);
    marker = new google.maps.Marker({
        position: latLng,
        title: 'Vị trí chi nhánh',
        map: map,
        draggable: true
    });
    
    // Add dragging event listeners.
    google.maps.event.addListener(marker, 'dragend', function() {
        var new_point = marker.getPosition();
        $('#frmBranch #lat').val(new_point.lat());
        $('#frmBranch #lng').val(new_point.lng());
        infowindow.open(map, marker);
        setTimeout(function(){infowindow.close();}, 1000);
    });
}
