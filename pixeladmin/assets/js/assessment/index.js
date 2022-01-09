var table_name = 'assessment';
var dataTableObj = '';
$(document).ready(function(){
    $(('#add_assessment_late, #add_working_time')).tooltipster({
        theme: 'tooltipster-shadow',
        position: 'top'
    });
    
    bindEvents();
    
    $('.filter_section #export_working_time').click(function(e){
        e.preventDefault();
        var params = getParams('admin_export_working_time');
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
    
    $('.filter_section #export_assessment').click(function(e){
        e.preventDefault();
        var params = getParams('admin_export_assessment');
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
});


function search(){
    var params = getParams('admin_search_assessment');
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
    if ($('.dataTables_filter #filter_day').length)
        params['filter_day'] = $('.dataTables_filter #filter_day').val();
    else
        params['filter_day'] = $('#filter_day').val();
    params['filter_month'] = $('.dataTables_filter #filter_month').val();
    params['filter_year'] = $('.dataTables_filter #filter_year').val();
    if ($('.dataTables_filter #filter_member').length)
        params['filter_member'] = $('.dataTables_filter #filter_member').val();
    else
        params['filter_member'] = $('#filter_member').val();
    return params;
}

function bindEvents()
{
    var oLanguage = $.extend(true, {}, dataTables_oLanguage);
    oLanguage['sEmptyTable'] = 'Không có bảng đánh giá nào.';
    if (!dataTableObj){
        dataTableObj = $('#dataTables-assessmentlist').dataTable({
           "bSort": false,
           "oLanguage": oLanguage
        });
        dataTableObj.on( 'draw.dt', function () {
            bindEvents();
        } );
        
        if ($('#total_working_time').length){
            $('.dataTables_filter span.total_working_time').html($('#total_working_time').val());
        }
    }
    
    bindFilterInput();
    bindEventForTableFilters('.dataTables_filter #filter_day, .dataTables_filter #filter_month, .dataTables_filter #filter_year, .dataTables_filter #filter_member');
    
    $('a.delete_item').unbind('click');
    $('a.delete_item').click(function(e){
        e.preventDefault();
        if (confirm('Bạn có chắc muốn xóa phần đánh giá này?')){
            deleteById(table_name, $(this).parent().parent().attr('id'), URIs[table_name]);
        }
    });
    $('td.username span').each(function(){
        if ($(this).next().find('p').html() == '')
            return;
        var contenthtml = $(this).next().html();
        $(this).parent().tooltipster({
            content: contenthtml,
            contentAsHTML: true,
            theme: 'tooltipster-shadow',
            position: 'top'
        });
    });
    $('td.has_tooltip span').each(function(){
        if ($(this).html().indexOf('…') != -1){
            var contenthtml = $(this).next().html();
            $(this).parent().tooltipster({
                content: contenthtml,
                contentAsHTML: true,
                theme: 'tooltipster-shadow',
                position: 'bottom'
            });
        }
    });
    
    setLastColumnWidth();
}