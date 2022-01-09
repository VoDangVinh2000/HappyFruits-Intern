    <style>
        ol.example li.placeholder:before { position: absolute; }
        .list-group-item > div { margin-bottom: 5px; }
    </style>
    <div id="content-wrapper">
        <?php $controlerObj->load_view('elements/breadcrumb');?>
        <?php $controlerObj->load_view('elements/pageheader');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <?=html_select($menus, 'id', 'name', 'class="form-control form-group-margin" id="menu"');?>
                </div>
                <div class="clearfix"></div><br/>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading clearfix">
                            <h5 class="pull-left">Thứ tự menu</h5>
                            <div class="pull-right">
                                <button type="button" class="btn btn-success btn-save"> <i class="fa fa-save"></i> Lưu</button>
                            </div>
                            <div class="clearfix"></div>
                            <p class="e-note">Khi thay đổi vị trí cần lưu lại danh sách.</p>
                        </div>
                        <div class="panel-body" id="cont">
                            <ul id="myList" class="sortableLists list-group"></ul>
                        </div>
                        <div class="panel-footer clearfix">
                            <div class="pull-right">
                                <button type="button" class="btn btn-success btn-save"> <i class="fa fa-save"></i> Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">Chi tiết menu con</div>
                        <div class="panel-body">
                            <form id="frmEdit" class="form-horizontal">
                                <div class="form-group">
                                    <label for="mnu_text" class="col-sm-3 control-label">Tên *</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="mnu_text" name="mnu_text" placeholder="Tên">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="mnu_short_text" class="col-sm-3 control-label">Tên gọn</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="mnu_short_text" name="mnu_short_text" placeholder="Tên gọn">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="mnu_en_text" class="col-sm-3 control-label">Tên tiếng Anh</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="mnu_en_text" name="mnu_en_text" placeholder="Tên tiếng Anh">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="mnu_page" class="col-sm-3 control-label">Liên kết page</label>
                                    <div class="col-sm-9">
                                        <?=html_select($pages, 'page_code', 'page_title', 'class="form-control select2" id="mnu_page" name="mnu_page"', 'Không liên kết');?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="mnu_href" class="col-sm-3 control-label">URL *</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="mnu_href" name="mnu_href" placeholder="URL">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="mnu_target" class="col-sm-3 control-label">Loại liên kết *</label>
                                    <div class="col-sm-9">
                                        <select id="mnu_target" name="mnu_target" class="form-control">
                                            <option value="_self">Mở trang hiện tại</option>
                                            <option value="_blank">Mở trang mới</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="mnu_page" class="col-sm-3 control-label">Liên kết nhóm hàng</label>
                                    <div class="col-sm-9">
                                        <?=html_select($categories, 'category_id', 'name', 'class="form-control select2" id="mnu_cat" name="mnu_cat"', 'Không liên kết');?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="mnu_description" class="col-sm-3 control-label">Nội dung / Ghi chú</label>
                                    <div class="col-sm-9">
                                        <textarea type="text" class="form-control" id="mnu_description" name="mnu_description" placeholder="Nội dung / Ghi chú"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="mnu_title" class="col-sm-3 control-label">Image</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="mnu_image" name="mnu_image" placeholder="Banner ảnh" value="" />
                                            <span style="padding: 0;margin: 0;" class="input-group-addon"><a id="select_image" href="#" class="btn btn-warning "><i style="color: white;" class="fa fa-image"></i></a></span>
                                        </div>
                                        <br />
                                        <div id="preview_image"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="panel-footer">
                            <button type="button" id="btnUpdate" class="btn btn-primary hidden"><i class="fa fa-refresh"></i> Cập nhật</button>
                            <button type="button" id="btnAdd" class="btn btn-success"><i class="fa fa-plus"></i> Thêm mới</button>
                        </div>
                    </div>
    			</div>
            </div>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#content-wrapper -->