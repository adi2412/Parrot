<?php

class discussion {
	/**
	 * Create a discussion
	 */
	public function submit($title, $content, $category) {
		// check if logged in again as a safety net
		// the first check is mainly just to redirect
		// pesky users
		$query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Discussion` WHERE `title`='$title'");
	    $rows = $query->fetchAll();
	    $checkTitle;
	    foreach ($rows as $row) {
	    	$checkTitle = $row['title'];
	    }
		if (auth::isLoggedIn()) {
			if ($checkTitle !== $title) {
				// strip the HTML tags... Markdown only
				$title = strip_tags($title);
				$content = strip_tags($content);
				$session = auth::getSession();
				$query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Users` WHERE `session`='$session'");
		    	$rows = $query->fetchAll();
		    	$username;
		    	foreach ($rows as $row) {
		    		$username = $row['username'];
		    	}
		    	$date = date('jS F, Y');
		    	$query = database::getInstance()->query("INSERT INTO `" . DB_PREFIX . "Discussion` (title, author, content, time, category) VALUES ('$title', '$username', '$content', '$date', '$category')");
				header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'discussion' . DS . str_replace(' ', '-', $title));
		    } else {
		    	global $messages;
		    	$messages = 'Please choose another title.';
		    	require(PATH . 'themes' . DS . siteinfo('theme') . DS . 'create' . EXT);
		    }
		} else {
			// the user should have already been re-directed to the login page by now
			global $messages;
		    $messages = 'Please login to post.';
		    require(PATH . 'themes' . DS . siteinfo('theme') . DS . 'create' . EXT);
		}
	}

	/**
	 * Get all discussions
 	 */
	function get_discussions() {
		$query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Discussion` ORDER BY `timestamp` DESC");
		$rows = $query->fetchAll();
		$discuss_array;
		for($i = 0; $i < count($rows); $i++) {
			$discuss_array[$i]['title'] = $rows[$i]['title'];
			$discuss_array[$i]['content'] = $rows[$i]['content'];
			$discuss_array[$i]['author'] = $rows[$i]['author'];
			$discuss_array[$i]['time'] = $rows[$i]['time'];
			$discuss_array[$i]['replies'] = $rows[$i]['replies'];
			$discuss_array[$i]['category'] = $rows[$i]['category'];
		}
		return $discuss_array;
	}

	/**
	 * Get indivigual discussion details
	 */
	function get_discussion($title) {
		$decodedtitle = discussion::decode_title($title);
		$query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Discussion` WHERE `title`='$decodedtitle'");
		$rows = $query->fetchAll();
		$discuss_array;
		foreach ($rows as $row) {
			$discuss_array[0]['title'] = $row['title'];
			$discuss_array[0]['content'] = $row['content'];
			$discuss_array[0]['author'] = $row['author'];
			$discuss_array[0]['time'] = $row['time'];
			$discuss_array[0]['replies'] = $row['replies'];
			$discuss_array[0]['category'] = $row['category'];
		}
		return $discuss_array;
	}

	/**
	 * Reply to a discussion
	 */
	public function reply($content, $discussionTitle) {
		if (auth::isLoggedIn()) {
			$content = strip_tags($content);
			$session = auth::getSession();
	    	$author = auth::getCurrentUser();
	    	$time = date('jS F, Y');
	    	$query = database::getInstance()->query("INSERT INTO `" . DB_PREFIX . "Replies` (discussionTitle, content, author, time, approved, timestamp) VALUES ('$discussionTitle', '$content', '$author', '$time', 'true', NULL)");
		} else {
			// no user logged in
		}
	}

	/**
	 * Gets the replies for a discussion
	 */
	public function get_replies($title) {
		$query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Replies` WHERE `discussionTitle`='$title'");
	    $rows = $query->fetchAll();
	    $replies;
	    for ($i = 0; $i < count($rows); $i++) {
	    	$replies[$i]['content'] = $rows[$i]['content'];
	    	$replies[$i]['author'] = $rows[$i]['author'];
	    	$replies[$i]['time'] = $rows[$i]['time'];
	    }
	   	return $replies;
	}

	/**
	 * Delete a discussion
	 */
	public function delete($title) {
		// check if logged in again as a safety net
		// the first check is mainly just to redirect
		// pesky users
		$title = discussion::decode_title($title);
		$query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Discussion` WHERE `title`='$title'");
		$rows = $query->fetchAll();
		$author;
		foreach ($rows as $row) { $author = $row['author']; }

		$currentUser = auth::getCurrentUser();

	    if ($author == $currentUser || auth::isAdmin() || auth::isMod()) {
	    	$query = database::getInstance()->query("DELETE FROM `" . DB_PREFIX . "Discussion` WHERE `title`='$title'");
	    	$query->execute();
	    	$query = database::getInstance()->query("DELETE FROM `" . DB_PREFIX . "Replies` WHERE `discussionTitle`='$title'");
	    	header('Location: http://' . getenv(DOMAIN_NAME) . BASE);
		} else {
			// not the same person
		}
	}

	/**
	 * Encodes a title for URL
	 */
	public function encode_title($title) {
		return str_replace(' ', '-', $title);
	}

	/**
	 * Decodes a title for URL
	 */
	public function decode_title($title) {
		return str_replace('-', ' ', $title);
	}
}

?>