<?php
/*
 * lib/lmt-functions.php
 * LHS Math Club Website
 */

if (!isSet($path_to_root))
	$path_to_root = '../'.$path_to_lmt_root; //this is wrong

require_once $path_to_root . 'lib/CONFIG.php';


// include regular functions
require_once $path_to_root . 'lib/functions.php';
require_once $path_to_root . 'lib/lmt-scoring.php';

DB::useDB('lmt');

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
if (isSet($_SESSION['LMT_user_id']) && isSet($_SESSION['LMT_login_time']) && time() >= $_SESSION['LMT_login_time'] + 7200)
	die('Signing Out... | ' . $_SESSION['LMT_user_id'] . ' | ' . $_SESSION['LMT_login_time'] . ' | ' . time());
	//header('Location: ' . $path_to_lmt_root . 'Registration/Signout');



/*
 * map_value($key)
 * Returns the value associated with the given key
 * in the LMT map, or null if it does not exist.
 *
 * Map, as in a "mapping" in math. Makes life easier
 * if there's some data to be played with.
 */
$map_values=NULL;
$map_values_changed=false;
function map_value($key) {
	global $map_values;
	if($map_values===NULL)//Caching
		$map_values=DBHelper::verticalSlice(DB::query('SELECT map_key, map_value FROM map'),'map_value','map_key');
	
	if(array_key_exists(strtolower($key),$map_values))
		return $map_values[strtolower($key)];
	else return NULL;
}

/*
 * map_set($key, $value)
 * Sets the value for a given key, creating the pair
 * if it does not already exist
 */
function map_set($key, $value) {
	global $map_values,$map_values_changed;
	if($map_values===NULL)map_value(0);//Load stuff into $map_values
	$map_values_changed=true;
	$map_values[strtolower($key)]=$value;
}
/*
 * map_commit()
 * Shutdown function that should not be used normally, but can be.
 * Commits all the changes to the database, since PHP globals are faster than DB storage.
 * May cause race condition problems (e.g. if it runs too long and a cached version is not up to date)
 * but there aren't that many admins.
 *
 * Note: The field map_key must be a primary key.
 */
function map_commit(){
	global $map_values,$map_values_changed;
	if($map_values===NULL||!$map_values_changed)return;//If we haven't loaded anything, or we haven't changed anything, nothing happens.
	
	$insertions=array();
	foreach($map_values as $key=>$value)
		$insertions[]=array('map_key'=>$key,'map_value'=>$value);
	
	DB::insertUpdate('map',$insertions,'map_value=VALUES(map_value)');
	
	$map_values_changed=false;
}
register_shutdown_function('map_commit');





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
	// Registration must be open
	if (!registration_is_open())
		lmt_location('');
	// Check permissions
	if ($level == 'X' && isSet($_SESSION['LMT_user_id']))
		lmt_location('Registration');
	if ($level == 'L' && !isSet($_SESSION['LMT_user_id']))
		lmt_location('Registration');
}

function lmt_location($s){
	location('LMT/'.$s);
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
	if (!val('e',$email))
		return 'That\'s not a valid email address';
	
	$c = DB::queryFirstField('SELECT COUNT(*) AS c FROM individuals WHERE LOWER(email)=%s',strtolower($email));
	if ($c) return 'An account with that email address already exists';
	
	return true;
}





/*
 * validate_coach_email($email)
 * Returns true if the email is valid, else an error.
 * Should be performed after a reCaptcha check, if necessary.
 */
