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
            $sidebarArray[] = new Sidebar($var->page, $var->title, $var->text, $var->link);
        }
        return $sidebarArray;
    }
}