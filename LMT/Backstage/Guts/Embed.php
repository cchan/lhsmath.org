<?php
/*
 * LMT/Backstage/Guts/Embed.php
 * LHS Math Club Website
 *
 * Produces the content of the data entry boxes
 * that are embedded into the main Guts Round
 * scoring page
 */

$miniature_page = true;
$path_to_lmt_root = '../../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
backstage_access();
scoring_access();

if (isSet($_POST['score']))
	process_form();
else if (isSet($_POST['score_special']))
	score_special();
else if (isSet($_POST['go_back']))
	cancel_score();
else if (isSet($_GET['ID']))
	show_scoring_page();
else
	show_setup_page();





function show_setup_page() {
	$teams_dropdown = make_teams_dropdown();
	echo <<<HEREDOC
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title></title>
    <link rel="stylesheet" href="../../../res/default.css" type="text/css" media="all" />
    <link rel="stylesheet" href="../../../res/lmt.css" type="text/css" media="all" />
    <link rel="stylesheet" href="../../../res/print.css" type="text/css" media="print" />
  </head>
  
  <body class="gutsEmbedSetup">
    <form method="get" action="{$_SERVER['REQUEST_URI']}">
      <table>
        <tr>
          <td>Team:</td>
          <td>
$teams_dropdown
          </td>
        </tr><tr>
          <td>Color:&nbsp;</td>
          <td>
            <select name="Color" style="width: 100px;">
              <option value="fff" style="background-color: #fff;">White</option>
              <option value="f66" style="background-color: #f66;">Red</option>
              <option value="fc9" style="background-color: #fc9;">Orange</option>
              <option value="ffc" style="background-color: #ffc;">Yellow</option>
              <option value="cf9" style="background-color: #cf9;">Green</option>
              <option value="9fc" style="background-color: #9fc;">Turquoise</option>
              <option value="9cf" style="background-color: #9cf;">Blue</option>
              <option value="ccf" style="background-color: #ccf;">Purple</option>
              <option value="fcf" style="background-color: #fcf;">Pink</option>
              <option value="f6358a" style="background-color: #f6358a;">Dark Pink</option>
              <option value="eee" style="background-color: #eee;">Gray</option>
            </select>
          </td>
        </tr><tr>
          <td></td>
          <td><input type="submit" value="Select" /></td>
        </tr>
      </table>
    </form>
  </body>
</html>
HEREDOC;
	die;
}





function make_teams_dropdown() {
	$sp = '            ';
	$return = $sp . '<select name="ID">' . "\n"
		. $sp . '  <option value="-1"></option>' . "\n";
	
	$result = lmt_query('SELECT teams.team_id, teams.name, schools.name AS school_name FROM teams'
		. ' LEFT JOIN schools ON teams.school=schools.school_id WHERE team_id <> "'
		. $except . '" AND teams.deleted="0" ORDER BY name');
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$school = htmlentities($row['school_name']);
		if ($school == '')
			$school = 'Individuals';
		$return .= $sp . '  <option value="' . htmlentities($row['team_id']) . '">'
			. htmlentities($row['name']) . '&nbsp;&nbsp;(' . $school . ')</option>' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	$return .= $sp . '</select>';
	return $return;
}





function show_scoring_page() {
	if ($_GET['ID'] == -1)
		show_setup_page();
	
	$request_uri = htmlentities($_SERVER['REQUEST_URI']);
	$color = htmlentities($_GET['Color']);
	$id = htmlentities($_GET['ID']);
	
	$row = lmt_query('SELECT name FROM teams WHERE team_id="'
		. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '" AND deleted = "0"', true);
	$team = htmlentities($row['name']);
	
	$row = lmt_query('SELECT MAX(problem_set) FROM guts WHERE team="'
		. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '"', true);
	$set = (int) htmlentities($row['MAX(problem_set)']) + 1;
	$problems = (3 * $set - 2) . ', ' . (3 * $set -  1) . ', ' . ' and ' . (3 * $set);
	
	if ($set > 1) {
		$row = lmt_query('SELECT score FROM guts WHERE problem_set="'
			. mysqli_real_escape_string($GLOBALS['LMT_DB'],$set - 1) . '" AND team="'
			. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '"', true);
		$prev_right_val = (int) htmlentities($row['score']);
		
		if ($set == 12) {
			// Check for answers to round 13 in the other table
			$row  = lmt_query('SELECT guts_ans_a, guts_ans_b, guts_ans_c FROM teams WHERE team_id="'
				. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '"', true);
			if (!is_null($row['guts_ans_a']) || !is_null($row['guts_ans_b']) || !is_null($row['guts_ans_c']))
				show_completed_page(htmlentities($team),
					array(1 => $row['guts_ans_a'], 2 => $row['guts_ans_b'], 3 => $row['guts_ans_c']));	// so, set is actually 13
			
			show_special_input_page(htmlentities($team), $prev_right_val); // set is indeed 12
		}
		
		$previous_right = <<<HEREDOC
        Score on last set: <span class="b">$prev_right_val</span>&nbsp;
        <input type="submit" name="go_back" value="Cancel" />
        <div class="halfbreak"></div>
HEREDOC;
	}
	
	echo <<<HEREDOC
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title></title>
    <link rel="stylesheet" href="../../../res/default.css" type="text/css" media="all" />
    <link rel="stylesheet" href="../../../res/lmt.css" type="text/css" media="all" />
    <link rel="stylesheet" href="../../../res/print.css" type="text/css" media="print" />
  </head>
  
  <body class="gutsEmbedScoring" style="background-color: #$color">
    <form method="post" action="$request_uri">
      <table class="noMargin">
        <tr>
          <td>Team:</td>
          <td class="b">$team</td>
        </tr><tr>
          <td>Now On:</td>
          <td class="b">$problems</td>
        </tr><tr>
          <td>Score:</td>
          <td>
            <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
            <input type="hidden" name="set" value="$set" />
            <input type="submit" name="score" value="0" />
            <input type="submit" name="score" value="1" />
            <input type="submit" name="score" value="2" />
            <input type="submit" name="score" value="3" />
          </td>
        </tr>
      </table>
      
      <div class="gutsEmbedBottom small">
$previous_right
      	<a href="$request_uri">Reload</a>&nbsp;&nbsp;&nbsp;
        <a href="Embed">Switch Team</a>&nbsp;&nbsp;&nbsp;
        <a href="Full?ID=$id" target="_blank">All Scores</a>
      </div>
    </form>
  </body>
</html>
HEREDOC;
	die;
}





