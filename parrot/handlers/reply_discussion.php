<?php

class reply_discussion {
    function post($slug) {
        $content = $_POST['content'];
        discussion::reply($content, discussion::decode_title($slug));
        header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'discussion' . DS . $slug);
    }
}

?>