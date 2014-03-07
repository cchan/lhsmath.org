<?php
/*
 * LMT/Backstage/Data/Individual.php
 * LHS Math Club Website
 *
 * Displays individual data and allows staff to edit it.
 *
 * ID:	the id of the individual to display
 */

$path_to_lmt_root = '../../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
backstage_access();

if (isSet($_POST['lmtDataIndividual_changeName']))
	do_change_name();
else if (isSet($_POST['lmtDataIndividual_changeGrade']))
	do_change_grade();
else if (isSet($_POST['lmtDataIndividual_changeEmail']))
	do_change_email();
else if (isSet($_POST['lmtDataIndividual_changeAttendance']))
	do_change_attendance();
else if (isSet($_POST['lmtDataIndividual_changeTeam']))
	do_change_team();
else if (isSet($_POST['lmtDataIndividual_changeIndividualRound']))
	do_change_individual_round();
else if (isSet($_POST['lmtDataIndividual_changeThemeRound']))
	do_change_theme_round();
else if (isSet($_POST['lmtDataIndividual_delete']))
	do_confirm_delete();
else if (isSet($_POST['lmtDataIndividual_reallyDelete']))
	do_delete();
else
	display_individual('', '');





function display_individual($err, $selected_field) {
	$row = lmt_query('SELECT individuals.*, teams.name AS team_name, (SELECT name AS school_name FROM schools WHERE schools.school_id=teams.school) AS school_name'
		. ' FROM individuals LEFT JOIN teams ON individuals.team=teams.team_id'
		. ' WHERE id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '"', true);
	$name = htmlentities($row['name']);
	$school = htmlentities($row['school_name']);
	if ($row['grade'] == '6')
		$grade6_sel = ' selected="selected"';
	else if ($row['grade'] == '7')
		$grade7_sel = ' selected="selected"';
	else if ($row['grade'] == '8')
		$grade8_sel = ' selected="selected"';
	$email = htmlentities($row['email']);
	if ($email != '') {
		$email_link = "\n              <div class=\"halfbreak\"></div>              <a href=\"mailto:$email\" rel=\"external\">Send Email</a>";
		$school = 'Unaffiliated';
	}
	$attendance = htmlentities($row['attendance']) ? 'Present' : 'Absent';
	$team_id = htmlentities($row['team']);
	$team_link = '<a href="Team?ID=' . $team_id . '">' . htmlentities($row['team_name']) . '</a>';
	if ($team_id == -1)
		$team_link = '<span class="b">Not Assigned</span>';
	$teams_dropdown = make_teams_dropdown($team_id);
	if ($school == '')
		$school = 'None';
	$individualround_checked = is_null($row['score_individual']) ? '' : ' checked="checked"';
	$individualround_score = htmlentities($row['score_individual']);
	$themeround_checked = is_null($row['score_theme']) ? '' : ' checked="checked"';
	$themeround_score = htmlentities($row['score_theme']);
	
	$row2 = lmt_query(individual_composite('', 'WHERE id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '"'), true);
	$composite_score = $row2['score_composite'];
	
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
        if (document.forms['lmtDataIndividualRoundScore'].hasValue.checked) {
          document.forms['lmtDataIndividualRoundScore'].score.disabled = false;
          if (isClick == 1)
            document.forms['lmtDataIndividualRoundScore'].score.focus();
        }
        else
          document.forms['lmtDataIndividualRoundScore'].score.disabled = true;
        
        
        if (document.forms['lmtDataThemeRoundScore'].hasValue.checked) {
          document.forms['lmtDataThemeRoundScore'].score.disabled = false;
          if (isClick == 2)
            document.forms['lmtDataThemeRoundScore'].score.focus();
        }
        else
          document.forms['lmtDataThemeRoundScore'].score.disabled = true;
      }
HEREDOC;
	
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	$a = fetch_alert('lmt_data_individual_update_name');
	$b = fetch_alert('lmt_data_individual_update_grade');
	$c = fetch_alert('lmt_data_individual_update_email');
	$d = fetch_alert('lmt_data_individual_update_attendance');
	$e = fetch_alert('lmt_data_individual_update_team');
	$f = fetch_alert('lmt_data_individual_update_individual_score');
	$g = fetch_alert('lmt_data_individual_update_theme_score');
	
	if (!scoring_is_enabled()) {
		$scoring_warning = "\n      " . '<div class="text-centered">Note: Scoring has been frozen, so results may not be changed.</div><br /><br />';
		$scoring_freeze = 'disabled="disabled" ';
	}
	
	lmt_page_header($name);
	echo <<<HEREDOC
      <h1>Individual</h1>
      $scoring_warning$a$b$c$d$e$f$g$err
      <table>
        <tr>
          <td>Name:</td>
          <td>
            <form id="lmtDataIndividualName" method="post" action="{$_SERVER['REQUEST_URI']}"><div>
              <input type="text" name="name" size="25" maxlength="25" value="$name" />
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
              <input type="submit" name="lmtDataIndividual_changeName" value="Change" />
            </div></form>
          </td>
        </tr><tr>
          <td>Grade:</td>
          <td>
            <form id="lmtDataIndividualGrade" method="post" action="{$_SERVER['REQUEST_URI']}"><div>
              <select name="grade">
                <option value="6"{$grade6_sel}>Sixth</option>
                <option value="7"{$grade7_sel}>Seventh</option>
                <option value="8"{$grade8_sel}>Eighth</option>
              </select>
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
              <input type="submit" name="lmtDataIndividual_changeGrade" value="Change" />
            </div></form>
          </td>
        </tr><tr>
          <td>Email:</td>
          <td>
            <form id="lmtDataIndividualEmail" method="post" action="{$_SERVER['REQUEST_URI']}"><div>
              <input type="text" name="email" size="25" value="$email" />
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
              <input type="submit" name="lmtDataIndividual_changeEmail" value="Change" />$email_link
            </div></form>
          </td>
        </tr><tr>
          <td>Attendance:</td>
          <td>
            <form id="lmtDataIndividualAttendance" method="post" action="{$_SERVER['REQUEST_URI']}"><div>
              <span class="b">$attendance</span>&nbsp;
              <input type="hidden" name="currentAttendance" value="$attendance" />
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
              <input type="submit" name="lmtDataIndividual_changeAttendance" value="Change" />
            </div></form>
            <br />
          </td>
        </tr><tr>
          <td>Team:</td>
          <td>
            $team_link
            <div class="halfbreak"></div>
            <form id="lmtDataIndividualTeam" method="post" action="{$_SERVER['REQUEST_URI']}"><div>
$teams_dropdown
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
              <input type="submit" name="lmtDataIndividual_changeTeam" value="Change" />
            </div></form>
          </td>
        </tr><tr>
          <td>School:</td>
          <td><span class="b">$school</span><br /><br /></td>
        </tr><tr>
          <td>Individual Round Score:</td>
          <td>
            <form id="lmtDataIndividualRoundScore" method="post" action="{$_SERVER['REQUEST_URI']}"><div>
              <input type="checkbox" name="hasValue" value="Yes" onchange="nullboxSetState(1);"$individualround_checked/>
              <input type="text" name="score" size="25" value="$individualround_score" />
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
              <input type="submit" name="lmtDataIndividual_changeIndividualRound" value="Change" $scoring_freeze/>
            </div></form>
          </td>
        </tr><tr>
          <td>Theme Round Score:</td>
          <td>
            <form id="lmtDataThemeRoundScore" method="post" action="{$_SERVER['REQUEST_URI']}"><div>
              <input type="checkbox" name="hasValue" value="Yes" onchange="nullboxSetState(2);"$themeround_checked/>
              <input type="text" name="score" size="25" value="$themeround_score" />
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
              <input type="submit" name="lmtDataIndividual_changeThemeRound" value="Change" $scoring_freeze/>
            </div></form>
          </td>
        </tr><tr>
          <td>Composite Score:</td>
          <td><span class="b">$composite_score</span><br /><br /></td>
        </tr><tr>
          <td>Delete:</td>
          <td>
            <form method="post" action="{$_SERVER['REQUEST_URI']}"><div>
              <input type="submit" name="lmtDataIndividual_delete" value="Delete Member" />
            </div></form>
          </td>
        </tr>
      </table>
HEREDOC;
	lmt_backstage_footer('');
	die;
}





function make_teams_dropdown($except) {
	$sp = '              ';
	$return = $sp . '<select name="team">' . "\n"
		. $sp . '  <option value="-2" selected="selected"></option>' . "\n"
		. $sp . '  <option value="-1">Not Assigned</option>' . "\n";
	
	$result = lmt_query('SELECT teams.team_id, teams.name, schools.name AS school_name FROM teams'
		. ' LEFT JOIN schools ON teams.school=schools.school_id WHERE team_id <> "'
		. $except . '" AND teams.deleted="0" ORDER BY name');
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$school = htmlentities($row['school_name']);
		if ($school == '')
			$school = 'Individuals';
		$return .= $sp . '  <option value="' . htmlentities($row['team_id']) . '">'
			. htmlentities($row['name']) . '&nbsp;&nbsp;/&nbsp;&nbsp;' . $school . '</option>' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	$return .= $sp . '</select>';
	return $return;
}





function do_change_name() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$name_msg = validate_member_name($_POST['name']);
	if ($name_msg !== true)
		display_individual($name_msg, 'document.forms[\'lmtDataIndividualName\'].name.focus();');
	
	$result = lmt_query('SELECT id FROM individuals WHERE name="'
					. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_POST['name'])
					. '" AND team = (SELECT team FROM individuals WHERE id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID'])
					. '") AND team <> "-1" AND deleted="0"');
	$row = mysqli_fetch_assoc($result);
	if ($row['id'] == $_GET['ID']) {
		header('Location: Individual?ID=' . $_GET['ID']);
		die;
	}
	
	lmt_query('UPDATE individuals SET name="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_POST['name'])
		. '" WHERE id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']). '" LIMIT 1');
	
	if ($row)
		add_alert('lmt_data_individual_update_name', 'Name was changed. WARNING: Another individual on the same team has that name.');
	else
		add_alert('lmt_data_individual_update_name', 'Name was changed');
	header('Location: Individual?ID=' . $_GET['ID']);
}





