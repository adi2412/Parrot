<?php

/**
 * Parrot
 */

/**
 * Constants
 */
define('START_TIME', microtime(true));

/**
 * Spread our wings
 *  - bootstrap the system
 *  - initialise various things and load configuration
 */
require_once(__DIR__ . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . 'bootstrap.php');

/**
 * Let's fly 
 */
require_once(SYS . 'start.php');
