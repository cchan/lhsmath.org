<?php
/*
 * LMT/Registration/Signout.php
 * LHS Math Club Website
 */


$path_to_lmt_root = '../';
require_once $path_to_lmt_root . '../lib/lmt-functions.php';

do_signout();

function do_signout() {
	session_destroy();
	unset($_SESSION);
	session_start();
	
	lmt_page_header('Signed Out');
	echo <<<HEREDOC
      <h1>Signed Out</h1>
      
      <div class="text-centered">
        You have been signed out. You may continue to add or modify teams until<br />
        registration closes through the link in the confirmation email.
      </div>
HEREDOC;
	lmt_page_footer('');
}

?>