function show_special_input_page($team_name, $last_score) {
	$color = htmlentities($_GET['Color']);
	$request_uri = htmlentities($_SERVER['REQUEST_URI']);
	$id = htmlentities($_GET['ID']);
	
	echo <<<HEREDOC
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title></title>
    <link rel="stylesheet" href="../../../res/default.css" type="text/css" media="all" />
    <link rel="stylesheet" href="../../../res/lmt.css" type="text/css" media="all" />
    <link rel="stylesheet" href="../../../res/print.css" type="text/css" media="print" />
  </head>
  
  <body class="gutsEmbedScoring" style="background-color: #$color">
    <form method="post" action="$request_uri">
      <table class="noMargin">
        <tr>
          <td>Team:&nbsp;</td>
          <td class="b">$team_name</td>
          <td></td>
          <td></td>
        </tr><tr>
          <td>34:</td>
          <td><input type="text" name="ans34" size="10" tabindex="1" maxlength="100" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
          <td>36:</td>
          <td><input type="text" name="ans36" size="10" tabindex="3" maxlength="100" /></td>
        </tr><tr>
          <td>35:</td>
          <td><input type="text" name="ans35" size="10" tabindex="2" maxlength="100" /></td>
          <td></td>
          <td>
            <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
            <input type="hidden" name="set" value="12" tabindex="4" />
            <input type="submit" name="score_special" value="Record" />
          </td>
        </tr>
      </table>
      
      <div class="gutsEmbedBottom small">
        Score on last set: <span class="b">$last_score</span>&nbsp;
        <input type="submit" name="go_back" value="Cancel" />
        <div class="halfbreak"></div>
      	<a href="$request_uri">Reload</a>&nbsp;&nbsp;&nbsp;
        <a href="Embed">Switch Team</a>&nbsp;&nbsp;&nbsp;
        <a href="Full?ID=$id" target="_blank">All Scores</a>
      </div>
    </form>
  </body>
</html>
HEREDOC;
	die;
}





function show_completed_page($team_name, $ans) {
	$color = htmlentities($_GET['Color']);
	$request_uri = htmlentities($_SERVER['REQUEST_URI']);
	$id = htmlentities($_GET['ID']);
	
	$a = htmlentities($ans[1]);
	$b = htmlentities($ans[2]);
	$c = htmlentities($ans[3]);
	
	echo <<<HEREDOC
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title></title>
    <link rel="stylesheet" href="../../../res/default.css" type="text/css" media="all" />
    <link rel="stylesheet" href="../../../res/lmt.css" type="text/css" media="all" />
    <link rel="stylesheet" href="../../../res/print.css" type="text/css" media="print" />
  </head>
  
  <body class="gutsEmbedScoring" style="background-color: #$color;">
    <div class="text-centered">
      <br />
      Team <span class="b">$team_name</span> has completed the Guts Round.<br />
      Last answers: [<span class="b">$a</span>], [<span class="b">$b</span>], and [<span class="b">$c</span>].
      
      <div class="gutsEmbedBottom small">
        <form method="post" action="$request_uri"><div>
          <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
          <input type="hidden" name="set" value="13" />
          <input type="submit" name="go_back" value="Cancel" />
        </div></form>
        <div class="halfbreak"></div>
      	<a href="$request_uri">Reload</a>&nbsp;&nbsp;&nbsp;
        <a href="Embed">Switch Team</a>&nbsp;&nbsp;&nbsp;
        <a href="Full?ID=$id" target="_blank">All Scores</a>
      </div>
    </div>
  </body>
</html>
HEREDOC;
	die;
}





