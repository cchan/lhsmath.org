<?php
/*
 * Admin/Login_Log.php
 * LHS Math Club Website
 *
 * Lists login attempts for the past week
 */


$path_to_root = '../';
require_once '../lib/functions.php';
restrict_access('A');


show_page();





function show_page() {
	page_header('Login Log');
		
	// Trim the log - delete everything more than a week old
	$query = 'DELETE FROM login_attempts WHERE request_time < (NOW() - INTERVAL 7 DAY)';
	mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	
	
	// Login Failures by Email
	echo <<<HEREDOC
      <h1>Login Log</h1>
      
      <span class="i right">
        To ban an IP address, edit /lib/CONFIG.php<br />
        Note that all data is for the past 7 days only.
      </span>
      <br />
      <br />
      <br />
      <br />
      <span class="b">Top Login Failures for Existing Accounts by Email with 5 or More Attempts</span>
      <table class="visible">
        <tr>
          <th>Email Address</th>
          <th>Success Rate</th>
          <th>Number of Attempts</th>
        </tr>

HEREDOC;
	
	$query = 'SELECT email, ROUND((COUNT(NULLIF(0,successful)) / COUNT(*) * 100), 0) AS percent_success, COUNT(*)'
		. ' FROM login_attempts'
		. ' WHERE email IN (SELECT email FROM users) OR email="lhsmath"'
		. ' GROUP BY email HAVING COUNT(*) >= 5 ORDER BY percent_success ASC, COUNT(*) DESC LIMIT 10';
		// ^-- biglong SQL to get the highest percent-login-failures, but only for accounts that exist (not when you type the email wrong)
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	
	$row = mysql_fetch_assoc($result);
	while ($row) {
		echo <<<HEREDOC
        <tr>
          <td>{$row['email']}</td>
          <td>{$row['percent_success']}%</td>
          <td>{$row['COUNT(*)']}</td>
        </tr>

HEREDOC;
		$row = mysql_fetch_assoc($result);
	}
	
	
	
	// Login Failures by IP
	echo <<<HEREDOC
      </table>
      
      <br />
      <br />
      <br />
      <span class="b">Top Login Failures by IP with 10 or More Attempts</span>
      <table class="visible">
        <tr>
          <th>IP Address</th>
          <th>Success Rate</th>
          <th>Number of Attempts</th>
        </tr>
HEREDOC;

	$query = 'SELECT remote_ip, ROUND((COUNT(NULLIF(0,successful)) / COUNT(*) * 100), 0) AS percent_success, COUNT(*)'
		. ' FROM login_attempts'
		. ' GROUP BY remote_ip HAVING COUNT(*) >= 10 ORDER BY percent_success ASC, COUNT(*) DESC LIMIT 10';
		// ^-- SQL to get the highest percent-login-failures for ALL accounts, by IP address
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	
	$row = mysql_fetch_assoc($result);
	while ($row) {
		echo <<<HEREDOC
        <tr>
          <td>{$row['remote_ip']}</td>
          <td>{$row['percent_success']}%</td>
          <td>{$row['COUNT(*)']}</td>
        </tr>

HEREDOC;
		$row = mysql_fetch_assoc($result);
	}
	
	
	
	// Complete List
	echo <<<HEREDOC
      </table>
      
      <br />
      <br />
      <br />
      <span class="b">All Login Attempts</span><br />
      <span class="i">Email addresses in italics correspond to nonexistent accounts.</span>
      <table class="visible">
        <tr>
          <th>Date</th>
          <th>Time</th>
          <th>Email Address</th>
          <th>IP Address</th>
        </tr>
HEREDOC;
	
	$query = 'SELECT DATE_FORMAT(request_time, "%a %b %e") AS formatted_request_date,'
		. ' DATE_FORMAT(request_time, "%r") AS formatted_request_time,'
		. ' request_time, LOWER(email) AS email, remote_ip, successful,'
		. ' email IN (SELECT email FROM users) OR email="lhsmath" AS email_exists'
		. ' FROM login_attempts ORDER BY request_time DESC';
		// ^-- SQL to get the full list of login attempts AND to figure out if the email address attempted actually exists
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
		
	$row = mysql_fetch_assoc($result);
	while ($row) {
		$color = $row['successful'] ? '#0a0' : '#a00';	// color row green if successful, red if unsuccessful
		$italicize_email = $row['email_exists'] ? '' : ' class="i"';	// italicize email address if doesn't exist
		
		echo <<<HEREDOC
        <tr style="color: $color;">
          <td>{$row['formatted_request_date']}</td>
          <td>{$row['formatted_request_time']}</td>
          <td$italicize_email>{$row['email']}</td>
          <td>{$row['remote_ip']}</td>
        </tr>

HEREDOC;
		$row = mysql_fetch_assoc($result);
	}
	
	echo "      </table>\n";
	admin_page_footer('Login Log');
}

?>