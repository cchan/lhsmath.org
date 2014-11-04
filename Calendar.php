<?php
/*
 * Calendar.php
 * LHS Math Club Website
 *
 * Shows an event calendar
 *
 * Credit to David Walsh [http://davidwalsh.name/php-calendar]
 */

$path_to_root = '';
require_once 'lib/functions.php';
restrict_access('XRLA');

if (isSet($_POST['do_add_event']) && user_access('A'))
	process_add_event();
else
	show_page('');





function show_page($add_err) {
	global $popup_javascript;
	$popup_javascript = true;
		
	page_header('Calendar');
	
	$year = (int)date('Y');
	$month_num = (int)date('m');
	
	// URL parameters to specify Month and Year
	if (isSet($_GET['Month']) && isSet($_GET['Year'])) {
		$requested_month = (int)$_GET['Month'];
		$requested_year = (int)$_GET['Year'];
		if ($requested_month > 0 && $requested_month <= 12 && $requested_year > 0) {
			$year = $requested_year;
			$month_num = $requested_month;
		}
	}
	
	$month_text = date('F', mktime(0, 0, 0, $month_num, 1, $year));
	
	// Calculate text for Forward and Back links
	$back_month_num = $month_num - 1;
	$back_year = $year;
	if ($back_month_num <= 0) {
		$back_month_num = 12;
		$back_year--;
	}
	$back_month_text = date('F', mktime(0, 0, 0, $back_month_num, 1, $back_year));
	
	$fwd_month_num = $month_num + 1;
	$fwd_year = $year;
	if ($fwd_month_num > 12) {
		$fwd_month_num = 1;
		$fwd_year++;
	}
	$fwd_month_text = date('F', mktime(0, 0, 0, $fwd_month_num, 1, $fwd_year));
	
	// Link to return to the current month
	$returnlink = "\n      <div class=\"text-centered small\">&nbsp;</div>";
	if ($year != (int)date('Y') || $month_num != (int)date('m'))
		$returnlink = "\n      <div class=\"text-centered small\"><a href=\"Calendar\" class=\"text-centered small\">return to Today</a></div>";
	
	$add_msg = '';
	if (isSet($_SESSION['CALENDAR_added_event'])) {
		$add_msg = "\n        <div class=\"alert\">{$_SESSION['CALENDAR_added_event']}</div><br />\n";
		unset($_SESSION['CALENDAR_added_event']);
	}
	
	$delete_msg = '';
	if (isSet($_SESSION['CALENDAR_deleted_event'])) {
		$delete_msg = "\n        <div class=\"alert\">{$_SESSION['CALENDAR_deleted_event']}</div><br />\n";
		unset($_SESSION['CALENDAR_deleted_event']);
	}
	
	// Assemble Page
	echo <<<HEREDOC
      <h1>Calendar</h1>
      $add_msg$delete_msg
      <h2 class="text-centered" style="margin: 2px;">$month_text $year</h2>$returnlink
      <a href="Calendar?Month=$back_month_num&amp;Year=$back_year" class="left">&lt; $back_month_text $back_year</a>
      <a href="Calendar?Month=$fwd_month_num&amp;Year=$fwd_year" class="right">$fwd_month_text $fwd_year &gt;</a>
      <p class="small" />

HEREDOC;
	
	echo draw_calendar($month_num, $year);
	
	echo <<<HEREDOC

      <div id="blanket" style="display:none;"></div>
      <div id="popUpDiv" style="display:none;">
        <object id="eventDisplay" data="" type="text/html"></object>
      </div>
HEREDOC;
	
	if (user_access('A')) {
		// Special Admin Edit functions
		if ($add_err != '')
			$add_err = "\n        <div class=\"error\">$add_err</div><br />\n";
		
		$title = $date = $desc = '';
		if(array_key_exists('title',$_POST)){
			$title = htmlentities($_POST['title']);
			$date = htmlentities($_POST['date']);
			$desc = htmlentities($_POST['description']);
		}
		$action = htmlentities($_SERVER['REQUEST_URI']);
		echo <<<HEREDOC
      
      <br /><br />
      
      <h3>Add an Event</h3>$add_err
      <form method="post" action="$action">
        <table>
          <tr>
            <td>Title:</td>
            <td><input type="text" name="title" value="$title" size="25" maxlength="25"/></td>
          </tr><tr>
            <td>Date:</td>
            <td><input id="add_date" type="text" name="date" value="$date" size="15"/></td>
          </tr><tr>
            <td>Description:&nbsp;</td>
            <td><textarea name="description" rows="10" cols="80">$desc</textarea></td>
          </tr><tr>
            <td></td>
            <td>
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
              <input type="submit" name="do_add_event" value="Add Event"/>
            </td>
          </tr>
        </table>
      </form>
	  <script>
		  $(function() {
			$("#add_date").datepicker({ });
		  });
	  </script>
HEREDOC;
	}
}





