<?php
/*
 * LMT/Backstage/Database/Verify.php
 * LHS Math Club Website
 *
 * Checks the database for errors
 */

require_once '../../../.lib/lmt-functions.php';
backstage_access();

show_page();





function show_page() {
	global $use_rel_external_script;
	$use_rel_external_script = true;
	
	lmt_page_header('Validation');
	
	echo <<<HEREDOC
      <h1>Verify Database</h1>
      <div class="text-centered b">
        <span>
          <a href="#basic">Basic Information</a>&nbsp;&nbsp;
          <a href="#checkin">Checkin</a>&nbsp;&nbsp;
          <a href="#grading">Grading</a>&nbsp;&nbsp;
          <a href="#guts">Guts</a>
          <br /><br />
        </span>
      </div>
      
HEREDOC;
	
	echo do_verify();
}





function do_verify() {
	$output = '<h3><a name="basic">Basic Information and Relationships</a> <a href="" class="nounderline">&uarr;</a></h3>';
	
	// All individuals have a valid name
	$new_output = '';
	$query = DB::query('SELECT id, name FROM individuals WHERE name NOT REGEXP "^[A-Za-z -]{1,40}$" AND deleted="0"');
	foreach ($query as $row)
		$new_output .= '      <span style="color: #a00;">Individual &quot;<a href="../Data/Individual?ID=' . htmlentities($row['id'])
			. '" rel="external">' . htmlentities($row['name']) . '</a>&quot; does not have a valid name</span><br />' . "\n";
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All individuals have a valid name</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// All teams have a valid name
	$new_output = '';
	$query = DB::query('SELECT team_id, name FROM teams WHERE name NOT REGEXP "^[A-Za-z0-9 -]{1,40}$" AND deleted="0"');
	foreach ($query as $row)
		$new_output .= '      <span style="color: #a00;">Team &quot;<a href="../Data/Team?ID=' . htmlentities($row['team_id'])
			. '" rel="external">' . htmlentities($row['name']) . '</a>&quot; does not have a valid name</span><br />' . "\n";
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All teams have a valid name</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// All schools have a valid name
	$new_output = '';
	$query = DB::query('SELECT school_id, name FROM schools WHERE name NOT REGEXP "^[A-Za-z -]{1,40}$" AND deleted="0"');
	foreach ($query as $row)
		$new_output .= '      <span style="color: #a00;">School &quot;<a href="../Data/School?ID=' . htmlentities($row['school_id'])
			. '" rel="external">' . htmlentities($row['name']) . '</a>&quot; does not have a valid name</span><br />' . "\n";
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All schools have a valid name</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// All individuals have been placed
	$new_output = '';
	$query = 'SELECT id, name FROM individuals WHERE team="-1" AND deleted="0"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">Individual &quot;<a href="../Data/Individual?ID=' . htmlentities($row['id'])
			. '" rel="external">' . htmlentities($row['name']) . '</a>&quot; has not been placed on a team</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All individuals have been placed on a team</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// All individuals have a real team
	$new_output = '';
	$query = 'SELECT id, name, team FROM individuals WHERE NOT EXISTS (SELECT team_id FROM teams WHERE team_id=team AND deleted="0") AND team != "-1" AND deleted="0"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">Individual &quot;<a href="../Data/Individual?ID=' . htmlentities($row['id'])
			. '" rel="external">' . htmlentities($row['name']) . '</a>&quot; does not have a real team ('
			. htmlentities($row['team']) . ')</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All individuals have been placed on a real team</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// All teams have a real school
	$new_output = '';
	$query = 'SELECT team_id, name, school FROM teams WHERE NOT EXISTS (SELECT school_id FROM schools WHERE school_id=school AND deleted="0") AND school!= "-1" AND deleted="0"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">Team &quot;<a href="../Data/Team?ID=' . htmlentities($row['team_id'])
			. '" rel="external">' . htmlentities($row['name']) . '</a>&quot; does not have a real school ('
			. htmlentities($row['school']) . ')</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All teams have schools (except individuals)</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// Same-named individuals
	$new_output = '';
	$query = 'SELECT name FROM individuals WHERE deleted="0" GROUP BY name HAVING COUNT(*) > 1';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">Duplicate individual name: &quot;' . htmlentities($row['name']) . '&quot;</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">No two individuals have the same name</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// Same-named teams
	$new_output = '';
	$query = 'SELECT name FROM teams WHERE deleted="0" GROUP BY name HAVING COUNT(*) > 1';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">Duplicate team name: &quot;' . htmlentities($row['name']) . '&quot;</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">No two teams have the same name</span><br />' . "\n";
	$output .= $new_output . '      <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />' . "\n";
	
	
	
	
	
	$output .= "\n<h3><a name=\"checkin\">Checkin</a> <a href=\"\" class=\"nounderline\">&uarr;</a></h3>";
	
	// Unaffiliated individuals nonpayment
	$new_output = '';
	$query = 'SELECT id, name FROM individuals WHERE email<>"" AND paid="0" AND attendance="1" AND deleted="0"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">Unaffiliated individual &quot;<a href="../Data/Individual?ID=' . htmlentities($row['id'])
			. '" rel="external">' . htmlentities($row['name']) . '</a>&quot; has not paid</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All attending unaffiliated individuals have paid</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// School nonpayment
	$new_output = '';
	$query = 'SELECT school_id, name FROM schools WHERE (SELECT COUNT(team_id) FROM teams WHERE school=school_id) > teams_paid AND deleted="0"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">School &quot;<a href="../Data/School?ID=' . htmlentities($row['school_id'])
			. '" rel="external">' . htmlentities($row['name']) . '</a>&quot; has unpaid teams</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All teams are paid for</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// School overpayment
	$new_output = '';
	$query = 'SELECT school_id, name FROM schools WHERE (SELECT COUNT(team_id) FROM teams WHERE school=school_id) < teams_paid AND deleted="0"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">School &quot;<a href="../Data/School?ID=' . htmlentities($row['school_id'])
			. '" rel="external">' . htmlentities($row['name']) . '</a>&quot; has paid for too many teams</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">No schools have paid too much</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// Absences
	$new_output = '';
	$query = 'SELECT id, name FROM individuals WHERE attendance="0" AND deleted="0"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">Individual &quot;<a href="../Data/Individual?ID=' . htmlentities($row['id'])
			. '" rel="external">' . htmlentities($row['name']) . '</a>&quot; is absent</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">No individuals are absent</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// Individuals with scores entered
	$new_output = '';
	$query = 'SELECT id, name FROM individuals WHERE (score_individual IS NOT NULL OR score_theme IS NOT NULL) AND deleted="0"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">Individual &quot;<a href="../Data/Individual?ID=' . htmlentities($row['id'])
			. '" rel="external">' . htmlentities($row['name']) . '</a>&quot; has scores entered already</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">No individuals have scores entered yet</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// Teams with scores entered
	$new_output = '';
	$query = 'SELECT team_id, name FROM teams WHERE (score_team_short IS NOT NULL OR score_team_long IS NOT NULL) AND deleted="0"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">Team &quot;<a href="../Data/Team?ID=' . htmlentities($row['team_id'])
			. '" rel="external">' . htmlentities($row['name']) . '</a>&quot; has team round scores entered already</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">No teams have entered scores yet</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// Guts scores
	$new_output = '';
	$query = 'SELECT COUNT(*) FROM guts';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	
	if ($row['COUNT(*)'] != '0')
		 $new_output .= '      <span style="color: #a00;">Early-round guts scores have been entered already</span><br />' . "\n";
	
	$query = 'SELECT team_id, name FROM teams WHERE (guts_ans_a IS NOT NULL OR guts_ans_B IS NOT NULL or guts_ans_c IS NOT NULL) AND deleted="0"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">Team &quot;<a href="../Data/Team?ID=' . htmlentities($row['team_id'])
			. '" rel="external">' . htmlentities($row['name']) . '</a>&quot; has final-round guts answers entered already</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">No guts scores have been entered yet</span><br />' . "\n";
	$output .= $new_output . '      <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />' . "\n";
	
	
	
	
	
	$output .= "\n<h3><a name=\"grading\">Grading</a> <a href=\"\" class=\"nounderline\">&uarr;</a></h3>";
	
	// Individual scores entered
	$new_output = '';
	$query = 'SELECT id, name FROM individuals WHERE score_individual IS NULL AND attendance="1" AND deleted="0"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">Individual &quot;<a href="../Data/Individual?ID=' . htmlentities($row['id'])
			. '" rel="external">' . htmlentities($row['name']) . '</a>&quot; is missing an individual round score</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All individual round scores have been entered</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// Theme scores entered
	$new_output = '';
	$query = 'SELECT id, name FROM individuals WHERE score_theme IS NULL AND attendance="1" AND deleted="0"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">Individual &quot;<a href="../Data/Individual?ID=' . htmlentities($row['id'])
			. '" rel="external">' . htmlentities($row['name']) . '</a>&quot; is missing a theme round score</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All theme round scores have been entered</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// Teams with scores entered
	$new_output = '';
	$query = 'SELECT team_id, name FROM teams WHERE (score_team_short IS NULL OR score_team_long IS NULL) AND deleted="0"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">Team &quot;<a href="../Data/Team?ID=' . htmlentities($row['team_id'])
			. '" rel="external">' . htmlentities($row['name']) . '</a>&quot; is missing a team round score</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All team round scores have been entered</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	$new_output = '      <a href="../Results/Print" style="color: #a00;" class="b">Review scores</a><br />' . "\n";
	$output .= $new_output . '      <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />' . "\n";
	
	
	
	
	
	$output .= "\n<h3><a name=\"guts\">Guts</a> <a href=\"\" class=\"nounderline\">&uarr;</a></h3>";
	
	// Not too many guts scores
	$new_output = '';
	$query = 'SELECT team_id, name FROM teams WHERE (SELECT COUNT(*) FROM guts WHERE team=team_id) > 11 AND deleted="0"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">Team &quot;<a href="../Data/Team?ID=' . htmlentities($row['team_id'])
			. '" rel="external">' . htmlentities($row['name']) . '</a>&quot; has too many guts scores</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All teams have under 12 regular guts scores</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// Not too few guts scores
	$new_output = '';
	$query = 'SELECT team_id, name FROM teams WHERE (SELECT COUNT(*) FROM guts WHERE team=team_id) < 11 AND deleted="0"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">Team &quot;<a href="../Data/Team?ID=' . htmlentities($row['team_id'])
			. '" rel="external">' . htmlentities($row['name']) . '</a>&quot; has too few guts scores</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All teams have at least 11 regular guts scores</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	// All 3 guts answers
	$new_output = '';
	$query = 'SELECT team_id, name FROM teams WHERE (guts_ans_a IS NULL OR guts_ans_b IS NULL OR guts_ans_c IS NULL) AND deleted="0"';
	$result = DB::queryRaw($query);
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$new_output .= '      <span style="color: #a00;">Team &quot;<a href="../Data/Team?ID=' . htmlentities($row['team_id'])
			. '" rel="external">' . htmlentities($row['name']) . '</a>&quot; has not answered the last 3 guts questions</span><br />' . "\n";
		$row = mysqli_fetch_assoc($result);
	}
	
	if ($new_output == '')
		$new_output .= '      <span style="color: #0a0;">All teams have answered Guts Set 12</span><br />' . "\n";
	$output .= $new_output . '      <br />' . "\n";
	
	
	return $output;
}

?>