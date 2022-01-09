<?php
/**
 * Class declaration
 */
class GalleryController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load_model('Files, ImagesInGallery');
    }
    
    function index()
    {
        $this->plugins = 'jquery-ui, select2';
        $js = array(
            ASSET_URL. 'js/gallery/index.js'
        );
        $page_title = 'Quản lý thư viện ảnh trên giao diện';
        $images = $this->Files->get_images(array('deleted' => 0));
        $images_in_gallery = $this->ImagesInGallery->get_full_list(array('gallery_id' => GALLERY_ID));
        $this->_merge_data(compact("js", "page_title", "images", "images_in_gallery"));
        $this->load_page('gallery/index');
    }
}
/* End of GalleryController class */
