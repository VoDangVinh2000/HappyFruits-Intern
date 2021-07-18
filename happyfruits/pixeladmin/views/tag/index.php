    <style>
        #products-in-tag { list-style-type: none; margin: 0; padding: 0; width: 100%; }
        #products-in-tag li {
            background: #f5f5f5 none repeat scroll 0 0;
            border: 1px solid #ddd;
            border-radius: 2px;
            cursor: pointer;
            margin: 5px 0 0;
            min-height: 0;
            padding: 0 15px;
            position: relative;
            display: block;
            font-size: 13px;
            line-height: 36px;
        }
        #products-in-tag li a{
            position: absolute;
            right: 10px;
            color: red;
        }
    </style>
    <div id="content-wrapper">
        <?php $controlerObj->load_view('elements/breadcrumb');?>
        <?php $controlerObj->load_view('elements/pageheader');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-8">
                    <?=html_select($tags, 'tag_id', 'tag_name', 'class="form-control form-group-margin" id="tag_id"', 'Vui lòng chọn nhóm');?>
                    <?=html_select_optgroup($products, 'product_id', 'name', 'category_name', 'multiple id="products_list" style="width: 100%;" class="form-control"');?>
                    <div class="clear"></div>
                    <br />
                    <button class="btn btn-success" id="add_product_to_tag">Thêm vào nhóm</button>
                    <br />
                    <div>
                        <h3 id="products-in-tag-header">Vui lòng chọn hoặc thêm nhóm</h3>
        				<ul id="products-in-tag" class="products-in-tag"></ul>
                        <br />
                        <div id="update_products_in_tag" style="display: none;" >
                            <p class="e-note">Khi thay đổi vị trí hoặc xóa sản phẩm trên danh sách, cần lưu lại danh sách.</p>
                            <button class="btn btn-success" id="update_products_in_tag_btn">Lưu danh sách</button>
    			         </div>
                     </div>
                </div>
                <div class="col-lg-4">
                    <br class="hidden-lg" />
    				<form class="panel form-horizontal panel-success" id="add_tag_form" action="">
    					<div class="panel-heading">
    						<span class="panel-title">Thêm/sửa nhóm</span>
    					</div>
    					<div class="panel-body">
                            <?=html_select($tags, 'tag_id', 'tag_name', 'class="form-control form-group-margin" id="edit_tag_id"', '-- Nhóm');?>
                            <p class="e-note">Không chọn nhóm khi muốn thêm</p>
                            <input type="text" class="form-control form-group-margin" placeholder="Tên * (vd: Món ngon, Bán chạy nhất)" name="tag_name" id="tag_name" />
                            <input type="text" class="form-control form-group-margin" placeholder="Tên tiếng Anh * (vd: Delicious, Best Seller)" name="english_name" id="english_name" />
    						<input type="text" class="form-control form-group-margin" placeholder="Mã (vd: monngon, banchaynhat)" name="tag_code" id="tag_code" />
    						<button id="tag_icon" class="btn form-group-margin" name="icon" data-iconset="fontawesome" data-icon="fa-heart"></button>
                            <input type="text" value="#555555" class="form-control minicolors-input" id="tag_icon_color" size="7" />
                            <div class="input-group" style="margin: 15px 0;">
                                <input type="text" class="form-control" id="image" name="image" placeholder="Banner ảnh" value="" />
                                <span style="padding: 0;margin: 0;" class="input-group-addon"><a id="select_image" href="#" class="btn btn-warning "><i style="color: white;" class="fa fa-image"></i></a></span>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="is_main" name="is_main" value="1" />
                                <label class="control-label" for="is_main">Trang chủ</label>
                            </div>
                            <div id="preview_image"></div><br />
                            <textarea placeholder="Chú thích" rows="5" class="form-control"></textarea>
                            <br />
                            <button class="btn btn-success" id="add_tag">Lưu</button>&nbsp;
                            <button style="display: none;" class="btn btn-danger" id="delete_tag">Xóa</button>
    					</div>
    				</form>
    			</div>
            </div>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#content-wrapper -->