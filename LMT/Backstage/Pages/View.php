<?php
/*
 * LMT/Backstage/Pages/View.php
 * LHS Math Club Website
 *
 * ID: the ID of the page to show
 */

$path_to_lmt_root = '../../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
restrict_access('A');

show_page();





function show_page() {
	$row = DB::queryFirstRow('SELECT * FROM pages WHERE page_id="'
		. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '"');
	
	$name = htmlentities($row['name']);
	$content = "      " . str_replace("\n", "\n      ", $row['content']);
	
	if (strpos($content, '<h1>') != 6)
		$content = '<h1></h1><br /><br />' . $content;
	
	global $LMT_EMAIL;
	$content = str_replace('{CONTACT_LINK}', email_obfuscate($LMT_EMAIL, null, '<span class="b">Please email us at:</span> '), $content);
	
	$page_id = htmlentities($_GET['ID']);
	
	global $use_rel_external_script;
	$use_rel_external_script = true;
	
	lmt_page_header($name);
	echo <<<HEREDOC
	  <div style="float: left; margin-top: 40px;">
        <a href="List"><img src="../../../res/icons/arrow_left.png" alt="" /> Return to Page List</a>
        <div class="halfbreak"></div>
        <a href="Edit?ID=$page_id"><img src="../../../res/icons/edit.png" alt="" /></a>
        <a href="Delete?ID=$page_id"><img src="../../../res/icons/delete.png" alt="" /></a>
      </div>
      

HEREDOC;

	echo $content;
	
	lmt_backstage_footer('');
}

?>