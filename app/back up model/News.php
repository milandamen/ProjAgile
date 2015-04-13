<?php

class News
{
    private $id;
    private $districtSectionId;
    private $userId;
    private $title;
    private $content;
    private $date;
    private $hidden;
    private $author;
    private $district;

    public function __construct($id, $districtSectionId, $userId, $title, $content, $date, $hidden)
    {
        $this->id = $id;
        $this->districtSectionId = $districtSectionId;
        $this->userId = $userId;
        $this->title = $title;
        $this->content = $content;
        $this->date = $date;
        $this->hidden = $hidden;
    }

    public function getId(){
        return $this->id;
    }

    public function getDistrictSectionId(){
        return $this->districtSectionId;
    }

    public function getUserId(){
        return $this->userId;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getContent(){
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getNormalDate()
    {
    	$date = date_create($this->date);
    	return date_format($date,'d-m-Y') ;
    }

    public function getHidden(){
        return $this->hidden;
    }

    public function setAuthor($author){
    	$this->author = $author;
    }

    public function getAuthor(){
    	return $this->author;
    }

    public function setDistrict($district){
    	$this->district = $district;
    }

    public function getDistrict(){
    	return $this->district;
    }

}