<?php 
	
require_once 'AuthenticationController.php';


class NewsController extends Shared
{
	private $newsdb;

	public function __construct(){
		parent::__construct();
		require_once '../app/repository/newsRepository.php';
		$this->newsdb = new NewsRepository();
	}

    public function show($id)
    {
        $this->header('Nieuws | ' . $this->newsdb->getById($id)->getTitle());
        $this->menu();
        $data = array('news' => $this->newsdb->getById($id));
        $this->view('news/show', ['newsdata' => $data, 'logged' => $this->login()]);
        $this->footer();
    }
	
	public function getArticlesByTitle($term) {
		$data = $this->newsdb->getByTitle($term);
		echo json_encode($data);
	}

}

?>