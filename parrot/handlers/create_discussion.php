<?php

class create_discussion {
    function get() {
    	/**
    	 * This is the create discussion page
    	 */
        require(PATH . 'themes' . DS . siteinfo('theme') . DS . 'create' . EXT);
    }
}

?>