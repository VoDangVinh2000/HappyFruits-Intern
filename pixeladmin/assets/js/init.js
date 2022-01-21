var dataTables_oLanguage = {
  oPaginate: {
    sFirst: "&laquo;",
    sLast: "&raquo;",
    sNext: "&rsaquo;",
    sPrevious: "&lsaquo;",
  },
  sEmptyTable: "Không có dữ liệu.",
  sInfo: "Hiển thị _START_ đến _END_ trong _TOTAL_ dòng",
  sInfoEmpty: "",
  sInfoFiltered: "(tổng cộng _MAX_ dòng)",
  sLoadingRecords: "Đang tải...",
  sProcessing: "Đang xử lý...",
  sSearch: "Tìm kiếm: ",
  sZeroRecords: "Không có kết quả nào.",
  sLengthMenu: "_MENU_ dòng trên 1 trang",
};

var monthsFullArr = [
  "Tháng Giêng",
  "Tháng Hai",
  "Tháng Ba",
  "Tháng Tư",
  "Tháng Năm",
  "Tháng Sáu",
  "Tháng Bảy",
  "Tháng Tám",
  "Tháng Chín",
  "Tháng Mười",
  "Tháng Mười Một",
  "Tháng Mười Hai",
];
var monthsShortArr = [
  "Giêng",
  "Hai",
  "Ba",
  "Bốn",
  "Năm",
  "Sáu",
  "Bảy",
  "Tám",
  "Chín",
  "Mười",
  "Mười Một",
  "Mười Hai",
];
var weekdaysShortArr = ["CN", "Hai", "Ba", "Tư", "Năm", "Sáu", "Bảy"];
var processing_branch_id = 1;

$(document).ready(function () {
  bindNumber(".number");
  bindFloat(".float");
  bindNumber(".number-with-space", 1);
  $("select.select2").not(".hide-searchbox").select2();
  $("select.select2.hide-searchbox").select2({
    minimumResultsForSearch: Infinity,
  });

  //Prevent users from using enter to submit the form
  $("form")
    .not(".allow_enter")
    .find("input,select")
    .bind("keypress", function (e) {
      if (e.keyCode == 13) {
        //e.preventDefault();
        return false;
      }
    });

  if ($(".filter_section ul li").length == 0) $(".filter_section").remove();

  $("#main-navbar-notifications").slimScroll({ height: 250 });
  $("#main-navbar-messages").slimScroll({ height: 250 });
  var main_menu = new MainMenu();
  main_menu.init();

  $("#menu-account-profile .close").click(function (e) {
    e.preventDefault();
    $("#menu-account-profile").hide("slow");
  });

  if ($("div.note-success").length) {
    setTimeout(function () {
      $("div.note-success").hide("slow");
    }, 5000);
  }
});

function bindNumber(selector, allow_space) {
  $(selector).keydown(function (event) {
    // Allow special number + arrows
    if (
      event.keyCode == 46 ||
      event.keyCode == 8 ||
      event.keyCode == 9 ||
      event.keyCode == 27 ||
      event.keyCode == 13 ||
      (event.keyCode == 65 && event.ctrlKey === true) ||
      (event.keyCode == 67 && event.ctrlKey === true) ||
      (event.keyCode == 86 && event.ctrlKey === true) ||
      (event.keyCode >= 35 && event.keyCode <= 39) ||
      (typeof allow_space != "undefined" &&
        allow_space == 1 &&
        event.keyCode == 32)
    ) {
      return;
    } else {
      // If it's not a number stop the keypress
      if (
        event.shiftKey ||
        ((event.keyCode < 48 || event.keyCode > 57) &&
          (event.keyCode < 96 || event.keyCode > 105))
      ) {
        event.preventDefault();
      }
    }
  });
}

function bindFloat(selector) {
  $(selector).keydown(function (event) {
    // Allow special number + arrows + dot
    if (
      event.keyCode == 46 ||
      event.keyCode == 8 ||
      event.keyCode == 9 ||
      event.keyCode == 27 ||
      event.keyCode == 13 ||
      (event.keyCode == 65 && event.ctrlKey === true) ||
      (event.keyCode == 67 && event.ctrlKey === true) ||
      (event.keyCode == 86 && event.ctrlKey === true) ||
      (event.keyCode >= 35 && event.keyCode <= 39) ||
      event.keyCode == 190
    ) {
      /* Dot has been enter, so we stop the keypress */
      if ($(this).val().indexOf(".") > -1 && event.keyCode == 190) {
        event.preventDefault();
      }
      return;
    } else {
      // If it's not a number stop the keypress
      if (
        event.shiftKey ||
        ((event.keyCode < 48 || event.keyCode > 57) &&
          (event.keyCode < 96 || event.keyCode > 105))
      ) {
        event.preventDefault();
      }
    }
  });
}

