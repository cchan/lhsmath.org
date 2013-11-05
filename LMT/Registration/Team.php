<?php
/*
 * LMT/Registration/Team.php
 * LHS Math Club Website
 */


$path_to_lmt_root = '../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
lmt_reg_restrict_access('L');

if (isSet($_POST['lmt_do_reg_add']))
	do_add();
else if (isSet($_POST['lmt_do_reg_edit_name']))
	do_edit_name();
else if (isSet($_POST['lmt_do_reg_delete']))
	do_delete();
else if (isSet($_POST['lmt_do_reg_add_member']))
	do_add_member();
else if (isSet($_POST['lmt_do_reg_edit_member']))
	do_edit_member();
else if (isSet($_GET['Add']))
	show_add_page('', 'team_name');
else if (isSet($_GET['Edit']))
	show_edit_page('', "document.forms['lmtRegAddMember'].member_name.focus();");
else if (isSet($_GET['Delete']))
	show_delete_page();
else if (isSet($_GET['EditMember']))
	show_edit_member_page('');
else if (isSet($_GET['DeleteMember']))
	do_delete_member();
else
	header('Location: Home');





function show_add_page($err, $selected_field) {
	global $body_onload, $team_name, $members;
	$body_onload = 'document.forms[\'lmtRegAddTeam\'].' . $selected_field . '.focus();';
	
	$row = lmt_query('SELECT COUNT(*) FROM teams WHERE school="' . mysql_real_escape_string($_SESSION['LMT_user_id']) . '"', true);
	if ($row['COUNT(*)'] != 0)
		$cancel_link = "\n              &nbsp;<a href=\"Home\">Cancel</a>";
	
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	$lmt_cost = htmlentities(map_value('team_cost'));
	$school_name = htmlentities($_SESSION['LMT_school_name']);
	
	lmt_page_header('Add Team');
	echo <<<HEREDOC
      <h1>Add a Team</h1>
      
      <div class="instruction">
      Team registration costs <span class="b">$lmt_cost</span>, paid at the competition.<br />
      <br />
      Please read the rules before registering teams. Though LMT is open to teams of 4, 5, or 6 competitors,
      we stress that a full team is one of 6 students. The option for smaller teams is intended for schools
      who may not be able to field full teams, but still have significant interest in the competition, or in
      case unexpected conflicts arise for individual members come competition day. We strongly discourage the
      forming of smaller teams solely for the purpose of somehow gaining a competitive advantage over a
      potentially larger team.<br />
      <br />
      You may add, remove and edit teams until registration closes.
      </div>
      <br /><br />
      $err
      <form id="lmtRegAddTeam" method="post" action="{$_SERVER['REQUEST_URI']}">
        <table>
          <tr>
            <td>School:</td>
            <td><span class="b">$school_name</span></td>
            <td></td>
          </tr><tr>
            <td>Team Name:&nbsp;</td>
            <td>
              <input type="text" name="team_name" size="25" maxlength="25" value="$team_name" />
              <br /><br />
            </td>
            <td></td>
          </tr><tr>
            <td>Members:</td>
            <td class="u">Name</td>
            <td class="u">Grade</td>
          </tr><tr>
            <td></td>
            <td><input type="text" name="name1" size="25" maxlength="25" value="{$members[1]['name']}" /></td>
            <td>
              <select name="grade1">
                <option value="6"{$members[1]['6sel']}>Sixth</option>
                <option value="7"{$members[1]['7sel']}>Seventh</option>
                <option value="8"{$members[1]['8sel']}>Eighth</option>
              </select>
            </td>
          </tr><tr>
            <td></td>
            <td><input type="text" name="name2" size="25" maxlength="25" value="{$members[2]['name']}" /></td>
            <td>
              <select name="grade2">
                <option value="6"{$members[2]['6sel']}>Sixth</option>
                <option value="7"{$members[2]['7sel']}>Seventh</option>
                <option value="8"{$members[2]['8sel']}>Eighth</option>
              </select>
            </td>
          </tr><tr>
            <td></td>
            <td><input type="text" name="name3" size="25" maxlength="25" value="{$members[3]['name']}" /></td>
            <td>
              <select name="grade3">
                <option value="6"{$members[3]['6sel']}>Sixth</option>
                <option value="7"{$members[3]['7sel']}>Seventh</option>
                <option value="8"{$members[3]['8sel']}>Eighth</option>
              </select>
            </td>
          </tr><tr>
            <td></td>
            <td><input type="text" name="name4" size="25" maxlength="25" value="{$members[4]['name']}" /></td>
            <td>
              <select name="grade4">
                <option value="6"{$members[4]['6sel']}>Sixth</option>
                <option value="7"{$members[4]['7sel']}>Seventh</option>
                <option value="8"{$members[4]['8sel']}>Eighth</option>
              </select>
            </td>
          </tr><tr>
            <td></td>
            <td><input type="text" name="name5" size="25" maxlength="25" value="{$members[5]['name']}" /></td>
            <td>
              <select name="grade5">
                <option value="6"{$members[5]['6sel']}>Sixth</option>
                <option value="7"{$members[5]['7sel']}>Seventh</option>
                <option value="8"{$members[5]['8sel']}>Eighth</option>
              </select>
            </td>
          </tr><tr>
            <td></td>
            <td><input type="text" name="name6" size="25" maxlength="25" value="{$members[6]['name']}" /></td>
            <td>
              <select name="grade6">
                <option value="6"{$members[6]['6sel']}>Sixth</option>
                <option value="7"{$members[6]['7sel']}>Seventh</option>
                <option value="8"{$members[6]['8sel']}>Eighth</option>
              </select>
            </td>
          </tr><tr>
            <td></td>
            <td>
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
              <input type="submit" name="lmt_do_reg_add" value="Add Team" />$cancel_link
            </td>
          </tr>
        </table>
      </form>
HEREDOC;
	lmt_page_footer('');
	die;
}





