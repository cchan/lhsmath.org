<?php
/*
 * Admin/Edit_Test.php
 * LHS Math Club Website
 *
 * Allows admins to edit, archive or create tests.
 *
 *
 * Must be linked to using GET parameters:
 *  - 'ID': test id
 *  - one of the following:
 *     - 'Archive': archive test
 *     - 'UnArchive': unarchive test
 *     - 'Edit': edit test
 *     - 'Delete': delete test
 *  - 'xsrf_token': the xsrf token, for archive/unArchive only
 *  - 'Return': where to return afterwards, either 'Edit' (the editing page),
 *      'List' (the test list) or 'ListAll'
 *
 * OR
 *
 * - 'New": create a new test
 */

$path_to_root = '../';
require_once '../lib/functions.php';
restrict_access('A');


if (isSet($_POST['do_add_test']))
	do_add_test();
else if (isSet($_GET['Add']))
	show_add_form('');
else if (!isSet($_GET['ID']))
	trigger_error('No ID passed', E_USER_ERROR);
else if (isSet($_POST['do_perform_edit']))
	do_perform_edit();
elseif (isSet($_POST['do_perform_delete']))
	do_perform_delete();
else if (isSet($_GET['Edit']))
	show_edit_form('');
else if (isSet($_GET['Archive']))
	do_archive(true);
else if (isSet($_GET['UnArchive']))
	do_archive(false);
else if (isSet($_GET['Delete']))
	confirm_delete();
else
	// invalid parameters
	redirect();




function valid_test_id($id){
	return DB::queryFirstField('SELECT COUNT(*) FROM tests WHERE test_id = %i',$id) == 1;
}

/*
 * function do_archive()
 *
 * Archives the specified test by changing "archived" to 1 in the database;
 * If the test is already archived, nothing happens.
 */
function do_archive($archive) {
	// Check XSRF token
	if ($_SESSION['xsrf_token'] != $_GET['xsrf_token'])
		trigger_error('Archive: XSRF token invalid', E_USER_ERROR);
	
	// If Test ID isn't valid, show an error page
	if (!valid_test_id($_GET['ID']))
		trigger_error('Archive: Nonexistent Test ID', E_USER_ERROR);
	
	$archive = $archive ? 1 : 0;
	
	// Otherwise, archive the test
	DB::update('tests',array('archived'=>$archive),'test_id=%i LIMIT 1',$_GET['ID']);
	
	redirect();
}





/*
 * function do_perform_delete()
 *
 * Deletes the specified test
 */
function do_perform_delete() {
	// Check XSRF token
	if ($_SESSION['xsrf_token'] != $_POST['xsrf_token'])
		trigger_error('Delete: XSRF token invalid', E_USER_ERROR);
	
	// Check that the Test ID is valid
	$query = 'SELECT name FROM tests WHERE test_id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '"';
	$result = DB::queryRaw($query);
	
	// If Test ID isn't valid, show an error page
	if (mysqli_num_rows($result) != 1)
		trigger_error('Delete: Nonexistent Test ID', E_USER_ERROR);
		
	$row = mysqli_fetch_assoc($result);
	$test_name = $row['name'];
	
	// Otherwise, delete the test
	$query = 'DELETE FROM tests WHERE test_id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1';
	DB::queryRaw($query);
	

	alert('The test "' . $test_name . '" has been deleted',1);
	
	if ($_GET['Return'] == 'ListAll')
		header('Location: Tests?ShowAll');
	else
		header('Location: Tests');
}





/*
 * function confirm_delete
 *
 * Asks, "Are you sure you want to delete that test?"
 */
function confirm_delete() {
	// Get info
	$query = 'SELECT name FROM tests WHERE test_id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '"';
	$result = DB::queryRaw($query);
	
	// If Test ID isn't valid, show an error page
	if (mysqli_num_rows($result) != 1)
		trigger_error('Delete: Nonexistent Test ID', E_USER_ERROR);
	$row = mysqli_fetch_assoc($result);
	
	// Confirm...
	$request_uri = htmlentities($_SERVER['REQUEST_URI']);
	$redirect_param = '';
	if ($_GET['Return'] == 'ListAll')
		$redirect_param = '?ShowAll';
	page_header('Delete Test');
	echo <<<HEREDOC
      <h1>Confirm Deletion</h1>
      
      Are you sure you want to delete the test &quot;<span class="b">{$row['name']}</span>&quot;?
      <div class="halfbreak"></div>
      <form method="post" action="$request_uri"><div>
        <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
        <input type="submit" name="do_perform_delete" value="Delete"/>
        &nbsp;&nbsp;<a href="Edit_Test?Edit&amp;ID={$_GET['ID']}&amp;Return={$_GET['Return']}">Cancel</a>
      </div></form>
HEREDOC;
}





