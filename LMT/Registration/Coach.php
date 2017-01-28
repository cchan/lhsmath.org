<?php
/*
 * LMT/Registration/Coach.php
 * LHS Math Club Website
 */


require_once '../../.lib/lmt-functions.php';
lmt_reg_restrict_access('X');

lmt_page_header('Coach Registration');

if (isSet($_POST['lmt_do_reg_coach']))
	process_form();
else
	show_form();





function show_form() {
	// Get the code for reCAPTCHA
	$recaptcha_code = recaptcha_get_html_f();
	
	global $school_name, $email;
	
	// Assemble the page, and send.
	
	echo <<<HEREDOC
      <h1>Coach Registration</h1>
      
      <div class="instruction">
      In order to register <b>teams</b> for the Lexington Math Tournament, create an account by filling out this form.
	  Individuals who do not have teams should go to <a href="Individual">Individual Registration</a>.
      Only one account per school or organization is required; each account may register multiple teams. Note that 
	  each <i>team</i> <b>must</b> have one adult volunteer (coach, teacher, parent, or otherwise) for supervision.<br />
      <br />
	  Competitors are strongly advised to organize into teams of 4 to 6 students.
	  Additionally, remember that to prevent cherry-picking to create elite teams, registering teams across different
	  schools is <i>not</i> allowed unless specifically granted exception (such as for homeschool). If you don't have a 
	  team, ask your math coach or register as an individual!
	  <br />
      If you have already registered, use the link in the confirmation email to access your school's information. For
      assistance, please <a href="../Contact">contact us</a>.
      </div>
      <br />
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
            <!--td>Security Check:</td>
            <td>$recaptcha_code</td>-->
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
	$recaptcha_msg = validate_recaptcha();
	$email_msg = validate_coach_email($email);
	if ($name_msg !== true) alert($name_msg,-1);
	// else if ($recaptcha_msg !== true) alert($recaptcha_msg,-1);
	else if ($email_msg !== true) alert($email_msg,-1);
	else {
		// ** All information has been validated at this point **
		
		$access_code = generate_code(5);
		
		// Create database entry
		DB::insert('schools',array('name'=>$school_name,'coach_email'=>$email,'access_code'=>$access_code));
		
		// Get user id (MySQL AUTO_INCREMENT id)
		$id = DB::insertId();
		
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
		die;
	}
}

?>