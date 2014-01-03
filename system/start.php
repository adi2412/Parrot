<?php

/** Check to see if Parrot has been installed. */
if (!file_exists(SYS . "etc" . DS . "install")) {
    header("Location: " . Parrot::getInstance()->getUrl("install.php"));
    exit;
}

require_once(SYS . "toro.php");

/**
 * Page not found (404)
 *  - TODO: Custom page in theme
 */
ToroHook::add("404", function() {
    echo "Not found";
});

// All routes should start with a leading slash.
$routes = array(
    "/"                                 => 'discussions',
    "/login/verify"                     => 'verify_login',
    "/login"                            => 'login',
    "/signup"                           => 'signup',
    "/signup/submit"                    => 'submit_signup',
    "/user/:alpha"                      => 'user',
    "/users"                            => 'users',
    "/discussion/create"                => 'create_discussion',
    "/discussion/submit"                => 'submit_discussion',
    "/discussion/edit"                  => 'edit_submit_discussion',
    "/discussion/:alpha"                => 'view_discussion',
    "/discussion/:alpha/delete"         => 'delete_discussion',
    "/discussion/:alpha/reply"          => 'reply_discussion',
    "/discussion/:alpha/stick"          => 'stick_discussion',
    "/discussion/:alpha/edit"           => 'edit_discussion',
    "/discussion/:alpha/lock"           => 'lock_discussion',
    "/admin"                            => 'admin',
    "/admin/category/:alpha/delete"     => 'admin_cat_delete',
    "/admin/category/create"            => 'admin_cat_create',
    "/admin/info/update"                => 'admin_info_update',
    "/admin/user/:alpha/delete"         => 'admin_user_delete',
    "/admin/user/:alpha/promote"        => 'admin_user_promote',
    "/admin/user/:alpha/demote"         => 'admin_user_demote',
    "/reply/:alpha/delete"              => 'reply_delete'
);

$basePath = Parrot::getInstance()->config()->getConfig("app/basepath");

Toro::serve($routes, $_SERVER, $basePath);