function bindOnlyCharacter(selector) {
  $(selector).keydown(function (event) {
    // Allow special chars + arrows
    if (
      event.keyCode == 46 ||
      event.keyCode == 8 ||
      event.keyCode == 9 ||
      event.keyCode == 27 ||
      event.keyCode == 13 ||
      (event.keyCode == 65 && event.ctrlKey === true) ||
      (event.keyCode == 67 && event.ctrlKey === true) ||
      (event.keyCode == 86 && event.ctrlKey === true) ||
      (event.keyCode >= 65 && event.keyCode <= 90)
    ) {
      return;
    } else {
      event.preventDefault();
    }
  });
}

function addMoneyStringAlong(selector, cssStype) {
  if (typeof cssStype == "undefined") cssStype = "";
  var now = new Date();
  var rand = now.getTime();
  $(selector).attr("data-rand-id", rand);
  $(selector).after(
    '<span id="' +
      rand +
      '" class="money-label" style="' +
      cssStype +
      '"></span>'
  );
  $(selector).keyup(function () {
    var r = $(this).attr("data-rand-id");
    $("#" + r).html(money_format($(this).val()) + "đ");
  });
  $(selector).trigger("keyup");
}

/* Updates column */
function update(tablename, id, field, new_value, callbackFnc) {
  var parameters = {};
  parameters["action"] = "admin_edit";
  parameters["id"] = id;
  parameters["field"] = field;
  parameters["value"] = new_value;
  parameters["table_name"] = tablename;
  blockElement("#main-wrapper");
  $.post(
    postback_url,
    parameters,
    function (data) {
      unblockElement("#main-wrapper");
      if (data.status != "OK") showAlertError(data.message);
      else if (typeof callbackFnc == "function") callbackFnc();
    },
    "json"
  );
}

/* Deletes row */
function deleteById(tablename, id, redirect) {
  var parameters = {};
  parameters["action"] = "admin_delete";
  parameters["id"] = id;
  parameters["table_name"] = tablename;
  blockElement("#main-wrapper");
  $.post(
    postback_url,
    parameters,
    function (data) {
      if (data.status == "OK") {
        if (typeof search == "function") search();
        else if (typeof reload == "function") reload();
        else window.location.href = base_url + redirect;
      } else {
        unblockElement("#main-wrapper");
        showAlertError(data.message);
      }
    },
    "json"
  );
}

function isValidForm(id) {
  return !$("#" + id + " button#submit").hasClass("disabled");
}

function bindEventForTableFilters(selector) {
  $(selector).unbind("change");
  $(selector).change(function () {
    var id = $(this).attr("id");
    var value = $(this).val();
    $(".for_datatable_filter #" + id + " option").removeAttr("selected");
    $(".for_datatable_filter #" + id + ' option[value="' + value + '"]').attr(
      "selected",
      ""
    );
    if (typeof search == "function") search();
  });
  if (
    $("#filter_search").length &&
    $("#filter_start_date").length &&
    $("#filter_end_date").length
  ) {
    $("#filter_search").after(
      '&nbsp;<a id="filter_search_today" class="btn btn-success"><i class="fa fa-search"></i>&nbsp;Hôm nay</a>'
    );
    $("#filter_search_today").click(function () {
      startDate = endDate = new Date();
      $("#filter_start_date").datepicker("setDate", startDate);
      $("#filter_end_date").datepicker("setDate", endDate);
      if (typeof search == "function") search();
    });
  }
}

function bindFilterInput() {
  $(".dataTables_filter #filter_keyword").change(function () {
    $(".for_datatable_filter #filterString").val($(this).val());
  });
}

