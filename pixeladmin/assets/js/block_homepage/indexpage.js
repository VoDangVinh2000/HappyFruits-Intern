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

window.addEventListener("DOMContentLoaded", function () {
  const wrapListTypeBlock = document.querySelector("ol.list-type_block");

  const onUpOrDown = (from, to) => {
    let listTypeBlock = document.querySelectorAll("ol.list-type_block>li");
    wrapListTypeBlock.innerHTML = "";
    const array = [...listTypeBlock];
    array_move(array, from, to);

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
