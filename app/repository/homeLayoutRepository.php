<?php
require_once 'repositoryBase.php';
require_once '../app/model/HomeLayoutModule.php';

class HomeLayoutRepository extends RepositoryBase
{

    private $name = 'homelayout';

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
        $modules = array();

        #convert result objects to news objects
        foreach($objects as $var)
        {
            $modules[$var->ordernumber] = new HomeLayoutModule($var->modulename, $var->ordernumber);	
        }

        return $modules;
    }
	
	public function update($object)
    {
		$query = 'UPDATE ' . $this->tableName . ' SET ordernumber = :ordernumber 
        WHERE modulename = :modulename';

        $parameters = array(
            ':modulename' => $object->getModulename(),
            ':ordernumber' => $object->getOrdernumber()
        );

        $this->db->execQuery($query, $parameters);
    }
	
}