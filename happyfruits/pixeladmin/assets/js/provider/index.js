var table_name = 'providers';
var dataTableObj = '';
$(document).ready(function(){
    bindEvents();
});

function search(){
    return;
}

function bindEvents()
{
    var oLanguage = $.extend(true, {}, dataTables_oLanguage);
    oLanguage['sEmptyTable'] = 'Không có nhà cung cấp nào.';
    if (!dataTableObj){
        dataTableObj = $('#dataTables-providerlist').dataTable({
          "aoColumnDefs": [
              { 'bSortable': false, 'aTargets': [ 5, 6 ] }
           ],
           "columns": [
                { "orderDataType": "dom-text", type: 'string' },
                null,
                { "orderDataType": "dom-text", type: 'string' },
                { "orderDataType": "dom-text", type: 'string' },
                { "orderDataType": "dom-text", type: 'string' },
               { "orderDataType": "dom-text", type: 'string' },
                null
           ],
           "oLanguage": oLanguage,
           "order": [[ 0, "asc" ]]
        });
        dataTableObj.on( 'draw.dt', function () {
            bindEvents();
        } );
        bindFilterInput();
    }
    
    $('.provider_name, .provider_address, .mobile, .description').change(function(){
        var provider_id = $(this).parent().parent().attr('id');
        var field = $(this).attr('class');
        var new_value = $(this).val();
        update(table_name, provider_id, field, new_value);
    });
    
    bindNumber('.mobile');
    
    $('a.delete_item').unbind('click');
    $('a.delete_item').click(function(e){
        e.preventDefault();
        if (confirm('Bạn có chắc muốn xóa nhà cung cấp này?')){
            deleteById(table_name, $(this).parent().parent().attr('id'), URIs[table_name]);
        }
    });
    
    setLastColumnWidth();
}