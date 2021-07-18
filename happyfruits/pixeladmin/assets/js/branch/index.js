var table_name = 'branches';
var dataTableObj = '';
$(document).ready(function(){
    bindEvents();
});

function bindEvents()
{
    var oLanguage = $.extend(true, {}, dataTables_oLanguage);
    oLanguage['sEmptyTable'] = 'Không có chi nhánh nào.';
    if (!dataTableObj){
        dataTableObj = $('#dataTables-customerlist').dataTable({
            "bSort" : false,
            "columns": [
                { "orderDataType": "dom-text", type: 'string' },
                { "orderDataType": "dom-text", type: 'string' },
                { "orderDataType": "dom-data-numeric" },
                { "orderDataType": "dom-text-numeric" },
                null,
                null
            ],
            "oLanguage": oLanguage
        });
        dataTableObj.on( 'draw.dt', function () {
            bindEvents();
        } );
        bindFilterInput();
    }

    $('.branch_name, .branch_address, .lat, .lng').change(function(){
        var branch_id = $(this).parent().parent().attr('id');
        var field = $(this).attr('class');
        var new_value = $(this).val();
        update(table_name, branch_id, field, new_value);
    });

    bindFloat('.lat, .lng');
    $('.enabled').change(function(){
        var branche_id = $(this).closest('tr').attr('id');
        var field = $(this).attr('class');
        var new_value = $(this).is(':checked')?1:0;
        update(table_name, branche_id, field, new_value);
    });
    
    $('a.delete_item').unbind('click');
    $('a.delete_item').click(function(e){
        e.preventDefault();
        if (confirm('Bạn có chắc muốn xóa chi nhánh này?')){
            deleteById(table_name, $(this).parent().parent().attr('id'), URIs[table_name]);
        }
    });
    
    $('td.has_tooltip span').each(function(){
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
    
    setLastColumnWidth();
}