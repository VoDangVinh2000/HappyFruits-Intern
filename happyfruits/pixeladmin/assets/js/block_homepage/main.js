window.addEventListener('DOMContentLoaded', function () {

  // khi select option thay đổi.
  // hiển thị mẫu lên cho người dùng hiểu.

  // lay id "mau" -- để hiển thị html mẫu đã tạo.
  const mau =  document.querySelector('#mau');
  mau.innerHTML = mau3();
  // html mẫu 1.
  let mau1 = `
  <div class="row">
  </div>
  `;

  // html mẫu 2
  let mau2 = `
  <div class="row">
  </div>
  `;

  function mau3(data = null) {
    return `
    <div class="container my-3">
      <div class="row g-0 category-full">
        <div class="col-md-6">
          <div class="category-caption">
            <h3 class="efruit-vi"><span>Hoa trái cây</span></h3>
            <span class="efruit-vi">
              <p>Các loại bó hoa kết hợp giữa trái cây tươi và hoa rất đa dạng. Là một món quà tặng phong cách mới mẻ, hiện
                đại.</p>
            </span>
           
            <a class="btn-shop" href="http://www.happyfruits.vn/vi/fruit-bouquet">
              <div class="button-content-wrapper">
                <span class="button-text">SHOP NOW</span>
              </div>
            </a>
          </div>
        </div>
        <div class="col-md-6">
          <div class="category-home-page">
            <div class="top-img">
              <a href="http://www.happyfruits.vn/vi/fruit-bouquet">
                <img src="http://www.happyfruits.vn/uploads/210358f2d9899b53e9a9ca31e0e3ba74.jpg" alt="">
              </a>
            </div>
          </div>

        </div>
      </div>

      <div class="row mt-2 gy-2">
        <div class="col-6">
          <div style="margin-bottom: 15px;" class="product-cat-8  y-grid-card animate has-image compact full-width"
            on-ready="">

            <div class="y-image">
              <img width="320" height="320" alt="FM10"
                src="http://www.happyfruits.vn/uploads/square-small/hoa-trai-cay-mix-ngau-nhien.jpg" class="recipe-image">
              <img width="320" height="320" alt="gradient-background"
                src="http://www.happyfruits.vn/themes/efruit/assets/img/card-gradient.png" class="gradient">
            </div>
            <div class="y-info">
              <h3 class="y-title">
              <a style="text-overflow: inherit;white-space: unset;">FM10 - 
              <span class="product_name efruit-vi">Bó Hoa trái cây FM15</span>
              </h3>
              <a class="y-source">600,000<sup>đ</sup></a>
              <p class="y-ingredients efruit-vi">Hoa trai cây mix ngẫu nhiên, có thiệp, tag miễn phí.</p>
            </div>
            <div class="half-circle-ribbon ribbon-left" style="background: #9bc90d;box-shadow: 0 0 0 3px #9bc90d;">4h</div>
          </div>
        </div>
        
        <div class="col-6">
          <div style="margin-bottom: 15px;" class="product-cat-8  y-grid-card animate has-image compact full-width"
            on-ready="">

            <divclass="y-image">
              <img width="320" height="320" alt="FM14"
                src="http://www.happyfruits.vn/uploads/square-small/hoa-trai-cay-600k-.jpg" class="recipe-image">
              <img width="320" height="320" alt="gradient-background"
                src="http://www.happyfruits.vn/themes/efruit/assets/img/card-gradient.png" class="gradient">
            </divclass=>
            <div class="y-info">
              <h3 class="y-title">
              <a style="text-overflow: inherit;white-space: unset;">FM14 - 
              <span class="product_name efruit-vi">Bó Hoa trái cây FM14</span>
              </a>
              </h3>
              <a class="y-source">600,000<sup>đ</sup></a>
            </div>
            <div class="half-circle-ribbon ribbon-left" style="background: #9bc90d;box-shadow: 0 0 0 3px #9bc90d;">4h</div>
          </div>
        </div>

        <div class="col-6">
          <div style="margin-bottom: 15px;" class="product-cat-8  y-grid-card animate has-image compact full-width"
            on-ready="">

            <div class="y-image">
              <img width="320" height="320" alt="FC3"
                src="http://www.happyfruits.vn/uploads/square-small/hoa-trai-cay-ct-size-3.jpg" class="recipe-image">
              <img width="320" height="320" alt="gradient-background"
                src="http://www.happyfruits.vn/themes/efruit/assets/img/card-gradient.png" class="gradient">
            </div>
            <div class="y-info">
              <h3 class="y-title"><a style="text-overflow: inherit;white-space: unset;">FC3 - <span
                    class="product_name efruit-vi">Hoa trái cây cắt size 3</span></a></h3>
              <a class="y-source">1,000,000<sup>đ</sup></a>
              <p class="y-ingredients efruit-vi" style="max-height: 0px;">Sản phẩm cần đặt trước ít nhất 4h.</p>
            </div>
            <div class="half-circle-ribbon ribbon-left" style="background: #9bc90d;box-shadow: 0 0 0 3px #9bc90d;">4h</div>
          </div>
        </div>

        <div class="col-6">
          <div style="margin-bottom: 15px;" class="product-cat-8  y-grid-card animate has-image compact full-width"
            on-ready="">

            <divclass="y-image">
              <img width="320" height="320" alt="FC2"
                src="http://www.happyfruits.vn/uploads/square-small/hoa-trai-cay-ct-size-2.jpg" class="recipe-image">
              <img width="320" height="320" alt="gradient-background"
                src="http://www.happyfruits.vn/themes/efruit/assets/img/card-gradient.png" class="gradient">
            </divclass=>
            <div class="y-info">
              <h3 class="y-title"><a style="text-overflow: inherit;white-space: unset;">FC2 - <span
                    class="product_name efruit-vi">Hoa trái cây cắt size 2</span></a></h3>
              <a class="y-source">500,000<sup>đ</sup></a>
              <p class="y-ingredients efruit-vi">Sản phẩm cần đặt trước ít nhất 4h.</p>
            </div>
            <div class="half-circle-ribbon ribbon-left" style="background: #9bc90d;box-shadow: 0 0 0 3px #9bc90d;">4h</div>
          </div>
        </div>
      </div>
    </div>
    `;
  }

});