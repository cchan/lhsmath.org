<?php
/*
 * LMT/Backstage/Scoring_Frozen.php
 * LHS Math Club Website
 *
 * Informs users that scoring has been frozen.
 */

if (!isSet($path_to_lmt_root)) {	// not being included
	$path_to_lmt_root = '../';
	require_once $path_to_lmt_root . '../lib/lmt-functions.php';
	backstage_access();
}

show_frozen_page();





function show_frozen_page() {
	if (scoring_is_enabled())
		trigger_error('Error: Scoring is enabled!', E_USER_ERROR);
	
	lmt_page_header('Scoring Frozen');
	
	echo <<<HEREDOC
      <h1>Scoring Frozen</h1>
      
      <div class="text-centered b">Scoring has been frozen so that results
      may be tabulated. If some results have not yet been entered or are incorrect,
      please see the Head Grader immediately!</div>
HEREDOC;
	die;
}

?>