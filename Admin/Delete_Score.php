<?php
/*
 * Admin/Delete_Score.php
 * LHS Math Club Website
 *
 * Deletes a user's test score
 */

$path_to_root = '';
require_once '../lib/functions.php';
restrict_access('A');


show_page();





function show_page() {
	// Check XSRF token
	if ($_SESSION['xsrf_token'] != $_GET['xsrf_token'])
		trigger_error('Archive: XSRF token invalid', E_USER_ERROR);
	
	// Check that test exists
	$query = 'SELECT user_id FROM test_scores WHERE score_id="' . mysql_real_escape_string($_GET['ID']) . '"';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	if (mysql_num_rows($result) != 1)
		trigger_error('Incorrect number of results found');
	$row = mysql_fetch_assoc($result);
	$user_id = $row['user_id'];
	
	$query = 'DELETE FROM test_scores WHERE score_id="' . mysql_real_escape_string($_GET['ID']) . '" LIMIT 1';
	mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	
	header('Location: View_User?ID=' . $user_id);
}

?>