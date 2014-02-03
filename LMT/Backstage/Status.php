<?php
/*
 * LMT/Backstage/Status.php
 * LHS Math Club Website
 *
 * The main Admin page; shows whether registration is open, etc.
 */

$path_to_lmt_root = '../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
restrict_access('A');

if (isSet($_POST['lmt_close_reg']))
	do_close_reg();
else if (isSet($_POST['lmt_open_reg']))
	do_open_reg();
else if (isSet($_POST['lmt_close_backstage']))
	do_close_backstage();
else if (isSet($_POST['lmt_open_backstage']))
	do_open_backstage();
else if (isSet($_POST['lmt_freeze_scoring']))
	do_freeze_scoring();
else if (isSet($_POST['lmt_enable_scoring']))
	do_enable_scoring();
else if (isSet($_POST['lmt_update_date']))
	do_update_date();
else if (isSet($_POST['lmt_update_year']))
	do_update_year();
else if (isSet($_POST['lmt_update_indiv_cost']))
	do_update_indiv_cost();
else if (isSet($_POST['lmt_update_team_cost']))
	do_update_team_cost();
else if (isSet($_POST['lmt_update_backstage_message']))
	do_update_backstage_message();
else
	show_page('');





function show_page($err) {
	global $javascript, $lmt_database;
	$javascript = <<<HEREDOC
      function processKey(e, id) {
        if (null == e)
          e = window.event;
        if (e.keyCode == 13)  {
          document.getElementById(id).click();
          return false;
        }
      }
HEREDOC;
	
	lmt_page_header('Status');
	
	if (registration_is_open()) {
		$reg_status = 'Open';
		$reg_action = 'lmt_close_reg';
		$reg_action_name = 'Close';
	}
	else {
		$reg_status = 'Closed';
		$reg_action = 'lmt_open_reg';
		$reg_action_name = 'Open';
	}
	
	if (backstage_is_open()) {
		$backstage_status = 'Open';
		$backstage_action = 'lmt_close_backstage';
		$backstage_action_name = 'Close';
	}
	else {
		$backstage_status = 'Closed';
		$backstage_action = 'lmt_open_backstage';
		$backstage_action_name = 'Open';
	}
	
	if (scoring_is_enabled()) {
		$scoring_status = 'Enabled';
		$scoring_action = 'lmt_freeze_scoring';
		$scoring_action_name = 'Freeze';
	}
	else {
		$scoring_status = 'Frozen';
		$scoring_action = 'lmt_enable_scoring';
		$scoring_action_name = 'Enable';
	}
	
	$lmt_year = htmlentities(map_value('year'));
	$lmt_date = htmlentities(map_value('date'));
	$individual_cost = htmlentities(map_value('indiv_cost'));
	$team_cost = htmlentities(map_value('team_cost'));
	$backstage_message = htmlentities(map_value('backstage_message'));
	
	global $lmt_database;
	$row = $lmt_database->query_assoc('SELECT COUNT(*) AS c FROM schools WHERE deleted="0"');
	$num_coaches = $row['c'];
	
	$row = $lmt_database->query_assoc('SELECT COUNT(*) AS c FROM teams WHERE deleted="0"');
	$num_teams = $row['c'];
	
	$row = $lmt_database->query_assoc('SELECT COUNT(*) AS c FROM individuals WHERE email <> "" AND deleted="0"');
	$num_individuals = $row['c'];
	
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	$alert = fetch_alert('status');
	
	echo <<<HEREDOC
      <h1>Status</h1>
      
      <h2>Settings</h2>
      <div class="indented">
        $err$alert
        <form method="post" action="{$_SERVER['REQUEST_URI']}">
        <div><input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" /></div>
          <table style='vertical-align:middle;'>
            <tr>
              <td>Registration:</td>
              <td><span class="b">$reg_status</span></td>
              <td><input type="submit" name="$reg_action" value="$reg_action_name" /></td>
            </tr><tr>
              <td>Backstage:</td>
              <td><span class="b">$backstage_status</span> <span class="small">to regular members</span></td>
              <td><input type="submit" name="$backstage_action" value="$backstage_action_name" /></td>
            </tr><tr>
              <td>Score Entry:</td>
              <td><span class="b">$scoring_status</span></td>
              <td><input type="submit" name="$scoring_action" value="$scoring_action_name" /></td>
            </tr><tr>
              <td>Date:</td>
              <td><input type="text" name="date" value="$lmt_date" size="25" onkeydown="return processKey(event, 'lmtChangeDate');" />&nbsp;</td>
              <td><input id="lmtChangeDate" type="submit" name="lmt_update_date" value="Update" /></td>
            </tr><tr>
              <td>Year:</td>
			  <td><input disabled type="text" name="year" value="$lmt_year" size="4" maxlength="4" onkeydown="return processKey(event, 'lmtChangeYear');" /></td>
              <td><input id="lmtChangeYear" type="submit" name="lmt_update_year" value="Update" /><div style='color:red;'>Use <a href='Upgrade_Year'>Upgrade_Year</a> instead.</div></td>
            </tr><tr>
              <td>Individual Cost:</td>
              <td><input type="text" name="indiv_cost" value="$individual_cost" size="25" onkeydown="return processKey(event, 'lmtChangeIndiv');" /></td>
              <td><input id="lmtChangeIndiv" type="submit" name="lmt_update_indiv_cost" value="Update" /></td>
            </tr><tr>
              <td>Team Cost:</td>
              <td><input type="text" name="team_cost" value="$team_cost" size="25" onkeydown="return processKey(event, 'lmtChangeTeam');" /></td>
              <td><input id="lmtChangeTeam" type="submit" name="lmt_update_team_cost" value="Update" /></td>
            </tr><tr>
              <td>Backstage Message:&nbsp;</td>
              <td><textarea name="backstage_message" rows="5" cols="20">$backstage_message</textarea></td>
              <td><input id="lmtBackstageMessage" type="submit" name="lmt_update_backstage_message" value="Update" /></td>
            </tr>
          </table>
        </form>
      </div>
      
      <br />
      <h2>Statistics</h2>
      <div class="indented">
        <span class="b">$num_coaches</span> coaches have registered a total of <span class="b">$num_teams</span> teams.<br />
        <span class="b">$num_individuals</span> unaffiliated individuals have signed up.
      </div>
HEREDOC;
	lmt_backstage_footer('Status');
	die;
}





