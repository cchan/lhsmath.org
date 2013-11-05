<?php
/*
 * LMT/Backstage/Data/List.php
 * LHS Math Club Website
 *
 * Lists data, specified by a GET parameter:
 * 	Schools
 * 	Teams
 * 	Individuals
 * 	Unaffiliated
 */

$path_to_lmt_root = '../../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
backstage_access();

if (isSet($_GET['Schools']))
	show_schools_list();
else if (isSet($_GET['Teams']))
	show_teams_list();
else if (isSet($_GET['Unaffiliated']))
	show_unaffiliated_list();
else
	show_individuals_list();





function show_schools_list() {
	global $use_rel_external_script;
	$use_rel_external_script = true;
	
	global $body_onload;
	$body_onload = 'document.forms[\'lmtSchoolSearch\'].Query.focus();externalLinks();';
	
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
          source: "../Autocomplete?School"
        });
      });
      //]]>
HEREDOC;
	
	
	lmt_page_header('Schools');
	echo <<<HEREDOC
      <h1>Schools</h1>
      <a href="Home">&larr; Data Home</a>
      
      <h3>Search</h3>
      <form id="lmtSchoolSearch" method="get" action="../Search"><div>
        <input type="text" id="autocomplete" name="Query" size="35" />
        <input type="hidden" name="Scope" value="School" />
        <input type="hidden" name="From" value="School List" />
        <input type="hidden" name="Return" value="Data" />
        <input type="submit" value="Search" />
      </div></form>
      
      <h3>List</h3>
HEREDOC;
	
	// Make custom table
	$query = 'SELECT *, (SELECT COUNT(*) FROM teams WHERE teams.school=schools.school_id) AS num_teams FROM schools WHERE deleted="0" ORDER BY name';
	
	$empty_message = 'No Schools';
	$css = 'contrasting indented';
	$headers = array(	'name' => 'School Name',
						'num_teams' => '# Teams',
						'coach_email' => 'Coach\'s Email');
	$links = array(	'<img src="../../../res/icons/arrow_right.png" alt="View" />' => 'School?ID={school_id}');
	
	
	global $LMT_DB;
	$result = lmt_query($query);
	
	$return = <<<HEREDOC
      <table class="$css">

HEREDOC;
	
	if (!is_null($headers)) {
		$return .= "        <tr>\n";
		
		foreach ($headers as $header)
			$return .= "          <th>$header</th>\n";
		
		for ($i = 0; $i < count($links); $i++)
			$return .= "          <th></th>\n";
		
		$return .= "        </tr>\n";
	}
	
	$row = mysql_fetch_assoc($result);
	$row_number = 0;
	
	if (!$row) {
		if (!is_null($headers))
			$colspan = count($headers) + count($links);	// count(null) == 0
		else
			$colspan = mysql_num_fields($result) + count($links);
		$return .= <<<HEREDOC
        <tr>
          <td colspan="$colspan">$empty_message</td>
        </tr>

HEREDOC;
	}
	
	while ($row) {
		$return .= "        <tr>\n";
		
		if (!is_null($ordering)) {
			if ($row_number != 0)
				$return .= '          <td class="text-centered"><a href="' . $ordering['page'] . '?Up&amp;ID=' . $row[$ordering['field']]
					. '&amp;xsrf_token=' . $_SESSION['xsrf_token'] . '" class="nounderline">&nbsp;&uarr;&nbsp;</a></td>' . "\n";
			else
				$return .= "          <td></td>\n";
				
			if ($row_number != mysql_num_rows($result) - 1)
				$return .= '          <td class="text-centered"><a href="' . $ordering['page'] . '?Down&amp;ID=' . $row[$ordering['field']]
					. '&amp;xsrf_token=' . $_SESSION['xsrf_token'] . '" class="nounderline">&nbsp;&darr;&nbsp;</a></td>' . "\n";
			else
				$return .= "          <td></td>\n";
		}
		
		if (!is_null($headers))
			foreach ($headers as $field=>$header) {
				if ($field == 'name')
					$return .= "          <td><a href=\"School?ID=" . htmlentities($row['school_id']) . "\">" . htmlentities($row[$field]) . "</a></td>\n";
				else if ($field == 'coach_email')
					$return .= "          <td><a href=\"mailto:" . htmlentities($row[$field]) . "\" rel=\"external\">" . htmlentities($row[$field]) . "</a></td>\n";
				else if ($field == 'num_teams')
					$return .= "          <td class=\"text-centered\">" . htmlentities($row[$field]) . "</td>\n";
				else
					$return .= "          <td>" . htmlentities($row[$field]) . "</td>\n";
			}
		else
			foreach ($row as $field=>$value)
				$return .= "          <td>" . htmlentities($value) . "</td>\n";
		
		if (!is_null($links)) {
			foreach ($links as $link=>$url) {
				foreach ($row as $field=>$value) {
					$link = str_replace('{' . $field . '}', $value, $link);
					$url = str_replace('{' . $field . '}', $value, $url);
					$field = mysql_fetch_field($result);
				}
				$return .= "          <td><a href=\"$url\">$link</a></td>\n";
			}
		}
		
		$return .= "        </tr>\n";
		
		$row = mysql_fetch_assoc($result);
		$row_number++;
	}
	
	$return .= "      </table>\n";
	echo $return;
	lmt_backstage_footer('');
}