function process_form() {
	// Process the regular form
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$score = (int) htmlentities($_POST['score']);
	if ($score < 0 || $score > 3)
		trigger_error('Invalid score?!', E_USER_ERROR);
	
	$set = (int) htmlentities($_POST['set']);
	if ($set < 1 || $set > 11)
		trigger_error('Invalid set?!', E_USER_ERROR);
	
	$row  = lmt_query('SELECT COUNT(*) FROM guts WHERE team="'
		. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '" AND problem_set="'
		. mysqli_real_escape_string($GLOBALS['LMT_DB'],$set) . '"', true);
	if ($row['COUNT(*)'] != 0)
		show_duplicate_scores_warning();
	
	lmt_query('INSERT INTO guts (team, problem_set, score) VALUES ("'
		. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '", "'
		. mysqli_real_escape_string($GLOBALS['LMT_DB'],$set) . '", "'
		. mysqli_real_escape_string($GLOBALS['LMT_DB'],$score) . '")');
	
	show_scoring_page();
}





function show_duplicate_scores_warning() {
	// When there is already a score entered, alert the grader
	$color = htmlentities($_GET['Color']);
	$request_uri = htmlentities($_SERVER['REQUEST_URI']);
	$id = htmlentities($_GET['ID']);
	$set = htmlentities($_POST['set']);
	
	echo <<<HEREDOC
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title></title>
    <link rel="stylesheet" href="../../../res/default.css" type="text/css" media="all" />
    <link rel="stylesheet" href="../../../res/lmt.css" type="text/css" media="all" />
    <link rel="stylesheet" href="../../../res/print.css" type="text/css" media="print" />
  </head>
  
  <body class="gutsEmbedScoring" style="background-color: #$color">
    <div class="text-centered">
      <br />
      <span class="b">Warning:</span> This team already has a score entered for
      problem set $set. Please reconcile the <a href="Full?ID=$id" target="_blank">full score sheet</a>
      before <a href="$request_uri">continuing</a>.
      <div class="gutsEmbedBottom small">
      	<a href="$request_uri">Reload</a>&nbsp;&nbsp;&nbsp;
        <a href="Embed">Switch Team</a>&nbsp;&nbsp;&nbsp;
        <a href="Full?ID=$id" target="_blank">All Scores</a>
      </div>
    </div>
  </body>
</html>
HEREDOC;
	die;
}





function score_special() {
	// Scoring for the last probelem set, where a score
	// is calculated by algorithm or based on other peoples'
	// answers
	
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	if ($_POST['set'] != 12)
		trigger_error('Invalid set?!', E_USER_ERROR);
	
	$row  = lmt_query('SELECT guts_ans_a, guts_ans_b, guts_ans_c FROM teams WHERE team_id="'
		. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '"', true);
	if (!is_null($row['guts_ans_a']) || !is_null($row['guts_ans_b']) || !is_null($row['guts_ans_c']))
		show_duplicate_scores_warning();
	
	$ans_34 = $_POST['ans34'];
	$ans_35 = $_POST['ans35'];
	$ans_36 = $_POST['ans36'];
	
	if (strlen($ans_34) > 100 || strlen($ans_35) > 100 || strlen($ans_36) > 100)
		trigger_error('Answers too long!', E_USER_ERROR);
	
	$ans_34 = prescreen_guts(34, $ans_34);
	$ans_35 = prescreen_guts(35, $ans_35);
	$ans_36 = prescreen_guts(36, $ans_36);
	
	if (is_null($ans_34))
		$ans_34 = 'NULL';
	else
		$ans_34 = '"' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$ans_34) . '"';
	if (is_null($ans_35))
		$ans_35 = 'NULL';
	else
		$ans_35 = '"' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$ans_35) . '"';
	if (is_null($ans_36))
		$ans_36 = 'NULL';
	else
		$ans_36 = '"' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$ans_36) . '"';
	
	lmt_query('UPDATE teams SET guts_ans_a='
		. $ans_34 . ', guts_ans_b='
		. $ans_35 . ', guts_ans_c='
		. $ans_36 . ' WHERE team_id="'
		. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '" LIMIT 1');
	
	show_scoring_page();
}





function cancel_score() {
	// Cancel the last round's score
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$set = (int) htmlentities($_POST['set']) - 1;
	if ($set < 1 || $set > 12)
		trigger_error('Invalid set?!', E_USER_ERROR);
	
	if ($set == 12) {
		// Scores are as text entered into TEAMS table
		lmt_query('UPDATE teams SET guts_ans_a=NULL, guts_ans_b=NULL, guts_ans_c=NULL WHERE team_id="'
			. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '" LIMIT 1');
	} else {
		lmt_query('DELETE FROM guts WHERE team="'
			. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '" AND problem_set="'
			. mysqli_real_escape_string($GLOBALS['LMT_DB'],$set) . '"');
	}
	
	show_scoring_page();
}

?>