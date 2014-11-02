<?php
/*
 * Admin/Temporary_Users.php
 * LHS Math Club Website
 *
 * Allows admins to manage temporary users.
 */


$path_to_root = '../';
require_once '../lib/functions.php';
restrict_access('A');


if (isSet($_POST['do_combine_duplicate']))
	do_combine_duplicate();
else if (isSet($_POST['do_combine']))
	do_combine();
else if (isSet($_POST['do_delete']))
	do_delete();
else if (isSet($_GET['Combine']))
	show_combine_page('');
else if (isSet($_GET['Delete']))
	show_delete_page('');
else
	show_list();





/*
 * function show_list()
 *
 * Shows a list of temporary users with links to combine or remove them
 */
function show_list() {
	page_header('Temporary Users');
	
	// Assemble page
	echo <<<HEREDOC
      <h1>Temporary Users</h1>
      
      <div class="instruction">
        Temporary accounts can be created from the Enter Scores page when the actual
        user does not yet have an account. When the user creates their real account,
        and has been approved, use this page to combine the two.
      </div>
      

HEREDOC;
	
	$query = 'SELECT * FROM users WHERE permissions="T"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	
	if (!$row)
		echo <<<HEREDOC
      <h4>There are no temporary users.</h4>
HEREDOC;
	else
		echo <<<HEREDOC
      <br />
      <table class="contrasting">

HEREDOC;
	
	while ($row) {
		echo <<<HEREDOC
        <tr>
          <td>{$row['name']}</td>
          <td><a href="Temporary_Users?Combine&amp;ID={$row['id']}">Combine</a></td>
          <td><a href="Temporary_Users?Delete&amp;ID={$row['id']}">Delete</a></td>
        </tr>
HEREDOC;
		$row = mysqli_fetch_assoc($result);
	}
	
	echo <<<HEREDOC

      </table>
HEREDOC;
	
	admin_page_footer('Temporary Users');
}





/*
 * function show_combine_page($err)
 *
 * Shows a page that allows the admin to choose a user to combine with.
 */
function show_combine_page($err) {
	$row = DB::queryFirstRow('SELECT id, name FROM users WHERE id=%i',$_GET['ID']);
	if (is_null($row))
		trigger_error('Show_Combine: Invalid User ID', E_USER_ERROR);
	
	$id = $row['id'];
	$name = $row['name'];
	
	// Add some javascript for the jQuery Autocomplete
	autocomplete_js('#userAutocomplete',autocomplete_users_data());
	
	// If an error message is given, put it inside this div
	if ($err != '')
		alert($err,-1);
	
	page_header('Temporary Users');
	
	echo <<<HEREDOC
      <h1>Temporary Users</h1>
      
      $err
      <span class="b">Temporary User $name's Test Scores</span><br /><br />

HEREDOC;
	
	echo create_score_table($id);
	
	global $duplicate_with_id;
	if ($duplicate_with_id != '') {
		echo <<<HEREDOC
      
      <br /><br />
      <span class="b">Actual Account's Test Scores</span><br /><br />

HEREDOC;
		
		echo create_score_table($duplicate_with_id);
		
		$htmlentities_duplicate_with_id = htmlentities($duplicate_with_id);
		$request_url = htmlentities($_SERVER['REQUEST_URI']);
		
		echo <<<HEREDOC
      <br /><br /><br />
      <form method="post" action="$request_uri"><div>
        <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
        <input type="hidden" name="combine_with_id" value="$htmlentities_duplicate_with_id"/>
        <input type="submit" name="do_combine_duplicate" value="Combine Anyway"/>&nbsp;&nbsp;
        <a href="Temporary_Users">Cancel</a>
      </div></form>
HEREDOC;
	} else
		echo <<<HEREDOC
      <br /><br /><br />
      <form method="post" action="$request_uri"><div>
        Combine with:
        <input type="text" id="userAutocomplete" name="actual_user" size="25"/><br /><br />$duplicate_input
        <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
        <input type="submit" name="do_combine" value="Combine"/>&nbsp;&nbsp;
        <a href="Temporary_Users">Cancel</a>
      </div></form>
HEREDOC;
	
	admin_page_footer('Temporary Users');
}





/*
 * function do_combine()
 *
 * Combines a temporary user's score with the actual users'
 */
