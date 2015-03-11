<?php
require_once 'repositoryBase.php';
require_once '../app/model/News.php';

class NewsRepository extends RepositoryBase
{

    private $name = 'news';

    public function __construct()
    {
        #call to base constructor
        parent::__construct();
        $this->tableName = $this->name;
    }

    public function getAll()
    {
        #call to base method getAll
        $objects = parent::getAll();
        $newsArray = array();

        #convert result objects to news objects
        foreach($objects as $var)
        {
            $newsArray[] = new News($var->newsId, $var->districtSectionId, $var->userId, $var->title, $var->content, $var->date, $var->hidden);
        }
        return $newsArray;
    }

    public function getById($id)
    {
        $result = parent::getById($id);

        if (count($result) == 1)
        {
            $news = new News($result[0]->newsId, $result[0]->districtSectionId, $result[0]->userId, $result[0]->title, $result[0]->content, $result[0]->date, $result[0]->hidden);
        }

        return $news;
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

    public function update($object)
    {
        $query = 'UPDATE ' . $this->tableName . ' SET districtSectionId = :districtSectionId, userId = :userId, title = :title, content = :content, date = :date, hidden= :hidden
        WHERE ' . $this->tableName .'Id = :' . $this->tableName .'Id';

        $parameters = array(
            ':newsId' => $object->getId(),
            ':districtSectionId' => $object->getDistrictSectionId(),
            ':userId' => $object->getUserId(),
            ':title' => $object->getTitle(),
            ':content' => $object->getContent(),
            ':date' => $object->getDate(),
            ':hidden' => $object->getHidden()
        );

        $this->db->execQuery($query, $parameters);
    }
}