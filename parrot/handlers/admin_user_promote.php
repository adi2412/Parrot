<?php

class admin_user_promote {
    function get($slug) {
    	/**
    	 * This is the premote user page
    	 */
    	if (auth::isLoggedIn() && auth::isAdmin()) {
        	auth::promoteAccount($slug);
        } else {
        	header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'login');
        }
    }
}

?>