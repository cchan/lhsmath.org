<?php
/*
 * LMT/Registration/Coach.php
 * LHS Math Club Website
 */


$path_to_lmt_root = '../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
lmt_reg_restrict_access('X');

if (isSet($_POST['lmt_do_reg_coach']))
	process_form();
else
	show_form('', 'school_name');





function show_form($err, $selected_field) {
	// A little javascript to put the cursor in the first field when the form loads;
	// page_header() looks at the $body_onload variable and inserts it into the code.
	global $body_onload;
	$body_onload = 'document.forms[\'lmtRegCoach\'].' . $selected_field . '.focus();';
	
	// If an error message is given, put it inside this div
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	// Get the code for reCAPTCHA
	$recaptcha_code = recaptcha_get_html_f();
	
	global $school_name, $email;
	
	// Assemble the page, and send.
	lmt_page_header('Coach Registration');
	echo <<<HEREDOC
      <h1>Coach Registration</h1>
      
      <div class="instruction">
      In order to register <b>teams</b> for the Lexington Math Tournament, create an account by filling out this form.
      Only one account per school or organization is required; each account may register multiple teams. Note that 
	  each <i>team</i> <b>must</b> have one adult volunteer (coach, teacher, parent, or otherwise) for supervision.<br />
      <br />
      If you have already registered, use the link in the confirmation email to access your school's information. For
      assistance, please <a href="../Contact">contact us</a>.
      </div>
      <br />
      $err
      <form id="lmtRegCoach" method="post" action="{$_SERVER['REQUEST_URI']}">
        <table>
          <tr>
            <td>School/Organization:&nbsp;</td>
            <td>
              <input type="text" name="school_name" size="25" maxlength="35" value="$school_name" />
              <br /><br />
            </td>
          </tr><tr>
            <td>Coach's Email Address:</td>
            <td><input id="email" type="text" name="email" size="25" maxlength="320" value="$email" /></td>
          </tr><tr>
            <td>Security Check:</td>
            <td>$recaptcha_code</td>
          </tr><tr>
            <td></td>
            <td>
              <input type="submit" name="lmt_do_reg_coach" value="Create Account" />
              &nbsp;<a href="Home">Cancel</a>
            </td>
          </tr>
        </table>
      </form>
HEREDOC;
	die;
}





function process_form() {
	// INITIAL DATA FETCHING
	global $school_name, $email;	// so that the show_form function can use these values later
	
	$school_name = htmlentities(trim($_POST['school_name']));
	$email = htmlentities($_POST['email']);
	
	
	$name_msg = validate_school_name($school_name);
	if ($name_msg !== true)
		show_form($name_msg, 'school_name');
	
	$recaptcha_msg = validate_recaptcha();
	if ($recaptcha_msg !== true)
		show_form($recaptcha_msg, 'recaptcha_response_field');
	
	$email_msg = validate_coach_email($email);
	if ($email_msg !== true)
		show_form($email_msg, 'email');
	
	// ** All information has been validated at this point **
	
	$access_code = generate_code(5);
	
	// Create database entry
	DB::insert('schools',array('name'=>$school_name,'coach_email'=>$email,'access_code'=>$access_code));
	
	// Get user id (MySQL AUTO_INCREMENT id)
	$id = DB::insertId();
	
	// Start outputting the top part of the page, to make it seem responsive while we send the email
	lmt_page_header('Coach Registration');
	
	global $LMT_EMAIL;
	$lmt_year = htmlentities(map_value('year'));
	$lmt_date = htmlentities(map_value('date'));
	
	// Send the email
	$url = get_site_url() . '/LMT/Registration/Signin?ID=' . $id . '&Code=' . $access_code;
	
	$subject = "LMT $lmt_year Account";
	$body = <<<HEREDOC
To: $school_name

Thank you for registering your school for the LMT! The contest will be 
held on [b]$lmt_date [/b] at Lexington High School.

You may register teams for LMT $lmt_year via the link below. This link will
also enable you to modify teams as long as registration is open.

[b][url]$url [/url][/b]

If you have any questions, please contact us at [email]$LMT_EMAIL [/email].
HEREDOC;
	lmt_send_email(array($email=>$school_name), $subject, $body);
	
	// Show the post-registration message
	echo <<<HEREDOC
      <h1>Coach Registration</h1>
      
      <div class="text-centered">
        Your account was created. Please check your email inbox for a confirmation email.
      </div>
HEREDOC;
}

?>