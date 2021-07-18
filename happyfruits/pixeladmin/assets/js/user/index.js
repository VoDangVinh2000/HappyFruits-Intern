var table_name = 'users';
var dataTableObj = '';

$(document).ready(function(){
    var oLanguage = $.extend(true, {}, dataTables_oLanguage);
    oLanguage['sEmptyTable'] = 'Không có người dùng nào.';
    if (!dataTableObj){
        dataTableObj = $('#dataTables-userlist').dataTable({
          "aoColumnDefs": [
              { 'bSortable': false, 'aTargets': [ 3, 5, 6, 7 ] }
           ],
           "columns": [
                null,
                { "orderDataType": "dom-text", type: 'string' },
                { "orderDataType": "dom-text", type: 'string' },
                null,
                { "orderDataType": "dom-text-numeric" },
                null,
                null,
                null
           ],
           "oLanguage": oLanguage
        });
        
        dataTableObj.on( 'draw.dt', function () {
            bindEvents();
        } );
    }
    bindEvents();
});

function bindEvents()
{
    $('.enabled,.do_shipping').change(function(){
        var user_id = $(this).closest('tr').attr('id');
        var field = $(this).attr('class');
        var new_value = $(this).is(':checked')?1:0;
        update(table_name, user_id, field, new_value);
    });
    
    $('.fullname, .email, .type_id, .rate_per_hour').change(function(){
        var user_id = $(this).closest('tr').attr('id');
        var field = $(this).attr('class');
        var new_value = $(this).val();
        update(table_name, user_id, field, new_value);
    });
    
    bindNumber('.rate_per_hour');
    
    $('a.delete_item').unbind('click');
    $('a.delete_item').click(function(e){
        e.preventDefault();
        if (confirm('Bạn có chắc muốn xóa người dùng này?')){
            deleteById(table_name, $(this).parent().parent().attr('id'), URIs[table_name]);
        }
    });
    
    $('a.login_as_user').click(function(e){
        e.preventDefault();
        var params = {};
        params['action'] = 'login_as_user';
        params['user_id'] = $(this).parent().parent().attr('id');
        $.post(base_url + 'xu-ly',params, function(data){
            if (data.status == 'OK')
                window.location.href = base_url;
            else
            {
                unblockElement('#main-wrapper');
                alert(data.message);
            }
        },"json");
    });
    
    setLastColumnWidth();
}