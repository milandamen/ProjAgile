<?php
require_once 'repositoryBase.php';
class CarouselRepository extends RepositoryBase
{

    private $name = 'carousel';

    public function __construct()
    {
        #call to base constructor
        parent::__construct();
        $this->tableName = $this->name;
    }
	
	public function getAll() {
		$query = 	'SELECT c.carouselId AS carouselId, c.newsId AS newsId, c.imgpath AS imgpath, n.title AS title' +
					'FROM carousel AS c' + 
					'LEFT JOIN news AS n' +
						'ON c.newsId = n.newsId';
		$result = $this->db->getQuery($query);
		return $result;
	}
	
	// File upload
    public function add($path)
    {
        $query = 'INSERT INTO ' . $this->name . '(carouselId, path) VALUES(:carouselId, :path)';
        $parameters = array(':carouselId' => null, ':path' => $path);

        $this->db->execQuery($query, $parameters);
    }

}