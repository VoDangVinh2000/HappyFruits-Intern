<?php
if(file_exists(dirname(__DIR__).'/env.php')) {
    include dirname(__DIR__).'/env.php';
}

function env($key, $default = null) {
    global $e_config;
    return isset($e_config[$key])?$e_config[$key]:$default;
}

?>