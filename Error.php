<?php
/*
 * Error.php
 * LHS Math Club Website
 *
 * A generic error page: whenever anything goes wrong, users are
 * redirected here.
 */
 
/* //--todo--See if this can be used (in conjunction with .htaccess)
  $_GET['401'];//????
  $HttpStatus = $_SERVER["REDIRECT_STATUS"];
  if($HttpStatus==400) echo "Bad HTTP request";
  if($HttpStatus==401) echo "Unauthorized";
  if($HttpStatus==403) echo "Forbidden";
  if($HttpStatus==500) echo "Internal Server Error";
  if($HttpStatus==418)
	echo "<h1>Error <a href='http://tools.ietf.org/html/rfc2324#section-2.3.2'>418 I'm a teapot</a></h1>
		<p>In other words, the server went crazy and we're fixing it. Check back in a moment to see if it's back.</p>
		<p>Thanks for your patience, and we hope it'll be working again soon!</p>
		<p>-LHSMATH Webmaster(s)</p>";
*/

if(!array_key_exists('Error.php',$_SESSION)){ //Preventing redirect loops when including a buggy functions.php.
	$_SESSION = array();
	session_name('Session');
	session_start();
	$_SESSION['Error.php'] = true;
	
	$path_to_root = '../';
	require_once $path_to_root.'lib/functions.php';
	page_title("Error");
}

header("HTTP/1.1 500 Internal Server Error");
?>
<h1>Error</h1>
Whoops! Something went wrong. Try again?