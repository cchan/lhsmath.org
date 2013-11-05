<?php
/*
 * LMT/Backstage/Home.php
 * LHS Math Club Website
 *
 * A landing page for people going Backstage
 */

$path_to_lmt_root = '../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';
backstage_access();

show_page();





function show_page() {
	global $use_rel_external_script;
	$use_rel_external_script = true;
	
	lmt_page_header('Backstage');
	
	$message = map_value('backstage_message');
	
	echo <<<HEREDOC
      <h1>Backstage</h1>
      
$message
HEREDOC;
	lmt_backstage_footer('Backstage Home');
}

?>