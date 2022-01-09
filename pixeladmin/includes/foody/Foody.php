<?php
/**
 * Foody
 *
 * API to retrieve data from Now Merchant
 * @version    1.0.0, 2018-07-10
 * @author     nthieu
 * @email      info@midsolutions.net
 */

function AutoLoader($className)
{
	$file = str_replace('\\',DIRECTORY_SEPARATOR,$className);
	require_once __DIR__ . DIRECTORY_SEPARATOR . $file . '.php';
}

spl_autoload_register('AutoLoader');

require_once ("Curl/Curl.php");
use \Curl\Curl;

class Foody
{
	/* Get those info by inspect tool (Chrome or Firefox) when logged in - AUTH will be expired in 1 month */
	/* eFruit restaurant ID */
	private $RestaurantID = 38544;

	private $curl = null;
	private $EndPoint = 'https://gmerchant.deliverynow.vn/api/order/';
	private $PreLoginEndPoint = 'https://gsso.deliverynow.vn/api/auth/prelogin';
	private $SecureLoginEndPoint = 'https://gsso.deliverynow.vn/api/auth/secure_login';

	private $PENDING_STATUS = 1;
	private $COMPLETED_STATUS = 2;
	private $CANCELED_STATUS = 3;

	public function __construct()
	{
		$this->curl = $this->init_curl();
	}

	private function init_curl()
    {
        $MERCHANT_AUTH = get_setting('merchant_auth_code');
        $curl = new Curl();
        $curl->setHeader('Host', 'gmerchant.deliverynow.vn');
        $curl->setHeader('User-Agent', 'insomnia/6.2.0');
        $curl->setHeader('Content-Type', 'application/json;charset=UTF-8');
        $curl->setHeader('x-foody-access-token', $MERCHANT_AUTH);
        $curl->setHeader('x-foody-api-version', '1');
        $curl->setHeader('x-foody-app-type', '1001');
        $curl->setHeader('x-foody-client-id', 'eFruit');
        $curl->setHeader('x-foody-client-language', 'vi');
        $curl->setHeader('x-foody-client-type', '1');
        $curl->setHeader('x-foody-client-version', '3.0.0');

        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);

        /* Return result as array */
        $curl->setDefaultJsonDecoder(true);
        return $curl;
    }

	public function login()
	{
	    $myAccount = 'hieu.ps.nguyen@gmail.com';
        $myPass = 'traicayViet20';

		$curl = new Curl();
        $curl->setHeader('Host', 'gsso.deliverynow.vn');
        $curl->setHeader('User-Agent', 'insomnia/6.2.0');
        $curl->setHeader('Content-Type', 'application/json;charset=UTF-8');
        $curl->setHeader('x-foody-api-version', '1');
        $curl->setHeader('x-foody-app-type', '1001');
        $curl->setHeader('x-foody-client-id', 'eFruit');
        $curl->setHeader('x-foody-client-type', '1');
        $curl->setHeader('x-foody-client-version', '3.0.0');

		$curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
        $curl->setDefaultJsonDecoder(true);
		$result = $curl->post($this->PreLoginEndPoint, array("account" => $myAccount));
		if ($this->curl->error) {
			$this->log('Login NowMerchant error on step1: ' . $this->curl->errorCode . ': ' . $this->curl->errorMessage . "\n");
			return false;
		}
		if (empty($result) || empty($result['reply']) || $result['result'] != 'success')
		    return false;
		$this->VerifyCode = $result['reply']['verify_code'];
        $this->Salt = $result['reply']['salt'];

        $encoded_password = hash('sha256', sha1($myPass.$this->Salt). $this->VerifyCode);
        $ciphertext_raw = openssl_encrypt($myPass, "AES-256-CBC", pack("H*",$encoded_password), OPENSSL_RAW_DATA, pack("H*",'00000000000000000000000000000000'));
        $encrypted_password = implode(unpack("H*",$ciphertext_raw));

        $result = $curl->post($this->SecureLoginEndPoint, array("account" => $myAccount, 'password' => $encrypted_password));
        if ($this->curl->error) {
            $this->log('Login NowMerchant error on step 2: ' . $this->curl->errorCode . ': ' . $this->curl->errorMessage . "\n");
            return false;
        }
        if (empty($result) || empty($result['reply']) || $result['result'] != 'success')
            return false;
        if(!empty($result['reply']['access_token']) && strlen($result['reply']['access_token']) == 128){
            set_setting('merchant_auth_code', $result['reply']['access_token']);
            $this->log('Login NowMerchant successfully!');
            return true;
        }
		return false;

		/*
	    A = function(e, t, n) {
                var a = g(e, t, n);
                return f(e, a);
        }

        function g(e, t, n) {
            var a = i.a.SHA1(e + t).toString(i.a.enc.Hex);
            return i.a.SHA256(a + n);
        }

        function f(e, t) {
            var n = i.a.enc.Hex.parse("00000000000000000000000000000000");
            return i.a.AES.encrypt(e, i.a.enc.Hex.parse(t.toString()), {
                iv: n,
                padding: i.a.pad.Pkcs7,
                mode: i.a.mode.CBC
            }).ciphertext.toString(i.a.enc.Hex);
        }
	    */
	}

	private function log($message)
	{
		$fp = fopen(__DIR__ . "/debuglog.txt", "a");
		if (empty($fp))
			return false;
		fputs($fp, date("Y-m-d H:i:s") . " - " . $message . "\n");
		fclose($fp);
	}

	public function getOrders($request_data = array())
	{
		$default_data = array(
			'from_date' => '2018-07-03',
			'to_date' => '2018-07-03',
			'status' => $this->COMPLETED_STATUS,
			'restaurant_ids' => array($this->RestaurantID)
		);

		$request_data = array_merge($default_data, $request_data);
		$result = $this->curl->post($this->EndPoint.'get_list_v3', $request_data);

		if ($this->curl->error) {
			$this->log('Get orders error: ' . $this->curl->errorCode . ': ' . $this->curl->errorMessage . "\n");
			return null;
		}

		if (empty($result['result']) || $result['result'] != 'success')
			return null;
		$order_codes = $result['reply']['order_codes'];

		if (empty($order_codes))
		    return null;
        $curl = $this->init_curl();
        $request_data = array(
            'order_codes' => $order_codes
        );
        $result = $curl->post($this->EndPoint.'get_order_basic_infos', $request_data);

        if ($curl->error) {
            $this->log('Get orders error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n");
            return null;
        }
        if (empty($result['result']) || $result['result'] != 'success')
            return null;

        return $result['reply']['orders'];
	}

	public function getOrderDetails($orderId)
	{
		$result = $this->curl->get($this->EndPoint.'get_order_details_v3?order_code='.$orderId);

		if ($this->curl->error) {
			$this->log('Get order details error: ' . $this->curl->errorCode . ': ' . $this->curl->errorMessage . "\n");
			return null;
		}
		if (empty($result['result']) || $result['result'] != 'success')
			return null;
		return $result['reply'];
	}
}
