<?php

class delete_discussion {
    function get($slug) {
        require_once(SYS . 'admin' . EXT);
        discussion::delete($slug);
    }
}

?>