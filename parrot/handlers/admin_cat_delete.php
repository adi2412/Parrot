<?php

class admin_cat_delete {
    function get($slug) {
    	/**
    	 * This is the delete category page
    	 */
    	if (auth::isLoggedIn() && auth::isAdmin()) {
        	category::delete($slug);
            header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'admin');
        } else {
        	header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'login');
        }
    }
}

?>