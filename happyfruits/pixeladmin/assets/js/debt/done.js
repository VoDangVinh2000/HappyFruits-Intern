var table_name = 'debts';
var dataTableObj = '';
var startDate = endDate = '';
$(document).ready(function(){
    startDate = $('.for_datatable_filter #filter_start_date').val();
    endDate = $('.for_datatable_filter #current_date').val();
    bindEvents();

    $('#savePayment').click(function(e){
        e.preventDefault();
        blockElement('#frmPayment');
        $.post(postback_url, getParameters('#frmPayment'), function(data){
            unblockElement('#frmPayment');
            if (data.status != 'OK')
                showAlertError(data.message);
            else{
                $('#frmPaymentContainaer').modal('hide');
                search();
            }
        },"json");
    });

    addMoneyStringAlong('#paid_amount', 'float: left; margin-left: 10px; margin-top: 7px;');
});


function search(){
    var params = getParams('admin_search_debt');
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
    params['filter_provider'] = $('.dataTables_filter #filter_provider').val();
    params['is_done'] = $('#is_done').length?$('#is_done').val():0;
    return params;
}

function bindEvents()
{
    var oLanguage = $.extend(true, {}, dataTables_oLanguage);
    oLanguage['sEmptyTable'] = 'Không có dữ liệu.';
    if (!dataTableObj){
        dataTableObj = $('#dataTables-mainlist').dataTable({
            "aoColumnDefs": [
                { 'bSortable': false, 'aTargets': [ 9 ] }
            ],
            "columns": [
                { "orderDataType": "dom-data-numeric" },
                { "orderDataType": "dom-data-numeric" },
                null,
                null,
                null,
                { "orderDataType": "dom-data-numeric" },
                { "orderDataType": "dom-data-numeric" },
                null,
                null,
                null,
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
        bindEventForTableFilters('.dataTables_filter #filter_type,.dataTables_filter #filter_provider');

        if ($('#total_money').length){
            $('.dataTables_filter span.total_money').html($('#total_money').val());
        }
    }
    $('.dataTables_filter #filter_start_date').datepicker('setDate', startDate);
    $('.dataTables_filter #filter_end_date').datepicker('setDate', endDate);

    $('a.delete_item').unbind('click');
    $('a.delete_item').click(function(e){
        e.preventDefault();
        if (confirm('Bạn có chắc muốn xóa bản lưu công nợ này?')){
            deleteById(table_name, $(this).parent().parent().attr('id'), URIs[table_name]);
        }
    });

    $('a.add-payment').unbind('click');
    $('a.add-payment').click(function(e){
        e.preventDefault();
        $('#frmPayment [name="debt_id"]').val($(this).attr('data-id'));
        $('#frmPayment [name="user_id"]').val($(this).attr('data-user-id'));
        $('#frmPayment [name="paid_amount"]').val($(this).attr('data-amount'));
        $('#frmPayment [name="paid_amount"]').trigger('keyup');
        $('#frmPaymentContainaer').modal();
    });

    //setLastColumnWidth();
}

function updateTotalMoney()
{
    if ($('#total_money').length){
        var total_money = 0;
        $('.amount').each(function(){
            total_money += parseInt($(this).val());
        });
        $('.dataTables_filter span.total_money').html(money_format(total_money, '.'));
    }
}