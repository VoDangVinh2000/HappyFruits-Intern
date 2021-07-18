var table_name = 'inventory_export';
var dataTableObj = '';
var startDate = endDate = '';
$(document).ready(function(){
    startDate = $('.for_datatable_filter #filter_start_date').val();
    endDate = $('.for_datatable_filter #current_date').val();
    bindEvents();
});


function search(){
    var params = getParams('admin_search_check_inventory_fruits');
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
    params['filter_member'] = $('.dataTables_filter #filter_member').val();
    params['filter_warehouse'] = $('.dataTables_filter #filter_warehouse').val();
    return params;
}

function bindEvents()
{
    var oLanguage = $.extend(true, {}, dataTables_oLanguage);
    oLanguage['sEmptyTable'] = 'Không có phiếu kiểm kê nào.';
    if (!dataTableObj){
        dataTableObj = $('#dataTables-exportlist').dataTable({
            "aoColumnDefs": [
                { 'bSortable': false, 'aTargets': [ 6 ] }
            ],
            "oLanguage": oLanguage,
            "order": [[ 2, "desc" ]]
        });
        dataTableObj.on( 'draw.dt', function () {
            bindEvents();
        } );
        $('.dataTables_filter #filter_search').click(function(){
            search();
        });

        bindFilterInput();
        bindEventForTableFilters('.dataTables_filter #filter_member, .dataTables_filter #filter_warehouse');

        $('.dataTables_filter #filter_start_date, .dataTables_filter #filter_end_date').datepicker({language: 'vn', autoclose: true});

        $('.dataTables_filter #filter_start_date, .dataTables_filter #filter_end_date').change(function(){
            var id = $(this).attr('id');
            var value = $(this).val();
            if (id == 'filter_start_date')
                startDate = value;
            else if(id == 'filter_end_date')
                endDate = value;
        });
    }

    $('.dataTables_filter #filter_start_date').datepicker('setDate', startDate);
    $('.dataTables_filter #filter_end_date').datepicker('setDate', endDate);

    $('td.has_tooltip span').each(function(){
        if ($(this).html().indexOf('…') != -1){
            var contenthtml = $(this).next().html();
            $(this).parent().tooltipster({
                content: contenthtml,
                contentAsHTML: true,
                theme: 'tooltipster-shadow',
                position: 'top'
            });
        }
    });
    setLastColumnWidth();
}