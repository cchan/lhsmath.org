<?php
/*
 * Admin/Enter_Scores.php
 * LHS Math Club Website
 *
 * Allows Admins to enter test scores for members
 *
 * Requires the GET parameter 'ID' set to the ID of the test to enter.
 */


$path_to_root = '../';
require_once '../lib/functions.php';
restrict_access('A');
if (isSet($_POST['do_add_score']))
	process_form();
else if (isSet($_GET['Override']))
	do_override();
else if (isSet($_GET['Overridden']))
	show_page('', 'Entered a score of ' . htmlentities($_GET['Score']) . ' for ' . htmlentities($_GET['Name']));
else if (isSet($_GET['Temporary']))
	do_create_temporary_user();
else if (isSet($_GET['ID']))
	show_page('', '');
else
	header('Location: Tests');





/*
 * function show_page($err, $msg)
 *
 * Shows a page that allows admins to enter test scores
 */
function show_page($err, $msg) {
	// Get data about test, if not already cached in form data
	$test_name = htmlentities($_POST['test_name']);
	$total_points = htmlentities($_POST['total_points']);
	
	if (!isSet($_POST['test_name']) || !isSet($_POST['total_points'])) {
		$query = 'SELECT name, total_points FROM tests WHERE test_id="'
			. mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1';
		$result = DB::queryRaw($query);
		if (mysqli_num_rows($result) != 1)
			trigger_error('Show_Page: Invalid Test ID', E_USER_ERROR);
		
		$row = mysqli_fetch_assoc($result);
		$test_name = $row['name'];
		$total_points = $row['total_points'];
	}
	
	// Put the cursor in the first field
	global $body_onload;
	$body_onload = 'document.forms[\'enterScore\'].user.focus()';
	
	// Add some javascript for the jQuery Autocomplete
	global $jquery_function;
	$jquery_function = <<<HEREDOC
	$(function() {
		$( "#userAutocomplete" ).autocomplete({
			source: "User_Autocomplete?T",
			minLength: 2
		});
	});

HEREDOC;
	
	// If an (error) message is given, put it inside this div
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	if ($msg != '')
		$msg = "\n        <div class=\"alert\">$msg</div><br />\n";
	
	page_header('Enter Scores');
	echo <<<HEREDOC
      <h1>Enter Scores</h1>
      
      <h3>$test_name</h3>
      Total Points: <b>$total_points</b>
      <br />
      <br />
      <br />
      $err$msg
      <form id="enterScore" method="post" action="{$_SERVER['REQUEST_URI']}">
      <table class="spacious">
        <tr>
          <td>Name:</td>
          <td><input type="text" id="userAutocomplete" name="user" size="25"/></td>
        </tr><tr>
          <td>Score:&nbsp;</td>
          <td><input type="text" name="score" size="3"/></td>
        </tr><tr>
          <td></td>
          <td>
            <input type="hidden" name="test_name" value="$test_name"/>
            <input type="hidden" name="total_points" value="$total_points"/>
            <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
            <input type="submit" name="do_add_score" value="Enter"/>
            &nbsp;&nbsp;<a href="Tests">Cancel</a>
          </td>
        </tr>
      </table>
      </form>
HEREDOC;
	admin_page_footer('');
}






/*
 * function process_form()
 *
 * Processes the form
 */
