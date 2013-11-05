<?php
/*
 * Admin/Uptime.php
 * LHS Math Club Website
 *
 * Reports on the website's uptime
 */


$path_to_root = '../';
require_once '../lib/functions.php';
restrict_access('A');


show_page();





function show_page() {
	global $PINGDOM_UPTIME_BANNER, $PINGDOM_RESPONSE_BANNER, $PINGDOM_REPORT;
	page_header('Uptime Report');
	echo <<<HEREDOC
      <h1>Uptime Report</h1>
      
      <img src="$PINGDOM_UPTIME_BANNER" alt=""/>
      <img src="$PINGDOM_RESPONSE_BANNER" alt="" class="right"/>
      <br />
      <br />
      <br />
      <object id="pingdomreport" data="$PINGDOM_REPORT" type="text/html"></object>
HEREDOC;
	admin_page_footer('Uptime Report');
}

?>