<?php
require_once 'database.php';

class A {
	protected $db;
	
	public function __construct() {
		$this->db = new Db();
	}
	
	public function func1() {
		$result = $this->db->getQuery(
				'SELECT *
				FROM news'
		);
		
		var_dump($result);
	}
}

class B extends A {
	public function func1() {
		echo 'Dit is '.$this->name.'!';
	}
}

$a = new A();
$a->func1();
