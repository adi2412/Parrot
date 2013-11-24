<?php

/**
 * Get the session log in / out link
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

?>