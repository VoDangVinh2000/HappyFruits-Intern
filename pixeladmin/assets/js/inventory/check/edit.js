var table_name = 'inventory';
$(document).ready(function(){

    $('#frmCheckInventory #edit').click(function(){
        $('#frmCheckInventory #edit').hide();
        $('#frmCheckInventory #delete').hide();

        $('#export_date').datepicker({language: 'vn', autoclose: true});

        $('#frmCheckInventory #warehouse_id').removeAttr('disabled');
        $('#frmCheckInventory table tr td select').removeAttr('disabled');
        $('#frmCheckInventory table tr td input[type="text"]').removeAttr('disabled');
        $('#frmCheckInventory #description').removeAttr('disabled');
        $('#capital').removeAttr('disabled');

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
                    window.location.reload();
                }
                else{
                    unblockElement('#main-wrapper');
                    alert(data.message);
                }
            },"json");
            return false;
        });

        $('#frmCheckInventory #submit').show();
    });

    $('#frmCheckInventory #delete').click(function(e){
        e.preventDefault();
        if (confirm('Thao tác này sẽ KHÔNG thể khôi phục lại được. Bạn có chắc muốn xóa phiếu kiểm kê này?')){
            var params = {};
            params['action'] = 'admin_delete_export_inventory';
            params['export_id'] = $('#export_id').val();
            params['warehouse_id'] = $('#warehouse_id').val();
            blockElement('#main-wrapper');
            $("#frmCheckInventory #delete").attr('disabled', true);
            $("#frmCheckInventory #delete span").text('Đang xóa...');
            $.post(postback_url, params, function(data){
                if (data.status == 'OK'){
                    window.location.href = base_url + 'quan-ly-kho/phieu-kiem-ke';
                }
                else{
                    $("#frmCheckInventory #delete").attr('disabled', false);
                    $("#frmCheckInventory #delete span").text('Xóa');
                    unblockElement('#main-wrapper');
                    alert(data.message);
                }
            },"json");
        }
    });
});