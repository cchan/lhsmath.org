<?php
/*
 * Admin/Delete_Score.php
 * LHS Math Club Website
 *
 * Deletes a user's test score
 */

require_once '../lib/functions.php';
restrict_access('A');


show_page();





function show_page() {
	// Check XSRF token
	if ($_SESSION['xsrf_token'] != $_GET['xsrf_token'])
		trigger_error('Archive: XSRF token invalid', E_USER_ERROR);
	
	// Check that test exists
	$query = 'SELECT user_id FROM test_scores WHERE score_id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '"';
	$result = DB::queryRaw($query);
	if (mysqli_num_rows($result) != 1)
		trigger_error('Incorrect number of results found');
	$row = mysqli_fetch_assoc($result);
	$user_id = $row['user_id'];
	
	$query = 'DELETE FROM test_scores WHERE score_id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1';
	DB::queryRaw($query);
	
	header('Location: View_User?ID=' . $user_id);
}

?>