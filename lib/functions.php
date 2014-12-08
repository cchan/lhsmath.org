<?php
/*
 * lib/functions.php
 * LHS Math Club Website
 *
 * A library of functions. All pages should require_once this file.
 * Loading this file will also perform the following default actions:
 *  - hide the '.php' extension in the URL
 *  - start a session
 *  - connect to the (Meekro-style DB::)database
 *  - attach custom_errors as custom error handler if $CATCH_ERRORS is true.
 *  - Initialize a bunch of config variables
 *
 * Dependencies: $path_to_root defined as the relative path to the root directory of the site.
 * For example, the admin page '/Admin/blah.php' needs to have at the top:
 * 		$path_to_root = '../';								//Define the path_to_root to get to the root directory INCLUDING trailing slash
 * 		require_once $path_to_root . 'lib/functions.php';	//require_ONCE the functions.php library
 * 		restrict_access('A');								//Restrict access to admins only.
 
 
 Hints for Debugging:
 debug_print_backtrace(), register_shutdown_function(), set_error_handler() -- put these in various locations and move it around to locate the problem
 Google, PHP.net, StackOverflow, past webmasters
 Looking for cautionary comments [e.g. "I hate mail config $#%^$%#"]
 */
 
 /*
 Table of Contents and Descriptions
 
 ---todo--- come up with universal standard naming conventions - UpperCamelCase for function names plz
 */

//CONFIG only defines global variables. Nothing else.
require_once $path_to_root . 'lib/CONFIG.php';	// configuration information
	set_include_path(get_include_path() . PATH_SEPARATOR . $ADD_INCLUDE_PATH);//Extra include path specified in CONFIG
	date_default_timezone_set($TIMEZONE);//Timezone setting in CONFIG

//These are only allowed to define functions and classes, and require files subject to the same constraints.
require_once $path_to_root . 'lib/functions.data.php';//All data-management stuff - sanitation, validation, $_POST/$_GET/$_SESSION.

require_once $path_to_root . 'lib/functions.mail.php';

require_once $path_to_root . 'lib/functions.autocomplete.php';

require_once $path_to_root . 'lib/functions.users.php';
	 /*
	 User Types
	 *    * 'A': Administrative (Captains, Advisor and Webmaster)
	 *    * 'R': Regular (approved users)
	 *    * 'P': Pending approval
	 *    * 'B': Banned
	 *    * 'E': Email verification pending
	 *    * '+': Super-Admin (LHSMATH account)
	 *    * 'L': Alumnus
	 *    * 'X': Logged-out user
	 *    * 'T': Temporary user (should not be able to log in)
	 */

require_once $path_to_root . 'lib/functions.db.php';
	DB::$host = $DB_SERVER; //defaults to localhost if omitted
	DB::$user = $DB_USERNAME;
	DB::$password = $DB_PASSWORD;
	DB::$dbName = $DB_DATABASE;
	DB::$error_handler = 'db_error_handler';

require_once $path_to_root . 'lib/functions.template.php';

/*
 * custom_errors($errno, $errstr, $errfile, $errline)
 *
 * Logs errors and shows an error page
 */
$show_debug_backtrace = false;
set_error_handler(function($errno, $errstr, $errfile, $errline) {
	global $CATCH_ERRORS;
	
	//Being safe: https://stackoverflow.com/questions/16655453/change-php-behavior-for-undefined-constants
	if(stripos($errstr, 'Use of undefined constant') !== FALSE){
        trigger_error($errstr, E_USER_ERROR);//Undefined consts automatically become strings, which is really bad. Elevate it to a fatal error.
        return TRUE;
    }
	
	if(stripos($errstr, 'Undefined variable')){
		trigger_error($errstr, E_USER_NOTICE);//Whatever, doesn't matter, but log it anyway
		return TRUE;
	}
	
	//Generate error text
	$err = ' DATE:' . date(DATE_RFC822) . ' IP:' . $_SERVER['REMOTE_ADDR'] . ' Error [#' . $errno . '] on line ' . $errline . ' in ' . $errfile . ': ' . $errstr . "\n";
	
	//Log it in the proper file
	global $path_to_root;
	file_put_contents($path_to_root . '.content/Errors.txt', $err, FILE_APPEND);
	
	if(!$CATCH_ERRORS){//If catching errors is disabled, dump everything out.
		alert($err,-1);
		global $show_debug_backtrace; //Insert anywhere: "global $show_debug_backtrace;$show_debug_backtrace=true;" and it'll do it.
		if($show_debug_backtrace)var_dump(debug_backtrace());
		return;
	}
	
	if($errno & (E_USER_NOTICE | E_USER_WARNING | E_WARNING | E_NOTICE))
		return; //Just a notice/warning, not worth bothering the user for
	
	if (headers_sent())//Headers were already sent; we can't tell the browser HTTP/1.1 500 Internal Server Error
		echo '<meta http-equiv="refresh" content="0;url=' . $path_to_root . 'Error">';
	elseif (isSet($_GET['xsrf_token']))//So we don't resubmit with the xsrf_token again and cause infinite error generation.
		header('Location: ' . $path_to_root . 'Error');
	else {
		header("HTTP/1.1 500 Internal Server Error");
		page_title('Error');
		echo <<<HEREDOC
      <h1>Error</h1>
      
      Whoops! Something went wrong. Try again?
HEREDOC;
	}
	
	die;
}, E_ALL);
error_reporting(E_ALL);
/*else{function a(){debug_print_backtrace();}function b(){global $a;if($a)echo var_dump($a);}
function c(){global $a;if(!$a)$a=array();$a[]=debug_backtrace();}set_error_handler('a',E_ALL&!E_NOTICE);
register_shutdown_function('b');}*/ //Debug backtracing; put c() wherever to output; will also output on program end


