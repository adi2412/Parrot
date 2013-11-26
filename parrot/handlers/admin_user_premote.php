<?php

class admin_user_premote {
    function get($slug) {
    	/**
    	 * This is the premote user page
    	 */
    	if (auth::isLoggedIn() && auth::isAdmin()) {
        	auth::premoteAccount($slug);
        } else {
        	header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'login');
        }
    }
}

?>