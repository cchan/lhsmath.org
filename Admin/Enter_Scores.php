<?php
/*
 * Admin/Enter_Scores.php
 * LHS Math Club Website
 *
 * Allows Admins to enter test scores for members
 *
 * Requires the GET parameter 'ID' set to the ID of the test to enter.
 */
//NOTE: WHAT IF YOU'RE TRYING TO CREATE A TEMPORARY USER WITH THE SAME
//NAME AS SOMEONE ELSE IN A DIFFERENT GRADE

$path_to_root = '../';
require_once '../lib/functions.php';
restrict_access('A');
if (isSet($_POST['do_add_score']) || isSet($_GET['Override']) || isSet($_GET['Temporary']))
	process_form();
else if (isSet($_GET['ID']))
	show_page('', '');
else
	header('Location: Tests');

/*
 * function show_page($err, $msg)
 *
 * Shows a page that allows admins to enter test scores
 */
function show_page() {
	// Check that the provided ID exists
	$row = DB::queryFirstRow('SELECT test_id, name, total_points FROM tests WHERE test_id=%i LIMIT 1',$_REQUEST['ID']);
	if (is_null($row)) trigger_error('Show_Page: Invalid Test ID', E_USER_ERROR);
	$test_id = $row['test_id'];
	$test_name = $row['name'];
	$total_points = $row['total_points'];
	
	page_title('Enter Scores');
	
	echo autocomplete_js("#userAutocomplete",autocomplete_users_data());
?>
      <h1>Enter Scores</h1>
      
      <h3><?=$test_name?></h3>
      Total Points: <b><?=$total_points?></b>
      <br />
      <br />
      <br />
      <form id="enterScore" method="post" action="Enter_Scores" autocomplete="off">
      <table class="spacious">
        <tr>
          <td>Name:</td>
          <td><input type="text" id="userAutocomplete" name="user" class="focus" size="25"/></td>
        </tr><tr>
          <td>Score:&nbsp;</td>
          <td><input type="text" name="score" size="3"/></td>
        </tr><tr>
          <td></td>
          <td>
			<input type="hidden" name="ID" value="<?=$test_id?>"/>
            <input type="hidden" name="xsrf_token" value="<?=$_SESSION['xsrf_token']?>"/>
            <input type="submit" name="do_add_score" value="Enter"/>
            &nbsp;&nbsp;<a href="Tests">Cancel</a>
          </td>
        </tr>
      </table>
      </form>
<?php
}






/*
 * function process_form()
 *
 * Processes the form
 */
function process_form() {
	// Check XSRF token
	if ($_SESSION['xsrf_token'] != $_REQUEST['xsrf_token'])
		trigger_error('Invalid XSRF token', E_USER_ERROR);
	
	//Check Test ID
	$row = DB::queryFirstRow('SELECT test_id, name, total_points FROM tests WHERE test_id=%s LIMIT 1',$_REQUEST['ID']);
	if (!$row) trigger_error('Process_Form: Invalid Test ID', E_USER_ERROR);
	
	//Get some data
	$test_name = $row['name'];
	$test_id = intval($row['test_id']);
	$total_points = intval($row['total_points']);
	$score = $_REQUEST['score']; //No intval() because intval('') is 0.
	$user = sanitize_username($_REQUEST['user']);
	
	if($user === false)//Validate username
		alert('Name must have only letters, hyphens, apostrophes, and spaces, and be between 3 and 30 characters long',-1);
	elseif(!val('i0+',$score) || ($score = intval($score)) > $total_points)//Validate Score
		alert('Score must be a nonnegative integer not more than the total points',-1);
	elseif (count($userdata = autocomplete_users_php($_REQUEST['user'])) == 0) { // Check for username - No such users found.
		if($_GET['Temporary']){
			if (DB::queryFirstField('SELECT COUNT(*) FROM users WHERE name=%s',$user) > 0)
				alert('User already exists!',-1);
			
			DB::insert('users',array('name'=>$user,'permissions'=>'T','approved'=>1));
			DB::insert('test_scores',array('test_id'=>$test_id,'user_id'=>DB::insertId(),'score'=>$score));
		}
		else
			alert('Could not find <b>' . $user
				. '</b>. <a href="Enter_Scores?Temporary&amp;ID=' . $test_id
				. '&amp;user=' . $user . '&amp;score=' . $score
				. '&amp;xsrf_token=' . $_SESSION['xsrf_token'] . '">Create Temporary User</a>?', -1);
	}
	elseif (count($userdata) > 1) {
		alert('<b>'.$user.'</b> matches multiple people.'
			. ' <a href="Enter_Scores?Temporary&amp;ID=' .  $test_id
			. '&amp;user=' . $user . '&amp;score=' . $score
			. '&amp;xsrf_token=' . $_SESSION['xsrf_token'] . '">Create Temporary User?</a>', -1);
	}
	else{ //We've got exactly one match for the user name.
		$user = $userdata[0]['name'];
		$user_id = (int)$userdata[0]['id'];
		
		// Check for previously-entered scores
		$row = DB::queryFirstRow('SELECT score_id, score FROM test_scores WHERE test_id=%i AND user_id=%i LIMIT 1',$test_id,$user_id);
		$prev_score = $row['score'];
		$score_id = $row['score_id'];
		
		if (!is_null($prev_score)) { //Already entered.
			$prev_score = intval($prev_score);
			if ($prev_score == $score)
				alert('<b>'.$user.'</b>\'s score has already been entered as ' . $prev_score, -1);
			else if (isSet($_REQUEST['Override'])){
				DB::update('test_scores',array('score'=>$score),'score_id=%i LIMIT 1',$score_id);
				alert('Changed score from ' . $prev_score . ' to ' . $score . ' for <b>' . $user . '</b>',1);
			}
			else{
				alert("<b>$user</b>'s score has already been entered as $prev_score. <a href='?Override&ID=$test_id&user=$user&score=$score&xsrf_token={$_SESSION['xsrf_token']}'>Change to $score?</a>", -1);
			}
		}
		else{ //Non-duplicate, valid. Let's enter it.
			DB::insert('test_scores',array('test_id'=>$test_id,'user_id'=>$user_id,'score'=>$score));
			alert('Entered a score of ' . $score . ' for ' . $user,1);
		}
	}
	show_page();
}

?>