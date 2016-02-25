<?php

require_once '../.lib/functions.php';
restrict_access('A');

page_title('Search Users');

echo autocomplete_js('#searchbox',autocomplete_users_data());
?>
<input type="text" id="searchbox" class="focus"/>