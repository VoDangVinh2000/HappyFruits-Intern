// di chuyển phần tử mảng.
function array_move(arr = [], old_index, new_index) {
  if (old_index < 0 || new_index > arr.length - 1) {
    return arr;
  }

  while (old_index < 0) {
    old_index += arr.length;
  }
  while (new_index < 0) {
    new_index += arr.length;
  }
  if (new_index >= arr.length) {
    var k = new_index - arr.length + 1;
    while (k--) {
      arr.push(undefined);
    }
  }
  arr.splice(new_index, 0, arr.splice(old_index, 1)[0]);
  return arr; // for testing purposes
}

// so sánh. danh sách id.
function compareListTypeBlockHomePage(listA, listB) {
  const array1 = [...listA].map((item) => item.dataset.itemid);
  const array2 = [...listB].map((item) => item.dataset.itemid);
  return (
    array1.length === array2.length &&
    array1.every(function (value, index) {
      return value === array2[index];
    })
  );
}

window.addEventListener("DOMContentLoaded", function () {
  const wrapListTypeBlock = document.querySelector("ol.list-type_block");

  // dùng để lấy dữ liệu các (li) khi lần đầu load trang web.
  const LIST_TYPE_BLOCK = document.querySelectorAll("ol.list-type_block>li");

  // Form để cập nhập position cho block homepage.
  const updatePositionBlockHomePage = document.querySelector(
    "#updatePositionBlockHomePage"
  );
  // mặc định không hiện, chỉ khi dữ liệu bị thay đổi.
  updatePositionBlockHomePage.style.display = "none";

  // Lưu dữ liệu lên form
  const listIdUpdatePosition = document.querySelector("#listIdUpdatePosition");

  // Tạo giá trị mặc định cho form.
  const listItemIDDefault = [...LIST_TYPE_BLOCK].map(
    (item) => item.dataset.itemid
  );
  listIdUpdatePosition.value = listItemIDDefault.join(",");

  // sắp xếp và cập nhập dữ liệu cho việc: submit update form,
  const onUpOrDown = (from, to) => {
    // mỗi lần click nút mũi tên thì lấy lại giá trị trước khi cập nhập.
    let listTypeBlock = document.querySelectorAll("ol.list-type_block>li");

    // clear nội dung trong element OL
    wrapListTypeBlock.innerHTML = "";

    // thực hiện sắp xếp từ danh sách (li) đã được lấy
    const array = [...listTypeBlock];
    array_move(array, from, to);

    // lấy dữ liệu id liên tụ để cập nhập giá trị hidden của form.
    const listItemID = array.map((item) => item.dataset.itemid);
    listIdUpdatePosition.value = listItemID.join(",");

    // Hiện form nếu phát hiện dữ liệu thay đổi, người dùng có quyền ấn cập nhập.
    if (compareListTypeBlockHomePage(LIST_TYPE_BLOCK, array) === false) {
      updatePositionBlockHomePage.style.display = "block";
    } else {
      updatePositionBlockHomePage.style.display = "none";
    }

    // Thực hiện hiển thị lại dữ liệud đã được sắp xếp.
    array.forEach((item, index) => {
      item.firstElementChild.innerText = `Thứ tự hiển thị: ${index + 1}`;
      item
        .querySelectorAll("button.btn")
        .forEach((button) => (button.dataset.posid = index + 1));
      item
        .querySelectorAll("i.fa")
        .forEach((i) => (i.dataset.posid = index + 1));
      wrapListTypeBlock.innerHTML += `<li class="list-group-item" data-posid='${
        index + 1
      }' data-itemid='${item.dataset.itemid}'>${item.innerHTML}</li>`;
    });
  };

  // Khi click vào button lên xuống sẽ thực hiện hàm onUpOrDown.
  wrapListTypeBlock.addEventListener("click", (e) => {
    if (e.target.classList.value.includes("move-up")) {
      onUpOrDown(
        Number(e.target.dataset.posid) - 1,
        Number(e.target.dataset.posid) - 2
      );
    } else if (e.target.classList.value.includes("move-down")) {
      onUpOrDown(
        Number(e.target.dataset.posid) - 1,
        Number(e.target.dataset.posid)
      );
    }
  });
});

// nếu ấn nút thêm mới sẽ thêm một block mới v à reload lại trang.
$(document).ready(function () {
  $("#addNewBlockHomePage").submit(function () {
    var params = $("#addNewBlockHomePage").serialize() + "&ajax=1";
    $("#addNewBlockHomePage #submit").attr("disabled", true);
    $("#addNewBlockHomePage #submit span").text("Đang lưu...");
    blockElement("#main-wrapper");
    $.post(
      postback_url,
      params,
      function (data) {
        if (data.status === "OK") {
          setTimeout(function () {
            window.location.reload();
          }, 1200);
        }
        callbackSaveAction("addNewBlockHomePage", data);
      },
      "json"
    );
    return false;
  });
});

// nếu ấn nút thêm mới sẽ thêm một block mới v à reload lại trang.
$(document).ready(function () {
  $("#updatePositionBlockHomePage").submit(function () {
    var params = $("#updatePositionBlockHomePage").serialize() + "&ajax=1";
    $("#updatePositionBlockHomePage #submit").attr("disabled", true);
    $("#updatePositionBlockHomePage #submit span").text("Đang lưu...");
    blockElement("#main-wrapper");
    $.post(
      postback_url,
      params,
      function (data) {
        if (data.status === "OK") {
          setTimeout(function () {
            window.location.reload();
          }, 1200);
        }
        callbackSaveAction("updatePositionBlockHomePage", data);
      },
      "json"
    );
    return false;
  });
});