function process_form() {
	// Check XSRF token
	if ($_SESSION['xsrf_token'] != $_POST['xsrf_token'])
		trigger_error('Invalid XSRF token', E_USER_ERROR);
	
	// No blank data
	if ($_POST['user'] == '') {
		show_page('Please enter a name', '');
		return;
	}
	if ($_POST['score'] == '') {
		show_page('Please enter a score', '');
		return;
	}
	
	// Check that test exists
	$row = DB::queryFirstRow('SELECT test_id, total_points FROM tests WHERE test_id=%s LIMIT 1',$_GET['ID']);
	
	if (!$row)
		trigger_error('Process_Form: Invalid Test ID', E_USER_ERROR);
	
	$test_id = intval($row['test_id']);
	$total_points = intval($row['total_points']);
	
	// Verify score
	$score = intval($_POST['score']);
	if(!val('i0+',$_POST['score']) || $score > $total_points){
		show_page('Score must be a nonnegative integer not more than the total points.');
		return;
	}
	
	// Locate User
	$ans = form_autocomplete_query($_POST['user']);
	
	if ($ans['type'] == 'none') {
		// Validate name
		$name_is_valid = true;
		$name = htmlentities(ucwords(trim($_POST['user'])));
		$name = preg_replace('/\s\s+/', ' ', $name);
		if (strlen($name) > 25 || strlen($name) < 6)
			$name_is_valid = false;
		if (!preg_match('/^[A-Za-z-\s]+$/', $name))
			$name_is_valid = false;
		
		if ($name_is_valid)
			show_page('Could not find "' . $name
				. '". <a href="Enter_Scores?Temporary&amp;ID=' . $_GET['ID']
				. '&amp;User=' . $name . '&amp;Score=' . $_POST['score']
				. '&amp;xsrf_token=' . $_SESSION['xsrf_token'] . '">Create Temporary User?</a>', '');
		else
			show_page('Could not find "' . $name
				. '". It is not a valid name.', '');
		return;
	}
	else if ($ans['type'] == 'multiple') {
		if (!$ans['exact']) {
			// Validate name
			$name_is_valid = true;
			$name = htmlentities(ucwords(trim($_POST['user'])));
			$name = preg_replace('/\s\s+/', ' ', $name);
			if (strlen($name) > 25 || strlen($name) < 6)
				$name_is_valid = false;
			if (!preg_match('/^[A-Za-z-\s]+$/', $name))
				$name_is_valid = false;
			
			if ($name_is_valid)
				show_page('"' . htmlentities($_POST['user']). '" matches multiple people.'
					. '" <a href="Enter_Scores?Temporary&amp;ID=' . $_GET['ID']
					. '&amp;User=' . $name . '&amp;Score=' . $_POST['score']
					. '&amp;xsrf_token=' . $_SESSION['xsrf_token'] . '">Create Temporary User?</a>', '');
			else
				show_page('"' . htmlentities($_POST['user']). '" matches multiple people.', '');
		}
		else
			show_page('"' . htmlentities($_POST['user']). '" matches multiple people.', '');
		return;
	}
	
	$row = $ans['row'];
	$user_id = (int)$row['id'];
	$name = htmlentities($row['name']);
	
	// Check for previously-entered scores
	$query = 'SELECT score FROM test_scores WHERE test_id="' . $test_id
		. '" AND user_id="' . $user_id . '" LIMIT 1';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	
	if ($row) {
		if ($row['score'] == $_POST['score'])
			show_page('This person\'s score has already been entered as '
				. htmlentities($row['score']), '');
		else
			show_page('This person\'s score has already been entered as '
				. htmlentities($row['score'])
				. '. <a href="Enter_Scores?Override&amp;ID=' . $_GET['ID']
				. '&amp;User=' . $user_id . '&amp;Score=' . $_POST['score']
				. '&amp;xsrf_token=' . $_SESSION['xsrf_token'] . '">Change to ' . htmlentities($score) . '?</a>', '');
		return;
	}
	
	// INFORMATION VALIDATED
	
	$query = 'INSERT INTO test_scores (test_id, user_id, score) VALUES ("'
		. mysqli_real_escape_string(DB::get(),$test_id) . '", "'
		. mysqli_real_escape_string(DB::get(),$user_id) . '", "'
		. mysqli_real_escape_string(DB::get(),$score) . '")';
	DB::queryRaw($query);
	show_page('', 'Entered a score of ' . htmlentities($score) . ' for ' . htmlentities($name));
}






/*
 * function do_override()
 *
 * Changes the specified score in the database
 */