function callbackSaveAction(formID, data) {
  unblockElement("#main-wrapper");
  $("#" + formID + " #submit").attr("disabled", false);
  $("#" + formID + " #submit span").text("Lưu");
  if (data.status == "OK") {
    $("html, body").animate({ scrollTop: 0 }, 300);
    if (window.location.href.indexOf("/them") != -1) {
      if (typeof data.redirect_url != "undefined" && data.redirect_url)
        window.location.href = data.redirect_url;
      else if (typeof URIs[table_name] != "undefined" && URIs[table_name])
        window.location.href = base_url + URIs[table_name];
      else window.location.href = base_url;
    } else {
      if (typeof data.redirect_url != "undefined" && data.redirect_url) {
        window.location.href = data.redirect_url;
      } else {
        showNotifcation("Lưu thành công.", "success");
      }
    }
  } else {
    showAlertError(data.message);
  }
}

function sanitize_string(str) {
  str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, "a", str);
  str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, "e", str);
  str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, "i", str);
  str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, "o", str);
  str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, "u", str);
  str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, "y", str);
  str = str.replace(/(đ)/g, "d", str);
  str = str.replace(/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/g, "A", str);
  str = str.replace(/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/g, "E", str);
  str = str.replace(/(Ì|Í|Ị|Ỉ|Ĩ)/g, "I", str);
  str = str.replace(/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/g, "O", str);
  str = str.replace(/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/g, "U", str);
  str = str.replace(/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/g, "Y", str);
  str = str.replace(/(Đ)/g, "D", str);
  str = str.replace(/[^a-zA-Z0-9 ]/g, "", str);
  str = str.replace(/ /g, "-", str);
  return str.toLowerCase();
}

function setLastColumnWidth() {
  var table_width = $("table.dataTable.dt-responsive").width();
  var col_width = 0;
  $("table.dataTable.dt-responsive thead th").each(function () {
    col_width = $(this).outerWidth();
    table_width -= col_width;
  });
  $("table.dataTable.dt-responsive thead th:last").width(
    col_width + table_width
  );
}

function showAlertError(msg) {
  bootbox.alert({
    message: msg,
    callback: function () {},
    className: "bootbox-sm",
  });
}
function showConfirmBox(msg, yes_callback, no_callback) {
  bootbox.confirm({
    message: msg,
    callback: function (result) {
      if (result) yes_callback();
      else no_callback();
    },
    className: "bootbox-sm",
    buttons: {
      cancel: {
        label: "Không",
      },
      confirm: {
        label: "Có",
        className: "btn-danger pull-right",
      },
    },
  });
}
/* danger, success, info */
function showNotifcation(msg, type) {
  if (typeof type == "undefined") type = "danger";
  alerts.init();
  var options = {
    type: type,
    auto_close: 2,
    namespace: "pa_page_alerts_default",
  };
  scrollToTop();
  alerts.add(msg, options);
}

function scrollToTop() {
  $("html, body").animate({ scrollTop: 0 });
}

function getBranchLatLng() {
  if (google)
    return new google.maps.LatLng(
      branches[processing_branch_id].lat,
      branches[processing_branch_id].lng
    );
  return null;
}

function getBranchSaddr() {
  return (
    branches[processing_branch_id].lat +
    "," +
    branches[processing_branch_id].lng
  );
}

function getParameters(selector) {
  var params = {};
  if ($(selector).is("form")) var formdata = $(selector).serializeArray();
  else var formdata = $(selector + " *").serializeArray();
  $(formdata).each(function (index, obj) {
    console.log(obj);
    if (obj.name.indexOf("[]") != -1) {
      obj.name = obj.name.replace("[]", "");
      if (typeof params[obj.name] == "undefined") {
        params[obj.name] = [];
      }
      params[obj.name].push(obj.value);
    } else params[obj.name] = obj.value;
  });
  return params;
}

function money_format(input, separator) {
  if (typeof separator == "undefined" || separator.length > 1) separator = ".";
  if (isNaN(input) || input == 0) {
    return 0;
  } else {
    input = parseFloat(input).toFixed(0);
    input = input.toString();
    var s = "";
    for (var i = input.length - 1, j = 1; i >= 0; i--, j++) {
      s += input[i];
      if (j % 3 == 0 && i > 0) s += separator;
    }
    var r = "";
    for (var i = s.length - 1; i >= 0; i--) r += s[i];
    return r;
  }
}

function parse_money(input) {
  return parseFloat(input.replace(/\./g, ""));
}
