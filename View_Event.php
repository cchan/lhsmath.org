<?php
/*
 * View_Event.php
 * LHS Math Club Website
 *
 * Shows the description for a particular event and allows Admins
 * to edit it.
 *
 * If the GET parameter Popup is set, it will be formatted
 * for a popup window.
 */

$path_to_root = '';
require_once 'lib/functions.php';
restrict_access('XRLA');

if (isSet($_GET['Popup'])) {
	if (isSet($_POST['do_edit_event']) && user_access('A'))
		do_popup_edit();
	else if (isSet($_POST['do_delete_event']) && user_access('A'))
		do_popup_delete();
	else if (isSet($_GET['Edit']) && user_access('A'))
		show_popup_edit_page('');
	else if (isSet($_GET['Delete']) && user_access('A'))
		show_popup_delete_page();
	else
		show_popup_page();
}
else {
	if (isSet($_POST['do_edit_event']) && user_access('A'))
		do_full_edit();
	else if (isSet($_POST['do_delete_event']) && user_access('A'))
		do_full_delete();
	else if (isSet($_GET['Edit']) && user_access('A'))
		show_full_edit_page('');
	else if (isSet($_GET['Delete']) && user_access('A'))
		show_full_delete_page();
	else
		show_full_page();
}





function show_full_page() {
	$query = 'SELECT title, DATE_FORMAT(date, "%M %e, %Y") AS formatted_date, DATE_FORMAT(date, "%Y") AS year, '
		. 'DATE_FORMAT(date, "%m") AS month, description FROM events WHERE event_id="'
		. mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1';
	$result = DB::queryRaw($query);
	
	if (mysqli_num_rows($result) == 0)
		trigger_error('Event not found', E_USER_ERROR);
	
	$row = mysqli_fetch_assoc($result);
	$title = htmlentities($row['title']);
	$date = htmlentities($row['formatted_date']);
	$desc = nl2br(htmlentities($row['description']));
	
	$admin_footer = '';
	if (user_access('A')) {
		$admin_footer = <<<HEREDOC

    <div class="right">
      <a href="{$_SERVER['REQUEST_URI']}&amp;Edit">Edit</a>&nbsp;&nbsp;
      <a href="{$_SERVER['REQUEST_URI']}&amp;Delete">Delete</a>
    </div>
HEREDOC;
	}
	
	page_header($title);
	echo <<<HEREDOC
      <h1>$title</h1>
      
      <span class="b">$date</span><br />
      <br />
	  $desc
	  <br />
	  <br />$admin_footer
	  <a href="Calendar?Month={$row['month']}&amp;Year={$row['year']}" class="small">&lt; Back to Calendar</a>
HEREDOC;
	default_page_footer('');
}





function show_full_edit_page($err) {
	$title = '';
	$date = '';
	$desc = '';
	if (!isSet($_POST['title'])) {
		$query = 'SELECT title, DATE_FORMAT(date, "%m/%e/%y") AS formatted_date, DATE_FORMAT(date, "%Y") AS year, '
			. 'DATE_FORMAT(date, "%m") AS month, description FROM events WHERE event_id="'
			. mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1';
		$result = DB::queryRaw($query);
		
		if (mysqli_num_rows($result) == 0)
			trigger_error('Event not found', E_USER_ERROR);
		
		$row = mysqli_fetch_assoc($result);
		$title = htmlentities($row['title']);
		$date = htmlentities($row['formatted_date']);
		$desc = htmlentities($row['description']);
	}
	else {
		$title = htmlentities($_POST['title']);
		$date = htmlentities($_POST['formatted_date']);
		$desc = htmlentities($_POST['description']);
	}

	global $jquery_function;
	$jquery_function = <<<HEREDOC
      $(function() {
        $("#edit_date").datepicker({ });
      });
HEREDOC;
	
	global $body_onload;
	$body_onload = 'document.forms[\'editEvent\'].form_title.focus()';
	
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	$request_uri = htmlentities($_SERVER['REQUEST_URI']);
	$id = htmlentities($_GET['ID']);
	
	page_header('Edit Event');
	echo <<<HEREDOC
      <h1>Edit</h1>
      $err
      <form id="editEvent" method="post" action="$request_uri">
        <table>
          <tr>
            <td>Title:</td>
            <td><input type="text" id="form_title" name="title" value="$title" size="25" maxlength="25"/></td>
          </tr><tr>
            <td>Date:</td>
            <td><input id="edit_date" type="text" name="date" value="$date" size="15"/></td>
          </tr><tr>
            <td>Description:&nbsp;</td>
            <td><textarea name="description" rows="10" cols="80">$desc</textarea></td>
          </tr><tr>
            <td></td>
            <td>
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
              <input type="submit" name="do_edit_event" value="Edit"/>&nbsp;&nbsp;
              <a href="View_Event?ID=$id">Cancel</a>
            </td>
          </tr>
        </table>
      </form>
HEREDOC;
	default_page_footer('');
}





