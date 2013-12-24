<?php

function siteinfo($selector) {
    $database = Parrot::getInstance()->database();

    if ($selector == 'title') {
        $query = "SELECT * FROM " . $database->getTableName("Meta");
        $statement = $database->newStatement($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $title;
        foreach ($rows as $row) { $title = $row['title']; }
        return $title;
    } else if ($selector == 'description') {
        $query = "SELECT * FROM " . $database->getTableName("Meta");
        $statement = $database->newStatement($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $description;
        foreach ($rows as $row) { $description = $row['description']; }
        return $description;
    } else if ($selector == 'theme') {
        $query = "SELECT * FROM " . $database->getTableName("Meta");
        $statement = $database->newStatement($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $theme;
        foreach ($rows as $row) { $theme = $row['theme']; }
        return $theme;
    } else {
        return 'Unknown selector';
    }
}

/**
 * Get stylesheet
 */
function the_stylesheet($stylesheet = "style.css") {
    return get_theme_baseurl() . "/css/" . $stylesheet;
}

/**
 * Get javascript
 */
function the_javascript($javascript = "main.js") {
    return get_theme_baseurl() . "/js/" . $javascript;
}

function get_theme_baseurl() {
    return Parrot::getInstance()->getUrl("themes/" . siteinfo('theme'));
}

/**
 * Get theme directory
 * TODO: I don't think this function is necessary any longer. If it is, it should be altered to suit its name.
 * In its current state it won't even function properly because the BASE constant has been removed.
 */
function get_theme_directory() {
    return BASE . "themes" . DS . siteinfo('theme') . DS;
}

function get_link($link = '') {
    return Parrot::getInstance()->getUrl($link);
}

/**
 * Get theme names
 */
function get_themes() {
    $dirs = array_filter(glob(PATH . 'themes' . DS . '*'), 'is_dir');
    $themes = array();
    for ($i = 0; $i < count($dirs); $i++) {
        $themes[$i]['title'] = basename($dirs[$i]);
        $theme_description;
        $json = json_decode(file_get_contents(PATH . 'themes' . DS . basename($dirs[$i]) . DS . 'about.json'));
        $themes[$i]['description'] = $json->{'Description'};
        $themes[$i]['author'] = $json->{'Author'};
        $themes[$i]['version'] = $json->{'Version'};
    }
    return $themes;
}

/**
 * Gets current message in variable
 */
function msg_read() {
    global $messages;
    if ($messages !== null) {
        echo '<div class="msg">' . $messages . '</div>';
        $messages = null;
    }
}
