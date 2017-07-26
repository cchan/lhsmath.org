<?php
/*
 * .lib/functions.logs.php
 * LHS Math Club Website
 *
 */

//$DB_LOG_EDITS = false; // to be implemented in MeekroDB for all table edits.

if(!isset($DEBUG_ASSERTS))
	$DEBUG_ASSERTS = !$CATCH_ERRORS || false; // Enables/disables assertTruth() statements - if assert is used while this is false, it simply does nothing.

//use GA for actual pages' stats

function log_pageload(){ //For notable pages such as Password_Reset
	LOG::notice();
}

class LOG{
	public static function write($txt){
		write_log($txt);
	}
	public static function notice($txt){
		trigger_error($txt,E_USER_NOTICE);
	}
	public static function warning($txt){
		trigger_error($txt,E_USER_WARNING);
	}
	public static function error($txt){
		trigger_error($txt,E_USER_ERROR);
	}
	public static function fatal($txt){
		trigger_error($txt,E_USER_ERROR);
		die("Fatal error occurred.");
	}
	public static function assert($truth){
		global $DEBUG_ASSERTS;
		if($DEBUG_ASSERTS && !$truth){
			$d_bt = debug_backtrace();
			LOG::fatal("Debug assertion failed at line ".$d_bt[0]['line']." of file ".$d_bt[0]['file'].".");
			return false;
		}
		return true;
	}
}

function write_log($txt){
	//Generate error text
	$logtext = ' DATE:' . date(DATE_RFC822) . ' IP:' . $_SERVER['REMOTE_ADDR'] . ' ' . $txt;
	
	//Log it in the proper file
	file_put_contents(PATH::errfile(), $logtext, FILE_APPEND);
}

/*
 * custom_errors($errno, $errstr, $errfile, $errline)
 *
 * Logs errors and shows an error page
 */
$show_debug_backtrace = false;
set_error_handler(function($errno, $errstr, $errfile, $errline) {
	global $CATCH_ERRORS;
	
	//Being safe: https://stackoverflow.com/questions/16655453/change-php-behavior-for-undefined-constants
	if(stripos($errstr, 'Use of undefined constant') !== FALSE){
        trigger_error($errstr, E_USER_ERROR);//Undefined consts automatically become strings, which is really bad. Elevate it to a fatal error.
        return TRUE;
    }
	
	if(stripos($errstr, 'Undefined variable')){
		trigger_error($errstr, E_USER_NOTICE);//Whatever, doesn't matter, but log it anyway as a notice
		return TRUE;
	}
	
	//Write to the logfile always
	$err = 'Error [#' . $errno . '] on line ' . $errline . ' in ' . $errfile . ': ' . $errstr . "\n";
	write_log($err);
	
	if(!$CATCH_ERRORS){//If catching errors is disabled, dump everything out.
		alert($err,-1);
		global $show_debug_backtrace; //Insert anywhere: "global $show_debug_backtrace;$show_debug_backtrace=true;" and it'll do it.
		if($show_debug_backtrace)var_dump(debug_backtrace());
		return;
	}
	
	if($errno & (E_USER_NOTICE | E_USER_WARNING | E_WARNING | E_NOTICE))
		return; //Just a notice/warning, not worth bothering the user for
	
	if (headers_sent())//Headers were already sent; we can't tell the browser HTTP/1.1 500 Internal Server Error
		echo '<meta http-equiv="refresh" content="0;url='.URL::root().'/Error">';
	elseif (isSet($_GET['xsrf_token']))//So we don't resubmit with the xsrf_token again and cause infinite error generation.
		header('Location: '.URL::root().'/Error');
	else {
		header("HTTP/1.1 500 Internal Server Error");
		page_title('Error');
		echo <<<HEREDOC
      <h1>Error</h1>
      
      Whoops! Something went wrong. Try again?
HEREDOC;
	}
	
	die;
}, E_ALL);
error_reporting(E_ALL);
/*else{function a(){debug_print_backtrace();}function b(){global $a;if($a)echo var_dump($a);}
function c(){global $a;if(!$a)$a=array();$a[]=debug_backtrace();}set_error_handler('a',E_ALL&!E_NOTICE);
register_shutdown_function('b');}*/ //Debug backtracing; put c() wherever to output; will also output on program end

?>