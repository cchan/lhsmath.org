<?php
/*
 * LMT/Backstage/Data/School.php
 * LHS Math Club Website
 *
 * Displays school data and allows staff to edit it.
 *
 * ID:	the school_id of the school to display
 */

require_once '../../../.lib/lmt-functions.php';
backstage_access();

if (isSet($_POST['lmtDataSchool_changeName']))
	do_change_name();
else if (isSet($_POST['lmtDataSchool_changeEmail']))
	do_change_email();
else if (isSet($_POST['lmtDataSchool_resendLogin']))
	do_resend_login();
else if (isSet($_POST['lmtDataSchool_changePaid']))
	do_change_paid();
else if (isSet($_POST['lmtDataSchool_delete']))
	do_confirm_delete();
else if (isSet($_POST['lmtDataSchool_reallyDelete']))
	do_delete();
else
	display_school('', '');





function display_school($err, $selected_field) {
	$row = DB::queryFirstRow('SELECT * FROM schools WHERE school_id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '"');
	$school_name = htmlentities($row['name']);
	$coach_email = htmlentities($row['coach_email']);
	$team_list = make_teams_list();
	$paid = htmlentities($row['teams_paid']);
	
	global $body_onload;
	$body_onload = $selected_field . 'externalLinks();';
	
	global $use_rel_external_script;
	$use_rel_external_script = true;
	
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	lmt_page_header($school_name);
	echo <<<HEREDOC
      <h1>School</h1>
      <table>
        <tr>
          <td>School Name:</td>
          <td>
            <form id="lmtDataSchoolName" method="post" action="{$_SERVER['REQUEST_URI']}"><div>
              <input type="text" name="school_name" size="25" maxlength="25" value="$school_name" />
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
              <input type="submit" name="lmtDataSchool_changeName" value="Change" />
            </div></form>
            <br />
          </td>
        </tr><tr>
          <td>Coach's Email:</td>
          <td>
            <form id="lmtDataSchoolEmail" method="post" action="{$_SERVER['REQUEST_URI']}"><div>
              <input type="text" name="coach_email" size="25" value="$coach_email" />
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
              <input type="submit" name="lmtDataSchool_changeEmail" value="Change" />
            </div></form>
            <div class="halfbreak"></div>
            <form method="post" action="{$_SERVER['REQUEST_URI']}"><div>
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
              <input type="submit" name="lmtDataSchool_resendLogin" value="Resend Login Information" />
            </div></form>
            <div class="halfbreak"></div>
            <a href="mailto:$coach_email" rel="external">Send Email</a>
            <br /><br />
          </td>
        </tr><tr>
          <td>Teams Paid:</td>
          <td>
            <form id="lmtDataSchoolPaid" method="post" action="{$_SERVER['REQUEST_URI']}"><div>
              <input type="text" name="teams_paid" size="4" maxlength="4" value="$paid" />
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
              <input type="submit" name="lmtDataSchool_changePaid" value="Change" />
            </div></form>
            <br />
          </td>
        </tr><tr>
          <td>Teams:</td>
          <td>
$team_list            <br />
          </td>
        </tr><tr>
          <td>Delete:</td>
          <td>
            <form method="post" action="{$_SERVER['REQUEST_URI']}"><div>
              <input type="submit" name="lmtDataSchool_delete" value="Delete School, Teams &amp; Members" />
            </div></form>
          </td>
        </tr>
      </table>
HEREDOC;
	die;
}





function make_teams_list() {
	$sp = '            ';
	$return = '';
	
	$result = DB::queryRaw('SELECT team_id, name FROM teams WHERE school="' . htmlentities($_GET['ID']) . '" AND deleted="0" ORDER BY name');
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$return .= $sp . '<a href="Team?ID=' . htmlentities($row['team_id']) . '">' . htmlentities($row['name']) . '</a><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($return == '')
		$return = '<span class="i">None</span><br />' . "\n";
	
	return $return;
}





function do_change_name() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$name = $_POST['school_name'];
	$name_msg = validate_school_name($name);
	if ($name_msg !== true)
		display_school($name_msg, 'document.forms[\'lmtDataSchoolName\'].school_name.focus();');
	
	DB::update('schools','name=%s','school_id=%i AND name <> %s LIMIT 1', $name, $_GET['ID'], $name);
	
	global $LMT_DB;
	if (mysqli_affected_rows($LMT_DB) == 1) {
		$row = DB::queryFirstRow('SELECT COUNT(*) FROM schools WHERE name=%s AND school_id <> %i AND deleted="0"', $name, $_GET['ID']);
		if ($row['COUNT(*)'] > 0)
			alert('School name was changed. WARNING: Another school has the same name.',1);
		else
			alert('School name was changed',1);
	}
	lmt_location('Backstage/Data/School?ID=' . $_GET['ID']);
}





