<?php
if(file_exists(__DIR__.'/env.php')) {
    include __DIR__.'/env.php';
}

function env($key, $default = null) {
    global $e_config;
    return isset($e_config[$key])?$e_config[$key]:$default;
}

?>