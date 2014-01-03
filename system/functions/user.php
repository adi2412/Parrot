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
 * Check if the user exists
 */
function user_exist($username)
{
    global $users_index, $user, $users, $user_title;
    while(have_user())
        theuser();
    if(user_username() == $username)
        return true;
    else
        theuser();
    return false;
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
function user_delete_link()
{
    return Parrot::getInstance()->getUrl("admin/user/" . discussion::encode_title(user_username()) . "/delete");
}

/**
 * Get's the link to promote a user
 */
function user_promote_link()
{
    return Parrot::getInstance()->getUrl("admin/user/" . discussion::encode_title(user_username()) . "/promote");
}

/**
 * Get's the link to demote a user
 */
function user_demote_link()
{
    return Parrot::getInstance()->getUrl("admin/user/" . discussion::encode_title(user_username()) . "/demote");
}

/**
 * Gets all users
 */
function get_users()
{
    $database = Parrot::getInstance()->database();
    $query = "SELECT * FROM " . $database->getTableName("Users") . " ORDER BY `username`";
    $statement = $database->newStatement($query);
    $statement->execute();
    $rows = $statement->fetchAll();
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
