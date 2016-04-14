<?php
/*
 * LMT/Backstage/Pages/Add_Separator.php
 * LHS Math Club Website
 *
 * xsrf_token
 *
 * Adds a separator to the end of the page list
 */

require_once '../../../.lib/lmt-functions.php';
restrict_access('A');

do_add_separator();





function do_add_separator() {
	if ($_GET['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$row = DB::queryFirstRow('SELECT MIN(order_num - 1) AS new_order FROM pages');
	$new_order = $row['new_order'];
	
	DB::queryRaw('INSERT INTO pages (name, content, order_num) VALUES ("", "", "'
		. mysqli_real_escape_string(DB::get(),$new_order) . '")');
	
	header('Location: List');
}

?>