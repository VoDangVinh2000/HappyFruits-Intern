window.addEventListener("DOMContentLoaded", function () {
  // lấy danh sách sản phẩm được từ database lưu tại local.
  const productsFromLocalStorage = localStorage.getItem(
    "productsofblockshomepage"
  );

  // nếu có giá trị sẽ thực hiện load danh sách sản phẩm đã được chọn lên.
  if (productsFromLocalStorage !== "undefined") {
    // nơi hiện sản phẩm đã được chọn.
    let elementToShowProductsSelected =
      document.querySelector(".products-selected");

    // Chuyển đổi từ chuổi thành json.
    const arrayJsonProducts = JSON.parse(productsFromLocalStorage) || [];

    // tạo mẫu dữ liệu sẽ hiển thị lên giao diện.
    const arrayProductsSelected = arrayJsonProducts.map((product) => {
      return {
        id: product[0]?.product_id,
        code: product[0]?.code,
        name: product[0]?.name,
        checked: true,
      };
    });

    // reset hiển thị.
    elementToShowProductsSelected.innerHTML = "";

    // duyệt và hiển thị danh sách products.
    arrayProductsSelected.forEach((item) => {
      elementToShowProductsSelected.insertAdjacentHTML(
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

    // Xử lý check box.
    const table = $("#dataTables-block-productlist");

    // trường hợp khi form load lại, thì check xem, có tồn tại trong danh sách lựa chọn thì checked = true.
    table.on("draw.dt", function () {
      let listCheckBox = document.getElementsByName("products_show[]");
      listCheckBox.forEach((ckBox) => {
        if (
          arrayProductsSelected.find(
            (item) => item.id === parseInt(ckBox.dataset.productid)
          ) !== undefined
        ) {
          ckBox.checked = true;
        }
      });
    });

    let listCheckBox = document.getElementsByName("products_show[]");

    listCheckBox.forEach((ckBox) => {
      if (
        arrayProductsSelected.find(
          (item) => item.id === parseInt(ckBox.dataset.productid)
        ) !== undefined
      ) {
        ckBox.checked = true;
      }
    });
  }

  // xử lý click vào checkbox.
  const tbodyProducts = document.querySelector("#tbody-products");
  tbodyProducts.addEventListener("click", ({ target }) => {
    if (
      target.dataset?.productid !== undefined &&
      target.type !== undefined &&
      target.type === "checkbox"
    ) {
      const parent = target.parentElement.parentElement;
      const name = parent.childNodes[5].childNodes[0].value;
      const code = parent.childNodes[3].childNodes[0].value;
      const id = parseInt(target.dataset?.productid);
      const checked = target.checked;

      // nếu checked là false thì remove khỏi danh sách dựa theo id.
      let parentListProduct = document.querySelector(".products-selected");
      let listProduct = document.querySelectorAll(".products-selected>li");
      if (checked === false) {
        listProduct.forEach((product) => {
          if (parseInt(product.dataset.productid) === id) {
            parentListProduct.removeChild(product);
          }
        });
      } else if (checked === true) {
        // nếu checked là true thì kiểm tra số lượng <= 4 , rồi thêm vào.
        // nếu để là <= 4, sẽ chạy lỗi, vì khi click thêm, thì chương trình đếm được 4,
        //  và sau đó thêm 5, vậy thì số 5 vẫn được thêm
        if (listProduct.length < 4) {
          const html = `
          <li data-productid="${id}">
            <input type="hidden" value="${id}" name="product_id[]">
            <span class="code">${code}</span>
            <span class="name">${name}</span>
            <button data-productid="${id}" type="button" onclick="trashProduct(${id})">Xóa</button>
          </li>
          `;
          parentListProduct.insertAdjacentHTML("beforeend", html);
        } else {
          target.checked = false
        }
      }
    }
  });

  /**
   * Thực hiện chọn mẫu hiển thị ra giao diện.
   */

  // html mẫu 1.
  function mau1() {
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
  function mau2() {
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

  function mau3() {
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

  function mau4() {
    return `<div id="mau4"></div>`;
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
