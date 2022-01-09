var table_name = 'inventory';
$(document).ready(function(){
    $('#import_date').datepicker({language: 'vn', autoclose: true});

    $('#frmImportInventory').submit(function(){
        if (!isValidForm('frmImportInventory'))
            return false;
            
        var params = getParameters('#frmImportInventory');
        $("#frmImportInventory #submit").attr('disabled', true);
        $("#frmImportInventory #submit span").text('Đang lưu...');
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            $("#frmImportInventory #submit").attr('disabled', false);
            $("#frmImportInventory #submit span").text('Lưu');
            if (data.status == 'OK'){
                window.location.href = base_url + URIs['inventory_import_fruits'];
            }
            else{
                unblockElement('#main-wrapper');
                alert(data.message);
            }
        },"json");
        return false; 
    });

    $('input[name="item_price[]"], input[name="item_quantity[]"], #capital').change(function(){
        var total = 0;
        $('#dataTables-import tbody tr').each(function(){
            var t = parseFloat($(this).find('input[name="item_quantity[]"]').val())*parseInt($(this).find('input[name="item_price[]"]').val());
            if (!isNaN(t))
                total += t;
        });
        $('#total').val(total);
        $('#remain').val($('#capital').val() - total);
    });
});