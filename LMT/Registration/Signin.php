<?php
/*
 * LMT/Registration/Signin.php
 * LHS Math Club Website
 */

$path_to_lmt_root = '../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
lmt_reg_restrict_access('X');

process_login();





function process_login() {
	$school_id = htmlentities($_GET['ID']);
	// Validate credentials
	$result = lmt_query('SELECT school_id FROM schools WHERE school_id="'
		. mysql_real_escape_string($school_id)
		. '" AND access_code="'
		. mysql_real_escape_string($_GET['Code']) . '" LIMIT 1');
	if (mysql_num_rows($result) == 0)
		trigger_error('Incorrect login data', E_USER_ERROR);
	
	
	// ** CREDENTIALS ARE VALIDATED AT THIS POINT ** //
	$row = mysql_fetch_assoc($result);
	lmt_set_login_data($row['school_id']);
	
	header('Location: Home');
}

?>