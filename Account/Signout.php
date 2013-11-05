<?php
/*
 * Account/Signout.php
 * LHS Math Club Website
 *
 * Logs out the current user by destroying their session, then redircting
 * them to /Home
 */


$path_to_root = '../';
require_once '../lib/functions.php';


session_destroy();
header('Location: ../Home');

?>