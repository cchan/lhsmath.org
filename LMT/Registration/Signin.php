<?php
/*
 * LMT/Registration/Signin.php
 * LHS Math Club Website
 */

require_once '../../.lib/lmt-functions.php';
lmt_reg_restrict_access('X');

process_login();





function process_login() {
	// Validate credentials
	$sid = DB::queryFirstField('SELECT school_id FROM schools WHERE school_id=%i AND access_code=%i LIMIT 1',$_GET['ID'],$_GET['Code']);
	if (!$sid)trigger_error('Incorrect login data', E_USER_ERROR);
	
	// ** CREDENTIALS ARE VALIDATED AT THIS POINT ** //
	lmt_set_login_data($sid);
	
	header('Location: Home');
}

?>