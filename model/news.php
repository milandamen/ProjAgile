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

    public function __construct($id, $districtSectionId, $userId, $title, $content, $date, $hidden)
    {
        $this->id = $id;
        $this->districtSectionId = $districtSectionId;
        $this->userId = $userId;
        $this->title = $title;
        $this-> $content;
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

    public function getContent(){
        return $this->content;
    }

    public function getDate(){
        return $this->date;
    }

    public function gethidden(){
        return $this->hidden;
    }
}