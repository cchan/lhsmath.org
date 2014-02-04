<?php
/*
class.DB.php

Written by Clive Chan in PHP
Licensed under a Creative Commons Attribution-ShareAlike 4.0 International License
http://creativecommons.org/licenses/by-sa/4.0/

Defines the DB class, through which consistently secure database queries can be made.
*/

/*class DB
Database access class.
Makes databasing more secure (consistently sanitized/constructed queries) and shorter code.
Dependencies:
	PHP MySQLi (introduced in PHP 5)
	globals $DB_DOMAIN, $DB_UNAME, $DB_PASSW, [and optionally $DB_DB] all defined
Potential improvements:
	DELETE... (LIMIT 1)-> UPDATE... SET Deleted=1 (LIMIT 1)
	UNDELETE... (LIMIT 1)-> UPDATE... SET Deleted=0 (LIMIT 1)
	Honeypotting to a dud db when there's an obvious attack
	Using Show grants to make sure this user can do the very few specific things, and only those.

USAGE:
Initialization
	$db=new DB();			//Constructs database object connecting to database $DB_DB
	$db=new DB;				//Same as above
	$db=new DB('asdf');		//Constructs database object connecting to database 'asdf'
Queries
	$db->query('SELECT col1, col2 FROM table1 WHERE id=%0% AND name=%1%',[$_POST['id'],$name]);
		//Constructs the query from the first template string, and substituting each %n%
			//with the corresponding (zero-indexed) index from the second, array, parameter.
		//Everything is sanitized, so feel free to pass in $_POST variables directly.
		//Returns the mysqli_result object from the query.
	$db->query_assoc(...);
		//Returns $db->query->fetch_assoc(),
		//which gives back the first row found as associative array.
Insert-ID
	$db->insert_id
		//Gives you the ID of the inserted row from mysqli->insert_id
		//(only valid for INSERT)
		//Also, gives you only the LAST inserted one when inserting multiple
Closing
	unset($db); //[better]
	$db->__destroy();
		//Cleans up. Both ways work, but the second leaves $db reusable while the first makes it undefined.
		//Alternatively, just leave it, and PHP will automatically __destroy() it.
*/


final class DB{
	/*
	mysqli $con
		The original purpose of $DB, to encapsulate privately the $con variable.
		Represents connection to database made upon DB() construction, through which stuff is done.
		Private; don't use it.
	*/
	private $con;
	
	
	/*
	mixed $insert_id
		Variable containing the (integer) inserted id for INSERT statements in AUTO_INCREMENT tables.
		I don't know what it is for non-insert statements, and you should not be doing that.
	*/
	public $insert_id;
	
	/*
	int $num_rows
		Variable containing the (integer) number of rows found in a SELECT operation.
		I don't know what it is for non-select statements, and you should not be doing that.
	*/
	public $num_rows;
	
	
	/*
	__construct(string $db)
		Constructs an instance of DB, connecting to the database specified in $db.
		
		If $db isn't provided, uses global $DB_DB.
		
		Don't call it directly, use the "new" keyword.
	*/
	public function __construct($DB_SERVER=NULL,$DB_USERNAME=NULL,$DB_PASSWORD=NULL,$DB_DATABASE=NULL){//All this does is to try to connect to the db, and store that con in $this->con
		//Better to specify it explicitly.
		//if(is_null($DB_SERVER))global $DB_SERVER;
		//if(is_null($DB_USERNAME))global $DB_USERNAME;
		//if(is_null($DB_PASSWORD))global $DB_PASSWORD;
		//if(is_null($DB_DATABASE))global $DB_DATABASE;
		if(is_null($DB_SERVER)||is_null($DB_USERNAME)||is_null($DB_PASSWORD)||is_null($DB_DATABASE))$this->err('Bad connection parameters');
		$this->con=new MySQLi($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);
		if(!$this->con||$this->con->connect_error)$this->err('Failed connection');
		
		//var_dump($this->con->query('SHOW GRANTS')->fetch_all());
		
	}
	
	
	/*
	__destruct()
		Your run-of-the-mill class destructor. You can call it directly, use unset(),
			or just let PHP automatically do it upon program end.
	*/
	public function __destruct(){
		$this->con->kill($this->con->thread_id);
		$this->con->close();
		unset($this->con);
	}
	
	
	/*
	query(string $template,array(string) $replaceArr)
		
	*/
	public function query($template,$replaceArr=array()){
		if(!is_string($template))$this->err('Template not a string');//not a string
		if(!is_array($replaceArr))$this->err('Replacements not an array');//not an array
		
		//Check that it's not *allowed* to do anything other than those three [this in constructor]
		//self-modding self-verification [also in constructor]?
		
		//Check that it has no wildcard characters
		//$quoteless=preg_replace("",$template);
		//if(strpos($quoteless,'*')$this->err('wildcard being used');
		
		//Replace all the %0%,%1%,... things
		foreach($replaceArr as $ind=>$replace)
			if(!is_int($ind))$this->err('Not a number index of replacement arr');
			else $template=str_replace('%'.intval($ind).'%',$this->sanitize($replace),$template);
		if(preg_match('/%\d+%/',$template))$this->err('Unsuccessful replacement');//not all replaced
		
		if($this->isDestructiveQuery($template))$this->err('destructive query');//destructive query noooo
		
		//if(stripos($template,'WHERE')!==false)//adding in a "AND Deleted=0" since that's the point of the Deleted thing
		
		$this->insert_id=$this->num_rows=NULL;
		
		if(($qresult=$this->con->query($template))===false)//On the Acer, the query takes avg 0.01 sec.
			$this->err('Query failed: '.$this->con->error);//failed query
		else{
			$this->insert_id=intval($this->con->insert_id);
			if($qresult!==true)$this->num_rows=intval($qresult->num_rows);
		}
		
		return $qresult;
	}
	
	
	/*
	query_assoc(string $template,array(string) $replaceArr)
		Same as query(), but returns the associative array representing the first row instead.
		For non-SELECT (non-data-gathering) queries, it just returns true, exactly like query().
	*/
	public function query_assoc($template,$replaceArr=array()){
		$qresult=$this->query($template,$replaceArr);
		if($this->num_rows != 1)$this->err('Query_assoc on more than one row (or zero)');
		if($qresult===true)return true;//Not a data-gathering query, like INSERT or DELETE or UPDATE
		return $qresult->fetch_assoc();//A data-gathering query, like SELECT
	}
	
