<?php

require SYS . 'boot' . EXT;

/**
 * Page not found (404)
 *  - TODO: Custom page in theme
 */
ToroHook::add('404', function() {
    echo 'Not found';
});

/**
 * Routes
 *  - Be sure to require them in the boot file if you're adding more
 */
Toro::serve(array(
    BASE => 'discussions',
    BASE . 'login/verify' => 'verify_login',  
    BASE . 'login' => 'login',
    BASE . 'signup' => 'signup',
    BASE . 'signup/submit' => 'submit_signup',
    BASE . 'user/:string' => 'user',
    BASE . 'discussion/create' => 'create_discussion',
    BASE . 'discussion/submit' => 'submit_discussion',
    BASE . 'discussion/:alpha' => 'view_discussion',
    BASE . 'discussion/:alpha/delete' => 'delete_discussion',
    BASE . 'discussion/:alpha/reply' => 'reply_discussion'
));

?>