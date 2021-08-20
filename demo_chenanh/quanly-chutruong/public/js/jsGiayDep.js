const divThemGiayDep = document.getElementById('form-themGiayDep');
const btnThem = document.getElementById('btnThemGiayDep');
const divShow = document.getElementById('showAllProduct');
const divThemTrangThai = document.getElementById('form-themTrangThai');
const divThemTenLoai = document.getElementById('form-themTenLoai');
const divXemTrangThai = document.getElementById('form-showAllTrangThai');
const divXemLoai = document.getElementById('form-showAllLoai');
const divAnhNoiBat = document.getElementById('form-AnhNoiBat');
const divThemAnhNoiBat = document.getElementById('form-themAnhNoiBat');
function btnThemAnhNB() {
    if (divThemAnhNoiBat.style.display == "none") {
        divThemAnhNoiBat.style.display = "block";
        divAnhNoiBat.style.display = "none";
        divXemLoai.style.display = "none";
        divXemTrangThai.style.display = "none";
        divThemGiayDep.style.display = "none";
        divShow.style.display = "none";
        divThemTrangThai.style.display = "none";
        divThemTenLoai.style.display = "none";
    }
    else {
        divThemAnhNoiBat.style.display = "none";
        divAnhNoiBat.style.display = "none";
        divXemLoai.style.display = "none";
        divXemTrangThai.style.display = "none";
        divThemGiayDep.style.display = "none";
        divShow.style.display = "block";
        divThemTrangThai.style.display = "none";
        divThemTenLoai.style.display = "none";
    }
}
function btnAnhNoiBat() {
    if (divAnhNoiBat.style.display == "none") {
        divAnhNoiBat.style.display = "block";
        divThemAnhNoiBat.style.display = "none";
        divXemLoai.style.display = "none";
        divXemTrangThai.style.display = "none";
        divThemGiayDep.style.display = "none";
        divShow.style.display = "none";
        divThemTrangThai.style.display = "none";
        divThemTenLoai.style.display = "none";
    }
    else {
        divAnhNoiBat.style.display = "none";
        divXemLoai.style.display = "none";
        divXemTrangThai.style.display = "none";
        divThemGiayDep.style.display = "none";
        divShow.style.display = "block";
        divThemTrangThai.style.display = "none";
        divThemAnhNoiBat.style.display = "none";
        divThemTenLoai.style.display = "none";
    }
}
function btnXemTrangThai() {
    if (divXemTrangThai.style.display == "none") {
        divAnhNoiBat.style.display = "none";
        divXemLoai.style.display = "none";
        divXemTrangThai.style.display = "block";
        divThemGiayDep.style.display = "none";
        divShow.style.display = "none";
        divThemAnhNoiBat.style.display = "none";
        divThemTrangThai.style.display = "none";
        divThemTenLoai.style.display = "none";
    }
    else {
        divXemTrangThai.style.display = "none";
        divAnhNoiBat.style.display = "none";;
        divXemLoai.style.display = "none";
        divThemGiayDep.style.display = "none";
        divThemAnhNoiBat.style.display = "none";
        divShow.style.display = "block";
        divThemTrangThai.style.display = "none";
        divThemTenLoai.style.display = "none";
    }
}
function btnXemLoai() {
    if (divXemLoai.style.display == "none") {
        divAnhNoiBat.style.display = "none";
        divXemLoai.style.display = "block";
        divXemTrangThai.style.display = "none";
        divThemAnhNoiBat.style.display = "none";
        divThemGiayDep.style.display = "none";
        divShow.style.display = "none";
        divThemTrangThai.style.display = "none";
        divThemTenLoai.style.display = "none";
    }
    else {
        divAnhNoiBat.style.display = "none";
        divXemLoai.style.display = "none";
        divXemTrangThai.style.display = "none";
        divThemGiayDep.style.display = "none";
        divThemAnhNoiBat.style.display = "none";
        divShow.style.display = "block";
        divThemTrangThai.style.display = "none";
        divThemTenLoai.style.display = "none";
    }
}
function btnThemGiayDep() {
    if (divThemGiayDep.style.display == "none") {
        divXemLoai.style.display = "none";
        divAnhNoiBat.style.display = "none";
        divThemGiayDep.style.display = "block";
        divShow.style.display = "none";
        divThemTrangThai.style.display = "none";
        divThemAnhNoiBat.style.display = "none";
        divThemTenLoai.style.display = "none";
        divXemTrangThai.style.display = "none";
    }
    else {
        divThemGiayDep.style.display = "none";
        divAnhNoiBat.style.display = "none";
        divXemLoai.style.display = "none";
        divShow.style.display = "block";
        divThemAnhNoiBat.style.display = "none";
        divThemTrangThai.style.display = "none";
        divThemTenLoai.style.display = "none";
        divXemTrangThai.style.display = "none";
    }
}
function btnThemTrangThai() {

    if (divThemTrangThai.style.display == "none") {
        divXemLoai.style.display = "none";
        divThemAnhNoiBat.style.display = "none";
        divThemTrangThai.style.display = "block";
        divAnhNoiBat.style.display = "none";
        divThemGiayDep.style.display = "none";
        divShow.style.display = "none";
        divThemTenLoai.style.display = "none";
        divXemTrangThai.style.display = "none";
    }
    else {
        divThemTrangThai.style.display = "none";
        divAnhNoiBat.style.display = "none";
        divThemAnhNoiBat.style.display = "none";
        divXemLoai.style.display = "none";
        divThemGiayDep.style.display = "none";
        divShow.style.display = "block";
        divThemTenLoai.style.display = "none";
        divXemTrangThai.style.display = "none";
    }
}
function btnThemTenLoai() {
    if (divThemTenLoai.style.display == "none") {
        divXemLoai.style.display = "none";
        divThemTenLoai.style.display = "block";
        divThemTrangThai.style.display = "none";
        divAnhNoiBat.style.display = "none";
        divThemAnhNoiBat.style.display = "none";
        divThemGiayDep.style.display = "none";
        divShow.style.display = "none";
        divXemTrangThai.style.display = "none";
    }
    else {
        divThemTenLoai.style.display = "none";
        divThemTrangThai.style.display = "none";
        divXemLoai.style.display = "none";
        divThemAnhNoiBat.style.display = "none";
        divThemGiayDep.style.display = "none";
        divAnhNoiBat.style.display = "none";
        divShow.style.display = "block";
        divXemTrangThai.style.display = "none";
    }
}
$(document).ready(function () {
    let sizeSelectTrangThai = $('#trangThai > option');
    let sizeSelectTenLoai = $('#tenLoai option');
    let thongBaoTT = document.getElementById('notificationTT');
    let thongBaoTL = document.getElementById('notificationTL');
    if (sizeSelectTrangThai.length < 1) {
        thongBaoTT.style.display = "block";
    }
    if (sizeSelectTenLoai.length < 1) {
        thongBaoTL.style.display = "block";
    }
    //btn hien thi cho anh noi bat
    // $('input[name=gender]').each(function(index,element){
    //     alert($(element).val() + "vi tri : " + index);
    //  });
    $('input[name=gender]').each(function (index, element) {
        $(element).click(function () {
            let idAnhNB = $('input[name=idAnhNB]').eq(index).val();
            // $.ajax({
            //     type: "GET",
            //     url: "../controllers/getIDAnhNoiBat.php?idCheckRadio=" + parseInt(idAnhNB) + "",
            //     data: idAnhNB,
            //     success: function (data) {
            //        alert(data);
            //     }

            // });

        });
    })


//end btn hien thi cho anh noi bat
$('button[name=btnEdit]').each(function (index, element) {//click vao nut edit san pham
    var modal_body = $('.modal-body');
    $(element).click(function () {
        let id = $('input[id=idGiayDep]').eq(index).val();
        //lay id san pham bang ajax
        $.ajax({

            type: "GET",
            url: "../controllers/getIDGiayDep.php?id=" + parseInt(id) + "",
            data: id,
            success: function (data) {
                $('#modal-body').append(data);

            }

        });
        $('#modal-body').html("");
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
$('button[name=btnEditTrangThai]').each(function (index, element) {//click vao nut edit trang thai
    var modal_body = $('.modal-body');
    $(element).click(function () {
        let id = $('input[id=idTrangThai]').eq(index).val();
        //lay id san pham bang ajax
        $.ajax({

            type: "GET",
            url: "../controllers/getIDTrangThai.php?id=" + id + "",
            data: id,
            success: function (data) {
                $('#modal-body-edtTrangThai').append(data);

            }

        });
        $('#modal-body-edtTrangThai').html("");
    });
})
$('button[name=btnDeleteTrangThai]').each(function (index, element) {//click vao nut edit trang thai
    var modal_body = $('.modal-body');
    $(element).click(function () {
        let id = $('input[id=idTrangThai]').eq(index).val();
        //lay id san pham bang ajax
        $.ajax({
            type: "GET",
            url: "../controllers/getIDTrangThai.php?idDeleteTT=" + id + "",
            data: id,
            success: function (data) {
                $('#modal-body-deleteTT').append(data);

            }

        });
        $('#modal-body-deleteTT').html("");
    });
})
$('button[name=btnEditLoai]').each(function (index, element) {//click vao nut edit loai
    $(element).click(function () {
        let id = $('input[id=idLoai]').eq(index).val();
        //lay id san pham bang ajax
        $.ajax({
            type: "GET",
            url: "../controllers/getIDLoai.php?id=" + id + "",
            data: id,
            success: function (data) {
                $('#modal-body-edtLoai').append(data);

            }

        });
        $('#modal-body-edtLoai').html("");
    });
})
$('button[name=btnDeleteLoai]').each(function (index, element) {//click vao nut delete loai
    $(element).click(function () {
        let id = $('input[id=idLoai]').eq(index).val();
        //lay id san pham bang ajax
        $.ajax({
            type: "GET",
            url: "../controllers/getIDLoai.php?idDeleteTL=" + id + "",
            data: id,
            success: function (data) {
                $('#modal-body-deleteLoai').append(data);

            }

        });
        $('#modal-body-deleteLoai').html("");
    });
})
//btnEditAnhNB
$('button[name=btnEditAnhNB]').each(function (index, element) {//click vao nut edit anh nb
    $(element).click(function () {
        let id = $('input[name=idAnhNB]').eq(index).val();
        //lay id san pham bang ajax
        $.ajax({
            type: "GET",
            url: "../controllers/getIDAnhNoiBat.php?idAnhNB=" + id + "",
            data: id,
            success: function (data) {
                $('#modal-body-edtAnhNB').append(data);

            }

        });
        $('#modal-body-edtAnhNB').html("");
    });
})
//btnDeleteAnhNB
$('button[name=btnDeleteAnhNB]').each(function (index, element) {//click vao nut delete anh nb
    $(element).click(function () {
        let id = $('input[name=idAnhNB]').eq(index).val();
        //lay id san pham bang ajax
        $.ajax({
            type: "GET",
            url: "../controllers/getIDAnhNoiBat.php?idDeleteAnhNB=" + id + "",
            data: id,
            success: function (data) {
                $('#modal-body-deleteAnhNB').append(data);

            }

        });
        $('#modal-body-deleteAnhNB').html("");
    });
})
});

