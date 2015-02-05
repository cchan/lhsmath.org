<?php

require_once PATH::lib() . '/meekrodb.2.3.class.php'; //Even better version of class.DB.php, with OO'd database management.

function db_error_handler($params){
	$out = 'DB ERROR: ';
	if(strpos($params['error'],'Unable to connect to MySQL server!'))$params['error'].=" (Did you accidentally upload CONFIG.local.php?)";
	if (isset($params['query'])) $out .= "QUERY: " . $params['query'] . '<br />';
	if (isset($params['error'])) $out .= "ERROR: " . $params['error'] . '<br />';
	trigger_error($out,E_USER_ERROR);
	die;
}
class DBExt{//A few more features to add to MeekroDB.
	public static function parseWhereClause($where, $args){//Better whereclause creation, to be used in placeholding %l. (may not necessarily be a whereclause)
		//Does not deal with replacement params.
		if(!is_array($args)) $args = array();
		if(is_object($where) && get_class($where)=='WhereClause'){//Well, it's already a WhereClause.
			array_unshift($args,'TRUE');
			call_user_func_array(array($where,'add'),$args);
			return $where;
		}
		if(empty($where)){//If it's an empty string or something, you've still got that "WHERE %l" hanging there.
			return ' TRUE ';
		}
		elseif(is_array($where)){//Associative array of field-value pairs/array of actual wherestrings
			$wc = new WhereClause('and');
			array_unshift($args,'TRUE');
			call_user_func_array(array($wc,'add'),$args);
			foreach($where as $field=>$val){
				if(is_int($field))$wc->add($val);//Just a string in the array
				else $wc->add('%b=%s',$field,$val);//Actually associative
			}
			return $wc;
		}
		else{//Single actual wherestring
			$wc = new WhereClause('and');
			array_unshift($args,$where);
			call_user_func_array(array($wc,'add'),$args);
			return $wc;
		}
	}
	public static function queryCount(){ //Counts the number of rows in a table, where something.
		$args = func_get_args();
		$table = array_shift($args);
		$where = array_shift($args);
		$pass = array('SELECT COUNT(*) FROM %b WHERE %l',$table,self::parseWhereClause($where,$args));
		return intval(call_user_func_array('DB::queryFirstField',$pass));
	}
	public static function timeRelativeToSQL($s){ //+5m becomes ( NOW() + INTERVAL 5 MINUTE ), etc...
		$e = str_split($s);
		$unit = array_pop($e);
		$sign = array_shift($e);
		switch($unit){
			case 's': $unit = 'SECOND'; break;
			case 'm': $unit = 'MINUTE'; break;
			case 'd': $unit = 'DAY'; break;
			case 'M': $unit = 'MONTH'; break;
			case 'y': $unit = 'YEAR'; break;
			default: trigger_error('Invalid time specification.',E_USER_ERROR);
		}
		return ' ( NOW() '.$sign.' INTERVAL '.intval(implode('',$e)).' '.$unit.' ) ';
	}
	public static function timeInInterval($field,$start,$end){
		$wc = new WhereClause('and');
		if(!empty($start))//Assume goes off to neg infinity
			$wc->add('%b > %l',$field,self::timeRelativeToSQL($start));
		if(!empty($end))//Assume goes off to pos infinity
			$wc->add('%b < %l',$field,self::timeRelativeToSQL($end));
		return $wc;
	}
}

?>