function do_add() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	global $team_name, $members;
	
	$team_name = htmlentities(trim($_POST['team_name']));
	
	$name_msg = validate_team_name($team_name);
	if ($name_msg !== true)
		show_add_page($name_msg, 'team_name');
	
	$member_name_msg = true;
	$member_grade_msg = true;
	
	for ($i = 1; $i <= 6; $i++) {
		$members[$i]['name'] = htmlentities(ucwords(trim($_POST['name' . $i])));
		
		if ($members[$i]['name'] == '')
			$members[$i]['exists'] = false;
		else {
			$members[$i]['exists'] = true;
			
			$name_msg = validate_member_name($members[$i]['name']);
			if ($name_msg !== true) {
				$member_name_msg = $name_msg;
				$member_name_msg_field = 'name' . $i;
			}
			
			if ($_POST['grade' . $i] == '6') {
				$members[$i]['grade'] = 6;
				$members[$i]['6sel'] = ' selected="selected"';
			}
			else if ($_POST['grade' . $i] == '7') {
				$members[$i]['grade'] = 7;
				$members[$i]['7sel'] = ' selected="selected"';
			}
			else if ($_POST['grade' . $i] == '8') {
				$members[$i]['grade'] = 8;
				$members[$i]['8sel'] = ' selected="selected"';
			}
			else {
				$member_grade_msg = 'That\'s not a valid grade';
				$member_grade_msg_field =  'grade' . $i;
			}
		}
	}
	
	if ($member_name_msg !== true)
		show_add_page($member_name_msg, $member_name_msg_field);
	if ($member_grade_msg !== true)
		show_add_page($member_grade_msg, $member_grade_msg_field);
	
	$row = lmt_query(	'SELECT COUNT(*) FROM teams WHERE name="'
						. mysql_real_escape_string($team_name)
						. '" AND school="' . mysql_real_escape_string($_SESSION['LMT_user_id']) . '"', true);
	if ($row['COUNT(*)'] > 0)
		show_add_page('You already have a team with that name', 'team_name');
	
	// ** All information has been validated at this point **
	
	lmt_query(	'INSERT INTO teams (name, school) VALUES("'
				. mysql_real_escape_string($team_name)
				. '", "' . mysql_real_escape_string($_SESSION['LMT_user_id']) . '")');
	
	$row = lmt_query(	'SELECT team_id FROM teams WHERE name="'
						. mysql_real_escape_string($team_name)
						. '" AND school="' . mysql_real_escape_string($_SESSION['LMT_user_id']) . '"', true);
	$team_id = $row['team_id'];
	
	for ($i = 1; $i <= 6; $i++) {
		if ($members[$i]['exists']) {
			lmt_query(	'INSERT INTO individuals (name, grade, team) VALUES("'
						. mysql_real_escape_string($members[$i]['name'])
						. '", "' . mysql_real_escape_string($members[$i]['grade'])
						. '", "' . mysql_real_escape_string($team_id) . '")');
		}
	}
	
	header('Location: Home');
}