/*
 * function show_edit_form($err)
 *
 * Shows a form where the admin can edit the test's information
 */
function show_edit_form($err) {
	// Check that the Test ID is valid
	$query = 'SELECT *, DATE_FORMAT(date, "%m/%d/%Y") AS formatted_date FROM tests WHERE test_id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '"';
	$result = DB::queryRaw($query);
	
	// If Test ID isn't valid, show an error page
	if (mysqli_num_rows($result) != 1)
		trigger_error('Show_Edit: Invalid Test ID', E_USER_ERROR);
	
	// Show the form
	$row = mysqli_fetch_assoc($result);
	
	$archived = 'Yes';
	$action = 'UnArchive';
	$action_name = 'Un-Archive';
	if ($row['archived'] == '0') {
		$archived = 'No';
		$action = 'Archive';
		$action_name = 'Archive';
	}
	
	$redirect_param = '';
	if ($_GET['Return'] == 'ListAll')
		$redirect_param = '?ShowAll';
	
	// If an error message is given, put it inside this div
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	$request_uri = htmlentities($_SERVER['REQUEST_URI']);
	
	page_header('Edit Test');
	echo <<<HEREDOC
      <h1>Edit Test</h1>
      
      $err
      <form method="post" action="$request_uri">
      <table class="spacious">
        <tr>
          <td>ID:</td>
          <td><span class="b">{$row['test_id']}</span></td>
        </tr><tr>
          <td>Name:</td>
          <td><input type="text" name="name" value="{$row['name']}" size="20" maxlength="20"/></td>
        </tr><tr>
          <td>Date:</td>
          <td><input type="text" id="date" name="date" value="{$row['formatted_date']}" size="15"/></td>
        </tr><tr>
          <td>Total Points:&nbsp;</td>
          <td><input type="text" name="total_points" value="{$row['total_points']}" size="3"/></td>
        </tr><tr>
          <td>Archived:</td>
          <td>
            <span class="b">$archived</span>
            &nbsp;<span class="small">(<a href="Edit_Test?$action&amp;ID={$row['test_id']}&amp;xsrf_token={$_SESSION['xsrf_token']}&amp;Return=Edit">$action_name</a>)</span>
          </td>
        </tr><tr>
          <td></td>
          <td>
            <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
            <input type="submit" name="do_perform_edit" value="Change"/>
            &nbsp;&nbsp;<a href="Tests$redirect_param">Cancel</a><br /><br /><br />
          </td>
        </tr><tr>
          <td>Delete Test:</td>
          <td>
            <a href="Edit_Test?Delete&amp;ID={$row['test_id']}&amp;Return={$_GET['Return']}" class="b">DELETE</a>
          </td>
        </tr>
      </table>
      </form>
	  <script>
		  $(function() {
			$("#date").datepicker({ });
		  });
	  </script>
HEREDOC;
}





/*
 * function do_perform_edit()
 *
 * Commits an edit to the database
 */
function do_perform_edit() {
	// Check XSRF token
	if ($_SESSION['xsrf_token'] != $_POST['xsrf_token'])
		trigger_error('Do_Edit: XSRF token invalid', E_USER_ERROR);
	
	// Check if ID is valid
	$query = 'SELECT name FROM tests WHERE test_id="' . mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1';
	$result = DB::queryRaw($query);
	
	// If User ID isn't valid, show an error page
	if (mysqli_num_rows($result) != 1)
		show_test_not_found_page();	// at the end, this function die()s.
		
	
	// Validate the entered information:
	//
	
	// Check name length
	$name = mysqli_real_escape_string(DB::get(),htmlentities($_POST['name']));
	if (strlen($_POST['name']) > 20) {
		show_edit_form('Name is too long');
		return;
	}
	if ($name == '') {
		show_edit_form('Name can\'t be blank');
		return;
	}
	
	// Check date
	$date = strtotime($_POST['date']);
	if ($date == false) {
		show_edit_form('Huh? I can\'t understand that date');
		return;
	}
	
	// Check total points
	$total_points = (int)$_POST['total_points'];
	if ($total_points <= 0) {
		show_edit_form('Too few points');
		return;
	}
	
	// ** INFORMATION VALIDATED AT THIS POINT **
	
	$query = 'UPDATE tests SET name="' . $name . '", date="' . date('Y-m-d', $date)
		. '", total_points="' . $total_points . '" WHERE test_id="'
		. mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1';
	
	DB::queryRaw($query);
	
	redirect();
}





