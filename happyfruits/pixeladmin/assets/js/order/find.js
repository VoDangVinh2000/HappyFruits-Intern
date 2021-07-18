var table_name = 'orders';
var dataTableObj = '';
$(document).ready(function(){
    bindEvents();
});

function bindEvents()
{
    var oLanguage = $.extend(true, {}, dataTables_oLanguage);
    oLanguage['sEmptyTable'] = 'Không có đơn hàng nào.';
    if (!dataTableObj){
        dataTableObj = $('#dataTables-orderlist').dataTable({
           "paging": false,
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

        if ($('#number_of_records').length){
            $('.dataTables_filter span.number_of_records').html($('#number_of_records').val());
            $('.dataTables_filter span.order_total').html($('#order_total').val());
        }
    }

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