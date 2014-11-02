<?php
/*
 * Account/Register.php
 * LHS Math Club Website
 *
 * Allows users to create an account on the website.
 */


$path_to_root = '../';
require_once '../lib/functions.php';
restrict_access('X'); // only for logged-out users

//Expire any pre-approved-email invitation if it's past the expiration (15 min).
if (isSet($_SESSION['PREAPPROVED_expiry']) && $_SESSION['PREAPPROVED_expiry'] < time())
	header('Location: Signout');

if (isSet($_POST['do_register']))
	process_form();
else
	show_form();





/*
 * show_form($err, $selected_field)
 *
 * Shows the registration form, with optional error message.
 *
 * $selected_field is the name of the field to put the cursor into; if the
 * form was already submitted but had errors, the cursor goes into the
 * problematic field, for convenience.
 */
function show_form($err, $selected_field) {
	//--todo-- better way to do focus().
	
	// If an error message is given, put it inside this div
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	// Figure out what year people will be graduating.
	$year4 = (int)date('Y');
	
	if ((int)date('n') > 6) // after June...
		$year4 += 1;
	
	$year3 = $year4 + 1;
	$year2 = $year4 + 2;
	$year1 = $year4 + 3;
	
	// If the form was submitted before but had errors, fill in the previous values;
	// these were parsed when process_form was called
	global $name, $email, $cell, $yog, $mailings;
	$year1_sel = $yog == $year1 ? ' selected' : '';  // add the attribute 'selected' to the YOG that they selected
	$year2_sel = $yog == $year2 ? ' selected' : '';
	$year3_sel = $yog == $year3 ? ' selected' : '';
	$year4_sel = $yog == $year4 ? ' selected' : '';
	
	if ($mailings == '0')
		$mailings = '';
	else
		$mailings = ' checked="checked"';
	
	// Auto-fill pre-approved email address
	if (!isSet($email) && isSet($_SESSION['PREAPPROVED']))
		$email = htmlentities($_SESSION['PREAPPROVED']);
	
	// Get the code for reCAPTCHA
	global $RECAPTCHA_PUBLIC_KEY;
	require_once '../lib/recaptchalib.php';
	$recaptcha_code = recaptcha_get_html($RECAPTCHA_PUBLIC_KEY);
	
	// Assemble the page, and send.
	page_header('Register');
	echo <<<HEREDOC
      <h1>Register</h1>
      
      Create an account to access scores, handouts and other information.<br />
      <span class="b">These accounts are intended for members of the LHS Math Club only.</span><br /><br />
      $err
      <form id="register" method="post" action="{$_SERVER['REQUEST_URI']}" autocomplete="off">
        <table>
          <tr>
            <td>Name:</td>
            <td>
              <input type="text" name="name" size="25" maxlength="25" value="$name"/><br />
              <span class="small">First name or nickname AND last name</span><br /><br />
            </td>
          </tr><tr>
            <td>Email Address:</td>
            <td><input id="username" type="text" name="email" size="25" maxlength="320" value="$email"/></td>
          </tr><tr>
            <td>Cell Phone Number:&nbsp;</td>
            <td>
              <input type="text" name="cell" size="25" value="$cell"/><br />
              <span class="small">Optional</span><br /><br />
            </td>
          </tr><tr>
            <td>Year of Graduation:</td>
            <td>
              <select name="yog">
                <option value="$year1"{$year1_sel}>$year1</option>
                <option value="$year2"{$year2_sel}>$year2</option>
                <option value="$year3"{$year3_sel}>$year3</option>
                <option value="$year4"{$year4_sel}>$year4</option>
              </select><br /><br />
            </td>
          </tr><tr>
            <td>Password:</td>
            <td><input id="password" type="password" name="pass1" size="25"/></td>
          </tr><tr>
            <td>Re-type Password:</td>
            <td>
              <input type="password" name="pass2" size="25"/><br />
              <span class="small">Must be at least 6 characters</span><br /><br />
            </td>
          </tr><tr>
            <td>Mailing List:</td>
            <td>
              <input id="mailings" type="checkbox" name="mailings" value="Yes"$mailings/>
              <label for="mailings">Receive Math Club announcements</label><br /><br />
            </td>
          </tr><tr>
            <td>Are you human?</td>
            <td>$recaptcha_code</td>
          </tr><tr>
            <td></td>
            <td><input type="submit" name="do_register" value="Create Account"/></td>
          </tr>
        </table>
      </form>
HEREDOC;
	default_page_footer('');
}





/*
 * process_form()
 *
 * Vaidates the information submitted and then creates the user account.
 */
