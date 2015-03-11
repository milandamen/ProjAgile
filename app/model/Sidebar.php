<?php


class Sidebar{
	private $text;
	private $link;
	private $page;
	private $title;


	function __construct($page, $title, $text, $link)
	{
		$this->$title = $title;
		$this->page = $page;
		$this->text = $text;
		$this->link = $link;
	}

	public function getTitle(){
		return $this->title;
	}

	public function setTitle($title){
		$this->title = $title;
	}


	public function getPage()
	{
		return $this->page;
	}

	public function setPage($page)
	{
		$this->page = $page;
	}

    public function getLink()
    {
        return $this->link;
    }

    public function setLink($link)
    {
        $this->link = $link;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

}