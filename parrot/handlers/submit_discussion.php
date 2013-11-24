<?php

class submit_discussion {
    function post() {
    	/**
    	 * This is the submit discussion function
    	 */
		if (auth::isLoggedIn()) {
            if (preg_match("/^[A-Za-z0-9-_\s]+$/", $_POST['title'])) {
            	$title = $_POST['title'];
            	$content = $_POST['content'];
            	// the library auto-detects which user made the post ;)
            	discussion::submit($title, $content);
                header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'discussion' . DS . str_replace(' ', '-', $title));
            } else {
                // make it alpha-numeric, asshole
            }
		} else {
			// they better log in, or else
		}
    }
}

?>