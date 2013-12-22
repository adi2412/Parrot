<?php

/**
 * Get header
 */
function get_header() {
    require(PATH . "themes" . DS . Parrot::getInstance()->config()->getConfig("forum/theme") . DS . "header.php");
}

/**
 * Get footer
 */
function get_footer() {
    require(PATH . "themes" . DS . Parrot::getInstance()->config()->getConfig("forum/theme") . DS . "footer.php");
}
