let arrayProductsSelected = [];
let arrayChecked = [];
function appendProducts() {
	let htmlSelected = document.querySelector('.products-selected');
	htmlSelected.innerHTML = "";
	arrayProductsSelected.map((item, index) => {
		htmlSelected.insertAdjacentHTML('beforeend', '<div class="sttProducts">'
			+ (index + 1) + '</div><div class="code"><p>' + item.code
			+ '</p></div><div class="name"><p>' + item.name
			+ '</p></div> <div class="trash"><button onclick="trashProduct(' + item.id + ')" type="button">Xóa</button></div>');
	});
}
//Xóa sản phẩm không muốn hiển thị
function trashProduct(id) {
	arrayProductsSelected = unique();
	arrayProductsSelected = arrayProductsSelected.filter(item => item.id != id);
	appendProducts();
}

//Lọc những sản phẩm bị trùng
function unique() {
	var newArr = [];
	newArr = arrayProductsSelected.filter(function (item) {
		return newArr.includes(item.id) ? '' : newArr.push(item.id)
	})
	return newArr;
}

window.addEventListener('DOMContentLoaded', function () {

	// 	// lay id "mau" -- để hiển thị html mẫu đã tạo.
	// const mau = document.querySelector('#mau');

	// // Khi select option thay đổi.
	// function selectOption() {
	// 	let option = document.querySelector('#chooseAvailableThemes');
	// 	//Gọi hàm ngay khi selectOption được gọi
	// 	getValueInitial_Option(option);
	// 	//Nếu option có sự thay đổi
	// 	option.addEventListener('change', function () {
	// 		let themeChoosing = option.value != "default" ? getValueOption(option) : 'Vui lòng chọn mẫu';

	// 		mau.innerHTML = themeChoosing;
	// 		// console.log(themeChoosing);
	// 	});
	// 	//Nếu option không thay đổi
	// 	// console.log(getValueInitial_Option(option));
	// }
	// function getValueOption(option) {
	// 	if (option.value == 1) {
	// 		return mau1();
	// 	}
	// 	else if (option.value == 2) {
	// 		return mau2();
	// 	}
	// }
	// //Sự kiện lấy ngay giá trị option selected được chọn ngay khi load page
	// function getValueInitial_Option(option) {
	// 	return getValueOption(option);
	// }

	// selectOption();

	//Thực hiện xử lý checkbox cho việc chọn các sản phẩm hiển thị
	// let arrayProductsSelected = [];
	// let arrayChecked = [];
	function checkBox_products() {
		let table = $('#dataTables-block-productlist');
		checkedInput_notDrawTable(table);
		if (!table.on('draw.dt')) {

			checkedInput_notDrawTable(table);
		}
		else {
			//when datatable painted
			table.on('draw.dt', function () {
				let inputCkbox = document.getElementsByName('products_show[]');
				inputCkbox.forEach((e, index) => {
					e.addEventListener('change', function () {
						if (e.checked == false) {
							return false;
						}
						let tr_parent = table.closest('tr');
						//prevObject
						let prevObject = tr_parent.prevObject;
						//rows
						let rows = prevObject[0].rows;
						//get tag tr when checkbox at row of index
						let tr_child = rows[index + 1];

						// // let value_td = tr_child.lastChild.parentNode.cells[1].innerHTML;
						let tr_id = tr_child.getAttribute('id');
						// console.log(tr_id);
						let td_code_value = tr_child.lastChild.parentNode.cells[1].lastChild.getAttribute('value');
						let td_name_value = tr_child.lastChild.parentNode.cells[2].firstChild.getAttribute('value');
						if (conditionLength() == true) {
							return;
						}
						arrayProductsSelected = [...arrayProductsSelected, {
							"id": parseInt(tr_id), "code": td_code_value
							, "name": td_name_value, "checked": e.checked
						}];

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

		let inputCkbox = document.getElementsByName('products_show[]');
		inputCkbox.forEach((e, index) => {
			e.addEventListener('change', function () {
				if (e.checked == false) {
					return false;
				}
				let tr_parent = table.closest('tr');
				//prevObject
				let prevObject = tr_parent.prevObject;
				//rows
				let rows = prevObject[0].rows;
				//get tag tr when checkbox at row of index
				let tr_child = rows[index + 1];

				// // let value_td = tr_child.lastChild.parentNode.cells[1].innerHTML;
				let tr_id = tr_child.getAttribute('id');
				// console.log(tr_id);
				let td_code_value = tr_child.lastChild.parentNode.cells[1].lastChild.getAttribute('value');
				let td_name_value = tr_child.lastChild.parentNode.cells[2].firstChild.getAttribute('value');
				if (conditionLength() == true) {
					return;
				}
				arrayProductsSelected = [...arrayProductsSelected, {
					"id": parseInt(tr_id), "code": td_code_value
					, "name": td_name_value, "checked": e.checked
				}];

				arrayProductsSelected = unique();
				appendProducts();

			});
		});
	}

	function getIndexCheckedProducts() {
		// let table = $('#dataTables-block-productlist');
		// if(!table.on('draw.dt')){
		// 	let inputCkbox = document.getElementsByName('products_show[]');
		// 		inputCkbox.forEach((e,index) => {
		// 		e.addEventListener('change',function(){
		// 			if(e.checked == false){
		// 				return false;
		// 			}
		// 			let tr_parent = table.closest('tr');
		// 			//prevObject
		// 			let prevObject = tr_parent.prevObject;

		// 			//rows
		// 			let rows = prevObject[0].rows;
		// 			//get tag tr when checkbox at row of index
		// 			let tr_child = rows[index + 1];
		// 			let inputCheckbox = tr_child.lastChild.parentNode.cells[5].lastChild.previousSibling;
		// 			return inputCheckbox;
		// 			// inputCheckbox.disabled = true;
		// 			// inputCheckbox.checked = false;
		// 		});
		// 	});
		// }
		// else{
		// 	let inputCkbox = document.getElementsByName('products_show[]');
		// 		inputCkbox.forEach((e,index) => {
		// 		e.addEventListener('change',function(){
		// 			if(e.checked == false){
		// 				return false;
		// 			}
		// 			let tr_parent = table.closest('tr');
		// 			//prevObject
		// 			let prevObject = tr_parent.prevObject;

		// 			//rows
		// 			let rows = prevObject[0].rows;
		// 			//get tag tr when checkbox at row of index
		// 			let tr_child = rows[index + 1];
		// 			// let value_td = tr_child.lastChild.parentNode.cells[1].innerHTML;
		// 			// let tr_id = tr_child.getAttribute('id');
		// 			// let td_code_value = tr_child.lastChild.parentNode.cells[1].lastChild.getAttribute('value');
		// 			// let td_name_value = tr_child.lastChild.parentNode.cells[2].firstChild.getAttribute('value');
		// 			let inputCheckbox = tr_child.lastChild.parentNode.cells[5].lastChild.previousSibling;
		// 			return inputCheckbox;
		// 			// inputCheckbox.disabled = true;
		// 			// inputCheckbox.checked = false;
		// 		});
		// 	});
		// }
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
							<div class="col-md-6" style="height: 300px; border: 1px solid #999; text-align: center;" class="mau1-category">
									Category
							</div>

							<!-- right -->
							<div class="col-md-6">
									<div class="row">
											<div class="col-md-6" style="height: 150px;border: 1px solid #999; text-align: center;" class="mau1-product1">
													product 1
											</div>
											<div class="col-md-6" style="height: 150px;border: 1px solid #999; text-align: center;" class="mau1-product2">
													product 2
											</div>
											<div class="col-md-6" style="height: 150px;border: 1px solid #999; text-align: center;" class="mau1-product3">
													product 3
											</div>
											<div class="col-md-6" style="height: 150px;border: 1px solid #999; text-align: center;" class="mau1-product4">
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
											<div class="col-md-6" style="height: 150px;border: 1px solid #999; text-align: center;" class="mau2-product1">
													product 1
											</div>
											<div class="col-md-6" style="height: 150px;border: 1px solid #999; text-align: center;" class="mau2-product2">
													product 2
											</div>
											<div class="col-md-6" style="height: 150px;border: 1px solid #999; text-align: center;" class="mau2-product3">
													product 3
											</div>
											<div class="col-md-6" style="height: 150px;border: 1px solid #999; text-align: center;" class="mau2-product4">
													product 4
											</div>
									</div>
							</div>
							<!-- right -->
							<div class="col-md-6" style="height: 300px; border: 1px solid #999; text-align: center;" class="mau2-category">
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
							<div class="col-md-6" style="height: 300px; border: 1px solid #999; text-align: center;" class="mau3-category">
									Content Of Category
							</div>

							<!-- right -->
							<div class="col-md-6" style="height: 300px; border: 1px solid #999; text-align: center;">
									Category Image
							</div>

					</div>
			</div>
		</div>
    `;
	}

	function mau4(data = null) {
		return `mau 4`;
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

	const option = document.querySelector('#chooseAvailableThemes');
	const mauElement = document.querySelector('#mau');

	const defaultOptionValue = option?.value ? option?.value : 1;
	ChonMau(defaultOptionValue, mauElement);

	option.addEventListener('change', function (e) {
		if (!Number.isNaN(Number(e.target.value))) {
			console.log(e.target.value);
			ChonMau(e.target.value, mauElement);
		}
	});

});