function do_combine() {
	// Check XSRF token
	if ($_SESSION['xsrf_token'] != $_POST['xsrf_token'])
		trigger_error('Combine: Invalid XSRF token', E_USER_ERROR);
	
	// Must enter a user to combine with
	if ($_POST['actual_user'] == '') {
		show_combine_page('You must enter an account to combine this one into');
		return;
	}
	
	// Check user ID
	$id = $_GET['ID'];
	$query = 'SELECT name FROM users WHERE id="' . mysqli_real_escape_string(DB::get(),$id) . '" AND permissions="T"';
	$result = DB::queryRaw($query);
	
	if (mysqli_num_rows($result) != 1)
		trigger_error('Do_Combine: Invalid User ID', E_USER_ERROR);
	
	// Locate entered user
	$ans = form_autocomplete_query($_POST['actual_user']);
	if ($ans['type'] == 'none') {
		show_combine_page('"' . htmlentities($_POST['actual_user']). '" could not be found');
		return;
	} else if ($ans['type'] == 'multiple') {
		show_combine_page('"' . htmlentities($_POST['actual_user']). '" matches multiple people');
		return;
	}
	
	$row = $ans['row'];
	
	if ($row['permissions'] == 'T') {
		show_combine_page('You cannot combine two temporary users');
		return;
	}
	
	$combine_with = $row['id'];
	
	
	// Check for duplicate values
	$query = 'SELECT COUNT(*) AS num_tests FROM test_scores WHERE user_id="' . mysqli_real_escape_string(DB::get(),$id)
		. '" OR user_id="' . mysqli_real_escape_string(DB::get(),$combine_with) . '" GROUP BY test_id';
	$result = DB::queryRaw($query);
	
	$no_duplicates = true;
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		if ($row['num_tests'] > 1)
			$no_duplicates = false;
		$row = mysqli_fetch_assoc($result);
	}
	if (!$no_duplicates) {
		global $duplicate_with_id;
		$duplicate_with_id = $combine_with;
		show_combine_page('Some tests overlap. The actual account\'s scores will be used.');
		return;
	}
	
	// INFORMATION VALIDATED
	
	$query = 'UPDATE test_scores SET user_id="' . mysqli_real_escape_string(DB::get(),$combine_with) . '"'
		. ' WHERE user_id="' . mysqli_real_escape_string(DB::get(),$id) . '"';
	DB::queryRaw($query);
	
	$query = 'DELETE FROM users WHERE id="' . mysqli_real_escape_string(DB::get(),$id) . '" LIMIT 1';
	DB::queryRaw($query);
	
	header('Location: Temporary_Users');
}





/*
 * function do_combine_duplicate()
 *
 * Combines a temporary user's score with the actual users', keeping the actual account's test scores in the event of duplicates
 */
function do_combine_duplicate() {
	// Check XSRF token
	if ($_SESSION['xsrf_token'] != $_POST['xsrf_token'])
		trigger_error('Combine_Duplicate: Invalid XSRF token', E_USER_ERROR);
	
	// Must enter a user to combine with
	if ($_POST['combine_with_id'] == '') {
		show_combine_page('You must enter an account to combine this one into');
		return;
	}
	
	// Check user ID
	$id = $_GET['ID'];
	$query = 'SELECT name FROM users WHERE id="' . mysqli_real_escape_string(DB::get(),$id) . '" AND permissions="T"';
	$result = DB::queryRaw($query);
	
	if (mysqli_num_rows($result) != 1)
		trigger_error('Do_Combine_Duplicate: Invalid User ID', E_USER_ERROR);
	
	// Check combine-with user ID
	$combine_with = $_POST['combine_with_id'];
	$query = 'SELECT name FROM users WHERE id="' . mysqli_real_escape_string(DB::get(),$combine_with) . '"';
	$result = DB::queryRaw($query);
	
	if (mysqli_num_rows($result) != 1)
		trigger_error('Do_Combine_Duplicate: Invalid combine-with User ID', E_USER_ERROR);
	
	if ($combine_with == $id) {
		show_combine_page('You cannot combine this account with itself');
		return;
	}
	
	// INFORMATION VALIDATED
	
	$query = 'SELECT test_id FROM test_scores WHERE user_id="' . mysqli_real_escape_string(DB::get(),$combine_with) . '"';
	$old_tests_result = DB::queryRaw($query);
	$old_tests_row = mysqli_fetch_assoc($old_tests_result);
	
	while ($old_tests_row) {
		$query = 'SELECT score FROM test_scores WHERE test_id="' . mysqli_real_escape_string(DB::get(),$old_tests_row['test_id'])
			. '" AND user_id="' . mysqli_real_escape_string(DB::get(),$id) . '" LIMIT 1';
		$result = DB::queryRaw($query);
		
		if (mysqli_num_rows($result) == 0) {	// not a duplicate; okay to change
			$row = mysqli_fetch_assoc($result);
			$query = 'UPDATE test_scores SET user_id="' . mysqli_real_escape_string(DB::get(),$id)
				. '" WHERE user_id="' . mysqli_real_escape_string(DB::get(),$combine_with) . '"';
		}
		$old_tests_row = mysqli_fetch_assoc($old_tests_result);
	}
	
	// remove duplicates
	$query = 'DELETE FROM test_scores WHERE user_id="' . mysqli_real_escape_string(DB::get(),$id) . '"';
	DB::queryRaw($query);
	
	$query = 'DELETE FROM users WHERE id="' . mysqli_real_escape_string(DB::get(),$id) . '" LIMIT 1';
	DB::queryRaw($query);
	
	header('Location: Temporary_Users');
}





