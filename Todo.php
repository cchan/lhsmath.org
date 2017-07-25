<?php
/*
 * Todo.php
 * LHS Math Club Website
 */


require_once '.lib/functions.php';
restrict_access('A');


show_page();





function show_page() {
	global $use_rel_external_script;
	$use_rel_external_script = true;
	page_header('Todo');
	echo <<<HEREDOC
      <h1>Todo</h1>

HEREDOC;

	$text = file_get_contents('.content/Todo.txt');
	echo BBCode($text);
	
	if (user_access('A'))
		echo <<<HEREDOC

      <div class="sidetab"><a href="Admin/Edit_Page?Todo">(edit this page)</a></div>
HEREDOC;
}

?>