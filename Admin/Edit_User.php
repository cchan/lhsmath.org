<?php
/*
 * Admin/Edit_User.php
 * LHS Math Club Website
 *
 * Allows Admins to change users' information
 *
 * Must be linked to using GET parameters:
 *  - 'ID': user id
 *  - one of the following:
 *     - 'Ban': ban user
 *     - 'Approve': approve user
 *     - 'Unapprove': un-approve user
 *     - 'Name': change name
 *     - 'Yog': change yog
 *     - 'Permissions': change permissions
 *  - 'xsrf_token': the xsrf token, for ban/approve/unapprove only
 *  - 'Return': where to redirect afterward, either 'List' (User List)
 *       or 'View' (View User)
 */


$path_to_root = '../';
require_once '../lib/functions.php';
restrict_access('A');


if (!isSet($_GET['ID']))
	trigger_error('No user ID', E_USER_ERROR);
else if (isSet($_POST['do_change_name']))
	do_change_name();
else if (isSet($_POST['do_change_yog']))
	do_change_yog();
else if (isSet($_POST['do_change_permissions']))
	do_change_permissions();
else if (isSet($_GET['Ban']))
	do_ban();
else if (isSet($_GET['Approve']))
	do_approve();
else if (isSet($_GET['Unapprove']))
	do_unapprove();
else if (isSet($_GET['Change_Name']))
	show_change_name_page('');
else if (isSet($_GET['Change_YOG']))
	show_change_yog_page('');
else if (isSet($_GET['Change_Permissions']))
	show_change_permissions_page('');
else
	trigger_error('Unknown action', E_USER_ERROR);





/*
 * function do_ban()
 *
 * Bans the specified user by changing "approved" to -1 in the database;
 * If the user is already banned, nothing happens.
 */
