var table_name = 'customers';
var dataTableObj = '';
$(document).ready(function(){
    bindEvents();
    $("#filter_products").select2({
        placeholder: "Sản phẩm khách từng mua"
    });
});

function search(){
    if(dataTableObj)
        dataTableObj.api().ajax.reload();
}

function getParams(action)
{
    var params = {};
    params['action'] = action;
    params['filter_keyword'] = $('.dataTables_filter #filter_keyword').val();
    params['filter_district'] = $('.dataTables_filter #filter_district').val();
    params['filter_type'] = $('.dataTables_filter #filter_type').val();
    params['filter_products'] = $('.dataTables_filter #filter_products').val();
    return params;
}

function bindEvents()
{
    if (!dataTableObj){
        var oLanguage = $.extend(true, {}, dataTables_oLanguage);
        oLanguage['sEmptyTable'] = 'Không có khách hàng nào.';
        dataTableObj = $('#dataTables-customerlist').dataTable({
            "bProcessing": true,
            "bServerSide": true,
            "pageLength": 25,
            "ajax": {
                "url": postback_url,
                "type": "POST",
                "data": function ( d ) {
                    d['action'] = 'admin_get_customers';
                    d['filter_keyword'] = $('.dataTables_filter #filter_keyword').val();
                    d['filter_district'] = $('.dataTables_filter #filter_district').val();
                    d['filter_type'] = $('.dataTables_filter #filter_type').val();
                    d['filter_products'] = $('.dataTables_filter #filter_products').val();
                },
            },
            "aoColumnDefs": [
                { 'bSortable': false, 'aTargets': [ 8 ] }
            ],
            "columns": [
                { "orderDataType": "dom-text", type: 'string' },
                null,
                { "orderDataType": "dom-data-numeric" },
                { "orderDataType": "dom-text-numeric" },
                { "orderDataType": "dom-text-numeric" },
                { "orderDataType": "dom-anchor-numeric" },
                { "orderDataType": "dom-data-numeric" },
                null,
                null
            ],
            "oLanguage": oLanguage,
            "order": [[ 2, "desc" ]],
            "createdRow": function( row, data, dataIndex ) {
                $(row).children(':nth-child(1)').addClass('fullwidth');
                $(row).children(':nth-child(3)').addClass('center');
                $(row).children(':nth-child(4)').addClass('fullwidth');
                $(row).children(':nth-child(5)').addClass('fullwidth');
                $(row).children(':nth-child(6)').addClass('center');
                $(row).children(':nth-child(7)').addClass('center');
                $(row).children(':nth-child(8)').addClass('center');
                $(row).children(':nth-child(9)').addClass('center').css('width', '90px');
            }
        });
        dataTableObj.on( 'draw.dt', function () {
            bindEvents();
        } );
        bindFilterInput();
        bindEventForTableFilters('.dataTables_filter #filter_district, .dataTables_filter #filter_type, .dataTables_filter #filter_products');
        $('.dataTables_filter #export_customer').click(function(e){
            e.preventDefault();
            var params = getParams('admin_export_customer');
            params['checking'] = 1;
            params['filter_products'] = $('.dataTables_filter #filter_products').val().join(',');
            var order = dataTableObj.DataTable().order()[0];
            params['sorting_index'] = order[0];
            params['sorting_dir'] = order[1];
            blockElement('#main-wrapper');
            $.post(postback_url, params, function(data){
                unblockElement('#main-wrapper');
                if (data.status == 'OK')
                {
                    params['checking'] = 0;
                    $.download(postback_url, params);
                }
                else
                {
                    alert(data.message);
                }
            },"json");
        });

    }

    $('.dataTables_filter #filter_search').click(function(){
        blockElement('#main-wrapper');
        window.location.href = base_url + 'khach-hang/tim/' + $('.dataTables_filter #filter_keyword').val();
    });

    $('.dataTables_filter #filter_back').click(function(){
        blockElement('#main-wrapper');
        window.location.href = base_url + 'khach-hang';
    });

    $('.free_ship').change(function(){
        var customer_id = $(this).attr('data-id');
        var field = $(this).attr('class');
        var new_value = $(this).is(':checked')?1:0;
        update(table_name, customer_id, field, new_value);
    });

    $('.customer_name, .address, .mobile, .distance, .description').change(function(){
        var customer_id = $(this).attr('data-id');
        var field = $(this).attr('class');
        var new_value = $(this).val();
        update(table_name, customer_id, field, new_value);
    });

    bindNumber('.mobile');
    bindFloat('.distance');

    $('a.delete_item').unbind('click');
    $('a.delete_item').click(function(e){
        e.preventDefault();
        if (confirm('Bạn có chắc muốn xóa khách hàng này?')){
            deleteById(table_name, $(this).parent().parent().attr('id'), URIs[table_name]);
        }
    });

    $('td.has_tooltip span').each(function(){
        if ($(this).next().find('p').html() == '')
            return;
        var contenthtml = $(this).next().html();
        $(this).parent().tooltipster({
            content: contenthtml,
            contentAsHTML: true,
            theme: 'tooltipster-shadow',
            position: 'top'
        });
    });

    setLastColumnWidth();
}