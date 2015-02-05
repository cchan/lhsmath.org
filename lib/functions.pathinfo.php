<?php

function backslashToForward($url){
	return str_replace("\\","/",$url);
}
function substr_b($str,$start,$len = NULL){
	if(strlen($str) == $start) return "";
	if($len === 0) return "";
	if($len === NULL)return substr($str, $start);
	return substr($str, $start, $len);
}
function removeLeadingSlash($str){
	if(strpos($str,'/') === 0 || strpos($str,"\\") === 0)return substr_b($str,1);
	else return $str;
}
function concatURLNoBlanks(){
	$out = '';
	foreach(func_get_args() as $s){
		if($s == '') continue;
		$out .= $s . "/";
	}
	return substr_b($out,0,strlen($out)-1);
}





//https://stackoverflow.com/questions/834303/startswith-and-endswith-functions-in-php
function stringStartsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}
function stringEndsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || strpos($haystack, $needle, strlen($haystack) - strlen($needle)) !== FALSE;
}




function subtractURLsStart($a,$b){//Removes $b from the beginning of $a, if possible. Else errors.
	if(stringStartsWith($a, $b))
		return substr_b($a,strlen($b));
	else
		trigger_error("URL processing error: subtractURLsStart".var_export(debug_backtrace(),true),E_USER_ERROR);
}
function subtractURLsEnd($a,$b){//Removes $b from the end of $a, if possible. Else errors.
	if(stringEndsWith($a, $b))
		return substr_b($a,0,strlen($a)-strlen($b));
	else
		trigger_error("URL processing error: subtractURLsEnd",E_USER_ERROR);
}




class PATH{//Actual system path - Used in require, file I/O, etc.
	public static function root(){ return backslashToForward(dirname(__DIR__)); }									//Get the current dir (/lib) and go down one.
	public static function lib(){ return backslashToForward(__DIR__); }												//
	public static function dir(){ return backslashToForward(dirname($_SERVER['SCRIPT_FILENAME'])); }				//
	public static function filename(){ return basename($_SERVER['SCRIPT_FILENAME']); }			//
	public static function filepath(){ return backslashToForward($_SERVER['SCRIPT_FILENAME']); }					//
	public static function content(){ return self::root() . '/.content'; }						//
	public static function errfile(){ return self::content() . '/Errors.txt'; }					//
}

class URL{//Internet path - Used when constructing HTML, URLs, headers, etc.
	public static function pathToRootFromURLRoot(){return removeLeadingSlash(subtractURLsEnd(
		backslashToForward(dirname(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))),	//Gets http://website[/path/to/lhsmath/path/to/whatever]/file.php
		subtractURLsStart(PATH::dir(), PATH::root())	//Gets C:/path/to/htdocs/path/to/lhsmath[/path/to/whatever]/file.php
	)); }
	public static function root(){ return concatURLNoBlanks(((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'], self::pathToRootFromURLRoot()); }
	public static function dir(){ return removeLeadingSlash(subtractURLsStart(removeLeadingSlash(backslashToForward(dirname(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)))), self::pathToRootFromURLRoot())); }
	public static function filename(){ return basename($_SERVER['REQUEST_URI']); }
	public static function filepath(){ return concatURLNoBlanks(self::dir(), self::filename()); }
	public static function fileurl(){ return concatURLNoBlanks(self::root(), self::filepath()); }
}



function stringAllPathInfo(){
	$out = '';
	foreach(get_class_methods('PATH') as $method)
		$out .= 'PATH::'.$method.'() = ['.call_user_func(array('PATH',$method))."]\n";
	foreach(get_class_methods('URL') as $method)
		$out .= 'URL::'.$method.'() = ['.call_user_func(array('URL',$method))."]\n";
	return $out;
}
echo nl2br(stringAllPathInfo());
?>