function do_full_edit() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$title = $_POST['title'];
	$date = $_POST['date'];
	$desc = $_POST['description'];
	
	if ($title == '') {
		show_full_edit_page('Title cannot be blank');
		return;
	}
	if (strlen($title) > 25)
		trigger_error('Add_Event: Title too long', E_USER_ERROR);
	
	$date = date_parse($date);
	if (!($date['year'] && $date['month'] && $date['day'])) {
		show_full_edit_page('That\'s not a real date');
		return;
	}
	$date = $date['year'] . '-' . $date['month'] . '-' . $date['day'];
	
	if (strlen($desc) > 2000) {
		show_full_edit_page('Please limit your description to 2000 characters');
		return;
	}
	
	$query = 'UPDATE events SET title="'
		. mysqli_real_escape_string(DB::get(),$title) . '", date="'
		. mysqli_real_escape_string(DB::get(),$date) . '", description="'
		. mysqli_real_escape_string(DB::get(),$desc) . '" WHERE event_id="'
		. mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1';
	DB::queryRaw($query);
	
	$_SESSION['CALENDAR_edited_event'] = true;
	
	header('Location: View_Event?ID=' . $_GET['ID']);
}





function show_full_delete_page() {
	$request_uri = htmlentities($_SERVER['REQUEST_URI']);
	page_header('Delete Event');
	$id = htmlentities($_GET['ID']);
	echo <<<HEREDOC
      <h1>Delete</h1>
      
      <h4>Are you sure that you want to delete this event?</h4>
      <form method="post" action="$request_uri"><div>
        <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
        <input type="submit" name="do_delete_event" value="Delete"/>&nbsp;&nbsp;
        <a href="View_Event?ID=$id}">Cancel</a>
      </div></form>
HEREDOC;
	default_page_footer('');
}





function do_full_delete() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$query = 'SELECT title FROM events WHERE event_id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '"';
	$result = DB::queryRaw($query);
	if (mysqli_num_rows($result) != 1)
		trigger_error('Delete: Wrong number of results for ID', E_USER_ERROR);
	$row = mysqli_fetch_assoc($result);
	$title = $row['title'];
	
	$query = 'DELETE FROM events WHERE event_id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1';
	DB::queryRaw($query);
	
	$_SESSION['CALENDAR_deleted_event'] = 'The event &quot;' . htmlentities($title) . '&quot; has been deleted';
	
	header('Location: Calendar');
}





function show_popup_page() {
	$query = 'SELECT title, DATE_FORMAT(date, "%M %e, %Y") AS formatted_date, DATE_FORMAT(date, "%Y") AS year, '
		. 'DATE_FORMAT(date, "%m") AS month, description FROM events WHERE event_id="'
		. mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1';
	$result = DB::queryRaw($query);
	
	if (mysqli_num_rows($result) == 0)
		trigger_error('Event not found', E_USER_ERROR);
	
	$row = mysqli_fetch_assoc($result);
	$title = htmlentities($row['title']);
	$date = htmlentities($row['formatted_date']);
	$desc = nl2br(htmlentities($row['description']));
	
	
	$adminfooter = '';
	if (user_access('A')) {
		// Special Admin Edit functions
		$request_uri = htmlentities($_SERVER['REQUEST_URI']);
		$adminfooter = <<<HEREDOC

    <div id="adminfooter">
      <a href="$request_uri&amp;Edit">Edit</a>&nbsp;&nbsp;
      <a href="$request_uri&amp;Delete">Delete</a>
    </div>
HEREDOC;
	}
	
	$reload_parent = '';
	if (isSet($_SESSION['CALENDAR_edited_event'])) {
		$reload_parent = "window.opener.location.reload();";
		unset($_SESSION['CALENDAR_edited_event']);
	}
	
	echo <<<HEREDOC
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Calendar | LHS Math Club</title>
    <link rel="icon" href="favicon.ico" />
    <style type="text/css">
    html, body {
      font-family: georgia, serif;
      font-size: 13pt;
      line-height: 1.15;
      margin: 0;
      padding: 0;
      background-color: #ddd;
    }
    
    div#header {
      background-color: #333;
      height: 30px;
    }
    
    div#content {
      background-color: #fff;
      width: 85%;
      margin-left: auto;
      margin-right: auto;
      padding: 15px;
    }
    
    div#footer {
      font-size: 10pt;
      margin-right: 30px;
      margin-top: 10px;
      float: right;
    }
    
    div#adminfooter {
      font-size: 10pt;
      margin-left: 30px;
      margin-top: 10px;
      float: left;
    }
    
    h1 {
      text-align: right;
      padding-bottom: 15px;
      font-family: verdana, sans-serif;
      font-weight: normal;
    }
    
    a {
      color: #555;
    }
    
    .b {
      font-weight: bold;
    }
    </style>
    <script type="text/javascript">
      function resizeWin() {
        winHeight = document.getElementById('all').offsetHeight;
        parent.popup_height(winHeight+40);
      }
    </script>
  </head>
  <body onload="resizeWin();$reload_parent">
  <div id="all">
    <div id="header"> </div>
    <div id="content">
      <h1>$title</h1>
      
      <span class="b">$date</span><br />
      <br />
      $desc
      <br />
	  <br />
    </div>$adminfooter
    <div id="footer">
      <a href="javascript:parent.popup('popUpDiv');">Close Window</a>
    </div>
  </div>
  </body>
