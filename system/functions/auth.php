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

/**
 * Get stylesheet
 */
function admin_stylesheet() {
	return BASE . 'parrot' . DS . 'views' . DS . 'assets' . DS . 'css' . DS . 'style.css';
}

/**
 * Get login verify URL
 */
function login_verifyURL() {
	return BASE . 'login' . DS .'verify';
}

/**
 * Get login verify URL
 */
function signup_submitURL() {
	return BASE . 'signup' . DS .'submit';
}

/**
 * Get signup link
 */
function admin_signupLink() {
	return BASE . 'signup';
}

/**
 * Get login link
 */
function admin_loginLink() {
	return BASE . 'login';
}

/**
 * Checks if the given username is an admin
 */
function checkIfAdmin($username) {
    if (auth::getUserNumRole($username) == 3) {
        return true;
    } else {
        return false;
    }
}
