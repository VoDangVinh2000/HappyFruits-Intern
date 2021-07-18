<?php
    require_once dirname(__FILE__). '/env.inc.php';

    ini_set('display_startup_errors',1);
    ini_set('display_errors',1);
    ini_set('default_charset', 'UTF-8');
    mb_internal_encoding('UTF-8');
    
    error_reporting(-1);
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    define("VERSION", env("VERSION", "5.0"));
    define("DB_VERSION", env("DB_VERSION", "12.5"));
    define("ASSET_UPDATED_DATE", env("ASSET_UPDATED_DATE", "20200712"));

    define('ITEMS_PER_PAGE', env("ITEMS_PER_PAGE", 50));
    define('PASSWORD_LENGTH', 32);
    define('SALT', 'eFruit24082013');
    
    /* RSA keys */
    define("KEY_PUBLIC", '-----BEGIN PUBLIC KEY-----MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBALVICFZvBGpV1khNc9ZEYfbD96YMUd5Onu3dmkx8rauqj+mtssljuXRSoeprkkvPH1eJaPA6XI8rkeAlnth+4+sCAwEAAQ==-----END PUBLIC KEY-----');
    define("KEY_PRIVATE", "-----BEGIN ENCRYPTED PRIVATE KEY-----
MIIBpjBABgkqhkiG9w0BBQ0wMzAbBgkqhkiG9w0BBQwwDgQIxE9pBVNi35kCAggA
MBQGCCqGSIb3DQMHBAhIzWD9DxEdRgSCAWAr7xettHMB2EBU+jwjLkIok13E5LNl
jhr4/4OCUqF9qEAxyJU/sOfznAUpbmOI2KYW5SVis7rwbRs6mwNg1iZGqP8BwaYz
79M1KHblQguDRCIDhCej7iGC8MJyQBE/IaI+IlTPOyYcxQI/AuL5xhFk5w+NLT3f
Nu+eEOyPiIh2uMp8CnT7dg6dQnGa4ENSAo26ex2TAK3BW+IvN9VgCHHQHmeLmw7n
iM3IqSukQuMKS15CH/Uc3rMuWY3ZAWncSqZbyrFKyk5nEgFwgH7PIXQarpsXzBPw
4T/XfNwzCSNVYcoWBm3IRFLKi9csf3giU9f0EWNCQMTzQa1Iu1dzxLll8PjNRONf
x1EE2vkcF8IJXSC1LOjOPkO2P1UrFlibXrAL/WVgoFUwywcF83+/Rd8I6W++Cv9E
r3wqT8Ij0YY8388DOZH8rGrcHNx6fqMvTjsrWZ9mP3Lwih58jGoXu/sT
-----END ENCRYPTED PRIVATE KEY-----");
    define("KEY_PASSPHRASE", "eFruit24082013");
    
    define('START_DATE', '2014-10-15'); /* First day in system */
    
    define('SUPER_ADMIN_TYPE_ID', 1);
    define('ADMIN_TYPE_ID', 2);
    define('MEMBER_TYPE_ID', 3);
    define('SHIFT_LEADER_1_TYPE_ID', 4);
    define('SHIFT_LEADER_2_TYPE_ID', 5);
	define('SHIP_SERVICE_TYPE_ID', 6);
    
    define("ABSOLUTE_PATH", str_replace('includes', '', __DIR__));
    define("EFRUIT_ABSOLUTE_PATH", dirname(ABSOLUTE_PATH). '/');
    //define("PHPBB_ROOT_PATH",dirname(PHPBB_ROOT_PATH));

    define("IMPORT_PATH", ABSOLUTE_PATH. 'import/');
    define("FILES_PATH", ABSOLUTE_PATH. 'files/');
    define("DOCUMENT_FILES_PATH", ABSOLUTE_PATH. 'views/document/files/');
    
    define("DEFAULT_LAT", env("DEFAULT_LAT","10.805838"));
    define("DEFAULT_LNG", env("DEFAULT_LNG","106.66616"));
    
    define("STAY_TYPE_ID", 1);
    define("TAKEAWAY_TYPE_ID", 2);
    define("DELIVERY_TYPE_ID", 3);
    define("MAX_TIMES_TO_DO_ASSESSMENT_LATE", env("MAX_TIMES_TO_DO_ASSESSMENT_LATE", 3));
    
    define("CAPTCHA_NAME", md5("eFruit-captcha" . date("md")));
    
    define("WARNING_QUANTITY", env('WARNING_QUANTITY', 3));
    
    define("NUMBER_OF_ITEMS_PER_PAGE", env('NUMBER_OF_ITEMS_PER_PAGE', 8));
    
    define("DEFAULT_TAG_ID", 1);
    
    define("EFRUIT_CAT_ID", 2);
    define("CAKES_CAT_ID", 11);
    define("RAW_FRUIT_CAT_ID", 12);
    define("FRUIT_FREE_CHOICES_CAT_ID", 14);
    define("FRUIT_BOX_CAT_ID", 19);
    
    define("GALLERY_ID", 1);
    
    define("ACTIVE_THEME", env("ACTIVE_THEME", "efruit"));
    define("TEMPLATE_FILES_PATH", EFRUIT_ABSOLUTE_PATH. 'themes/' . ACTIVE_THEME .'/');

	define("FRUIT_COST_TYPE_ID", 1);
	define("FRUIT_DEBT_TYPE_ID", 1);

	define("INVENTORY_COST_TYPE_ID", 4);
    define("OTHER_COST_TYPE_ID", 8);
    define("SHIPPING_COST_TYPE_ID", 12);

	define("INVENTORY_DEBT_TYPE_ID", 4);
	define("CUSTOMER_DEBT_TYPE_ID", 8);

    define("SHIPNOW_USER_ID", 157);

    define("USING_SAME_PRICE", env('USING_SAME_PRICE', 1));
    
    set_error_handler('exceptions_error_handler');
    function exceptions_error_handler($severity, $message, $filename, $lineno) {
        if (error_reporting() == 0) {
            return;
        }
        if (error_reporting() & $severity) {
            throw new ErrorException($message, 0, $severity, $filename, $lineno);
        }
    }
    
    if (!session_id())
        session_start();
    
    require_once(ABSOLUTE_PATH. "models/common/Users.php");
    require_once ABSOLUTE_PATH. 'includes/hash.helper.php';
    require_once ABSOLUTE_PATH. 'includes/functions.inc.php';
    require_once ABSOLUTE_PATH. 'includes/db.inc.php';
    
    define("PRE_BOOKING_DISCOUNT", get_setting('pebooking_discount', 0.1));
    define("PRE_BOOKING_DISCOUNT_2", get_setting('pebooking_discount_2', 0.05));

    define("SYSTEM_EMAIL", env("SYSTEM_EMAIL", 'hethong@'. DOMAIN_NAME));
	define("KIEUOANH_EMAIL", 'kieuoanh21083@gmail.com');

    define("SHIFT_SEPARATOR_TIME", env("SHIFT_SEPARATOR_TIME", "17:30"));

    define("LHP_BRANCH_ID", 1);
    define("HTC_BRANCH_ID", 2);

	define("ORDER_TYPE_STAY_ID", 1);
	define("ORDER_TYPE_TAKEAWAY_ID", 2);
	define("ORDER_TYPE_DELIVERY_ID", 3);
	define("ORDER_TYPE_FOODY_ID", 8);
	define("ORDER_TYPE_GRABFOOD_ID", 9);
    define("ORDER_TYPE_GOFOOD_ID", 10);
    define("ORDER_TYPE_BAEMIN_ID", 11);

	define("EFRUIT_CUSTOMER_TYPE_ID", 1);
	define("FOODY_CUSTOMER_TYPE_ID", 7);

	define("MATERIAL_INVENTORY_ITEM_TYPE_ID", 1);

	define("RAW_INVENTORY_ID", 1);
	define("ND_INVENTORY_ID", 2);

	define("META_DESCRIPTION", get_setting('meta_description'));
    define("META_KEYWORDS", get_setting('meta_keywords'));

    define("SSO_FORUM", env("SSO_FORUM", 0));
    define('GA_ID', env('GA_ID', 'UA-42643123-1'));

    define('ACTIVE_PROJECT', env('ACTIVE_PROJECT', 'efruit'));