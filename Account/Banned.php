<?php
/*
 * Account/Banned.php
 * LHS Math Club Website
 *
 * Displays a message to banned users.
 */

global $being_included;
$being_included = true;
if (!isSet($path_to_root)) {
	$path_to_root = '../';
	$being_included = false;
}
require_once $path_to_root . 'lib/functions.php';
restrict_access('B');

page_header('Banned');
?>
<h1>Banned</h1>
You have been banned from the Math Club system.
