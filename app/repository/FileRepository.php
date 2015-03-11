<?php
require_once 'repositoryBase.php';
class FileRepository extends RepositoryBase
{
    private $name = 'file';

    public function __construct()
    {
        #call to base constructor
        parent::__construct();
        $this->tableName = $this->name;
    }

    public function add($filePath, $newsId)
    {
        $query = 'INSERT INTO file (fileId, path, newsId) VALUE(:fileId, :path, :newsId)';
        $parameters = array(':fileId' => null, ':path' => $filePath, ':newsId' => $newsId);
        $this->db->execQuery($query, $parameters);
    }
}