</html>
HEREDOC;
}





function show_popup_edit_page($err) {
	$title = '';
	$date = '';
	$desc = '';
	if (!isSet($_POST['title'])) {
		$query = 'SELECT title, DATE_FORMAT(date, "%m/%e/%y") AS formatted_date, DATE_FORMAT(date, "%Y") AS year, '
			. 'DATE_FORMAT(date, "%m") AS month, description FROM events WHERE event_id="'
			. mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1';
		$result = DB::queryRaw($query);
		
		if (mysqli_num_rows($result) == 0)
			trigger_error('Event not found', E_USER_ERROR);
		
		$row = mysqli_fetch_assoc($result);
		$title = htmlentities($row['title']);
		$date = htmlentities($row['formatted_date']);
		$desc = htmlentities($row['description']);
	}
	else {
		$title = htmlentities($_POST['title']);
		$date = htmlentities($_POST['formatted_date']);
		$desc = htmlentities($_POST['description']);
	}
	
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	$request_uri = htmlentities($_SERVER['REQUEST_URI']);
	$id = htmlentities($_GET['ID']);
	
	echo <<<HEREDOC
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Calendar | LHS Math Club</title>
    <link rel="icon" href="favicon.ico" />
    <style type="text/css">
    html, body {
      font-family: georgia, serif;
      font-size: 13pt;
      line-height: 1.15;
      margin: 0;
      padding: 0;
      background-color: #ddd;
    }
    
    div#header {
      background-color: #333;
      height: 30px;
    }
    
    div#content {
      background-color: #fff;
      width: 85%;
      margin-left: auto;
      margin-right: auto;
      padding: 15px;
    }
    
    div#footer {
      font-size: 10pt;
      margin-right: 30px;
      margin-top: 10px;
      float: right;
    }
    
    div#adminfooter {
      font-size: 10pt;
      margin-left: 30px;
      margin-top: 10px;
      float: left;
    }
    
    h1 {
      text-align: right;
      padding-bottom: 15px;
      font-family: verdana, sans-serif;
      font-weight: normal;
    }
    
    a {
      color: #555;
    }
    
    .b {
      font-weight: bold;
    }
    
    .error {
      width: 90%;
      padding: 10px;
      margin-right: auto;
      margin-left: auto;
      
      background-color: #ffb2b2;
      
      color: #000;
      text-align: center;
      font-size: 12px;
      font-weight: bold;
    }
    
    td {
      vertical-align: top;
    }
    
    textarea {
      font-family: georgia, serif;
      font-size: 16px;
      line-height: 1.15;
    }
    </style>
    <script type="text/javascript">
      function resizeWin() {
        winHeight = document.getElementById('all').offsetHeight;
        parent.popup_height(winHeight+40);
      }
    </script>
    
    <link rel="stylesheet" href="res/jquery/css/smoothness/jquery-ui-1.8.5.custom.css" type="text/css" media="all"/>
    <script type="text/javascript" src="res/jquery/js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="res/jquery/js/jquery-ui-1.8.5.custom.min.js"></script>
    <script type="text/javascript">
      $(function() {
        $("#edit_date").datepicker({ });
      });
    </script>
    <style type="text/css">
      .ui-datepicker, .ui-autocomplete {
        font-size: 12px;
      }
    </style>
  </head>
  <body onload="resizeWin();document.forms['editEvent'].title.focus();">
  <div id="all">
    <div id="header"> </div>
    <div id="content">
      <h1>Edit</h1>
      $err
      <form id="editEvent" method="post" action="$request_uri">
        <table>
          <tr>
            <td>Title:</td>
            <td><input type="text" id="title" name="title" value="$title" size="25" maxlength="25"/></td>
          </tr><tr>
            <td>Date:</td>
            <td><input id="edit_date" type="text" name="date" value="$date" size="15"/></td>
          </tr><tr>
            <td>Description:&nbsp;</td>
            <td><textarea name="description" rows="10" cols="40">$desc</textarea></td>
          </tr><tr>
            <td></td>
            <td>
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
              <input type="submit" name="do_edit_event" value="Edit"/>&nbsp;&nbsp;
              <a href="View_Event?&amp;Popup&amp;ID=$id">Cancel</a>
            </td>
          </tr>
        </table>
      </form>
      <br />
	  <br />
    </div>
    <div id="footer">
      <a href="javascript:parent.popup('popUpDiv');">Close Window</a>
    </div>
  </div>
  </body>
