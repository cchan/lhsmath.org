<?php
/*
 * LMT/Backstage/Pages/Delete_Separator.php
 * LHS Math Club Website
 *
 * ID: the page ID of the separator
 * xsrf_token
 *
 * Deletes the given separator
 */

require_once '../../../.lib/lmt-functions.php';
restrict_access('A');

do_add_separator();





function do_add_separator() {
	if ($_GET['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	DB::queryRaw('DELETE FROM pages WHERE page_id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1');
	
	header('Location: List');
}

?>