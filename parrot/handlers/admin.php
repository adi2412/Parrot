<?php

class admin {
    function get() {
    	/**
    	 * This is the admin page
    	 */
    	if (auth::isLoggedIn() && auth::isAdmin()) {
        	require(APP . 'views' . DS . 'admin' . DS . 'index' . EXT);
        } else {
        	header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'login');
        }
    }
}

?>