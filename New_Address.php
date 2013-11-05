<?php
/*
 * New_Address.php
 * LHS Math Club Website
 *
 * Informs visitors to the old lhsmath.co.cc domain that we have
 * moved to a new address.
 */

$path_to_root = '';
require_once 'lib/functions.php';


show_page();





function show_page() {
	$_SESSION['HOME_newAddress'] = 'Hi! We have moved to a new address: <span class="b">lhsmath.org</span>';
	header('Location: Home');
}

?>