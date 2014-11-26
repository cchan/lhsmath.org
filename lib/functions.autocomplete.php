<?php

//--todo--: nicknames? e.g. Eula vs Lingrui
//--todo--: reduce all these "approved" and "email_verification" fields to the "permissions" field?
function autocomplete_users_data($where=NULL/*,...*/){
	restrict_access('A');//Because that's a lot of names you're dumping to the browser.
	$search = call_user_func_array('user_data',func_get_args());
	$result = array();
	foreach($search as $user)
		$result[] = array('label'=>$user['name'].' ('.$user['id'].')', 'category'=>$user['category']);
	return $result;
}
//Autocompletes it on the server side
function autocomplete_users_php($string,$where/*,...*/){
	$args = func_get_args();array_shift($args);array_shift($args);
	
	if(preg_match('@\(([0-9]+)\)@',$string,$matches)){
		$where = 'id=%i AND ('.$where.')';//It was autocompleted with an ID value! No ambiguity.
		array_unshift($args,$matches[1]);
	}
	else{
		$where = 'name LIKE %ss AND ('.$where.')',$string);
		array_unshift($args,$string);
	}
	
	array_unshift($args,$where);
	return call_user_func_array('user_data',$args);
}

//Returns a (rather large) array of all users, with all associative-array data things. Where-enabled.
function user_data($where=NULL/*,...*/){
	if(isSet($where)){//Allows replacement-parameters too.
		$args=func_get_args();
		array_shift($args);
		$args[0]='SELECT * FROM users WHERE '.$where;
		$users = call_user_func_array("DB::query",$args);
	}
	else
		$users = DB::query('SELECT * FROM users');
	$results = array();
	foreach($users as $user){
		switch($user['permissions']){
			case 'B': case 'P': case 'E':
				continue 2; //Banned, pending approval, email verification pending aren't include (continues the foreach loop)
			case 'T':
				$categ = 'Temporary';
				$user["yog"] = 'Temporary';
				$order[] = 1;//Temporary users go first
				break;
			case 'R': case 'L':
				$categ = getGradeFromYOG($user["yog"]);
				$order[] = 30000 - intval($user["yog"]);//Reverse order of yog
				break;
			case 'A': case 'C':
				$categ = 'Captain';
				$order[] = 30000;//Captains after all the stuff
					//Assumes we're using this between 1 and 30000AD.
				break;
			default:
				$categ = '???error???';
				$order[] = 0;//Questionmark ones go very first, but they shouldn't happen.
				break;
		}
		$user['category'] = $categ;
		$results[] = $user;
	}
	//Order: Temporary, YOG (largest to smallest), ???, Captain
	uksort($results,function($ind1,$ind2)use($results,$order){//Sorts with respect to order specified in $order
		if($order[$ind1]==$order[$ind2])//Sorts alphabetically within a category
			return strcasecmp($results[$ind1]["name"],$results[$ind2]["name"]);
		else //Uses the given ordering numbers to sort categories
			return ($order[$ind1] > $order[$ind2]) ? 1 : -1;
	});
	return array_values($results);//Reassigns keys, since uksort will maintain disordered numerical keys.
}
function autocomplete_js($jqselector,$data){
	global $path_to_root;
	
	$json = json_encode($data);
	
	return <<<HEREDOC
<style>
.ui-autocomplete{font-size:10pt;}
.ui-autocomplete-category{font-weight:bold;margin-top:1em;}
</style>
<script>
$.widget( "custom.catcomplete", $.ui.autocomplete, {
    _create: function() {
      this._super();
      this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
    },
    _renderMenu: function( ul, items ) {
      var that = this,
        currentCategory = "";
      $.each( items, function( index, item ) {
        var li;
        if ( item.category != currentCategory ) {
          ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
          currentCategory = item.category;
        }
        li = that._renderItemData( ul, item );
        if ( item.category ) {
          li.attr( "aria-label", item.category + " : " + item.label );
        }
      });
    }
});
$(function() {
	var data = $json;
	$( "$jqselector" ).catcomplete({
		delay: 0,
		source: data
	});
});
</script>
HEREDOC;
}
?>