function do_change_grade() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$grade_msg = validate_grade($_POST['grade']);
	if ($grade_msg !== true)
		display_individual($grade_msg, 'document.forms[\'lmtDataIndividualGrade\'].grade.focus();');
	
	$row = lmt_query('SELECT grade FROM individuals WHERE id="' . $_GET['ID'] . '"', true);
	if ($_POST['grade'] == $row['grade']) {
		header('Location: Individual?ID=' . $_GET['ID']);
		die;
	}
	
	lmt_query('UPDATE individuals SET grade="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_POST['grade'])
		. '" WHERE id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']). '" LIMIT 1');
	
	add_alert('lmt_data_individual_update_grade', 'Grade was changed');
	header('Location: Individual?ID=' . $_GET['ID']);
}





function do_change_email() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	if ($_POST['email'] != '') {
		$email_msg = validate_email($_POST['email']);
		if ($email_msg !== true)
			display_individual($email_msg, 'document.forms[\'lmtDataIndividualEmail\'].email.focus();');
	}
	
	$row = lmt_query('SELECT email FROM individuals WHERE id="' . $_GET['ID'] . '"', true);
	if ($_POST['email'] == $row['email']) {
		header('Location: Individual?ID=' . $_GET['ID']);
		die;
	}
	
	lmt_query('UPDATE individuals SET email="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_POST['email'])
		. '" WHERE id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']). '" LIMIT 1');
	
	add_alert('lmt_data_individual_update_email', 'Email was changed');
	header('Location: Individual?ID=' . $_GET['ID']);
}





