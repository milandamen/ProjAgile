<?php
require_once 'repositoryBase.php';
class FooterRepository extends RepositoryBase
{

    private $name = 'footer';

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
        $footerArray = array();

        #convert result objects to footer objects
        foreach($objects as $var)
        {
            $footerArray[] = new Footer($var->col, $var->row, $var->text, $var->link);
        }
        return $footerArray;
    }

    public function add($object)
    {
        $query = 'INSERT INTO ' . $this->name . '(col, row, text, link) VALUES(:col, :row, :text, :link)';

        $parameters = array(
            ':col' => $object->getCol(),
            ':row' => $object->getRow(),
            ':text' => $object->getText(),
            ':link' => $object->getLink()
        );

        $this->db->execQuery($query, $parameters);
    }

    public function update($object)
    {
        $query = 'UPDATE ' . $this->tableName . ' SET text = :text, link = :link
        WHERE col = :col AND row = :row';

        $parameters = array(
            ':col' => $object->getCol(),
            ':row' => $object->getRow(),
            ':text' => $object->getText(),
            ':link' => $object->getLink()
        );

        $this->db->execQuery($query, $parameters);
    }

    public function remove($object)
    {
        $query = 'DELETE FROM ' . $this->tableName . 'WHERE col = :col AND row = :row';

        $parameters = array(
            ':col' => $object->getCol(),
            ':row' => $object->getRow()
        );

        $this->db->execQuery($query, $parameters);
    }
}