function do_change_email() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$email = $_POST['coach_email'];
	
	$row = DB::queryFirstRow('SELECT coach_email FROM schools WHERE school_id=%i',$_GET['ID']);
	if ($email == $row['coach_email']) {
		header('Location: School?ID=' . $_GET['ID']);
		die;
	}
	
	$email_msg = validate_coach_email($email);
	if ($email_msg !== true)
		display_school($email_msg, 'document.forms[\'lmtDataSchoolEmail\'].coach_email.focus();');
	
	DB::update('schools','coach_email=%s', 'school_id=%i LIMIT 1', $email, $_GET['ID']);
	
	alert('Coach email was changed', 1);
	lmt_location('Backstage/Data/School?ID=' . $_GET['ID']);
}





function do_resend_login() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$row = DB::queryFirstRow('SELECT school_id, name, coach_email, access_code FROM schools WHERE school_id="' . $_GET['ID'] . '"');
	$school_name = $row['name'];
	$email = $row['coach_email'];
	
	$url = get_site_url() . '/LMT/Registration/Signin?ID=' . $row['school_id'] . '&Code=' . $row['access_code'];
	global $LMT_EMAIL;
	
	$to = array($email => $school_name);
	$subject = 'LMT Account';
	$body = <<<HEREDOC
To: $school_name

You may register teams for the LMT by clicking the link below. This link will
also enable you to modify teams as long as registration is open.

$url
HEREDOC;
	lmt_send_email($to, $subject, $body);
	
	alert('The login information was resent to ' . htmlentities($email),1);
	lmt_location('Backstage/Data/School?ID=' . $_GET['ID']);
}





function do_change_paid() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	DB::queryRaw('UPDATE schools SET teams_paid="' . htmlentities(intval($_POST['teams_paid']))
		. '" WHERE school_id="' . htmlentities($_GET['ID'])
		. '" AND teams_paid <> "' . htmlentities(intval($_POST['teams_paid'])) . '" LIMIT 1');
	
	global $LMT_DB;
	if (mysqli_affected_rows($LMT_DB) == 1)
		alert('Number of teams paid was changed', 1);
	lmt_location('Backstage/Data/School?ID=' . $_GET['ID']);
}





function do_confirm_delete() {
	$id = htmlentities($_GET['ID']);
	
	$row = DB::queryFirstRow('SELECT name FROM schools WHERE school_id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '"');
	$school_name = htmlentities($row['name']);
	
	lmt_page_header('Delete School');
	echo <<<HEREDOC
      <h1>Delete School</h1>
      
      <div class="text-centered">
        Are you sure that you want to delete the school <span class="b">$school_name</span><br />
        and all of its teams and membes?
        <div class="halfbreak"></div>
        <form method="post" action="{$_SERVER['REQUEST_URI']}"><div>
          <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
          <input type="submit" name="lmtDataSchool_reallyDelete" value="Delete" />
          &nbsp;&nbsp;<a href="School?ID=$id">Cancel</a>
        </div></form>
      </div>
HEREDOC;
}





function do_delete() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	DB::queryRaw('UPDATE individuals SET deleted="1" WHERE team = ANY (SELECT team_id FROM teams WHERE school="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '")');
	DB::queryRaw('UPDATE teams SET deleted="1" WHERE school="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '"');
	DB::queryRaw('UPDATE schools SET deleted="1" WHERE school_id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1');
	
	header('Location: Home');
}

?>