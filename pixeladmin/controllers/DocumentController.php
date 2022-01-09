<?php
/**
 * Class declaration
 */
class DocumentController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load_model('Documents');
    }
    
    function index()
    {
        $this->plugins = 'dataTables, tooltipster';
        $js = array(
            ASSET_URL. 'js/document/index.js'
        );
        $page_title = 'Quản lý tài liệu';
        $documents = $this->Documents->get_list();
        $this->_merge_data(compact("js", "page_title", "documents"));
        $this->load_page('document/index');
    }
    
    function view()
    {
        $code = get('code');
        $obj = $this->Documents->get_details_by_code($code);
        if ($obj && $obj['filename'])
        {
            if (is_file(DOCUMENT_FILES_PATH. $obj['filename']))
                $content = file_get_contents(DOCUMENT_FILES_PATH. $obj['filename']);
            else
                $content = 'Nội dung không tồn tại.';
        }
        else
        {
            redirect('khong-tim-thay-trang');
        }
        $page_title = $obj['name'] . ' - Tài liệu - '. get_setting('site_name');
        $this->_merge_data(compact("obj", "page_title", "content"));
        $this->load_view('document/view');
    }
    
    function edit()
    {
        $this->plugins = 'validator, ckeditor';
        $js = array(
            ASSET_URL. 'js/document/document.js'
        );
        $page_title = 'Sửa tài liệu';
        
        $id = get('id');
        $obj = $content = null;
        if ($id)
            $obj = $this->Documents->get_details($id, array('deleted' => 0));
        if ($obj && $obj['filename'])
        {
            if (is_file(DOCUMENT_FILES_PATH. $obj['filename']))
                $content = file_get_contents(DOCUMENT_FILES_PATH. $obj['filename']);
            else
                $content = 'Nội dung không tồn.';
        }
        
        $this->_merge_data(compact("js", "page_title", "obj", "id", "content"));
        $this->load_page('document/document');
    }
    
    function add()
    {
        $this->plugins = 'validator, ckeditor';
        $js = array(
            ASSET_URL. 'js/document/document.js'
        );
        $page_title = 'Thêm tài liệu';
        $id = $obj = $content = null;
        $this->_merge_data(compact("js", "page_title", "obj", "id", "content"));
        $this->load_page('document/document');
    }
}
/* End of DocumentController class */
