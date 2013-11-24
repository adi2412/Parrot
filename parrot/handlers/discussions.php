<?php

class discussions {
    function get() {
    	/**
    	 * This is the home page
    	 */
        // TODO: Make the theme name an option    
        require(PATH . 'themes' . DS . 'default' . DS . 'index' . EXT);
    }
}

?>