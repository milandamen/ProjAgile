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

    public function getAllByNewsId($newsId)
    {
        $query = 'SELECT * FROM file WHERE newsId = :newsId';
        $parameter = array(':newsId' => $newsId);

        return $this->db->getQuery($query, $parameter);
    }

    public function addFile($filePath, $newsId)
    {
        $query = 'INSERT INTO file (fileId, path, newsId) VALUE(:fileId, :path, :newsId)';
        $parameters = array(':fileId' => null, ':path' => $filePath, ':newsId' => $newsId);
        $this->db->execQuery($query, $parameters);
    }

    public function deleteAllByNewsId($newsId)
    {
        $query = 'DELETE FROM file WHERE newsId = :newsId';
        $parameters = array(':newsId' => $newsId);
        $this->db->execQuery($query, $parameters);
    }

}