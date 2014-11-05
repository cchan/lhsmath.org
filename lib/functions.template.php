<?php


//Upon shutdown, templateify() will run, emptying the output buffer into a page template and then sending *that* instead.
ob_start();//Collect EVERYTHING that's outputted.
function templateify(){
	global $CANCEL_TEMPLATEIFY;//In case, for example, you want to send an attachment.
	if(@$CANCEL_TEMPLATEIFY)return;
	
	global $page_title, $header_title, $header_class, $path_to_root, $jquery_function, $LOCAL_BORDER_COLOR, $popup_code, $more_head_stuff;
	
	//Title bar: "Page_Name | LHS Math Club"
	if(!isSet($header_title))$header_title = 'LHS Math Club'; //Also in main white-on-black header "LHS Math Club"
	if(!isSet($page_title))$page_title = basename($_SERVER['REQUEST_URI'],'.php');
	
	global $logged_in_header;
	if (isSet($_SESSION['user_id']))
		$logged_in_header = <<<HEREDOC
      <div id="user"><span id="username">{$_SESSION['user_name']}</span><span id="bar"> | </span><a href="{$path_to_root}Account/Signout">Sign Out</a></div>
HEREDOC;
	
	if (isSet($meta_refresh))
		$more_head_stuff .= '<meta http-equiv="refresh" content="' . $meta_refresh . '" />';
	
	$alerts_html = fetch_alerts_html();
	
	$content = ob_get_clean();
	
	//Very hacky solution to inserting alerts, but it works.
	if(strpos($content,'</h1>')!==false)
		$content = substr_replace($content,$alerts_html,strpos("\n".$content,'</h1>')+strlen('</h1>'),0);
	else
		$content = $alerts_html . $content;
	
	header('Content-Type: text/html; charset=utf-8');
	
	//We're on to HTML5 now!
	/*echo '<?xml version="1.0" encoding="UTF-8"?>';//Uncooperative because it has the question mark tags.*/
	//xmlns="http://www.w3.org/1999/xhtml"
?><!doctype html>
<html lang="en">
  <head>
	<?php //Driving home the message to a ridiculous degree. ?>
	<meta charset="utf-8">
	<meta name="charset" content="utf-8" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	
    <title><?=$page_title?> | <?=$header_title?></title>
	
	<meta name="description" content="The Lexington (MA) High School Math Team website.">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="copyright" content="Lexington High School Math Team">
	
	<link rel="icon" href="<?=$path_to_root?>favicon.ico" />
    <link rel="stylesheet" href="<?=$path_to_root?>res/default.css" type="text/css" media="all" />
    <link rel="stylesheet" href="<?=$path_to_root?>res/print.css" type="text/css" media="print" />
	
	<?php //Using Google's CDN, with fallback if it's unavailable ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?=$path_to_root?>res/jquery/jquery-1.11.1.min.js"><\/script>')</script>
	
	<?php //We serve our own custom build of jqUI (all we need is DatePicker and Autocomplete, so we don't use CDNs. ?>
	<script src="<?=$path_to_root?>res/jquery/jquery-ui-1.11.1.min.js"></script>
	<link rel="stylesheet" href="<?=$path_to_root?>res/jquery/jquery-ui-1.11.1.min.css" />
	
	<?php //View_Event popups ?>
	<script type="text/javascript" src="<?=$path_to_root?>res/popup.js"></script>
    
	<?php //Custom stuff ?>
	<script type="text/javascript"><?=$jquery_function?></script>
	
	<script>//<![CDATA[
	  (function(l,h,s,m,a,t,H){l['GoogleAnalyticsObject']=a;l[a]=l[a]||function(){
	  (l[a].q=l[a].q||[]).push(arguments)},l[a].l=1*new Date();t=h.createElement(s),
	  H=h.getElementsByTagName(s)[0];t.async=1;t.src=m;H.parentNode.insertBefore(t,H)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	  ga('create', 'UA-56328776-1', 'auto');ga('send', 'pageview');
	//]]></script>
	
	<script>//<![CDATA[
		$(function(){
			//Focuses on the element with class "focus"
			//If there's multiple ones it'll probably focus on the first one.
			$('.focus').focus();
			
			//Makes rel='external' (or rel='(anything with "external" in it)') anchor links open in a new window.
			$('a[rel*="external"]').on({
				click: function() {
					window.open($(this).attr('href'));
					return false;
				}
			});
		});
	//]]></script>
	
    <style type="text/css">
      .ui-datepicker, .ui-autocomplete {
        font-size: 12px;
      }
    </style>
	
	<?=$more_head_stuff?>
  </head>
  <body>
    <div id="header" class="<?=$header_class?>" style="border-bottom: 4px solid <?=$LOCAL_BORDER_COLOR?>">
      <a href="<?=$path_to_root?>Home" id="title"><?=$header_title?></a><?=$logged_in_header?>
    </div>
    
    <div id="content">
		<?=$content?>
	</div>
	<div id="linkbar">
	    <?='<div class="linkgroup">'.navbar_html().'</div>'?>
    </div>
  </body>
</html>
<?php
	
	ob_flush();
	flush();
	//die();//DO NOT. Will cause other shutdown functions to not work.
	//--todo--For some reason it just keeps on "Waiting for localhost..." even though the script is done...
}
register_shutdown_function('templateify');

$CANCEL_TEMPLATEIFY=false;
function cancel_templateify(){
	global $CANCEL_TEMPLATEIFY;
	$CANCEL_TEMPLATEIFY=true;
}


/*******************ALERTS*********************/
//Also assumes that templateify() will add it in via fetch_alerts_html()
//Call this to add an alert to be displayed at the top.
//Text: the alert text
//Disposition: negative means bad (red), positive means good (green), zero means neutral (black)
function alert($text,$disposition=0,$page_name=NULL){
	//Check that it's an actual page:
	if(is_null($page_name) || !val('f',$page_name))
		$page_name='';//basename($_SERVER['REQUEST_URI']);
	$sp='alerts_'.$page_name;
	
	if(@!$_SESSION[$sp])$_SESSION[$sp]=array();
	$_SESSION[$sp][]=array($text,$disposition);
}
function fetch_alerts_html(){
	$page_name='';//basename($_SERVER['REQUEST_URI']);
	$sp='alerts_'.$page_name;
	
	$html='';
	
	if(array_key_exists($sp,$_SESSION)){
		foreach($_SESSION[$sp] as $alert){
			if($alert[1]>0)$disposition='pos';
			else if($alert[1]<0)$disposition='neg';
			else $disposition='neut';
			$html.="<div class='alert {$disposition}'>{$alert[0]}</div>";
		}
		unset($_SESSION[$sp]);
	}
	
	return $html;
}

function location($path_from_root){
	cancel_templateify();
	header('Location: /'.$path_from_root);//--todo-- $path_to_root doesn't work for Post_Message, etc.
	die;
}



/*
 * page_header($title)
 *  - $title: the title of the page, which is shown in the browser's
 *      titlebar. The string ' | LHS Math Club' is appended to the end.
 *
 *  Echoes the top half of the page template (that comes before the content).
 */
function page_header($title) {//Deprecated.
	page_title($title);
}
function page_title($title){
	global $page_title;
	$page_title = $title;
}

//-----------WARNING----------//
//Specifying the same permissions in the same level of the array
//will lead to duplicate array keys, which will erase the first one.
//Append a random number to the permission to alleviate this,
//or nest so that it doesn't happen.

$main_navbar = array( //Name => Page path, or if it's the same you can omit the array key
	//End result: flattens and concatenates all permissible pages into a list and then outputs it as a single navbar.
	//Interestingly, for the Email-Verify, etc. people, it outputs nothing except Home, which was what was originally intended by Tidor. :)
	'Home',
	'X'=>[
		'Calendar',
		'Contests',
		'Contact',
		'About',
		'',
		'LMT',
		'',
		'Member Sign-in'=>'Account/Signin',
		'Member Registration'=>'Account/Register',
	],
	'ARL'=>[
		'LMT',
		'Contact',
		'About',
		'',
		'Messages',
		'Calendar',
		'Contests',
		'Files',
		'',
		'!L'=>[//Not alumni
			'My Scores'=>'My_Scores'
		],
		'My Profile'=>'Account/My_Profile',
		'A'=>[//Admins only
			'',
			'Admin Dashboard'=>'Admin/Dashboard'
		],
	],
);
$admin_navbar = array(
	'A'=>[
		'Home',
		'Admin Dashboard'=>'Admin/Dashboard',
		'',
		'User List'=>'Admin/User_List',
		'Search Members'=>'Admin/Member_Search',
		'Invite Members'=>'Admin/Invite_Members',
		'Approve Users'=>'Admin/Approve_Users',
		'Temporary Users'=>'Admin/Temporary_Users',
		'Alumni'=>'Admin/Alumni',
		'',
		'Post a Message'=>'Admin/Post_Message',
		'',
		'Tests'=>'Admin/Tests',
		'Calendar',
		'Files'=>'Admin/Files',
		'',
		'Edit Home Page'=>'Admin/Edit_Page?Home',
		'Edit Contests Page'=>'Admin/Edit_Page?Contests',
		'',
		'Uptime Report'=>'Admin/Uptime',
		'Login Log'=>'Admin/Login_Log',
		'Registration Log'=>'Admin/Registration_Log',
		'Database'=>'Admin/Database',
	],
);


if(strpos(get_relative_path(),'Admin') === 0){
//	restrict_access('A');
	set_navbar($admin_navbar);
}
else{
	set_navbar($main_navbar);
}


function set_navbar($n){
	global $navbar_array;
	$navbar_array = $n;
}
function navbar_html($navbar=NULL){
	global $path_to_root;
	if(is_null($navbar)){
		global $navbar_array;
		$navbar = $navbar_array;
	}
	$html = '';
	foreach($navbar as $key => $nav_elem)
		if(is_array($nav_elem)){
			if(user_access($key)) //If it's a section and it's allowed, then recursively continue flattening the array.
				$html .= navbar_html($nav_elem);
		}
		elseif($nav_elem === '')
			$html .= "</div><div class='linkgroup'>";
		elseif(is_string($key)){//In this case $key is the name, $nav_elem is the path.
			if($nav_elem === get_relative_path())//In this case it's the current page, so indicate so.
				$html .= "<span class='selected'>$key</span><br />";
			else
				$html .= "<a href='{$path_to_root}{$nav_elem}'>{$key}</a><br />";
		}
		else{//In this case $nav_elem is both the name and the path.
			if($nav_elem === get_relative_path())//In this case it's the current page, so indicate so.
				$html .= "<span class='selected'>$nav_elem</span><br />";
			else
				$html .= "<a href='{$path_to_root}{$nav_elem}'>{$nav_elem}</a><br />";
		}
	return $html;
}

function default_page_footer(){trigger_error('default_page_footer',E_USER_NOTICE);}
function page_footer(){trigger_error('page_footer',E_USER_NOTICE);}
function admin_page_footer(){trigger_error('admin_page_footer',E_USER_NOTICE);}

?>