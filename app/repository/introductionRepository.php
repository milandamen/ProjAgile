<?php
require_once 'repositoryBase.php';
class IntroductionRepository extends RepositoryBase
{
    private $name = 'introduction';

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
        $introArray = array();

        foreach($objects as $var){    
            $introArray[] = new Introduction($var->pageNr, $var->title, $var->text);
        }
        return $introArray;
    }

    public function getById($id){

        $query = 'SELECT * FROM ' . $this->name . ' WHERE pageId = :pageId';
        $parameters = array( ':pageId' => $id);

        $result = $this->db->getQuery($query, $parameters);

        if (count($result) == 1)
        {
            $introduction = new Introduction($result[0]->pageId, $result[0]->text, $result[0]->title);
            return $introduction;
        }
    }

    public function add($object){
		$query = 'INSERT INTO ' . $this->name . '(pageId, title, text) VALUES(:pageId, :title, :text)';

		$parameters = array(
			':pageId' => $object->getPageNr(),
			':title' => $object->getTitle(),
			':text' => $object->getText(),
		);

		$this->db->execQuery($query, $parameters);

    }

    public function update($object){
		$query = 'UPDATE ' . $this->tableName . ' SET pageId = :pageId, title = :title, text = :text
        WHERE pageId = :pageId';

		$parameters = array(
			':pageId' => $object->getPageNr(),
			':title' => $object->getTitle(),
			':text' => $object->getText()
		);

		$this->db->execQuery($query, $parameters);

    }

    public function delete($object){
    	$query = 'DELETE FROM ' . $this->tableName . ' WHERE pageId = :pageId';

        $parameters = array(
            ':pageId' => $object->getPageNr(),
        );

        $this->db->execQuery($query, $parameters);
    }



    
}