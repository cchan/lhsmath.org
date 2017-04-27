<?php


/*
 * val()
 *
 * Data validation, with ludicrously overly immense power. Examples:
 *
 * val('i0+',$n,$m) returns true if both $n and $m are nonnegative integers.
 * val('*s',$_POST) returns true if $_POST is an array of strings (and nothing else). (which $_POST should always be)
 * val(array('abc','i'),array($a,$b))
    or val(array('abc','i'),$a,$b)
	or val('abc,i',array($a,$b))
	or val('abc,i',$a,$b)
    will verify that $a is an alphabetic string and $b an int.
 * val('**abc',$board)
    or val('*2abc',$board)
    returns true if $board is a 2D array of alphabetic strings (note: does not check row length alignment)
	Supports any nonnegative integer dimensions (zero is just a plain value, and 1 is just an array), even '*200abc'.
 * val('@@@@abc',$matrix)
    or val('@4abc',$matrix)
    returns true if $matrix is a 4D array of alphabetic strings, with row lengths properly aligned to form a rectangular hyperprism.
    Note that needing this is a sign of bad coding, and probably also indicates a chronic need to get a life, like me.
    Like *N, supports any nonnegative integer dimensions.
 * val('@10*4@3i',$matrix)
    Theoretically, you could do this if you wanted to verify a ten-dimensional aligned array of 
	four-dimensional arrays of three-dimensional aligned arrays of integers. What *are* you doing?
 */
function val($type /*,$x1,$x2,...*/){
	$args=func_get_args();
	array_shift($args);
	if(!count($args)){
		trigger_error('val(): Nothing to validate.',E_USER_ERROR);
		return false;
	}
  
  $x = $args[0];
	
  /*
	if(is_string($type)&&strpos($type,',')!==false)$type=explode(',',$type);
	
	if(is_array($type)){//MULTIPLE TYPES, MULTIPLE VALIDATEES
		while(count($type)>1 && count($args)==1 && is_array($args[0]))$args = $args[0];//While, because what if you nest empty arrays for no reason whatsoever?
		if(count($type)!=count($args)){trigger_error('val(): #types != #validatees',E_USER_ERROR);return false;}
		foreach($args as $arg)
			if(!val(array_shift($type),$arg))
				return false;
		return true;
	}
	elseif(is_string($type)&&count($args)>1){//SINGLE TYPE, MULTIPLE VALIDATEES
		foreach($args as $arg)
			if(!val($type,$arg))
				return false;
		return true;
	}
	elseif(!is_string($type)){trigger_error('val(): $type neither string nor array',E_USER_ERROR);return false;}//Invalid $type.
	*/
  
	/*********SINGLE VALIDATEE*********/
	
  /*
	$x=$args[0];//Already confirmed that it's only one validatee, so let's go do just this one arg.
	
	$firstchar = substr($type,0,1);
	$morechars = $type;
	
	//*: N-D ARRAY TYPE
	//@: N-D ALIGNED ARRAY TYPE
	if($firstchar=='*' || $firstchar == '@'){//does it work for '*0abc' and '@0abc'? Does it work for '***'? '@@@'? '*@*'?
		$str_shift = function(&$str){
			if(strlen($str)==0)trigger_error('str_shift(): empty string');
			$chr = substr($str,0,1);
			$str = substr($str,1);
			return $chr;
		};
		$dim=0;
		while(1){//Get how many dimensions are requested in the validation string
			$chr=$str_shift($morechars);
			while($chr==$firstchar){$dim++;$chr=$str_shift($morechars);}//Increments the dimension as long as there's more of that char.
			
			$tmpnum='0';
			while(val('d',$chr)){$tmpnum.=$chr;$chr=$str_shift($morechars);}//Appends digits to the end of the number as long as there's more digits,
			$dim+=intval($tmpnum);//and then adds them to the dimension number.
			
			if($chr!=$firstchar)break;//If there's no more useful chars (no digits, no * / @) then exit.
		}
		$morechars = $chr.$morechars;//Add the detected one back
		
		$dimensions=array();
		if($firstchar == '@'){//Dimensions checking, for @: grab it first into $dimensions
			$tmpx=$x;
			for($i=0;$i<$dim;$i++){//Grab the actual dimensions
				if(!is_array($tmpx))return false;
				array_unshift($dimensions,count($tmpx));//So the deepest will be at the beginning.
				$tmpx=$tmpx[0];
			}
		}
		
		//ok got everything, now recursively check all counts (if @), and at the bottom check the values.
		$rec_check = function($matrix,$n) use ($dimensions,$morechars,&$rec_check){//then use $n to determine where in $dimensions you are.
			if($n==0)return val($morechars,$matrix);
			if($firstchar=='@' && count($matrix)!=$dimensions[$n-1])return false;
			foreach($matrix as $submatrix)
				if(!$rec_check($submatrix,$n-1))return false;
			return true;
		};
		return $rec_check($x,$dim);
	}
  */
	
	//SINGLE SIMPLE TYPE
	switch(strtolower($type)){//All of these must begin with an alphabetic character.
    case '*':                 return is_array($x);
		case 's':case 'string':		return is_string($x);	//String
		
		case 'd':case 'digit':		return intval($x) == $x		//Digit
										&& $x>=0
										&& $x<10;
		
		case 'i-':	return intval($x) == $x && $x < 0;			//Negative int
		case 'i0-':	return intval($x) == $x && $x <= 0;			//Nonpositive int
		case 'i':	return intval($x) == $x;					//Int
		case 'i0+':	return intval($x) == $x && $x >= 0;			//Nonnegative int
		case 'i+':	return intval($x) == $x && $x > 0;			//Positive int
		
		case 'num':	return is_numeric($x);					//Number (including floats)
		
		case 'aln':	return is_string($x) && ctype_alnum($x);//Alphanumeric
		case 'abc':	return is_string($x) && ctype_alpha($x);//Alphabetic
		
		case 'e':case 'email':		return is_string($x)	//Email
										&& filter_var($x,FILTER_VALIDATE_EMAIL)!==false;
								// !!preg_match('/^([\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*[\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]'
								// .'+@((((([a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,6})|(\d{1,3}\.){3}\d{1,3}(\:\d{1,5})?)$/i'
								// , $email);
								// ^^^ a really long regex to *properly* validate email addresses
								// from https://fightingforalostcause.net/misc/2006/compare-email-regex.php
								// credit to James Watts and Francisco Jose Martin Moreno
		
		case 'f':case 'file':		return is_string($x)	//Filename
										&& preg_match('/^[A-Za-z0-9]([A-Za-z0-9\_\-\.]+[A-Za-z0-9])?$/i',$x)
										&& !strpos($x,'..');
		
		default:					debug_print_backtrace();trigger_error('val(): Invalid validation type.',E_USER_ERROR);return false;
	}
}



