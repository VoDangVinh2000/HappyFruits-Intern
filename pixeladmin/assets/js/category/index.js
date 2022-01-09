var table_name = 'categories';
var dataTableObj = '';
$(document).ready(function () {
    var oLanguage = $.extend(true, {}, dataTables_oLanguage);
    oLanguage['sEmptyTable'] = 'Không có nhóm hàng nào.';
    if (!dataTableObj) {
        dataTableObj = $('#dataTables-categorylist').dataTable({
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': [4, 5, 6]}
            ],
            "columns": [
                {"orderDataType": "dom-text-numeric"},
                null,
                null,
                {"orderDataType": "dom-text", type: 'string'},
                null,
                null,
                null
            ],
            "oLanguage": oLanguage
        });

        dataTableObj.on('draw.dt', function () {
            bindEvents();
        });
    }
    bindEvents();
});

function bindEvents() {
    $('.enabled, .allow_delivery').change(function () {
        var category_id = $(this).closest('tr').attr('id');
        var field = $(this).attr('class');
        var new_value = $(this).is(':checked') ? 1 : 0;
        update(table_name, category_id, field, new_value);
    });

    $('.name, .sequence_number, .english_name, .code').change(function () {
        var category_id = $(this).parent().parent().attr('id');
        var field = $(this).attr('class');
        var new_value = $(this).val();
        update(table_name, category_id, field, new_value);
    });

    bindFloat('.sequence_number');

    $('a.delete_item').unbind('click');
    $('a.delete_item').click(function (e) {
        e.preventDefault();
        if (confirm('Bạn có chắc muốn xóa nhóm hàng này?')) {
            deleteById(table_name, $(this).parent().parent().attr('id'), URIs[table_name]);
        }
    });
    setLastColumnWidth();
}