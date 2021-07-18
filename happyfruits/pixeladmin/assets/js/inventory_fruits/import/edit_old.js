var table_name = 'inventory';
$(document).ready(function(){

    $('#frmImportInventory #edit').click(function(){
        $('#frmImportInventory #edit').hide();
        $('#frmImportInventory #delete').hide();

        $('#import_date').datepicker({language: 'vn', autoclose: true});

        $('#frmImportInventory #warehouse_id').removeAttr('disabled');
        $('#frmImportInventory table tr td select').removeAttr('disabled');
        $('#frmImportInventory table tr td input[type="text"]').removeAttr('disabled');
        $('#capital').removeAttr('disabled');
        $('#description').removeAttr('disabled');

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
                    window.location.reload();
                }
                else{
                    unblockElement('#main-wrapper');
                    alert(data.message);
                }
            },"json");
            return false;
        });

        $('#frmImportInventory #submit').show();
    });

    $('#frmImportInventory #delete').click(function(e){
        e.preventDefault();
        if (confirm('Thao tác này sẽ KHÔNG thể khôi phục lại được. Bạn có chắc muốn xóa phiếu nhập này?')){
            var params = {};
            params['action'] = 'admin_delete_import_inventory';
            params['import_id'] = $('#import_id').val();
            params['warehouse_id'] = $('#warehouse_id').val();
            blockElement('#main-wrapper');
            $("#frmImportInventory #delete").attr('disabled', true);
            $("#frmImportInventory #delete span").text('Đang xóa...');
            $.post(postback_url, params, function(data){
                if (data.status == 'OK'){
                    window.location.href = base_url + URIs[table_name];
                }
                else{
                    $("#frmImportInventory #delete").attr('disabled', false);
                    $("#frmImportInventory #delete span").text('Xóa');
                    unblockElement('#main-wrapper');
                    alert(data.message);
                }
            },"json");
        }
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

    $('#capital').trigger('change');
});