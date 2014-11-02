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

page_title('Search Members');

if (isSet($_REQUEST['query']))
	do_search();
else
	show_search_page();





/*
 * show_search_page()
 *
 * Shows a page where admins can search for a member by name and grade
 */
function show_search_page() {
	$previous_query = htmlentities($_REQUEST['query']);
	
	admin_page_footer('Search Members');
	
	echo autocomplete_js('#search',autocomplete_users_data()) . <<<HEREDOC
      <h1>Search Members</h1>
	  
      <br />
      <form id="memberSearch" method="get"><div>
        <input type="text" id="search" name="query" value="$previous_query" size="35" class="focus"/>
        <input type="submit" id="" value="Search"/>
      </div></form>
HEREDOC;
}





/*
 * do_search()
 *
 * Process the above search form
 */
function do_search() {
	$userdata = autocomplete_users_php($_REQUEST['query']);
	if(count($userdata) == 0){
		alert('No results!',-1);
		show_search_page();
		return;
	}elseif(count($userdata) == 1){
		redirect($userdata[0]['id']);
	}else{
		show_search_page();
		list_results($userdata);
	}
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
	if (isSet($_REQUEST['return'])) {
		if (preg_match('/?/', $_POST['return']))
			header('Location: ../Admin/' . $_POST['return'] . '&MemberSearchID=' . $id);//If it already has a ? query string in it, make it &
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
function list_results($results) {
	$previous_query = htmlentities($_REQUEST['query']);
	
	$link_base = 'View_User?ID=';
	if (isSet($_POST['return'])) {
		if (preg_match('/?/', $_POST['return']))
			$link_base = '../Admin/' . $_POST['return'] . '&amp;MemberSearchID=';
		else
			$link_base = '../Admin/' . $_POST['return'] . '?MemberSearchID=';
	}
	
	page_title('Search Results');
	echo <<<HEREDOC
      <br />
      <br />
      <table class="contrasting">
        <tr>
          <th>Name</th>
          <th>YOG</th>
        </tr>
HEREDOC;
	
	$currentcateg = "";
	foreach ($results as $user) {
		if($user['category']!=$currentcateg){
			$currentcateg = $user['category'];
			echo <<<HEREDOC
        <tr>
          <th colspan="2">-----$currentcateg-----</th>
        </tr>
HEREDOC;
		}
		echo <<<HEREDOC
        <tr>
          <td><a href="$link_base{$user['id']}">{$user['name']}</a></td>
          <td>{$user['yog']}</td>
        </tr>
HEREDOC;
	}
	
	echo '</table>';
}

?>