    <style>
        #images-in-gallery { list-style-type: none; margin: 0; padding: 0; width: 100%; }
        #images-in-gallery li {
            background: #f5f5f5 none repeat scroll 0 0;
            border: 1px solid #ddd;
            border-radius: 2px;
            cursor: pointer;
            margin: 5px 20px 20px 0;
            min-height: 0;
            padding: 0 10px 0 0;
            position: relative;
            display: inline-block;
            font-size: 13px;
            line-height: 36px;
        }
            #images-in-gallery li img{
                padding-right: 5px;
            }
            #images-in-gallery li a{
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
                    <?=html_select($images, 'id', 'filename', 'multiple id="images_list" style="width: 100%;" class="form-control"');?>
                    <div class="clear"></div>
                    <br />
                    <button class="btn btn-success" id="add_image_to_gallery">Thêm từ danh sách</button> hoặc
                    <a id="select_image" href="#" class="btn btn-warning"><i class="fa fa-save"></i> Chọn ảnh</a>
                    <br />
                    <div>
                        <h3 id="images-in-gallery-header">Vui lòng chọn ảnh thêm vào thư viện</h3>
        				<ul id="images-in-gallery" class="images-in-gallery">
                        <?php 
                            if ($images_in_gallery):
                                foreach($images_in_gallery as $img):
                                    $path = get_image_url($img, 'thumbnail');
                        ?>
                            <li id="pit<?=$img['id']?>"><img src="<?=$path?>" /> <?=$img['filename']?><a id="del<?=$img['id']?>" class="del"><i class="fa fa-trash"></i></a></li>
                        <?php
                                endforeach;
                            endif;
                        ?>
                        </ul>
                        <br />
                        <div id="update_images_in_gallery" <?=empty($images_in_gallery)?'style="display: none;"':''?> >
                            <p class="e-note">Khi thay đổi vị trí hoặc xóa hình ảnh trên danh sách, cần lưu lại danh sách.</p>
                            <button class="btn btn-success" id="update_images_in_gallery_btn">Lưu danh sách</button>
    			         </div>
                     </div>
                </div>
            </div>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#content-wrapper -->