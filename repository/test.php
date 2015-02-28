<?php
class A {
	protected $name = 'piet';
	
	public function func1() {
		echo 'Dit is func1!';
	}
}

class B extends A {
	public function func1() {
		echo 'Dit is '.$this->name.'!';
	}
}

$a = new B();
$a->func1();
?>