<?php

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
		if ($author == auth::getCurrentUser()) {
        	require(PATH . 'themes' . DS . siteinfo('theme') . DS . 'edit' . EXT);
        } else {
        	header('Location: http://' . getenv(DOMAIN_NAME) . BASE);
        }
    }
}

?>