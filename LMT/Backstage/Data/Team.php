<?php
/*
 * LMT/Backstage/Data/Team.php
 * LHS Math Club Website
 *
 * Displays team data and allows staff to edit it.
 *
 * ID:	the team_id of the team to display
 */

$path_to_lmt_root = '../../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
backstage_access();

if (isSet($_POST['lmtDataTeam_changeName']))
	do_change_name();
else if (isSet($_POST['lmtDataTeam_changeSchool']))
	do_change_school();
else if (isSet($_POST['lmtDataTeam_changeTeamRoundShort']))
	do_set_team_round_short();
else if (isSet($_POST['lmtDataTeam_changeTeamRoundLong']))
	do_set_team_round_long();
else if (isSet($_POST['lmtDataTeam_delete']))
	do_confirm_delete();
else if (isSet($_POST['lmtDataTeam_reallyDelete']))
	do_delete();
else
	display_team('', '');





function display_team($err, $selected_field) {
	score_guts();
	
	$row = lmt_query('SELECT teams.*, schools.name AS school_name, schools.coach_email FROM teams LEFT JOIN schools ON teams.school=schools.school_id'
		. ' WHERE team_id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '"', true);
	$team_name = htmlentities($row['name']);
	$school_name = htmlentities($row['school_name']);
	$school_id = htmlentities($row['school']);
	$coach_email = '<a href="mailto:' . htmlentities($row['coach_email']) . '" rel="external">' . htmlentities($row['coach_email']) .'</a>';
	if ($school_id == '-1') {
		$school_link = '<span class="b">Individuals</span>';
		$coach_email = '<span class="b">None</span>';
	}
	else
		$school_link = '<a href="School?ID=' . $school_id . '">' . $school_name . '</a>';
	$schools_dropdown = make_schools_dropdown($school_id);
	$members_list = make_members_list();
	$teamround_short_checked = is_null($row['score_team_short']) ? '' : ' checked="checked"';
	$teamround_short_score = htmlentities($row['score_team_short']);
	$teamround_long_checked = is_null($row['score_team_long']) ? '' : ' checked="checked"';
	$teamround_long_score = htmlentities($row['score_team_long']);
	
	$row2 = lmt_query(team_composite('', 'WHERE team_id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '"'), true);
	$composite_score = $row2['team_composite'];
	if (is_null($composite_score))
		$composite_score = 'None';
	else
		$composite_score = htmlentities($composite_score);
	
	global $body_onload;
	$body_onload = $selected_field . 'nullboxSetState(-1);externalLinks();';
	
	global $use_rel_external_script;
	$use_rel_external_script = true;
	
	global $javascript;
	$javascript = <<<HEREDOC
      function nullboxSetState(isClick) {
        if (document.forms['lmtDataTeamRoundShortScore'].teamRoundShortHasValue.checked) {
          document.forms['lmtDataTeamRoundShortScore'].teamRoundShortScore.disabled = false;
          if (isClick == 1)
            document.forms['lmtDataTeamRoundShortScore'].teamRoundShortScore.focus();
        }
        else
          document.forms['lmtDataTeamRoundShortScore'].teamRoundShortScore.disabled = true;
        
        if (document.forms['lmtDataTeamRoundLongScore'].teamRoundLongHasValue.checked) {
          document.forms['lmtDataTeamRoundLongScore'].teamRoundLongScore.disabled = false;
          if (isClick == 2)
            document.forms['lmtDataTeamRoundLongScore'].teamRoundLongScore.focus();
        }
        else
          document.forms['lmtDataTeamRoundLongScore'].teamRoundLongScore.disabled = true;
      }
HEREDOC;
	
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	$a = fetch_alert('lmt_data_team_update_name');
	$b = fetch_alert('lmt_data_team_update_school');
	$c = fetch_alert('lmt_data_team_update_team_score_short');
	$d = fetch_alert('lmt_data_team_update_team_score_long');
	
	$id = htmlentities($_GET['ID']);

	if (!scoring_is_enabled()) {
		$scoring_warning = "\n      " . '<div class="text-centered">Note: Scoring has been frozen, so results may not be changed.</div><br /><br />';
		$scoring_freeze = 'disabled="disabled" ';
	}
	
	lmt_page_header($team_name);
	echo <<<HEREDOC
      <h1>Team</h1>
      $scoring_warning$a$b$c$d$err
      <table>
        <tr>
          <td>Team Name:</td>
          <td>
            <form id="lmtDataTeamName" method="post" action="{$_SERVER['REQUEST_URI']}"><div>
              <input type="text" name="team_name" size="25" maxlength="25" value="$team_name" />
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
              <input type="submit" name="lmtDataTeam_changeName" value="Change" />
            </div></form>
            <br />
          </td>
        </tr><tr>
          <td>School:</td>
          <td>
            $school_link
            <div class="halfbreak"></div>
            <form id="lmtDataTeamSchool" method="post" action="{$_SERVER['REQUEST_URI']}"><div>
$schools_dropdown
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
              <input type="submit" name="lmtDataTeam_changeSchool" value="Change" />
            </div></form>
          </td>
        </tr><tr>
          <td>Coach's Email:</td>
          <td>$coach_email<br /><br /></td>
        </tr><tr>
          <td>Team Round Short Score:</td>
          <td>
            <form id="lmtDataTeamRoundShortScore" method="post" action="{$_SERVER['REQUEST_URI']}"><div>
              <input type="checkbox" name="teamRoundShortHasValue" value="Yes" onchange="nullboxSetState(1);"$teamround_short_checked/>
              <input type="text" name="teamRoundShortScore" size="25" value="$teamround_short_score" />
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
              <input type="submit" name="lmtDataTeam_changeTeamRoundShort" value="Change" $scoring_freeze/>
            </div></form>
          </td>
        </tr><tr>
          <td>Team Round Long Score:</td>
          <td>
            <form id="lmtDataTeamRoundLongScore" method="post" action="{$_SERVER['REQUEST_URI']}"><div>
              <input type="checkbox" name="teamRoundLongHasValue" value="Yes" onchange="nullboxSetState(2);"$teamround_long_checked/>
              <input type="text" name="teamRoundLongScore" size="25" value="$teamround_long_score" />
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
              <input type="submit" name="lmtDataTeam_changeTeamRoundLong" value="Change" $scoring_freeze/>
            </div></form>
          </td>
        </tr><tr>
          <td>Guts Round Score:</td>
          <td><a href="../Guts/Full?ID=$id">View &amp; Edit</a></td>
        </tr><tr>
          <td>Composite Score:</td>
          <td><span class="b">$composite_score</span><br /><br /></td>
        </tr><tr>
          <td>Members:</td>
          <td>
$members_list              <br />
          </td>
        </tr><tr>
          <td>Delete:</td>
          <td>
            <form method="post" action="{$_SERVER['REQUEST_URI']}"><div>
              <input type="submit" name="lmtDataTeam_delete" value="Delete Team &amp; Members" />
            </div></form>
          </td>
        </tr>
      </table>
HEREDOC;
	lmt_backstage_footer('');
	die;
}





function make_schools_dropdown($except) {
	$sp = '              ';
	$return = $sp . '<select name="school">' . "\n"
		. $sp . '  <option value="-2" selected="selected"></option>' . "\n"
		. $sp . '  <option value="-1">Individuals</option>' . "\n";
	
	$result = lmt_query('SELECT school_id, name FROM schools WHERE school_id <> "'
		. $except . '" AND deleted="0" ORDER BY name');
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$return .= $sp . '  <option value="' . htmlentities($row['school_id']) . '">'
			. htmlentities($row['name']) . '</option>' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	$return .= $sp . '</select>';
	return $return;
}





function make_members_list() {
	$sp = '              ';
	$return = '';
	
	$result = lmt_query('SELECT id, name FROM individuals WHERE team="' . htmlentities($_GET['ID']) . '" AND deleted="0" ORDER BY name');
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$return .= $sp . '<a href="Individual?ID=' . htmlentities($row['id']) . '">' . htmlentities($row['name']) . '</a><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($return == '')
		$return = '<span class="i">None</span><br />' . "\n";
	
	return $return;
}





function do_change_name() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$name_msg = validate_team_name($_POST['team_name']);
	if ($name_msg !== true)
		display_team($name_msg, 'document.forms[\'lmtDataTeamName\'].team_name.focus();');
	
	$result = lmt_query('SELECT team_id FROM teams WHERE name="'
					. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_POST['team_name'])
					. '" AND school = (SELECT school FROM teams WHERE team_id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID'])
					. '" AND deleted="0") AND deleted="0"');
	$row = mysqli_fetch_assoc($result);
	if ($row['team_id'] == $_GET['ID']) {
		header('Location: Team?ID=' . $_GET['ID']);
		die;
	}
	else if ($row)
		display_team('The school already has a team with that name', 'document.forms[\'lmtDataTeamName\'].team_name.focus();');
	
	lmt_query('UPDATE teams SET name="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_POST['team_name'])
		. '" WHERE team_id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']). '" LIMIT 1');
	
	add_alert('lmt_data_team_update_name', 'Name was changed');
	header('Location: Team?ID=' . $_GET['ID']);
}





