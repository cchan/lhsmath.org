<?php
/*
 * Contests.php
 * LHS Math Club Website
 */

$path_to_root = '';
require_once 'lib/functions.php';
restrict_access('XRLA');


show_page();





function show_page() {
	global $use_rel_external_script;
	$use_rel_external_script = true;
	page_header('Contests');
	echo <<<HEREDOC
      <h1>Contests</h1>

HEREDOC;

	$text = file_get_contents('.content/Contests.txt');
	echo BBCode($text);
	
	if (user_access('A'))
		echo <<<HEREDOC

      <div class="sidetab"><a href="Admin/Edit_Page?Contests">(edit this page)</a></div>
HEREDOC;
	
	default_page_footer('Contests');
}

?>