/*
 * function show_delete_page($err)
 *
 * Shows a page to confirm deletion of a temporary user
 */
function show_delete_page($err) {
	$id = $_GET['ID'];
	$query = 'SELECT name FROM users WHERE id="' . mysqli_real_escape_string(DB::get(),$id) . '" AND permissions="T"';
	$result = DB::queryRaw($query);
	
	if (mysqli_num_rows($result) != 1)
		trigger_error('Show_Delete: Invalid User ID', E_USER_ERROR);
	
	$row = mysqli_fetch_assoc($result);
	$name = $row['name'];
	
	page_header('Temporary Users');
	
	// If an error message is given, put it inside this div
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	echo <<<HEREDOC
      <h1>Temporary Users</h1>
      
      $err
      <span class="b">$name's Temporary Test Scores</span><br /><br />

HEREDOC;
	
	echo create_score_table($id);
	
	$request_uri = htmlentities($_SERVER['REQUEST_URI']);
	
	echo <<<HEREDOC
      
      <br /><br />
      <form method="post" action="$request_uri"><div>
        Are you sure you want to delete this temporary account?<br /><br />
        <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
        <input type="submit" name="do_delete" value="Delete"/>&nbsp;&nbsp;
        <a href="Temporary_Users">Cancel</a>
      </div></form>
HEREDOC;
	
	admin_page_footer('Temporary Users');
}





/*
 * function do_delete()
 *
 * Deletes a temporary user
 */
function do_delete() {
	// Check XSRF token
	if ($_SESSION['xsrf_token'] != $_POST['xsrf_token'])
		trigger_error('Delete: Invalid XSRF token', E_USER_ERROR);
	
	// Check user ID
	$id = $_GET['ID'];
	$query = 'SELECT name FROM users WHERE id="' . mysqli_real_escape_string(DB::get(),$id) . '" AND permissions="T"';
	$result = DB::queryRaw($query);
	
	if (mysqli_num_rows($result) != 1)
		trigger_error('Do_Delete: Invalid User ID', E_USER_ERROR);
	
	// Do delete
	$query = 'DELETE FROM users WHERE id="' . mysqli_real_escape_string(DB::get(),$id) . '" LIMIT 1';
	DB::queryRaw($query);
	
	$query = 'DELETE FROM test_scores WHERE user_id="' . mysqli_real_escape_string(DB::get(),$id) . '"';
	DB::queryRaw($query);
	
	header('Location: Temporary_Users');
}





/*
 * function create_score_table($id)
 *
 * Returns XHTML code for a table of a users' scores
 */
function create_score_table($id) {
	$query = 'SELECT test_scores.score AS score, tests.name AS name, tests.total_points AS total'
			. ' FROM test_scores'
			. ' INNER JOIN tests ON tests.test_id=test_scores.test_id'
			. ' WHERE test_scores.user_id="' . mysqli_real_escape_string(DB::get(),$id) . '"'
			. ' ORDER BY tests.test_id';
	$result = DB::queryRaw($query);
	
	$table = <<<HEREDOC
      <table class="contrasting">
        <tr>
          <th>Test</th>
          <th>Score</th>
          <th>Total Points</th>
        </tr>

HEREDOC;
	
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$table .= <<<HEREDOC
        <tr>
          <td>{$row['name']}</td>
          <td>{$row['score']}</td>
          <td>{$row['total']}</td>
        </tr>

HEREDOC;
		$row = mysqli_fetch_assoc($result);
	}
	
	$table .= <<<HEREDOC
      </table>

HEREDOC;
	
	return $table;
}

?>