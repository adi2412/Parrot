<?php

class login {
    function get() {
    	/**
    	 * This is the login page
    	 */
        // TODO: Make the theme name an option
		if (auth::isLoggedIn()) {
			unset($_COOKIE['parrotSession']);
            setcookie('parrotSession', null, -1, BASE);
		}
        require(APP . 'views' . DS . 'login' . EXT);
    }
}

class signup {
    function get() {
        /**
         * This is the signup page
         */
        // TODO: Make the theme name an option
        require(APP . 'views' . DS . 'signup' . EXT);
    }
}

class submit_signup {
     function post() {
        auth::createAccount($_POST['username'], $_POST['password'], $_POST['email'], $_POST['name']);
        auth::verify($_POST['username'], $_POST['password']);
        header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'login');
     }
}

class user {
    function get($slug) {
        /**
         * This is the user profile page
         */
        echo 'Woo! Hi, '. $slug;
    }
}

class verify_login {
    function post() {
        auth::verify($_POST['username'], $_POST['password']);
    }
}
