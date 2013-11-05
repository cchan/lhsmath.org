<?php
/*
 * LMT/Backstage/Checkin/Home.php
 * LHS Math Club Website
 *
 * A dashboard page for staff running checkin
 */

$path_to_lmt_root = '../../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
backstage_access();

if (isSet($_POST['do_find_school']))
	find_school();
else if (isSet($_POST['do_find_individual']))
	find_individual();
show_page('');





function show_page($err) {
	global $body_onload;
	$body_onload = 'document.forms[\'lmtSchoolCheckin\'].id.focus()';
	
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
          source: "../Autocomplete?School&Individual"
        });
      });
      //]]>
HEREDOC;
	
	if ($err != '')
		$err = "\n        <div class=\"error\">$err</div><br />\n";
	
	$individual_alert = fetch_alert('checkinIndividual');
	$school_alert = fetch_alert('checkinSchool');
	
	lmt_page_header('Check-in');
	echo <<<HEREDOC
      <h1>Check-in</h1>
      <h3>Check in by ID</h3>
      $err$school_alert$individual_alert
      <form id="lmtSchoolCheckin" method="post" action="{$_SERVER['REQUEST_URI']}"><div>
        School ID:
        <input type="text" name="id" size="5" />
        <input type="submit" name="do_find_school" value="Find" />
      </div></form>
      <div class="halfbreak"></div>
      <form method="post" action="{$_SERVER['REQUEST_URI']}"><div>
        Unaffiliated Individual ID:
        <input type="text" name="id" size="5" />
        <input type="submit" name="do_find_individual" value="Find" />
      </div></form>
      
      <h3>Search by Name</h3>
      <form id="lmtSearchAll" method="get" action="../Search"><div>
        <input type="text" id="autocomplete" name="Query" size="35" />
        <input type="hidden" name="Scope" value="School Individual" />
        <input type="hidden" name="From" value="Checkin Home" />
        <input type="hidden" name="Return" value="Checkin" />
        <input type="submit" value="Search" />
      </div></form>
      
      <h3>Other</h3>
      <a href="Print">Print Attendance Sheets</a>
      <div class="halfbreak"></div>
      <a href="Team_List">Download Team List</a>
HEREDOC;
	lmt_backstage_footer('Check-in');
	die;
}





function find_school() {
	$result = lmt_query('SELECT school FROM teams WHERE team_id="'
		. mysql_real_escape_string($_POST['id']) . '" AND deleted="0"');
	if (mysql_num_rows($result) != 1)
		show_page('School not found');
	
	$row = mysql_fetch_assoc($result);
	
	header('Location: School?ID=' . $row['school']);
}





function find_individual() {
	$row = lmt_query('SELECT COUNT(*), email FROM individuals WHERE id="'
		. mysql_real_escape_string($_POST['id']) . '" AND deleted="0"', true);
	if ($row['COUNT(*)'] != 1)
		show_page('Individual not found');
	if ($row['email'] == "")
		show_page('Individual was registered as part of a team');
	
	header('Location: Individual?ID=' . $_POST['id']);
}

?>