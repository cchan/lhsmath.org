<?php
/*
 * Admin/Member_Search.php
 * LHS Math Club Website
 *
 * Allows Admins to search for a member.
 *
 * The search functionality can be used on any other page
 * by including a form like the one here that submits to
 * this page. If a hidden element named "return" is included,
 * the admin will be redirected to /Admin/<the specified place>
 * with the GET parameter MemberSearchID=<the id of the member>
 * when the search is complete.
 */


$path_to_root = '../';
require_once '../lib/functions.php';
restrict_access('A');


if (isSet($_GET['Query']))
	do_search();
else
	show_search_page();





/*
 * show_search_page()
 *
 * Shows a page where admins can search for a member by name and grade
 */
function show_search_page() {
	// A little javascript to put the cursor in the first field when the form loads;
	// page_header() looks at the $body_onload variable and inserts it into the code.
	global $body_onload;
	$body_onload = 'document.forms[\'memberSearch\'].Query.focus()';
	
	// Add some javascript for the jQuery Autocomplete
	global $jquery_function;
	$jquery_function = <<<HEREDOC
	$(function() {
		$( "#userAutocomplete" ).autocomplete({
			source: "User_Autocomplete?All"
		});
	});

HEREDOC;
	
	page_header('Search Members');
	echo <<<HEREDOC
      <h1>Search Members</h1>
      
      <br />
      <form id="memberSearch" method="get" action="{$_SERVER['REQUEST_URI']}"><div>
        <input type="text" id="userAutocomplete" name="Query" size="35"/>
        <input type="submit" value="Search"/>
      </div></form>
HEREDOC;
	admin_page_footer('Search Members');
}





/*
 * do_search()
 *
 * Process the above search form
 */
function do_search() {
	// Locate User
	$ans = form_autocomplete_query($_GET['Query']);
	
	if ($ans['type'] == 'no-entry') {
		show_search_page();
		return;
	} else if ($ans['type'] == 'none')
		show_no_results_page();
	else if ($ans['type'] == 'single') {
		$row = $ans['row'];
		redirect($row['id']);
	} else
		list_results($ans['result']);
}





/*
 * show_no_results_page()
 *
 * If no results are found, shows an error page
 */
function show_no_results_page() {
	$previous_query = htmlentities($_GET['Query']);
	
	// A little javascript to put the cursor in the first field when the form loads;
	// page_header() looks at the $body_onload variable and inserts it into the code.
	global $body_onload;
	$body_onload = 'document.forms[\'memberSearch\'].Query.focus()';
	
	// Add some javascript for the jQuery Autocomplete
	global $jquery_function;
	$jquery_function = <<<HEREDOC
	$(function() {
		$( "#userAutocomplete" ).autocomplete({
			source: "User_Autocomplete?All"
		});
	});

HEREDOC;
	
	page_header('Search Results');
	echo <<<HEREDOC
      <h1>Search Results</h1>
      
      <div class="error">Your search returned no results.</div>
      <br />
      <form id="memberSearch" method="get" action="{$_SERVER['REQUEST_URI']}">
        <input type="text" id="userAutocomplete" name="Query" size="35"/>
        <input type="submit" value="Search"/>
      </form>
HEREDOC;
	admin_page_footer('Search Members');
	
	die();
}





/*
 * redirect($id)
 *  - $id: the id of the member found
 *
 * If exactly one member is found, go to the View_User page for that member.
 * If the search came from another page, results will be returned to that
 * page.
 */
function redirect($id) {
	if (isSet($_POST['return'])) {
		if (preg_match('/?/', $_POST['return']))
			header('Location: ../Admin/' . $_POST['return'] . '&MemberSearchID=' . $id);
		else
			header('Location: ../Admin/' . $_POST['return'] . '?MemberSearchID=' . $id);
	}
	else
		header('Location: View_User?ID=' . $id);
	die();
}





/*
 * list_results($result)
 *  - $result: the result of the mysql query above
 *
 * Shows a table of returned results; the admin picks the right one or
 * can modify their search
 */
function list_results($result) {
	// A little javascript to put the cursor in the first field when the form loads;
	// page_header() looks at the $body_onload variable and inserts it into the code.
	global $body_onload;
	$body_onload = 'document.forms[\'memberSearch\'].Query.focus()';
	
	// Add some javascript for the jQuery Autocomplete
	global $jquery_function;
	$jquery_function = <<<HEREDOC
	$(function() {
		$( "#userAutocomplete" ).autocomplete({
			source: "User_Autocomplete?All"
		});
	});

HEREDOC;
	
	$previous_query = htmlentities($_POST['query']);
	
	$link_base = 'View_User?ID=';
	if (isSet($_POST['return'])) {
		if (preg_match('/?/', $_POST['return']))
			$link_base = '../Admin/' . $_POST['return'] . '&amp;MemberSearchID=';
		else
			$link_base = '../Admin/' . $_POST['return'] . '?MemberSearchID=';
	}
	
	page_header('Search Results');
	echo <<<HEREDOC
      <h1>Search Results</h1>
      
      <form id="memberSearch" method="get" action="{$_SERVER['REQUEST_URI']}">
        <input type="text" id="userAutocomplete" name="Query" value="$previous_query" size="35"/>
        <input type="submit" value="Search"/>
      </form>
      <br />
      <br />
      <table class="contrasting">
        <tr>
          <th>Name</th>
          <th>YOG</th>
        </tr>
HEREDOC;
	
	$row = mysqli_fetch_assoc($result);
	while ($row) {
		echo <<<HEREDOC
        <tr>
          <td><a href="$link_base{$row['id']}">{$row['name']}</a></td>
          <td>{$row['yog']}</td>
        </tr>
HEREDOC;
		$row = mysqli_fetch_assoc($result);
	}
	
	echo <<<HEREDOC
      </table>
HEREDOC;
	admin_page_footer('Search Members');
	die();
}

?>