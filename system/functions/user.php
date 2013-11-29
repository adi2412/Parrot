<?php

/**
 * Constants
 */
$users = null;
$user = null;
$users_count = 0;
$users_index = 0;

/**
 * Check if have users to loop through
 */
function have_user() {
	global $users_index, $user, $users, $users_count, $user_title;

	// check if single user page
	if (!$user_title) {
		$users_count = count(get_users());
		$users = get_users();
	} else {
		$users_count = 1;
		$users = get_user($user_title);
	}

	if ($users && $users_index + 1 <= $users_count) {
		$users_index++;
		return true;
	} else {
		$users_count = 0;
		return false;
	}
}

/**
 * Updates the user object
 */
function theuser() {
	global $users_index, $user, $users, $user_title;
	$user = $users[$users_index - 1];
	return $user;
}

/**
 * Get's the link to delete a user
 */
function user_delete_link() {
	return discussion::encode_title(BASE . 'admin' . DS . 'user' . DS . user_username() . DS . 'delete');
}

/**
 * Get's the link to promote a user
 */
function user_promote_link() {
	return discussion::encode_title(BASE . 'admin' . DS . 'user' . DS . user_username() . DS . 'promote');
}

/**
 * Get's the link to demote a user
 */
function user_demote_link() {
	return discussion::encode_title(BASE . 'admin' . DS . 'user' . DS . user_username() . DS . 'demote');
}

/**
 * Gets all users
 */
function get_users() {
	$query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Users` ORDER BY `username`");
	$rows = $query->fetchAll();
	$user_array;
	for($i = 0; $i < count($rows); $i++) {
	    $user_array[$i]['username'] = $rows[$i]['username'];
	    $user_array[$i]['email'] = $rows[$i]['email'];
	}
	return $user_array;
}

/**
 * Gets user's username
 */
function user_username() {
	global $user;
	return $user['username'];
}

/**
 * Gets user's email
 */
function user_email() {
	global $user;
	return $user['email'];
}

?>