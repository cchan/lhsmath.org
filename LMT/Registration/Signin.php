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
	
	$sid = DB::queryFirstField('SELECT school_id FROM schools WHERE school_id=%i AND access_code=%i LIMIT 1',$school_id,$_GET['Code'])
	if (!$sid)trigger_error('Incorrect login data', E_USER_ERROR);
	
	// ** CREDENTIALS ARE VALIDATED AT THIS POINT ** //
	lmt_set_login_data($sid);
	
	header('Location: Home');
}

?>