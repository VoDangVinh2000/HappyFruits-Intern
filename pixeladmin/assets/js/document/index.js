var table_name = 'documents';
var dataTableObj = '';
$(document).ready(function(){
    var oLanguage = $.extend(true, {}, dataTables_oLanguage);
    oLanguage['sEmptyTable'] = 'Không có tài liệu nào.';
    if (!dataTableObj){
        dataTableObj = $('#dataTables-documentlist').dataTable({
          "aoColumnDefs": [
              { 'bSortable': false, 'aTargets': [ 4 ] }
           ],
           "columns": [
                { "orderDataType": "dom-text", type: 'string' },
                { "orderDataType": "dom-text", type: 'string' },
                null,
                { "orderDataType": "dom-data-numeric" },
                null
           ],
           "oLanguage": oLanguage,
           "order": [[ 1, "asc" ]]
        });
        
        dataTableObj.on( 'draw.dt', function () {
            bindEvents();
        } );
    }
    bindEvents();
});

function bindEvents()
{
    $('.code, .name').change(function(){
        var document_id = $(this).parent().parent().attr('id');
        var field = $(this).attr('class');
        var new_value = $(this).val();
        update(table_name, document_id, field, new_value);
    });
    
    $('a.delete_item').unbind('click');
    $('a.delete_item').click(function(e){
        e.preventDefault();
        if (confirm('Bạn có chắc muốn xóa tài liệu này?')){
            deleteById(table_name, $(this).parent().parent().attr('id'), URIs[table_name]);
        }
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