// check IP ban list
if (in_array(strtolower($_SERVER['REMOTE_ADDR']), $BANNED_IPS)) {
	session_name('Session');
	session_start();
	session_destroy();
	
	$_SESSION['permissions'] = 'B';
	require_once $path_to_root . 'Account/Banned.php';
}

// hide .PHP extension (/Home.php -> /Home - this works because of a URL Rewrite in the .htaccess file)
@$url_pieces = parse_url($_SERVER['REQUEST_URI']);
if ($url_pieces != false && basename($url_pieces['path']) != basename($url_pieces['path'], '.php')){
	$url = basename($url_pieces['path'], '.php');
	if (isSet($url_pieces['query']))
		$url .= '?' . $url_pieces['query'];
	header('Location: ' . $url);
}

// start a session
session_name('Session');
session_start();


// all sessions have an XSRF-protection token that should be
// submitted with all forms via invisible field.
//
// Hypothetical scenario: User logs into our site, and sometime later
// accesses EvilSite.com, which loads a form much like
// the one used to send emails, then uses javascript to submit
// it. The action of the form is set to lhsmath/Account/Confirm_Email.
// The user's browser sends the request to us, along with the right
// cookes - so the request looks just like one that came from our site.
// Email is sent. Repeat 500x; spam (and a waste of server time) ensues.
//
// To make sure that the only forms we accept were actually requested by
// the user, we include a secret code in the form, which must match the
// one stored in SESSION (therefore, we had to have generated the form ourselves)
if (!isSet($_SESSION['xsrf_token']))
	$_SESSION['xsrf_token'] = generate_code(20);


// lock session to IP address
if (!isSet($_SESSION['ip_address']))
	$_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];

if ($_SESSION['ip_address'] != $_SERVER['REMOTE_ADDR']) {
	session_destroy();
	session_name('Session');
	session_start();
}


// refresh cached data (name, permissions) 15 sec. for people who are pending email verification or account approval
// and 1 min. for everyone else
if (isSet($_SESSION['user_id'])) {
	if (user_access('EP')) {
		if (time() >= $_SESSION['last_refresh'] + 15)
			set_login_data($_SESSION['user_id']);
	} else if (time() >= $_SESSION['last_refresh'] + 60)
		set_login_data($_SESSION['user_id']);
}

// everyone gets logged out after 8 hours, no matter what
if (isSet($_SESSION['user_id']) && time() >= $_SESSION['login_time'] + 28800) {
	session_destroy();
	session_name('Session');
	session_start();
}


/*
 * get_site_url()
 *  - returns: the url of the site (e.g. 'http://lhsmath.co.cc')
 */
