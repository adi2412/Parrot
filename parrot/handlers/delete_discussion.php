<?php

class delete_discussion {
    function get($slug) {
    	//require_once(SYS . 'queries' . EXT);
        require_once(SYS . 'admin' . EXT);
        // the library auto-detects which user made the post ;)
        discussion::delete($slug);
    }
}

?>