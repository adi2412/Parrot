<?php

class verify_login {
     function post() {
     	auth::verify($_POST['username'], $_POST['password']);
     }
}

?>