<?php

class admin
{
    function get()
    {
        /**
         * This is the admin page
         */
        if (auth::isLoggedIn() && auth::isAdmin()) {
            require(APP . "views" . DS . "admin" . DS . "index.php");
        } else {
            header("Location: " . Parrot::getInstance()->getUrl("login"));
        }
    }
}

class admin_cat_create
{
    function post()
    {
        /**
         * This is the submit category function
         */
        if (auth::isLoggedIn() || auth::isAdmin()) {
            if (preg_match("/^[A-Za-z0-9\s]+$/", $_POST["title"])) {
                $title = $_POST["title"];
                category::submit($title);
                header("Location: " . Parrot::getInstance()->getUrl("admin"));
            } else {
                global $messages;
                $messages = 'Only include spaces, letters and numbers in the name.';
                require(APP . 'views' . DS . 'admin' . DS . 'index.php');
            }
        } else {
            header("Location: " . Parrot::getInstance()->getUrl("login"));
        }
    }
}

class admin_cat_delete
{
    function get($slug)
    {
        /**
         * This is the delete category page
         */
        if (auth::isLoggedIn() && auth::isAdmin()) {
            category::delete($slug);
            header("Location: " . Parrot::getInstance()->getUrl("admin"));
        } else {
            header("Location: " . Parrot::getInstance()->getUrl("login"));
        }
    }
}

class admin_info_update
{
    /**
     * This is the submit category function
     */
    function post()
    {
        if (auth::isLoggedIn() || auth::isAdmin()) {
            if (preg_match("/^[A-Za-z0-9\s]+$/", $_POST['title'])) {
                $title = $_POST['title'];
                $description = $_POST['description'];
                $theme = $_POST['theme'];
                info::update($title, $description, $theme);
                header("Location: " . Parrot::getInstance()->getUrl("admin"));
            } else {
                global $messages;
                $messages = 'Only include spaces, letters and numbers in the name.';
                require(APP . 'views' . DS . 'admin' . DS . 'index.php');
            }
        } else {
            header("Location: " . Parrot::getInstance()->getUrl("login"));
        }
    }
}

class admin_user_delete
{
    /**
     * This is the delete user page
     */
    function get($slug)
    {
        if (auth::isLoggedIn() && auth::isAdmin()) {
            auth::deleteAccount($slug);
        } else {
            header("Location: " . Parrot::getInstance()->getUrl("login"));
        }
    }
}

class admin_user_demote
{
    /**
     * This is the demote user page
     */
    function get($slug)
    {
        if (auth::isLoggedIn() && auth::isAdmin()) {
            auth::demoteAccount($slug);
        } else {
            header("Location: " . Parrot::getInstance()->getUrl("login"));
        }
    }
}

class admin_user_promote
{
    /**
     * This is the premote user page
     */
    function get($slug)
    {
        if (auth::isLoggedIn() && auth::isAdmin()) {
            auth::promoteAccount($slug);
        } else {
            header("Location: " . Parrot::getInstance()->getUrl("login"));
        }
    }
}
