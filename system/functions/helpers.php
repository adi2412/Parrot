<?php

/**
 * Get header
 */
function get_header() {
	require(PATH . 'themes' . DS . 'default' . DS . 'header' . EXT);
}

/**
 * Get footer
 */
function get_footer() {
	require(PATH . 'themes' . DS . 'default' . DS . 'footer' . EXT);
}

?>