function validate_coach_email($email) {
	if(!val('e',$email))return 'That\'s not a valid email address';
	
	$c = DB::queryFirstField('SELECT COUNT(*) AS c FROM schools WHERE LOWER(coach_email)=%s',strtolower($email));
	if ($c) return 'An account with that email address already exists';
			
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
 * Returns true if the passwords match and are long enough, else an error.
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
 * Returns true if the grade is valid, else else an error.
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
function lmt_send_email($to, $subject, $body, $reply_to = NULL){
	global $LMT_EMAIL;
	if($reply_to === NULL)$reply_to = $LMT_EMAIL;
	send_email($to,$subject,$body,$reply_to,'[LMT '.intval(map_value('year')).']',"Lexington Math Tournament\n".get_site_url().'/LMT');
}






function lmt_send_list_email($bcc_list, $subject, $body, $list_id){
	global $LMT_EMAIL;
	$site_url = str_replace(array('http://www.','http://'), '', get_site_url());
	return send_email($bcc_list, $subject, $body,
		array($LMT_EMAIL=>'LMT Contact'),
		'[LMT '.intval(map_value('year')).'] ',
		"\n\n\n---\nLexington Mathematics Tournament\n[url]".get_site_url()."/LMT[/url]\n\nYou received this email because you registered for the LMT. To unsubscribe, please contact [email]lmt@lhsmath.org.[/email]",
		array(
			'Precedence' => 'bulk',
			'List-Id' => $list_id,
			'List-Unsubscribe' => '<' . $list_id . '.lmt.'.$site_url.'>'
		)
	);
}
function lmt_send_individuals_email($subject,$body){
	$result = DB::query('SELECT name, email FROM individuals WHERE email != "" AND deleted="0"');
	$list = DBHelper::verticalSlice($result,'email','name');
	
	return lmt_send_list_email($list,$subject,$body,'individuals');
}
function lmt_send_coaches_email($subject,$body){
	$result = DB::query('SELECT name, email FROM coaches WHERE email != "" AND deleted="0"');
	$list = DBHelper::verticalSlice($result,'email','name');
	
	return lmt_send_list_email($list,$subject,$body,'coaches');
}




/*
 * lmt_set_login_data($id)
 *  - $row: the result of mysqli_fetch_assoc() on the query 'SELECT * FROM users WHERE id="..."'
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
	
	$_SESSION['LMT_last_refresh'] = time();
	
	if (!isSet($_SESSION['LMT_user_id'])) {
		$row = DB::queryFirstRow('SELECT name, school_id FROM schools WHERE school_id=%i LIMIT 1', $id);
		if(!$row)trigger_error('Invalid login.',E_USER_ERROR);
		
		$_SESSION['LMT_school_name'] = $row['name'];
		
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
	$result = DB::queryRaw($query);//--todo--this is evil
	
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
	
	$row = $result->fetch_assoc();
	$row_number = 0;
	
	if (!$row) {
		if (!is_null($headers))
			$colspan = count($headers) + count($links);	// count(null) == 0
		else
			$colspan = $result->field_count + count($links);
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
				
			if ($row_number != $result->num_rows - 1)
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
					//$field = $result->fetch_field();
				}
				$return .= "          <td><a href=\"$url\">$link</a></td>\n";
			}
		}
		
		$return .= "        </tr>\n";
		
		$row=$result->fetch_assoc();
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
 *  Sets some stuff which is passed to the templateify() shutdown function.
 */
function lmt_page_header($title) {
	global $path_to_root;
	
	global $page_title;
	$page_title = $title;
	
	global $header_title;
	$header_title = 'Lexington Math Tournament';
	
	global $logged_in_header;
	if(isSet($_SESSION['LMT_user_id']))
		$logged_in_header = <<<HEREDOC
		<div id="user"><span id="username">School: {$_SESSION['LMT_school_name']}</span><span id="bar"> | </span><a href="{$path_to_root}LMT/Registration/Signout">Log Out</a></div>
HEREDOC;
	
	global $more_head_stuff;
	$more_head_stuff.='<link rel="stylesheet" href="'.$path_to_root.'res/lmt.css" type="text/css" media="all" />';
	
	global $jquery_function, $javascript;
	$jquery_function .= $javascript;
	
	global $header_noprint, $header_class;
	if (isSet($header_noprint))
		$header_class = 'noPrint';
}





/*
 * lmt_page_footer($page_name)
 */
function lmt_page_footer($page_name) {
	if ($page_name == 'About')  {
		$names[] = 'Math Club Home';
		$pages[] = 'Home';
		
		global $BACKSTAGE_OPEN;
		if (array_key_exists('permissions',$_SESSION) && (user_access('A') || 
			(user_access('RL') && backstage_is_open()))) {
			$names[] = 'Backstage';
			$pages[] = 'LMT/Backstage/Home';
		}
		$names[] = '';
		$pages[] = '';
	}
	
	$result = DB::queryRaw('SELECT page_id, name FROM pages ORDER BY order_num');
	
	while ($row = $result->fetch_assoc()) {
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
		'LMT/Backstage/Guts/Home','LMT/Backstage/Results/Full','','LMT/Backstage/Data/Home',
		'LMT/Backstage/Database/Verify','LMT/Backstage/Database/Backup');
	
	if (user_access('A')) {
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