function show_teams_list() {
	global $body_onload;
	$body_onload = 'document.forms[\'lmtTeamSearch\'].Query.focus()';
	
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
          source: "../Autocomplete?Team"
        });
      });
      //]]>
HEREDOC;
	
	
	lmt_page_header('Teams');
	echo <<<HEREDOC
      <h1>Teams</h1>
      <a href="Home">&larr; Data Home</a>
      
      <h3>Search</h3>
      <form id="lmtTeamSearch" method="get" action="../Search"><div>
        <input type="text" id="autocomplete" name="Query" size="35" />
        <input type="hidden" name="Scope" value="Team" />
        <input type="hidden" name="From" value="Team List" />
        <input type="hidden" name="Return" value="Data" />
        <input type="submit" value="Search" />
      </div></form>
      
      <h3>List</h3>
HEREDOC;
	
	// Make custom table
	$query = 'SELECT teams.*, schools.name AS school_name, (SELECT COUNT(*) FROM individuals WHERE team=teams.team_id)'
		. ' AS num_members FROM teams LEFT JOIN schools ON teams.school=schools.school_id WHERE teams.deleted="0" ORDER BY name';
	
	$empty_message = 'No Teams';
	$css = 'contrasting indented';
	$headers = array(	'name' => 'Team Name',
						'school_name' => 'School',
						'num_members' => '# Members',
						'score_team_short' => 'Team Round Short Score',
						'score_team_long' => 'Team Round Long Score',
						'guts_ans_a' => 'Guts Ans. A',
						'guts_ans_b' => 'Guts Ans. B',
						'guts_ans_c' => 'Guts Ans. C');
	$links = array(	'<img src="../../../res/icons/arrow_right.png" alt="View" />' => 'Team?ID={team_id}');
	
	
	global $LMT_DB;
	$result = lmt_query($query);
	
	$return = <<<HEREDOC
      <table class="$css">

