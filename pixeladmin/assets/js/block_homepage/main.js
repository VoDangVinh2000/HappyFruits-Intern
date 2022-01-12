let arrayProductsSelected = [];
let arrayChecked = [];

// productsofblockshomepage
function appendProducts() {
  let htmlSelected = document.querySelector(".products-selected");
  if (htmlSelected) {
    htmlSelected.innerHTML = "";
    arrayProductsSelected.map((item, index, oldArray) => {
      htmlSelected.insertAdjacentHTML(
        "beforeend",
        `
      <li data-productid="${item?.id}">
      <input type="hidden" value="${item?.id}" name="product_id[]">
      <span class="code">${item?.code}</span>
      <span class="name">${item?.name}</span>
      <button  data-productid="${item?.id}" type="button" onclick="trashProduct(${item?.id})">Xóa</button>
      </li>
      `
      );
    });
  }
}

//Xóa sản phẩm không muốn hiển thị
function trashProduct(id) {
  arrayProductsSelected = unique();
  arrayProductsSelected = arrayProductsSelected.filter((item) => item.id != id);
  appendProducts();
}

//Lọc những sản phẩm bị trùng
function unique() {
  var newArr = [];
  newArr = arrayProductsSelected.filter(function (item) {
    return newArr.includes(item?.id) ? "" : newArr.push(item?.id);
  });
  return newArr;
}

