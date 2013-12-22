<?php

class login
{
    /**
     * This is the login page
     */
    function get()
    {
        // TODO: Make the theme name an option
        if (auth::isLoggedIn()) {
            unset($_COOKIE['parrotSession']);
            setcookie('parrotSession', null, -1, Parrot::getInstance()->config()->getConfig("app/basepath"));
        }
        require(APP . 'views' . DS . 'login.php');
    }
}

class signup
{
    /**
     * This is the signup page
     */
    function get()
    {
        // TODO: Make the theme name an option
        require(APP . 'views' . DS . 'signup.php');
    }
}

class submit_signup
{
    function post()
    {
        auth::createAccount($_POST['username'], $_POST['password'], $_POST['email'], $_POST['name']);
        auth::verify($_POST['username'], $_POST['password']);
        header("Location: " . Parrot::getInstance()->getUrl("login"));
    }
}

class user
{
    /**
     * This is the user profile page
     */
    function get($slug)
    {
        echo "Woo! Hi, " . $slug;
    }
}

class verify_login
{
    function post()
    {
        auth::verify($_POST["username"], $_POST["password"]);
    }
}
