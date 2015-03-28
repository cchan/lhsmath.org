<?php
/*
 * LMT/Backstage/Guts/Home.php
 * LHS Math Club Website
 *
 * A dashboard page for the Guts area
 */

require_once '../../../lib/lmt-functions.php';
backstage_access();

show_page();





function show_page() {
	lmt_page_header('Guts Round');
	echo <<<HEREDOC
      <h1>Guts Round</h1>
      
      <div class="registration-box">
        <a href="Enter_Scores">Enter Scores</a>
        <a href="Display/Home">Guts Display</a>
		<a href="Extra" class="box-light">Extra</a>
      </div>
HEREDOC;
}

?>