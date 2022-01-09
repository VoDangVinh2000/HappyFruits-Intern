var table_name = 'inventory';
$(document).ready(function(){
    $('#export_date').datepicker({language: 'vn', autoclose: true});

    $('#frmCheckInventory').submit(function(){
        if (!isValidForm('frmCheckInventory'))
            return false;
            
        var params = getParameters('#frmCheckInventory');
        $("#frmCheckInventory #submit").attr('disabled', true);
        $("#frmCheckInventory #submit span").text('Đang lưu...');
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            $("#frmCheckInventory #submit").attr('disabled', false);
            $("#frmCheckInventory #submit span").text('Lưu');
            if (data.status == 'OK'){
                window.location.href = base_url + URIs['inventory_check'];
            }
            else{
                unblockElement('#main-wrapper');
                alert(data.message);
            }
        },"json");
        return false; 
    });
    bindTypeFilter();
});

function bindTypeFilter()
{
    $('#type_id').change(function(){
        blockElement('#main-wrapper');
        $.post(postback_url, {action: 'load_inventory_items_for_checking', type_id: $(this).val()}, function(data){
            if (data.status == 'OK'){
                $('#table-container').html(data.html);
            }
            else{
                alert(data.message);
            }
            unblockElement('#main-wrapper');
        },"json");
    });
}