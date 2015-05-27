<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */

/*function setBaseUrl() {
    global $g_BaseUrl;
    $g_BaseUrl = '/Evolus/';
    Zend_Registry::set('email', 'aa');
}
setBaseUrl();*/

chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

    
// Setup autoloading
require 'init_autoloader.php';


// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
