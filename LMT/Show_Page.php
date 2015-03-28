<?php
/*
 * LMT/Show_Page.php
 * LHS Math Club Website
 *
 * Name: the name of the page to show, with
 * underscores instead of spaces
 */
 
require_once '../lib/lmt-functions.php';

show_page();





function show_page() {
	$name = str_replace('_', ' ', $_GET['Name']);//Why?
	
	$content=DB::queryFirstField('SELECT content FROM pages WHERE name=%s',$name);
	if (!$content) {
		header("HTTP/1.1 404 Not Found");
		require 'Error.php';
		die;
	}
	
	$name = htmlentities($name);
	$content = "      " . str_replace("\n", "\n      ", $content);
	global $LMT_EMAIL;
	$content = str_replace('{CONTACT_LINK}', email_obfuscate($LMT_EMAIL, null, '<span class="b">Please email us at:</span> '), $content);
	
	global $use_rel_external_script;
	$use_rel_external_script = true;
	
	lmt_page_header($name);
	
	echo $content;
}

?>