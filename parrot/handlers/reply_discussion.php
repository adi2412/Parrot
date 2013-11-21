<?php

class reply_discussion {
    function post($slug) {
    	require_once(SYS . 'queries' . EXT);
        require_once(SYS . 'admin' . EXT);
        // the library auto-detects if the user is logged in
        $content = $_POST['content'];
        discussion::reply($content, discussion::decode_title($slug));
        header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'discussion' . DS . $slug);
    }
}

?>