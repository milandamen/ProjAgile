<?php

class Introduction
{
    private $pageNr;
    private $text;
    private $title;

    function __construct($pageNr, $text, $title)
    {	
    	$this->pageNr = $pageNr;
    	$this->text = $text;
    	$this->title = $title;
    }

    	// All getters for the attributes.
	public function getPageNr()
	{
		return $this->pageNr;
	}

	public function getTitle(){
		return $this->title;
	}


    public function getText()
    {
        return $this->text;
    }


	// All setters for the attributes. 
	
	public function setTitle($title){
		$this->title = $title;
	}

	public function setPage($page)
	{
		$this->pageNr = $page;
	}


    public function setText($text)
    {
        $this->text = $text;
    }


}