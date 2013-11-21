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
define('EXT', '.php');

// let's fly
if (file_exists(PATH . 'install' . DS . 'config' . EXT)) {
	require INSTALL . 'config' . EXT;
	require SYS . 'start' . EXT;
} else {
	require INSTALL . 'install' . EXT;
}

?>