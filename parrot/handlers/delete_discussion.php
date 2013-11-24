<?php

class delete_discussion {
    function get($slug) {
        discussion::delete($slug);
    }
}

?>