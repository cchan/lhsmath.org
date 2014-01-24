<?php
/*
 * lib/lmt-functions.php
 * LHS Math Club Website
 */

if (!isSet($path_to_root))
	$path_to_root = '../'.$path_to_lmt_root; //this is wrong

require_once $path_to_root . 'lib/CONFIG.php';

// connect to database - we do this first so that the regular database is used without a link identifier
connect_to_lmt_database();


// include regular functions
require_once 'functions.php';
require_once 'lmt-scoring.php';


//
// DEFAULT ACTIONS:
//

// Replace the custom error handler with this one
function lmt_custom_errors($errno, $errstr, $errfile, $errline) {
	global $path_to_root;
	$rh = fopen($path_to_root . '.content/Errors.txt', 'a+');
	fwrite($rh, date(DATE_RFC822) . ' Error [' . $errno . '] on line ' . $errline . ' in ' . $errfile . ': ' . $errstr . "\n");
	fclose($rh);
	
	global $miniature_page;
	if (isSet($miniature_page))
		$miniature_page = '?Mini';
	
	if (headers_sent())
		echo '<meta http-equiv="refresh" content="0;url=' . $path_to_root . 'LMT/Error' . $miniature_page . '">';
	
	else if (isSet($_GET['xsrf_token']))
		header('Location: ' . $path_to_root . 'LMT/Error' . $miniature_page);
	
	else {
		if (isSet($miniature_page)) {
			echo <<<HEREDOC
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title></title>
    <link rel="stylesheet" href="{$path_to_root}res/default.css" type="text/css" media="all" />
    <link rel="stylesheet" href="{$path_to_root}res/lmt.css" type="text/css" media="all" />
    <link rel="stylesheet" href="{$path_to_root}res/print.css" type="text/css" media="print" />
  </head>
  
  <body class="gutsEmbedSetup">
    <div style="width: 350px; height: 30px; background-color: #fd0; margin: -10px;"></div>
    <br />
    <br />
    <div class="text-centered b">
      An error occurred.
      <div class="halfbreak"></div>
      (<a href="{$_SERVER['REQUEST_URI']}">reload</a>)
    </div>
  </body>
</html>
HEREDOC;
		} else {
			header("HTTP/1.1 500 Internal Server Error");
			lmt_page_header('Error');
			echo <<<HEREDOC
      <h1>Error</h1>
      
      Whoops! Something went wrong. Try again?
HEREDOC;
			lmt_home_footer();
		}
	}
	
	die;
}
if ($CATCH_ERRORS) {
	set_error_handler('lmt_custom_errors', E_ERROR | E_PARSE | E_USER_ERROR);
	error_reporting(E_ERROR | E_PARSE | E_USER_ERROR);
}


// refresh cached data (name, permissions) every 1 min.
if (isSet($_SESSION['LMT_user_id']) && time() >= $_SESSION['LMT_last_refresh'] + 60)
	lmt_set_login_data($_SESSION['LMT_user_id']);


// everyone gets logged out after 2 hours, no matter what
// (this is in case an account is compromised without the password, i.e. left logged
// in somewhere, or via intercepted verification email). Not that that's our most
// significant worry.
if (isSet($_SESSION['LMT_user_id']) && time >= $_SESSION['LMT_login_time'] + 7200)
	die('Signing Out... | ' . $_SESSION['LMT_user_id'] . ' | ' . $_SESSION['LMT_login_time'] . ' | ' . time());
	//header('Location: ' . $path_to_lmt_root . 'Registration/Signout');





/*
 * connect_to_lmt_database()
 * Connects to the LMT database and stores the connection in $LMT_DB
 */
function connect_to_lmt_database() {
	global $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $LMT_DB_DATABASE, $TIMEZONE, $LMT_DB;
	$LMT_DB = mysql_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD) or trigger_error(mysql_error(), E_USER_ERROR);
	mysql_select_db($LMT_DB_DATABASE, $LMT_DB) or trigger_error(mysql_error(), E_USER_ERROR);
	
	$query = 'SET time_zone = "' . mysql_real_escape_string($TIMEZONE) . '"';
	mysql_query($query, $LMT_DB) or trigger_error(mysql_error($LMT_DB), E_USER_ERROR);
}





