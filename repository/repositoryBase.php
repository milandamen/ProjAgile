<?php

class RepositoryBase
{
    protected $db;

    public function __construct()
    {
        require_once 'database.php';
        $this->db = new Db();
    }

    public function getAll($tableName)
    {
        return $this->db->getQuery('SELECT * FROM ' . $tableName);
    }

}