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
	
	global $lmt_database;
	
	if (!($result = $lmt_database->query_assoc('SELECT school_id FROM schools WHERE school_id=%0% AND access_code=%1% LIMIT 1',array($school_id,$_GET['Code']))))
		trigger_error('Incorrect login data', E_USER_ERROR);
	
	// ** CREDENTIALS ARE VALIDATED AT THIS POINT ** //
	lmt_set_login_data($result['school_id']);
	
	header('Location: Home');
}

?>