/*
 * lmt_query($query, $get_row=false)
 * Executes the specified query and returns the result. If $get_row is set to true,
 * a row will be returned; if there is not exactly one row, an error will be thrown.
 */
function lmt_query($query, $get_row=false) {
	global $LMT_DB;
	$result = mysql_query($query, $LMT_DB)or
		trigger_error(mysql_error($LMT_DB) . '<br /><strong>Query:</strong> '. htmlentities($query) . '<br />', E_USER_ERROR);
	
	if (!$get_row)
		return $result;
	
	// Get row
	if (mysql_num_rows($result) != 1)
		trigger_error('Incorrect number of rows for [' . $query . ']', E_USER_ERROR);
	return mysql_fetch_assoc($result);
}





/*
 * map_value($key)
 * Returns the value associated with the given key
 * in the LMT map, or null if it does not exist.
 */
function map_value($key) {
	$result = lmt_query('SELECT map_value FROM map WHERE map_key="'
		. mysql_real_escape_string(strtolower($key)) . '"');
	
	if (mysql_num_rows($result) == 0)
		return null;
	
	$row = mysql_fetch_assoc($result);
	return $row['map_value'];
}





/*
 * map_set($key, $value)
 * Sets the value for a given key, creating the pair
 * if it does not already exist
 */
function map_set($key, $value) {
	if (map_value($key) === null)
		lmt_query('INSERT INTO map (map_key, map_value) VALUES("'
			. mysql_real_escape_string(strtolower($key)) . '", "'
			. mysql_real_escape_string($value) . '")');
	else
		lmt_query('UPDATE map SET map_value="'
			. mysql_real_escape_string($value) . '" WHERE map_key="'
			. mysql_real_escape_string(strtolower($key)) . '" LIMIT 1');
}





/*
 * backstage_is_open()
 * Returns true if the backstage is open to all members, else false
 */
function backstage_is_open() {
	return htmlentities(map_value('backstage')) == '1';
}





/*
 * registration_is_open()
 * Returns true if registration is open, else false
 */
function registration_is_open() {
	return htmlentities(map_value('registration')) == '1';
}





/*
 * scoring_is_enabled()
 * Returns true if score entry is enabled, else false
 */
function scoring_is_enabled() {
	return htmlentities(map_value('scoring')) == '1';
}





/*
 * backstage_access()
 * Restricts access to logged-in members, but only when Backstage is enabled for them
 */
function backstage_access() {
	if (backstage_is_open())
		restrict_access('RLA');
	else
		restrict_access('A');
}





/*
 * scoring_access()
 * Restricts access if scoring is disabled
 */
function scoring_access() {
	global $path_to_lmt_root;
	if (!scoring_is_enabled())
		require_once $path_to_lmt_root . 'Backstage/Scoring_Frozen.php';
}





/*
 * lmt_reg_restrict_access($levels)
 * Like restrict_access, but for LMT registration
 *
 * $level
 * 	- 'X': not logged in
 * 	- 'L': logged in
 *  - '': either
 *
 * Also requires registration to be open
 */
function lmt_reg_restrict_access($level) {
	// Restrict access
	global $path_to_lmt_root;
	
	// Registration must be open
	if (!registration_is_open()) {
		header('Location: ' . $path_to_lmt_root);
		die();
	}
	
	// Check permissions
	if ($level == 'X' && isSet($_SESSION['LMT_user_id'])) {
		header('Location: ' . $path_to_lmt_root . 'Registration');
		die();
	}
	
	if ($level == 'L' && !isSet($_SESSION['LMT_user_id'])) {
		header('Location: ' . $path_to_lmt_root . 'Registration');
		die();
	}
}





