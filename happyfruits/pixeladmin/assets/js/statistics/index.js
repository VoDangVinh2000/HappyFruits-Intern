var table_name = 'orders';
var dataTableObj = '';
var startDate = endDate = shift = '';
$(document).ready(function(){
    startDate = $('.for_datatable_filter #filter_start_date').val();
    endDate = $('.for_datatable_filter #current_date').val();
    bindEvents();
    $('#report_charts').iframeAutoHeight();
});


function search(){
    var params = getParams('admin_statistics_filter');
    blockElement('#main-wrapper');
    $.post(postback_url, params, function(data){
        unblockElement('#main-wrapper');
        if (data.status == 'OK')
        {
            $('#list_container').html(data.html);
            if (typeof chart0 != 'undefined')
            {
                
            }
            if (typeof chart1 != 'undefined')
            {
                
            }
            dataTableObj = '';
            bindEvents();
        }
        else
        {
            alert(data.message);
        }
    },"json");
    $('#report_charts').attr("src", base_url + 'thong-ke/bieu-do?startdate=' + startDate + '&enddate=' + endDate + '&shift=' + $('.dataTables_filter #filter_shift').val() + '&branch_id=' + $('.dataTables_filter #filter_branch').val());
    $('#report_charts').iframeAutoHeight();
}

function getParams(action)
{
    var params = {};
    params['action'] = action;
    params['filter_start_date'] = $('.dataTables_filter #filter_start_date').val();
    params['filter_end_date'] = $('.dataTables_filter #filter_end_date').val();
    params['filter_category'] = $('.dataTables_filter #filter_category').val();
    params['filter_shift'] = $('.dataTables_filter #filter_shift').val();
    params['filter_branch'] = $('.dataTables_filter #filter_branch').val();
    return params;
}

function bindEvents()
{
    var oLanguage = $.extend(true, {}, dataTables_oLanguage);
    oLanguage['sEmptyTable'] = 'Không có dữ liệu.';
    if (!dataTableObj){
        dataTableObj = $('#dataTables-statisticslist').dataTable({
           "oLanguage": oLanguage
        });
        dataTableObj.on( 'draw.dt', function () {
            bindEvents();
        } );
        
        $('.dataTables_filter #filter_search').click(function(){
            /*
            var filter_category = $('.dataTables_filter #filter_category').val();
            $('.for_datatable_filter #filter_category option').removeAttr('selected');
            $('.for_datatable_filter #filter_category option[value="' + filter_category + '"]').attr('selected', '');
            */
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
        bindEventForTableFilters('.dataTables_filter #filter_category, .dataTables_filter #filter_shift, .dataTables_filter #filter_branch');

        $('.dataTables_filter #export_statistic_data').click(function(e){
            e.preventDefault();
            var params = getParams('admin_export_statistic_data');
            params['checking'] = 1;
            blockElement('#main-wrapper');
            $.post(postback_url, params, function(data){
                unblockElement('#main-wrapper');
                if (data.status == 'OK')
                {
                    params['checking'] = 0;
                    $.download(postback_url, params);
                }
                else
                {
                    alert(data.message);
                }
            },"json");
        });
    }
    $('.dataTables_filter #filter_start_date').datepicker('setDate', startDate);
    $('.dataTables_filter #filter_end_date').datepicker('setDate', endDate);
    
    setLastColumnWidth();
}