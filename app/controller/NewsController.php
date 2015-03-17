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
		require_once '../app/repository/newsRepository.php';
        require_once '../app/repository/districtsectionRepository.php';
        require_once '../app/repository/fileRepository.php';
        $this->setAuth(new AuthenticationController());
		$this->newsRepository = new NewsRepository();
        $this->districtRepository = new DistrictSectionRepository();
        $this->fileRepository = new FileRepository();
	}

    public function show($id)
    {
        $this->header('Nieuws | ' . $this->newsRepository->getById($id)->getTitle());
        $this->menu();
        $data = array('news' => $this->newsRepository->getById($id));
        $this->view('news/show', ['newsdata' => $data, 'files' => $this->fileRepository->getAllByNewsId($id), 'loggedIn' => $this->getAuth()->loggedIn()]);
        $this->footer();
    }

    public function create()
    {
        if($this->getAuth()->loggedIn() && ($_SESSION['userGroupId'] == 1 || $_SESSION['userGroupId'] == 2))
        {
            $this->header('Nieuw artikel');
            $this->menu();
            $this->view('news/create', $this->districtRepository->getAll());
            $this->footer();
        }
    }

    public function edit($newsId)
    {
        if($this->getAuth()->loggedIn() && ($_SESSION['userGroupId'] == 1 || $_SESSION['userGroupId'] == 2))
        {
            $this->header('Wijzig artikel');
            $this->menu();
            $this->view('news/edit', array('news' => $this->newsRepository->getById($newsId), 'sections' => $this->districtRepository->getAll(), 'files' => $this->fileRepository->getAllByNewsId($newsId)));
            $this->footer();
        }
    }

    public function save($create)
    {
    	if($this->getAuth()->loggedIn() && ($_SESSION['userGroupId'] == 1 || $_SESSION['userGroupId'] == 2))
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

	        #Upload files
	        $target = '../public/uploads/';
	        $temp = '../public/uploads/tijdelijk/';
	        $filepaths = array();
	        $count = 0;
	        foreach($_FILES['file']['name'] as $filename)
	        {
	            #if there are no files selected you will get an empty '' string therefore the !empty check
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
	                #change the name of the file in a temporary folder and move it to the uploads folder
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

	        #if a news item is edited then the newsId and keepfiles will ve requested
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
	            #Adds the news item and gets the id of it, to connect it to uploaded files
	            #and redirects to show
	            $newsId = $this->newsRepository->add($news);
	        }
	        else
	        {
	            $this->newsRepository->update($news);
	        }

	        #files are being added to the db and connected to the news item
	        foreach($filepaths as $path)
	        {
	            $this->fileRepository->add($path, $newsId);
	        }

	        $this->show($newsId);

    	} else {
    		global $Base_URI;
				header('Location: ' . $Base_URI . 'Shared/noPermission');
    	}
    }

    private function deleteFile($newsId)
    {
        $files = $this->fileRepository->getAllByNewsId($newsId);
        $path = '../public/uploads/';

        foreach($files as $file)
        {
            unlink($path . $file->path);
        }

        #delete also from db
        $this->fileRepository->deleteAllByNewsId($newsId);
    }

}
