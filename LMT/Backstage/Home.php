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

global $use_rel_external_script;
$use_rel_external_script = true;

lmt_page_header('Backstage');
$message = '<h1>Backstage</h1>' . map_value('backstage_message');
lmt_backstage_footer('Backstage Home');

?>