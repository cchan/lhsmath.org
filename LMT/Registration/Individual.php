<?php
/*
 * LMT/Registration/Individual.php
 * LHS Math Club Website
 */


require_once '../../.lib/lmt-functions.php';
lmt_reg_restrict_access('X');

if (isSet($_POST['lmt_do_reg_individual']))
	process_form();
else
	show_form('', 'name');





function show_form($err, $selected_field) {
	// A little javascript to put the cursor in the first field when the form loads;
	// page_header() looks at the $body_onload variable and inserts it into the code.
	global $body_onload;
	$body_onload = 'document.forms[\'lmtRegIndividual\'].' . $selected_field . '.focus();';
	
	// If an error message is given, put it inside this div
	if ($err != '')
		$err = "\n        <div class=\"error\">{$err}</div><br />\n";
	
	// If the form was submitted before but had errors, fill in the previous values;
	// these were parsed when process_form was called
	global $name, $email, $grade;
	$grade6_sel = $grade == '6' ? ' selected' : '';  // add the attribute 'selected' to the grade that they selected
	$grade7_sel = $grade == '7' ? ' selected' : '';
	$grade8_sel = $grade == '8' ? ' selected' : '';
	
	// Get the code for reCAPTCHA
	$recaptcha_code = recaptcha_get_html_f();
	
	// Dates
	$lmt_year = htmlentities(map_value('year'));
	$lmt_date = htmlentities(map_value('date'));
	$lmt_cost = htmlentities(map_value('indiv_cost'));
	
	// Assemble the page, and send.
	lmt_page_header('Individual Registration');
	echo <<<HEREDOC
      <h1>Individual Registration</h1>
      
      <div class="instruction">
      To register as an individual <span class="b">not affiliated with a school</span>, please fill out this form with your parents.<br />
      <br />
      The Lexington Mathematics Tournament {$lmt_year} will be held on <span class="b">{$lmt_date}</span>
      at Lexington High School. Please read the rules before registering.<br />
      <br />
      An individual registration costs <span class="b">{$lmt_cost}</span>, paid at the competition.
      </div>
      <br />
	  {$err}
      <form id="lmtRegIndividual" method="post" action="{$_SERVER['REQUEST_URI']}">
        <table>
          <tr>
            <td>Full Name:</td>
            <td><input type="text" name="name" size="25" maxlength="25" value="{$name}" /></td>
          </tr><tr>
            <td>Parent's Email Address:&nbsp;</td>
            <td><input id="email" type="text" name="email" size="25" maxlength="320" value="{$email}" /></td>
          </tr><tr>
            <td>Grade:</td>
            <td>
              <select name="grade">
                <option value="6"{$grade6_sel}>Sixth</option>
                <option value="7"{$grade7_sel}>Seventh</option>
                <option value="8"{$grade8_sel}>Eighth</option>
              </select><br /><br />
            </td>
          </tr><tr>
            <!--td>Are you human?</td>-->
            <td>{$recaptcha_code}</td>
          </tr><tr>
            <td></td>
            <td>
              <input type="submit" name="lmt_do_reg_individual" value="Register" />
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
	global $name, $email, $grade;	// so that the show_form function can use these values later
	
	$name = htmlentities(ucwords(trim($_POST['name'])));
	$name = preg_replace('/\s\s+/', ' ', $name);
	$name = preg_replace('/\-+/', '-', $name);
	
	$email = htmlentities($_POST['email']);
	$grade = $_POST['grade'];
	
	
	$name_msg = validate_name($name);
	if ($name_msg !== true)
		show_form($name_msg, 'name');
	
	$grade_msg = validate_grade($grade);
	if ($grade_msg !== true)
		show_form($grade_msg, 'grade');
	
	// $recaptcha_msg = validate_recaptcha();
	// if ($recaptcha_msg !== true)
	//	show_form($recaptcha_msg, 'recaptcha_response_field');
	
	$email_msg = validate_email($email);
	if ($email_msg !== true)
		show_form($email_msg, 'email');
	
	// ** All information has been validated at this point **
	
	// Create database entry
	DB::insert('individuals',array('name'=>$name,'grade'=>$grade,'email'=>$email));
	$id = DB::insertId();//Get AUTO_INCREMENT id
	
	// Start outputting the top part of the page, to make it seem responsive while we send the email
	lmt_page_header('Individual Registration');
	
	// Send the email
	$lmt_year = htmlentities(map_value('year'));
	$lmt_date = htmlentities(map_value('date'));
	$cost = htmlentities(map_value('indiv_cost'));
	$url = get_site_url() . '/LMT';
	global $LMT_EMAIL;
	
	$subject = "LMT {$lmt_year} Registration Receipt";
	$body = <<<HEREDOC
Hi {$name},
You have successfully registered as an individual for LMT {$lmt_year}!

[b]Please print out this email and bring it to the competition
along with the registration fee of {$cost}[/b].

Date: [b]{$lmt_date}[/b]
Location: Lexington High School [url]https://www.lhsmath.org/LMT/Location[/url]

If you have any questions, please contact us at [email]{$LMT_EMAIL}[/email].
______________________________________________________________

Registration: [b]Individual[/b]
ID: [b]{$id}[/b]
Name: [b]{$name}[/b]
Email: [b]{$email}[/b]
Grade: [b]{$grade}[/b]
______________________________________________________________
HEREDOC;
	lmt_send_email(array($email=>$name), $subject, $body);
	
	// Show the post-registration message
	echo <<<HEREDOC
      <h1>Individual Registration</h1>
      
      <div class="text-centered">
        You have successfully registered for LMT {$lmt_year}! An email has been sent with more information.
      </div>
HEREDOC;
}

?>