/*
 * add_alert($name, $value)
 * Adds an alert to Session storage that is displayed when
 * another page calls fetch_alert($name)
 */
function add_alert($name, $value) {
	if(@!$_SESSION['LMT_ALERT_' . $name])$_SESSION['LMT_ALERT_' . $name]=array();
	$_SESSION['LMT_ALERT_' . $name][] = $value;
}





/*
 * fetch_alert($name)
 * Returns code to show a saved alert if it exists
 */
function fetch_alert($name) {
	if (isSet($_SESSION['LMT_ALERT_' . $name])) {
		$message='';
		foreach($_SESSION['LMT_ALERT_' . $name] as $alert){
			$message .= "\n        <div class=\"alert\">{$alert}</div><br />\n";
		}
		unset($_SESSION['LMT_ALERT_' . $name]);
		return $message;
	}
	return '';
}





/*
 * validate_email($email)
 * Returns true if the email is valid, else an error.
 * Should be performed after a reCaptcha check, if necessary.
 */
function validate_email($email) {
	if (!preg_match('/^([\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*[\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]'
		.'+@((((([a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,6})|(\d{1,3}\.){3}\d{1,3}(\:\d{1,5})?)$/i'
		, $email))
		return 'That\'s not a valid email address';
	
	$row = lmt_query('SELECT COUNT(*) FROM individuals WHERE LOWER(email)="'
		. mysql_real_escape_string(strtolower($email)) . '"', true);
	if ($row['COUNT(*)'] != 0)
		return 'An account with that email address already exists';
			
	return true;
}





/*
 * validate_coach_email($email)
 * Returns true if the email is valid, else an error.
 * Should be performed after a reCaptcha check, if necessary.
 */
function validate_coach_email($email) {
	//Todo: once safe DB is implemented, use if(filter_var($email,FILTER_VAR_EMAIL)===false)return 'That\'s not a valid email address';
	if (!preg_match('/^([\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*[\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]'
		.'+@((((([a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,6})|(\d{1,3}\.){3}\d{1,3}(\:\d{1,5})?)$/i'
		, $email))
		return 'That\'s not a valid email address';
	
	$row = lmt_query('SELECT COUNT(*) FROM schools WHERE LOWER(coach_email)="'
		. mysql_real_escape_string(strtolower($email)) . '"', true);
	if ($row['COUNT(*)'] != 0)
		return 'An account with that email address already exists';
			
	return true;
}





/*
 * validate_name($name)
 * Returns true if the name is valid, else else an error.
 */
function validate_name($name) {
	if ($name == '')
		return 'Your name cannot be blank';
	if (strlen($name) > 25)
		return 'Your name is too long';
	if (!preg_match('/^[A-Za-z\s\-]+$/', $name))
		return 'Names may only contain letters, hyphens and spaces';
	return true;
}





/*
 * validate_school_name($name)
 * Returns true if the school name is valid, else else an error.
 */
function validate_school_name($name) {
	if ($name == '')
		return 'The school name cannot be blank';
	if (strlen($name) > 35)
		return 'The school name is too long';
	if (!preg_match('/^[A-Za-z\s]+$/', $name))
		return 'School names may only contain letters, hyphens and spaces';
	return true;
}





/*
 * validate_team_name($name)
 * Returns true if the team name is valid, else else an error.
 */
function validate_team_name($name) {
	if ($name == '')
		return 'The team name cannot be blank';
	if (strlen($name) > 25)
		return 'The team name is too long';
	if (!preg_match('/^[A-Za-z0-9\s]+$/', $name))
		return 'Team names may only contain letters, numbers, hyphens and spaces';
	return true;
}





/*
 * validate_member_name($name)
 * Returns true if the name is valid, else else an error.
 */
function validate_member_name($name) {
	if ($name == '')
		return 'The name cannot be blank';
	if (strlen($name) > 25)
		return 'The name is too long';
	if (!preg_match('/^[A-Za-z\s]+$/', $name))
		return 'Names may only contain letters, hyphens and spaces';
	return true;
}





