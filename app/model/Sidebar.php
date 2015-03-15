<?php


class Sidebar{
	private $row;
	private $text;
	private $pageNr;
	private $title;
	private $intern;
	private $extern;


	function __construct($pageNr, $rowNR, $title, $text, $internlink, $externlink)
	{
		$this->pageNr = $pageNr;
		$this->text = $text;
		$this->row = $rowNR;
		$this->title = $title;
		$this->intern = $internlink;
		$this->extern = $externlink;

	}

	public function getPageNr()
	{
		return $this->pageNr;
	}


	public function getRowNr()
	{
		return $this->row;
	}

	public function getTitle(){
		return $this->title;
	}


    public function getText()
    {
        return $this->text;
    }

	public function getInternLink() {
		return $this->intern;
	}

	public function getExternLink()  {
		return $this->extern;
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function setPage($page)
	{
		$this->pageNr = $page;
	}

	public function setRow($row)
	{
		$this->row = $row;
	}

    public function setText($text)
    {
        $this->text = $text;
    }

}