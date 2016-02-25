<?php
/*
 * LMT/Backstage/Scoring/Team_Short.php
 * LHS Math Club Website
 *
 * A page where staff enter scores for the team round's
 * short answer section
 */

require_once '../../../.lib/lmt-functions.php';
backstage_access();
scoring_access();

if (isSet($_POST['do_enter_team_score']))
	do_enter_team_score();
else if (isSet($_GET['ID']))
	do_enter_clarified_score();
else
	show_page('', '');





function show_page($err, $msg) {
	global $body_onload;
	$body_onload = 'document.forms[\'lmtIndivScore\'].autocomplete.focus()';
	
	global $jquery_function;
	$jquery_function = <<<HEREDOC
      //<![CDATA[
      $.widget( "custom.catcomplete", $.ui.autocomplete, {
        _renderMenu: function( ul, items ) {
          var self = this,
          currentCategory = "";
          $.each( items, function( index, item ) {
            if ( item.category != currentCategory ) {
              ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
              currentCategory = item.category;
            }
            self._renderItem( ul, item );
          });
        }
      });
      $(function() {
        $( "#autocomplete" ).catcomplete({
          source: "../Autocomplete?Team",
          delay: 0
        });
      });
      //]]>
HEREDOC;
	
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	if ($msg != '')
		$msg = "\n        <div class=\"alert\">$msg</div><br />\n";
	
	lmt_page_header('Score Entry');
	echo <<<HEREDOC
      <h1>Team Round (Short) Score Entry</h1>
      $err$redirAlert$msg
      <form id="lmtIndivScore" method="post" action="{$_SERVER['REQUEST_URI']}"><div class="text-centered">
        Name:
        <input type="text" id="autocomplete" name="name" size="35" />
        &nbsp;&nbsp;&nbsp;&nbsp;
        Score:
        <input type="text" name="score" size="5" />
        &nbsp;
        <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
        <input type="submit" name="do_enter_team_score" value="Enter" />
      </div></form>
HEREDOC;
	die;
}





function do_enter_team_score() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$score_msg = validate_team_short_score($_POST['score']);
	if ($score_msg !== true)
		show_page($score_msg, '');
	
	$result = DB::queryRaw('SELECT team_id, name, score_team_short FROM teams WHERE name="'
		. mysqli_real_escape_string(DB::get(),$_POST['name']) . '" AND deleted="0"');
	
	if (mysqli_num_rows($result) == 0)
		show_page('An team named "' . htmlentities($_POST['name']) .'" not found', '');
	if (mysqli_num_rows($result) > 1)
		show_multiple_results_page();
	
	$row = mysqli_fetch_assoc($result);
	if (!is_null($row['score_team_short'])) {
		$msg = 'A score of ' . htmlentities($row['score_team_short'])
			. ' has already been entered for ' . htmlentities($row['name']);
		if ($row['score_team_short'] != $_POST['score'])
			$msg .= ' (<a href="Team_Short?Overwrite&amp;ID=' . htmlentities($row['team_id']) . '&amp;Score='
			. htmlentities($_POST['score']) . '&amp;xsrf_token=' . $_SESSION['xsrf_token']
			. '">change to ' . htmlentities($_POST['score']) . '</a>)';
		show_page($msg, '');
	}
	
	DB::queryRaw('UPDATE teams SET score_team_short="'
		. mysqli_real_escape_string(DB::get(),$_POST['score']) . '" WHERE team_id="'
		. mysqli_real_escape_string(DB::get(),$row['team_id']) . '" LIMIT 1');

	$msg = 'A score of ' . htmlentities($_POST['score']) . ' was entered for '
		. htmlentities($row['name']);
	
	if (isSet($_GET['ID'])) {
		alert($msg, 1);
		header('Location: Team_Short');
		die;
	}
	
	show_page('', $msg);
}





function show_multiple_results_page() {
	lmt_page_header('Score Entry');
	
	$name = htmlentities($_POST['name']);
	
	$result = DB::queryRaw('SELECT team_id, teams.name AS name, schools.name AS school_name '
		. 'FROM teams LEFT JOIN schools ON teams.school=schools.school_id WHERE teams.name="'
		. mysqli_real_escape_string(DB::get(),$_POST['name']) . '" WHERE teams.deleted="0"');
	
	echo <<<HEREDOC
      <h1>Team Round (Short) Score Entry</h1>
      
      <div class="text-centered">
        Multiple teams named <span class="b">$name</span> exist. Please select the correct one:
      </div>
      <br />
      
      <table class="contrasting table-center">
        <tr>
          <th>Team</th>
          <th>School</th>
        </tr>

HEREDOC;
	
	$score = htmlentities($_POST['score']);
	
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$id = htmlentities($row['team_id']);
		$team = htmlentities($row['name']);
		$school = htmlentities($row['school_name']);
		echo <<<HEREDOC
        <tr>
          <td><a href="Team_Short?ID=$id&amp;Score=$score&amp;xsrf_token={$_SESSION['xsrf_token']}">$team</a></td>
          <td>$school</td>
        </tr>

HEREDOC;
		$row = mysqli_fetch_assoc($result);
	}
	
	echo <<<HEREDOC
      </table>
      
      <a href="Team_Short">&larr; Cancel</a>
HEREDOC;
	die;
}





function do_enter_clarified_score() {
	if (!validate_team_short_score($_GET['Score']))
		trigger_error('Score isn\'t valid this time?!', E_USER_ERROR);
	
	$row = DB::queryFirstRow('SELECT name, score_team_short FROM teams WHERE team_id="'
		. mysqli_real_escape_string(DB::get(),$_GET['ID']) . '"');
	
	if (!is_null($row['score_team_short']) && !isSet($_GET['Overwrite'])) {
		if (isSet($_GET['xsrf_token'])) {
			header('Location: Team_Short?ID=' . $_GET['ID'] . '&Score=' . $_GET['Score']);
			die;
		}
		else {
			$msg = 'A score of ' . htmlentities($row['score_team_short'])
				. ' has already been entered for ' . htmlentities($row['name']);
			if ($row['score_team_short'] != $_GET['Score'])
				$msg .= ' (<a href="Team_Short?Overwrite&amp;ID=' . htmlentities($_GET['ID']) . '&amp;Score='
				. htmlentities($_GET['Score']) . '&amp;xsrf_token=' . $_SESSION['xsrf_token']
				. '">change to ' . htmlentities($_GET['Score']) . '</a>)';
			show_page($msg, '');
		}
	}
	// we check this later so we can go here without a token, too - so we can show an override message
	// if the team already has a score entered
	if ($_GET['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	DB::queryRaw('UPDATE teams SET score_team_short="'
		. mysqli_real_escape_string(DB::get(),$_GET['Score']) . '" WHERE team_id="'
		. mysqli_real_escape_string(DB::get(),$_GET['ID']) . '" LIMIT 1');
	$msg = 'A score of ' . htmlentities($_GET['Score']) . ' was entered for '
		. htmlentities($row['name']);
	
	if (isSet($_GET['ID'])) {
		alert($msg, 1);
		header('Location: Team_Short');
		die;
	}
	
	show_page('', $msg);
}

?>