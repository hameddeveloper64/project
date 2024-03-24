<?php

define ("MAGNET_DIR",str_replace('\\', '/', realpath(dirname(__FILE__) . '/')));
define("DIR_SYSTEM",MAGNET_DIR."/framework");
define('DIR_IMAGE', MAGNET_DIR."/uploads/");
define('DIR_STORAGE', DIR_SYSTEM . "/storage/");
define('DIR_TEMPLATE', MAGNET_DIR . "/frontend/view/");
define('DIR_BACKUP', DIR_STORAGE . 'backup/');
define('DIR_CACHE', DIR_STORAGE . 'cache/');
define('DIR_CACHE_IMAGES', DIR_CACHE . 'images/');
define('DIR_CACHE_MYSQL', DIR_CACHE . 'mysql/');
define('DIR_CACHE_TEMPLATES', DIR_CACHE . 'templates/');
define('DIR_LOGS', DIR_STORAGE . 'logs/');
define('DIR_SESSION', DIR_STORAGE . 'session/');


/*
define('DB_DRIVER', 'mpdo');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'opencart2019');
define('DB_PORT', '3306');
define('DB_PREFIX', 'oc_');
*/
//config vars
define("conf_error_display" , true);
define("conf_error_log" , true);
?>