<?php
/*
 * Error.php
 * LHS Math Club Website
 *
 * A generic error page: whenever anything goes wrong, users are
 * redirected here.
 */

@session_name('Session');
@session_start();

header("HTTP/1.1 500 Internal Server Error");

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Error | LHS Math Club</title>
    <link rel="icon" href="favicon.ico" />
    <link rel="stylesheet" href="/res/default.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/res/print.css" type="text/css" media="print" />
  </head>
  <body>

    <div id="header">
      <a href="/Home" id="title">LHS Math Club</a><?php
if (isSet($_SESSION['user_name']))
	echo "\n" . '      <div id="user"><span id="username">' . $_SESSION['user_name'] . '</span><span id="bar"> | </span><a href="/Account/Signout">Sign Out</a></div>';
?>
    </div>
    
    <div id="content">
      <h1>Error</h1>

      
      Whoops! Something went wrong. Try again?
    </div>
    
    <div id="linkbar"><br />
      <div class="linkgroup">
        <a href="/Home">Home</a><br />
      </div>
    </div>
  </body>
</html>