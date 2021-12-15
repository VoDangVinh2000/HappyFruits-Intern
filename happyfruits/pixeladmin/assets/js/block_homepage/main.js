window.addEventListener('DOMContentLoaded', function () {
  
  	// Khi select option thay đổi.
	function selectOption(){
		let option = document.querySelector('#chooseAvailableThemes');
		//Gọi hàm ngay khi selectOption được gọi
		getValueInitial_Option(option);
		//Nếu option có sự thay đổi
		option.addEventListener('change',function(){
			let themeChoosing =  option.value != "default" ? getValueOption(option) : 'Vui lòng chọn mẫu';
			console.log(themeChoosing);
		});
		//Nếu option không thay đổi
		console.log(getValueInitial_Option(option));
	}
	function getValueOption(option){
		if(option.value == 1){
			return mau1();
		}
		else if(option.value == 2){
			return mau2();
		}
	}
	//Sự kiện lấy ngay giá trị option selected được chọn ngay khi load page
	function getValueInitial_Option(option){
	   return	getValueOption(option);
	}
	
	selectOption();
  
  // hiển thị mẫu lên cho người dùng hiểu.

  // lay id "mau" -- để hiển thị html mẫu đã tạo.


  // html mẫu 1.
  function mau1(){
	let mau1 = `
	<div class="row">
		<div class="product-main-home-page my-3">
			<div class="category-home-page">
				<div class="top-img">
					<a href="">
						<img src="" alt="">
					</a>
					<div class="category-desc">
						<span class="efruit-vi">
							<p>Mau 1</p>
						</span>
						<span class="efruit-en">
							<p>Mau 1</p>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	`;
	return mau1;
  }
  

  // html mẫu 2
  function mau2(){
	let mau2 = `
	<div class="row">
	</div>
	`;
	return mau2;
  }
  

});