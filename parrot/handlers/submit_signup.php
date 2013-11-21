<?php

class submit_signup {
     function post() {
     	auth::createAccount($_POST['username'], $_POST['password'], $_POST['email'], $_POST['name']);
     }
}

?>