function get_site_url() {
	$protocol = (isSet($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http';
	return $protocol . '://' . $_SERVER['HTTP_HOST'];
}
function get_relative_path(){//https://coderwall.com/p/gdam2w
	$dir = str_replace('\\','/',__DIR__);
    $request_uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
    $script_name = explode('/', trim($dir, '/'));array_pop($script_name);
    $parts = array_diff($request_uri, $script_name);
    if (empty($parts))
    {
        return '/';
    }
    $path = implode('/', $parts);
    if (($position = strpos($path, '?')) !== FALSE)
    {
        $path = substr($path, 0, $position);
    }
    return $path;
}


//Case-insensitive glob
//Turns search pattern ("amc","",".php") into globbed "[aA][mM][cC].php"
function globi($pattern, $base = '', $suffix = ''){
	//Pattern is case insensitive, 
	//$base and $suffix are prepended and appended and are case sensitive.
	$p = $base;
	$p .= preg_replace_callback('@[a-zA-Z]@i',function($matches){
		$l = $matches[0];//full match
		return '['.strtolower($l).strtoupper($l).']';
	},$pattern);
	$p .= $suffix;
	return glob($p);
}




function download($filepath){
	sendfile(basename($filepath),file_get_contents($filepath));
}
function sendfile($downloadname,$content){
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="' . $downloadname . '"');
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: ' . strlen($content));
	
	ob_clean();
	echo $content;
	
	cancel_templateify();
}

/*
USAGE:
make_table(
	"contrasting",
	array("name"=>"Name","email"=>"Email Address"),
	array(
		array("name"=>"Person","email"=>"asdf@asdf.com"),
		array("name"=>"Oinker","email"=>"oink@oink.org"),
		//...
	)
);
//Alternatively, you don't necessarily need associative indices as long as you keep everything in order yourself.

*/
function make_table($classes, $headers, $data){
	if(is_array($classes))$classes = implode(' ',$classes);
	$table = "<table class='$classes'>";
	
		$table .= "<tr>";
		$indices = array();
		foreach($headers as $index=>$header){//Header indices correspond to data indices.
			$indices[] = $index;
			$table .= "<th>$header</th>";
		}
		$table .= "</tr>";
		
		foreach($data as $row){
			$table .= "<tr>";
			
			foreach($indices as $index)
				if(array_key_exists($index,$row))
					$table .= "<td>{$row[$index]}</td>";
				else //No data for this row, just skip (e.g. with scoring comparison, maybe they just didn't take the test.)
					$table .= "<td>&nbsp;</td>";
			
			$table .= "</tr>";
		}
	
	$table .="</table>";
	
	return $table;
}



/*
 * email_obfuscate($address)
 * Returns javascript code for obfuscating an email address
 * Optionally, specify link text
 */
function email_obfuscate($address, $link_text=null, $pre_text='', $post_text='')
{
	if(is_null($link_text))$link_text=$address;
	return $pre_text."<a href='mailto:$address'>$link_text</a>".$post_text;
	
	$address = strtolower($address);
	$coded = "";
	$unmixedkey = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789.@";
	$len = strlen($unmixedkey);
	for ($i = 0; $i < $len; $i++)
		$unmixedkey.=$unmixedkey[rand(0,$len-1)];
	$cipher = substr($unmixedkey,$len,2*$len);

	$shift = strlen($address);

	$txt = "<script type=\"text/javascript\">\n" .
		   "          <!-"."-\n" .
		   "          // Email obfuscator script 2.1 by Tim Williams, University of Arizona\n".
		   "          // Random encryption key feature by Andrew Moulden, Site Engineering Ltd\n".
		   "          // PHP version coded by Ross Killen, Celtic Productions Ltd\n".
		   "          // This code is freeware provided these six comment lines remain intact\n".
		   "          // A wizard to generate this code is at http://www.jottings.com/obfuscator/\n".
		   "          // The PHP code may be obtained from http://www.celticproductions.net/\n\n";

	for ($j=0; $j<strlen($address); $j++)
	{
	if (strpos($cipher,$address{$j}) == -1 )
	{
		$chr = $address{$j};
		$coded .= $address{$j};
	}
	else
	{
		$chr = (strpos($cipher,$address{$j}) + $shift) % strlen($cipher);
		$coded .= $cipher{$chr};
	}
	}
	
	if (is_null($link_text)) {
		$js_link_text = '"+link+"';
		$ns_link_text = 'this address';
	}
	else {
		$js_link_text = $link_text;
		$ns_link_text = $link_text;
	}
	
	global $MAILHIDE_PUBLIC_KEY, $MAILHIDE_PRIVATE_KEY, $path_to_root;
	require_once $path_to_root . 'lib/recaptchalib.php';
	$mailhide_url = htmlentities(recaptcha_mailhide_url($MAILHIDE_PUBLIC_KEY, $MAILHIDE_PRIVATE_KEY, $address));
	
	$escaped_pre_text = str_replace('"', '\"', $pre_text);
	$escaped_post_text = str_replace('"', '\"', $post_text);
	
    $txt .= "          coded = \"" . $coded . "\"\n" .
	"            key = \"".$cipher."\"\n".
	"            shift=coded.length\n".
	"            link=\"\"\n".
	"            for (i=0; i<coded.length; i++) {\n" .
	"              if (key.indexOf(coded.charAt(i))==-1) {\n" .
	"                ltr = coded.charAt(i)\n" .
	"                link += (ltr)\n" .
	"              }\n" .
	"              else {     \n".
	"                ltr = (key.indexOf(coded.charAt(i))-shift+key.length) % key.length\n".
	"                link += (key.charAt(ltr))\n".
	"              }\n".
	"            }\n".
	"          document.write(\"<div>$escaped_pre_text<a href='mailto:\"+link+\"' target='_blank'>$js_link_text</a>$escaped_post_text</div>\")\n" .
	"          \n".
	"          //-"."->\n" .
	"          <" . "/script>\n          <noscript><div>$pre_text<a href=\"$mailhide_url\" onclick=\"window.open('$mailhide_url', '', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=300'); return false;\" title=\"Reveal this e-mail address\">" .
    $ns_link_text . '</a>' .
	"$post_text</div></noscript>";
	return $txt;
}

?>