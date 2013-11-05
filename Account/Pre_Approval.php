<?php
/*
 * Account/Pre_Approval.php
 * LHS Math Club Website
 *
 * Members who recieve an invitation with a pre-approved email
 * address link here. The approval is validated and saved to the
 * session.
 */

$path_to_root = '../';
require_once '../lib/functions.php';
restrict_access('X'); // only for logged-out users


validate_approval();





function validate_approval() {
	$email = strtolower($_GET['email']);
	$approval = $_GET['approval'];
	
	// Checks if the code was issued either this month or last
	global $SECRET_SALT;
	$correct_code_1 = sha1(hash_pass($email, $SECRET_SALT) . 'KJincsaio09j87po8h6CAlo8tesojesai' . date('YF'));
	
	$last_month = time() - (60 * 60 * 24 * ((int)date('j') + 1));
	$correct_code_2 = sha1(hash_pass($email, $SECRET_SALT) . 'KJincsaio09j87po8h6CAlo8tesojesai' . date('YF', $last_month));
	
	if ($approval === $correct_code_1 || $approval === $correct_code_2) {
		$_SESSION['PREAPPROVED'] = $email;
		$_SESSION['PREAPPROVED_expiry'] = time() + 54000;	// expires in 15 minutes
		header('Location: Register');
		die;
	}
	
	header('Location: ../Error');
	die;
}