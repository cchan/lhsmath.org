<?php
/*
 * LMT/Backstage/Pages/Order.php
 * LHS Math Club Website
 *
 * Up: move up
 * Down: move down
 *
 * ID: the ID of the page to edit
 * xsrf_token
 */

$path_to_lmt_root = '../../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
restrict_access('A');

do_move();





function do_move() {
	if ($_GET['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	if (isSet($_GET['Up'])) {
		$operator = ' < ';
		$sql_order = 'DESC';
		$modifier = -1;
	}
	else if (isSet($_GET['Down'])) {
		$operator = ' > ';
		$sql_order = 'ASC';
		$modifier = 1;
	}
	else
		trigger_error('Neither Up nor Down specified', E_USER_ERROR);
	
	$row = lmt_query('SELECT order_num FROM pages WHERE page_id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '"', true);
	$order = $row['order_num'];
	
	$row = lmt_query('SELECT page_id, order_num FROM pages WHERE order_num' . $operator
		. $order . ' ORDER BY order_num ' . $sql_order . ' LIMIT 1', true);
	$other_id = $row['page_id'];
	$new_order = (int)$order + $modifier;
	
	lmt_query('UPDATE pages SET order_num="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$new_order) . '" WHERE page_id="'
		. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '" LIMIT 1');
	lmt_query('UPDATE pages SET order_num="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$order) . '" WHERE page_id="'
		. mysqli_real_escape_string($GLOBALS['LMT_DB'],$other_id) . '" LIMIT 1');
	
	header('Location: List');
}

?>