<?php
/*
 * LMT/Backstage/Checkin/Home.php
 * LHS Math Club Website
 *
 * A dashboard page for staff running checkin
 */

require_once '../../../lib/lmt-functions.php';
backstage_access();
lmt_page_header('Check-in');

if (isSet($_GET['SCH_ID']))
	find_school($_GET['SCH_ID']);
else if (isSet($_GET['IND_ID']))
	find_individual($_GET['IND_ID']);

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
  <h3>Check in by ID</h3>
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
  </div></form>
  
  <h3>Search by Name</h3>
  <form id="lmtSearchAll" method="get" action="../Search"><div>
	<input type="text" id="autocomplete" name="Query" size="35" />
	<input type="hidden" name="Scope" value="School Individual" />
	<input type="hidden" name="From" value="Checkin Home" />
	<input type="hidden" name="Return" value="Checkin" />
	<input type="submit" value="Search" />
  </div></form>
  
  <h3>Other</h3>
  <a href="Print">Print Attendance Sheets</a>
  <div class="halfbreak"></div>
  <a href="Team_List">Download Team List</a>
