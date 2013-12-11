<?php

/**
 * Libraries
 */
$files = glob(APP . 'libraries' . DS . '/*' . EXT);
foreach ($files as $file) {
    require_once($file);
}

/**
 * Functions
 */
$files = glob(SYS . 'functions' . DS . '/*' . EXT);
foreach ($files as $file) {
    require_once($file);
}

/**
 * Handlers
 */
$files = glob(APP . 'handlers' . DS . '/*' . EXT);
foreach ($files as $file) {
    require_once($file);
}

/**
 * Vars
 */
$discussion_title = null;
$messages;
