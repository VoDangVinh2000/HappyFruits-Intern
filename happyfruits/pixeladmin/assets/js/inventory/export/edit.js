var table_name = 'inventory_export';
$(document).ready(function(){
    
    $('#frmExportInventory #edit').click(function(){
        $('#frmExportInventory #edit').hide();
        $('#frmExportInventory #delete').hide();
        
        $('#export_date').datepicker({language: 'vn', autoclose: true});
        
        $('#frmExportInventory #warehouse_id').removeAttr('disabled');
        $('#frmExportInventory #item_type_id').removeAttr('disabled');
        $('#frmExportInventory table tr td input[type="text"]').removeAttr('disabled');
        $('#frmExportInventory a.add_row, #frmExportInventory a.remove_row').show();
        
        $('#frmExportInventory').submit(function(){
            if (!isValidForm('frmExportInventory'))
                return false;
                
            var params = $(this).serialize();
            $("#frmExportInventory #submit").attr('disabled', true);
            $("#frmExportInventory #submit span").text('Đang lưu...');
            blockElement('#main-wrapper');
            $.post(postback_url, params, function(data){
                if (data.status == 'OK'){
                    window.location.reload();
                }
                else{
                    $("#frmExportInventory #submit").attr('disabled', false);
                    $("#frmExportInventory #submit span").text('Lưu');
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
            var number_of_rows = $('#dataTables-export tbody tr').length;
            if (number_of_rows <= 1){
                alert('Phiếu nhập phải có ít nhất 1 dòng.');
                return;
            }
            if (confirm('Bạn có chắc muốn xóa dòng này?')){
                $(this).parent().parent().remove();
            }
        });
        bindAutoComplete();
        
        $('#frmExportInventory #submit').show();
    });
    
    $('#frmExportInventory #delete').click(function(e){
        e.preventDefault();
        if (confirm('Thao tác này sẽ KHÔNG thể khôi phục lại được. Bạn có chắc muốn xóa phiếu nhập này?')){
            var params = {};
            params['action'] = 'admin_delete_export_inventory';
            params['export_id'] = $('#export_id').val();
            params['warehouse_id'] = $('#warehouse_id').val();
            blockElement('#main-wrapper');
            $("#frmExportInventory #delete").attr('disabled', true);
            $("#frmExportInventory #delete span").text('Đang xóa...');
            $.post(postback_url, params, function(data){
                if (data.status == 'OK'){
                    window.location.href = base_url + URIs[table_name];
                }
                else{
                    $("#frmExportInventory #delete").attr('disabled', false);
                    $("#frmExportInventory #delete span").text('Xóa');
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
            var selected_type_id = $('#frmExportInventory #item_type_id').val();
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
            var details = ui.item.name + ' - ' + ui.item.unit;
            if (ui.item.unit_in_details)
                details += ' - ' + ui.item.unit_in_details;
            $(row).find("td.details").html(details);
            $(row).find("#item_id").val(ui.item.id);
            return false;
        }
    }); 
}