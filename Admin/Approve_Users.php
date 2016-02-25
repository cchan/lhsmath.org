<?php
/*
 * Admin/Approve_Users.php
 * LHS Math Club Website
 *
 * Allows Admins to approve users
 */


require_once '../.lib/functions.php';
restrict_access('A');


if (isSet($_POST['do_approve_user']))
	process_form();
else
	show_page('', '');





function show_page($err, $msg) {
	global $body_onload;
	$body_onload = 'document.forms[\'approve\'].id.focus()';
	
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	if ($msg != '')
		$msg = "\n        <div class=\"alert\">$msg</div><br />\n";
	
	page_header('Approve Users');
	echo <<<HEREDOC
      <h1>Approve Users</h1>
      
      <div class="instruction">
        Before users can access this site, they must be
        approved by an Admin. They will be prompted to print out a sheet
        and bring it to the Captains. To activate a user's account, locate
        his or her ID on that sheet and enter it below.<br />
      </div><br />
      
      $err$msg
      <form id="approve" method="post" action="{$_SERVER['REQUEST_URI']}">
        <table>
          <tr>
            <td>User ID:&nbsp;</td>
            <td><input type="text" name="id" size="5"/></td>
          </tr><tr>
            <td></td>
            <td>
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
              <input type="submit" name="do_approve_user" value="Approve"/>
            </td>
          </tr>
        </table>
      </form>
HEREDOC;
	
	if (isSet($_SESSION['approved_list'])) {
		echo <<<HEREDOC

      <br /><br />
      <h4 class="smbottom">Recently Approved Users</h4><div class="halfbreak"></div>
      <div class="indented">
HEREDOC;
		for ($i = 1; $i <= $_SESSION['approved_list_size']; $i++)
			echo "\n      " . $_SESSION['approved_list'][$i] . '<br />';
		echo "\n      </div>";
	}
}





function process_form() {
	// Check XSRF token
	if ($_SESSION['xsrf_token'] != $_POST['xsrf_token'])
		trigger_error('XSRF token invalid', E_USER_ERROR);
	
	$query = 'SELECT name, email, mailings, approved, email_verification FROM users WHERE id="' . mysqli_real_escape_string(DB::get(),$_POST['id']) . '"';
	$result = DB::queryRaw($query);
	
	if (mysqli_num_rows($result)!= 1) {
		show_page('User not found.', '');
		return;
	}
	
	$row = mysqli_fetch_assoc($result);
	
	if ($row['approved'] == '1') {
		show_page('User already approved.', '');
		return;
	}
	if ($row['email_verification'] != '1') {
		show_page('User\'s email not yet verified.', '');
		return;
	}
	$email_warning = "";
	if($row["mailings"] == '0') {
		$email_warning = " <b>Warning:</b> This user has mailings turned off.";
	}
	
	// ** OK To Proceed **
	
	$user_string = $row['name'] . ' (#' . htmlentities($_POST['id']) . ') &lt;' . $row['email'] . '&gt;';
	
	$query = 'UPDATE users SET approved="1" WHERE id="' . mysqli_real_escape_string(DB::get(),$_POST['id']) . '" LIMIT 1';
	DB::queryRaw($query);
	
	if (!isSet($_SESSION['approved_list'])) {
		$_SESSION['approved_list_size'] = 1;
		$_SESSION['approved_list'][1] = htmlentities($row['email']);
	}
	else {
		$_SESSION['approved_list_size']++;
		$_SESSION['approved_list'][$_SESSION['approved_list_size']] = htmlentities($row['email']);
	}
	
	show_page('', 'Approved: ' . $user_string . $email_warning);
}

?>