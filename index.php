<?php

/**
 * Parrot
 */

define('START_TIME', microtime(true));
define('DS', DIRECTORY_SEPARATOR);
define('VERSION', '0.1');

define('PATH', dirname(__FILE__) . DS);
define('APP', PATH . 'parrot' . DS);
define('SYS', PATH . 'system' . DS);
define('INSTALL', PATH . 'install' . DS);
define('BASE', substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'],basename($_SERVER['SCRIPT_NAME']))));

// let's fly
if (file_exists(PATH . "install" . DS . "config.php")) {
	require_once(INSTALL . "config.php");
	require_once(SYS . "start.php");
} else {
	require_once(INSTALL . "install.php");
}
