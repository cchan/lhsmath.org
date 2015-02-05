<?php
/*
 * Account/Banned.php
 * LHS Math Club Website
 *
 * Displays a message to banned users.
 */

if (!defined('FUNCTIONSPHP'))require_once '../lib/functions.php';
	//If functions hasn't been included, get functions.
	//(if it has been, that means someone's including this file, so rootpath may be messed up and the require will fail)

restrict_access('B');

page_title('Banned');
?>
<h1>Banned</h1>
You have been banned from the Math Club system.
