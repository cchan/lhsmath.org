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
	global $team_name, $members;
	
	$c = DB::queryFirstField('SELECT COUNT(*) FROM teams WHERE school=%i', $_SESSION['LMT_user_id']);
	$cancel_link = '';
	if ($c != 0)
		$cancel_link = "\n              &nbsp;<a href=\"Home\">Cancel</a>";
	
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	$lmt_cost = htmlentities(map_value('team_cost'));
	$school_name = htmlentities($_SESSION['LMT_school_name']);
	
	lmt_page_header('Add Team');
	echo <<<HEREDOC
	<script>document.forms['lmtRegAddTeam'].$selected_field.focus();</script>
      <h1>Add a Team</h1>
      
      <div class="instruction">
      Team registration costs <span class="b">$lmt_cost</span>, paid at the competition.<br />
      <br />
      Please read the rules before registering teams. Though LMT is open to teams of 4, 5, or 6 competitors,
      we stress that a full team is one of 6 students. The option for smaller teams is intended for schools
      who may not be able to field full teams, but still have significant interest in the competition, or in
      case unexpected conflicts arise for individual members come competition day. Forming smaller teams is 
	  otherwise strongly discouraged.<br />
      <br />
      You may add, remove and edit teams until registration closes.
      </div>
      <br /><br />
      $err
      <form id="lmtRegAddTeam" method="post" action="{$_SERVER['REQUEST_URI']}">
        <table>
          <tr>
            <td>School:</td>
            <td><span class="b">$school_name</span><br><br></td>
            <td></td>
          </tr><tr>
            <td>Team Name:&nbsp;</td>
            <td>
              <input type="text" name="team_name" size="25" maxlength="25" value="$team_name" />
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
            <td colspan="2">
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
              <input type="submit" name="lmt_do_reg_add" value="Add This Team" />$cancel_link
            </td>
          </tr>
        </table>
      </form>
HEREDOC;
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
	
	$c = DB::queryFirstField('SELECT COUNT(*) FROM teams WHERE name=%s AND school=%i', $team_name,$_SESSION['LMT_user_id']);
	if ($c > 0)
		show_add_page('You already have a team with that name', 'team_name');
	
	// ** All information has been validated at this point **
	
	DB::insert('teams',array('name'=>$team_name,'school'=>$_SESSION['LMT_user_id']));
	$team_id = DB::insertId();
	
	for ($i = 1; $i <= 6; $i++)
		if ($members[$i]['exists'])
			DB::insert('individuals',array('name'=>$members[$i]['name'],'grade'=>$members[$i]['grade'],'team'=>$team_id));
	
	header('Location: Home');
}




function show_edit_page($err, $selected_field) {
	lmt_page_header('Modify Team');
	
	if ($err != '')alert($err,-1);
	
	$school_name = htmlentities($_SESSION['LMT_school_name']);
	
	$team_id = htmlentities($_GET['Edit']);
	$team_name = DB::queryFirstField('SELECT name FROM teams WHERE team_id=%i AND school=%i',$team_id,$_SESSION['LMT_user_id']);
	
	$members = lmt_db_table(	'SELECT id, name, grade FROM individuals WHERE team="'
								. mysqli_real_escape_string(DB::get(),$team_id) . '" ORDER BY name',
							array(	'name' => '',
									'grade' => ''),
							array(	'<img src="../../res/icons/edit.png" alt="Edit" />' => 'Team?EditMember={id}',
									'<img src="../../res/icons/delete.png" alt="Delete" />' => 'Team?DeleteMember={id}&amp;xsrf_token=' . $_SESSION['xsrf_token']),
							'None',
							'contrasting');
	$num_members = (int)DB::queryFirstField('SELECT COUNT(*) FROM individuals WHERE team=%i',$team_id);
	
	if ($num_members < 4)alert('Warning: There are less than 4 members on this team!',-1);
	
	global $member_name, $member_grade;
	
	if ($num_members < 6)
		$add_member = <<<HEREDOC
		<script>document.forms['lmtRegAddMember'].$selected_field.focus();</script>
		<tr>
          <td>Add Member:&nbsp;</td>
          <td>
            <form id="lmtRegAddMember" method="post" action="{$_SERVER['REQUEST_URI']}"><div>
              <input type="text" name="member_name" size="25" maxlength="25" value="$member_name" />
              <select name="member_grade" value="$member_grade">
                <option value="6">Sixth</option>
                <option value="7">Seventh</option>
                <option value="8">Eighth</option>
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
	
	$name = DB::queryFirstField('SELECT name FROM teams WHERE team_id=%i AND school=%i',$_GET['Edit'],$_SESSION['LMT_user_id']);
	if ($name == $team_name) {
		header('Location: Team?Edit=' . $_GET['Edit']);
		die;
	}
	
	$c = DB::queryFirstField('SELECT COUNT(*) FROM teams WHERE name=%s AND school=%i',$team_name,$_SESSION['LMT_user_id']);
	if ($c > 0)
		show_edit_page('You already have a team with that name', 'team_name');
	
	DB::update('teams',array('name'=>$team_name),'team_id=%i AND school=%i',$_GET['Edit'],$_SESSION['LMT_user_id']);
	
	alert('The team name has been changed',1);
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
	
	if(DB::queryFirstField('SELECT COUNT(*) FROM teams WHERE team_id=%i AND school=%i',$_GET['Edit'],$_SESSION['LMT_user_id'])==0)
		show_edit_page('Invalid team.');
	
	// ** All information has been validated at this point **
	
	DB::insert('individuals',array('name'=>$member_name,'grade'=>$member_grade,'team'=>$_GET['Edit']));
	
	header('Location: Team?Edit=' . $_GET['Edit']);
}