/*
 * validate_password($password, $verify)
 * Returns true if the grade is valid, else else an error.
 */
function validate_password($password, $verify) {
	if ($password != $verify)
		return 'Passwords do not match';
	if (strlen($password) < 6)
		return 'Password must contain at least six characters';
	return true;
}





/*
 * validate_recaptcha()
 * Returns true if the recaptcha was entered correctly, else else an error.
 */
function validate_recaptcha() {
	global $RECAPTCHA_PRIVATE_KEY, $path_to_root;
	require_once $path_to_root . 'lib/recaptchalib.php';
	$recaptcha_response = recaptcha_check_answer(	$RECAPTCHA_PRIVATE_KEY,
													$_SERVER['REMOTE_ADDR'],
													$_POST['recaptcha_challenge_field'],
													$_POST['recaptcha_response_field']);
	if (!$recaptcha_response->is_valid)
		return 'You entered the reCaptcha incorrectly';
	return true;
}





/*
 * validate_grade($grade)
 * Returns true if the passwords are valid, else else an error.
 */
function validate_grade($grade) {
	if ($grade != '6' && $grade != '7' && $grade != '8')
		return 'That\'s not a valid grade';
	return true;
}





/*
 * lmt_hash_pass($email, $pass)
 *  - $email: the email address, used to salt the hash
 *  - $pass: the password that was entered
 *  - returns: a 128-character hash that is UNIQUE to this particular
 *      email/password combination
 *
 *  To protect the security of passwords in case the database is
 *  compromised, password are hashed before storage. To validate a
 *  email/password pair, hash them and then compare it to the stored
 *  passhash for that user.
 */
function lmt_hash_pass($email, $pass) {
	global $SECRET_SALT;
	$hash = hash('sha512', 'lhsmath-lmt $4Sosnd90f2q983hOASKLNnlea0[pw4tnh9sra90fgbniodfil;bnklwfahsdf MDLGeUD)}:"mlAt9kekTiaET!mcmVQYTJlk;TdYZJS1aqo' . $email);
	$hash = hash('sha512', $hash . ' lhsmath 2BATHJ0G61o23#%zEHEw];.2a46893QW0SmXAsf8990)bcjtPQI%&#RjjANLpyz' . $pass);
	return hash('sha512', $hash . ' lhsmath elEf\89nisdfan,ksefay90er#%.*()eVvBO6' . $pass . ';Rjz@um3FbPj#$89WnYVil;\'[p0-wj\=-iosdionC7x42M4hUFd' . $SECRET_SALT);
}





/*
 * lmt_send_email($to, $subject, $body, $reply_to)
 *  - $to: who to send the email to, as: 'Name <email@address>' (no quotes)
 *  - $subject: the subject line; '[LMT {YEAR}]'  is automatically prefixed
 *  - $body: the body of the message
 */
function lmt_send_email($to, $subject, $body){
	global $LMT_EMAIL;
	send_email($to,'[LMT '.intval(map_value('year')).'] '.$subject,$body,array($LMT_EMAIL=>'LMT Contact'),'Lexington Math Tournament\n'.get_site_url().'/LMT');
}





/*
 * Used in email lists
 */
