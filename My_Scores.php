<?php
/*
 * My_Scores.php
 * LHS Math Club Website
 *
 * Displays the user's contest scores
 */

$path_to_root = '';
require_once 'lib/functions.php';
restrict_access('RA');


show_page();





function show_page() {
	page_header('My Scores');
	
	echo <<<HEREDOC
      <h1>My Scores</h1>
      
HEREDOC;

	$query = 'SELECT test_scores.score AS score, tests.name AS name, tests.total_points AS total, DATE_FORMAT(tests.date, "%M %e, %Y") AS formatted_date'
			. ' FROM test_scores'
			. ' INNER JOIN tests ON tests.test_id=test_scores.test_id'
			. ' WHERE test_scores.user_id="' . mysql_real_escape_string($_SESSION['user_id']) . '" AND archived="0"'
			. ' ORDER BY tests.date DESC';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	
	if (mysql_num_rows($result) > 0) {
		echo <<<HEREDOC
      <h4>Recent Tests</h4>
      <table class="contrasting">
        <tr>
          <th>Test</th>
          <th>Score</th>
          <th>Date</th>
        </tr>

HEREDOC;
		
		$row = mysql_fetch_assoc($result);
		while ($row) {
			$score_display = $row['score'] . ' <span class="scorepart">/ ' . $row['total'] . '</span>';
			if ($row['total'] == 1)
				$score_display = ($row['score'] == 1) ? 'Yes' : 'No';
			
			echo <<<HEREDOC
        <tr>
          <td>{$row['name']}</td>
          <td class="text-centered">$score_display</td>
          <td>{$row['formatted_date']}</td>
        </tr>

HEREDOC;
			$row = mysql_fetch_assoc($result);
		}
		echo <<<HEREDOC
      </table>
      <br /><br />

HEREDOC;
	}
	else
		echo <<<HEREDOC
      <h4 class="smbottom">Recent Tests</h4><div class="halfbreak"></div>
      &nbsp;&nbsp;There are no recent tests to display.
      <br /><br />
      

HEREDOC;
	
	
	
	$query = 'SELECT test_scores.score AS score, tests.name AS name, tests.total_points AS total, DATE_FORMAT(tests.date, "%M %e, %Y") AS formatted_date'
			. ' FROM test_scores'
			. ' INNER JOIN tests ON tests.test_id=test_scores.test_id'
			. ' WHERE test_scores.user_id="' . mysql_real_escape_string($_SESSION['user_id']) . '" AND archived="1"'
			. ' ORDER BY tests.date DESC';
	$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
	
	if (mysql_num_rows($result) > 0) {
		echo <<<HEREDOC
      <h4 class="smbottom">Old Tests</h4><div class="halfbreak"></div>
      <table class="contrasting">
        <tr>
          <th>Test</th>
          <th>Score</th>
          <th>Date</th>
        </tr>

HEREDOC;
		
		$row = mysql_fetch_assoc($result);
		while ($row) {
			$score_display = $row['score'] . ' <span class="scorepart">/ ' . $row['total'] . '</span>';
			if ($row['total'] == 1)
				$score_display = ($row['score'] == 1) ? 'Yes' : 'No';
			
			echo <<<HEREDOC
        <tr>
          <td>{$row['name']}</td>
          <td class="text-centered">$score_display</td>
          <td>{$row['formatted_date']}</td>
        </tr>

HEREDOC;
			$row = mysql_fetch_assoc($result);
		}
		
		echo <<<HEREDOC
      </table>
HEREDOC;
	}
	else
		echo <<<HEREDOC
      <h4 class="smbottom">Old Tests</h4><div class="halfbreak"></div>
      &nbsp;&nbsp;There are no old tests to display.
HEREDOC;
	default_page_footer('My Scores');
}

?>