window.addEventListener("DOMContentLoaded", function () {
  // {id: 198, code: 'D1A', name: 'Giỏ dâu size 1A', checked: true}
  const productsofblockshomepage = localStorage.getItem(
    "productsofblockshomepage"
  );
  if (productsofblockshomepage !== "undefined") {
    const arrayJsonProducts = JSON.parse(productsofblockshomepage) || [];
    arrayProductsSelected = arrayJsonProducts.map((product) => {
      return {
        id: product[0]?.product_id,
        code: product[0]?.code,
        name: product[0]?.name,
        checked: true,
      };
    });
    appendProducts();
  }

  function checkBox_products() {
    let table = $("#dataTables-block-productlist");
    checkedInput_notDrawTable(table);
    if (!table.on("draw.dt")) {
      checkedInput_notDrawTable(table);
    } else {
      //when datatable painted
      table.on("draw.dt", function () {
        let inputCkbox = document.getElementsByName("products_show[]");
        inputCkbox.forEach((e, index) => {
          e.addEventListener("change", function () {
            if (e.checked == false) {
              return false;
            }
            let tr_parent = table.closest("tr");
            //prevObject
            let prevObject = tr_parent.prevObject;
            //rows
            let rows = prevObject[0].rows;
            //get tag tr when checkbox at row of index
            let tr_child = rows[index + 1];

            let tr_id = tr_child.getAttribute("id");
            let td_code_value =
              tr_child.lastChild.parentNode.cells[1].lastChild.getAttribute(
                "value"
              );
            let td_name_value =
              tr_child.lastChild.parentNode.cells[2].firstChild.getAttribute(
                "value"
              );
            if (conditionLength() == true) {
              return;
            }
            arrayProductsSelected = [
              ...arrayProductsSelected,
              {
                id: parseInt(tr_id),
                code: td_code_value,
                name: td_name_value,
                checked: e.checked,
              },
            ];

            arrayProductsSelected = unique();
            appendProducts();
          });
        });
      });
    }
  }
  checkBox_products();
  //Hàm được thực thi khi table redered
  function checkedInput_notDrawTable(table) {
    let inputCkbox = document.getElementsByName("products_show[]");
    inputCkbox.forEach((e, index) => {
      e.addEventListener("change", function () {
        if (e.checked == false) {
          return false;
        }
        let tr_parent = table.closest("tr");
        //prevObject
        let prevObject = tr_parent.prevObject;
        //rows
        let rows = prevObject[0].rows;
        //get tag tr when checkbox at row of index
        let tr_child = rows[index + 1];

        let tr_id = tr_child.getAttribute("id");
        let td_code_value =
          tr_child.lastChild.parentNode.cells[1].lastChild.getAttribute(
            "value"
          );
        let td_name_value =
          tr_child.lastChild.parentNode.cells[2].firstChild.getAttribute(
            "value"
          );
        if (conditionLength() == true) {
          return;
        }
        arrayProductsSelected = [
          ...arrayProductsSelected,
          {
            id: parseInt(tr_id),
            code: td_code_value,
            name: td_name_value,
            checked: e.checked,
          },
        ];

        arrayProductsSelected = unique();
        appendProducts();
      });
    });
  }

  //Tối đa 4 sản phẩm (tùy theo nghiệp vụ)
  function conditionLength() {
    if (arrayProductsSelected.length == 4) {
      return true;
    }
  }

  /**
   * Thực hiện chọn mẫu hiển thị ra giao diện.
   */

  // html mẫu 1.
  function mau1(data = null) {
    let mau1 = `
		<div id="mau1">
			<div class="container">
					<div class="row">
							<div class="col-md-6" style="height: 300px; border: 1px solid #000; text-align: center; background-color: #999;" class="mau1-category">
									Category
							</div>

							<!-- right -->
							<div class="col-md-6">
									<div class="row">
											<div class="col-md-6" style="height: 150px;border: 1px solid #000; text-align: center; background-color: #999;" class="mau1-product1">
													product 1
											</div>
											<div class="col-md-6" style="height: 150px;border: 1px solid #000; text-align: center; background-color: #999;" class="mau1-product2">
													product 2
											</div>
											<div class="col-md-6" style="height: 150px;border: 1px solid #000; text-align: center; background-color: #999;" class="mau1-product3">
													product 3
											</div>
											<div class="col-md-6" style="height: 150px;border: 1px solid #000; text-align: center; background-color: #999;" class="mau1-product4">
													product 4
											</div>
									</div>
							</div>

					</div>
			</div>
		</div>
	`;
    return mau1;
  }

  // html mẫu 2
  function mau2(data = null) {
    let mau2 = `
		<div id="mau2">
			<div class="container">
					<div class="row">

							<div class="col-md-6">
									<div class="row">
											<div class="col-md-6" style="height: 150px;border: 1px solid #000; text-align: center; background-color: #999;" class="mau2-product1">
													product 1
											</div>
											<div class="col-md-6" style="height: 150px;border: 1px solid #000; text-align: center; background-color: #999;" class="mau2-product2">
													product 2
											</div>
											<div class="col-md-6" style="height: 150px;border: 1px solid #000; text-align: center; background-color: #999;" class="mau2-product3">
													product 3
											</div>
											<div class="col-md-6" style="height: 150px;border: 1px solid #000; text-align: center; background-color: #999;" class="mau2-product4">
													product 4
											</div>
									</div>
							</div>
							<!-- right -->
							<div class="col-md-6" style="height: 300px; border: 1px solid #000; text-align: center; background-color: #999;" class="mau2-category">
									Category
							</div>
					</div>
			</div>
	</div>
	`;
    return mau2;
  }

  function mau3(data = null) {
    return `
		<div id="mau3">
			<div class="container">
					<div class="row">
							<div class="col-md-6" style="height: 300px; border: 1px solid #000; text-align: center; background-color: #999;" class="mau3-category">
									Content Of Category
							</div>

							<!-- right -->
							<div class="col-md-6" style="height: 300px; border: 1px solid #000; text-align: center; background-color: #999;">
									Category Image
							</div>

					</div>
			</div>
		</div>
    `;
  }

  function mau4(data = null) {
    return `
		<div id="mau4">
			<div class="container">
					<div class="row">
							<div class="col-md-3" style="height: 220px; border: 1px solid #000; text-align: center; background-color: #999;" class="mau4-product1">
									Product 1
							</div>
							<div class="col-md-3" style="height: 220px; border: 1px solid #000; text-align: center; background-color: #999;" class="mau4-product2">
									Product 2
							</div>
							<div class="col-md-3" style="height: 220px; border: 1px solid #000; text-align: center; background-color: #999;" class="mau4-product3">
									Product 3
							</div>
							<div class="col-md-3" style="height: 220px; border: 1px solid #000; text-align: center; background-color: #999;" class="mau4-product4">
									Product 4
							</div>
					</div>
			</div>
		</div>
`;
  }

  function ChonMau(optionValue, mauElement, data = null) {
    if (optionValue == 1 && mauElement?.id == "mau") {
      mauElement.innerHTML = mau1();
    } else if (optionValue == 2) {
      mauElement.innerHTML = mau2();
    } else if (optionValue == 3) {
      mauElement.innerHTML = mau3();
    } else if (optionValue == 4) {
      mauElement.innerHTML = mau4();
    } else {
      mauElement.innerHTML = "";
    }
  }

  const option = document.querySelector("#chooseAvailableThemes");
  const mauElement = document.querySelector("#mau");

  const defaultOptionValue = option?.value ? option?.value : 1;
  ChonMau(defaultOptionValue, mauElement);

  if (option !== null) {
    option.addEventListener("change", function (e) {
      if (!Number.isNaN(Number(e.target.value))) {
        ChonMau(e.target.value, mauElement);
      }
    });
  }
});
