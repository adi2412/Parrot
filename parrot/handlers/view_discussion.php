<?php

class view_discussion {
    function get($slug) {
    	/**
    	 * This is the indivigual discussion page
    	 */
        //require_once(SYS . 'queries' . EXT);
        global $discussion_title;
        $discussion_title = discussion::decode_title($slug);
        require_once(SYS . 'admin' . EXT);
        require_once(PATH . 'themes' . DS . 'default' . DS . 'discussion' . EXT);
    }
}

?>