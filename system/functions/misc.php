<?php

/**
 * Gets misc site info
 */
function siteinfo($selector) {
	if ($selector == 'title') {
		$query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Meta`");
		$rows = $query->fetchAll();
		$title;
		foreach ($rows as $row) { $title = $row['title']; }
		return $title;
	}
	else if ($selector == 'description') {
		$query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Meta`");
		$rows = $query->fetchAll();
		$description;
		foreach ($rows as $row) { $description = $row['description']; }
		return $description;
	} else if ($selector == 'theme') {
		$query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Meta`");
		$rows = $query->fetchAll();
		$theme;
		foreach ($rows as $row) { $theme = $row['theme']; }
		return $theme;
	} else {
		return 'Unknown selector';
	}
}

/**
 * Get stylesheet
 */
function the_stylesheet() {
	return BASE . 'themes' . DS . siteinfo('theme') . DS . 'style.css';
}

/**
 * Get the site's URL
 */
function get_site_url() {
	return 'http://' . getenv(DOMAIN_NAME) . BASE;
}

/**
 * Get theme names
 */
function get_themes() {
	$dirs = array_filter(glob(PATH . 'themes' . DS . '*'), 'is_dir');
	$themes = array();
	for ($i = 0; $i < count($dirs); $i++) {
		$themes[$i]['title'] = basename($dirs[$i]);
		$theme_description;
		$json = json_decode(file_get_contents(PATH . 'themes' . DS . basename($dirs[$i]) . DS . 'about.json'));
		if (!($json->{'Description'})) { 
			$theme_description = '';
		} else { 
			$theme_description = ' - ' . $json->{'Description'}; 
		}
		$themes[$i]['description'] = $theme_description;
    }
	return $themes;
}

/**
 * Get info update link
 */
function info_update_link() {
	return BASE . 'admin' . DS . 'info' . DS . 'update';
}

/**
 * Gets current message in variable
 */
function msg_read() {
	global $messages;
	if ($messages !== null) {
		echo '<div class="msg">' . $messages . '</div>';
		$messages = null;
	}
}

?>