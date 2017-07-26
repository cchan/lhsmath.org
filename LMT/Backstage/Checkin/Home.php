<?php
/*
 * LMT/Backstage/Checkin/Home.php
 * LHS Math Club Website
 *
 * A dashboard page for staff running checkin
 */

require_once '../../../.lib/lmt-functions.php';
backstage_access();
lmt_page_header('Check-in');

if (isSet($_GET['SCH_ID']))
	find_school($_GET['SCH_ID']);
else if (isSet($_GET['IND_ID']))
	find_individual($_GET['IND_ID']);
else if (isSet($_GET['Download']))
  download_csv();

function download_csv() {
	// Get Data
	$file = "Team ID,Team Name,School\n";
	
	$result = DB::queryRaw('SELECT team_id, teams.name AS team_name, schools.name AS school_name FROM teams '
		. 'LEFT JOIN schools ON teams.school=schools.school_id WHERE teams.deleted="0" ORDER BY team_id');
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$id = htmlentities($row['team_id']);
		$team_name = htmlentities($row['team_name']);
		$school_name = htmlentities($row['school_name']);
		if ($school_name == '')
			$school_name = 'None';
		
		$file .= $id . "," . $team_name . "," . $school_name . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	
	// Download File
	header('Content-Description: File Transfer');
	header('Content-Type: text/csv');
	header('Content-Disposition: attachment; filename="Team List.csv"');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: ' . strlen($file));
	cancel_templateify();
	ob_clean();
	flush();
	echo $file;
}

function find_school($id) {
	$school_id = DB::queryFirstField('SELECT school FROM teams WHERE team_id=%i AND deleted="0"',$id);
	if (is_null($school_id)){
		alert('School not found',-1);
		return;
	}
	
	lmt_location("Backstage/Checkin/School?ID=".$id);
}

function find_individual($id) {
	$row = DB::queryFirstRow('SELECT id, name, email, grade, paid, attendance FROM individuals WHERE id=%i AND deleted="0"',$id);
	if ($row == null){
		alert('Individual not found',-1);
		return;
	}
	else if ($row['email'] == ""){
		alert('Individual was registered as part of a team',-1);
		return;
	}
	
	lmt_location("Backstage/Checkin/Individual?ID=".$id);
	
	$individual_id = intval($row['id']);
	$name = htmlentities($row['name']);
	$email = htmlentities($row['email']);
	$grade = htmlentities($row['grade']);
	$paid = ($row['paid'] == "1") ? '<span style="color: red">Yes</span>' : 'No';
	$attendance = ($row['attendance'] == "1") ? '<span style="color: red">Present</span>' : 'Absent';
?>
      <h1>Individual Check-in</h1>
      $err
      <form method="post" action="{$_SERVER['REQUEST_URI']}">
        <table>
          <tr>
            <td>ID:</td>
            <td class="b">$id&nbsp;&nbsp;<span class="small">(<a href="../Data/Individual?ID=$id">Data Page</a>)</span></td>
          </tr><tr>
            <td>Name:</td>
            <td class="b">$name</td>
          </tr><tr>
            <td>Email:</td>
            <td class="b">$email</td>
          </tr><tr>
            <td>Grade:</td>
            <td class="b">$grade</td>
          </tr><tr>
            <td>Paid:</td>
            <td class="b">$paid</td>
          </tr><tr>
            <td>Attendance:&nbsp;</td>
            <td class="b">$attendance<br /><br /></td>
          </tr><tr>
            <td>Check-in:</td>
            <td>
              <input id="paid" type="checkbox" name="paid" value="Yes" checked="checked"/>
              <label for="paid">Payment has been received</label>
              <br />
              <input id="attendance" type="checkbox" name="attendance" value="Yes" checked="checked"/>
              <label for="attendance">Individual is present</label>
            </td>
          </tr><tr>
            <td></td>
            <td>
              <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
              <input type="submit" name="do_lmt_checkin_individual" value="Update" />
              &nbsp;<a href="Home">Cancel</a>
            </td>
          </tr>
        </table>
      </form>
<?php
}
?>
  <h1>Check-in</h1>
  <!--h3>Check in by ID</h3>
  <form id="lmtSchoolCheckin" method="GET" action="<?=$_SERVER['REQUEST_URI']?>"><div>
	School ID:
	<input type="text" name="SCH_ID" size="5" class="focus" />
	<input type="submit" value="Find" />
  </div></form>
  <div class="halfbreak"></div>
  
  <form method="GET" action="<?=$_SERVER['REQUEST_URI']?>"><div>
	Unaffiliated Individual ID:
	<input type="text" name="IND_ID" size="5" />
	<input type="submit" value="Find" />
  </div></form-->
  
  <h3>Search Schools, Teams, and Individuals by Name</h3>
  <form id="lmtSearchAll" method="get" action="../Search"><div>
    <input type="text" id="autocomplete" name="Query" size="35" />
    <input type="hidden" name="Scope" value="School Team Individual" />
    <input type="hidden" name="From" value="Checkin Home" />
    <input type="hidden" name="Return" value="Checkin" />
    <input type="submit" value="Search" />
  </div></form>
  
  <h3>Team List</h3>
  
  <table class="visible">
    <tr>
      <th>"ID"</th>
      <th>Here</th>
      <th>Team Name</th>
      <th>School</th>
    </tr>
<?php
	
	$result = DB::queryRaw('SELECT team_id, school_id, teams.name AS team_name, schools.name AS school_name,
  count(individuals.id) AS teamMembersTotal, count(case attendance when 1 then 1 else null end) AS attendanceTotal
  
  FROM teams 
  LEFT JOIN schools ON teams.school=schools.school_id 
  LEFT JOIN individuals ON individuals.team=teams.team_id 
  
  WHERE (individuals.deleted is null OR individuals.deleted="0") AND teams.deleted="0" AND (schools.deleted is null OR schools.deleted="0") GROUP BY team_id ORDER BY team_name');
	$row = mysqli_fetch_assoc($result);
  $i = 0;
	while ($row) {
    $i ++;
    $attendanceTotal = intval($row['attendanceTotal']);
    $teamMembersTotal = intval($row['teamMembersTotal']);
    $attendanceColor = ($attendanceTotal==$teamMembersTotal && $teamMembersTotal >= 4)?"green":"red";
		$id = intval($row['team_id']);
    $sid = intval($row['school_id']);
		$team_name = htmlentities($row['team_name']);
		$school_name = htmlentities($row['school_name']);
		if ($school_name == '')
			$school_name = '<span class="i">None</span>';
		
		echo <<<HEREDOC
        <tr>
          <td>$i</td>
          <td style="color:$attendanceColor">$attendanceTotal/$teamMembersTotal</td>
          <td><a href="School?ID=$sid">$team_name</a> [T$id]</td>
          <td><a href="School?ID=$sid">$school_name</a> [S$sid]</td>
        </tr>
		
HEREDOC;
		$row = mysqli_fetch_assoc($result);
	}
?>
  </table>
  
  <h3>Other</h3>
  <a href="Print">Print Attendance Sheets</a>
  <div class="halfbreak"></div>
  <a href="?Download">Download Team List CSV</a>
