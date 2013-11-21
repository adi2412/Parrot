<?php

class discussions {
    function get() {
    	/**
    	 * This is the home page
    	 */
        //$articles = get_articles();

        // TODO: Make the theme name an option
        require(SYS . 'queries' . EXT);
        require(PATH . 'themes' . DS . 'default' . DS . 'index' . EXT);
    }
}

?>