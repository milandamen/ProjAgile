<?php
require_once 'repositoryBase.php';
class DistrictSectionRepository extends RepositoryBase
{

    private $name = 'districtsection';

    public function __construct()
    {
        #call to base constructor
        parent::__construct();
        $this->tableName = $this->name;
    }

    public function getAll()
    {

        require_once '../app/model/Districtsection.php';

        #call to base method getAll
        $objects = parent::getAll();
        $districtsectionArray = array();

        #convert result objects to news objects
        foreach($objects as $var)
        {
            $districtsectionArray[] = new Districtsection($var->districtSectionId, $var->name, $var->generalInfo);
        }
        return $districtsectionArray;
    }
}