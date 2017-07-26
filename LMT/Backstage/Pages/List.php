<?php
/*
 * LMT/Backstage/Pages/List.php
 * LHS Math Club Website
 *
 * Shows a list of pages in the LMT site and has links to add/edit them
 */

require_once '../../../.lib/lmt-functions.php';
restrict_access('A');

show_page();





function show_page() {
	// If the Registration page does not exist, add it
	if (DB::queryFirstField('SELECT COUNT(*) FROM pages WHERE page_id="-1"') == 0) {
		$new_order_num = DB::queryFirstField('SELECT (MIN(order_num) - 1) AS new_order FROM pages');
		DB::insert('pages',array('page_id'=>'-1','name'=>'Registration','content'=>'','order_num'=>$new_order_num));
	}
	
	
	lmt_page_header('Page List');
	
	$delete_alert = fetch_alert('deletePage');
	
	echo <<<HEREDOC
      <h1>Page List</h1>
      $delete_alert
      <a href="Add"><img src="../../../res/icons/add.png" alt="+" /> Add a Page</a><br />
      <a href="Add_Separator?xsrf_token={$_SESSION['xsrf_token']}"><img src="../../../res/icons/add.png" alt="+" /> Add a Separator</a><br />
      <br />
      <h4 class="smbottom">Pages</h4>
HEREDOC;

	$table = lmt_db_table(	'SELECT page_id, name, order_num FROM pages ORDER BY order_num',
							array('name' => ''),
							array(	'<img src="../../../res/icons/eye.png" alt="View" />' => 'View?ID={page_id}',
									'<img src="../../../res/icons/edit.png" alt="Edit" />' => 'Edit?ID={page_id}',
									'<img src="../../../res/icons/delete.png" alt="Delete" />' => 'Delete?ID={page_id}'),
							'No Pages',
							'contrasting indented',
							array(	'page' => 'Order',
									'field' => 'page_id'));
	
	//Make the Separators come out nicely
	$search = '#<td></td>(\s+)<td><a href="View\?ID=(\d+)"><img src="../../../res/icons/eye.png" alt="View" /></a></td>(\s+)<td><a href="Edit\?ID=(\d+)"><img src="../../../res/icons/edit.png" alt="Edit" /></a></td>(\s+)<td><a href="Delete\?ID=(\d+)"><img src="../../../res/icons/delete.png" alt="Delete" /></a></td>(\s+)</tr>#';
	$replace = '<td>[Separator]</td>${1}<td></td>${1}<td></td>${1}<td><a href="Delete_Separator?ID=${2}&amp;xsrf_token=' . $_SESSION['xsrf_token'] . '"><img src="../../../res/icons/delete.png" alt="Delete" /></a></td>${1}</tr>';
	$table = preg_replace($search, $replace, $table);
	
	// Make Registration uneditable
	$search = '#<td><a href="View\?ID=-1"><img src="../../../res/icons/eye.png" alt="View" /></a></td>(\s+)<td><a href="Edit\?ID=-1"><img src="../../../res/icons/edit.png" alt="Edit" /></a></td>(\s+)<td><a href="Delete\?ID=-1"><img src="../../../res/icons/delete.png" alt="Delete" /></a></td>(\s+)</tr>#';
	$replace = '<td></td>${1}<td></td>${1}<td></td>${1}</tr>';
	$table = preg_replace($search, $replace, $table);
	
	echo $table;
}

?>