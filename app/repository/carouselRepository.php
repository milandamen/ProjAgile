<?php
require_once 'repositoryBase.php';
class CarouselRepository
{

    private $name = 'carousel';

    public function __construct()
    {
        #call to base constructor
        parent::__construct();
        $this->tableName = $this->name;
    }

    public function add($path)
    {
        $query = 'INSERT INTO ' . $this->name . '(carouselId, path) VALUES(:carouselId, :path)';
        $parameters = array(':carouselId' => null, ':path' => $path);

        $this->db->execQuery($query, $parameters);
    }

}