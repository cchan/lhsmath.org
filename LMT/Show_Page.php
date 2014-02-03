<?php
/*
 * LMT/Show_Page.php
 * LHS Math Club Website
 *
 * Name: the name of the page to show, with
 * underscores instead of spaces
 */

$path_to_lmt_root = '';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';

show_page();





function show_page() {
	$name = str_replace('_', ' ', $_GET['Name']);//Why?
	
	global $lmt_database;
	$row=$lmt_database->query_assoc('SELECT * FROM pages WHERE name=%0%',array($name));
	if (!$row) {
		header("HTTP/1.1 404 Not Found");
		require 'Error.php';
		die;
	}
	
	$name = htmlentities($name);
	$content = "      " . str_replace("\n", "\n      ", $row['content']);
	global $LMT_EMAIL;
	$content = str_replace('{CONTACT_LINK}', email_obfuscate($LMT_EMAIL, null, '<span class="b">Please email us at:</span> '), $content);
	
	global $use_rel_external_script;
	$use_rel_external_script = true;
	
	lmt_page_header($name);
	
	echo $content;
	
	lmt_page_footer($name);
}

?>