function do_close_reg() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	map_set('registration', '0');
	
	add_alert('status', 'Registration has been closed. Be sure to update the About page.');
	header('Location: Status');
}





function do_open_reg() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	map_set('registration', '1');
	
	add_alert('status', 'Registration has been opened. Be sure to update the About page.');
	header('Location: Status');
}





function do_close_backstage() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	map_set('backstage', '0');
	
	add_alert('status', 'Backstage has been closed');
	header('Location: Status');
}





function do_open_backstage() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	map_set('backstage', '1');
	
	add_alert('status', 'Backstage has been opened');
	header('Location: Status');
}





function do_freeze_scoring() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	map_set('scoring', '0');
	
	add_alert('status', 'Score entry has been frozen');
	header('Location: Status');
}





function do_enable_scoring() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	map_set('scoring', '1');
	
	add_alert('status', 'Score entry has been enabled');
	header('Location: Status');
}





function do_update_date() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	if (strlen($_POST['date']) > 2000)
		show_page('Please limit all fields to 2000 characters');
	
	map_set('date', $_POST['date']);
	
	add_alert('status', 'Date has been changed. Be sure to update the About page.');
	header('Location: Status');
}





function do_update_year() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$year = $_POST['year'];
	if (!preg_match('/^\d\d\d\d$/', $year) || (int)$year < 1000 || (int)$year > 9999)
		show_page('That\'s not a valid year');
	
	map_set('year', $year);
	
	add_alert('status', 'Year has been changed. Be sure to update the About page.');
	header('Location: Status');
}





function do_update_indiv_cost() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	if (strlen($_POST['indiv_cost']) > 2000)
		show_page('Please limit all fields to 2000 characters');
	
	map_set('indiv_cost', $_POST['indiv_cost']);
	
	add_alert('status', 'Individual cost has been changed');
	header('Location: Status');
}





function do_update_team_cost() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	if (strlen($_POST['team_cost']) > 2000)
		show_page('Please limit all fields to 2000 characters');
	
	map_set('team_cost', $_POST['team_cost']);
	
	add_alert('status', 'Team cost has been changed');
	header('Location: Status');
}





function do_update_backstage_message() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	if (strlen($_POST['backstage_message']) > 2000)
		show_page('Please limit your message to 2000 characters');
	
	map_set('backstage_message', $_POST['backstage_message']);
	
	add_alert('status', 'Backstage message has been changed');
	header('Location: Status');
}

?>