HEREDOC;
	
	if (!is_null($headers)) {
		$return .= "        <tr>\n";
		
		foreach ($headers as $header)
			$return .= "          <th>$header</th>\n";
		
		for ($i = 0; $i < count($links); $i++)
			$return .= "          <th></th>\n";
		
		$return .= "        </tr>\n";
	}
	
	$row = mysql_fetch_assoc($result);
	$row_number = 0;
	
	if (!$row) {
		if (!is_null($headers))
			$colspan = count($headers) + count($links);	// count(null) == 0
		else
			$colspan = mysql_num_fields($result) + count($links);
		$return .= <<<HEREDOC
        <tr>
          <td colspan="$colspan">$empty_message</td>
        </tr>

HEREDOC;
	}
	
	while ($row) {
		$return .= "        <tr>\n";
		
		if (!is_null($ordering)) {
			if ($row_number != 0)
				$return .= '          <td class="text-centered"><a href="' . $ordering['page'] . '?Up&amp;ID=' . $row[$ordering['field']]
					. '&amp;xsrf_token=' . $_SESSION['xsrf_token'] . '" class="nounderline">&nbsp;&uarr;&nbsp;</a></td>' . "\n";
			else
				$return .= "          <td></td>\n";
				
			if ($row_number != mysql_num_rows($result) - 1)
				$return .= '          <td class="text-centered"><a href="' . $ordering['page'] . '?Down&amp;ID=' . $row[$ordering['field']]
					. '&amp;xsrf_token=' . $_SESSION['xsrf_token'] . '" class="nounderline">&nbsp;&darr;&nbsp;</a></td>' . "\n";
			else
				$return .= "          <td></td>\n";
		}
		
		if (!is_null($headers))
			foreach ($headers as $field=>$header) {
				if ($field == 'name')
					$return .= "          <td><a href=\"Team?ID=" . htmlentities($row['team_id']) . "\">" . htmlentities($row[$field]) . "</a></td>\n";
				else if ($field == 'school_name' && $row['school_name'] == '')
					$return .= "          <td><span class=\"i\">Individuals</span></td>\n";
				else if ($field == 'school_name')
					$return .= "          <td><a href=\"School?ID=" . htmlentities($row['school']) . "\">" . htmlentities($row[$field]) . "</a></td>\n";
				else if ($field == 'num_members')
					$return .= "          <td class=\"text-centered\">" . htmlentities($row[$field]) . "</td>\n";
				else
					$return .= "          <td>" . htmlentities($row[$field]) . "</td>\n";
			}
		else
			foreach ($row as $field=>$value)
				$return .= "          <td>" . htmlentities($value) . "</td>\n";
		
		if (!is_null($links)) {
			foreach ($links as $link=>$url) {
				foreach ($row as $field=>$value) {
					$link = str_replace('{' . $field . '}', $value, $link);
					$url = str_replace('{' . $field . '}', $value, $url);
					$field = mysql_fetch_field($result);
				}
				$return .= "          <td><a href=\"$url\">$link</a></td>\n";
			}
		}
		
		$return .= "        </tr>\n";
		
		$row = mysql_fetch_assoc($result);
		$row_number++;
	}
	
	$return .= "      </table>\n";
	echo $return;
	lmt_backstage_footer('');
}





function show_individuals_list() {
	global $use_rel_external_script;
	$use_rel_external_script = true;
	
	global $body_onload;
	$body_onload = 'document.forms[\'lmtIndividualSearch\'].Query.focus();externalLinks();';
	
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
          source: "../Autocomplete?Individual"
        });
      });
      //]]>
HEREDOC;
	
	
	lmt_page_header('Individuals');
	echo <<<HEREDOC
      <h1>Individuals</h1>
      <a href="Home">&larr; Data Home</a>
      
      <h3>Search</h3>
      <form id="lmtIndividualSearch" method="get" action="../Search"><div>
        <input type="text" id="autocomplete" name="Query" size="35" />
        <input type="hidden" name="Scope" value="Individual" />
        <input type="hidden" name="From" value="Individual List" />
        <input type="hidden" name="Return" value="Data" />
        <input type="submit" value="Search" />
      </div></form>
      
      <h3>List</h3>
HEREDOC;
	
	// Make custom table
	$query = 'SELECT individuals.*, teams.name AS team_name, (SELECT name FROM schools WHERE schools.school_id=teams.school) AS school_name, teams.school'
		. ' FROM individuals LEFT JOIN teams ON individuals.team=teams.team_id WHERE individuals.deleted="0" ORDER BY name';
	
	$empty_message = 'No Individuals';
	$css = 'contrasting indented';
	$headers = array(	'name' => 'Individual Name',
						'grade' => 'Grade',
						'school_name' => 'School',
						'team_name' => 'Team',
						'attendance' => 'Here',
						'score_individual' => 'Individual Score',
						'score_theme' => 'Theme Score',
						'email' => 'Parent\'s Email (Unaffiliated)');
	$links = array(	'<img src="../../../res/icons/arrow_right.png" alt="View" />' => 'Individual?ID={id}');
	
	
	global $LMT_DB;
	$result = lmt_query($query);
	
	$return = <<<HEREDOC
      <table class="$css">

