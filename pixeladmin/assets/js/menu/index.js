var fields = ['text', 'short_text', 'en_text', 'page', 'href', 'target', 'cat', 'description', 'image'];
var required_fields = ['text', 'href', 'target'];
var editorOptions = {
    listOptions: {
        hintCss: {'border': '1px dashed #13981D'},
        placeholderCss: {'background-color': 'gray'},
        ignoreClass: 'btn',
        opener: {
            active: true,
            as: 'html',
            close: '<i class="fa fa-minus"></i>',
            open: '<i class="fa fa-plus"></i>',
            openerCss: {'margin-right': '10px'},
            openerClass: 'btn btn-success btn-xs'
        }
    },
    labelEdit: 'Sửa',
    labelRemove: 'X'
};

function menuEditor(idSelector, settings){
    var $main = $("#"+idSelector);
    var labelEdit = settings.labelEdit || 'E';
    var labelRemove = settings.labelRemove || 'X';

    if ('data' in settings){
        var data = jsonToObject(settings.data);
        if (data!==null){
            var menu = createMenu(data, 0);
            $main.append(menu);
        }
    }
    var options = settings.listOptions;
    var itemEdit = 0;
    var inst = $main.sortableLists(options);
    $('.btn-save').on('click', function () {
        saveMenu();
    });

    $("#btnUpdate").click(function (e) {
        e.preventDefault();
        updateItem();
    });

    $("#btnAdd").click(function (e) {
        e.preventDefault();
        addItem();
    });

    $(document).on('click', '.btnRemove', function (e) {
        e.preventDefault();
        var list = $(this).closest('ul');
        $(this).closest('li').remove();

        var isMainContainer = false;
        if (typeof list.attr('id')!=='undefined'){
            isMainContainer = (list.attr('id').toString()===idSelector);
        }

        if ((!list.children().length)&&(!isMainContainer)) {
            list.prev('div').children('.sortableListsOpener').first().remove();
            list.remove();
        }
    });

    $(document).on('click', '.btnEdit', function (e) {
        e.preventDefault();
        itemEdit = $(this).closest('li');
        editItem(this);
    });

    $(document).on('change', '#mnu_page', function () {
        var page_code = $(this).val();
        if (page_code.length) {
            $('#mnu_href').val(frontend_url + page_code).attr('readonly', true);
        } else {
            $('#mnu_href').attr('readonly', false);
        }
    });

    function saveMenu() {
        var obj = inst.sortableListsToJson();
        var str = JSON.stringify(obj);
        var params = {
            action: 'admin_save_menu',
            menu_id: $('#menu').val(),
            items: str
        };
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(return_data){
            unblockElement('#main-wrapper');
            if (return_data.status == 'OK'){
                showNotifcation('Lưu thành công.', 'success');
            }else{
                showAlertError(return_data.message);
            }
        },"json");
    }

    function editItem(item) {
        var data = $(item).closest('li').data();
        $.each(data, function (p, v) {
            $("#mnu_" + p).val(v);
        });
        $("#mnu_text").focus();
        $("#btnUpdate").removeClass('hidden');
        $('#mnu_image').trigger('change');
        $('#frmEdit .select2').trigger('change');
    }

    function updateItem() {
        if (itemEdit === 0) {
            return;
        }
        var arrForm = $("#frmEdit").serializeArray();
        var reg = new RegExp("^mnu_");
        var valid = true;
        $.each(arrForm, function (k, v) {
            if (valid && reg.test(v.name)) {
                var name = v.name.replace(reg, '');
                if(required_fields.indexOf(name) != -1 && (!v.value || $.trim(v.value).length == 0)) {
                    valid = false;
                    return;
                }
                itemEdit.data(name, v.value);
            }
        });
        if(!valid){
            showAlertError('Vui lòng nhập đầy đủ thông tin hợp lệ');
            return false;
        }
        itemEdit.find('span.txt').first().text($("#mnu_text").val());
        saveMenu();
        reset();
    }

    function addItem() {
        var arrForm = $("#frmEdit").serializeArray();
        var text = $("#mnu_text").val();
        var btnEdit = TButton({classCss: 'btn btn-default btn-xs btnEdit', text: labelEdit});
        var btnRemv = TButton({classCss: 'btn btn-danger btn-xs btnRemove', text: labelRemove});
        var grpBtns = $("<div>").addClass('btn-group pull-right').append(btnEdit).append(btnRemv);
        var textItem = $('<span>').addClass('txt').text(text);
        var div = $('<div>').append(textItem).append(grpBtns);
        var li = $("<li>");
        var reg = new RegExp("^mnu_");
        var valid = true;
        $.each(arrForm, function (k, v) {
            if (valid && reg.test(v.name)) {
                var name = v.name.replace(reg, '');
                if(required_fields.indexOf(name) != -1 && (!v.value || $.trim(v.value).length == 0)) {
                    valid = false;
                    return;
                }
                li.data(name, v.value);
            }
        });
        if(!valid){
            showAlertError('Vui lòng nhập đầy đủ thông tin hợp lệ');
            return false;
        }
        li.addClass('list-group-item').append(div);
        $('#'+idSelector).append(li);
        saveMenu();
        reset();
    }
    function reset(){
        $("#frmEdit")[0].reset();
        $("#btnUpdate").addClass('hidden');
        $("#mnu_href").attr('readonly', false);
        $('#frmEdit .select2').val('').trigger('change');
        $('#preview_image').html('');
        itemEdit = 0;
    }
}


