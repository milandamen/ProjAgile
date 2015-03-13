<?php 
	
require_once 'AuthenticationController.php';


class NewsController extends Shared
{
	private $newsRepository;
    private $districtRepository;
    private $fileRepository;

	public function __construct(){
		parent::__construct();
		require_once '../app/repository/newsRepository.php';
        require_once '../app/repository/districtsectionRepository.php';
        require_once '../app/repository/fileRepository.php';
		$this->newsRepository = new NewsRepository();
        $this->districtRepository = new DistrictSectionRepository();
        $this->fileRepository = new FileRepository();
	}

    public function show($id)
    {
        $this->header('Nieuws | ' . $this->newsRepository->getById($id)->getTitle());
        $this->menu();
<<<<<<< HEAD

        $data = array('news' => $this->newsRepository->getById($id), 'files' => $this->fileRepository->getAllByNewsId($id));
        $this->view('news/show', $data);

        $this->footer();
    }

    public function create()
    {
        $this->header('Nieuw artikel');
        $this->menu();
        $this->view('news/create', $this->districtRepository->getAll());
        $this->footer();
    }

    public function edit($newsId)
    {
        $this->header('Wijzig artikel');
        $this->menu();
        $this->view('news/edit', array('news' => $this->newsRepository->getById($newsId), 'sections' => $this->districtRepository->getAll(), 'files' => $this->fileRepository->getAllByNewsId($newsId)));
        $this->footer();
    }

    public function save($create)
    {
        require_once '../app/model/News.php';

        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
        $hidden = filter_var($_POST['hidden'], FILTER_VALIDATE_BOOLEAN);
        $districtsectionId = filter_var($_POST['district'], FILTER_VALIDATE_INT);
        $create = filter_var($create, FILTER_VALIDATE_BOOLEAN);

        if($districtsectionId === 0)
        {
            $districtsectionId = null;
        }

        //files worden geupload
        session_start();
        $target = '../public/uploads/';
        $filepaths = array();
        $count = 0;
        foreach($_FILES['file']['name'] as $filename)
        {
            //als er geen bestand wordt gekozen dan krijg je altijd een '' string mee vandaar de !empty check
            if(!empty($filename))
            {
                $tmp = $_FILES['file']['tmp_name'][$count];
                $count=$count + 1;
                $target = $target.basename($filename);
                $filepaths[] = $filename;
                move_uploaded_file($tmp,$target);
            }
        }
=======
        $data = array('news' => $this->newsdb->getById($id));
        $this->view('news/show', ['newsdata' => $data, 'logged' => $this->login()]);
        $this->footer();
    }


}
>>>>>>> develop

        if($hidden == true)
        {
            $hidden = 1;
        }
        else
        {
            $hidden = 0;
        }

        $newsId = null;

        //als een artikel wordt gewijzigd dan wordt de newsId en keepfiles opgehaald.
        if($create === false)
        {
            $newsId = filter_var($_POST['newsId'], FILTER_VALIDATE_INT);

            if(isset($_POST['keepFiles']))
            {
                $keepFiles = filter_var($_POST['keepFiles'], FILTER_VALIDATE_BOOLEAN);

                if($keepFiles === false)
                {
                    $this->deleteFile($newsId);
                    $this->fileRepository->deleteAllByNewsId($newsId);
                }
            }

        }

        $news = new News($newsId, $districtsectionId, 1, $title, $content, new DateTime(), $hidden);

        if($create === true)
        {
            //voegt het artikel toe en krijgt een nieuws id terug, om deze aan eventuele bestanden toe te voegen
            //en naar de detail pagina te redirecten.
            $newsId = $this->newsRepository->add($news);
        }
        else
        {
            $this->newsRepository->update($news);
        }

        //files worden toegevoegd aan db en gekoppeld aan nieuws
        foreach($filepaths as $path)
        {
            $this->fileRepository->add($path, $newsId);
        }

        $this->show($newsId);
    }

    private function deleteFile($newsId)
    {
        $files = $this->fileRepository->getAllByNewsId($newsId);
        $path = '../public/uploads/';

        foreach($files as $file)
        {
            if(!$this->fileRepository->usedByOthers($file->path))
            {
                unlink($path . $file->path);
            }
        }
    }

}
