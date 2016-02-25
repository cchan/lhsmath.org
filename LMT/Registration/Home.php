<?php
/*
 * LMT/Registration/Home.php
 * LHS Math Club Website
 *
 * A landing page with links to team and individual registration, and signin
 */

require_once '../../.lib/lmt-functions.php';
lmt_reg_restrict_access('');

if (isSet($_SESSION['LMT_user_id']))
	show_logged_in_page();
else
	show_public_page();





function show_public_page() {
	lmt_page_header('Registration');
	
	$lmt_date = htmlentities(map_value('date'));
	$reg_close = htmlentities(map_value('reg_close'));
	
	echo <<<HEREDOC
      <h1>Registration</h1>
      
      <div class="registration-box">
        <h3>Registration for LMT on $lmt_date is Open.</h3>
		<h4>Registration closes on $reg_close.</h4>
        <br /><br />
        <a href="Individual">Individual Registration</a>
        <a href="Coach">Team Registration</a>
      </div>
HEREDOC;
}





function show_logged_in_page() {
	//If there's no such school, we're in the middle of adding it or something.
	if (DB::queryFirstField('SELECT COUNT(*) FROM teams WHERE school=%i', $_SESSION['LMT_user_id']) == 0) {
		header('Location: Team?Add');
		die;
	}
	
	lmt_page_header('Team Registration');
	
	$lmt_year = htmlentities(map_value('year'));
	$school_name = htmlentities($_SESSION['LMT_school_name']);
	$table = lmt_db_table(	'SELECT team_id, name, school, (SELECT COUNT(*) FROM individuals WHERE individuals.team = teams.team_id AND individuals.deleted="0")'
								. ' AS size FROM teams WHERE school="'
								. mysqli_real_escape_string(DB::get(),$_SESSION['LMT_user_id']) . '" AND deleted="0" ORDER BY size, name',
							array(	'name' => 'Name',
									'size' => 'Size'),
							array(	'<img src="../../res/icons/edit.png" alt="Edit" />' => 'Team?Edit={team_id}',
									'<img src="../../res/icons/delete.png" alt="Delete" />' => 'Team?Delete={team_id}'),
							'No Teams',
							'contrasting indented');
	
	echo <<<HEREDOC
      <h1>Team Registration</h1>
      
      <h3 class="smbottom">Teams for $school_name</h3>
      <span class="small">&nbsp;<a href="Team?Add">Add a Team</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="Signout">Sign Out</a></span><br /><br />
      $table
HEREDOC;
}

?>