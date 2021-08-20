$('button[name=btnEdit]').each(function (index, element) {//click vao nut edit san pham
    var modal_body = $('.modal-body');
    $(element).click(function () {
        let id = $('input[id=idGiayDep]').eq(index).val();
        //lay id san pham bang ajax 
        $.ajax({
            type: "GET",
            url: "../controllers/getIDGiayDepPageSearch.php?id=" + parseInt(id) + "",
            data: id,
            success: function (data) {
                $('#modal-body-search-edit').append(data);
            }
        });
        $('#modal-body-search-edit').html("");
    });
});
$('button[name=btnDelete]').each(function (index, element) {//click vao nut edit san pham
    var modal_body = $('.modal-body');
    $(element).click(function () {
        let id = $('input[id=idGiayDep]').eq(index).val();
        //lay id san pham bang ajax
        $.ajax({
            type: "GET",
            url: "../controllers/getIDGiayDep.php?idDelete=" + parseInt(id) + "",
            data: id,
            success: function (data) {
                $('#modal-body-delete').append(data);

            }

        });
        $('#modal-body-delete').html("");
    });
});