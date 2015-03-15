<?php

class HomeLayoutModule {
	private $modulename;
	private $ordernumber;
	
	public function __construct($modulename, $ordernumber)
    {
        $this->modulename = $modulename;
        $this->ordernumber = $ordernumber;
	}
	
	public function getModulename() {
		return $this->modulename;
	}
	
	public function getOrdernumber() {
		return $this->ordernumber;
	}
}