<?php

class Db {
	// Connection settings
	private $HOST = 	'84.246.4.143';
	private $PORT = 	'9130';
	private $DBNAME = 	'Vermeule3bunders';
	private $USERNAME =	'Vermeule3bunders';
	private $PASSWORD =	'Koekje07';
	
	const FETCH_ASSOC = PDO::FETCH_ASSOC;	// Return fetch result as an associaive array.
	const FETCH_OBJ = PDO::FETCH_OBJ;		// Return fetch result as an array with objects.
	// Default: FETCH_OBJ
	
	private static $singleton;				// Make sure every repository uses the same database library.
	private $database;						// PDO object for database connection handling.
	
	// Smart statements
	private $usesmartstmt;					// Boolean for enable/disable of smart statements mode.
	private $lastquery;						// When smart statements mode is enabled, this variable will contain the string of the last query.
	private $laststmt;						// When smart statements mode is enabled, this variable will contain the PDOStatement object of the last query.
	// Default: Enabled
	
	// Debug
	private $debugmode = true;				// Boolean for enable/disable of debug mode. To print debug info call dumpDebug().
	private $debugcollection = array();		// When debug mode is enabled, contains log of all statement errors.
	
	/**
		Constructor for this database library. Sets use of smart statements and connects to the database.
	*/
	private function __construct() {
		$this->usesmartstmt = true;
		$this->dbConnect();
	}
	
	/**
		Destructor for this database library. Closes the database connection and any open statements.
	*/
	public function __destruct() {
		$this->dbClose();
		$this->dumpDebug();
	}
	
	/**
		Gets the current database library in use, or create database library. One database library is used globally.
	*/
	public static function getDb() {
		if (self::$singleton == null) {
			self::$singleton = new self();
		}
		
		return Db::$singleton;
	}
	
	/**
		Destroy the database library. Disconnects from database and statements.
	*/
	public static function destruct() {
		self::$singleton = null;
	}
	
	/**
		Connect to the database.
	*/
	public function dbConnect() {
		try {
			$this->database = new PDO(
					'mysql:host='.$this->HOST.
					';port='.$this->PORT.
					';dbname='.$this->DBNAME
					, $this->USERNAME
					, $this->PASSWORD
			);
		} catch(PDOException $e){
			throw new Exception('Database error: '.$e->getMessage());
		}
	}
	
	/**
		Close the database connection and any open statements.
	*/
	public function dbClose() {
		$this->closeLastStatement();
		$this->database = null;
	}
	
	/**
		If you enabled smart statements, manually disconnect and remove the last statement.
	*/
	public function closeLastStatement() {
		$this->lastquery = null;
		$this->laststmt = null;
	}
	
	/**
		Execute a query.
	*/
	public function execQuery($query, $params = array()) {
		$stmt = null;
		if ($this->usesmartstmt && $this->isLastQuery($query)) {
			$stmt = $this->laststmt;
		} else {
			$this->closeLastStatement();
			$stmt = $this->database->prepare($query);
		}
		
		foreach ($params as $key => $value) {
			$stmt->bindValue($key, $value);
		}

		$stmt->execute();
		
		$this->logError($stmt);
		
		if ($this->usesmartstmt) {
			$this->lastquery = $query;
			$this->laststmt = $stmt;
		} else {
			$stmt = null;
		}
	}
	
	/**
		Execute a query. If the query returns rows, the result gets returned depending on what mode is set.
		Mode Db::FETCH_ASSOC:   return an associative array
		Mode Db::FETCH_OBJ:     return an array with objects
		
		Example:
			$id = 3;
			$hidden = false;
			
			$result = $db->getQuery(
					'SELECT * 
					FROM news 
					WHERE id = :id AND hidden = :hidden',
					array(
						':id' => $id,
						':hidden' => $hidden
					)
			);
			
			if (is_array($result) && count($result) == 1) {			// If you want a result and only 1 result
				$title = $result[0]->title;
				$userId = $result[0]->userId;
			} else {
				die('ERROR: Recieved invalid result from database!');
			}
		
		If there are more rows returned you can parse the list with a foreach loop:
			foreach($result as $key => $object){
				// Do something with each object, for example:
				echo $object->title;
			}
	*/
	public function getQuery($query, $params = array(), $mode = Db::FETCH_OBJ) {
		$stmt = null;
		if ($this->usesmartstmt && $this->isLastQuery($query)) {
			$stmt = $this->laststmt;
		} else {
			$this->closeLastStatement();
			$stmt = $this->database->prepare($query);
		}
		
		foreach ($params as $key => $value) {
			$stmt->bindValue($key, $value);
		}
		
		$stmt->execute();
		
		$this->logError($stmt);
		
		$result = null;

		if ($mode == Db::FETCH_ASSOC) {
			$result = $stmt->fetchAll();
			if (!isset($result) || !is_array($result)) {
				$result = array();
			}
		}
		if ($mode == Db::FETCH_OBJ) {
			$result = array();
			while ($row = $stmt->fetchObject()) {
				$result[] = $row;
			}
		}
		
		if ($this->usesmartstmt) {
			$this->lastquery = $query;
			$this->laststmt = $stmt;
		} else {
			$stmt = null;
		}
		
		return $result;
	}
	
	/**
		Enables or disables the use of smart statements.
	*/
	public function setUseSmartStatement($bool) {
		$this->usesmartstmt = $bool;
	}
	
	/**
		Enables or disables debug mode.
	*/
	public function setDebugMode($bool) {
		$this->debugmode = $bool;
	}
	
	/**
		Dumps log of statement errors (if debugmode is enabled).
	*/
	public function dumpDebug() {
		if ($this->debugmode && count($this->debugcollection)) {
			var_dump($this->debugcollection);
		}
	}
	
	/**
		If an error happened, log to debug collection.
	*/
	private function logError($stmt) {
		if ($this->debugmode) {
			$error = $stmt->errorInfo();
			if (isset($error) && $error[1]) {
				$this->debugcollection[] = $error;
			}
		}
	}
	
	/**
		Is the currently pending query the same as last one?
	*/
	private function isLastQuery($query) {
		return $this->lastquery === $query;
	}
}

Db::getDb();		// Initialize the database on startup
?>