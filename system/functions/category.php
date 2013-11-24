<?php

/**
 * Constants
 */
$categories = null;
$category = null;
$categories_count = 0;
$categories_index = 0;

/**
 * Check if have categories to loop through
 */
function have_category() {
	global $categories_index, $discussion, $categories, $categories_count;

	$categories_count = count(get_categories());
	$categories = get_categories();

	if ($categories && $categories_index + 1 <= $categories_count) {
		$categories_index++;
		return true;
	} else {
		$categories_count = 0;
		return false;
	}
}

/**
 * LOOP
 * Updates the category object
 */
function thecategory() {
	global $categories_index, $category, $categories;
	$category = $categories[$categories_index - 1];
	return $category;
}

/**
 * Get all categories
 */
function get_categories() {
	$query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Category` ORDER BY `title`");
	$rows = $query->fetchAll();
	$category_array;
	for($i = 0; $i < count($rows); $i++) {
	    $category_array[$i]['title'] = $rows[$i]['title'];
	}
	return $category_array;
}

/**
 * LOOP
 * Get's the link to delete a category
 */
function cat_delete_link() {
	return BASE . 'admin' . DS . 'category' . DS . cat_title() . DS . 'delete';
}

/**
 * Get's the link to delete a category
 */
function cat_create_link() {
	return BASE . 'admin' . DS . 'category' . DS . 'create';
}

/**
 * LOOP
 * Gets category title
 */
function cat_title() {
	global $category;
	return $category['title'];
}

?>