<?php
/**
 * Class declaration
 */
class CustomerController extends BaseController
{
    function __construct()
    {
        $this->not_require_logged = array('register');
        parent::__construct();
        $this->load_model('Customers, Products');
    }
    
    function index()
    {
        $this->plugins = 'dataTables, tooltipster, download, select2';
        $js = array(
            ASSET_URL. 'js/customer/index.js'
        );
        $page_title = 'Quản lý khách hàng';
        $filter_array = "";
        $filter_keyword = get('s');
        if ($filter_keyword) {
            $search_str = "(customer_name LIKE '%$filter_keyword%' OR address LIKE '%$filter_keyword%' OR mobile LIKE '%$filter_keyword%')";
            $filter_array = array('where' => "($search_str)");
            $customers = $this->Customers->get_list($filter_array);
        }else{
            $customers = null;
        }
        $products = $this->Products->get_list(array('products.is_additional'=>"0"), -1);
        var_dump($filter_array);
        $this->_merge_data(compact("js", "page_title", "customers", "filter_keyword", "filter_array", "products"));
        $this->load_page('customer/index');
    }
    
    function edit()
    {
        $this->plugins = 'googleapis, validator, icheck';
        $js = array(
            ASSET_URL. 'js/customer/customer.js'
        );
        $page_title = 'Sửa thông tin khách hàng';
        $id = get('id');
        $obj = null;
        if ($id)
            $obj = $this->Customers->get_details($id);
        $customer_types = $this->Customers->get_customer_types();
        $this->_merge_data(compact("js", "page_title", "obj", "customer_types", "id"));
        $this->load_page('customer/customer');
    }
    
    function add()
    {
        $this->plugins = 'googleapis, validator, icheck';
        $js = array(
            ASSET_URL. 'js/customer/customer.js'
        );
        $page_title = 'Thêm khách hàng';
        $id = $obj = null;
        $customer_types = $this->Customers->get_customer_types();
        $this->_merge_data(compact("js", "page_title", "obj", "customer_types", "id"));
        $this->load_page('customer/customer');
    }

    function register(){
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])){
            $table_name = "customers";
            $params['username'] = $_POST['username'];
            $params['password'] = md5($_POST['password']);
            $params['mobile'] = $_POST['phone'];
            $params['email'] = $_POST['email'];
            $success = Customers::_insert($table_name, $params);
            if($success){
                //qua trang đăng nhập
            }
        }
        else{
            //quay về trang home
        }
    }
    function loginCustomer(){
        //Mật khẩu là mã hóa md5
        //Sau khi so sánh nếu đúng thì tạo session (mã hóa session).
        echo "ok";
    }

}
/* End of CustomersController class */
