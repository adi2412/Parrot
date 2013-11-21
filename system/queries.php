<?php

/**
 * Get site title
 */
function meta_title() {
	return FORUM_NAME;
}

/**
 * Get site description
 */
function meta_description() {
	return FORUM_DESCRIPTION;
}

/**
 * Get stylesheet
 */
function meta_stylesheet() {
	return BASE . 'themes' . DS . 'default' . DS . 'style.css';
}

/**
 * Get header
 */
function meta_header() {
	require(PATH . 'themes' . DS . 'default' . DS . 'header' . EXT);
}

/**
 * Get footer
 */
function meta_footer() {
	require(PATH . 'themes' . DS . 'default' . DS . 'footer' . EXT);
}

/**
 * Get the site's URL
 */
function meta_URL() {
	return 'http://' . getenv(DOMAIN_NAME) . BASE;
}

/**
 * Get the session log in/out link
 */
function session_link() {
	return BASE . 'login';
}

/**
 * Get the log in / out text
 */
function session_text() {
	if (auth::isLoggedIn()) {
		return 'Log Out';
	} else {
		return 'Log in';
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
		$discuss_array['title'] = $row['title'];
	    $discuss_array['content'] = $row['content'];
	    $discuss_array['author'] = $row['author'];
	    $discuss_array['time'] = $row['time'];
	    $discuss_array['replies'] = $row['replies'];
	}
	return $discuss_array;
}

/**
 * Get link to discussions
 */
function get_discussionLink($title) {
	return BASE . 'discussion' . DS . discussion::encode_title($title);
}

/**
 * Show the discussion menu
 */
function discussion_menu($title) {
	$title = discussion::decode_title($title);
	$query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Discussion` WHERE `title`='$title'");
	$rows = $query->fetchAll();
	$owner;
	foreach ($rows as $row) { $owner = $row['author']; }
	// display these if it's the owner of the article
	if ($owner == auth::getCurrentUser()) {
		echo '<a href="' . delete_link($title) . '"><button class="red">Delete</button></a>';
	} else {
		// don't display delete, because they're not the owner
	}
}

/**
 * Get's the link to delete a discussion
 */
function delete_link($title) {
	return BASE . 'discussion' . DS . discussion::encode_title($title) . DS . 'delete';
}

/**
 * Create new discussion link
 */
function get_createlink() {
	return BASE . 'discussion' . DS . 'create';
}

/**
 * Create new discussion backend link
 */
function get_submitLink() {
	return BASE . 'discussion' . DS . 'submit';
}

/**
 * Create get the reply form
 */
function reply_form($title, $btnText = 'Reply') {
	if (auth::isLoggedIn()) {
		echo '
		<form name="input" action="' . BASE . 'discussion' . DS . discussion::encode_title($title) . DS . 'reply' . '" method="post">
			<textarea rows="18" placeholder="Your thoughts..." name="content" class="boxsizingBorder"></textarea><br/>
			<input type="submit" class="submit small" value="' . $btnText .'"/>
		</form>
		';
	} else {
		echo '<a href="http://' . getenv(DOMAIN_NAME) . BASE . 'login' . '">Please log in to reply</a>';
	}
}

function get_replies($title) {
	if (is_array(discussion::get_replies($title))) {
		return discussion::get_replies($title);
	} else {
		return array();
	}
}

?>