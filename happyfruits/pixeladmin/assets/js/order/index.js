// test

var table_name = 'orders';
var dataTableObj = '';
var startDate = endDate = '';
$(document).ready(function(){
    startDate = $('.for_datatable_filter #filter_start_date').val();
    endDate = $('.for_datatable_filter #current_date').val();
    bindEvents();
});


function search(){
    var params = getParams('admin_search_orders');
    blockElement('#main-wrapper');
    $.post(postback_url, params, function(data){
        unblockElement('#main-wrapper');
        if (data.status == 'OK')
        {
            $('#list_container').html(data.html);
            dataTableObj = '';
            bindEvents();
        }
        else
        {
            alert(data.message);
        }
    },"json");
}

function getParams(action)
{
    var params = {};
    params['action'] = action;
    params['filter_type'] = $('.dataTables_filter #filter_type').val();
    params['filter_branch'] = $('.dataTables_filter #filter_branch').val();
    params['filter_shift'] = $('.dataTables_filter #filter_shift').val();
    params['filter_start_date'] = $('.dataTables_filter #filter_start_date').val();
    params['filter_end_date'] = $('.dataTables_filter #filter_end_date').val();
    params['filter_vat'] = $('.dataTables_filter #filter_vat').val();
    return params;
}

function bindEvents()
{
    var oLanguage = $.extend(true, {}, dataTables_oLanguage);
    oLanguage['sEmptyTable'] = 'Không có đơn hàng nào.';
    if (!dataTableObj){
        dataTableObj = $('#dataTables-orderlist').dataTable({
           "aoColumnDefs": [
              { 'bSortable': false, 'aTargets': [ 8 , 9 ] }
           ],
           "columns": [
                null,
                null,
                null,
                null,
                null,
                { "orderDataType": "dom-data-numeric" },
                null,
                null,
                null,
                null
           ],
           "oLanguage": oLanguage,
            "order": [[ 5, "desc" ]]
        });
        dataTableObj.on( 'draw.dt', function () {
            bindEvents();
        } );
        
        $('.dataTables_filter #filter_search').click(function(){
            search();
        });
        $('.dataTables_filter #filter_start_date, .dataTables_filter #filter_end_date').datepicker({language: 'vn', autoclose: true});
        if ($('#min_date').length){
            $('.dataTables_filter #filter_start_date, .dataTables_filter #filter_end_date').datepicker('setStartDate', $('#min_date').val());
        }
        
        $('.dataTables_filter #filter_start_date, .dataTables_filter #filter_end_date').change(function(){
            var id = $(this).attr('id');
            var value = $(this).val();
            if (id == 'filter_start_date')
                startDate = value;
            else if(id == 'filter_end_date')
                endDate = value;
        });
        
        bindFilterInput();
        bindEventForTableFilters('.dataTables_filter #filter_type, .dataTables_filter #filter_branch, .dataTables_filter #filter_shift, .dataTables_filter #filter_vat');
        
        if ($('#number_of_records').length){
            $('.dataTables_filter span.number_of_records').html($('#number_of_records').val());
            $('.dataTables_filter span.order_total').html($('#order_total').val());
        }
    }
    
    $('.dataTables_filter #filter_start_date').datepicker('setDate', startDate);
    $('.dataTables_filter #filter_end_date').datepicker('setDate', endDate);

    $('a.delete_item').unbind('click');
    $('a.delete_item').click(function(e){
        e.preventDefault();
        if (confirm('Bạn có chắc muốn xóa đơn hàng này?')){
            deleteById(table_name, $(this).parent().parent().attr('id'), URIs[table_name]);
        }
    });
    
    $('.is_shipped').change(function(){
        var id = $(this).closest('tr').attr('id');
        var field = $(this).attr('class');
        var new_value = $(this).is(':checked')?1:0;
        update(table_name, id, field, new_value);
    });

    /*
    $('td.has_tooltip a').each(function(){
        if ($(this).next().find('p').html() == '')
            return;
        var contenthtml = $(this).parent().find('.tooltip_content').html();
        $(this).parent().tooltipster({
            content: contenthtml,
            contentAsHTML: true,
            theme: 'tooltipster-shadow',
            position: 'top'
        });
    });
    */

    $('.efruit_note').editable({
        emptytext: 'Chưa có ghi chú',
        url: postback_url,
        params: function(params) {
            //originally params contain pk, name and value
            params.action = 'admin_update_efruit_note';
            return params;
        },
        ajaxOptions: {
            dataType: 'json'
        },
        success: function(data, config){
            if (data && data.status == 'ERROR')
                alert(data.message);
        }
    });
    $('.edit-note').click(function(e) {
        e.stopPropagation();
        e.preventDefault();
        $(this).prev('.efruit_note').editable('toggle');
    });

    setLastColumnWidth();
}