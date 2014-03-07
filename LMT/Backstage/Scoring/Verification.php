<?php
/*
 * LMT/Backstage/Scoring/Verification.php
 * LHS Math Club Website
 *
 * Displays sums of scores for verification
 */

$path_to_lmt_root = '../../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
backstage_access();

show_page();





function show_page() {
	lmt_page_header('Scoring Verification');
	
	echo <<<HEREDOC
      <h1>Scoring Verification</h1>
      
      <div class="text-centered b noprint">
        <span>
          <a href="../Results/Print">Print Score Sheets</a>
          <br /><br />
        </span>
      </div>
	  
      <table class="contrasting">
        <tr>
          <th>ID</th>
          <th>Team Name</th>
          <th>Individual Sum</th>
          <th>Theme Sum</th>
		  <th>Team Short</th>
		  <th>Team Long</th>
        </tr>
HEREDOC;
	
	score_guts();
	
	// INDIVIDUAL
	
	$sum_indiv = '(SELECT SUM(score_individual) FROM individuals WHERE team=teams.team_id AND deleted="0") AS sum_indiv';
	$sum_theme = '(SELECT SUM(score_theme) FROM individuals WHERE team=teams.team_id AND deleted="0") AS sum_theme';
	$query = "SELECT team_id, name, $sum_indiv, $sum_theme, score_team_short, score_team_long FROM teams WHERE deleted=\"0\" ORDER BY team_id";
	$result = lmt_query($query);
	
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$team_id = htmlentities($row['team_id']);
		$name = htmlentities($row['name']);
		$sum_indiv = htmlentities($row['sum_indiv']);
		$sum_theme = htmlentities($row['sum_theme']);
		$team_short = htmlentities($row['score_team_short']);
		$team_long = htmlentities($row['score_team_long']);
		
		if (is_null($row['sum_indiv']))
			$sum_indiv = '<span class="i">None</span>';
		if (is_null($row['sum_theme']))
			$sum_theme = '<span class="i">None</span>';
		if (is_null($row['score_team_short']))
			$team_short = '<span class="i">None</span>';
		if (is_null($row['score_team_long']))
			$team_long = '<span class="i">None</span>';
		
	echo <<<HEREDOC
        <tr>
          <td>$team_id</td>
          <td><a href="../Data/Team?ID=$team_id">$name</a></td>
          <td>$sum_indiv</td>
          <td>$sum_theme</td>
          <td>$team_short</td>
          <td>$team_long</td>
        </tr>
HEREDOC;
		$row = mysqli_fetch_assoc($result);
	}
	echo "      </table>\n";
	
	lmt_backstage_footer('');
	die;
}

?>