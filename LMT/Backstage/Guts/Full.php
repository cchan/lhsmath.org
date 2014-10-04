<?php
/*
 * LMT/Backstage/Guts/Full.php
 * LHS Math Club Website
 *
 * ID: a team's ID
 *
 * Displays a complete list of a team's Guts
 * scores, and allows it to be modified.
 */

$path_to_lmt_root = '../../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
backstage_access();
scoring_access();

if (isSet($_POST['xsrf_token']))
	process_form();
else
	show_page('');





function show_page($err) {
	global $javascript;
	$javascript = <<<HEREDOC
      function nullboxSetState(isClick) {
        if (document.forms['gutsFull'].aHasValue.checked) {
          document.forms['gutsFull'].a.disabled = false;
          if (isClick == 1)
            document.forms['gutsFull'].a.focus();
        }
        else
          document.forms['gutsFull'].a.disabled = true;
        
        if (document.forms['gutsFull'].bHasValue.checked) {
          document.forms['gutsFull'].b.disabled = false;
          if (isClick == 2)
            document.forms['gutsFull'].b.focus();
        }
        else
          document.forms['gutsFull'].b.disabled = true;
        
        if (document.forms['gutsFull'].cHasValue.checked) {
          document.forms['gutsFull'].c.disabled = false;
          if (isClick == 3)
            document.forms['gutsFull'].c.focus();
        }
        else
          document.forms['gutsFull'].c.disabled = true;
      }
HEREDOC;
	
	global $body_onload;
	$body_onload = 'nullboxSetState(-1);';
	
	lmt_page_header('Guts Round');
	
	$row = DB::queryFirstRow('SELECT name, guts_ans_a, guts_ans_b, guts_ans_c, '
		. '(SELECT name FROM schools WHERE schools.school_id=teams.school) AS school_name '
		. 'FROM teams WHERE team_id="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '"');
	
	$team_name = htmlentities($row['name']);
	$school_name = htmlentities($row['school_name']);
	$a = $row['guts_ans_a'];
	$b = $row['guts_ans_b'];
	$c = $row['guts_ans_c'];
	if (is_null($a)) {
		$a = '';
		$a_checked = '';
	}
	else {
		$a = htmlentities($a);
		$a_checked = ' checked="checked"';
	}
	if (is_null($b)) {
		$b = '';
		$b_checked = '';
	}
	else {
		$b = htmlentities($b);
		$b_checked = ' checked="checked"';
		$b_hidden = $b;
	}
	if (is_null($c)) {
		$c = '';
		$c_checked = '';
	}
	else {
		$c = htmlentities($c);
		$c_checked = ' checked="checked"';
	}
	
	$result = DB::queryRaw('SELECT problem_set, score FROM guts WHERE team="'
		. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '" ORDER BY problem_set');
	
	$selected = array();
	for($i=1;$i<12;$i++)$selected[$i]=array('','','','');
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		if(isSet($row['score'])){
			$selected[$row['problem_set']][$row['score']] = ' selected="selected"';
			$scores[$row['problem_set']] = htmlentities($row['score']);
		}
		$row = mysqli_fetch_assoc($result);
	}
	$table = '';
	for ($set = 1; $set < 12; $set++) {
		$problems = (3 * $set - 2) . ' to ' . (3 * $set);
		if (isSet($scores[$set]))
			$value = $scores[$set];
		else
			$value = 'None';
		
		if (!isSet($selected[$set]))
			$none_selected = ' selected="selected"';
		else
			$none_selected = '';
		
		$table .= <<<HEREDOC
        <tr>
          <td>$set</td>
          <td>$problems</td>
          <td>
            <select name="$set" class="text-centered">
              <option value="None"$none_selected>None</option>
              <option value="0"{$selected[$set][0]}>0</option>
              <option value="1"{$selected[$set][1]}>1</option>
              <option value="2"{$selected[$set][2]}>2</option>
              <option value="3"{$selected[$set][3]}>3</option>
            </select>
          </td>
          <td>
            <input type="hidden" name="previous_value_$set" value="$value" />
            <input type="submit" name="guts_full_update_$set" value="Update" />
          </td>
        </tr>
HEREDOC;
		//$row = $next_row;
		
	}
	
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	$alert = fetch_alert('gutsFull');
	
	echo <<<HEREDOC
      <h1>Guts Round</h1>
      
      <div class="text-centered">
        Note that only one set may be changed at a time. When you are done making changes, please
        double-check that all scores are entered as intended. Note that invalid answers to the last
        three problems will be treated as no answer. Lastly, do not use the enter key on this page.
      </div>
      <br /><br />
      
      $err$alert
      <h3 class="noMargin">$team_name</h3>
      <div class="halfbreak"></div>
      <span class="i">$school_name</span><br />
      <br />
      
      <form id="gutsFull" method="post" action="{$_SERVER['REQUEST_URI']}"><div>
      <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
      
      <table class="contrasting text-centered">
        <tr>
          <th>Set</th>
          <th>Problems</th>
          <th>Score/Answer</th>
          <th></th>
        </tr>
$table
        <tr>
          <td></td>
          <td>34</td>
          <td>
            <input type="checkbox" name="aHasValue" value="Yes" onchange="nullboxSetState(1);"$a_checked />
            <input type="text" name="a" size="10" maxlength="100" value="$a" />
          </td>
          <td><input type="submit" name="guts_full_update_a" value="Update" /></td>
        </tr>
        <tr>
          <td style="background-color: #f7fcff;">12</td>
          <td>35</td>
          <td>
            <input type="checkbox" name="bHasValue" value="Yes" onchange="nullboxSetState(2);"$b_checked />
            <input type="text" name="b" size="10" maxlength="100" value="$b" />
          </td>
          <td><input type="submit" name="guts_full_update_b" value="Update" /></td>
        </tr>
        <tr>
          <td></td>
          <td>36</td>
          <td>
            <input type="checkbox" name="cHasValue" value="Yes" onchange="nullboxSetState(3);"$c_checked />
            <input type="text" name="c" size="10" maxlength="100" value="$c" />
          </td>
          <td><input type="submit" name="guts_full_update_c" value="Update" /></td>
        </tr>
      </table></div></form>
HEREDOC;
	lmt_backstage_footer('');
	die;
}