</html>
HEREDOC;
}





function do_popup_edit() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$title = $_POST['title'];
	$date = $_POST['date'];
	$desc = $_POST['description'];
	
	if ($title == '') {
		show_popup_edit_page('Title cannot be blank');
		return;
	}
	if (strlen($title) > 25)
		trigger_error('Add_Event: Title too long', E_USER_ERROR);
	
	$date = date_parse($date);
	if (!($date['year'] && $date['month'] && $date['day'])) {
		show_popup_edit_page('That\'s not a real date');
		return;
	}
	$date = $date['year'] . '-' . $date['month'] . '-' . $date['day'];
	
	if (strlen($desc) > 2000) {
		show_popup_edit_page('Please limit your description to 2000 characters');
		return;
	}
	
	$query = 'UPDATE events SET title="'
		. mysqli_real_escape_string(DB::get(),$title) . '", date="'
		. mysqli_real_escape_string(DB::get(),$date) . '", description="'
		. mysqli_real_escape_string(DB::get(),$desc) . '" WHERE event_id="'
		. mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1';
	DB::queryRaw($query);
	
	$_SESSION['CALENDAR_edited_event'] = true;
	
	header('Location: View_Event?Popup&ID=' . $_GET['ID']);
}





function show_popup_delete_page() {
	$request_uri = htmlentities($_SERVER['REQUEST_URI']);
	$id = htmlentities($_GET['ID']);
	echo <<<HEREDOC
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Calendar | LHS Math Club</title>
    <link rel="icon" href="favicon.ico" />
    <style type="text/css">
    html, body {
      font-family: georgia, serif;
      font-size: 13pt;
      line-height: 1.15;
      margin: 0;
      padding: 0;
      background-color: #ddd;
    }
    
    div#header {
      background-color: #333;
      height: 30px;
    }
    
    div#content {
      background-color: #fff;
      width: 85%;
      margin-left: auto;
      margin-right: auto;
      padding: 15px;
    }
    
    div#footer {
      font-size: 10pt;
      margin-right: 30px;
      margin-top: 10px;
      float: right;
    }
    
    div#adminfooter {
      font-size: 10pt;
      margin-left: 30px;
      margin-top: 10px;
      float: left;
    }
    
    h1 {
      text-align: right;
      padding-bottom: 15px;
      font-family: verdana, sans-serif;
      font-weight: normal;
    }
    
    a {
      color: #555;
    }
    
    .b {
      font-weight: bold;
    }
    </style>
    <script type="text/javascript">
      function resizeWin() {
        winHeight = document.getElementById('all').offsetHeight;
        parent.popup_height(winHeight+40);
      }
    </script>
  </head>
  <body onload="resizeWin()">
  <div id="all">
    <div id="header"> </div>
    <div id="content">
      <h1>Delete</h1>
      
      <h4>Are you sure that you want to delete this event?</h4>
      <form method="post" action="$request_uri"><div>
        <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
        <input type="submit" name="do_delete_event" value="Delete"/>&nbsp;&nbsp;
        <a href="View_Event?&amp;Popup&amp;ID=$id">Cancel</a>
      </div></form>
      <br />
	  <br />
    </div>
    <div id="footer">
      <a href="javascript:parent.popup('popUpDiv');">Close Window</a>
    </div>
  </div>
  </body>
</html>
HEREDOC;
}





function do_popup_delete() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$query = 'SELECT title FROM events WHERE event_id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '"';
	$result = DB::queryRaw($query);
	if (mysqli_num_rows($result) != 1)
		trigger_error('Delete: Wrong number of results for ID', E_USER_ERROR);
	$row = mysqli_fetch_assoc($result);
	$title = $row['title'];
	
	$query = 'DELETE FROM events WHERE event_id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1';
	DB::queryRaw($query);
	
	$_SESSION['CALENDAR_deleted_event'] = 'The event &quot;' . htmlentities($title) . '&quot; has been deleted';
	
	echo <<<HEREDOC
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
  </head>
  <body onload="parent.window.location.reload();">
  </body>
</html>
HEREDOC;
}

?>