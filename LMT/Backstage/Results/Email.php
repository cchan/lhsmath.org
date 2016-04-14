<?php
/*
 * LMT/Backstage/Results/Email
 * LHS Math Club Website
 *
 * A convenient thing to help send results to coaches via email.
 */

require_once '../../../.lib/lmt-functions.php';
restrict_access('A');

show_page();



function show_page() {
	global $header_noprint;
	$header_noprint = true;
	lmt_page_header('Score Sheets');
	$message = '';
  $lmt_year = intval(map_value('year'));
  $lmt_nextyear = $lmt_year + 1;
  $lmt_archive_url = URL::lmt()."/{$lmt_year}_Archive";
	if (scoring_is_enabled())
		$message = '<div class="error noPrint">Score entry is still enabled! Disable it <a href="../Scoring/Refrigerator">here</a>.</div><br />';
	echo <<<HEREDOC
      <h1 class="noPrint">Score Emails</h1>
      $message
	  
	  <style>textarea{width: 100%;height: 400px;}</style>
	  
		<form method="post" action="{$_SERVER['REQUEST_URI']}">
			<input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}"/>
			<input type="submit" name="Send" value="Send All Emails"/>
		</form>
      
      <div>

HEREDOC;
	
	$individuals = DB::query('SELECT individuals.name as ind_name, individuals.grade as grade, '
		. 'IFNULL(score_team_short, 0) + IFNULL(score_team_long, 0) AS score_team, '
		. 'score_guts, teams.name AS team_name, score_individual as score_ind, score_theme, email '
		. 'FROM individuals LEFT JOIN teams ON team=team_id '
		. 'WHERE email != "" AND individuals.deleted = 0 ORDER BY ind_name');
	foreach ($individuals as $ind){
    $if_not_eighth = "";
    if($ind['grade'] != 8)
      ", and we hope to see you at LMT {$lmt_nextyear}";
		$body = <<<HEREDOC
Hello,

Thanks for coming to LMT {$lmt_year}; here are your individual results!
[b]Name:[/b] {$ind['ind_name']}
[b]Individual Score:[/b] {$ind['score_ind']}
[b]Theme Score:[/b] {$ind['score_theme']}

As an unaffiliated individual, you were also placed onto a team. Here's how you did:
[b]Team Name:[/b] {$ind['team_name']}
[b]Team Round Score:[/b] {$ind['score_team']}
[b]Guts Round Score:[/b] {$ind['score_guts']}

You can also find useful things such as overall results, photos, and problems and solutions at [url]{$lmt_archive_url}[/url].

Finally, we'd love to hear from you! Any feedback at all about how we did this year and how we might improve for next year is greatly appreciated.

Thanks for coming{$if_not_eighth}!
LHS Math Team Captains
HEREDOC;
		if(array_key_exists('Send',$_POST) && $_POST['xsrf_token'] == $_SESSION['xsrf_token']){
			echo $ind['email'];
			$err = lmt_send_email($ind['email'],"Scores!", $body);
			if($err !== true){
				alert($err, -1);
				return;
			}
			else
				alert("Sent to {$ind['email']}",1);
		}
		echo "<h2>{$ind['email']}</h2><div style='border:solid 1px #000'>".BBCode($body)."</div>";
	}
	
	
	$teams = DB::query('SELECT team_id, IFNULL(score_team_short, 0) + IFNULL(score_team_long, 0) AS score_team, '
		. ' score_guts, teams.name AS team_name, teams.school AS school_id,'
		. ' schools.name AS school_name, coach_email '
		. ' FROM teams RIGHT JOIN schools ON teams.school=schools.school_id '
		. ' WHERE teams.deleted=0 ORDER BY school_name, team_name');
	
	for($i = -1; $i + 1 < count($teams);) {
		$body = '';
		do{
			$i++;
			$team = $teams[$i];
			$school = htmlentities($team['school_name']);
			$coach_email = htmlentities($team['coach_email']);
			$team_id = htmlentities($team['team_id']);
			$team_name = htmlentities($team['team_name']);
			$score_team = htmlentities($team['score_team']);
			$score_guts = htmlentities($team['score_guts']);
			
			if($body == ''){
				$body = <<<HEREDOC
Hello,

Thanks for coming to LMT {$lmt_year}; here are the results for your team(s)!

[b]School Name:[/b] $school

HEREDOC;
			}
			
			if (is_null($team['score_team']))
				$score_team = 'NONE';
			if (is_null($team['score_guts']))
				$score_guts = 'NONE';
			
			$body .= <<<HEREDOC

[b]Team Name:[/b] {$team_name}
[b]Team Round Score:[/b] {$score_team}
[b]Guts Round Score:[/b] {$score_guts}
HEREDOC;

			$members = DB::query('SELECT name, score_individual, score_theme, email FROM individuals WHERE team=%i AND deleted="0" ORDER BY name',$team_id);
			if (count($members) == 0)
				$body .= "\n\nNo Team Members\n";
			else
				$body .= "\n\n[b]Individual Scores: Individual Round, Theme Round[/b]\n";
			foreach($members as $member){
				$name = htmlentities($member['name']);
				$score_individual = htmlentities($member['score_individual']);
				$score_theme = htmlentities($member['score_theme']);
				
				if (is_null($member['score_individual']))
					$score_individual = 'NONE';
				if (is_null($member['score_theme']))
					$score_theme = 'NONE';
				
				$indiv_msg = '';
				if ($member['email'] != '')
					$indiv_msg = ' (Unaffiliated Individual)';
				
				$body .= "$name$indiv_msg: $score_individual, $score_theme\n";
			}
			$body .= "\n";
		}while($i+1 < count($teams) && $teams[$i]['coach_email'] == $teams[$i+1]['coach_email']);

		$body .= <<<HEREDOC

You can also find useful things such as overall results, photos, and problems and solutions at [url]{$lmt_archive_url}[/url].

Finally, we'd love to hear from you! Any feedback at all about how we did this year and how we might improve for next year is greatly appreciated.

Thanks for coming, and we hope to see you at LMT {$lmt_nextyear}!
LHS Math Team Captains
HEREDOC;

		if(array_key_exists('Send',$_POST) && $_POST['xsrf_token'] == $_SESSION['xsrf_token']){
			echo $coach_email;
			$err = lmt_send_email($coach_email,"Scores!", $body);
			if($err !== true){
				alert($err, -1);
				return;
			}
			else
				alert("Sent to {$coach_email}",1);
		}
		echo "<h2>{$coach_email}</h2><div style='border:solid 1px #000'>".BBCode($body)."</div>";
	}
	
	echo "      </div>";
}

?>

end of page :)

