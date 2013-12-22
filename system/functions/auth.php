<?php

/**
 * Get the log in / out text
 */
function session_text()
{
    if (auth::isLoggedIn()) {
        return "Log Out";
    } else {
        return "Log in";
    }
}

/**
 * Checks if the given username is an admin
 */
function checkIfAdmin($username)
{
    if (auth::getUserNumRole($username) == 3) {
        return true;
    } else {
        return false;
    }
}
