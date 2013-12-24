<?php

$CONFIG = array();

// change these values after install in the admin panel
$CONFIG['forum'] = array();
$CONFIG['forum']['name'] = 'Parrot';
$CONFIG['forum']['description'] = 'Minimalist discussion platform.';
$CONFIG['forum']['theme'] = 'default';

$CONFIG['database'] = array();
$CONFIG['database']['hostname'] = 'localhost';
$CONFIG['database']['database'] = 'parrot';
$CONFIG['database']['username'] = 'parrot_user';
$CONFIG['database']['password'] = 'parrot_pass';
$CONFIG['database']['prefix'] = 'parrot_';

$CONFIG['app'] = array();
$CONFIG['app']['baseurl'] = 'http://localhost'; // Never use a trailing slash
$CONFIG['app']['basepath'] = '/parrot'; // Always use a leading slash, but never a trailing slash

return $CONFIG;
