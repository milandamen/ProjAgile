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
            if($var->hidden == 0)
            {
                $hidden = false;
            }
            else
            {
                $hidden = true;
            }
            $newsArray[] = new News($var->newsId, $var->districtSectionId, $var->userId, $var->title, $var->content, $var->date, $hidden);
        }

        foreach($newsArray as $news){
        	$news->setAuthor($this->getAuthor($news->getUserId()));
        	$news->setDistrict($this->getDistrict($news->getDistrictSectionId()));
        }

        return $newsArray;
    }

    public function getById($id)
    {
        $result = parent::getById($id);

        if (count($result) == 1)
        {
            $news = new News($result[0]->newsId, $result[0]->districtSectionId, $result[0]->userId, $result[0]->title, $result[0]->content, $result[0]->date, $result[0]->hidden);
        	$news->setAuthor($this->getAuthor($result[0]->userId));
        	$news->setDistrict($this->getDistrict($result[0]->districtSectionId));
            return $news;
        }

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

        return $this->db->getLastInsertedId();
    }

    public function update($object)
    {
        $query = 'UPDATE ' . $this->tableName . ' SET districtSectionId = :districtSectionId, userId = :userId, title = :title, content = :content, date = NOW(), hidden= :hidden
        WHERE ' . $this->tableName .'Id = :' . $this->tableName .'Id';

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

    private function getAuthor($id){
    	$username='';
    	$query = 'SELECT username FROM user WHERE userId = :userId';
    	$parameters = array( 
    		':userId' => $id,
    	);

    	$result = $this->db->getQuery($query, $parameters);

    	 if (count($result) == 1)
        {
        	$username = $result[0]->username;
        }
    	return $username;
    }

    private function getDistrict($id){
    	$district='';
    	$query = 'SELECT name FROM districtsection WHERE districtSectionId = :districtId';
    	$parameters = array( 
    		':districtId' => $id,
    	);

    	$result = $this->db->getQuery($query, $parameters);

    	 if (count($result) == 1)
        {
        	$district = $result[0]->name;
        }
    	return $district;
    }


	public function getByTitle($term) {
		$term = '%'.$term.'%';
		$query = "SELECT * FROM news WHERE `title` LIKE :term AND `hidden` = 0";
		$parameters = array(
			':term' => $term
		);
		
		$result = $this->db->getQuery($query, $parameters);
		
		return $result;
	}

}

