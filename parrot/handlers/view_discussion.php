<?php

class view_discussion {
    function get($slug) {
    	/**
    	 * This is the indivigual discussion page
    	 */
        global $discussion_title;
        $discussion_title = discussion::decode_title($slug);
        require_once(PATH . 'themes' . DS . siteinfo('theme') . DS . 'discussion' . EXT);
    }
}

?>