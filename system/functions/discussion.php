<?php

/**
 * Constants
 */
$discussions = null;
$discussion = null;
$discussions_count = 0;
$discussions_index = 0;

$replies = null;
$reply = null;
$replies_count = 0;
$replies_index = 0;

/**
 * Check if have discussions to loop through
 */
function have_discussion() {
	global $discussions_index, $discussion, $discussions, $discussions_count, $discussion_title;

	// check if single discussion page
	if (!$discussion_title) {
		$discussions_count = count(discussion::get_discussions());
		$discussions = discussion::get_discussions();
	} else {
		$discussions_count = 1;
		$discussions = discussion::get_discussion($discussion_title);
	}

	if ($discussions && $discussions_index + 1 <= $discussions_count) {
		$discussions_index++;
		return true;
	} else {
		$discussions_count = 0;
		return false;
	}
}

/**
 * LOOP
 * Updates the discussion object
 */
function thediscussion() {
	global $discussions_index, $discussion, $discussions, $discussion_title;
	$discussion = $discussions[$discussions_index - 1];
	return $discussion;
}

/**
 * Show the discussion menu
 */
function discussion_menu($title) {
	$title = discussion::decode_title($title);
	$query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Discussion` WHERE `title`='$title'");
	$rows = $query->fetchAll();
	$owner;
	$locked;
	foreach ($rows as $row) { $owner = $row['author']; $locked = $row['locked']; }
	// display these if it's the owner of the article
	if ($owner == auth::getCurrentUser() || auth::isAdmin() || auth::isMod()) {
		echo '<a class="clear" href="' . delete_link($title) . '"><button class="red">Delete</button></a>';
		if ($locked == 'false') {
			echo '<a class="clear" href="' . edit_link($title) . '"><button>Edit</button></a>';
		}
		if (auth::isAdmin() || auth::isMod()) {
			echo '<a class="clear" href="' . stick_link($title) . '"><button>Toggle Stick</button></a>';
			echo '<a class="clear" href="' . lock_link($title) . '"><button>Toggle Lock</button></a>';
		}
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
 * Get's the link to edit a discussion
 */
function edit_link($title) {
	return BASE . 'discussion' . DS . discussion::encode_title($title) . DS . 'edit';
}

/**
 * Get's the link to toggle the sticky of a discussion
 */
function stick_link($title) {
	return BASE . 'discussion' . DS . discussion::encode_title($title) . DS . 'stick';
}

/**
 * Get's the link to toggle the lock of a discussion
 */
function lock_link($title) {
	return BASE . 'discussion' . DS . discussion::encode_title($title) . DS . 'lock';
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
 * Edit a discussion
 */
function get_editLink() {
	return BASE . 'discussion' . DS . 'edit';
}

/**
 * LOOP
 * Create get the reply form
 */
function reply_form($btnText = 'Reply', $errorMsg = 'Please log in to reply') {
	global $discussion_title;
	global $discussion;
	if ($discussion['locked'] == 'false') {
		if (auth::isLoggedIn()) {
			echo '
			<form name="input" action="' . BASE . 'discussion' . DS . discussion::encode_title($discussion_title) . DS . 'reply' . '" method="post">
				<textarea rows="5" placeholder="Just type..." name="content" class="reply_textarea"></textarea><br/>
				<input type="submit" class="submit small" value="' . $btnText .'" class="reply_input"/>
			</form>
			';
		} else {
			echo '<a class="soft-text" href="http://' . getenv(DOMAIN_NAME) . BASE . 'login' . '">' . $errorMsg . '</a>';
		}
	} else {
		echo '<span class="soft-text">This discussion is locked</span>';
	}
}

/**
 * LOOP
 * Gets replies for a discussion
 */
function get_replies($title) {
	if (is_array(discussion::get_replies($title))) {
		return discussion::get_replies($title);
	} else {
		return array();
	}
}

/**
 * LOOP
 * Gets discussion title
 */
function the_title() {
	global $discussion;
	return $discussion['title'];
}

/**
 * LOOP
 * Gets discussion author
 */
function the_author() {
	global $discussion;
	return $discussion['author'];
}

/**
 * LOOP
 * Gets discussion category
 */
function the_category() {
	global $discussion;
	return $discussion['category'];
}

/**
 * LOOP
 * Gets discussion link
 */
function the_link() {
	global $discussion;
	return BASE . 'discussion' . DS . discussion::encode_title($discussion['title']);
}

/**
 * LOOP
 * Gets discussion posted time
 */
function the_time() {
	global $discussion;
	return $discussion['time'];
}

/**
 * LOOP
 * Gets if the discussion is locked
 */
function is_locked() {
	global $discussion;
	return $discussion['locked'];
}

/**
 * LOOP
 * Gets discussion content
 */
function the_content() {
	global $discussion;
	return Parsedown::instance()->parse($discussion['content']);
}

/**
 * LOOP
 * Check if have discussions to loop through
 */
function have_replies() {
	global $replies_index, $reply, $replies, $replies_count, $discussion_title;

	$replies_count = count(get_replies($discussion_title));
	$replies = get_replies($discussion_title);

	if ($replies && $replies_index + 1 <= $replies_count) {
		$replies_index++;
		return true;
	} else {
		$replies_count = 0;
		return false;
	}
}

/**
 * LOOP
 * Updates the reply object
 */
function thereply() {
	global $replies_index, $reply, $replies;

	$reply = $replies[$replies_index - 1];
	return $reply;
}

/**
 * LOOP
 * Gets the reply author
 */
function reply_author() {
	global $reply;
	return $reply['author'];
}

/**
 * LOOP
 * Gets the reply ID
 */
function reply_id() {
	global $reply;
	return $reply['id'];
}

/**
 * LOOP
 * Gets the reply posted time
 */
function reply_time() {
	global $reply;
	return $reply['time'];
}

/**
 * LOOP
 * Gets the reply content
 */
function reply_content() {
	global $reply;
	return Parsedown::instance()->parse($reply['content']);
}

/**
 * LOOP
 * Checks if discussion is sticky
 */
function is_sticky() {
	global $discussion;
	return $discussion['sticky'];
}

/**
 * LOOP
 * Gets number of replies to a discussion in text
 */
function get_reply_count_text($noneText = 'No Replies', $oneText = '1 Reply', $manyText = 'Replies') {
	$replies = discussion::get_replies(the_title());
	if (!$replies) {
		return $noneText;
	} else if (count($replies) == 1) {
		return $oneText;
	} else {
		return count($replies) . ' ' . $manyText;
	}
}

/**
 * LOOP
 * Gets number of replies to a discussion
 */
function get_reply_count() {
	$replies = discussion::get_replies(the_title());
	return count($replies);
}

/**
 * Gets the discussion title for edit pages
 */
function discussion_title() {
	global $discussion_title;
	return $discussion_title;
}

/**
 * Gets the discussion content for edit pages
 */
function discussion_content() {
	global $discussion_title;
	$content;
	$query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Discussion` WHERE `title`='$discussion_title'");
	$rows = $query->fetchAll();
	foreach ($rows as $row) { $content = $row['content']; }
	return $content;
}

/**
 * LOOP
 * Get's the link to delete a discussion
 */
function reply_deletelink() {
	return BASE . 'reply' . DS . reply_id() . DS . 'delete';
}

/**
 * LOOP
 * A button to delete the reply
 */
function reply_delete_button() {
	if (reply_author() == auth::getCurrentUser() && is_locked() == 'false' || auth::isAdmin() && is_locked() == 'false' || auth::isMod() && is_locked() == 'false') {
		echo '<a href="' . reply_deletelink() . '" class="reply_delete_link"><h3>Delete</h3></a>';
	}
}