function do_change_school() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	if ($_POST['school'] == -2) {
		header('Location: Team?ID=' . $_GET['ID']);
		die;
	}
	
	// Make sure school exists
	if ($_POST['school'] == -1)
		$school_name = 'Individuals';
	else {
		$row = lmt_query('SELECT name FROM schools WHERE school_id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_POST['school']) . '" AND deleted="0"', true);
		$school_name = $row['name'];
	}
	
	$row = lmt_query('SELECT COUNT(*) FROM teams WHERE school="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_POST['school'])
		. '" AND name = (SELECT name FROM teams WHERE team_id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID'])
		. '" AND deleted="0") AND deleted="0"');
	if ($row['COUNT(*)'] > 0)
		display_team('That school already has a team with the same name', 'document.forms[\'lmtDataTeamName\'].team_name.focus();');
	
	lmt_query('UPDATE teams SET school="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_POST['school'])
		. '" WHERE team_id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']). '" LIMIT 1');
	
	add_alert('lmt_data_team_update_school', 'School was changed');
	header('Location: Team?ID=' . $_GET['ID']);
}





function do_set_team_round_short() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	if (!scoring_is_enabled()) {
		header('Location: ../Scoring_Frozen');
		die;
	}
	
	if ($_POST['teamRoundShortHasValue'] == 'Yes') {
		$score = $_POST['teamRoundShortScore'];
		$score_msg = validate_team_short_score($score);
		if ($score_msg !== true)
			display_team($score_msg, 'document.forms[\'lmtDataTeamRoundShortScore\'].teamRoundShortScore.focus();');
		
		lmt_query('UPDATE teams SET score_team_short="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$score)
			. '" WHERE team_id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID'])
			. '" AND (score_team_short <> "' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$score) . '" OR score_team_short IS NULL) LIMIT 1');
	}
	else
		lmt_query('UPDATE teams SET score_team_short=NULL WHERE team_id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID'])
			. '" AND score_team_short IS NOT NULL LIMIT 1');
	
	global $LMT_DB;
	if (mysqli_affected_rows($LMT_DB) == 1)
		add_alert('lmt_data_team_update_team_score_short', 'Team round short answer score was changed');
	header('Location: Team?ID=' . $_GET['ID']);
}