function do_change_attendance() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	if ($_POST['currentAttendance'] == 'Present')
		$attendance = '0';
	else if ($_POST['currentAttendance'] == 'Absent')
		$attendance = '1';
	else
		trigger_error('Invalid value of attendance', E_USER_ERROR);
	
	lmt_query('UPDATE individuals SET attendance="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$attendance)
		. '" WHERE id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']). '" LIMIT 1');
	
	add_alert('lmt_data_individual_update_attendance', 'Attendance was changed');
	header('Location: Individual?ID=' . $_GET['ID']);
}





function do_change_team() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$row = lmt_query('SELECT team FROM individuals WHERE id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '"', true);
	if ($row['team'] == $_POST['team'] || $_POST['team'] == '-2') {
		header('Location: Individual?ID=' . $_GET['ID']);
		die;
	}
	
	if ($_POST['team'] != '-1')
		lmt_query('SELECT team_id FROM teams WHERE team_id="'
			. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_POST['team']) . '"', true);
	
	$result = lmt_query('SELECT id FROM individuals WHERE team="'
		. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_POST['team'])
		. '" AND name = (SELECT name FROM individuals WHERE id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID'])
		. '") AND team <> "-1" AND deleted="0"');
	
	lmt_query('UPDATE individuals SET team="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_POST['team'])
		. '" WHERE id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '" LIMIT 1');
	
	if (mysqli_num_rows($result) > 0)
		add_alert('lmt_data_individual_update_team', 'Team was changed. WARNING: Another member of the team has the same name.');
	else
		add_alert('lmt_data_individual_update_team', 'Team was changed');
	header('Location: Individual?ID=' . $_GET['ID']);
}





