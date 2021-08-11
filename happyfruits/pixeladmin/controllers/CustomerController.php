<?php
require_once './models/common/Customers.php';
/**
 * Class declaration
 */

class CustomerController extends BaseController
{
    function __construct()
    {
        $this->not_require_logged = array('register','loginCustomer','logoutCustomer');
        parent::__construct();
        $this->load_model('Customers, Products');
    }

    function index()
    {
        $this->plugins = 'dataTables, tooltipster, download, select2';
        $js = array(
            ASSET_URL . 'js/customer/index.js'
        );
        $page_title = 'Quản lý khách hàng';
        $filter_array = "";
        $filter_keyword = get('s');
        if ($filter_keyword) {
            $search_str = "(customer_name LIKE '%$filter_keyword%' OR address LIKE '%$filter_keyword%' OR mobile LIKE '%$filter_keyword%')";
            $filter_array = array('where' => "($search_str)");
            $customers = $this->Customers->get_list($filter_array);
        } else {
            $customers = null;
        }
        $products = $this->Products->get_list(array('products.is_additional' => "0"), -1);
        $this->_merge_data(compact("js", "page_title", "customers", "filter_keyword", "filter_array", "products"));
        $this->load_page('customer/index');
    }

    function edit()
    {
        $this->plugins = 'googleapis, validator, icheck';
        $js = array(
            ASSET_URL . 'js/customer/customer.js'
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
            ASSET_URL . 'js/customer/customer.js'
        );
        $page_title = 'Thêm khách hàng';
        $id = $obj = null;
        $customer_types = $this->Customers->get_customer_types();
        $this->_merge_data(compact("js", "page_title", "obj", "customer_types", "id"));
        $this->load_page('customer/customer');
    }

    function register()
    {
        $table_name = "customers";
        $customers_common = new Customers;
        $error_username = NULL;
        $error_email = NULL;
        $bool = false;
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
            //Kiểm tra username khi người dùng đăng ký có trong database chưa
            $query_user_email = $customers_common->get_list_customer_email($_POST['email']);
            $query_username = $customers_common->get_list_customer_username($_POST['username_en']);

            if (isset($query_user_email[0]['email'])) {
                $error_email = 'This email has been already. Please log in account';
                setcookie("error_email", $error_email, time() + 600, "/");
                $bool = true;
            }
            if (isset($query_username[0]['username'])) {
                $error_username = 'This username has been already. Please log in account';
                setcookie("error_username", $error_username, time() + 600, "/");
                $bool = true;
            }
            if ($bool) {
                header('location:/vi/dang-ky');
            } else {
                $params['username'] = $_POST['username_en'];
                $params['password'] = md5($_POST['password_en']);
                $params['mobile'] = $_POST['phone_en'];
                $params['email'] = $_POST['email'];
                $params['created_dtm'] = date('Y-m-d H:i:s', time());
                $success = Customers::_insert($table_name, $params);
                if ($success) {
                    setcookie("error_email", $error_email, 0, "/");
                    setcookie("error_username", $error_username, 0, "/");
                    header('location:/vi/dang-nhap');
                }
            }
        } else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['dang-ky'])) {

            //Kiểm tra username khi người dùng đăng ký có trong database chưa
            $query_user_email = $customers_common->get_list_customer_email($_POST['email']);
            $query_username = $customers_common->get_list_customer_username($_POST['username_en']);
            if (isset($query_user_email[0]['email'])) {
                $error_email = 'Email này đã được đăng ký. Vui lòng đăng nhập tài khoản';
                setcookie("error_email", $error_email, time() + 600, "/");
                $bool = true;
            }
            if (isset($query_username[0]['username'])) {
                $error_username = 'Tên này đã được đăng ký. Vui lòng đăng nhập tài khoản';
                setcookie("error_username", $error_username, time() + 600, "/");
                $bool = true;
            }
            if ($bool) {
                header('location:/vi/dang-ky');
            } else {
                $params['username'] = $_POST['username_en'];
                $params['password'] = md5($_POST['password_en']);
                $params['mobile'] = $_POST['phone_en'];
                $params['email'] = $_POST['email'];
                $params['created_dtm'] = date('Y-m-d H:i:s', time());
                $success = Customers::_insert($table_name, $params);
                if ($success) {
                    setcookie("error_email", $error_email, 0, "/");
                    setcookie("error_username", $error_username, 0, "/");
                    header('location:/vi/dang-nhap');
                }
            }
        }
         else {
            header('location:/vi');
        }
    }


    function loginCustomer()
    {
        $error_username_password = null;
        $error_acount_does_not_exist = null;
        $check_error_login = false;
        //reset lại lỗi đăng nhập sau mỗi lần đăng nhập
        setcookie("error_username_password", $error_username_password, 0, "/");
        setcookie("error_acount_does_not_exist", $error_acount_does_not_exist, 0, "/");
        if (isset($_POST['username']) && $_SERVER['REQUEST_METHOD'] == "POST") {
            //Kiểm tra username password khi đăng nhập
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            echo $username . " " . $password;
            $customer = new Customers;
            $data = $customer->get_list_customer_username($username);
            //kiểm tra username có tồn tại trên csdl hay không
            if ($data) {
                if ($password == $data[0]['password']) {
                    //tạo session lưu phiên đăng nhập 
                    if (!isset($_SESSION)) {
                        session_start();
                    }
                    $_SESSION['user_account'] = $data;
                    $check_error_login = false;

                    header('location:/vi');
                } else {
                    $error_username_password = 'Tài khoản hoặc mật khẩu không chính xác';
                    setcookie("error_username_password", $error_username_password, time() + 600, "/");
                    $check_error_login = true;
                    header('location:/vi/dang-nhap');
                }
            } else {
                $error_acount_does_not_exist = 'Tài khoản này không tồn tại';
                setcookie("error_acount_does_not_exist", $error_acount_does_not_exist, time() + 600, "/");
                $check_error_login = true;
                header('location:/vi/dang-nhap');
            }
            //xóa thông báo lỗi đăng nhập
            if (!$check_error_login) {
                setcookie("error_username_password", $error_username_password, 0, "/");
                setcookie("error_acount_does_not_exist", $error_acount_does_not_exist, 0, "/");
            }
        }
    }

    function logoutCustomer(){
        if(isset($_SESSION['user_account'])){
            unset($_SESSION['user_account']);
            header('location:/vi');
        }
        else
        {
            header('location: /vi/dang-nhap');
        }  
    }
}
/* End of CustomersController class */
