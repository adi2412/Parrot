<?php

/**
 * Get requires and init important variables
 */
require_once(SYS . 'boot' . EXT);

/**
 * Page not found (404)
 *  - TODO: Custom page in theme
 */
ToroHook::add('404', function() {
    echo 'Not found';
});

/**
 * Routes
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
    BASE . 'discussion/:alpha/reply' => 'reply_discussion',
    BASE . 'admin' => 'admin',
    BASE . 'admin/category/:alpha/delete' => 'admin_cat_delete',
    BASE . 'admin/category/create' => 'admin_cat_create',
    BASE . 'admin/info/update' => 'admin_info_update',
));

?>