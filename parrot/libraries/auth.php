<?php

class auth {
    /**
     * Checks if the request to login is valid
     */
	public function verify($username, $password) {
        require_once(APP . 'libraries' . DS . 'database' . EXT);
		$query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Users` WHERE `username`='$username' AND `password`='$password'");
    	$rows = $query->fetchAll();
        if (count($rows) == 1) {
            // OMG OMG OMG...
            // it's a real user... create a session for them and redirect
            // cookie expires on one hour
            $randString = auth::generateRandomString(15);
            setcookie('parrotSession', $randString, time()+3600, BASE);
            $query = database::getInstance()->query("UPDATE `" . DB_PREFIX . "Users` SET `session`='$randString' WHERE `username`='$username'");
            $query->execute();
            header('Location: http://' . getenv(DOMAIN_NAME) . BASE);
        } else {
            /*
            $errorMsg = urlencode('Incorrect username or password.');
            header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'login' . '?error=' . $errorMsg);
            */
            header('Location: http://' . getenv(DOMAIN_NAME) . BASE . 'login');
        }
	}

    /**
     * Checks if the current user is logged in
     */
    public function isLoggedIn() {
        require_once(APP . 'libraries' . DS . 'database' . EXT);
        $cookie = $_COOKIE['parrotSession'];
        $query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Users` WHERE `session`='$cookie'");
        $rows = $query->fetchAll();
        $matches = false;
        foreach ($rows as $row) {
            $matches = true;
        }
        if (isset($_COOKIE['parrotSession']) && $matches == true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Creates an account
     */
    public function createAccount($username, $password, $email, $name) {
       require_once(APP . 'libraries' . DS . 'database' . EXT);
       if (!empty($username) && !empty($password) && !empty($email) && !empty($name)) {
            $query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Users` WHERE `username`='$username'");
            $rows = $query->fetchAll();
            if (count($rows) == 0) {
                // woo! username is not taken
                $query = database::getInstance()->query("INSERT INTO `" . DB_PREFIX . "Users` (session, username, password, name, email) VALUES (NULL, '$username', '$password', '$name', '$email')");
            } else {
                // username is already taken
            }
       } else {
            // they need to fill in all of the fields
       }
    }

    /**
     * Gets the session cookie
     */
    public function getSession() {
       return $_COOKIE['parrotSession'];
    }

    /**
     * Gets the username of the current user
     */
    public function getCurrentUser() {
        $cookie = $_COOKIE['parrotSession'];
        $query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Users` WHERE `session`='$cookie'");
        $rows = $query->fetchAll();
        foreach ($rows as $row) {
            return $row['username'];
        }
    }

    /**
     * Generates a random alpha-num string
     */
    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}

?>