var table_name = 'orders';
var order_ids = [];
var is_reloading = 0;
var last_update = 0;
var counter = 0;
var latlngCol = {};
var directionsService = '';
$(document).ready(function(){
    $('#reload').click(function(e){
        e.preventDefault();
        reload();
    });
    $('#filter_branch').change(function(){
        var filter_branch_id = $(this).val();
        if (filter_branch_id){
            $('tr[class*="branch_"]').hide();
            $('tr.branch_' + filter_branch_id).show();
        }else{
            $('tr[class*="branch_"]').show();
        }
    });
    $('#filter_type').change(function(){
        var filter_type_id = $(this).val();
        if (filter_type_id){
            $('tr[class*="type_"]').hide();
            $('tr.type_' + filter_type_id).show();
        }else{
            $('tr[class*="type_"]').show();
        }
    });
    $('.edit-note').click(function(e){
        e.preventDefault();
        var branch_id = $(this).attr('data-branch-id');
        $('div#note-in-text' + branch_id).addClass('hidden');
        $('#edit_note_' + branch_id).addClass('hidden');
        $('textarea#note' + branch_id).removeClass('hidden');
        $('#save_note_' + branch_id).removeClass('hidden');
    });
    $('.save-note').click(function(e){
        e.preventDefault();
        var branch_id = $(this).attr('data-branch-id');
        blockElement('.note-container');
        $.post(postback_url, {
            action: 'admin_save_note_for_processing_screen',
            note: $('#note' + branch_id).val(),
            branch_id: branch_id
        }, function(data){
            unblockElement('.note-container');
            if (data.status == 'OK'){
                $('div#note-in-text' + data.branch_id).html(data.note).removeClass('hidden');
                $('#edit_note_' + branch_id).removeClass('hidden');
                $('textarea#note' + data.branch_id).addClass('hidden');
                $('#save_note_' + data.branch_id).addClass('hidden');
            }else{
                alert(data.message);
            }
            last_update = data.last_update;
            is_reloading = counter = 0;
        },"json");
    });
    $('a.overload').click(function(e){
        e.preventDefault();
        overload($(this).attr('data-period'));
    });
    bindEvents();
    count();
});

function count(){
    counter++;
    setTimeout(function(){
        if (counter >= 10)
            reload();
        count();
    }, 1000);
}

function reload(){
    if (is_reloading)
        return;
    blockElement('#list_container');
    is_reloading = 1;
    $.post(postback_url, {action: 'admin_reload_processing_orders', last_update: last_update, make_a_ding: make_a_ding}, function(data){
        unblockElement('#list_container');
        if (data.make_a_ding == 1){
            $('#ding').get(0).play();
            console.log('play ding!');
        }
        if (data.status == 'OK'){
            if (data.html){
                $('#list_container').html(data.html);
                bindEvents();
            }
            if (data.html_notes){
                for(var i in data.notes){
                    $('#note-in-text' + i).html(data.html_notes[i]);
                }
            }
            /*
            if (data.notes){
                for(var i in data.notes){
                    $('#note' + i).val(data.notes[i]);
                }
            }
            */
        }else{
            alert(data.message);
        }
        last_update = data.last_update;
        is_reloading = counter = make_a_ding = 0;
    },"json");
}

function overload(period){
    $.post(postback_url, {action: 'admin_overload_in_period', period: period}, function(data){
        if (data.status == 'OK'){
        }else{
            alert(data.message);
        }
    },"json");
}

