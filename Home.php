<?php
/*
 * Home.php
 * LHS Math Club Website
 *
 * Displays the homepage. Admins can edit the content of the
 * homepage, which is stored in a separate file.
 */

$path_to_root = '';
require_once 'lib/functions.php';
restrict_access('XRLA');


show_page();





function show_page() {
	$welcome_msg = '';
	if (isSet($_SESSION['HOME_welcome'])) {
		$welcome_msg = "\n        <div class=\"alert\">{$_SESSION['HOME_welcome']}</div><br />\n";
		unset($_SESSION['HOME_welcome']);
	}
	$new_address_msg = '';
	if (isSet($_SESSION['HOME_newAddress'])) {
		$new_address_msg = "\n        <div class=\"alert\">{$_SESSION['HOME_newAddress']}</div><br />\n";
		unset($_SESSION['HOME_newAddress']);
	}
	
	global $use_rel_external_script;
	$use_rel_external_script = true;
	page_header('Home');
	echo <<<HEREDOC
      <h1>Home</h1>$welcome_msg$new_address_msg

HEREDOC;

	$text = file_get_contents('.content/Home.txt');
	echo BBCode($text);
	
	if (@user_access('A'))
		echo <<<HEREDOC

      <div class="sidetab"><a href="Admin/Edit_Page?Home">(edit this page)</a></div>
HEREDOC;
}

?>