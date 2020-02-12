<?php
//Class for DB Connection and general PDO functions with right integration
/*
WHAT DOES IT INCLUDE:
	--Authorization:	-checking the rights for the tables
	--DBControl:		-checking the database, if an error accures and send the query a second time
	
	
METHODS: 	-execute	-only for select statements
			-sqlinsert 	-only for insert statements
			-sqlupdate	-only for update statements
			-handle		-check if a request was successfull and check the table in the database if needed
*/

include_once __DIR__.'/functions.php';

class DBObject {
	static protected $pdo;
	
	function __construct() {
		if (!isset(DBObject::$pdo)) {DBObject::$pdo = new PDO("mysql:host=".HOST.";dbname=".DATABASE.";charset=utf8", USER, PASSWORD);} 			//PDO-based Connection
	}
	function execute( $query, $arrayData = array()) { 											//Datenabfrage
 		$statement = DBObject::$pdo->prepare($query);
		return $statement->execute($arrayData);
	}
}
?>