/*
 * function show_add_form($err)
 *
 * Shows a form where the admin can add a test
 */
function show_add_form($err) {
	// Put the cursor in the first field
	global $body_onload;
	$body_onload = 'document.forms[\'addTest\'].name.focus()';
	
	// Add some javascript for the jQuery Date Selector
	global $jquery_function;
	$jquery_function = <<<HEREDOC
      $(function() {
        $("#date").datepicker();
      });
HEREDOC;

	$redirect_param = '';
	if ($_GET['Return'] == 'ListAll')
		$redirect_param = '?ShowAll';
	
	// If an error message is given, put it inside this div
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	// Fetch previous data from POST
	$name = htmlentities($_POST['name']);
	$date = htmlentities($_POST['date']);
	$total_points = htmlentities($_POST['total_points']);
	
	$request_uri = htmlentities($_SERVER['REQUEST_URI']);
	
	page_header('Add Test');
	echo <<<HEREDOC
      <h1>Add a Test</h1>
      
      $err
      <form id="addTest" method="post" action="$request_uri">
      <table class="spacious">
        <tr>
          <td>Name:</td>
          <td><input type="text" name="name" value="$name" size="20" maxlength="20"/></td>
        </tr><tr>
          <td>Date:</td>
          <td><input type="text" id="date" name="date" value="$date" size="15"/></td>
        </tr><tr>
          <td>Total Points:&nbsp;</td>
          <td><input type="text" name="total_points" value="$total_points" size="3"/></td>
        </tr><tr>
          <td></td>
          <td>
            <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
            <input type="submit" name="do_add_test" value="Add"/>
            &nbsp;&nbsp;<a href="Tests$redirect_param">Cancel</a>
          </td>
        </tr>
      </table>
      </form>
HEREDOC;
}





/*
 * function do_add_test()
 *
 * Processes the Add Test form
 */
function do_add_test() {
	// Check XSRF token
	if ($_SESSION['xsrf_token'] != $_POST['xsrf_token'])
		trigger_error('Do_Add: XSRF token invalid', E_USER_ERROR);
	
	// Validate the entered information:
	//
	
	// Check name length
	$name = mysqli_real_escape_string(DB::get(),htmlentities($_POST['name']));
	if (strlen($_POST['name']) > 20) {
		show_add_form('Name is too long');
		return;
	}
	if ($name == '') {
		show_add_form('Name can\'t be blank');
		return;
	}
	
	// Check date
	$date = strtotime($_POST['date']);
	if ($date == false) {
		show_add_form('Huh? I can\'t understand that date');
		return;
	}
	
	// Check total points
	$total_points = (int)$_POST['total_points'];
	if ($total_points <= 0) {
		show_add_form('Too few points');
		return;
	}
	
	// ** INFORMATION VALIDATED AT THIS POINT **
	
	$query = 'INSERT INTO tests (name, date, total_points) VALUES("'
		. $name . '", "' . date('Y-m-d', $date) . '", "' . $total_points
		. '")';
	DB::queryRaw($query);
	
	$_SESSION['TEST_added'] = 'The test "' . $name . '" has been added';
	
	redirect();
}





/*
 * function redirect()
 *
 * After an archive operation, the admin is redirected via the Return parameter
 */
function redirect() {
	if ($_GET['Return'] == 'Edit')
		header('Location: Edit_Test?Edit&ID=' . $_GET['ID']);
	else if ($_GET['Return'] == 'ListAll')
		header('Location: Tests?ShowAll');
	else
		header('Location: Tests');
	
	die();
}

?>