var table_name = 'inventory_import';
var added_items = {};
$(document).ready(function(){
    $('input[type=checkbox]').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'icheckbox_square-blue',
        increaseArea: '20%' // optional
    });
    $('#payment_status').change(function(){
        var val = $(this).val();
        if (val == 'paid_by_cash' || val == 'paid_via_bank'){
            $('.cashier-group').show();
        }else{
            $('.cashier-group').hide();
        }
    });
    $('#payment_status').trigger('change');
    
    $('#frmImportInventory #edit').click(function(){
        $('#frmImportInventory #edit').hide();
        $('#frmImportInventory #delete').hide();
        
        $('#import_date, #payment_date').datepicker({language: 'vn', autoclose: true});
        
        $('#frmImportInventory #warehouse_id').removeAttr('disabled');
        $('#frmImportInventory #item_type_id').removeAttr('disabled');
        $('#frmImportInventory #has_invoice').removeAttr('disabled');
        $('#frmImportInventory #has_invoice').parent().removeClass('disabled');
        $('#frmImportInventory table tr td input[type="text"], #frmImportInventory table tr td select[name]').removeAttr('disabled');
        $('#frmImportInventory #description, #frmImportInventory #payment_status, #frmImportInventory #cashier_id, #frmImportInventory #shipping_fee').removeAttr('disabled');
        $('#frmImportInventory a.add_row, #frmImportInventory a.remove_row').show();
        
        $('#frmImportInventory').submit(function(){
            if (!isValidForm('frmImportInventory'))
                return false;
            if ($('#payment_status').val().indexOf('paid') != -1){
                if ($('#cashier_id').val() == 0){
                    alert('Vui lòng chọn nhân viên thanh toán.');
                    return false;
                }
            }else if(!isOneProvider()){
                alert('Một phiếu nhập chỉ lưu công nợ cho 1 nhà cung cấp (nơi nhập).');
                return false;
            }
            if (!isValidPrices()){
                alert('Vui lòng không nhập trái cây có giá và không giá trong cùng 1 phiếu nhập.');
                return false;
            }
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
            bindTotal();
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
                var item_id = $(this).parent().find('input[name="item_id[]"]').val();
                if (typeof added_items[item_id] != 'undefined')
                    delete added_items[item_id];
            }
        });
        
        bindAutoComplete();
        bindTotal();
        
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

    var total = 0;
    $('#dataTables-import tbody tr').each(function(){
        var t = parseFloat($(this).find('input[name="item_quantity[]"]').val())*parseInt($(this).find('input[name="item_price[]"]').val());
        if (!isNaN(t))
            total += t;
    });
    total += parseInt($('#shipping_fee').val());
    $('#total').val(money_format(total));
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
                if (typeof added_items[results[i].id] == 'undefined'){
                    rs.push(results[i]);
                    counter++;
                }
            }
            response(rs);
        },
        select: function( event, ui ) {
            var row = $(this).parent().parent();
            $(this).val(ui.item.value);
            $(row).find("#item_code").val(ui.item.code);
            $(row).find(".item_info").html(ui.item.name + (ui.item.type_name.length?' - '+ui.item.type_name:'') + ' - ' + ui.item.unit);
            $(row).find("#item_price").val(ui.item.price);
            $(row).find("#item_id").val(ui.item.id);
            added_items[ui.item.id] = 1;
            return false;
        }
    }); 
}

function bindTotal()
{
    $('input[name="item_price[]"], input[name="item_quantity[]"], #shipping_fee').unbind('change');
    $('input[name="item_price[]"], input[name="item_quantity[]"], #shipping_fee').change(function(){
        var total = 0;
        $('#dataTables-import tbody tr').each(function(){
            var t = parseFloat($(this).find('input[name="item_quantity[]"]').val())*parseInt($(this).find('input[name="item_price[]"]').val());
            if (!isNaN(t))
                total += t;
        });
        total += parseInt($('#shipping_fee').val());
        $('#total').val(money_format(total));
    });
}

function isValidPrices()
{
    var has_prices = 0;
    var no_prices = 0;
    $('input[name="item_price[]"]').each(function(){
        if (has_prices && no_prices)
            return;
        var p = $(this).val();
        if (p && parseInt(p) > 0)
            has_prices = 1;
        else
            no_prices = 1;
    });
    if (has_prices && no_prices)
        return false;
    return true;
}

function isOneProvider()
{
    var selected_provider = '';
    var valid = 1;
    $('select[name="item_provider[]"]').each(function(){
        var p = $(this).val();
        if (p){
            if (selected_provider == '')
                selected_provider = p;
            else if(p != selected_provider){
                valid = 0;
                return;
            }
        }else if(selected_provider){
            valid = 0;
            return;
        }
    });
    return valid;
}