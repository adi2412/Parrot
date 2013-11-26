<?php

class admin_user_demote {
    function get($slug) {
    	/**
    	 * This is the demote user page
    	 */
    	if (auth::isLoggedIn() && auth::isAdmin()) {
        	auth::demoteAccount($slug);
        } else {
        	header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'login');
        }
    }
}

?>