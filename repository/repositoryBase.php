<?php

class RepositoryBase
{
    protected $db;
    protected $tableName;

    private $selectAll = 'SELECT * FROM ';

    public function __construct()
    {
        require_once 'database.php';
        $this->db = new Db();
    }

    public function getAll()
    {
        return $this->db->getQuery($this->selectAll . $this->tableName);
    }

    public function getById($id)
    {
        return $this->db->getQuery($this->selectAll . $this->tableName . ' where ' . $this->tableName . 'Id = ' . $id);
    }

    public function add($object)
    {

    }

    public function delete($id)
    {
        $this->db->execQuery('DELETE FROM ' . $this->tableName . ' where ' . $this->tableName . 'Id = ' . $id);
    }

}