function do_override() {
	if ($_GET['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('Override: Invalid XSRF token', E_USER_ERROR);
	
	// Check that test exists
	$query = 'SELECT test_id, total_points FROM tests WHERE test_id="'
		. mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1';
	$result = DB::queryRaw($query);
	
	if (mysqli_num_rows($result) != 1)
		trigger_error('Override: Invalid Test ID', E_USER_ERROR);
	
	$row = mysqli_fetch_assoc($result);
	$test_id = (int)$row['test_id'];
	$total_points = (int)$row['total_points'];
	
	// Locate user
	$user_id = mysqli_real_escape_string(DB::get(),$_GET['User']);
	$query = 'SELECT id, name FROM users WHERE id="' . $user_id . '" LIMIT 2';
	$result = DB::queryRaw($query);
	
	if (mysqli_num_rows($result) > 1)
		trigger_error('Override: Multiple users match ID', E_USER_ERROR);
	if (mysqli_num_rows($result) != 1)
		trigger_error('Override: No usres match ID', E_USER_ERROR);
	
	$row = mysqli_fetch_assoc($result);
	$user_id = (int)$row['id'];
	$name = htmlentities($row['name']);
	
	// Verify score
	$score = (int)$_GET['Score'];
	if (!preg_match('/^(\d)*$/', $_GET['Score']))
		trigger_error('Override: Score could not be parsed', E_USER_ERROR);
	if ($score > $total_points)
		trigger_error('Override: Score > total_points', E_USER_ERROR);
	if ($score < 0)
		trigger_error('Override: Negative score', E_USER_ERROR);
	
	// INFORMATION VALIDATED
	
	$query = 'UPDATE test_scores SET score="' . mysqli_real_escape_string(DB::get(),$score)
		. '" WHERE user_id="' . mysqli_real_escape_string(DB::get(),$user_id)
		. '" AND test_id="' . mysqli_real_escape_string(DB::get(),$test_id) . '" LIMIT 1';
	DB::queryRaw($query);
	header('Location: Enter_Scores?Overridden&ID=' . $_GET['ID'] . '&Score=' . $score . '&Name=' . $name);
	die();
}





/*
 * function do_create_temporary_user()
 *
 * If the user does not have an account, create a temporary one for them.
 */
function do_create_temporary_user() {
	if ($_GET['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('Temporary_User: Invalid XSRF token', E_USER_ERROR);
	
	// Validate name
	$name = htmlentities(ucwords(trim($_GET['User'])));
		// capitalizes first letters if they didn't do it; removes whitespace before and after.
		// and makes sure to escape the name
	$name = preg_replace('/\s\s+/', ' ', $name);	// removes multiple consecutive spaces, thanks to juglesh at http://bytes.com/topic/php/answers/160400-delete-multiple-spaces-special-characters
	
	if (strlen($name) > 25 || strlen($name) < 6)
		trigger_error('Temporary_User: Invalid  name length', E_USER_ERROR);
	
	// Check for extraneous characters
	if (!preg_match('/^[A-Za-z-\s]+$/', $name))
		trigger_error('Temporary_User: Bad characters in name', E_USER_ERROR);
	
	// Check that test exists
	$query = 'SELECT test_id, total_points FROM tests WHERE test_id="'
		. mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1';
	$result = DB::queryRaw($query);
	
	if (mysqli_num_rows($result) != 1)
		trigger_error('Temporary_User: Invalid Test ID', E_USER_ERROR);
	
	$row = mysqli_fetch_assoc($result);
	$test_id = (int)$row['test_id'];
	$total_points = (int)$row['total_points'];
	
	// Check that user does not exist
	$name = mysqli_real_escape_string(DB::get(),$_GET['User']);
	$name = preg_replace("/\\040\\050.*\\051/", "", $name);	// remove stuff in parentheses
	$name = str_replace(" ", "%", $name);
	$query = 'SELECT id, name FROM users WHERE name="' . $name . '" AND (permissions="R" OR permissions="A" OR permissions="C" OR permissions="T") AND approved="1" LIMIT 2';
	$result = DB::queryRaw($query);
	
	if (mysqli_num_rows($result) > 0)
		trigger_error('Temporary_User: User already exists', E_USER_ERROR);
	
	// Verify score
	$score = (int)$_GET['Score'];
	if (!preg_match('/^(\d)*$/', $_GET['Score']))
		trigger_error('Temporary_User: Score could not be parsed', E_USER_ERROR);
	if ($score > $total_points)
		trigger_error('Temporary_User: Score > total_points', E_USER_ERROR);
	if ($score < 0)
		trigger_error('Temporary_User: Negative score', E_USER_ERROR);
	
	// INFORMATION VALIDATED
	
	$name = mysqli_real_escape_string(DB::get(),htmlentities($_GET['User']));
	$query = 'INSERT INTO users (name, permissions, approved) VALUES ("' . $name . '", "T", 1)';
	DB::queryRaw($query);
	
	$query = 'SELECT id FROM users WHERE name="' . $name . '"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	$user_id = $row['id'];
	
	$query = 'INSERT INTO test_scores (test_id, user_id, score) VALUES ("'
		. mysqli_real_escape_string(DB::get(),$test_id) . '", "'
		. mysqli_real_escape_string(DB::get(),$user_id) . '", "'
		. mysqli_real_escape_string(DB::get(),$score) . '")';
	DB::queryRaw($query);
	header('Location: Enter_Scores?Overridden&ID=' . $_GET['ID'] . '&Score=' . $score . '&Name=' . $name);
	die();
}

?>