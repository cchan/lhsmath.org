<?php
/*
 * .lib/CONFIG.php
 * LHS Math Club Website
 *
 * This file is where information such as database connections, etc. are
 * specified. Edit CONFIG.server.php or CONFIG.local.php as appropriate.
 *
 */


require 'CONFIG.server.php';

@include 'CONFIG.local.php';	// DEVELOPERS: to override certain values in your
								// testing environment, put them in 'CONFIG.local.php'
								// and DO NOT add it to source control.

?>