function show_edit_page($err, $selected_field) {
	global $body_onload;
	$body_onload = $selected_field;
	
	lmt_page_header('Modify Team');
	
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	$school_name = htmlentities($_SESSION['LMT_school_name']);
	
	$team_id = htmlentities($_GET['Edit']);
	$row = lmt_query(	'SELECT name FROM teams WHERE team_id="'
						. mysql_real_escape_string($team_id)
						. '" AND school="' . mysql_real_escape_string($_SESSION['LMT_user_id']) . '"', true);
	$team_name = htmlentities($row['name']);
	
	$members = lmt_db_table(	'SELECT id, name, grade FROM individuals WHERE team="'
								. mysql_real_escape_string($team_id) . '" ORDER BY name',
							array(	'name' => '',
									'grade' => ''),
							array(	'<img src="../../res/icons/edit.png" alt="Edit" />' => 'Team?EditMember={id}',
									'<img src="../../res/icons/delete.png" alt="Delete" />' => 'Team?DeleteMember={id}&amp;xsrf_token=' . $_SESSION['xsrf_token']),
							'None',
							'contrasting');
							
	$row = lmt_query('SELECT COUNT(*) FROM individuals WHERE team="' . mysql_real_escape_string($team_id) . '"', true);
	$num_members = (int)$row['COUNT(*)'];
	
	if ($num_members < 4)
		$warning = "\n      <div class=\"alert\">There are less than 4 members on this team!</div><br />\n";
	
	global $member_name, $member_grade;
	if ($member_grade == '6')
		$member_6sel = ' selected="selected"';
	else if ($member_grade == '7')
		$member_7sel = ' selected="selected"';
	else if ($member_grade == '8')
		$member_8sel = ' selected="selected"';
	
	if ($num_members < 6)
		$add_member = <<<HEREDOC
<tr>
          <td>Add Member:&nbsp;</td>
          <td>
            <form id="lmtRegAddMember" method="post" action="{$_SERVER['REQUEST_URI']}"><div>
              <input type="text" name="member_name" size="25" maxlength="25" value="$member_name" />
              <select name="member_grade">
                <option value="6"$member_6sel>Sixth</option>
                <option value="7"$member_7sel>Seventh</option>
                <option value="8"$member_8sel>Eighth</option>
              </select>
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
              <input type="submit" name="lmt_do_reg_add_member" value="Add" />
            </div></form>
          </td>
        </tr>
HEREDOC;
	
	$change_alert = fetch_alert('regChangeName');
	
	echo <<<HEREDOC
      <h1>Modify a Team</h1>
      <a href="Home">&larr; Back to Team List</a><br /><br />
      $warning$err$change_alert
      <table>
        <tr>
          <td>School:</td>
          <td><span class="b">$school_name</span></td>
          <td></td>
        </tr><tr>
          <td>Team Name:</td>
          <td>
            <form id="lmtRegEditTeam" method="post" action="{$_SERVER['REQUEST_URI']}"><div>
              <input type="text" name="team_name" size="25" maxlength="25" value="$team_name" />
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
              <input type="submit" name="lmt_do_reg_edit_name" value="Change Name" />
            </div></form>
          </td>
          <td></td>
        </tr><tr>
          <td>Members:</td>
          <td>$members</td>
        </tr>$add_member
      </table>
HEREDOC;
	lmt_page_footer('');
	die;
}





