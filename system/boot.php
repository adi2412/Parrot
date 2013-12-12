<?php

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
