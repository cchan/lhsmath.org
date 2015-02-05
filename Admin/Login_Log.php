<?php
/*
 * Admin/Login_Log.php
 * LHS Math Club Website
 *
 * Lists login attempts for the past week
 */


require_once '../lib/functions.php';
restrict_access('A');

page_title('Login Log');
	
// Trim the log - delete everything more than a week old
$query = 'DELETE FROM login_attempts WHERE request_time < (NOW() - INTERVAL 7 DAY)';
DB::query($query);
?>
<h1>Login Log</h1>

<span class="i right">
	To ban an IP address, edit /lib/CONFIG.php<br />
	Note that all data is for <span class="b">the past 7 days only</span>.
</span>

<br /><br /><br />
<span class="b">Top Login Failures for Existing Accounts by Email with 5 or More Attempts</span>
<?=make_table('visible',
	array('email'=>'Email Address','percent_success'=>'Success Rate','attempts'=>'Number of Attempts'),
	DB::query('SELECT email, ROUND((COUNT(NULLIF(0,successful)) / COUNT(*) * 100), 0) AS percent_success, COUNT(*) AS attempts'
	. ' FROM login_attempts'
	. ' WHERE email IN (SELECT email FROM users) OR email="lhsmath"'
	. ' GROUP BY email HAVING COUNT(*) >= 5 ORDER BY percent_success ASC, COUNT(*) DESC LIMIT 10')
	// ^-- biglong SQL to get the highest percent-login-failures, but only for accounts that exist (not when you type the email wrong)
)?>

<br /><br /><br />
<span class="b">Top Login Failures by IP with 10 or More Attempts</span>
<?=make_table('visible',
	array('remote_ip'=>'IP Address','percent_success'=>'Success Rate','attempts'=>'Number of Attempts'),
	DB::query('SELECT remote_ip, ROUND((COUNT(NULLIF(0,successful)) / COUNT(*) * 100), 0) AS percent_success, COUNT(*) AS attempts'
	. ' FROM login_attempts'
	. ' GROUP BY remote_ip HAVING COUNT(*) >= 10 ORDER BY percent_success ASC, COUNT(*) DESC LIMIT 10')
	// ^-- SQL to get the highest percent-login-failures for ALL accounts, by IP address
)?>

<br /><br /><br />
<span class="b">All Login Attempts</span><br />
<span class="i">Rows in italics have nonexistent email addresses.</span>
<span class="i">Red is successful, green is not.</span>
<style>
	.green{color:#0f0;}
	.red{color:#f00;}
</style>
<?=make_table('visible',
	array('formatted_request_date'=>'Date','formatted_request_time'=>'Time','email'=>'Email Address','remote_ip'=>'IP Address'),
	DB::query('SELECT DATE_FORMAT(request_time, "%a %b %e") AS formatted_request_date,'
		. ' DATE_FORMAT(request_time, "%r") AS formatted_request_time,'
		. ' request_time, LOWER(email) AS email, remote_ip, successful,'
		. ' email IN (SELECT email FROM users) OR email="lhsmath" AS email_exists'
		. ' FROM login_attempts ORDER BY request_time DESC'
	),
	// ^-- SQL to get the full list of login attempts AND to figure out if the email address attempted actually exists
	function($row){//Callback for each row's data --> assigning classes
		if(!$row['email_exists'])return 'i'; //italics if email doesn't exist
		else if($row['successful'])return 'green'; //green if successful login
		else return 'red'; //red if unsuccessful login
	}
)?>
