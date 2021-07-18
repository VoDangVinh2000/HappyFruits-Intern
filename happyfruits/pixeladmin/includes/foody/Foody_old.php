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
	private $UDID = '7b68bfaa-7282-43d5-b317-fac0c18471b9';
	private $AUTH = '';
	private $MERCHANT_AUTH = '';
	private $SESSION_ID = 'mt1m5gwgatuprhe4qi2cva2z';

	/* eFruit restaurant ID */
	private $RestaurantID = 38544;

	private $curl = null;
	private $EndPoint = 'https://merchant.now.vn/Merchant/';

	private $PENDING_STATUS = 1;
	private $COMPLETED_STATUS = 2;
	private $CANCELED_STATUS = 3;

	public function __construct()
	{
		$this->AUTH = get_setting('delivery_auth_code');
		$this->MERCHANT_AUTH = get_setting('merchant_auth_code');
		$this->curl = new Curl();
		$this->curl->setHeader('Accept', 'application/json, text/plain, */*');
		$this->curl->setHeader('Accept-Encoding', 'gzip, deflate, br');
		$this->curl->setHeader('Accept-Language', 'en-US,en;q=0.9');
		$this->curl->setHeader('Connection', 'keep-alive');
		$this->curl->setHeader('Content-Type', 'application/json;charset=UTF-8');
		$this->curl->setHeader('Host', 'merchant.now.vn');
		$this->curl->setHeader('Origin', 'https://merchant.now.vn');
		$this->curl->setHeader('Referer', 'https://merchant.now.vn/');
		$this->curl->setHeader('X-Requested-With', 'XMLHttpRequest');
		$this->curl->setUserAgent('Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36');

		$this->curl->setCookie('flg', 'vn');
		$this->curl->setCookie('ASP.NET_SessionId', $this->SESSION_ID);
		$this->curl->setCookie('floc', '217');
		$this->curl->setCookie('_ga', 'GA1.2.1595198346.1531152895');
		$this->curl->setCookie('_gid', 'GA1.2.567035244.1531152895');
		$this->curl->setCookie('mroot', '1');
		$this->curl->setCookie('view', 'grid');
		$this->curl->setCookie('MERCHANT.AUTH.UDID', $this->UDID);
		$this->curl->setCookie('MERCHANT.AUTH', $this->MERCHANT_AUTH);
		$this->curl->setCookie('ilg', '1');
		$this->curl->setCookie('_gat', '1');
		$this->curl->setCookie('shareCartId', '0');
		$this->curl->setCookie('OnlineRestaurant', $this->RestaurantID);

		$this->curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);

		/* Return result as array */
		$this->curl->setDefaultJsonDecoder(true);
	}

	public function login()
	{
		/*
		$curl = new Curl();
		$curl->setOpt(CURLOPT_CONNECTTIMEOUT, 30);
		$curl->setOpt(CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36');
		$curl->setOpt(CURLOPT_RETURNTRANSFER, true);
		$curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
		$curl->setOpt(CURLOPT_HEADER, true);
		$curl->setOpt(CURLOPT_FOLLOWLOCATION, false);

		$result = $curl->post('https://id.foody.vn/dang-nhap', array('Email' => 'hieu.ps.nguyen@gmail.com', 'Password' => 'mikjuji9k'));
		if ($this->curl->error) {
			$this->log('Login error: ' . $this->curl->errorCode . ': ' . $this->curl->errorMessage . "\n");
			return false;
		}
		$headers = explode("\n", $result);
		if (empty($headers))
			return false;
		$beginStr = 'Set-Cookie: ';
		$cookie_values = array('flg=vn');
		foreach($headers as $header){
			if (strpos($header, $beginStr) === 0){
				$cookie_line = str_replace($beginStr, '', $header);
				if (strpos($cookie_line, 'IDFOODY') === 0){
					$values = explode('; ', $cookie_line);
					$cookie_values[] = $values[0];
				}
			}
		}
		$curl->setOpt(CURLOPT_COOKIE, implode('; ', $cookie_values));
		$result = $curl->get('https://id.foody.vn/tai-khoan');
		if ($this->curl->error) {
			$this->log('Login error: ' . $this->curl->errorCode . ': ' . $this->curl->errorMessage . "\n");
			return false;
		}
		$headers = explode("\n", $result);
		if (empty($headers))
			return false;
		$beginStr = 'Set-Cookie: ';
		foreach($headers as $header){
			if (strpos($header, $beginStr) === 0){
				$cookie_line = str_replace($beginStr, '', $header);
				if (strpos($cookie_line, '__RequestVerificationToken') === 0){
					$values = explode('; ', $cookie_line);
					$cookie_values[] = $values[0];
				}
			}
		}
		$curl->setOpt(CURLOPT_COOKIE, implode('; ', $cookie_values));
		$result = $curl->get('https://www.now.vn/order-management');
		var_dump($result);
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
			'OrderCode' => '',
			'BeginDate' => '03/07/2018',
			'EndDate' => '10/07/2018',
			'status' => $this->COMPLETED_STATUS,
			'pageIndex' => 0,
			'pageSize' => 10000,
			'restaurantId' => $this->RestaurantID,
			'sortBy' => 1
		);

		$request_data = array_merge($default_data, $request_data);
		$result = $this->curl->post($this->EndPoint.'GetOrdersByFilter', $request_data);

		if ($this->curl->error) {
			$this->log('Get orders error: ' . $this->curl->errorCode . ': ' . $this->curl->errorMessage . "\n");
			return null;
		}
		if (empty($result['success']))
			return null;
		return $result['data'];
	}

	public function getOrderDetails($orderId, $deliveryId)
	{
		$request_data = array(
			'orderId' => $orderId,
			'deliveryId' => $deliveryId,
			'isReceived' => false
		);
		$result = $this->curl->post($this->EndPoint.'GetOrderReceivedItems', $request_data);

		if ($this->curl->error) {
			$this->log('Get order details error: ' . $this->curl->errorCode . ': ' . $this->curl->errorMessage . "\n");
			return null;
		}
		if (empty($result['success']))
			return null;
		return $result;
	}
}
