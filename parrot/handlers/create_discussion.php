<?php

class create_discussion {
    function get() {
    	/**
    	 * This is the create discussion page
    	 */
        require(SYS . 'admin' . EXT);
        require(PATH . 'themes' . DS . 'default' . DS . 'create' . EXT);
    }
}

?>