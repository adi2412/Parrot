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

        //require(SYS . 'queries' . EXT);
        require(SYS . 'admin' . EXT);
        require(APP . 'views' . DS . 'login' . EXT);
    }
}

?>