function process_add_event() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$title = $_POST['title'];
	$date = $_POST['date'];
	$desc = $_POST['description'];
	
	if ($title == '') {
		show_page('Title cannot be blank');
		return;
	}
	if (strlen($title) > 25)
		trigger_error('Add_Event: Title too long', E_USER_ERROR);
	
	$date = date_parse($date);
	if (!($date['year'] && $date['month'] && $date['day'])) {
		show_page('That\'s not a real date');
		return;
	}
	$date = $date['year'] . '-' . $date['month'] . '-' . $date['day'];
	
	if (strlen($desc) > 2000) {
		show_page('Please limit your description to 2000 characters');
		return;
	}
	
	$query = 'INSERT INTO events (title, date, description) VALUES ("'
		. mysqli_real_escape_string(DB::get(),$title) . '", "'
		. mysqli_real_escape_string(DB::get(),$date) . '", "'
		. mysqli_real_escape_string(DB::get(),$desc) . '")';
	DB::queryRaw($query);
	
	$_SESSION['CALENDAR_added_event'] = 'The event &quot;' . htmlentities($title) . '&quot; has been added';
	header('Location: ' . $_SERVER['REQUEST_URI']);
}





/*
 * function draw_calendar($month, $year)
 *
 * Returns code for a calendar.
 * Vaguely inspired by the disappointingly verbose David Walsh [http://davidwalsh.name/php-calendar]
 */
function draw_calendar($month, $year) {
	$thismonth 				= strtotime('this month');
	$currmonth = $currdate 	= strtotime($year.'-'.$month);
	$nextmonth 				= strtotime($year.'-'.$month.' + 1 month');
	
	$pastnowfuture = function($timestamp){
		$now = strtotime('today');
		if($timestamp > $now) return 'future';
		if($timestamp == $now) return 'now';
		if($timestamp < $now) return 'past';
	};
	
	$events = DB::query('SELECT event_id, title, DAYOFMONTH(date) AS day FROM events WHERE MONTH(date)=%i AND YEAR(date)=%i ORDER BY day ASC',$month,$year);
	
	
	$calendar = '<table cellpadding="0" cellspacing="0" class="cal">';
	
	/* table headings */
	$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$calendar .= '<tr><th>'.implode('</th><th>',$headings).'</th></tr>';
	
	/* row for week one */
	$calendar.= '<tr class="calendar-row">';
	
	/* print blank days until the first of the current week */
	for($x = 0; $x < date('w',$currdate); $x++)
		$calendar.= '<td class="blank">&nbsp;</td>';
	
	while($currdate < $nextmonth){
		if(date('w',$currdate) == 0)//New week!
			$calendar .= "</tr><tr>";
		
		$calendar .= "<td class='day {$pastnowfuture($currdate)}'>";
		
		// Add in day number
		$calendar .= '<div class="day-number">'.date('j',$currdate).'</div>';
		
		// Look for matching events from the earlier query
		while (count($events) > 0 && $events[0]['day'] == date('j',$currdate)) {
			$event = array_shift($events);
			$title = htmlentities($event['title']);
			$calendar .= "<a href=\"View_Event?ID={$event['event_id']}\" style='display:block;width:100%;height:100%;' onclick=\"popup_id('{$event['event_id']}'); return false;\">$title</a><br /><br />";
		}
		
		$calendar .= "</td>";
		
		$currdate = strtotime("+1 day", $currdate);
	}
	
	/* finish the rest of the days in the week */
	for($x = intval(date('w',$currdate)); $x < 7; $x++)
		$calendar.= '<td class="blank">&nbsp;</td>';

	/* final row, end of table */
	$calendar.= '</tr></table>';
	
	/* all done, return result */
	return $calendar;
}

?>