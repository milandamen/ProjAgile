<?php
    class RepositoryBase
    {
        protected $db;
        protected $tableName;

        protected $selectAll = 'SELECT * FROM ';

        public function __construct()
        {
            require_once 'database.php';
            $this->db = Db::getDb();
        }

        public function getAll()
        {
            return $this->db->getQuery($this->selectAll . $this->tableName);
        }

        public function getById($id)
        {
            $query = $this->selectAll . $this->tableName . ' WHERE ' . $this->tableName . 'Id = :' . $this->tableName .'Id';
            $parameter = array(':' . $this->tableName . 'Id' => $id);

            return $this->db->getQuery($query, $parameter);
        }

        public function add($object)
        {

        }

        public function update($object)
        {

        }

        public function delete($id)
        {
            $query = 'DELETE FROM ' . $this->tableName . ' WHERE ' . $this->tableName . 'Id = :' . $this->tableName . 'Id';
            $parameter = array(':' . $this->tableName . 'Id' => $id);

            $this->db->execQuery($query, $parameter);
        }
    }
?>