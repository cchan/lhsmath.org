<?php
/*
 * Account/My_Profile.php
 * LHS Math Club Website
 *
 * Allows users to view and change their stored personal information
 */

require_once '../lib/functions.php';
restrict_access('RLA');


set_login_data($_SESSION['user_id']);	// visiting this page will cause your cached data to reload


if (isSet($_POST['do_change_email']))
	change_email();
else if (isSet($_POST['do_change_cell']))
	change_cell();
else if (isSet($_POST['do_change_password']))
	change_password();
else if (isSet($_GET['Email']))
	show_change_email_page('', 'email');
else if (isSet($_GET['Cell']))
	show_change_cell_page('', 'cell');
else if (isSet($_GET['Password']))
	show_change_password_page('');
else if (isSet($_GET['Mailings']))
	do_toggle_mailings();
else
	show_info_page();





function show_info_page() {
	page_header('My Profile');
	
	// Get Data
	$query = 'SELECT * FROM users WHERE id="' . $_SESSION['user_id'] . '" LIMIT 1';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	
	// format cell #
	$cell = format_phone_number($row['cell']);
	
	// turn Permissions into understandable English
	$account_type = 'Member';
	if ($row['permissions'] == 'A')
		$account_type = 'Non-Captain Admin';
	else if ($row['permissions'] == 'C')
		$account_type = 'Captain';
	else if ($row['permissions'] == 'L')
		$account_type = 'Alumnus';
	
	// mailing list status
	$mailings = 'No';
	if ($row['mailings'] == '1')
		$mailings = 'Yes';
	
	
	// Show the "Your cell phone number/password has been updated" message
	if (isSet($_SESSION['ACCOUNT_profile_change_message'])) {
		$msg = "\n      <div class=\"alert\">{$_SESSION['ACCOUNT_profile_change_message']}</div><br /><br />\n      ";
		unset($_SESSION['ACCOUNT_profile_change_message']);
	}
	
	
	
	// Send body of page
	echo <<<HEREDOC
      <h1>My Profile</h1>
      <table class="spacious">
        <tr>
          <td>User ID:</td>
          <td class="b"><span class="b">{$row['id']}</span></td>
        </tr><tr>
          <td>Name:</td>
          <td><span class="b">{$row['name']}</span></td>
        </tr><tr>
          <td>Email Address:</td>
          <td>
            <span class="b">{$row['email']}</span>
            &nbsp;<span class="small">(<a href="My_Profile?Email">change</a>)</span>
          </td>
        </tr><tr>
          <td>Cell Phone Number:</td>
          <td>
            <span class="b">$cell</span>
            &nbsp;<span class="small">(<a href="My_Profile?Cell">change</a>)</span>
          </td>
        </tr><tr>
          <td>Year of Graduation:</td>
          <td><span class="b">{$row['yog']}</span></td>
        </tr><tr>
          <td>Password:</td>
          <td>
            <span class="b">&#183;&#183;&#183;&#183;&#183;&#183;&#183;&#183;&#183;&#183;</span>
            &nbsp;<span class="small">(<a href="My_Profile?Password">change</a>)</span>
          </td>
        </tr><tr>
          <td>Receive Mailings:</td>
          <td><span class="b">$mailings</span>
          &nbsp;<span class="small">(<a href="My_Profile?Mailings&amp;xsrf_token={$_SESSION['xsrf_token']}">change</a>)</span></td>
        </tr><tr>
          <td>Account Type:</td>
          <td><span class="b">$account_type</span></td>
        </tr>
      </table>
      <br />
      <span class="i small">If you wish to change other information, please contact a Captain.</span>
HEREDOC;
}




function show_change_email_page($err, $selected_field) {
	// Put cursor in first field
	global $body_onload;
	$body_onload = 'document.forms[\'changeEmail\'].' . $selected_field . '.focus()';
	
	
	page_header('Change Email');
	
	
	// Get data
	$query = 'SELECT email FROM users WHERE id="' . $_SESSION['user_id'] . '" LIMIT 1';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	$old_email = $row['email'];
	
	// If an error message is given, put it inside this div and echo, later
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	// If there was an error, put the last thing the user typed back in the box
	global $email;
	
	// Assemble body of page
	echo <<<HEREDOC
      <h1>Change Email Address</h1>
      
      <div class="alert">Changing your email address will require you to re-verify the new address.
      You must log in with the new address.</div>
      <br />
      <br />$err
      <form id="changeEmail" method="post" action="{$_SERVER['REQUEST_URI']}">
        <table class="spacious">
          <tr>
            <td>Current Email Address:&nbsp;</td>
            <td><span class="b">$old_email</span></td>
          </tr><tr>
            <td>New Email Address:</td>
            <td><input type="text" name="email" size="25" maxlength="320" value="$email"/></td>
          </tr><tr>
            <td>Current Password:</td>
            <td><input type="password" name="pass" size="25"/></td>
          </tr><tr>
            <td></td>
            <td>
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
              <input type="submit" name="do_change_email" value="Change Email Address"/>
              &nbsp;&nbsp;<a href="My_Profile">Cancel</a>
            </td>
          </tr>
        </table>
      </form>
HEREDOC;
}





