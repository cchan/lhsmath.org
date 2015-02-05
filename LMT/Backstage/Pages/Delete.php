<?php
/*
 * LMT/Backstage/Pages/Delete.php
 * LHS Math Club Website
 *
 * ID: the ID of the page to delete
 */

$path_to_lmt_root = '../../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';

if (isSet($_POST['lmt_do_delete_page']))
	do_delete_page();
else
	show_page();





function show_page() {
	$row = DB::queryFirstRow('SELECT * FROM pages WHERE page_id="'
		. mysqli_real_escape_string(DB::get(),$_GET['ID']) . '"');
	
	$name = htmlentities($row['name']);
	$content = "      " . str_replace("\n", "\n      ", $row['content']);
	
	lmt_page_header('Delete Page');
	echo <<<HEREDOC
      <h1>Delete Page</h1>
      
      <span class="b">Are you sure that you want to delete this page?</span>
      <div class="halfbreak"></div>
      <form method="post" action="{$_SERVER['REQUEST_URI']}"><div>
        <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
        <input type="submit" name="lmt_do_delete_page" value="Delete" />
        &nbsp;&nbsp;<a href="List">Cancel</a>
      </div></form>
      
      <br /><hr />
      

HEREDOC;

	echo $content;
}





function do_delete_page() {
	if ((int)$_GET['ID'] == -1)
		trigger_error('Cannot delete Registration page', E_USER_ERROR);
	
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$row = DB::queryFirstRow('SELECT name FROM pages WHERE page_id="'
		. mysqli_real_escape_string(DB::get(),$_GET['ID']) . '"');
	$page_name = htmlentities($row['name']);
	
	DB::queryRaw('DELETE FROM pages WHERE page_id="'
		. mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1');
	
	alert('The page &quot;' . $page_name . '&quot; has been deleted', 1);
	header('Location: List');
}

?>