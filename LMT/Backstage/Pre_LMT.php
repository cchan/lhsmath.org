<?php
/*
 * LMT/Backstage/Post_LMT.php
 * LHS Math Club Website
 *
 * Super-secret page. Upgrades everything across the LMT thing to the next year, doing all necessary archiving.
 * Specifically:
 *   - Generate and post an archive page called {year}_Archive [based on the date currently in Status]
 *   - Move the LMT database to LMT_{year} and create a new empty LMT database
 *   - Reset status info
 */


//Standard stuff.
require_once '../../.lib/lmt-functions.php';
restrict_access('A');

show_form();



function show_form(){
	lmt_page_header('Pre-LMT');
?>
	<h1>Pre-LMT</h1>
	<p>This page is for preparing things before each LMT. If you're not an admin, you <b>should not be here</b>. 
  <b>If you are an admin, please follow <i>every</i> step on this page.</b></p>
<?php
	die();
}

?>