function show_edit_member_page($err) {
	lmt_page_header('Edit Member');
	
	$school_name = htmlentities($_SESSION['LMT_school_name']);
	
	$row = DB::queryFirstRow('SELECT name, grade, team FROM individuals WHERE id=%i',$_GET['EditMember']);
	$row2 = DB::queryFirstRow('SELECT name, school FROM teams WHERE team_id=%i',$row['team']);
	if ($row2['school'] != $_SESSION['LMT_user_id'])
		trigger_error('Edit Member: Member does not attend this school', E_USER_ERROR);
	
	$team_name = htmlentities($row2['name']);
	
	global $name, $grade;
	if (!isSet($name)) {
		$name = htmlentities($row['name']);
		$grade = $row['grade'];
	}
	
	$back_url = 'Team?Edit=' . htmlentities($row['team']);
	
	if ($err != '')alert($err,-1);
	
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
              <select name="grade" value="$grade">
                <option value="6">Sixth</option>
                <option value="7">Seventh</option>
                <option value="8">Eighth</option>
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
	
	$team = DB::queryFirstField('SELECT team FROM individuals WHERE id=%i',$_GET['EditMember']);
	$school = DB::queryFirstField('SELECT school FROM teams WHERE team_id=%i',$team);
	if ($school != $_SESSION['LMT_user_id'])
		trigger_error('Edit Member: Member does not attend this school', E_USER_ERROR);
	
	// ** All information has been validated at this point **
	
	DB::update('individuals',array('name'=>$name,'grade'=>$grade),'id=%i',$_GET['EditMember']);
	
	header('Location: Team?Edit=' . $team);
}





function do_delete_member() {
	if ($_GET['xsrf_token'] != $_SESSION['xsrf_token'])
		header('Error' . $_GET['Edit']);
	
	$id = $_GET['DeleteMember'];
	
	$team = DB::queryFirstField('SELECT team FROM individuals WHERE id=%i',$id);
	$school = DB::queryFirstField('SELECT school FROM teams WHERE team_id=%i',$team);
	if ($school != $_SESSION['LMT_user_id'])
		trigger_error('Delete Member: Member does not attend this school', E_USER_ERROR);
		
	// ** All information has been validated at this point **
	
	DB::delete('individuals','id=%i',$id);
	
	header('Location: Team?Edit=' . $team);
}





function show_delete_page() {
	lmt_page_header('Remove Team');
	
	$team_name = htmlentities(DB::queryFirstField('SELECT name FROM teams WHERE team_id=%i AND school=%i',$_GET['Delete'],$_SESSION['LMT_user_id']));
	$school_name = htmlentities($_SESSION['LMT_school_name']);
	$members = lmt_db_table(	'SELECT name, grade FROM individuals WHERE team="'
								. mysqli_real_escape_string(DB::get(),$_GET['Delete']) . '" ORDER BY name',
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
	die;
}





function do_delete() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	// Ensure that the team exists and belongs to this user's school
	if(DB::queryFirstField('SELECT COUNT(*) FROM teams WHERE team_id=%i AND school=%i',$_GET['Delete'],$_SESSION['LMT_user_id'])==0)
		show_edit_page('Invalid team.');
	
	DB::delete('teams','team_id=%i',$_GET['Delete']);
	DB::delete('teams','individuals=%i',$_GET['Delete']);
	
	header('Location: Home');
}

?>