function process_form() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	if (isSet($_POST['guts_full_update_a'])
		|| isSet($_POST['guts_full_update_b'])
		|| isSet($_POST['guts_full_update_c']))
		process_special_form(); // and don't come back
	
	$set = null;
	for ($n = 1; $n < 12; $n++) {
		if (isSet($_POST['guts_full_update_' . $n]))
			$set = $n;
	}
	
	if (is_null($set))
		trigger_error('No button clicked', E_USER_ERROR);
	
	if ($_POST[$set] == 'None')
		$score = NULL;
	else {
		$score = (int) htmlentities($_POST[$set]);
		if ($score < 0 || $score > 3)
			trigger_error('Invalid score?!', E_USER_ERROR);
	}
	
	if ($_POST['previous_value_' . $set] == 'None') {
		$row = DB::queryFirstRow('SELECT COUNT(*) FROM guts WHERE problem_set="'
			. mysqli_real_escape_string($GLOBALS['LMT_DB'],$set) . '" AND team="'
			. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '"');
		if ($row['COUNT(*)'] != '0')
			show_page('The value of that field has changed. Make sure no '
				. 'one else is currently entering scores for this team, and '
				. 'try again.');
		
		if (!is_null($score)) {
			DB::queryRaw('INSERT INTO guts (team, problem_set, score) VALUES ("'
				. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '", "'
				. mysqli_real_escape_string($GLOBALS['LMT_DB'],$set) . '", "'
				. mysqli_real_escape_string($GLOBALS['LMT_DB'],$score) . '")');
		}
	}
	else {
		$result = DB::queryRaw('SELECT score FROM guts WHERE problem_set="'
			. mysqli_real_escape_string($GLOBALS['LMT_DB'],$set) . '" AND team="'
			. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '"');
		if (mysqli_num_rows($result) == 0)
			show_page('The value of that field has changed. Make sure no '
				. 'one else is currently entering scores for this team, and '
				. 'try again.');
		
		if (is_null($score)) {
			DB::queryRaw('DELETE FROM guts WHERE team="'
				. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '" AND problem_set="'
				. mysqli_real_escape_string($GLOBALS['LMT_DB'],$set) . '" LIMIT 1');
		}
		else {
			DB::queryRaw('UPDATE guts SET score="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$score)
				. '" WHERE team="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID'])
				. '" AND problem_set="' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$set) . '"');
		}
	}
	add_alert('gutsFull', 'The score for set ' . $set . ' has been updated');
	header('Location: ' . $_SERVER['REQUEST_URI']);
	die;
}





function process_special_form() {
	if (isSet($_POST['guts_full_update_a'])) {
		$problem = 34;
		$field = 'guts_ans_a';
		$has_value = ($_POST['aHasValue'] == 'Yes');
		$prev = $_POST['previous_value_a'];
		$new = $_POST['a'];
	}
	else if (isSet($_POST['guts_full_update_b'])) {
		$problem = 35;
		$field = 'guts_ans_b';
		$has_value = ($_POST['bHasValue'] == 'Yes');
		$prev = $_POST['previous_value_b'];
		$new = $_POST['b'];
	}
	else if (isSet($_POST['guts_full_update_c'])) {
		$problem = 36;
		$field = 'guts_ans_c';
		$has_value = ($_POST['cHasValue'] == 'Yes');
		$prev = $_POST['previous_value_c'];
		$new = $_POST['c'];
	}
	else
		trigger_error('None of the three special answer fields clicked?!', E_USER_ERROR);
	
	if ($has_value) {
		if (strlen($new) > 100)
			trigger_error('Answers too long!', E_USER_ERROR);
		
		$new = prescreen_guts($problem, $new);
	}
	else
		$new = null;
	
	if (is_null($new))
		$new = 'NULL';
	else
		$new = '"' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$new) . '"';
	
	DB::queryRaw('UPDATE teams SET ' . mysqli_real_escape_string($GLOBALS['LMT_DB'],$field) . '='
		. $new . ' WHERE team_id="'
		. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '" LIMIT 1');
	
	add_alert('gutsFull', 'The score for problem ' . $problem . ' has been updated');
	header('Location: ' . $_SERVER['REQUEST_URI']);
	die;
}

?>