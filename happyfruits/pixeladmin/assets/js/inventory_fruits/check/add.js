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
                window.location.href = base_url + URIs['inventory_check_fruits'];
            }
            else{
                unblockElement('#main-wrapper');
                alert(data.message);
            }
        },"json");
        return false;
    });

    $('#warehouse_id').change(function(){
        $('#dataTables-check tr').not('.heading').hide();
        $('#dataTables-check tr.warehouse_'+$(this).val()).show();
    });
});