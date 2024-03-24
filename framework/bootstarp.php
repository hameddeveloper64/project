<?php
// Error Reporting
error_reporting(E_ALL);

if (version_compare(phpversion(), '8.0.0', '<') == true) {
	exit('PHP8+ Required');
}
if (!ini_get('date.timezone')) {
	date_default_timezone_set('Asia/Tehran');
}

//engine
//require_once(DIR_SYSTEM . "/engine/registry.php");
//require_once(DIR_SYSTEM . "/engine/controller.php");
//require_once(DIR_SYSTEM . "/engine/model.php");
//require_once(DIR_SYSTEM . "/engine/admin.php");
//require_once(DIR_SYSTEM . "/engine/catalog.php");
//require_once(DIR_SYSTEM . "/engine/loader.php");

//vendor
require_once(DIR_STORAGE . "/vendor/autoload.php");

$a = new \Magnet\App\Library\A();


// Registry
$registry = new \Magnet\App\Engine\Registry();

//Log
$log = new \Magnet\App\Library\Log("error_log");
$registry->set("log",$log);

set_error_handler(function($code, $message, $file, $line) use($log) {
    // error suppressed with @
    if (error_reporting() === 0) {
        return false;
    }

    switch ($code) {
        case E_NOTICE:
        case E_USER_NOTICE:
            $error = 'Notice';
            break;
        case E_WARNING:
        case E_USER_WARNING:
            $error = 'Warning';
            break;
        case E_ERROR:
        case E_USER_ERROR:
            $error = 'Fatal Error';
            break;
        default:
            $error = 'Unknown';
            break;
    }

    if (conf_error_display) {
        echo '<b>' . $error . '</b>: ' . $message . ' in <b>' . $file . '</b> on line <b>' . $line . '</b>';
    }

    if (conf_error_log) {
        $log->write('PHP ' . $error . ':  ' . $message . ' in ' . $file . ' on line ' . $line);
    }

    return true;
});

//Smarty
$smarty = new Smarty();
$smarty->setTemplateDir(DIR_TEMPLATE);
$smarty->setConfigDir(DIR_SYSTEM.'/config/smarty');
$smarty->setCompileDir(DIR_CACHE_TEMPLATES);
$smarty->setCacheDir(DIR_CACHE_TEMPLATES);

$registry->set('smarty', $smarty);

//database
$db= new \Magnet\App\Library\Database("localhost", "root", "", "loadmore" , 3306);
$registry->set("db",$db);

//Cache
$cache = new \Magnet\App\Library\Cache();
$registry->set("cache",$cache);

/*













// Loader
$admin = new Admin;
$registry->set('admin', $admin);
$catalog = new Catalog;
$registry->set('catalog', $catalog);
$load = new Loader($registry);
$registry->set('load', $load);

*/

?>