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
                $category = $_POST['category'];
            	discussion::submit($title, $content, $category);
            } else {
                global $messages;
                $messages = 'Only include spaces, letters and numbers in the title.';
                require(PATH . 'themes' . DS . siteinfo('theme') . DS . 'create' . EXT);
            }
		} else {
			header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'login');
		}
    }
}

?>