function lmt_send_multipart_list_email($bcc_list, $subject, $txt_body, $html_body, $reply_to, $list_id) {
	global $EMAIL_ADDRESS, $EMAIL_USERNAME, $EMAIL_PASSWORD,
		$SMTP_SERVER, $SMTP_SERVER_PORT;
	require_once('Mail.php');
	require_once('Mail/mime.php');
	
	$from = 'LMT Mailbot <'.$EMAIL_ADDRESS.'>';
	$to = 'LMT Mailbot <' . $EMAIL_ADDRESS . '>';
	$subject = '[LMT ' . htmlentities(map_value('year')) . '] ' . $subject;
	
	$site_url = get_site_url() . '/LMT';
	$txt_body .= <<<HEREDOC


---
Lexington Mathematics Tournament
$site_url

You received this email because you registered for the LMT. To unsubscribe, please contact lmt@lhsmath.org
HEREDOC;

	$html_body =  <<<HEREDOC
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
  </head>
  <body>
$html_body
    <br />
    <br />
    ---<br />
    Lexington Mathematics Tournament<br />
    $site_url<br />
    <br />
    You received this email because you are registered for the LMT. To unsubscribe, please
    contact <a href="mailto:lmt@lhsmath.org">lmt@lhsmath.org</a>.
  </body>
HEREDOC;
	
	$headers = array('From' => $from,
		'To' => $to,
		'Reply-To' => $reply_to,
		'Subject' => $subject,
		'Precedence' => 'bulk',
		'List-Id' => $list_id,
		'List-Unsubscribe' => '<' . $reply_to . '>');
	
	$mime = new Mail_mime();
	$mime->setTXTBody($txt_body);
	$mime->setHTMLBody($html_body);
	$body = $mime->get();
	$headers = $mime->headers($headers);
	
	$smtp = Mail::factory('smtp',
		array('host' => $SMTP_SERVER,
			'port' => $SMTP_SERVER_PORT,
			'auth' => true,
			'username' => $EMAIL_USERNAME,
			'password' => $EMAIL_PASSWORD));
	$mail = $smtp->send($bcc_list, $headers, $body);
	
	if (PEAR::isError($mail))
		trigger_error('Error sending email: ' . $mail->getMessage(), E_USER_ERROR);
}





/*
 * lmt_set_login_data($id)
 *  - $row: the result of mysql_fetch_assoc() on the query 'SELECT * FROM users WHERE id="..."'
 *
 * Sets the SESSION variables that contain a logged-in user's information
 */
function lmt_set_login_data($id) {
	if (!isSet($_SESSION['LMT_user_id'])) {
		// ** THIS IS A LOG-IN, NOT A REFRESH OF EXISTING DATA, SO... ***
		session_destroy();  // clear any stored data
		session_name('Session');
		session_start();
		session_regenerate_id(true);  // change session id to prevent hijacking
	}
	
	$row = lmt_query('SELECT * FROM schools WHERE school_id="' . mysql_escape_string($id) . '" LIMIT 1', true);
	
	$_SESSION['LMT_school_name'] = $row['name'];
	
	// REFRESH TIME
	$_SESSION['LMT_last_refresh'] = time();
	
	if (!isSet($_SESSION['LMT_user_id'])) {
		// ** THIS IS A LOG-IN, NOT A REFRESH OF EXISTING DATA, SO... ***
		$_SESSION['LMT_login_time'] = time();
		$_SESSION['LMT_user_id'] = $row['school_id'];	// the actual log-in
	}
}





/*
 * lmt_db_table($query, $headers=null, $links=null, $empty_message="None", $css="contrasting")
 * 	- $query: the query to execute
 * 	- $headers: an associative array of row names to headers; null for no headers
 *	- $links: an associative array of names to URLs ({field_name} is replaced with the value of that field)
 *	- $empty_message: what to show when no rows match
 *	- $css: a string containing space-separated classes to apply to the table
 *	- $ordering: Up and down arrows (hidden by a NULL value); contains an associative array of:
 *		- page: the page which, when passed ?Up or ?Down and an XSRF token, will change the order
 *			of the list items
 *		- field: the name of the field that contains the ID to pass
 *
 *	returns XHTML code for the table
 */
