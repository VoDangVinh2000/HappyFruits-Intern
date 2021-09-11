<?php
require_once './models/common/Customers.php';
require_once EFRUIT_ABSOLUTE_PATH . '/pixeladmin/classroom/connection.php';
/**
 * Class declaration
 */

class CustomerController extends BaseController
{
    function __construct()
    {
        $this->not_require_logged = array('register', 'Login_Customer', 'Logout_Customer', 'Edit_Info_Account_Customer', 'Forgot_Pass', 'Change_Pass');
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
        //registerOld : self::registerOld()
        $table_name = "customers";
        // $customers_common = new Customers;
        $error_username = NULL;
        $error_email = NULL;
        $bool = false;
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
            //Kiểm tra username và email khi người dùng đăng ký có trong database chưa
            $query_user_email_account = $this->Customers->get_list_customer_email_account($_POST['email']);
            $query_user_username_account = $this->Customers->get_list_customer_username($_POST['username_en']);
            // $query_username = $customers_common->get_list_customer_username($_POST['username_en']);
            if (!empty($query_user_username_account)) {
                $error_username = 'This username has been already . Please log in account';
                setcookie("error_username", $error_username, time() + 600, "/");
                $bool = true;
            }
            if (!empty($query_user_email_account)) {
                $error_email = 'This email has been already . Please log in account';
                setcookie("error_email", $error_email, time() + 600, "/");
                $bool = true;
            }

            if ($bool == true) {
                header('location:/vi/dang-ky');
                exit();
            } else {
                $params['username'] = $_POST['username_en'];
                $params['password'] = md5($_POST['password_en']);
                $params['mobile_account'] = $_POST['phone_en'];
                $params['email_account'] = eModel::matchRegexEmail($_POST['email']);
                $params['type_id'] = 1;
                $params['created_dtm'] = date('Y-m-d H:i:s', time());
                $success = Customers::_insert($table_name, $params);
                if ($success) {
                    setcookie("error_email", $error_email, 0, "/");
                    setcookie("error_username", $error_email, 0, "/");
                    header('location:/vi/dang-nhap');
                    exit();
                }
            }
        } else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['dang-ky'])) {

            //Kiểm tra username và email khi người dùng đăng ký có trong database chưa
            $query_user_email_account = $this->Customers->get_list_customer_email_account($_POST['email']);
            $query_user_username_account = $this->Customers->get_list_customer_username($_POST['username_en']);
            // $query_username = $customers_common->get_list_customer_username($_POST['username_en']);

            if (!empty($query_user_username_account)) {
                $error_username = 'This username has been already . Please log in account';
                setcookie("error_username", $error_username, time() + 600, "/");
                $bool = true;
            }
            if (!empty($query_user_email_account)) {
                $error_email = 'This email has been already . Please log in account';
                setcookie("error_email", $error_email, time() + 600, "/");
                $bool = true;
            }

            if ($bool == true) {
                header('location:/vi/dang-ky');
                exit();
            } else {
                $params['username'] = $_POST['username'];
                $params['password'] = md5($_POST['password_en']);
                $params['mobile_account'] = $_POST['phone_en'];
                $params['email_account'] = eModel::matchRegexEmail($_POST['email']);
                $params['type_id'] = 1;
                $params['created_dtm'] = date('Y-m-d H:i:s', time());
                $success = Customers::_insert($table_name, $params);
                if ($success) {
                    header('location:/vi/dang-nhap');
                    exit();
                }
            }
        } else {
            header('location:/vi');
        }
    }

    //hàm đăng nhập phía khách hàng
    function Login_Customer()
    {
        $error_username_password = null;
        $error_acount_does_not_exist = null;
        if (isset($_POST['username'])) {
            //Kiểm tra username password khi đăng nhập
            $username = eModel::matchRegexLogin($_POST['username']);
            $password = md5($_POST['password']);
            $data = $this->Customers->get_list_customer_username($username);

            //kiểm tra username có tồn tại trên csdl hay không
            if ($data) {
                if ($password == $data[0]['password']) {
                    //tạo session lưu phiên đăng nhập 
                    if (!isset($_SESSION)) {
                        session_start();
                    }
                    $_SESSION['user_account'] = $data;
                    header('location:/vi');
                    exit();
                } else {
                    $error_username_password = 'Tài khoản hoặc mật khẩu không chính xác';
                    setcookie("error_username_password", $error_username_password, time() + 600, "/");
                    header('location:/vi/dang-nhap');
                    exit();
                }
            } else {
                $error_acount_does_not_exist = 'Tài khoản này không tồn tại';
                setcookie("error_acount_does_not_exist", $error_acount_does_not_exist, time() + 600, "/");
                header('location:/vi/dang-nhap');
                exit();
            }
        }
    }

    //hàm đăng xuất
    function Logout_Customer()
    {
        if (isset($_SESSION['user_account'])) {
            unset($_SESSION['user_account']);
            header('location: vi/dang-nhap');
        } else {
            header('location: /vi');
        }
    }
    //hàm sửa thông tin tài khoản người dùng
    function Edit_Info_Account_Customer()
    {
        $error_email = NULL;
        //reset lại lỗi sau mỗi lần sửa thông tin
        setcookie("error_email", $error_email, 0, "/");

        $customer_id = $_SESSION['user_account'][0]['customer_id'];
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sua-thongtin-btn']) || isset($_POST['edit-profile-btn'])) {

            //Sử dụng chung hàm matchRegex này do cùng chức năng là chống sql injection
            $fullName = $_POST['fullname'];
            $email = eModel::matchRegexEmail($_POST['email']);
            $phoneNumber = $_POST['phone-number'];
            $address = $_POST['address'];
            $building = $_POST['building'];
            $district = $_POST['district'];
            // $companyName = eModel::matchRegex_SearchProducts($_POST['company-name']);
            // $companyTaxCode = eModel::matchRegex_SearchProducts($_POST['company-tax-code']);
            // $companyAddress = eModel::matchRegex_SearchProducts($_POST['company-address']);
          
            //lấy email của tài khoản hiện tại đang đăng nhập
             $query_user_email_account = $this->Customers->get_list_customer_email_account($email);
            // //Kiểm tra email người dùng nhập có trong database chưa, nếu tồn email đã tồn tại trên database thì báo lỗi
            if (isset($query_user_email_account[0]['email_account'])) {
                $data = $this->Customers->get_list_customer_username($_SESSION['user_account'][0]['username']);
                $_SESSION['user_account'] = $data;
                if (isset($_POST['sua-thongtin-btn'])) {

                    $error_email = 'Email này đã có người sử dụng. Xin hãy chọn email khác';
                } else {
                    $error_email = 'This email already exists. Please enter another email';
                }
                setcookie("error_email", $error_email, time() + 600, "/");
                header('location:/vi/profile');
                exit();
            }
            else{
                $update =   $this->Customers->update($customer_id, array(
                    'customer_name_account' => $fullName, 'email_account' => $email, 'mobile_account' => $phoneNumber,
                    'address_account' => $address, 'building_account' => $building, 'district_account' => $district
                ));
                if($update){
                    $data = $this->Customers->get_list_customer_username($_SESSION['user_account'][0]['username']);
                     $_SESSION['user_account'] = $data;
                    header('location:/vi/profile');
                    exit();
                }
                else{
                    header('location:/vi/profile');
                    exit();
                }
            }
        } else {
            header('location: /vi/profile');
            exit();
        }
    }

    //quên mật khẩu
    function Forgot_Pass()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        // Kiểm tra nếu thực hiện thao tác cập nhật quyền của người dùng
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitForgot'])) {

            $errors = '';
            $email = '';
            $error_email = null;
            $send_mail_success = null;
            setcookie("error_email", $error_email, 0, "/");
            setcookie("send_mail_success", $send_mail_success, 0, "/");

            if (isset($_POST['email']) && is_email_exists($_POST['email'])) {
                $email = $_POST['email'];
            } else {
                $errors = "email";
            }
            if (empty($_POST['email'])) {
                $error_email = 'Please enter your email';
                setcookie("error_email", $error_email, time() + 600, "/");
                header('Location: vi/dang-nhap');
                exit();
            }

            if (!empty($errors)) {
                $error_email = 'Email address does not exist';
                setcookie("error_email", $error_email, time() + 600, "/");
                header('Location: vi/dang-nhap');
                exit();
            }
            if (empty($errors) && !empty($email)) {

                $account = $this->Customers->get_list_customer_email_account($email);
                if (empty($account)) {
                    $error_email = 'Email address does not exist';
                    setcookie("error_email", $error_email, time() + 600, "/");
                    header('Location: vi/dang-nhap');
                    exit();
                }
                $randPassword = rand_string(8);
                $content = "<h3> Dear " . $account[0]['username'] . '</h3>';
                $content .= "<p>We have received a request to re-issue your password recently.</p>";
                $content .= "<p>We have updated and sent you a new password</p>";
                $content .= "<p>Your new password is : <b>$randPassword</b></p> ";
                $sendMail = Customers::send($content, $account[0]['username'], $account[0]['email_account']);
                if ($sendMail) {
                    $password = md5($randPassword);
                    $update =   $this->Customers->update($account[0]['customer_id'], array(
                        'password' => $password
                    ));
                    if($update){
                        $send_mail_success = 'We have sent a new password to your email. Please check it';
                        setcookie("send_mail_success", $send_mail_success, time() + 600, "/");
                        header('Location: /vi/dang-nhap');
                    }
                   
                } else {
                    $error_email = 'An error has occurred unable to retrieve the password';
                    setcookie("error_email", $error_email, time() + 600, "/");
                    header('Location: /vi/dang-nhap');
                    exit();
                }
            }
        }
    }

    //đổi mật khẩu
    function Change_Pass()
    {
        setcookie("error_username", "", 0, "/");
        setcookie("error_password", "", 0, "/");
        if (isset($_POST['username'])) {
            $username = $_POST['username'];
            $current_password = md5($_POST['current-password']);
            $new_password = md5($_POST['new-password']);

            $account = $this->Customers->get_list_customer_username($username);
            if (!empty($account)) {
                if ($current_password === $account[0]['password']) {
                    $customer_id = $this->Customers->get_customerID($username);
                    $update =   $this->Customers->update($customer_id, array(
                        'password' => $new_password
                    ));
                    if($update){
                        setcookie("change_password_success", "Change password successfully", time() + 600, "/");
                        header('Location: /vi/dang-nhap');
                        exit();
                    }
                } else {
                    setcookie("error_password", "Incorrect password ", time() + 600, "/");
                    header('Location: /vi/dang-nhap');
                    exit();
                }
            } else {
                setcookie("error_username", "Username does not exist", time() + 600, "/");
                header('Location: /vi/dang-nhap');
                exit();
            }
        }
    }

    function registerOld()
    {
        // if (!empty($query_user_email_username)) {
        //         foreach ($query_user_email_username as $key) {
        //             //Vòng lặp kiểm tra tất cả các row xem có trùng username không
        //             if ($key['username'] == $username) {
        //                 $error_username = 'This username has been already . Please log in account';
        //                 setcookie("error_username", $error_username, time() + 600, "/");
        //                 header('location:/vi/dang-ky');
        //                 exit();
        //             }
        //         }

        //         foreach ($query_user_email_username as $key) {
        //             //Vòng lặp kiểm tra tất cả các row : Cột username và email đã có dữ liệu chưa, nếu username chưa có thì chèn, ng lại thì ko
        //             if (!empty($key['email']) && !empty($key['username'])) {
        //                 $error_email = 'This email or username has been already . Please log in account';
        //                 setcookie("error_email", $error_email, time() + 600, "/");
        //                 header('location:/vi/dang-ky');
        //                 exit();
        //             }
        //         }

        //         foreach ($query_user_email_username as $key) {
        //             if ($key['username'] != $username) {
        //                 //Trường hợp cuối : username không tồn tại
        //                 $params['username'] = $username;
        //                 $params['password'] = md5($_POST['password_en']);
        //                 $params['mobile_account'] = $_POST['phone_en'];
        //                 $params['email'] = eModel::matchRegexEmail($_POST['email']);
        //                 $params['type_id'] = 1;
        //                 $params['created_dtm'] = date('Y-m-d H:i:s', time());
        //                 $success = Customers::_insert($table_name, $params);
        //                 if ($success) {
        //                     setcookie("error_email", $error_email, 0, "/");
        //                     setcookie("error_username", $error_username, 0, "/");
        //                     header('location:/vi/dang-nhap');
        //                     exit();
        //                 }
        //             }
        //         }
        //     } else {
        //         $params['username'] = $username;
        //         $params['password'] = md5($_POST['password_en']);
        //         $params['mobile_account'] = $_POST['phone_en'];
        //         $params['email'] = eModel::matchRegexEmail($_POST['email']);
        //         $params['type_id'] = 1;
        //         $params['created_dtm'] = date('Y-m-d H:i:s', time());
        //         $success = Customers::_insert($table_name, $params);
        //         if ($success) {
        //             setcookie("error_email", $error_email, 0, "/");
        //             setcookie("error_username", $error_username, 0, "/");
        //             header('location:/vi/dang-nhap');
        //             exit();
        //         }
        //     }
    }
    /*show histories order */
}
/* End of CustomersController class */
