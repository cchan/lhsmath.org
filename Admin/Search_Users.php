<?php

$path_to_root = '../';
require_once $path_to_root.'lib/functions.php';
restrict_access('A');

page_title('Search Users');

echo autocomplete_script('#searchbox',autocomplete_users());
?>
<input type="text" id="searchbox" class="focus"/>