var table_name = 'vouchers';
var dataTableObj = '';
var startDate = endDate = '';
$(document).ready(function(){
    startDate = $('.for_datatable_filter #filter_start_date').val();
    endDate = $('.for_datatable_filter #current_date').val();
    bindEvents();
});


function search(){
    var params = getParams('admin_search_voucher');
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
    params['filter_start_date'] = $('.dataTables_filter #filter_start_date').val();
    params['filter_end_date'] = $('.dataTables_filter #filter_end_date').val();
    params['filter_type'] = $('.dataTables_filter #filter_type').val();
    return params;
}

function bindEvents()
{
    var oLanguage = $.extend(true, {}, dataTables_oLanguage);
    oLanguage['sEmptyTable'] = 'Không có dữ liệu.';
    if (!dataTableObj){
        dataTableObj = $('#dataTables-voucherlist').dataTable({
           "aoColumnDefs": [
              { 'bSortable': false, 'aTargets': [ 6 ] }
           ],
           "columns": [
                null,
                null,
                { "orderDataType": "dom-data-numeric" },
                null,
               null,
                null
           ],
           "oLanguage": oLanguage,
           "order": [[ 0, "desc" ]]
        });
        dataTableObj.on( 'draw.dt', function () {
            bindEvents();
        } );
        
        $('.dataTables_filter #filter_search').click(function(){
            search();
        });
        
        $('.dataTables_filter #filter_start_date, .dataTables_filter #filter_end_date').datepicker({language: 'vn', autoclose: true});
        
        $('.dataTables_filter #filter_start_date, .dataTables_filter #filter_end_date').change(function(){
            var id = $(this).attr('id');
            var value = $(this).val();
            if (id == 'filter_start_date')
                startDate = value;
            else if(id == 'filter_end_date')
                endDate = value;
        });
        
        bindFilterInput();
        bindEventForTableFilters('.dataTables_filter #filter_type');
    }
    $('.dataTables_filter #filter_start_date').datepicker('setDate', startDate);
    $('.dataTables_filter #filter_end_date').datepicker('setDate', endDate);
    
    $('a.delete_item').unbind('click');
    $('a.delete_item').click(function(e){
        e.preventDefault();
        if (confirm('Bạn có chắc muốn xóa phiếu thu chi này?')){
            deleteById(table_name, $(this).parent().parent().attr('id'), URIs[table_name]);
        }
    });

    bindNumber('.amount');
    $('.amount').change(function(){
        var user_id = $(this).parent().parent().attr('id');
        var field = $(this).attr('class');
        var new_value = $(this).val();
        update(table_name, user_id, field, new_value);
    });
    //setLastColumnWidth();
}