function do_edit_name() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	global $team_name;
	$team_name = htmlentities(trim($_POST['team_name']));
	
	$name_msg = validate_team_name($team_name);
	if ($name_msg !== true)
		show_edit_page($name_msg, "document.forms['lmtRegEditTeam'].team_name.focus();");
	
	$row = lmt_query(	'SELECT name FROM teams WHERE team_id="'
				. mysql_real_escape_string($_GET['Edit'])
				. '" AND school="' . mysql_real_escape_string($_SESSION['LMT_user_id']) . '"', true);
				
	if ($row['name'] == $team_name) {
		header('Location: Team?Edit=' . $_GET['Edit']);
		die;
	}
	
	$row = lmt_query(	'SELECT COUNT(*) FROM teams WHERE name="'
						. mysql_real_escape_string($team_name)
						. '" AND school="' . mysql_real_escape_string($_SESSION['LMT_user_id']) . '"', true);
	if ($row['COUNT(*)'] > 0)
		show_edit_page('You already have a team with that name', 'team_name');
	
	lmt_query(	'UPDATE teams SET name="' . mysql_real_escape_string($team_name)
				. '" WHERE team_id="' . mysql_real_escape_string($_GET['Edit'])
				. '" AND school="' . mysql_real_escape_string($_SESSION['LMT_user_id'])
				. '" LIMIT 1');
	
	add_alert('regChangeName', 'The team name has been changed');
	header('Location: Team?Edit=' . $_GET['Edit']);
}





function do_add_member() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	global $member_name, $member_grade;
	$member_name = htmlentities(ucwords(trim($_POST['member_name'])));
	$member_grade = htmlentities($_POST['member_grade']);
	
	$name_msg = validate_member_name($member_name);
	if ($name_msg !== true)
		show_edit_page($name_msg, "document.forms['lmtRegAddMember'].member_name.focus();");
	
	$grade_msg = validate_grade($member_grade);
	if ($grade_msg !== true)
		show_edit_page($grade_msg, "document.forms['lmtRegAddMember'].member_grade.focus();");
	
	// Ensure that the team exists and belongs to this user's school
	$row = lmt_query(	'SELECT * FROM teams WHERE team_id="'
				. mysql_real_escape_string($_GET['Edit'])
				. '" AND school="' . mysql_real_escape_string($_SESSION['LMT_user_id']) . '"', true);
	
	// ** All information has been validated at this point **
	
	lmt_query(	'INSERT INTO individuals (name, grade, team) VALUES("'
				. mysql_real_escape_string($member_name)
				. '", "' . mysql_real_escape_string($member_grade)
				. '", "' . mysql_real_escape_string($_GET['Edit']) . '")');
	header('Location: Team?Edit=' . $_GET['Edit']);
}





function show_edit_member_page($err) {
	lmt_page_header('Edit Member');
	
	$school_name = htmlentities($_SESSION['LMT_school_name']);
	
	$row = lmt_query('SELECT name, grade, team FROM individuals WHERE id="' . mysql_real_escape_string($_GET['EditMember']) . '"', true);
	$row2 = lmt_query('SELECT name, school FROM teams WHERE team_id="' . mysql_real_escape_string($row['team']) . '"', true);
	if ($row2['school'] != $_SESSION['LMT_user_id'])
		trigger_error('Edit Member: Member does not attend this school', E_USER_ERROR);
	
	$team_name = htmlentities($row2['name']);
	
	global $name, $grade;
	if (!isSet($name)) {
		$name = htmlentities($row['name']);
		$grade = $row['grade'];
	}
	if ($grade == '6')
		$sel6 = ' selected="selected"';
	else if ($grade == '7')
		$sel7 = ' selected="selected"';
	else if ($grade == '8')
		$sel8 = ' selected="selected"';
	
	$back_url = 'Team?Edit=' . htmlentities($row['team']);
	
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	echo <<<HEREDOC
      <h1>Edit Member</h1>
      <a href="$back_url">&larr; Back to Team Page</a><br /><br />
      $err
      <form id="lmtRegEditMember" method="post" action="{$_SERVER['REQUEST_URI']}">
        <table>
          <tr>
            <td>School:</td>
            <td><span class="b">$school_name</span></td>
            <td></td>
          </tr><tr>
            <td>Team:</td>
            <td><span class="b">$team_name</span></td>
            <td></td>
          </tr><tr>
            <td>Name:</td>
            <td><input type="text" name="name" size="25" maxlength="25" value="$name" /></td>
            <td></td>
          </tr><tr>
            <td>Grade:</td>
            <td>
              <select name="grade">
                <option value="6"$sel6>Sixth</option>
                <option value="7"$sel7>Seventh</option>
                <option value="8"$sel8>Eighth</option>
              </select>
            </td>
          </tr><tr>
            <td></td>
            <td>
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
              <input type="submit" name="lmt_do_reg_edit_member" value="Update Information" />
            </td>
          </tr>
        </table>
      </form>
HEREDOC;
	lmt_page_footer('');
	die;
}





