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
        $table_name = "customers";
        $customers_common = new Customers;
        $error_username = NULL;
        $error_email = NULL;
        $error_username = NULL;
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
            //Kiểm tra username khi người dùng đăng ký có trong database chưa
            /*Hàm đăng ký được thực hiện như sau : Cột email trong bảng customer 
            được sử dụng cho dữ liệu khi nhấn đặt hàng, email người đặt sẽ được thêm vào.
            Nên sẽ ảnh hưởng tới phần đăng ký, vì đăng ký không đc trùng email. 
            Mà thanh toán offline thì username không có dữ liệu, nên dựa vào đây để check.
            Nếu select email mà cột username không có dữ liệu thì email của tài khoản đăng ký đó đc thêm vào db.
            */
            $username = eModel::matchRegexLogin($_POST['username_en']);
            $query_user_email_username = $customers_common->get_list_customer_email_username(
                $_POST['email'],
                $_POST['username_en']
            );
            $query_username = $customers_common->get_list_customer_username($_POST['username_en']);
            if (!empty($query_user_email_username)) {
                foreach ($query_user_email_username as $key) {
                    //Vòng lặp kiểm tra tất cả các row xem có trùng username không
                    if ($key['username'] == $username) {
                        $error_username = 'This username has been already . Please log in account';
                        setcookie("error_username", $error_username, time() + 600, "/");
                        header('location:/vi/dang-ky');
                        exit();
                    }
                }

                foreach ($query_user_email_username as $key) {
                    //Vòng lặp kiểm tra tất cả các row : Cột username và email đã có dữ liệu chưa, nếu username chưa có thì chèn, ng lại thì ko
                    if (!empty($key['email']) && !empty($key['username'])) {
                        $error_email = 'This email or username has been already . Please log in account';
                        setcookie("error_email", $error_email, time() + 600, "/");
                        header('location:/vi/dang-ky');
                        exit();
                    }
                }

                foreach ($query_user_email_username as $key) {
                    if ($key['username'] != $username) {
                        //Trường hợp cuối : username không tồn tại
                        $params['username'] = $username;
                        $params['password'] = md5($_POST['password_en']);
                        $params['mobile_account'] = $_POST['phone_en'];
                        $params['email'] = eModel::matchRegexEmail($_POST['email']);
                        $params['type_id'] = 1;
                        $params['created_dtm'] = date('Y-m-d H:i:s', time());
                        $success = Customers::_insert($table_name, $params);
                        if ($success) {
                            setcookie("error_email", $error_email, 0, "/");
                            setcookie("error_username", $error_username, 0, "/");
                            header('location:/vi/dang-nhap');
                            exit();
                        }
                    }
                }
            } else {
                $params['username'] = $username;
                $params['password'] = md5($_POST['password_en']);
                $params['mobile_account'] = $_POST['phone_en'];
                $params['email'] = eModel::matchRegexEmail($_POST['email']);
                $params['type_id'] = 1;
                $params['created_dtm'] = date('Y-m-d H:i:s', time());
                $success = Customers::_insert($table_name, $params);
                if ($success) {
                    setcookie("error_email", $error_email, 0, "/");
                    setcookie("error_username", $error_username, 0, "/");
                    header('location:/vi/dang-nhap');
                    exit();
                }
            }
        } else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['dang-ky'])) {

            //Kiểm tra username khi người dùng đăng ký có trong database chưa
            /*Hàm đăng ký được thực hiện như sau : Cột email trong bảng customer 
            được sử dụng cho dữ liệu khi nhấn đặt hàng, email người đặt sẽ được thêm vào.
            Nên sẽ ảnh hưởng tới phần đăng ký, vì đăng ký không đc trùng email. 
            Mà thanh toán offline thì username không có dữ liệu, nên dựa vào đây để check.
            Nếu select email mà cột username không có dữ liệu thì email của tài khoản đăng ký đó đc thêm vào db.
            */
            $username = eModel::matchRegexLogin($_POST['username_en']);
            $query_user_email_username = $customers_common->get_list_customer_email_username(
                $_POST['email'],
                $_POST['username_en']
            );
            $query_username = $customers_common->get_list_customer_username($_POST['username_en']);
            if (!empty($query_user_email_username)) {
                foreach ($query_user_email_username as $key) {
                    //Vòng lặp kiểm tra tất cả các row xem có trùng username không
                    if ($key['username'] == $username) {
                        $error_username = 'This username has been already . Please log in account';
                        setcookie("error_username", $error_username, time() + 600, "/");
                        header('location:/vi/dang-ky');
                        exit();
                    }
                }

                foreach ($query_user_email_username as $key) {
                    //Vòng lặp kiểm tra tất cả các row : Cột username và email đã có dữ liệu chưa, nếu username chưa có thì chèn, ng lại thì ko
                    if (!empty($key['email']) && !empty($key['username'])) {
                        $error_email = 'This email or username has been already . Please log in account';
                        setcookie("error_email", $error_email, time() + 600, "/");
                        header('location:/vi/dang-ky');
                        exit();
                    }
                }

                foreach ($query_user_email_username as $key) {
                    if ($key['username'] != $username) {
                        //Trường hợp cuối : username không tồn tại
                        $params['username'] = $username;
                        $params['password'] = md5($_POST['password_en']);
                        $params['mobile_account'] = $_POST['phone_en'];
                        $params['email'] = eModel::matchRegexEmail($_POST['email']);
                        $params['type_id'] = 1;
                        $params['created_dtm'] = date('Y-m-d H:i:s', time());
                        $success = Customers::_insert($table_name, $params);
                        if ($success) {
                            setcookie("error_email", $error_email, 0, "/");
                            setcookie("error_username", $error_username, 0, "/");
                            header('location:/vi/dang-nhap');
                            exit();
                        }
                    }
                }
            } else {
                $params['username'] = $username;
                $params['password'] = md5($_POST['password_en']);
                $params['mobile_account'] = $_POST['phone_en'];
                $params['email'] = eModel::matchRegexEmail($_POST['email']);
                $params['type_id'] = 1;
                $params['created_dtm'] = date('Y-m-d H:i:s', time());
                $success = Customers::_insert($table_name, $params);
                if ($success) {
                    setcookie("error_email", $error_email, 0, "/");
                    setcookie("error_username", $error_username, 0, "/");
                    header('location:/vi/dang-nhap');
                    exit();
                    // echo 'TH cuoois';
                    // return;
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

                    header('location:/vi');
                } else {
                    $error_username_password = 'Tài khoản hoặc mật khẩu không chính xác';
                    setcookie("error_username_password", $error_username_password, time() + 600, "/");

                    header('location:/vi/dang-nhap');
                }
            } else {
                $error_acount_does_not_exist = 'Tài khoản này không tồn tại';
                setcookie("error_acount_does_not_exist", $error_acount_does_not_exist, time() + 600, "/");

                header('location:/vi/dang-nhap');
            }
        }
    }

    //hàm đăng xuất
    function Logout_Customer()
    {
        if (isset($_SESSION['user_account'])) {
            unset($_SESSION['user_account']);
            header('location: vi/dang-nhap');
        } else
            header('location: /vi');
        // header('location:' . frontend_url() . ''); tương đương //header('location: vi/dang-nhap');
    }
    //hàm sửa thông tin tài khoản người dùng
    function Edit_Info_Account_Customer()
    {
        $customer = new Customers;
        $server = "localhost";
        $username = "root";
        $password = "";
        $dbname = "happyfruit_db";
        $connect = mysqli_connect($server, $username, $password, $dbname);

        if (!$connect) {
            echo 'kết nối thất bại ' . mysqli_connect_error();
            exit();
        }

        $error_email = NULL;
        //reset lại lỗi sau mỗi lần sửa thông tin
        setcookie("error_email", $error_email, 0, "/");

        $customer_id = $_SESSION['user_account'][0]['customer_id'];
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['phone-number'])) {
            
            //Sử dụng chung hàm matchRegex này do cùng chức năng là chống sql injection
            // $fullName = eModel::matchRegex_FullName($_POST['fullname']);
            $email = eModel::matchRegexEmail($_POST['email']);
            $phoneNumber = eModel::matchRegex_SearchProducts($_POST['phone-number']);
            // $address = eModel::matchRegexAddress($_POST['address']);
            // $building = eModel::matchRegexAddress($_POST['building']);
            // $companyName = eModel::matchRegex_SearchProducts($_POST['company-name']);
            // $companyTaxCode = eModel::matchRegex_SearchProducts($_POST['company-tax-code']);
            // $companyAddress = eModel::matchRegex_SearchProducts($_POST['company-address']);
            // $district = eModel::matchRegexDistrict($_POST['district']);

            //lấy email của tài khoản hiện tại đang đăng nhập
            // $query_user_email = $customer->get_list_customer_email_username($email);
            //Kiểm tra email người dùng nhập có trong database chưa, nếu tồn email đã tồn tại trên database thì báo lỗi
            // if (isset($query_user_email[0]['email']) && $query_user_email[0]['email'] != $_SESSION['user_account'][0]['email']) {
            //     if (isset($_POST['dang-ky'])) {
            //         $error_email = 'Email này đã có người sử dụng. Xin hãy chọn email khác';
            //     } else
            //         $error_email = 'This email already exists. Please enter another email';

            //     setcookie("error_email", $error_email, time() + 600, "/");
            // }
            // nếu email hợp lệ thì cập nhật thông tin trên database

            //câu lệnh sql 
            // $sql = 'UPDATE customers SET `customer_name` = ' . "N'" . $fullName . "'" . ', `email` = ' . "'" . $email . "'" .
            //     ', `mobile_account` = ' . "'" . $phoneNumber . "'" . ', `address` = ' . "N'" . $address . "'" . ', `building` = ' . "N'" . $building . "'" .
            //     ', `company_name` = ' . "N'" . $companyName . "'" . ', `company_tax_code` = ' . "'" . $companyTaxCode . "'" .
            //     ', `company_address` = ' . "N'" . $companyAddress . "'" . ', `district` = ' . "N'" . $district . "'" . ' WHERE `customer_id` = ' . $customer_id;
            $sql = "UPDATE customers SET `mobile_account` = '" . $phoneNumber . "', `email` = '".$email."'
                WHERE `customer_id` = '" . $customer_id . "' ";
                var_dump($sql);
            if (mysqli_query($connect, $sql)) {
                //cập nhật lại session thông tin tài khoản người dùng
                $data = $customer->get_list_customer_username($_SESSION['user_account'][0]['username']);
                $_SESSION['user_account'] = $data;
                header('location:/vi/profile');
                exit();
            } else {
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
            // kiem tra email co ton tai va dung dinh dang
            // if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            //     $email = $_POST['email'];
            // } else {
            //     $errors = "email";
            // }
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
                $conn = open_database();
                $sql = "SELECT  `customer_id`, `customer_name`, `username`, `email` FROM `customers` WHERE BINARY(email) = '" . $email . "'";
                $result = $conn->query($sql);
                $account = mysqli_fetch_assoc($result);

                if (empty($account)) {
                    $error_email = 'Email address does not exist';
                    setcookie("error_email", $error_email, time() + 600, "/");
                    header('Location: vi/dang-nhap');
                    exit();
                }

                $randPassword = rand_string(8);
                $content = "<h3> Dear " . $account['username'] . '</h3>';
                $content .= "<p>We have received a request to re-issue your password recently.</p>";
                $content .= "<p>We have updated and sent you a new password</p>";
                $content .= "<p>Your new password is : <b>$randPassword</b></p> ";
                $sendMail = Customers::send($content, $account['customer_name'], $account['email']);
                if ($sendMail) {
                    $password = md5($randPassword);
                    $sqlUpdate = "UPDATE `customers` SET `password`= '" . $password . "' WHERE `customer_id` = '" . $account['customer_id'] . "' ";
                    $conn->query($sqlUpdate);
                    $send_mail_success = 'We have sent a new password to your email. Please check it';
                    setcookie("send_mail_success", $send_mail_success, time() + 600, "/");
                    header('Location: /vi/dang-nhap');
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

            $conn = open_database();
            $sql = "SELECT  `password` FROM `customers` WHERE BINARY(username) = '" . $username . "'";
            $result = $conn->query($sql);
            $account = mysqli_fetch_assoc($result);

            if (!empty($account)) {
                if ($current_password === $account['password']) {
                    $sqlUpdate = "UPDATE `customers` SET `password`= '" . $new_password . "' WHERE BINARY(`username`) = " . "'" . $username . "'";
                    $conn->query($sqlUpdate);
                    setcookie("change_password_success", "Change password successfully", time() + 600, "/");
                    header('Location: /vi/dang-nhap');
                } else {
                    setcookie("error_password", "Incorrect password ", time() + 600, "/");
                    header('Location: /vi/dang-nhap');
                }
            } else {
                setcookie("error_username", "Username does not exist", time() + 600, "/");

                header('Location: /vi/dang-nhap');
            }
        }
    }

    /*show histories order */
}
/* End of CustomersController class */
