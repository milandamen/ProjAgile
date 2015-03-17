<?php

class News
{
    private $id;
	private $newsId;
	private $imgpath;
	private $title;

    public function __construct($id, $newsId, $imgpath, $title)
    {
        $this->id = id;
		$this->newsId = newsId;
		$this->imgpath = imgpath;
		$this->title = title;
    }

    public function getId(){
        return $this->id;
    }
	
	public function getNewsId(){
        return $this->newsId;
    }
	
	public function getImgpath(){
        return $this->imgpath;
    }

    public function getTitle(){
        return $this->title;
    }

}