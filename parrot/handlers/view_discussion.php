<?php

class view_discussion {
    function get($slug) {
    	/**
    	 * This is the indivigual discussion page
    	 */
        require_once(SYS . 'queries' . EXT);
        require_once(SYS . 'admin' . EXT);
        require_once APP . 'libraries' . DS . 'parsedown' . EXT;
        require_once(PATH . 'themes' . DS . 'default' . DS . 'discussion' . EXT);
    }
}

?>