	/*
	sanitize(mixed $in)
		Sanitizes a replacement-variable of a query.
		Private; you don't need to use it.
	*/
	private function sanitize($in){
		//NULL: it's just... null. Nothing to sanitize about that.
			//But needs to be string 'NULL' so the query doesn't have a missing blank spot.
		if($in===''||$in===NULL)return 'NULL';
		
		//BOOL: Explicit typecasting, since it's TINYINT(1) in MySQL
		if($in===true)return '1';elseif($in===false)return '0';
		
		//INT: More explicit typecasting
		if(is_int($in))return strval(intval($in));
		
		//STRING: Below means it's a string of some sort, so it'll be thoroughly sanitized:
			//str_replace'd, HTMLENTITIES'd, mysqli_real_escape_string'd, and put in double quotes.
		if(!is_string($in))$this->err('Invalid replacement-param type');
		
		//htmlentities troubleshooting :( It doesn't like weird characters.
		$search = array(chr(145), //'smart' single quotes
							chr(146), //'smart' single quotes
							chr(147), //'smart' double quotes
							chr(148), //'smart' double quotes
							chr(151)); //em dash
		$replace = array("'", 
							 "'", 
							 '"', 
							 '"', 
							 '-');
		$processed=str_replace($search, $replace, $in);
		
		$escaped=$this->con->real_escape_string(
			htmlentities($processed,ENT_QUOTES|ENT_HTML401,'ISO-8859-1')//Trying to make HTMLENTITIES work.
		);
		
		if($escaped=='')$this->err('HTMLENTITIES failed on string "'.$processed.'"');
		
		return '"'.$escaped.'"';
	}
	
	
	/*
	isDestructiveQuery(string $q)
		Checks for DROPs and TRUNCATEs in query $q. Those tend to be bad.
		Private; you don't need to use it.
		
		Note: $DELETED_FLAG_IMPLEMENTED indicates whether the Deleted flag on db entries is implemented in this particular web application.
			If false, will allow DELETEs with LIMITs.
			If true, will not allow any sort of DELETE.
		Note on Note: $DELETED_FLAG_IMPLEMENTED is deprecated, but you can bring it back if you want.
			You must use UPDATE asdf SET Deleted=1 WHERE qwer=123 LIMIT 1
			instead of DELETE FROM asdf SET Deleted=1 WHERE qwer=123 LIMIT 1
	*/
	private function isDestructiveQuery($q){
		//$DELETED_FLAG_IMPLEMENTED=true;
		
		//Check that its main command is indeed SELECT, INSERT, or UPDATE.
		if(strpos($q,' ')===false)$this->err('no spaces...?');
		$maincmd=strtolower(substr($q,0,strpos($q,' ')));
		if(!in_array($maincmd,['select','insert','update'],true))$this->err('Select, insert, and update only.');
		
		//Check that there's no DROP, TRUNCATE, or DELETE. Maybe should check others too.
		if(stripos($q,'DROP ')!==false||stripos($q,'TRUNCATE ')!==false||stripos($q,'DELETE ')!==false
			//&&($DELETED_FLAG_IMPLEMENTED||stripos($q,'LIMIT')===false)
				)$this->err('possibly dangerous query');
		
		if(stripos($q,'--')!==false)$this->err('possible sql injection');
		
		return false;
	}
	
	
	/*
	err(string $str)
		Triggers a custom error specifically for class DB.
		Private; you don't need to use it.
	*/
	private function err($str){
		$helpful=true;
		if($helpful)trigger_error('DB error: '.htmlentities($str),E_USER_ERROR);
		else trigger_error('Error.',E_USER_ERROR);
		die();
	}
};
?>