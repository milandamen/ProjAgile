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
        $query = 'INSERT INTO ' . $this->name . '(newsId, districtSectionId, userId, title, content, date, hidden) VALUES(:newsId, :districtSectionId, :userId, :title, :content, NOW() , :hidden)';

        $parameters = array(
            ':newsId' => $object->getId(),
            ':districtSectionId' => $object->getDistrictSectionId(),
            ':userId' => $object->getUserId(),
            ':title' => $object->getTitle(),
            ':content' => $object->getContent(),
            ':hidden' => $object->getHidden()
        );

        $this->db->execQuery($query, $parameters);
    }

}