function do_set_team_round_long() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	if (!scoring_is_enabled()) {
		header('Location: ../Scoring_Frozen');
		die;
	}
	
	if ($_POST['teamRoundLongHasValue'] == 'Yes') {
		$score = $_POST['teamRoundLongScore'];
		$score_msg = validate_team_long_score($score);
		if ($score_msg !== true)
			display_team($score_msg, 'document.forms[\'lmtDataTeamRoundLongScore\'].teamRoundLongScore.focus();');
		
		lmt_query('UPDATE teams SET score_team_long="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$score)
			. '" WHERE team_id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID'])
			. '" AND (score_team_long <> "' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$score) . '" OR score_team_long IS NULL) LIMIT 1');
	}
	else
		lmt_query('UPDATE teams SET score_team_long=NULL WHERE team_id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID'])
			. '" AND score_team_long IS NOT NULL LIMIT 1');
	
	global $LMT_DB;
	if (mysqli_affected_rows($LMT_DB) == 1)
		add_alert('lmt_data_team_update_team_score_long', 'Team round long answer score was changed');
	header('Location: Team?ID=' . $_GET['ID']);
}





function do_confirm_delete() {
	$id = htmlentities($_GET['ID']);
	
	$row = lmt_query('SELECT teams.name, schools.name AS school_name FROM teams'
		. ' LEFT JOIN schools ON teams.school=schools.school_id WHERE team_id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '"', true);
	$team_name = htmlentities($row['name']);
	$school = htmlentities($row['school_name']);
	
	lmt_page_header('Delete Team');
	echo <<<HEREDOC
      <h1>Delete Team</h1>
      
      <div class="text-centered">
        Are you sure that you want to delete the team <span class="b">$team_name</span><br />
        from <span class="b">$school</span> and all of its members?
        <div class="halfbreak"></div>
        <form method="post" action="{$_SERVER['REQUEST_URI']}"><div>
          <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
          <input type="submit" name="lmtDataTeam_reallyDelete" value="Delete" />
          &nbsp;&nbsp;<a href="Team?ID=$id">Cancel</a>
        </div></form>
      </div>
HEREDOC;
	lmt_backstage_footer('');
}





function do_delete() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	lmt_query('UPDATE individuals SET deleted="1" WHERE team="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '" LIMIT 6');
	lmt_query('UPDATE teams SET deleted="1" WHERE team_id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '" LIMIT 1');
	
	header('Location: Home');
}

?>