/**
 * @param {array} arrayItem Object Array
 * @param {int} depth Depth sub-menu
 * @return {object} jQuery Object
 * */
function createMenu(arrayItem, depth){
    var level = (typeof(depth)==='undefined') ? 0 : depth;
    var $elem;
    if (level === 0){
        $elem = $('#myList');
    } else{
        $elem = $('<ul>');
    }
    $.each(arrayItem, function(k, v){
        var isParent = (typeof(v.children) !== "undefined") && ($.isArray(v.children));
        var $li = $('<li>');
        $li.attr('id', v.text);
        $li.addClass('list-group-item');
        if (fields.length) {
            for (var i in fields) {
                if (typeof v[fields[i]] != 'undefined') {
                    $li.addClass('list-group-item').data(fields[i], v[fields[i]]);
                }
            }
        }
        var $div = $('<div>');
        var $span = $('<span>').addClass('txt').append(v.text);
        var $divbtn = $('<div>').addClass('btn-group pull-right');
        var $btnEdit = TButton({classCss: 'btn btn-default btn-xs btnEdit', text: editorOptions.labelEdit});
        var $btnRemv = TButton({classCss: 'btn btn-danger btn-xs btnRemove', text: editorOptions.labelRemove});
        $divbtn.append($btnEdit).append($btnRemv);
        $div.append("&nbsp;").append($span).append($divbtn);
        $li.append($div);
        if (isParent){
            $li.append(createMenu(v.children, level+1));
        }
        $elem.append($li);
    });
    return $elem;
}
function jsonToObject(str){
    try {
        var obj = $.parseJSON(str);
    } catch (err) {
        console.log('The string is not a json valid.');
        return null;
    }
    return obj;
}
function TButton(attr){
    return $("<a>").addClass(attr.classCss).attr("href", "#").text(attr.text);
}

function bindImageSelector(){
    window.handleSelectedImage = function(imageUrl, imageID){
        $('#mnu_image').val(imageUrl);
        $('#mnu_image').trigger('change');
    };

    $('#select_image').click(function(e){
        e.preventDefault();
        window.open(base_url + 'quan-ly-anh?type=select', '_blank', "toolbar=0,status=0,menubar=0,location=0,fullscreen=1,scrollbars=1");
    });

    $('#mnu_image').change(function(){
        var image_url = $(this).val();
        if (image_url.length)
            $('#preview_image').html('<img src="'+image_url+'" height=100 />');
        else
            $('#preview_image').html('');
    });
    $('#mnu_image').trigger('change');
}

$(document).ready(function(){
    bindImageSelector();

    $("#menu, .select2").select2();
    $("#menu").change(function(){
        var menu_id = $(this).val();
        if (menu_id == '')
            return;
        var params = {
            action: 'admin_load_menu',
            menu_id: menu_id
        };
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(return_data){
            unblockElement('#main-wrapper');
            if (return_data.status == 'OK'){
                var options = $.extend(editorOptions, {data: return_data.menu.items});
                $("#myList").html('');
                if (return_data.menu.items && return_data.menu.items.length) {
                    var items = jsonToObject(return_data.menu.items);
                    if (items !== null) {
                        var menu = createMenu(items, 0);
                        $("#myList").append(menu);
                    }
                } else {
                    showAlertError('Menu trống!');
                }
            }else{
                showAlertError(return_data.message);
            }
        },"json");
    });
    $('#mnu_text').change(function () {
        var value = $('#mnu_text').val();
        if ($('#mnu_short_text').val() == '')
            $('#mnu_short_text').val(value)
        if ($('#mnu_en_text').val() == '')
            $('#mnu_en_text').val(value)
    });
    menuEditor('myList', editorOptions);
    $("#menu").trigger('change');
});