/*
 * format_phone_number($num)
 *  - $num: a ten-digit phone number
 *  - returns: $num in the form "(xxx) xxx-xxxx"
 *
 * Formats a phone number. If $num is not 10 digits long, it is returned
 * unchanged.
 */
function format_phone_number($num) {
	$num = preg_replace('@[^\d]@','',$num);
	
	//if(strlen($num) == 7) $num = '781' . $num; //Probably not a good idea to assume area codes.
	if(strlen($num) < 10)
		return false;
	
	$formatted = '(' . substr($num, 0, 3) . ') - ' . substr($num, 3, 3) . '-' . substr($num, 6, 4);
	if(strlen($num) > 10) //Extensions, such as with teachers' phone numbers.
		$formatted .= 'x' . substr($num, 10);
	return $formatted;
}





/*
 * trim_email($email)
 *  - $email: an email address
 *  - returns: a shortened email of 30 characters, in the form of bobsm...@example.com
 *      if the email address is longer than 30 characters long
 */
function trim_email($email) {
	$len = strlen($email);
	if ($len <= 30)
		return $email;
	
	$end_of_name = strpos($email, '@');
	
	if ($len - $end_of_name >= 27)	// if omitting the whole name won't be enough, just put the ... after 30 characters
		return substr($email, 0, 27) . '...';
	
	// otherwise, chop the end of the name and put ... at the end
	return substr($email, 0, $end_of_name - ($len - 27)) . '...' . substr($email, $end_of_name);
}

function getTextGradeFromYOG($yog){
	$grade = getGradeFromYOG($yog);
	if($grade <= 12 && $grade >= 9) return 'Grade '.strval($grade);
	elseif($grade > 12) return 'Alumni';
	else return 'Middle School';
}
function getGradeFromYOG($yog){
	//$yog = 2016 means they're graduating in ~~June of 2016. Let's have the switchover happen in July/August, since that's safer.
	if($yog != intval($yog)) return 'error';
	$yog = intval($yog);
	
	$currentyear = intval(date('Y'));
	$currentmonth = intval(date('n'));
	$grade = ($currentyear - $yog) + 12;
	if($currentmonth > 7) $grade++; //July/Aug switchover
	
	return $grade;
}

