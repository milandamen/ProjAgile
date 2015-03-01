<?php
require_once 'repositoryBase.php';
class NewsRepository extends RepositoryBase
{

    private $name = 'news';

    public function __construct()
    {
        #call to base constructor
        parent::__construct();
        $this->tableName = $this->name;
    }

    public function add($object)
    {
        $query = 'INSERT INTO ' . $this->name . '(newsId, districtSectionId, userId, title, content, date, hidden) VALUES($object->getId(), $object->getDistrictSectionId(), $object->getUserId(), $object->getTitle(), $object->getContent(), $object->getDate(), $object->getHidden())';

        #$query = 'INSERT INTO ' . $this->name . '(newsId, districtSectionId, userId, title, content, date, hidden) '.'VALUES(:newsId, :districtSectionId, :userId, :title, :content, NOW(), :hidden)';


        $this->db->execQuery($query);
    }

}