function bindEvents()
{
    /*
    var latlng = [];
    order_ids = [];
    $('#dataTables-orderlist tr[id]').each(function(){
        var self = $(this);
        var order_id = self.attr('id');
        if (self.find('#lat_' + order_id).length){
            var lat = self.find('#lat_' + order_id).val();
            var lng = self.find('#lng_' + order_id).val();
            latlng.push(new google.maps.LatLng(lat, lng));
            order_ids.push(order_id);
        }
    });
    if (!$.isEmptyObject(latlng)){
        var service = new google.maps.DistanceMatrixService();
        service.getDistanceMatrix(
          {
            origins: latlng,
            destinations: latlng,
            travelMode: google.maps.TravelMode.DRIVING
          }, callbackGetDistanceMatrix);
    }
    */

    $('#dataTables-orderlist tr[id]').each(function(){
        var self = $(this);
        var order_id = self.attr('id');
        if (self.find('#lat_' + order_id).length){
            var lat = self.find('#lat_' + order_id).val();
            var lng = self.find('#lng_' + order_id).val();
            latlngCol[order_id] = new google.maps.LatLng(lat, lng);
        }
    });

    $('.actions button').click(function(){
        var order_id = $(this).parent().parent().attr('id');
        var target_status = $(this).attr('data-target');
        if (!target_status)
            return;
        if (target_status == 'Completed'){
            if(!confirm('Đơn hàng đã hoàn thành?'))
                return false;
        }else if(target_status == 'In Process'){
            var parameters = {};
            parameters['action'] = 'admin_assign_order_to_branch';
            parameters['order_id'] = order_id;
            parameters['branch_id'] = $(this).parent().parent().find('.branch').val();
            parameters['in_process'] = 1;
            blockElement('#main-wrapper');
            $.post(postback_url, parameters, function(data){
                unblockElement('#main-wrapper');
                if (data.status != 'OK')
                    showAlertError(data.message);
                else
                    reload();
            },"json");
            return false;
        }
        update(table_name, order_id, 'status', target_status, reload);
    });

    $('.hide_from_list').click(function(e){
        e.preventDefault();
        if(!confirm('Bạn có chắc muốn hủy đơn hàng này khỏi danh sách?'))
            return false;
        var order_id = $(this).closest('tr').attr('id');
        update(table_name, order_id, 'status', 'Failed', reload);
    });

    $('.branch').change(function(){
        var order_id = $(this).parent().parent().attr('id');
        var branch_id = $(this).val();
        calcRoute(order_id, branch_id);
    });

    $('.shipper').change(function(){
        var order_id = $(this).parent().parent().attr('id');
        var shipper_id = $(this).val();
        update(table_name, order_id, 'shipper_id', shipper_id);
        var is_ship_service = parseInt($(this).find('option[value="'+shipper_id+'"]').attr('data-is-ship-service'));
        if (is_ship_service){
            $('#service_fee_container_' + order_id).show();
            var service_fee = $('#service_fee_' + order_id).val();
            if (service_fee.length)
                update(table_name, order_id, 'service_fee', service_fee);
        }else{
            $('#service_fee_container_' + order_id).hide();
            update(table_name, order_id, 'service_fee', 0);
        }
    });

    $('.service_fee').change(function(){
        var order_id = $(this).attr('data-order-id');
        var service_fee = $(this).val();
        if (service_fee.length)
            update(table_name, order_id, 'service_fee', service_fee);
    });

    $('.show_on_management_screen').click(function(e){
        e.preventDefault();
        var order_id = $(this).parent().parent().attr('id');
        update(table_name, order_id, 'hide_on_management_screen', 0, reload);
    });

    $('.hide_on_management_screen').click(function(e){
        e.preventDefault();
        var order_id = $(this).closest('tr').attr('id');
        update(table_name, order_id, 'hide_on_management_screen', 1, reload);
    });
    $('#filter_branch, #filter_type').trigger('change');
}

function updateBranch(order_id, branch_id, distance){
    //update(table_name, order_id, 'branch_id', branch_id, reload);
    var parameters = {};
    parameters['action'] = 'admin_assign_order_to_branch';
    parameters['order_id'] = order_id;
    parameters['branch_id'] = branch_id;
    parameters['distance'] = distance;
    blockElement('#main-wrapper');
    $.post(postback_url, parameters, function(data){
        unblockElement('#main-wrapper');
        if (data.status != 'OK')
            showAlertError(data.message);
        else
            reload();
    },"json");
}

function callbackGetDistanceMatrix(response, status) {
    if (response != null && response.rows){
        for(var i = 0; i < order_ids.length; i++){
            var results = {};
            if (typeof response.rows[i] == 'undefined')
                continue;
            var distances = response.rows[i].elements;
            for(var j = 0; j < distances.length; j++){
                var d = distances[j].distance.value;
                if (i != j){
                    results[order_ids[j]] = d;
                }
            }
            if (!$.isEmptyObject(results)){
                var sorted_keys = Object.keys(results).sort(function(a,b){return results[a]-results[b]});
                var html = '';
                for(var t = 0; t < sorted_keys.length; t++){
                    if (results[sorted_keys[t]] <= 3000)
                    html += '<br/><a target="_blank" href="'+$('tr#' + sorted_keys[t]).find('.order_code').attr('href')+'">' + $('tr#' + sorted_keys[t]).find('.order_code').html() + '</a> : ' + (results[sorted_keys[t]])/1000 + 'km';
                }
                $('tr#' + order_ids[i]).find('.nearby').html(html);
            }
            
        }
    }
}

function calcRoute(order_id, branch_id){
    console.log(typeof latlngCol[order_id]);
    if (typeof latlngCol[order_id] == 'undefined'){
        updateBranch(order_id, branch_id, -1);
        return;
    }

    //get distance
    var request = {
        origin: new google.maps.LatLng(branches[branch_id].lat, branches[branch_id].lng),
        destination: latlngCol[order_id],
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
                    updateBranch(order_id, branch_id, distance);
                }//test
            }
        }
    });
}