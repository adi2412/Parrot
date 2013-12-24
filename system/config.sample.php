<?php

$CONFIG = array();

/**
 * Change the forum name, description, and blog in the admin panel.
 */

$CONFIG['database'] = array();
$CONFIG['database']['hostname'] = 'localhost';
$CONFIG['database']['database'] = 'parrot';
$CONFIG['database']['username'] = 'parrot_user';
$CONFIG['database']['password'] = 'parrot_pass';
$CONFIG['database']['prefix'] = 'parrot_';

$CONFIG['app'] = array();
$CONFIG['app']['baseurl'] = 'http://localhost'; // never use a trailing slash
$CONFIG['app']['basepath'] = '/parrot'; // always use a leading slash, but never a trailing slash

return $CONFIG;