function change_email() {
	// Check XSRF token
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	
	// Get form data
	global $email;
	$email = htmlentities(strtolower($_POST['email']));
	
	// Get Data
	$query = 'SELECT name, email, passhash FROM users WHERE id="' . $_SESSION['user_id'] . '" LIMIT 1';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	
	$name = $row['name'];
	$old_email = strtolower($row['email']);
	$old_passhash = $row['passhash'];
	
	// CHECK PASSWORD
	if (hash_pass($old_email, $_POST['pass']) != $old_passhash) {
		show_change_email_page('Incorrect password', 'pass');
		return;
	}
	
	
	// Check that the email address is valid
	if (!preg_match('/^([\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*[\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]'
		.'+@((((([a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,6})|(\d{1,3}\.){3}\d{1,3}(\:\d{1,5})?)$/i'
		, $email)) {	// <- a really long regex to *properly* validate email addresses
					// from http://fightingforalostcause.net/misc/2006/compare-email-regex.php
					// credit to James Watts and Francisco Jose Martin Moreno
		show_change_email_page('That\'s not a valid email address', 'email');
		return;
	}
	
	// Check that an account with that email address doesn't already exist
	$sql_email = mysqli_real_escape_string(DB::get(),strtolower($email));
	$query = 'SELECT COUNT(*) FROM users WHERE LOWER(email)="' . $sql_email . '"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	if ($row['COUNT(*)'] != 0) {
		show_change_email_page('An account with that email address already exists', 'email');
		return;
	}
	
	// Change email address, re-hash password
	$passhash = hash_pass(mysqli_real_escape_string(DB::get(),strtolower($email)), $_POST['pass']);
	$verification_code = generate_code(5);  // for verifying ownership of the email address
	$query = 'UPDATE users SET email="' . mysqli_real_escape_string(DB::get(),$email)
		. '", passhash="' . mysqli_real_escape_string(DB::get(),$passhash)
		. '", email_verification="' . mysqli_real_escape_string(DB::get(),$verification_code)
		. '" WHERE id="' . $_SESSION['user_id'] . '" LIMIT 1';
	
	DB::queryRaw($query);
	
	
	// Send an email to the old address saying that someone changed the email
	global $WEBMASTER_EMAIL;
	$to = $name . ' <' . $old_email . '>';
	$subject = 'Change of Email Address';
	$body = <<<HEREDOC
Hi $name,

The email address for your account at the LHS Math Club website has been changed to {$email}
Your ID is {$_SESSION['user_id']}.
HEREDOC;
	send_email($to, $subject, $body, $WEBMASTER_EMAIL);
	
	// Must resend verification email...
	$_SESSION['ACCOUNT_do_send_verification_email'] = true;
	$_SESSION['permissions'] = 'E';
	header('Location: Verify_Email');
}





function show_change_cell_page($err, $selected_field) {
	// Put cursor in first field
	global $body_onload;
	$body_onload = 'document.forms[\'changeCell\'].' . $selected_field . '.focus()';
	
	
	page_header('Change Cell');
	
	
	// Get data
	$query = 'SELECT cell FROM users WHERE id="' . $_SESSION['user_id'] . '" LIMIT 1';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	$old_cell = format_phone_number($row['cell']);
	
	// If an error message is given, put it inside this div and echo, later
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	// If there was an error, put the last thing the user typed back in the box
	global $cell;
	
	// Assemble body of page
	echo <<<HEREDOC
      <h1>Change Cell Phone Number</h1>
      
      <span class="i">Optional. You may leave your cell phone number blank.</span><br />
      <br />
      <br />$err
      <form id="changeCell" method="post" action="{$_SERVER['REQUEST_URI']}">
        <table class="spacious">
          <tr>
            <td>Current Cell Phone Number:&nbsp;</td>
            <td><span class="b">$old_cell</span></td>
          </tr><tr>
            <td>New Cell Phone Number:</td>
            <td><input type="text" name="cell" size="25" value="$cell"/></td>
          </tr><tr>
            <td>Current Password:</td>
            <td><input type="password" name="pass" size="25"/></td>
          </tr><tr>
            <td></td>
            <td>
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
              <input type="submit" name="do_change_cell" value="Change Cell Phone Number"/>
              &nbsp;&nbsp;<a href="My_Profile">Cancel</a>
            </td>
          </tr>
        </table>
      </form>
HEREDOC;
}





