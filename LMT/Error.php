<?php
/*
 * LMT/Error.php
 * LHS Math Club Website
 *
 * A generic error page: whenever anything goes wrong, users are
 * redirected here.
 */

@session_name('Session');
@session_start();

echo '<?xml version="1.0" encoding="UTF-8"?>';

if (isSet($_GET['Mini'])) {	// error page for Guts embedded frame
	echo <<<HEREDOC

<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title></title>
    <link rel="stylesheet" href="../res/default.css" type="text/css" media="all" />
    <link rel="stylesheet" href="../res/lmt.css" type="text/css" media="all" />
    <link rel="stylesheet" href="../res/print.css" type="text/css" media="print" />
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
	die;
	}
?>

<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Error | LMT</title>
    <link rel="icon" href="favicon.ico" />
    <link rel="stylesheet" href="../res/default.css" type="text/css" media="all" />
    <link rel="stylesheet" href="../res/lmt.css" type="text/css" media="all" />
    <link rel="stylesheet" href="../res/print.css" type="text/css" media="print" />
  </head>
  <body>

    <div id="header">
      <a href="/LMT/About" id="title">Lexington Math Tournament</a><?php
if (isSet($_SESSION['user_name']))
	echo "\n" . '      <div id="user"><span id="username">' . $_SESSION['user_name'] . '</span><span id="bar"> | </span><a href="/Account/Signout">Sign Out</a></div>';
?>
    </div>
    
    <div id="content">
      <h1>Error</h1>

      <div class="text-centered">Whoops! Something went wrong. Try again?</div>
    </div>
    
    <div id="linkbar"><br />
      <div class="linkgroup">
        <a href="/LMT/About">About</a><br />
      </div>
    </div>
  </body>
</html>