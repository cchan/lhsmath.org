<?php
/*
 * LMT/Backstage/Scoring/Individual.php
 * LHS Math Club Website
 *
 * A page where staff enter scores for the individual round
 */

$path_to_lmt_root = '../../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
backstage_access();
scoring_access();

if (isSet($_POST['do_enter_individual_score']))
	do_enter_individual_score();
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
          source: "../Autocomplete?Individual",
          delay: 0
        });
      });
      //]]>
HEREDOC;
	
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	if ($msg != '')
		$msg = "\n        <div class=\"alert\">$msg</div><br />\n";
	
	$redirAlert = fetch_alert('indivScore');
	
	lmt_page_header('Score Entry');
	echo <<<HEREDOC
      <h1>Individual Round Score Entry</h1>
      $err$redirAlert$msg
      <form id="lmtIndivScore" method="post" action="{$_SERVER['REQUEST_URI']}"><div class="text-centered">
        Name:
        <input type="text" id="autocomplete" name="name" size="35" />
        &nbsp;&nbsp;&nbsp;&nbsp;
        Score:
        <input type="text" name="score" size="5" />
        &nbsp;
        <input type="hidden" name="xsrf_token" value="{$_SESSION['xsrf_token']}" />
        <input type="submit" name="do_enter_individual_score" value="Enter" />
      </div></form>
HEREDOC;
	
	lmt_backstage_footer('');
	die;
}





function do_enter_individual_score() {
	if ($_POST['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	$score_msg = validate_individual_score($_POST['score']);
	if ($score_msg !== true)
		show_page($score_msg, '');
	
	$result = DB::queryRaw('SELECT id, name, attendance, score_individual FROM individuals WHERE name="'
		. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_POST['name']) . '" AND deleted="0"');
	
	if (mysqli_num_rows($result) == 0)
		show_page('An individual named "' . htmlentities($_POST['name']) .'" not found', '');
	if (mysqli_num_rows($result) > 1)
		show_multiple_results_page();
	
	$row = mysqli_fetch_assoc($result);
	
	if ($row['attendance'] == '0')
		show_page(htmlentities($row['name']) . ' is absent', '');
	
	if (!is_null($row['score_individual'])) {
		$msg = 'A score of ' . htmlentities($row['score_individual'])
			. ' has already been entered for ' . htmlentities($row['name']);
		if ($row['score_individual'] != $_POST['score'])
			$msg .= ' (<a href="Individual?Overwrite&amp;ID=' . htmlentities($row['id']) . '&amp;Score='
			. htmlentities($_POST['score']) . '&amp;xsrf_token=' . $_SESSION['xsrf_token']
			. '">change to ' . htmlentities($_POST['score']) . '</a>)';
		show_page($msg, '');
	}
	
	DB::queryRaw('UPDATE individuals SET score_individual="'
		. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_POST['score']) . '" WHERE id="'
		. mysqli_real_escape_string($GLOBALS['LMT_DB'],$row['id']) . '" LIMIT 1');

	$msg = 'A score of ' . htmlentities($_POST['score']) . ' was entered for '
		. htmlentities($row['name']);
	
	if (isSet($_GET['ID'])) {
		add_alert('indivScore', $msg);
		header('Location: Individual');
		die;
	}
	
	show_page('', $msg);
}





function show_multiple_results_page() {
	lmt_page_header('Score Entry');
	
	$name = htmlentities($_POST['name']);
	
	$result = DB::queryRaw('SELECT id, individuals.name AS name, grade, teams.name AS team_name, '
		. '(SELECT name FROM schools WHERE schools.school_id=teams.school) AS school_name '
		. 'FROM individuals LEFT JOIN teams ON individuals.team=teams.team_id WHERE individuals.name="'
		. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_POST['name']) . '" AND deleted="0"');
	
	echo <<<HEREDOC
      <h1>Individual Round Score Entry</h1>
      
      <div class="text-centered">
        Multiple individuals named <span class="b">$name</span> exist. Please select the correct one:
      </div>
      <br />
      
      <table class="contrasting table-center">
        <tr>
          <th>Name</th>
          <th>Grade</th>
          <th>Team</th>
          <th>School</th>
        </tr>

HEREDOC;
	
	$score = htmlentities($_POST['score']);
	
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		$id = htmlentities($row['id']);
		$name = htmlentities($row['name']);
		$grade = htmlentities($row['grade']);
		$team = htmlentities($row['team_name']);
		$school = htmlentities($row['school_name']);
		echo <<<HEREDOC
        <tr>
          <td><a href="Individual?ID=$id&amp;Score=$score&amp;xsrf_token={$_SESSION['xsrf_token']}">$name</a></td>
          <td>$grade</td>
          <td>$team</td>
          <td>$school</td>
        </tr>

HEREDOC;
		$row = mysqli_fetch_assoc($result);
	}
	
	echo <<<HEREDOC
      </table>
      
      <a href="Individual">&larr; Cancel</a>
HEREDOC;
	lmt_backstage_footer('');
	die;
}





function do_enter_clarified_score() {
	if (!validate_individual_score($_GET['Score']))
		trigger_error('Score isn\'t valid this time?!', E_USER_ERROR);
	
	$row = DB::queryFirstRow('SELECT name, score_individual FROM individuals WHERE id="'
		. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '"');
	
	if (!is_null($row['score_individual']) && !isSet($_GET['Overwrite'])) {
		if (isSet($_GET['xsrf_token'])) {
			header('Location: Individual?ID=' . $_GET['ID'] . '&Score=' . $_GET['Score']);
			die;
		}
		else {
			$msg = 'A score of ' . htmlentities($row['score_individual'])
				. ' has already been entered for ' . htmlentities($row['name']);
			if ($row['score_individual'] != $_GET['Score'])
				$msg .= ' (<a href="Individual?Overwrite&amp;ID=' . htmlentities($_GET['ID']) . '&amp;Score='
				. htmlentities($_GET['Score']) . '&amp;xsrf_token=' . $_SESSION['xsrf_token']
				. '">change to ' . htmlentities($_GET['Score']) . '</a>)';
			show_page($msg, '');
		}
	}
	// we check this later so we can go here without a token, too - so we can show an override message
	// if the individual already has a score entered
	if ($_GET['xsrf_token'] != $_SESSION['xsrf_token'])
		trigger_error('XSRF code incorrect', E_USER_ERROR);
	
	DB::queryRaw('UPDATE individuals SET score_individual="'
		. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['Score']) . '" WHERE id="'
		. mysqli_real_escape_string($GLOBALS['LMT_DB'],$_GET['ID']) . '" LIMIT 1');
	$msg = 'A score of ' . htmlentities($_GET['Score']) . ' was entered for '
		. htmlentities($row['name']);
	
	if (isSet($_GET['ID'])) {
		add_alert('indivScore', $msg);
		header('Location: Individual');
		die;
	}
	
	show_page('', $msg);
}

?>