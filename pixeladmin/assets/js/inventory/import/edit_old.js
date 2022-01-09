var table_name = 'inventory_import';
$(document).ready(function(){
    
    $('#frmImportInventory #edit').click(function(){
        $('#frmImportInventory #edit').hide();
        $('#frmImportInventory #delete').hide();
        
        $('#import_date').datepicker({language: 'vn', autoclose: true});
        
        $('#frmImportInventory #warehouse_id').removeAttr('disabled');
        $('#frmImportInventory #item_type_id').removeAttr('disabled');
        $('#frmImportInventory table tr td input[type="text"], #frmImportInventory table tr td select[name]').removeAttr('disabled');
        $('#frmImportInventory #description').removeAttr('disabled');
        $('#frmImportInventory a.add_row, #frmImportInventory a.remove_row').show();
        
        $('#frmImportInventory').submit(function(){
            if (!isValidForm('frmImportInventory'))
                return false;
                
            var params = $(this).serialize();
            $("#frmImportInventory #submit").attr('disabled', true);
            $("#frmImportInventory #submit span").text('Đang lưu...');
            blockElement('#main-wrapper');
            $.post(postback_url, params, function(data){
                if (data.status == 'OK'){
                    window.location.reload();
                }
                else{
                    $("#frmImportInventory #submit").attr('disabled', false);
                    $("#frmImportInventory #submit span").text('Lưu');
                    unblockElement('#main-wrapper');
                    alert(data.message);
                }
            },"json");
            return false; 
        });
        
        $('a.add_row').click(function(e){
            e.preventDefault();
            $("input.item_code, input.item_name").autocomplete('destroy');
            var record = $(this).parent().parent();
            var obj = record.clone(true);
            obj.find('input,select').val('');
            record.after(obj);
            bindAutoComplete();
        });
        
        $('a.remove_row').click(function(e){
            e.preventDefault();
            var number_of_rows = $('#dataTables-import tbody tr').length;
            if (number_of_rows <= 1){
                alert('Phiếu nhập phải có ít nhất 1 dòng.');
                return;
            }
            if (confirm('Bạn có chắc muốn xóa dòng này?')){
                $(this).parent().parent().remove();
            }
        });
        
        bindAutoComplete();
        
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
});

function bindAutoComplete()
{
    $("input.item_code, input.item_name").autocomplete({
        minLength: 1,
        source: function(request, response) {
            var results = $.ui.autocomplete.filter(window.inventory_items, request.term);
            var counter = 0;
            var selected_type_id = $('#frmImportInventory #item_type_id').val();
            var rs = [];
            for(var i = 0; i < results.length && counter < 10; i++){
                if (results[i].type_id != selected_type_id)
                    continue;
                rs.push(results[i]);
                counter++;
            }
            response(rs);
        },
        select: function( event, ui ) {
            var row = $(this).parent().parent();
            $(this).val(ui.item.value);
            $(row).find("#item_code").val(ui.item.code);
            $(row).find("#item_name").val(ui.item.name);
            $(row).find("#item_unit").val(ui.item.unit);
            $(row).find("#item_price").val(ui.item.price);
            $(row).find("#item_id").val(ui.item.id);
            return false;
        }
    }); 
}