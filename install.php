<?php

// bootstrap the system. Initialise various things and load configuration
require_once(__DIR__ . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . 'bootstrap.php');

// check to see if Parrot has already been installed
if (file_exists(SYS . 'etc' . DS . 'install')) {
    // Parrot is already installed. Redirect to the home page.
    require(APP . 'views' . DS . 'install' . DS . 'already.php');
    exit;
}

require(APP . 'views' . DS . 'install' . DS . 'install.php');
