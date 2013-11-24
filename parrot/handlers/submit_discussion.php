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
            	discussion::submit($title, $content);
            } else {
                // make it alpha-numeric, asshole
            }
		} else {
			// they better log in, or else
		}
    }
}

?>