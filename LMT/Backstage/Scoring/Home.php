<?php
/*
 * LMT/Backstage/Scoring/Home.php
 * LHS Math Club Website
 *
 * A dashboard page for staff entering scores
 */

require_once '../../../.lib/lmt-functions.php';
backstage_access();

show_page();





function show_page() {
	lmt_page_header('Score Entry');
	echo <<<HEREDOC
      <h1>Score Entry</h1>
      
      <div class="registration-box">
        <a href="Individual">Individual Round</a>
        <a href="Theme">Theme Round</a>
      </div>
      
      <div class="registration-box">
        <a href="Team_Short">Team Round: Short Answer</a>
        <a href="Team_Long">Team Round: Long Answer</a>
      </div>
      
      <div class="registration-box">
        <a href="Refrigerator" class="box-light">Scoring Control</a>
        <a href="Verification" class="box-light">Verification</a>
      </div>
HEREDOC;
}

?>