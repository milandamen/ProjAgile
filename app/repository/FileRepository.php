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

    public function add($filePaths, $newsId)
    {
        $query = 'INSERT INTO files (idfiles, path) VALUE(:idfiles, :path)';
        $query2 = 'INSERT INTO news_files (news_newsId, files_idfiles) VALUE(:news_newsId, :files_idfiles)';

        foreach($filePaths as $path)
        {
            $parameters = array(':idfiles' => null, ':path' => $path);
            $this->db->execQuery($query, $parameters);
            $lastFileId = $this->db->getLastInsertedId();
            $parameters2 = array(':news_newsId' => $newsId, ':files_idfiles' => $lastFileId);
            $this->db->execQuery($query2, $parameters2);
        }
    }
}