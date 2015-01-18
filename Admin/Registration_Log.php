<?php
/*
 * Admin/Registration_Log.php
 * LHS Math Club Website
 *
 * Lists account registrations by IP
 */


$path_to_root = '../';
require_once '../lib/functions.php';
restrict_access('A');


if (isSet($_GET['IP']))
	show_detail_page();
else
	show_main_page();





function show_main_page() {
	page_title('Registration Log');
	
	// Top banned registrations
	echo <<<HEREDOC
      <h1>Registration Log</h1>
      
      <span class="b">Banned Users by Registration IP</span>
      <table class="visible">
        <tr>
          <th>IP Address</th>
          <th>Percent Banned</th>
          <th>Total</th>
        </tr>

HEREDOC;
	
	$query = 'SELECT registration_ip, ROUND(COUNT(NULLIF(0,approved=-1)) / COUNT(*) * 100, 0) AS banned_percent, '
		. 'COUNT(*) AS total '
		. 'FROM users '
		. 'GROUP BY registration_ip ORDER BY banned_percent DESC, total DESC';
		// ^-- biglong SQL to get the highest percent-banned IPs
	$result = DB::queryRaw($query);
	
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		if ($row['banned_percent'] == 0)
			break;
		echo <<<HEREDOC
        <tr>
          <td><a href="Registration_Log?IP={$row['registration_ip']}">{$row['registration_ip']}</a></td>
          <td>{$row['banned_percent']}%</td>
          <td>{$row['total']}</td>
        </tr>

HEREDOC;
		$row = mysqli_fetch_assoc($result);
	}
	echo "      </table>\n";
}





function show_detail_page() {
	page_title('Registration Log');
	
	$ip = htmlentities($_GET['IP']);
	
	echo <<<HEREDOC
      <h1>Registration Log</h1>
      
      <a href="Registration_Log" class="small">&lt; Back to Full List</a><br /><br />
      <span class="i">IP addresses that are spamming the site can be banned by editing /lib/CONFIG.php</span><br /><br />
      <span class="b">Accounts Created From $ip</span>
      <table class="visible">
        <tr>
          <th>Name</th>
          <th>Email Address</th>
          <th>YOG</th>
          <th>Account Creation</th>
          <th>Status</th>
        </tr>

HEREDOC;
	
	$query = 'SELECT name, email, yog, creation_date, DATE_FORMAT(creation_date, "%M %e, %Y") AS formatted_creation, approved FROM users WHERE registration_ip="'
		. mysqli_real_escape_string(DB::get(),$_GET['IP']) . '" ORDER BY creation_date DESC';
	$result = DB::queryRaw($query);
	
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$color = '#a00';
		$status = 'Banned';
		if ($row['approved'] == 0) {
			$color = '#000';
			$status = 'Pending';
		}
		else if ($row['approved'] == 1) {
			$color = '#0a0';
			$status = 'Approved';
		}
		
		$email = trim_email($row['email']);
		
		echo <<<HEREDOC
        <tr>
          <td>{$row['name']}</td>
          <td>$email</td>
          <td>{$row['yog']}</td>
          <td>{$row['formatted_creation']}</td>
          <td style="color: $color">$status</td>
        </tr>

HEREDOC;
		$row = mysqli_fetch_assoc($result);
	}
	echo "      </table>\n";
}

?>