function sanitize_username($name){ //'Name must have only letters, hyphens, apostrophes, and spaces, and be between 3 and 30 characters long'
	$name = preg_replace('/\([\s\S]+\)/','',$name);//Remove anything parenthetical
	$name = ucwords(trim($name));//Capitalize it properly. Remove extraneous whitespace.
	$name = preg_replace('/\s+/', ' ', $name);//Replace all whitespace of any length with a single space (greedy regex)
	if (strlen($name) > 30 || strlen($name) < 3)
		return false;
	if (!preg_match('/^[A-Za-z\s\-\']+$/', $name))//Alphabetic and space and apostrophe and dash
		return false;
	return $name;
}







function inRange($n,$a,$b){//Checks if $n is in range [$a,$b].
	if(!val('i',$n))return NULL;
	if($a>$b)err('inRange: invalid range');
	if($n<$a)return -1;
	if($n>$b)return 1;
	return 0;
}
function normRange($n,$a,$b,$default=NULL){//Normalizes $n to the range [$a,$b]; if $n is invalid it sets to $default.
	$i=inRange($n,$a,$b);
	if($i===NULL)return $default;
	if($i===-1)return $a;
	if($i===1)return $b;
	return $n;
}

function arrayKeysExist($ARR,$indices){
	if(!val('*',$ARR))return false;
	foreach($indices as $index)
		if(!array_key_exists($index,$ARR))return false;
	return true;
}
function arrayKeysNotEmpty($ARR,$indices){//'' is empty - however, empty() takes 0 and '0' as empty :(
	if(!val('*',$ARR))return false;
	foreach($indices as $index)
		if(!array_key_exists($index,$ARR)||is_null($ARR[$index])||$ARR[$index]==='')return false;
	return true;
}
//--todo--Naming conventions... parametric conventions...
function anyIndicesEmpty($array/*, var1, var2, ...,varN*/){//it's NOT anyIndicesEmpty. '' is empty.
	$args=func_get_args();
	array_shift($args);
	foreach($args as $arg)
		if(!array_key_exists($arg,$array)||empty($array[$arg])/*&&$array[$arg]==='0'*/)return true;
	return false;
}

/****************ARRAY OPERATIONS*****************/
function randomizeArr($arr){//Randomly permute an array - yes, it works! in what amounts to O(n)!
//realization several months later... this is exactly the Fisher-Yates shuffle. But I discovered it myself, hmph!
	for($i=count($arr)-1;$i>0;$i--){
		$ind=mt_rand(0,$i);//Get the index of the one to swap with.
		$tmp=$arr[$ind];$arr[$ind]=$arr[$i];$arr[$i]=$tmp;//Swap with the last one.
	}
	return $arr;
}
function arrayToRanges($arr){//Converts [1,2,3,5,6,8,9,10] to the human-readable "1-3, 5-6, 8-10"
	if(count($arr)==0)return '';
	if(count($arr)==1)return $arr[0];
	sort($arr);
	$string='';
	$string.=$arr[0];
	for($i=1;$i < count($arr);$i++){
		if($arr[$i] > $arr[$i-1]+1){
			if($i>=2&&$arr[$i-1]==$arr[$i-2]+1)$string.=$arr[$i-1];
				$string.=', '.$arr[$i];
		}
		elseif($arr[$i]==$arr[$i-1]+1&&($i<2||$arr[$i]>$arr[$i-2]+2))$string.='-';
	}
	if($arr[count($arr)-1]==$arr[count($arr)-2]+1)$string.=$arr[count($arr)-1];
	return $string;
}
function Array2DTranspose($arr){//Transposes a 2d array (aka flipping x and y)
    $out = array();
    foreach ($arr as $key => $subarr)
		foreach ($subarr as $subkey => $subvalue)
			$out[$subkey][$key] = $subvalue;
    return $out;
}

/***************HTTP Data Exist/Get*******************/
//:( Always gonna be string type anyway...
function posted(){return arrayKeysExist($_POST,func_get_args());}
function POST($index){if(posted($index))return $_POST[$index];else return NULL;}

function getted(){return arrayKeysExist($_GET,func_get_args());}
function GET($index){if(getted($index))return $_GET[$index];else return NULL;}

function sessioned(){return arrayKeysExist($_SESSION,func_get_args());}
function SESSION($index){if(sessioned($index))return $_SESSION[$index];else return NULL;}

//Note: never trust REQUEST_URI or stuff like that. Can be spoofed.
function servered(){return arrayKeysExist($_SERVER,func_get_args());}
function SERVER($index){if(servered($index))return $_SERVER[$index];else return NULL;}

function filed(){return arrayKeysExist($_FILES,func_get_args());}
function FILES($index){if(filed($index))return $_FILE[$index];else return NULL;}

?>