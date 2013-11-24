<?php

class submit_signup {
     function post() {
     	auth::createAccount($_POST['username'], $_POST['password'], $_POST['email'], $_POST['name']);
     	auth::verify($_POST['username'], $_POST['password']);
     	header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'login');
     }
}

?>