<?php
/*
 * LMT/Backstage/Email/Home.php
 * LHS Math Club Website
 *
 * A dashboard page for staff entering scores
 */

require_once '../../../.lib/lmt-functions.php';
backstage_access();

show_page();





function show_page() {
	lmt_page_header('Email');
	echo <<<HEREDOC
      <h1>Email</h1>
      
      <div class="registration-box">
        <a href="Coaches">Email Coaches</a>
        <a href="Individuals">Email Individuals</a>
      </div>
HEREDOC;
}

?>