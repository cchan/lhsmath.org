<?php
/*
 * Calendar.php
 * LHS Math Club Website
 *
 * Shows an event calendar
 */


require_once '.lib/functions.php';
restrict_access('XRLA');

page_title('Calendar');

if (isSet($_POST['do_add_event']) && user_access('A'))
	process_add_event();
else
	show_page();




function show_page() {
	$curr_ts = mktime(0,0,0,isSet($_GET['Month'])?$_GET['Month']:date('n'),1,isSet($_GET['Year'])?$_GET['Year']:date('Y'));
	if($curr_ts === false)$curr_ts = mktime(0,0,0,date('n'),1);
	
	$back_ts = strtotime('-1 month',$curr_ts);
	$fwd_ts = strtotime('+1 month',$curr_ts);
	
	$tsurl = function($ts){return "Calendar?Month=".date('n',$ts)."&amp;Year=".date('Y',$ts);};
	$tstxt = function($ts){return date('F Y',$ts);};
	
	// Assemble Page
	echo <<<HEREDOC
      <h1>Calendar</h1>
      
	  <h2 class="text-centered" style="margin: 2px;">{$tstxt($curr_ts)}</h2>
	  <div class="text-centered small"><a href="Calendar">back to today</a></div>
	  
      <a href="{$tsurl($back_ts)}" class="left">&lt; {$tstxt($back_ts)}</a>
      <a href="{$tsurl($fwd_ts)}" class="right">{$tstxt($fwd_ts)} &gt;</a>
HEREDOC
.draw_calendar($curr_ts).<<<HEREDOC
HEREDOC;
	
	if (user_access('A')) {
		$title = $date = $desc = '';
		if(array_key_exists('title',$_POST)){
			$title = htmlentities($_POST['title']);
			$date = htmlentities($_POST['date']);
			$desc = htmlentities($_POST['description']);
		}
		$action = htmlentities($_SERVER['REQUEST_URI']);
		echo <<<HEREDOC
      
      <br /><br />
      
      <h3>Add an Event</h3>
      <form method="post" action="$action">
        <table>
          <tr>
            <td>Title:</td>
            <td><input type="text" name="title" value="$title" size="25" maxlength="25"/></td>
          </tr><tr>
            <td>Date:</td>
            <td><input type="text" name="date" value="$date" size="15" class="datepicker"/></td>
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
HEREDOC;
	}
}





function process_add_event() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$title = $_POST['title'];
	$date = $_POST['date'];
	$desc = $_POST['description'];
	
	if ($title == '' || strlen($title) > 25) {
		alert('Title must be between 1 and 25 characters long',-1);
		show_page();
		return;
	}
	
	$date = date_parse($date);//Builtin PHP function
	if (!($date['year'] && $date['month'] && $date['day'])) {
		alert('That\'s not a real date',-1);
		show_page();
		return;
	}
	$date = $date['year'] . '-' . $date['month'] . '-' . $date['day'];
	
	if (strlen($desc) > 2000) {
		alert('Please limit your description to 2000 characters',-1);
		show_page();
		return;
	}
	
	DB::insert('events',array('title'=>$title,'date'=>$date,'description'=>$desc));
	
	alert('The event &quot;' . htmlentities($title) . '&quot; has been added',1);
	header('Location: ' . $_SERVER['REQUEST_URI']);
}





/*
 * function draw_calendar($month, $year)
 *
 * Returns code for a calendar.
 * Vaguely inspired by the disappointingly verbose David Walsh [https://davidwalsh.name/php-calendar]
 */
function draw_calendar($current_month_timestamp) {
	$currmonth = $currdate 	= strtotime('this month',$current_month_timestamp);
	$nextmonth 				= strtotime('next month',$current_month_timestamp);
	
	$pastnowfuture = function($timestamp){
		$now = strtotime('today');
		if($timestamp > $now) return 'future';
		if($timestamp == $now) return 'now';
		if($timestamp < $now) return 'past';
	};
	$currdate += 10000; //lol daylight savings time smh
	
	$events = DB::query('SELECT event_id, title, DAYOFMONTH(date) AS day, UNIX_TIMESTAMP(date) FROM events WHERE %i <= UNIX_TIMESTAMP(date) AND UNIX_TIMESTAMP(date) < %i ORDER BY day ASC',$currmonth,$nextmonth);
	$calendar = '<table cellpadding="0" cellspacing="0" class="cal">';
	
	/* table headings */
	$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$calendar .= '<tr><th>'.implode('</th><th>',$headings).'</th></tr>';
	
	/* row for week one */
	$calendar.= '<tr>';
	
	/* print blank days until the first of the current week */
	for($x = 0; $x < date('w',$currdate); $x++)
		$calendar.= '<td class="blank">&nbsp;</td>';
	
	while($currdate < $nextmonth){
		if(date('w',$currdate) == 0)//New week!
			$calendar .= "</tr><tr>";
		
		$calendar .= "<td class='day {$pastnowfuture($currdate)}'>";
		
		// Add in day number
		$calendar .= '<div class="day-number">'.date('j',$currdate).'</div>';
		
		// Look for matching events in the query
		while (count($events) > 0 && $events[0]['day'] == date('j',$currdate)) {
			$event = array_shift($events);
			$title = htmlentities($event['title']);
			$calendar .= "<a href=\"View_Event?ID={$event['event_id']}\" style='display:block;width:100%;height:100%;' onclick=\"return true; popup_id('{$event['event_id']}'); return false;\">{$title}</a><br /><br />";
		}
		
		$calendar .= "</td>";
		
		$currdate += 60*60*24; // next day
	}
	
	/* finish the rest of the days in the week */
	for($x = intval(date('w',$currdate)); $x > 0 && $x < 7; $x++)
		$calendar.= '<td class="blank">&nbsp;</td>';

	/* final row, end of table */
	$calendar.= '</tr></table>';
	
	/* all done, return result */
	return $calendar;
}

?>