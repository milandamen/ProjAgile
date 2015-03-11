<?php

class Footer
{
    private $col;
    private $row;
    private $link;
    private $text;

    function __construct($col, $row, $text, $link)
    {
        $this->col = $col;
        $this->row = $row;
        $this->text = $text;
        $this->link = $link;
    }

    public function getCol()
    {
        return $this->col;
    }

    public function setCol($col)
    {
        $this->col = $col;
    }

    public function getRow()
    {
        return $this->row;
    }

    public function setRow($row)
    {
        $this->row = $row;
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