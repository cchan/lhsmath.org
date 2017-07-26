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
function autocomplete_users_php($string/*,$where,...*/){
	$args = func_get_args();
	array_shift($args);
	$where = array_shift($args);
	if($where == NULL) $where = "1";
	
	if(preg_match('@\(([0-9]+)\)@',$string,$matches)){
		$where = 'id=%i AND ('.$where.')';//It was autocompleted with an ID value! No ambiguity.
		array_unshift($args,$matches[1]);
	}
	else{
		$where = 'name LIKE %ss AND ('.$where.')';
		array_unshift($args,$string);
	}
	
	array_unshift($args,$where);
	return call_user_func_array('user_data',$args);
}

function autocomplete_data($query, $orderCallback/*, ...replacement parameters for $query...*/){
  //Will sort by $orderCallback and then ['name']
  //You may wish to take $user by reference and add ['label'] and ['category'] to it
	//Allows replacement-parameters too.
  $args=func_get_args();
  array_shift($args);
  array_shift($args);
  array_unshift($args,$query);
  $data = call_user_func_array("DB::query",$args);
  
	$results = array();
	$order = array();
	foreach($data as &$datum){
    $order[] = $orderCallback($datum);
		$results[] = $datum;
	}
	uksort($results,function($ind1,$ind2)use($results,$order){//Sorts with respect to order specified in $order
		if($order[$ind1]==$order[$ind2]){//Sorts alphabetically within a category
      if(array_key_exists("name",$results[$ind1]))
        return strcasecmp($results[$ind1]["name"],$results[$ind2]["name"]);
      else return 0;
		}else //Uses the given ordering numbers to sort categories
			return ($order[$ind1] > $order[$ind2]) ? 1 : -1;
	});
	return array_values($results);//Reassigns keys, since uksort will maintain disordered numerical keys.
}


//Returns a (rather large) array of all users, with all associative-array data things. Where-enabled.
function user_data($where=NULL/*,...*/){
  $params = array(
    "SELECT * FROM users".(!empty($where)?" WHERE ".$where:""),
    function(&$user){
      //Order: Temporary, YOG (largest to smallest), ???, Captain
      switch($user['permissions']){
        case 'B': case 'P': case 'E':
          continue 2; //Banned, pending approval, email verification pending aren't include (continues the foreach loop)
        case 'T':
          $user['category'] = 'Temporary';
          return 1;//Temporary users go first
        case 'R': case 'L':
          $user['category'] = getTextGradeFromYOG($user["yog"]);
          return 30000 - intval($user["yog"]);//Reverse order of yog
        case 'A': case 'C':
          $user['category'] = 'Captain';
          return 30000;//Captains after all the stuff
            //Assumes we're using this between 1 and 30000AD.
        default:
          $user['category'] = '???error???';
          return 0;//Questionmark ones go very first, but they shouldn't happen.
      }
      $user['label'] = $user['name'];
    });
  $args = func_get_args();
  array_shift($args);
  $params = array_merge($params, $args);
  return call_user_func_array("autocomplete_data",$params);
}


function lmt_indiv_data($where=NULL/*,...*/){
  if(!is_null($where))
    $where .= " AND deleted=0";
  else
    $where = "deleted=0";
  return autocomplete_data("SELECT individuals.name as indiv_name, teams.name as team_name FROM individuals LEFT JOIN teams on individuals.team=teams.team_id WHERE individuals.deleted=0",
    function(&$user){
      $user['label'] = $user['indiv_name'];
      $user['category'] = $user['team_name'];
      if(is_null($user['category']))$user['category'] = "<i>None</i>";
      $user['name'] = $user['team_name'];
      return 0;
    }, $where);
}



function autocomplete_js($jqselector,$data){
  $filteredData = [];
  
  foreach($data as $datum){
    $filteredDatum = [];
    if(array_key_exists('label',$datum))$filteredDatum['label']=$datum['label'];
    if(array_key_exists('category',$datum))$filteredDatum['category']=$datum['category'];
    $filteredData[] = $filteredDatum;
  }
  
	$json = json_encode($filteredData);
	
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