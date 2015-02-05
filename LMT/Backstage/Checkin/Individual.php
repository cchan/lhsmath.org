<?php
/*
 * LMT/Backstage/Checkin/Individual.php
 * LHS Math Club Website
 *
 * - ID: the ID of an individual
 */

$path_to_lmt_root = '../../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
backstage_access();

page_title('Check-in');

if (isSet($_POST['do_lmt_checkin_individual']))
	process_form();
else
	show_page();


function show_page() {
	$row = DB::queryFirstRow('SELECT id, name, email, grade, paid, attendance FROM individuals WHERE id=%i AND deleted="0"',$_GET['ID']);
	
	if ($row == null){
		alert('Individual not found',-1);
		lmt_location('Home');
	}
	else if ($row['email'] == ""){
		alert('Individual was registered as part of a team',-1);
		lmt_location('Home');
	}
	
	$id = htmlentities($row['id']);
	$name = htmlentities($row['name']);
	$email = htmlentities($row['email']);
	$grade = htmlentities($row['grade']);
	$paid = ($row['paid'] == "1") ? '<span style="color: red">Yes</span>' : 'No';
	$attendance = ($row['attendance'] == "1") ? '<span style="color: red">Present</span>' : 'Absent';
	
	echo <<<HEREDOC
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
HEREDOC;
	die;
}





function process_form() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$paid = ($_POST['paid'] == 'Yes') ? '1' : '0';
	$attendance = ($_POST['attendance'] == 'Yes') ? '1' : '0';
	
	$name = DB::queryFirstField('SELECT name FROM individuals WHERE id=%i',$_GET['ID']);
	
	DB::update('individuals',array('paid'=>$paid,'attendance'=>$attendance),'id=%i',$_GET['ID']);
	
	alert($name . ' has been checked in. (<a href="Individual?ID=' . htmlentities($_GET['ID']) . '">go back</a>)',1);
	header('Location: Home');
}

?>
