<?php

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

?>