<?php
/*
 * LMT/Backstage/Checkin/School.php
 * LHS Math Club Website
 *
 * - ID: the ID of a school
 */

$path_to_lmt_root = '../../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
backstage_access();

if (isSet($_POST['do_lmt_checkin_school']))
	process_form();
else
	show_page();


function show_page() {
	$id = htmlentities($_GET['ID']);
	$row = DB::queryFirstRow('SELECT name, coach_email, teams_paid FROM schools WHERE school_id=%i AND deleted="0"',$id);
	$name = htmlentities($row['name']);
	$email = htmlentities($row['coach_email']);
	$grade = htmlentities($row['grade']);
	$paid = htmlentities($row['teams_paid']);
	
	$result = DB::queryRaw('SELECT team_id, name FROM teams WHERE school=%i AND deleted="0" ORDER BY name',$id);
	$num_teams = htmlentities(mysqli_num_rows($result));
	$add_teams_paid = $num_teams - $paid;
	if ($add_teams_paid < 0) {
		$add_teams_paid = '0';
		$paid = '<span style="color: red">' . $paid . '</span>';
	}
	else
		$add_teams_paid = htmlentities($add_teams_paid);
	
	$team_table = '';
	$n = 0;
	if ($num_teams != 0)
		$team_table = <<<HEREDOC

          </tr><tr>
            <td colspan="2"><h3>Team Attendance</h3></td>
HEREDOC;
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$team_name = htmlentities($row['name']);
		$team_table .= <<<HEREDOC

          </tr><tr>
            <td class="b">$team_name</td>
            <td>

HEREDOC;
		
		$result2 = DB::queryRaw('SELECT id, name, attendance, grade FROM individuals WHERE team="'
			. mysqli_real_escape_string(DB::get(),$row['team_id']) . '" AND deleted="0" ORDER BY name');
		$row2 = mysqli_fetch_assoc($result2);
		while ($row2) {
			$indiv_id = htmlentities($row2['id']);
			$indiv_name = htmlentities($row2['name']);
			$indiv_grade = htmlentities($row2['grade']);
			$checked = ($row2['attendance']) ? 'checked="checked" ' : '';
			$team_table .= <<<HEREDOC
              <input id="indiv_$n" type="checkbox" name="indiv[$indiv_id]" value="Yes" $checked/>
              <label for="indiv_$n">$indiv_name&nbsp;&nbsp;($indiv_grade)</label><br />
HEREDOC;
			$row2 = mysqli_fetch_assoc($result2);
			$n++;
		}
		if (mysqli_num_rows($result2) == 0)
			$team_table .= <<<HEREDOC
              Team has no members<br />
HEREDOC;
		$team_table .= "\n            <br /></td>";
		$row = mysqli_fetch_assoc($result);
	}
	
	
	lmt_page_header('Check-in');
	echo <<<HEREDOC
      <h1>School Check-in</h1>
      $err
      <form method="post" action="{$_SERVER['REQUEST_URI']}">
        <table>
          <tr>
            <td colspan="2"><h3>School Information</h3></td>
          </tr><tr>
            <td>ID:</td>
            <td class="b">$id&nbsp;&nbsp;<span class="small">(<a href="../Data/School?ID=$id">Data Page</a>)</span></td>
          </tr><tr>
            <td>School Name:&nbsp;</td>
            <td class="b">$name</td>
          </tr><tr>
            <td>Coach Email:</td>
            <td class="b">$email</td>
          </tr><tr>
            <td>Num. Teams:</td>
            <td class="b">$num_teams</td>
          </tr><tr>
            <td>Teams Paid:</td>
            <td class="b">$paid<br /><br /></td>
          </tr><tr>
            <td>Check-in:</td>
            <td>
              <input type="text" name="add_teams_paid" value="$add_teams_paid" size="5" />
              &nbsp; more teams paid for
              <br /><br />
            </td>$team_table
          </tr><tr>
            <td></td>
            <td>
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
              <input type="submit" name="do_lmt_checkin_school" value="Update" />
              &nbsp;<a href="Home">Cancel</a>
            </td>
          </tr>
        </table>
      </form>
HEREDOC;
	lmt_backstage_footer('');
	die;
}





function process_form() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$paid = ($_POST['paid'] == 'Yes') ? '1' : '0';
	$attendance = ($_POST['attendance'] == 'Yes') ? '1' : '0';
	
	$row = DB::queryFirstRow('SELECT name FROM schools WHERE school_id="'
		. mysqli_real_escape_string(DB::get(),$_GET['ID']) . '"');
	$name = htmlentities($row['name']);
	
	DB::queryRaw('UPDATE schools SET teams_paid = teams_paid + "'
		. mysqli_real_escape_string(DB::get(),$_POST['add_teams_paid']) . '" LIMIT 1');
	
	$present = array();
	$pid = 0;
	
	if (count($_POST['indiv']) > 0) {
		foreach ($_POST['indiv'] as $indiv_id => $attendance) {
			if ($attendance == 'Yes')
				$present[$pid++] = mysqli_real_escape_string(DB::get(),$indiv_id);
		}
	}
	
	DB::queryRaw('UPDATE individuals SET attendance="0" WHERE'
		. ' team = ANY (SELECT team_id FROM teams WHERE school = "'
		. mysqli_real_escape_string(DB::get(),$_GET['ID']) . '")');
	
	if (count($present) > 0) {
		$query = 'UPDATE individuals SET attendance="1" WHERE (';
		$first = true;
		foreach ($present as $indiv_id) {
			if (!$first)
				$query .= ' OR ';
			$query .= 'id="' . $indiv_id . '"';
			$first = false;
		}
		$query .= ') LIMIT ' . mysqli_real_escape_string(DB::get(),count($present));
		DB::queryRaw($query);
	}
	
	alert($name . ' has been updated. (<a href="School?ID=' . htmlentities($_GET['ID']) . '" style="color: blue">go back</a>)',1);
	header('Location: Home');
}

?>