HEREDOC;
	
	if (!is_null($headers)) {
		$return .= "        <tr>\n";
		
		foreach ($headers as $header)
			$return .= "          <th>$header</th>\n";
		
		for ($i = 0; $i < count($links); $i++)
			$return .= "          <th></th>\n";
		
		$return .= "        </tr>\n";
	}
	
	$row = mysql_fetch_assoc($result);
	$row_number = 0;
	
	if (!$row) {
		if (!is_null($headers))
			$colspan = count($headers) + count($links);	// count(null) == 0
		else
			$colspan = mysql_num_fields($result) + count($links);
		$return .= <<<HEREDOC
        <tr>
          <td colspan="$colspan">$empty_message</td>
        </tr>

HEREDOC;
	}
	
	while ($row) {
		$return .= "        <tr>\n";
		
		if (!is_null($ordering)) {
			if ($row_number != 0)
				$return .= '          <td class="text-centered"><a href="' . $ordering['page'] . '?Up&amp;ID=' . $row[$ordering['field']]
					. '&amp;xsrf_token=' . $_SESSION['xsrf_token'] . '" class="nounderline">&nbsp;&uarr;&nbsp;</a></td>' . "\n";
			else
				$return .= "          <td></td>\n";
				
			if ($row_number != mysql_num_rows($result) - 1)
				$return .= '          <td class="text-centered"><a href="' . $ordering['page'] . '?Down&amp;ID=' . $row[$ordering['field']]
					. '&amp;xsrf_token=' . $_SESSION['xsrf_token'] . '" class="nounderline">&nbsp;&darr;&nbsp;</a></td>' . "\n";
			else
				$return .= "          <td></td>\n";
		}
		
		if (!is_null($headers))
			foreach ($headers as $field=>$header) {
				if ($field == 'name')
					$return .= "          <td><a href=\"Individual?ID=" . htmlentities($row['id']) . "\">" . htmlentities($row[$field]) . "</a></td>\n";
				else if ($field == 'team_name' && $row['team'] == -1)
					$return .= "          <td><span class=\"i\">Not Assigned</span></td>\n";
				else if ($field == 'school_name' && $row['email'] != '')
					$return .= "          <td><span class=\"i\">Unaffiliated</span></td>\n";
				else if ($field == 'school_name')
					$return .= "          <td><a href=\"School?ID=" . htmlentities($row['school']) . "\">" . htmlentities($row[$field]) . "</a></td>\n";
				else if ($field == 'team_name')
					$return .= "          <td><a href=\"Team?ID=" . htmlentities($row['team']) . "\">" . htmlentities($row[$field]) . "</a></td>\n";
				else if ($field == 'email')
					$return .= "          <td><a href=\"mailto:" . htmlentities($row[$field]) . "\" rel=\"external\">" . htmlentities($row[$field]) . "</a></td>\n";
				else if ($field == 'attendance') {
					if ($row[$field])
						$return .= "          <td class=\"text-centered\">Yes</td>\n";
					else
						$return .= "          <td class=\"text-centered\">No</td>\n";
				}
				
				else if ($field == 'grade')
					$return .= "          <td class=\"text-centered\">" . htmlentities($row[$field]) . "</td>\n";
				else
					$return .= "          <td>" . htmlentities($row[$field]) . "</td>\n";
			}
		else
			foreach ($row as $field=>$value)
				$return .= "          <td>" . htmlentities($value) . "</td>\n";
		
		if (!is_null($links)) {
			foreach ($links as $link=>$url) {
				foreach ($row as $field=>$value) {
					$link = str_replace('{' . $field . '}', $value, $link);
					$url = str_replace('{' . $field . '}', $value, $url);
					$field = mysql_fetch_field($result);
				}
				$return .= "          <td><a href=\"$url\">$link</a></td>\n";
			}
		}
		
		$return .= "        </tr>\n";
		
		$row = mysql_fetch_assoc($result);
		$row_number++;
	}
	
	$return .= "      </table>\n";
	echo $return;
	lmt_backstage_footer('');
}





function show_unaffiliated_list() {
	global $use_rel_external_script;
	$use_rel_external_script = true;
	
	global $body_onload;
	$body_onload = 'document.forms[\'lmtUnaffiliatedSearch\'].Query.focus();externalLinks();';
	
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
          source: "../Autocomplete?Unaffiliated"
        });
      });
      //]]>
HEREDOC;
	
	
	lmt_page_header('Individuals');
	echo <<<HEREDOC
      <h1>Individuals</h1>
      <a href="Home">&larr; Data Home</a>
      
      <h3>Search</h3>
      <form id="lmtUnaffiliatedSearch" method="get" action="../Search"><div>
        <input type="text" id="autocomplete" name="Query" size="35" />
        <input type="hidden" name="Scope" value="Unaffiliated" />
        <input type="hidden" name="From" value="Unaffiliated List" />
        <input type="hidden" name="Return" value="Data" />
        <input type="submit" value="Search" />
      </div></form>
      
      <h3>List</h3>