function process_form() {
	// INITIAL DATA FETCHING
	global $name, $email, $cell, $yog, $mailings;	// so that the show_form function can use these values later
	
	$name = htmlentities(ucwords(trim(strtolower($_POST['name']), ' \-\'')));
	foreach (array('-', '\'') as $delimiter) {
		if (strpos($name, $delimiter) !== false) {
			$name = implode($delimiter, array_map('ucfirst', explode($delimiter, $name)));
		}
	}	// forces characters after spaces, hyphens and apostrophes to be capitalized
	$name = preg_replace('/[\s\']*\-+[\s\']*/', '-', $name);// removes hyphens not between two characters
	$name = preg_replace('/[\s\-]*\'+[\s\-]*/', '\'', $name);// removes apostrophes not between two characters
	$name = preg_replace('/\s+/', ' ', $name);		// removes multiple consecutive spaces
	$name = preg_replace('/\-+/', '-', $name);		// removes multiple consecutive hyphens
	$name = preg_replace('/\'+/', '\'', $name);		// removes multiple consecutive apostrophes
	
	$email = htmlentities(strtolower($_POST['email']));
	$cell = htmlentities($_POST['cell']);
	$yog = $_POST['yog'];
	$pass = $_POST['pass1'];
	
	$mailings = '0';
	if ($_POST['mailings'] == 'Yes')
		$mailings = '1';
	
	
	// CHECK THAT THE NAME IS VALID
	if (($name = sanitize_username($name)) === false){
		alert('Your name must have only letters, hyphens, apostrophes, and spaces, and be between 3 and 30 characters long', -1);
		show_form();
		return;
	}
	if (strpos($name, ' ') == false) {
		alert('Please enter both your first <span class="i">and</span> last name', -1);
		show_form();
		return;
	}
	
	// CHECK THAT THE EMAIL ADDRESS IS VALID
	if (!val('e',$email)){
		alert('That\'s not a valid email address',-1);
		show_form();
		return;
	}
	
	// CHECK AND FORMAT CELL PHONE NUMBER
	if ($cell != '' && ($cell = format_phone_number($cell)) === false) { //Validate the format of the cell phone number (if it's not left blank)
		alert('That\'s not a valid cell phone number',-1);
		show_form();
		return;
	}
	
	// CHECK THAT THE YOG IS VALID
	$grade = getGradeFromYOG($yog);
	if ($grade < 9 || $grade > 12) {
		show_form('That is not a valid YOG (you have to be in high school)', 'yog');
		return;
	}
	
	// CHECK THAT THE PASSWORDS MATCH, MEET MINIMUM LENGTH
	if ($pass != $_POST['pass2']) {
		show_form('The passwords that you entered do not match', 'pass1');
		return;
	}
	if (strlen($pass) < 6) {
		show_form('Please choose a password that has at least 6 characters', 'pass1');
		return;
	}
	
	// CHECK THAT THEY ENTERED THE RECAPTCHA CORRECTLY
	global $RECAPTCHA_PRIVATE_KEY;
	require_once '../lib/recaptchalib.php';
	$recaptcha_response = recaptcha_check_answer(	$RECAPTCHA_PRIVATE_KEY,
													$_SERVER['REMOTE_ADDR'],
													$_POST['recaptcha_challenge_field'],
													$_POST['recaptcha_response_field']);
	if (!$recaptcha_response->is_valid) {
		show_form('You entered the reCaptcha incorrectly', 'pass1');
		return;
	}
	
	// CHECK THAT AN ACCOUNT WITH THAT EMAIL DOES NOT ALREADY EXIST
	// this is done *after* checking the reCaptcha to prevent bots from harvesting our email
	// addresses via a brute-force attack.
	if (DBExt::queryCount('users','LOWER(email)=LOWER(%s)',$email) != 0) {
		show_form('An account with that email address already exists', 'email');
		return;
	}
	
	// CHECK THAT AN ACCOUNT WITH THE SAME NAME IN THE SAME GRADE DOES NOT EXIST
		// - with the exception that if it's permissions = 'E', they probably mistyped their email and are redoing it.
	if (DBExt::queryCount('users','LOWER(name)=%s AND yog=%i AND permissions!="E"',strtolower($name),$yog) != 0) {
		show_form('An account in your grade with that name already exists', 'name');
		return;
	}
	
	
	// ** All information has been validated at this point **
	
	$verification_code = generate_code(5);  // for verifying ownership of the email address
	
	// Check if email address has been pre-approved
	if (isSet($_SESSION['PREAPPROVED']) && $email === $_SESSION['PREAPPROVED']) {
		$approved = '1';			// skip Captain approval
		$verification_code = '1';	// skip email verification (already done)
	}
	else
		$approved = '0';
	
	// Create database entry
	$passhash = hash_pass($email, $pass);
	
	if ($cell == '')
		$cell = 'None';
	else
		$cell = preg_replace('#[^\d]#', '', $_POST['cell']);  // remove non-numbers from cell phone # again
	
	DB::insert('users',array(
		'name'=>$name,
		'email'=>$email,
		'passhash'=>$passhash,
		'cell'=>$cell,
		'yog'=>$yog,
		'mailings'=>$mailings,
		'approved'=>$approved,
		'email_verification'=>$verification_code,
		'registration_ip'=>htmlentities(strtolower($_SERVER['REMOTE_ADDR']))
	));
	
	set_login_data(DB::insertId());	// LOG THEM IN
	
	// For pre-approved members:
	if ($approved == '1') {
		global $WEBMASTER_EMAIL;
		$to = $name . ' <' . $email . '>';
		$subject = 'Account Created';
		$body = <<<HEREDOC
Welcome to the LHS Math Club website, $name!
Your account has been created. If you have any questions about the site, please email
the webmaster at $WEBMASTER_EMAIL
HEREDOC;
		send_email($to, $subject, $body, $WEBMASTER_EMAIL);
		
		$_SESSION['HOME_welcome'] = 'Welcome to the LHS Math Club website, ' . $name . '!';
		header('Location: Home');
	}
	
	$_SESSION['ACCOUNT_do_send_verification_email'] = true;
	
	header('Location: Verify_Email');
}

?>