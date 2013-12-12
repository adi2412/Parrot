<?php

/**
 * Get header
 */
function get_header() {
    require(PATH . "themes" . DS . siteinfo("theme") . DS . "header.php");
}

/**
 * Get footer
 */
function get_footer() {
    require(PATH . "themes" . DS . siteinfo("theme") . DS . "footer.php");
}