function lmt_db_table($query, $headers=null, $links=null, $empty_message="None", $css="contrasting", $ordering=null) {
	global $LMT_DB;
	$result = lmt_query($query);
	
	$return = <<<HEREDOC
      <table class="$css">

HEREDOC;
	
	if (!is_null($headers)) {
		$return .= "        <tr>\n";
		
		foreach ($headers as $header)
			$return .= "          <th>$header</th>\n";
		
		for ($i = 0; $i < count($links); $i++)
			$return .= "          <th></th>\n";
		
		$return .= "        </tr>\n";
	}
	
	$row = mysql_fetch_assoc($result);
	$row_number = 0;
	
	if (!$row) {
		if (!is_null($headers))
			$colspan = count($headers) + count($links);	// count(null) == 0
		else
			$colspan = mysql_num_fields($result) + count($links);
		$return .= <<<HEREDOC
        <tr>
          <td colspan="$colspan">$empty_message</td>
        </tr>

HEREDOC;
	}
	
	while ($row) {
		$return .= "        <tr>\n";
		
		if (!is_null($ordering)) {
			if ($row_number != 0)
				$return .= '          <td class="text-centered"><a href="' . $ordering['page'] . '?Up&amp;ID=' . $row[$ordering['field']]
					. '&amp;xsrf_token=' . $_SESSION['xsrf_token'] . '" class="nounderline">&nbsp;&uarr;&nbsp;</a></td>' . "\n";
			else
				$return .= "          <td></td>\n";
				
			if ($row_number != mysql_num_rows($result) - 1)
				$return .= '          <td class="text-centered"><a href="' . $ordering['page'] . '?Down&amp;ID=' . $row[$ordering['field']]
					. '&amp;xsrf_token=' . $_SESSION['xsrf_token'] . '" class="nounderline">&nbsp;&darr;&nbsp;</a></td>' . "\n";
			else
				$return .= "          <td></td>\n";
		}
		
		if (!is_null($headers))
			foreach ($headers as $field=>$header)
				$return .= "          <td>" . htmlentities($row[$field]) . "</td>\n";
		else
			foreach ($row as $field=>$value)
				$return .= "          <td>" . htmlentities($value) . "</td>\n";
		
		if (!is_null($links)) {
			foreach ($links as $link=>$url) {
				foreach ($row as $field=>$value) {
					$link = str_replace('{' . $field . '}', $value, $link);
					$url = str_replace('{' . $field . '}', $value, $url);
					$field = mysql_fetch_field($result);
				}
				$return .= "          <td><a href=\"$url\">$link</a></td>\n";
			}
		}
		
		$return .= "        </tr>\n";
		
		$row = mysql_fetch_assoc($result);
		$row_number++;
	}
	
	$return .= "      </table>\n";
	return $return;
}





/*
 * lmt_page_header($title)
 *  - $title: the title of the page, which is shown in the browser's
 *      titlebar. The string ' | LMT' is appended to the end.
 *
 *  Echoes the top half of the page template (that comes before the content).
 */
function lmt_page_header($title) {
	global $path_to_root, $body_onload, $use_rel_external_script, $jquery_function, $javascript, $LOCAL_BORDER_COLOR, $header_noprint, $meta_refresh;
	
	$logged_in_header = '';
	if (isSet($_SESSION['user_id']))
		$logged_in_header = <<<HEREDOC

      <div id="user"><span id="username">{$_SESSION['user_name']}</span><span id="bar"> | </span><a href="{$path_to_root}Account/Signout">Sign Out</a></div>
HEREDOC;
	
	$rel_external_script = '';
	if ($use_rel_external_script)
		$rel_external_script = <<<HEREDOC

    <script type="text/javascript" src="{$path_to_root}res/rel_external.js"></script>
HEREDOC;
	
	if ($body_onload != '')
		$body_onload = ' onload="' . $body_onload . '"';
	
	$jquery_code = '';
	if ($jquery_function != '') {
	
	$jquery_code = <<<HEREDOC

    <link rel="stylesheet" href="{$path_to_root}res/jquery/css/smoothness/jquery-ui-1.8.5.custom.css" type="text/css" media="all" />
    <script type="text/javascript" src="{$path_to_root}res/jquery/js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="{$path_to_root}res/jquery/js/jquery-ui-1.8.5.custom.min.js"></script>
    <script type="text/javascript">
$jquery_function
    </script>
    <style type="text/css">
      .ui-datepicker, .ui-autocomplete {
        font-size: 12px;
      }
    </style>
HEREDOC;
	}
	
	if (isSet($meta_refresh))
		$meta_refresh = '<meta http-equiv="refresh" content="' . $meta_refresh . '" />';
	
	if (isSet($LOCAL_BORDER_COLOR))
		$local_border_code = ' style="border-bottom: 4px solid ' . $LOCAL_BORDER_COLOR . '"';
	
	if ($javascript != '')
		$javascript = "\n" . '    <script type="text/javascript">' . "\n" . $javascript . "\n" . '</script>';
	
	if (isSet($header_noprint))
		$header_noprint = ' class="noPrint"';
	
	echo <<<HEREDOC
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>$title | LMT</title>
    <link rel="icon" href="{$path_to_root}favicon.ico" />
    <link rel="stylesheet" href="{$path_to_root}res/default.css" type="text/css" media="all" />
    <link rel="stylesheet" href="{$path_to_root}res/lmt.css" type="text/css" media="all" />
    <link rel="stylesheet" href="{$path_to_root}res/print.css" type="text/css" media="print" />$rel_external_script$jquery_code$javascript$meta_refresh
  </head>
  <body$body_onload>
    <div id="header"$local_border_code$header_noprint>
      <a href="{$path_to_root}LMT/About" id="title">Lexington Math Tournament</a>$logged_in_header
    </div>
    
    <div id="content">

HEREDOC;
}