function do_change_individual_round() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	if (!scoring_is_enabled()) {
		header('Location: ../Scoring_Frozen');
		die;
	}
	
	if ($_POST['hasValue'] == 'Yes') {
		$score = $_POST['score'];
		$score_msg = validate_individual_score($score);
		if ($score_msg !== true)
			display_individual($score_msg, 'document.forms[\'lmtDataIndividualRoundScore\'].score.focus();');
		
		lmt_query('UPDATE individuals SET score_individual="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$score)
			. '" WHERE id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID'])
			. '" AND (score_individual <> "' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$score) . '" OR score_individual IS NULL) LIMIT 1');
	}
	else
		lmt_query('UPDATE individuals SET score_individual=NULL WHERE id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID'])
			. '" AND score_individual IS NOT NULL LIMIT 1');
	
	global $LMT_DB;
	if (mysqli_affected_rows($LMT_DB) == 1)
		add_alert('lmt_data_individual_update_individual_score', 'Individual round score was changed');
	header('Location: Individual?ID=' . $_GET['ID']);
}





function do_change_theme_round() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	if (!scoring_is_enabled()) {
		header('Location: ../Scoring_Frozen');
		die;
	}
	
	$score = intval($_POST['score']);
	
	if ($_POST['hasValue'] == 'Yes') {
		$score = $_POST['score'];
		$score_msg = validate_theme_score($score);
		if ($score_msg !== true)
			display_individual($score_msg, 'document.forms[\'lmtDataThemeRoundScore\'].score.focus();');
		
		lmt_query('UPDATE individuals SET score_theme="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$score)
			. '" WHERE id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID'])
			. '" AND (score_theme <> "' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$score) . '" OR score_theme IS NULL) LIMIT 1');
	}
	else
		lmt_query('UPDATE individuals SET score_theme=NULL WHERE id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID'])
			. '" AND score_theme IS NOT NULL LIMIT 1');
	
	global $LMT_DB;
	if (mysqli_affected_rows($LMT_DB) == 1)
		add_alert('lmt_data_individual_update_theme_score', 'Theme round score was changed');
	header('Location: Individual?ID=' . $_GET['ID']);
}





function do_confirm_delete() {
	$id = htmlentities($_GET['ID']);
	
	$row = lmt_query('SELECT individuals.name, teams.name AS team_name,'
		. ' (SELECT name FROM schools WHERE schools.school_id=teams.school) AS school_name FROM individuals'
		. ' LEFT JOIN teams ON individuals.team=teams.team_id WHERE id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '"', true);
	$name = htmlentities($row['name']);
	$team = htmlentities($row['team_name']);
	$school = htmlentities($row['school_name']);
	if ($school != '')
		$school = ' <span class="b">' . $school . '</span>\'s';
	if ($team != '')
		$team = '<br />' . "\n" . '        from' . $school . ' <span class="b">' . $team . '</span> team';
	else
		$unaffiliated = ' unaffiliated';
	
	lmt_page_header('Delete Individual');
	echo <<<HEREDOC
      <h1>Delete Individual</h1>
      
      <div class="text-centered">
        Are you sure that you want to delete the$unaffiliated individual <span class="b">$name</span>$team?
        <div class="halfbreak"></div>
        <form method="post" action="{$_SERVER['REQUEST_URI']}"><div>
          <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
          <input type="submit" name="lmtDataIndividual_reallyDelete" value="Delete" />
          &nbsp;&nbsp;<a href="Individual?ID=$id">Cancel</a>
        </div></form>
      </div>
HEREDOC;
	lmt_backstage_footer('');
}





function do_delete() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	lmt_query('UPDATE individuals SET deleted="1" WHERE id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '" LIMIT 1');
	
	header('Location: Home');
}

?>