<?php

class signup {
    function get() {
    	/**
    	 * This is the signup page
    	 */
        // TODO: Make the theme name an option
        require(APP . 'views' . DS . 'signup' . EXT);
    }
}

?>