/*
 * lmt_page_footer($page_name)
 */
function lmt_page_footer($page_name) {
	if ($page_name == 'About')  {
		$names[] = 'Math Club Home';
		$pages[] = 'Home';
		
		global $BACKSTAGE_OPEN;
		if ($_SESSION['permissions'] == 'A' ||
			(($_SESSION['permissions'] == 'R' || $_SESSION['permissions'] == 'L') && backstage_is_open()))  {
			$names[] = 'Backstage';
			$pages[] = 'LMT/Backstage/Home';
		}
		$names[] = '';
		$pages[] = '';
	}
	
	
	$result = lmt_query('SELECT page_id, name FROM pages ORDER BY order_num');
	$row = mysql_fetch_assoc($result);
	
	while ($row) {
		if ($row['page_id'] == '-1') {
			if (registration_is_open()) {
				$names[] = 'Registration';
				$pages[] = 'LMT/Registration/Home';
				
				$names[] = '';
				$pages[] = '';
			}
		}
		else if ($row['name'] == '') {
			$names[] = '';
			$pages[] = '';
		}
		else {
			$names[] = $row['name'];
			$pages[] = 'LMT/' . str_replace(' ', '_', $row['name']);
		}
		$row = mysql_fetch_assoc($result);
	}
	
	if(($n=array_search($page_name,$names))!==false)$pages[$n]='';
	
	page_footer($names, $pages);
}





/*
 * lmt_backstage_footer($page_name)
 */
function lmt_backstage_footer($page_name) {
	$names = array('LMT Home','Backstage Home','','Check-in','Score Entry','Guts Round','Results','','Data','Verification','Backup');
	$pages = array('LMT/About','LMT/Backstage/Home','','LMT/Backstage/Checkin/Home','LMT/Backstage/Scoring/Home',
		'LMT/Backstage/Guts/Home','LMT/Backstage/Results/Full','','Data','LMT/Backstage/Data/Home',
		'LMT/Backstage/Database/Verify','LMT/Backstage/Database/Backup');
	
	if ($_SESSION['permissions'] == 'A') {
		array_splice($names,2,0,array('','Status','Website','Email','Export'));
		array_splice($pages,2,0,array('','LMT/Backstage/Status','LMT/Backstage/Pages/List','LMT/Backstage/Email/Home','LMT/Backstage/Export'));
	}
	
	if(($n=array_search($page_name,$names))!==false)$pages[$n]='';
	
	page_footer($names, $pages);
}





/*
 * lmt_home_footer($page_name)
 */
function lmt_home_footer() {
	$names = array('About');
	$pages = array('LMT/About');
	
	page_footer($names, $pages);
}

?>