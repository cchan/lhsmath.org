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

if(!defined('FUNCTIONSPHP'))require_once 'lib/functions.php'; //Require it only if Errors.php isn't being included by another file.
	//May present problems if functions.php itself has bugs.

//Making pages case-insensitive.
$pagename = $_SERVER['REQUEST_URI'];
if(strpos($pagename,'.php')!==false)
	$pagename=substr($pagename,0,-4);
if(strpos($pagename,'/')===0)
	$pagename=substr($pagename,1);
if(preg_match('@[^a-zA-Z0-9\/]@i',$pagename)===0){//Nothing but alphanumeric and slashes
	$files=globi($pagename,'','.php');
	if(is_array($files) && count($files)>0){
		cancel_templateify();
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: '.$files[0]);
		die();
	}
}

page_title("Error");

header("HTTP/1.1 500 Internal Server Error");
?>
<h1>Error <?=$_SERVER['REDIRECT_STATUS']?></h1>
Whoops! Something went wrong. Try again?
