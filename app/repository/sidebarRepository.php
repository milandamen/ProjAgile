<?php
require_once 'repositoryBase.php';
class SidebarRepository extends RepositoryBase
{
    private $name = 'sidebar';

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
        $fsidebarArray = array();

        #convert result objects to footer objects
        foreach($objects as $var)
        {
            $sidebarArray[] = new Sidebar($var->pageNr, $var->rowNr, $var->title, $var->text, $var->internlink, $var->externlink);
        }
        return $sidebarArray;
    }

    public function add($object){
		$query = 'INSERT INTO ' . $this->name . '(pageNr, rowNr, title, text, internlink, externlink) VALUES(:pageNr, :rowNr, :title, :text, :in, :out)';

		$parameters = array(
			':pageNr' => $object->getPageNr(),
			':rowNr' => $object->getRowNr(),
			':title' => $object->getTitle(),
			':text' => $object->getText(),
			':in' => $object->getInternLink(),
			':out'=> $object->getExternLink()
		);

	//	$this->db->execQuery($query, $parameters);

		$this->db->execQuery($query, $parameters);

    }

    public function update($object){
		$query = 'UPDATE ' . $this->tableName . ' SET rowNr = :rowNr, title = :title, text = :text, interlink = :in, externlink = :out
        WHERE pageNr = :pageNr AND rowNr = :rowNr';

		$parameters = array(
			':pageNr' => $object->getPageNr(),
			':rowNr' => $object->getRowNr(),
			':title' => $object->getTitle(),
			':text' => $object->getText(),
			':in' => $object->getInternLink(),
			':out'=> $object->getExternLink()
		);

		$this->db->execQuery($query, $parameters);

    }

    public function delete($object){
    	$query = 'DELETE FROM ' . $this->tableName . ' WHERE pageNr = :pageNr AND rowNr = :rowNr';

        $parameters = array(
            ':pageNr' => $object->getPageNr(),
            ':rowNr' => $object->getRowNr()
        );

        $this->db->execQuery($query, $parameters);
    }

    public function deleteAllFromPage($pageNr){
    	$query = 'DELETE FROM ' . $this->tableName . ' WHERE pageNr = :pageNr';

        $parameters = array(
            ':pageNr' => $pageNr
        );

        $this->db->execQuery($query, $parameters);
    }


    
}