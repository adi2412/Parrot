<?php

class admin_user_delete {
    function get($slug) {
    	/**
    	 * This is the delete user page
    	 */
    	if (auth::isLoggedIn() && auth::isAdmin()) {
        	auth::deleteAccount($slug);
        } else {
        	header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'login');
        }
    }
}

?>