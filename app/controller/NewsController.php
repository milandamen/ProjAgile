<?php 
	
require_once 'AuthenticationController.php';
class NewsController extends Shared
{
	private $newsRepository;
    private $districtRepository;
    private $fileRepository;

    private $minRand = 100;
    private $maxRand = 500000;

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

//        $data = array('news' => $this->newsRepository->getById($id), 'files' => $this->fileRepository->getAllByNewsId($id));
//        $this->view('news/show', $data);
//
//        $this->footer();

        $data = array('news' => $this->newsRepository->getById($id));
        $this->view('news/show', ['newsdata' => $data, 'files' => $this->fileRepository->getAllByNewsId($id), 'logged' => $this->login()]);
        $this->footer();
    }

    public function create()
    {
        if($this->login())
        {
            $this->header('Nieuw artikel');
            $this->menu();
            $this->view('news/create', $this->districtRepository->getAll());
            $this->footer();
        }
    }

    public function edit($newsId)
    {
        if($this->login())
        {
            $this->header('Wijzig artikel');
            $this->menu();
            $this->view('news/edit', array('news' => $this->newsRepository->getById($newsId), 'sections' => $this->districtRepository->getAll(), 'files' => $this->fileRepository->getAllByNewsId($newsId)));
            $this->footer();
        }
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
        $target = '../public/uploads/';
        $temp = '../public/uploads/tijdelijk/';
        $filepaths = array();
        $count = 0;
        foreach($_FILES['file']['name'] as $filename)
        {
            //als er geen bestand wordt gekozen dan krijg je altijd een '' string mee vandaar de !empty check
            if(!empty($filename))
            {
                $tmp = $_FILES['file']['tmp_name'][$count];
                $count = $count + 1;

                $nameToCheck =  rand($this->minRand, $this->maxRand) . 'id' . $filename;

                while(file_exists($target . $nameToCheck))
                {
                    $nameToCheck = rand($this->minRand, $this->maxRand) . 'id' . $filename;
                }

                $temp = $temp.basename($filename);
                $filepaths[] = $nameToCheck;
                move_uploaded_file($tmp,$temp);
                #wijzig de naam van het bestand in de tijdelijke map en verplaats het naar de uploads folder
                rename($temp, $target . $nameToCheck);

            }
        }

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
            unlink($path . $file->path);
        }

        #verwijder ook uit de db
        $this->fileRepository->deleteAllByNewsId($newsId);
    }

}