function change_cell() {
	// Check XSRF token
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	
	// Get form data
	global $cell;
	$cell = htmlentities($_POST['cell']);
	
	// Get Data
	$query = 'SELECT name, email, cell, passhash FROM users WHERE id="' . $_SESSION['user_id'] . '" LIMIT 1';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	
	$name = $row['name'];
	$email = $row['email'];
	$old_cell = $row['cell'];
	$passhash = $row['passhash'];
	
	// CHECK PASSWORD
	if (hash_pass($email, $_POST['pass']) != $passhash) {
		show_change_cell_page('Incorrect password', 'pass');
		return;
	}
	
	if ($cell == '')	// because you can leave the cell # blank
		$cell = 'None';
	else {
		// CHECK THAT THE CELL PHONE NUMBER IS VALID
		// by removing all non-digits and seeing if there are 10 digits left over
		$cell = preg_replace('#[^\d]#', '', $cell); // source: http://stackoverflow.com/questions/1173612/how-do-i-remove-all-non-numbers-in-a-string-using-a-regular-expression
		if (strlen($cell) != 10) {
			$cell = htmlentities($_POST['cell']);
			show_change_cell_page('That\'s not a valid cell phone number', 'cell');
			return;
		}
	}
	
	// Change cell phone number
	$query = 'UPDATE users SET cell="' . mysqli_real_escape_string(DB::get(),$cell)
		. '" WHERE id="' . $_SESSION['user_id'] . '" LIMIT 1';
	DB::queryRaw($query);
		
	// Go to Profile Page
	$_SESSION['ACCOUNT_profile_change_message'] = 'Your cell phone number has been changed';
	header('Location: My_Profile');
}





function show_change_password_page($err) {
	// Put cursor in first field
	global $body_onload;
	$body_onload = 'document.forms[\'changePassword\'].currpass.focus()';
	
	
	page_header('Change Password');
	
	
	// If an error message is given, put it inside this div and echo, later
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	
	// Assemble body of page
	echo <<<HEREDOC
      <h1>Change Password</h1>
      $err
      <form id="changePassword" method="post" action="{$_SERVER['REQUEST_URI']}">
        <table class="spacious">
          <tr>
            <td>Current Password:</td>
            <td><input type="password" name="currpass" size="25"/></td>
          </tr><tr>
            <td>New Password:</td>
            <td><input type="password" name="pass1" size="25"/></td>
          </tr><tr>
            <td>Re-type New Password:&nbsp;</td>
            <td>
              <input type="password" name="pass2" size="25"/><br />
              <span class="small">Must be at least 6 characters</span>
            </td>
          </tr><tr>
            <td></td>
            <td>
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
              <input type="submit" name="do_change_password" value="Change Password"/>
              &nbsp;&nbsp;<a href="My_Profile">Cancel</a>
            </td>
          </tr>
        </table>
      </form>
HEREDOC;
}





function change_password() {
	// Check XSRF token
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	// Fetch form data
	$pass = $_POST['pass1'];
	
	// Get Data
	$query = 'SELECT email, passhash FROM users WHERE id="' . $_SESSION['user_id'] . '" LIMIT 1';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	
	$email = mysqli_real_escape_string(DB::get(),strtolower($row['email']));
	$old_passhash = $row['passhash'];
	
	// CHECK PASSWORD
	if (hash_pass($email, $_POST['currpass']) != $old_passhash) {
		show_change_password_page('Incorrect password');
		return;
	}
	
	// CHECK THAT THE PASSWORDS MATCH, MEET MINIMUM LENGTH
	if ($pass != $_POST['pass2']) {
		show_change_password_page('The passwords that you entered do not match');
		return;
	}
	if (strlen($pass) < 6) {
		show_change_password_page('Please choose a password that has at least 6 characters');
		return;
	}
	
	// Change password
	$passhash = hash_pass($email, $pass);
	$query = 'UPDATE users SET passhash="' . mysqli_real_escape_string(DB::get(),$passhash) . '" WHERE id="' . $_SESSION['user_id'] . '" LIMIT 1';
	DB::queryRaw($query);
		
	// Go to Profile Page
	$_SESSION['ACCOUNT_profile_change_message'] = 'Your password has been changed';
	header('Location: My_Profile');
}





function do_toggle_mailings() {
	// Check XSRF token
	if ($_GET['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	// Get previous value
	$query = 'UPDATE users SET mailings = mailings XOR 1 WHERE id="' . mysqli_real_escape_string(DB::get(),$_SESSION['user_id']) . '"';
	DB::queryRaw($query);
	
	header('Location: My_Profile');
}
?>