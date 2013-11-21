<?php

/**
 * Libraries
 */
require APP . 'libraries' . DS . 'toro' . EXT;
require APP . 'libraries' . DS . 'auth' . EXT;
require APP . 'libraries' . DS . 'database' . EXT;
require APP . 'libraries' . DS . 'discussion' . EXT;

/**
 * Handlers
 */
// frontend
require APP . 'handlers' . DS . 'admin' . EXT;
require APP . 'handlers' . DS . 'discussions' . EXT;
require APP . 'handlers' . DS . 'user' . EXT;
require APP . 'handlers' . DS . 'login' . EXT;
require APP . 'handlers' . DS . 'signup' . EXT;

// backend
require APP . 'handlers' . DS . 'submit_signup' . EXT;
require APP . 'handlers' . DS . 'delete_discussion' . EXT;
require APP . 'handlers' . DS . 'view_discussion' . EXT;
require APP . 'handlers' . DS . 'verify_login' . EXT;
require APP . 'handlers' . DS . 'create_discussion' . EXT;
require APP . 'handlers' . DS . 'submit_discussion' . EXT;
require APP . 'handlers' . DS . 'reply_discussion' . EXT;

?>