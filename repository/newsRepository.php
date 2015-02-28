<?php

class NewsRepository
{
    private $db;
    private $getAllNewsQuery = "SELECT * FROM news";

    public function __construct()
    {
        $this->db = new Db();
    }

    public function getAllNews()
    {
        $newsarray = $this->db->getQuery($this->getAllNewsQuery);

        echo $newsarray[0]->name;

    }
}