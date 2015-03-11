<?php 

class NewsController extends Shared
{
	private $newsdb;

	public function __construct(){
		require_once '../app/repository/newsRepository.php';
        require_once '../app/repository/districtsectionRepository.php';
        require_once '../app/repository/fileRepository.php';
		$this->newsdb = new NewsRepository();
	}

    public function show($id)
    {
        $this->header('Nieuws | ' . $this->newsdb->getById($id)->getTitle());
        $this->menu();


        $data = array('news' => $this->newsdb->getById($id));
        $this->view('news/show', $data);

        $this->footer();
    }

    public function createNews()
    {
        $districtdb = new DistrictSectionRepository();

        $this->header('Nieuw artikel');
        $this->menu();
        $this->view('news/createNews', $districtdb->getAll());
        $this->footer();
    }

    public function edit($newsId)
    {
        $this->header('Wijzig artikel');
        $this->menu();

        $districtdb = new DistrictSectionRepository();
        $filerepo = new FileRepository();

        $this->view('news/editNews', array('news' => $this->newsdb->getById($newsId), 'sections' => $districtdb->getAll(), 'files' => $filerepo->getAllByNewsId($newsId)));
        $this->footer();
    }

    public function createNewsSaveOld()
    {
        require_once '../app/repository/newsRepository.php';
        require_once '../app/repository/fileRepository.php';
        require_once '../app/model/News.php';

        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
        $hidden = $_POST['hidden'];
        $districtsectionId = filter_var($_POST['district'], FILTER_VALIDATE_INT);

        session_start();
        $target = '../public/uploads/';
        $filepaths = array();
        $count = 0;
        foreach($_FILES['file']['name'] as $filename)
        {
            $tmp = $_FILES['file']['tmp_name'][$count];
            $count=$count + 1;
            $target = $target.basename($filename);
            $filepaths[] = $filename;
            move_uploaded_file($tmp,$target);
        }

        if($hidden === true)
        {
            $hidden = 1;
        }
        else
        {
            $hidden = 0;
        }

        $news = new News(null, $districtsectionId, 1, $title, $content, new DateTime(), $hidden);
        $newsrepo = new NewsRepository();
        $newsId = $newsrepo->add($news);

        $filerepo = new FileRepository();

        foreach($filepaths as $path)
        {
            $filerepo->add($path, $newsId);
        }

        $this->header('Home');
        $this->menu();
        $this->view('home/index');
        $this->footer();
    }

    public function createNewsSave($create)
    {
        require_once '../app/model/News.php';

        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
        $hidden = $_POST['hidden'];
        $districtsectionId = filter_var($_POST['district'], FILTER_VALIDATE_INT);
        $create = filter_var($create, FILTER_VALIDATE_BOOLEAN);

        //files worden geupload
        session_start();
        $target = '../public/uploads/';
        $filepaths = array();
        $count = 0;
        foreach($_FILES['file']['name'] as $filename)
        {
            $tmp = $_FILES['file']['tmp_name'][$count];
            $count=$count + 1;
            $target = $target.basename($filename);
            $filepaths[] = $filename;
            move_uploaded_file($tmp,$target);
        }

        if($hidden === true)
        {
            $hidden = 1;
        }
        else
        {
            $hidden = 0;
        }

        $filerepo = new FileRepository();

        $newsId = null;

        //als een artikel wordt gewijzigd dan wordt de newsId en keepfiles opgehaald.
        if($create === false)
        {
            $newsId = filter_var($_POST['newsId'], FILTER_VALIDATE_INT);
            $keepFiles = $_POST['keepFiles'];

            if($keepFiles === false)
            {
                $filerepo->deleteAllByNewsId($newsId);
            }
        }

        $news = new News($newsId, $districtsectionId, 1, $title, $content, new DateTime(), $hidden);
        $newsrepo = new NewsRepository();

        if($create === true)
        {
            //voegt het artikel toe en krijgt een nieuws id terug, om deze aan eventuele bestanden toe te voegen
            //en naar de detail pagina te redirecten.
            $newsId = $newsrepo->add($news);
        }
        else
        {
            $newsrepo->update($news);
        }

        //files worden toegevoegd aan db en gekoppeld aan nieuws
        foreach($filepaths as $path)
        {
            if($path !== null)
            {
                $filerepo->add($path, $newsId);
            }
        }

        $this->show($newsId);
    }

}
