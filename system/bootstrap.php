<?php

define("VERSION", "0.1");

define("DS", DIRECTORY_SEPARATOR);
define("PATH", dirname(__DIR__) . DS);
define("APP", PATH . "parrot" . DS);
define("SYS", PATH . "system" . DS);

require(APP . "config.php");
require(APP . "database.php");
require(APP . "parrot.php");
Parrot::initialise(new Config(SYS . "config.php"));

/**
 * Libraries
 */
$files = glob(APP . "libraries" . DS . "/*.php");
foreach ($files as $file) {
    require_once($file);
}

/**
 * Functions
 */
$files = glob(SYS . "functions" . DS . "/*.php");
foreach ($files as $file) {
    require_once($file);
}

/**
 * Handlers
 */
$files = glob(APP . "handlers" . DS . "/*.php");
foreach ($files as $file) {
    require_once($file);
}

/**
 * Vars
 */
$discussion_title = null;
$messages;