function do_edit_member() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	global $name, $grade;
	$name = htmlentities(ucwords(trim($_POST['name'])));
	$grade = htmlentities($_POST['grade']);
	
	$name_msg = validate_member_name($name);
	if ($name_msg !== true)
		show_edit_member_page($name_msg);
	
	$grade_msg = validate_grade($grade);
	if ($grade_msg !== true)
		show_edit_member_page($grade_msg);
	
	$row = lmt_query('SELECT team FROM individuals WHERE id="'. mysql_real_escape_string($_GET['EditMember']) . '"', true);
	$team = $row['team'];
	$row = lmt_query('SELECT school FROM teams WHERE team_id="' . mysql_real_escape_string($team) . '"', true);
	if ($row['school'] != $_SESSION['LMT_user_id'])
		trigger_error('Edit Member: Member does not attend this school', E_USER_ERROR);
	
	// ** All information has been validated at this point **
	
	lmt_query(	'UPDATE individuals SET name="'
				. mysql_real_escape_string($name)
				. '", grade="' . mysql_real_escape_string($grade)
				. '" WHERE id="' . mysql_real_escape_string($_GET['EditMember'])
				. '" LIMIT 1');
	
	header('Location: Team?Edit=' . $team);
}





function do_delete_member() {
	if ($_GET['xsrf_token'] != $_SESSION['xsrf_token'])
		header('Error' . $_GET['Edit']);
	
	$id = $_GET['DeleteMember'];
	
	$row = lmt_query('SELECT team FROM individuals WHERE id="'. mysql_real_escape_string($id) . '"', true);
	$team = $row['team'];
	$row = lmt_query('SELECT school FROM teams WHERE team_id="' . mysql_real_escape_string($team) . '"', true);
	if ($row['school'] != $_SESSION['LMT_user_id'])
		trigger_error('Delete Member: Member does not attend this school', E_USER_ERROR);
		
	// ** All information has been validated at this point **
	
	lmt_query('DELETE FROM individuals WHERE id="' . mysql_real_escape_string($id) . '" LIMIT 1');
	
	header('Location: Team?Edit=' . $team);
}





function show_delete_page() {
	lmt_page_header('Remove Team');
	
	$school_name = htmlentities($_SESSION['LMT_school_name']);
	$row = lmt_query(	'SELECT * FROM teams WHERE team_id="'
						. mysql_real_escape_string($_GET['Delete'])
						. '" AND school="' . mysql_real_escape_string($_SESSION['LMT_user_id']) . '"', true);
	$team_name = htmlentities($row['name']);
	$members = lmt_db_table(	'SELECT name, grade FROM individuals WHERE team="'
								. mysql_real_escape_string($_GET['Delete']) . '" ORDER BY name',
							null,
							null,
							'None',
							'contrasting');
	
	echo <<<HEREDOC
      <h1>Remove a Team</h1>
      
      <form method="post" action="{$_SERVER['REQUEST_URI']}">
        <div>
          Are you sure that you want to remove this team?
          <div class="halfbreak"></div>
          <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
          <input type="submit" name="lmt_do_reg_delete" value="Remove" />
          &nbsp;<a href="Home">Cancel</a>
        </div>
      </form>
      
      <br /><br />
      
      <table class="smbottom">
        <tr>
          <td>School:</td>
          <td><span class="b">$school_name</span></td>
        </tr><tr>
          <td>Team Name:&nbsp;</td>
          <td><span class="b">$team_name</span></td>
        </tr><tr>
          <td>Members:</td>
          <td>$members</td>
        </tr>
      </table>
HEREDOC;
	lmt_page_footer('');
	die;
}





function do_delete() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	// Ensure that the team exists and belongs to this user's school
	$row = lmt_query(	'SELECT * FROM teams WHERE team_id="'
				. mysql_real_escape_string($_GET['Delete'])
				. '" AND school="' . mysql_real_escape_string($_SESSION['LMT_user_id']) . '"', true);
	
	lmt_query('DELETE FROM teams WHERE team_id="' . mysql_real_escape_string($_GET['Delete']) . '" LIMIT 1');
	lmt_query('DELETE FROM individuals WHERE team="' . mysql_real_escape_string($_GET['Delete']) . '" LIMIT 6');
	
	header('Location: Home');
}

?>