<?php
require_once 'repositoryBase.php';
require_once '../app/model/CarouselItem.php';

class CarouselRepository extends RepositoryBase
{

    private $name = 'carousel';

    public function __construct()
    {
        #call to base constructor
        parent::__construct();
        $this->tableName = $this->name;
    }
	
	// Get whole carousel
	public function getAll() {
		$query = 'SELECT c.carouselId AS carouselId, c.newsId AS newsId, c.imgpath AS imgpath, n.title AS title FROM carousel AS c LEFT JOIN news AS n ON c.newsId = n.newsId';
		$result = $this->db->getQuery($query);
		
		$carousel = array();
		foreach ($result as $item) {
			$carousel[] = new CarouselItem($item->carouselId, $item->newsId, $item->imgpath, $item->title);
		}
		
		return $carousel;
	}
	
	/**
		Save whole carousel to database (does not save custom titles).
	*/
	public function saveCarousel($carousel) {
		$query = 'INSERT INTO carousel (newsId, imgpath) VALUES (:newsId, :imgpath)';

		$parameters = array(
			':newsId' => $carousel->getNewsId(),
			':imgpath' => $carousel->getImgpath()
		);

		$this->db->execQuery($query, $parameters);
	}

	public function deleteAll(){
		$query = 'DELETE FROM carousel';
		$this->db->execQuery($query);
	}

	
	// File upload
    public function add($path)
    {
        $query = 'INSERT INTO ' . $this->name . '(carouselId, path) VALUES(:carouselId, :path)';
        $parameters = array(':carouselId' => null, ':path' => $path);

        $this->db->execQuery($query, $parameters);
    }

}