HEREDOC;
	
	// Make custom table
	$query = 'SELECT individuals.*, teams.name AS team_name'
		. ' FROM individuals LEFT JOIN teams ON individuals.team=teams.team_id WHERE individuals.email <> "" AND individuals.deleted="0" ORDER BY name';
	
	$empty_message = 'No Individuals';
	$css = 'contrasting indented';
	$headers = array(	'name' => 'Individual Name',
						'grade' => 'Grade',
						'team_name' => 'Team',
						'attendance' => 'Here',
						'score_individual' => 'Individual Score',
						'score_theme' => 'Theme Score',
						'email' => 'Parent\'s Email (Unaffiliated)');
	$links = array(	'<img src="../../../res/icons/arrow_right.png" alt="View" />' => 'Individual?ID={id}');
	
	
	global $LMT_DB;
	$result = lmt_query($query);
	
	$return = <<<HEREDOC
      <table class="$css">

HEREDOC;
	
	if (!is_null($headers)) {
		$return .= "        <tr>\n";
		
		foreach ($headers as $header)
			$return .= "          <th>$header</th>\n";
		
		for ($i = 0; $i < count($links); $i++)
			$return .= "          <th></th>\n";
		
		$return .= "        </tr>\n";
	}
	
	$row = mysql_fetch_assoc($result);
	$row_number = 0;
	
	if (!$row) {
		if (!is_null($headers))
			$colspan = count($headers) + count($links);	// count(null) == 0
		else
			$colspan = mysql_num_fields($result) + count($links);
		$return .= <<<HEREDOC
        <tr>
          <td colspan="$colspan">$empty_message</td>
        </tr>

HEREDOC;
	}
	
	while ($row) {
		$return .= "        <tr>\n";
		
		if (!is_null($ordering)) {
			if ($row_number != 0)
				$return .= '          <td class="text-centered"><a href="' . $ordering['page'] . '?Up&amp;ID=' . $row[$ordering['field']]
					. '&amp;xsrf_token=' . $_SESSION['xsrf_token'] . '" class="nounderline">&nbsp;&uarr;&nbsp;</a></td>' . "\n";
			else
				$return .= "          <td></td>\n";
				
			if ($row_number != mysql_num_rows($result) - 1)
				$return .= '          <td class="text-centered"><a href="' . $ordering['page'] . '?Down&amp;ID=' . $row[$ordering['field']]
					. '&amp;xsrf_token=' . $_SESSION['xsrf_token'] . '" class="nounderline">&nbsp;&darr;&nbsp;</a></td>' . "\n";
			else
				$return .= "          <td></td>\n";
		}
		
		if (!is_null($headers))
			foreach ($headers as $field=>$header) {
				if ($field == 'name')
					$return .= "          <td><a href=\"Individual?ID=" . htmlentities($row['id']) . "\">" . htmlentities($row[$field]) . "</a></td>\n";
				else if ($field == 'team_name' && $row['team'] == -1)
					$return .= "          <td><span class=\"i\">Not Assigned</span></td>\n";
				else if ($field == 'team_name')
					$return .= "          <td><a href=\"Team?ID=" . htmlentities($row['team']) . "\">" . htmlentities($row[$field]) . "</a></td>\n";
				else if ($field == 'email')
					$return .= "          <td><a href=\"mailto:" . htmlentities($row[$field]) . "\" rel=\"external\">" . htmlentities($row[$field]) . "</a></td>\n";
				else if ($field == 'attendance') {
					if ($row[$field])
						$return .= "          <td class=\"text-centered\">Yes</td>\n";
					else
						$return .= "          <td class=\"text-centered\">No</td>\n";
				}
				
				else if ($field == 'grade')
					$return .= "          <td class=\"text-centered\">" . htmlentities($row[$field]) . "</td>\n";
				else
					$return .= "          <td>" . htmlentities($row[$field]) . "</td>\n";
			}
		else
			foreach ($row as $field=>$value)
				$return .= "          <td>" . htmlentities($value) . "</td>\n";
		
		if (!is_null($links)) {
			foreach ($links as $link=>$url) {
				foreach ($row as $field=>$value) {
					$link = str_replace('{' . $field . '}', $value, $link);
					$url = str_replace('{' . $field . '}', $value, $url);
					$field = mysql_fetch_field($result);
				}
				$return .= "          <td><a href=\"$url\">$link</a></td>\n";
			}
		}
		
		$return .= "        </tr>\n";
		
		$row = mysql_fetch_assoc($result);
		$row_number++;
	}
	
	$return .= "      </table>\n";
	echo $return;
	lmt_backstage_footer('');
}

?>