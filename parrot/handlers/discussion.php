<?php

class discussions {
    function get() {
    	/**
    	 * This is the home page
    	 */
        // TODO: Make the theme name an option    
        require(PATH . 'themes' . DS . siteinfo('theme') . DS . 'index' . EXT);
    }
}

class create_discussion {
    function get() {
    	/**
    	 * This is the create discussion page
    	 */
        require(PATH . 'themes' . DS . siteinfo('theme') . DS . 'create' . EXT);
    }
}

class delete_discussion {
    function get($slug) {
        discussion::delete($slug);
    }
}

class edit_discussion {
    function get($slug) {
        /**
    	 * This is the edit discussion page
    	 */
        global $discussion_title;
        $discussion_title = discussion::decode_title($slug);
        $query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Discussion` WHERE `title`='$discussion_title'");
		$rows = $query->fetchAll();
		$author;
		foreach ($rows as $row) { $author = $row['author']; }
		if ($author == auth::getCurrentUser() || auth::isAdmin() || auth::isMod()) {
        	require(PATH . 'themes' . DS . siteinfo('theme') . DS . 'edit' . EXT);
        } else {
        	header('Location: http://' . getenv(DOMAIN_NAME) . BASE);
        }
    }
}

class edit_submit_discussion {
    function post() {
    	/**
    	 * This is the submit discussion function
    	 */
		if (auth::isLoggedIn()) {
            if (preg_match("/^[A-Za-z0-9-_\s]+$/", $_POST['title'])) {
            	$title = $_POST['title'];
                $content = $_POST['content'];
            	discussion::edit($title, $content);
            } else {
                global $messages;
                $messages = 'Only include spaces, letters and numbers in the title';
                require(PATH . 'themes' . DS . siteinfo('theme') . DS . 'index' . EXT);
            }
		} else {
			header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'login');
		}
    }
}

class reply_discussion {
    function post($slug) {
        $content = $_POST['content'];
        discussion::reply($content, discussion::decode_title($slug));
        header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'discussion' . DS . $slug);
    }
}

class stick_discussion {
    function get($slug) {
        discussion::stick($slug);
    }
}

class lock_discussion {
    function get($slug) {
        discussion::lock($slug);
    }
}

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
                $messages = 'Only include spaces, letters and numbers in the title';
                require(PATH . 'themes' . DS . siteinfo('theme') . DS . 'create' . EXT);
            }
		} else {
			header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'login');
		}
    }
}

class view_discussion {
    function get($slug) {
    	/**
    	 * This is the indivigual discussion page
    	 */
        global $discussion_title;
        $discussion_title = discussion::decode_title($slug);
        require_once(PATH . 'themes' . DS . siteinfo('theme') . DS . 'discussion' . EXT);
    }
}

class reply_delete {
    function get($slug) {
        /**
         * This is the delete reply page
         */
        discussion::delete_reply($slug);
    }
}

?>