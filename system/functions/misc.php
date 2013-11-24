<?php

/**
 * Gets misc site info
 */
function siteinfo($selector) {
	if ($selector == 'title') {
		return FORUM_NAME;
	}
	else if ($selector == 'description') {
		return FORUM_DESCRIPTION;
	} else {
		return 'Unknown selector';
	}
}

/**
 * Get stylesheet
 */
function the_stylesheet() {
	return BASE . 'themes' . DS . 'default' . DS . 'style.css';
}

/**
 * Get the site's URL
 */
function get_site_url() {
	return 'http://' . getenv(DOMAIN_NAME) . BASE;
}

?>