function do_ban() {
	// Anti-hacking check
	if ($_GET['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('Ban: Invalid XSRF token', E_USER_ERROR);
	
	// Check that the user id is valid
	$query = 'SELECT id FROM users WHERE id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '"';
	$result = DB::queryRaw($query);
	
	// If User ID isn't valid, show an error page
	if (mysqli_num_rows($result) != 1)
		trigger_error('Invalid user ID', E_USER_ERROR);
	
	// Otherwise, perform the ban
	$query = 'UPDATE users SET approved="-1" WHERE id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1';
	DB::queryRaw($query);
	
	redirect();	// Go back to the previous page
}





/*
 * function do_approve()
 *
 * Appproves the specified user by changing "approved" to 1 in the database;
 * If the user is already approved, nothing happens.
 */
function do_approve() {
	// Anti-hacking check
	if ($_GET['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('Approve: Invalid XSRF token', E_USER_ERROR);
	
	// Check that the user id is valid
	$query = 'SELECT id FROM users WHERE id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '"';
	$result = DB::queryRaw($query);
	
	// If User ID isn't valid, show an error page
	if (mysqli_num_rows($result) != 1)
		trigger_error('Invalid user ID', E_USER_ERROR);
	
	// Otherwise, approve the user
	$query = 'UPDATE users SET approved="1" WHERE id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1';
	DB::queryRaw($query);
	
	redirect();	// Go back to the previous page
}





/*
 * function do_unapprove()
 *
 * Places the specified user into limbo by changing "approved" to 0 in the database
 * (that means "hasn't gotten approved yet")
 * If the user is already in limbo, nothing happens.
 */
function do_unapprove() {
	// Anti-hacking check
	if ($_GET['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('Unapprove: Invalid XSRF token', E_USER_ERROR);
	
	// Check that the user id is valid
	$query = 'SELECT id FROM users WHERE id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '"';
	$result = DB::queryRaw($query);
	
	// If User ID isn't valid, show an error page
	if (mysqli_num_rows($result) != 1)
		trigger_error('Invalid user ID', E_USER_ERROR);
	
	// Otherwise, approve the user
	$query = 'UPDATE users SET approved="0" WHERE id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1';
	DB::queryRaw($query);
	
	redirect();	// Go back to the previous page
}





/*
 * function show_change_name_page($err)
 *  - $err: the error message to show, or an empty string
 *
 * Shows a page that allows an admin to change a user's name
 */
function show_change_name_page($err) {
	// Check that the user id is valid and get user's info
	$query = 'SELECT name FROM users WHERE id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '"';
	$result = DB::queryRaw($query);
	
	// If User ID isn't valid, show an error page
	if (mysqli_num_rows($result) != 1)
		trigger_error('Invalid user ID', E_USER_ERROR);
	
	// Otherwise, get info
	$row = mysqli_fetch_assoc($result);
	$old_name = $row['name'];
	
	
	// A little javascript to put the cursor in the first field when the form loads;
	// page_header() looks at the $body_onload variable and inserts it into the code.
	global $body_onload;
	$body_onload = 'document.forms[\'changeName\'].name.focus()';
	
	// If an error message is given, put it inside this div
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	global $name;	// if the form was previously submitted and an error came up, get the old name
	
	page_header('Change Name');
	echo <<<HEREDOC
      <h1>Change Name</h1>
      $err
      <form id="changeName" method="post" action="{$_SERVER['REQUEST_URI']}">
        <table class="spacious">
          <tr>
            <td>Current Name:&nbsp;</td>
            <td><span class="b">$old_name</span></td>
          </tr><tr>
            <td>New Name:</td>
            <td><input type="text" name="name" value="$name" size="25" maxlength="25"/></td>
          </tr><tr>
            <td></td>
            <td>
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
              <input type="submit" name="do_change_name" value="Change"/>
              &nbsp;&nbsp;<a href="View_User?ID={$_GET['ID']}">Cancel</a>
            </td>
          </tr>
        </table>
      </form>
HEREDOC;
	admin_page_footer('');
}





/*
 * function do_change_name()
 *
 * Processes the above form for changing a user's name
 */
function do_change_name() {
	// Check XSRF token
	if ($_SESSION['xsrf_token'] != $_POST['xsrf_token'])
		trigger_error('Do_Change_Name: Invalid XSRF token', E_USER_ERROR);
	
	// Check if ID is valid
	$query = 'SELECT name, yog FROM users WHERE id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1';
	$result = DB::queryRaw($query);
	
	// If User ID isn't valid, show an error page
	if (mysqli_num_rows($result) != 1)
		trigger_error('Invalid user ID', E_USER_ERROR);
	
	$row = mysqli_fetch_assoc($result);
	$yog = $row['yog'];
	$old_name = $row['name'];
	
	// Validate the entered name:
	//
	
	global $name;
	$name = htmlentities(ucwords(trim($_POST['name'])));
		// capitalizes first letters if they didn't do it; removes whitespace before and after.
		// and makes sure to escape the name
	$name = preg_replace('/\s\s+/', ' ', $name);	// removes multiple consecutive spaces, thanks to juglesh at http://bytes.com/topic/php/answers/160400-delete-multiple-spaces-special-characters
	
	
	if (strlen($name) > 25)
		$name = substr($name, 0, 25); 	// you should not be able to enter a name > 25 chars.
										// If so, you're probably hacking around. Names are trimmed.
	
	if (strlen($name) < 6) {		// minimum length: 6 chars
		show_change_name_page('Names must be at least 6 characters long');
		return;
	}
	
	// Check for extraneous characters
	if (!preg_match('/^[A-Za-z-\s]+$/', $name)) {
		show_change_name_page('You may only use letters, hyphens and spaces in a name');
		return;
	}
	
	// Check that a current member (or pending member) does not share that name
	$sql_name = mysqli_real_escape_string(DB::get(),strtolower($name));
	$query = 'SELECT COUNT(*) FROM users WHERE LOWER(name)="' . $sql_name . '" AND yog="'
		. mysqli_real_escape_string(DB::get(),$yog) . '" AND permissions!="L" AND approved!="-1"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	
	$count = 0;
	if (strtolower($name) == strtolower($old_name))	// you can change the case of a name
		$count = 1;
	
	if ($row['COUNT(*)'] > $count) {
		show_change_name_page('An account with that name in the same grade already exists');
		return;
	}
	
	
	// ** INFORMATION VALIDATED AT THIS POINT **
	
	// Change name
	$query = 'UPDATE users SET name="' . $name . '" WHERE id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) .'" LIMIT 1';
	DB::queryRaw($query);
	
	redirect();
}





/*
 * function show_change_yog_page($err)
 *  - $err: the error message to show, or an empty string
 *
 * Shows a page that allows an admin to change a user's year of graduation
 */
function show_change_yog_page($err) {
	// Check that the user id is valid and get user's info
	$query = 'SELECT name, yog FROM users WHERE id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '"';
	$result = DB::queryRaw($query);
	
	// If User ID isn't valid, show an error page
	if (mysqli_num_rows($result) != 1)
		trigger_error('Invalid user ID', E_USER_ERROR);
	
	// Otherwise, get info
	$row = mysqli_fetch_assoc($result);
	$name = $row['name'];
	$old_yog = $row['yog'];
	
	
	// A little javascript to put the cursor in the first field when the form loads;
	// page_header() looks at the $body_onload variable and inserts it into the code.
	global $body_onload;
	$body_onload = 'document.forms[\'changeYOG\'].yog.focus()';
	
	// If an error message is given, put it inside this div
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	global $yog;	// if the form was previously submitted and an error came up, get what they previously entered
	
	page_header('Change YOG');
	echo <<<HEREDOC
      <h1>Change Year of Graduation</h1>
      $err
      <form id="changeYOG" method="post" action="{$_SERVER['REQUEST_URI']}">
        <table class="spacious">
          <tr>
            <td>Name:</td>
            <td><span class="b">$name</span></td>
          </tr><tr>
            <td>Current YOG:&nbsp;</td>
            <td><span class="b">$old_yog</span></td>
          </tr><tr>
            <td>New YOG:</td>
            <td><input type="text" name="yog" value="$yog" size="4" maxlength="4"/></td>
          </tr><tr>
            <td></td>
            <td>
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
              <input type="submit" name="do_change_yog" value="Change"/>
              &nbsp;&nbsp;<a href="View_User?ID={$_GET['ID']}">Cancel</a>
            </td>
          </tr>
        </table>
      </form>
HEREDOC;
	admin_page_footer('');
}





/*
 * function do_change_yog()
 *
 * Processes the above form for changing a user's yog
 */
function do_change_yog() {
	// Check XSRF token
	if ($_SESSION['xsrf_token'] != $_POST['xsrf_token'])
		trigger_error('Do_Change_YOG: Invalid XSRF token', E_USER_ERROR);
	
	// Check if ID is valid
	$query = 'SELECT name FROM users WHERE id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1';
	$result = DB::queryRaw($query);
	
	// If User ID isn't valid, show an error page
	if (mysqli_num_rows($result) != 1)
		trigger_error('Invalid user ID', E_USER_ERROR);
		
	
	// Validate the entered yog:
	//
	
	global $yog;
	$yog = htmlentities($_POST['yog']);
	
	// Remove non-numbers
	if (!preg_match('/^\d\d\d\d$/', $yog) || (int)$yog < 1000 || (int)$yog > 9999) {
		show_change_yog_page('That\'s not a valid YOG');
		return;
	}
	
	
	// ** INFORMATION VALIDATED AT THIS POINT **
	
	// Change yog
	$query = 'UPDATE users SET yog="' . $yog . '" WHERE id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) .'" LIMIT 1';
	DB::queryRaw($query);
	
	redirect();
}





/*
 * function show_change_permissions_page($err)
 *  - $err: the error message to show, or an empty string
 *
 * Shows a page that allows an admin to change a user's permissions (regular, admin, alumnus)
 */
function show_change_permissions_page($err) {
	// Check that the user id is valid and get user's info
	$query = 'SELECT name, permissions FROM users WHERE id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '"';
	$result = DB::queryRaw($query);
	
	// If User ID isn't valid, show an error page
	if (mysqli_num_rows($result) != 1)
		trigger_error('Invalid user ID', E_USER_ERROR);
	
	// Otherwise, get info
	$row = mysqli_fetch_assoc($result);
	$name = $row['name'];
	$old_permissions = $row['permissions'];
	
	// turn into human-readable text
	if ($old_permissions == 'C')
		$old_permissions = 'Captain';
	else if ($old_permissions == 'R')
		$old_permissions = 'Regular';
	else if ($old_permissions == 'A')
		$old_permissions = 'Non-Captain Admin';
	else if ($old_permissions == 'L')
		$old_permissions = 'Alumnus';
	
	
	// A little javascript to put the cursor in the first field when the form loads;
	// page_header() looks at the $body_onload variable and inserts it into the code.
	global $body_onload;
	$body_onload = 'document.forms[\'changePermissions\'].permissions.focus()';
	
	// If an error message is given, put it inside this div
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	page_header('Change Type');
	echo <<<HEREDOC
      <h1>Change Account Type</h1>
      
      <span class="instruction">Note that making someone a captain will automatically
      cause their email address and cell phone number to be displayed to logged-in members.</span><br /><br />
      <br />
      $err
      <form id="changePermissions" method="post" action="{$_SERVER['REQUEST_URI']}">
        <table class="spacious">
          <tr>
            <td>Name:</td>
            <td><span class="b">$name</span></td>
          </tr><tr>
            <td>Current Account Type:&nbsp;</td>
            <td><span class="b">$old_permissions</span></td>
          </tr><tr>
            <td>New Account Type:</td>
            <td>
              <select name="permissions">
                <option value="Cancel"></option>
                <option value="R">Regular</option>
                <option value="L">Alumnus</option>
                <option value="A">Non-Captain Admin</option>
                <option value="C">Captain</option>
              </select>
            </td>
          </tr><tr>
            <td></td>
            <td>
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
              <input type="submit" name="do_change_permissions" value="Change"/>
              &nbsp;&nbsp;<a href="View_User?ID={$_GET['ID']}">Cancel</a>
            </td>
          </tr>
        </table>
      </form>
HEREDOC;
	admin_page_footer('');
}





/*
 * function do_change_permissions()
 *
 * Processes the above form for changing a user's permissions level
 */
function do_change_permissions() {
	// Check XSRF token
	if ($_SESSION['xsrf_token'] != $_POST['xsrf_token'])
		trigger_error('Do_Change_Permissions: Invalid XSRF token', E_USER_ERROR);
	
	// Check if ID is valid
	$query = 'SELECT name FROM users WHERE id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1';
	$result = DB::queryRaw($query);
	
	// If User ID isn't valid, show an error page
	if (mysqli_num_rows($result) != 1)
		trigger_error('Invalid user ID', E_USER_ERROR);
		
	
	// Validate the entered permissions:
	//
	
	$permissions = $_POST['permissions'];
	
	if ($permissions == 'Cancel')	// didn't select anything
		redirect();
	
	else if ($permissions != 'R' && $permissions != 'L' && $permissions != 'A' && $permissions != 'C') {
		show_change_permissions_page('Huh? That\'s not a valid account type');
	}
	
	
	// ** INFORMATION VALIDATED AT THIS POINT **
	
	// Change permissions
	$query = 'UPDATE users SET permissions="' . $permissions . '" WHERE id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) .'" LIMIT 1';
	DB::queryRaw($query);
	
	redirect();
}





/*
 * function redirect()
 *
 * When the admin finishes editing a user's info, this function
 * sends them back where they came from, either to the View User
 * page or to the User List, as specified by the 'Return' GET parameter.
 */
function redirect() {
	if ($_GET['Return'] == 'View')
		header('Location: View_User?ID=' . $_GET['ID']);
	else
		header('Location: User_List');
	
	die();
}

?>