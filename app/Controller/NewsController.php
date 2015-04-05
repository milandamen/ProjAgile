<?php

require_once 'AuthenticationController.php';
class NewsController extends Shared
{
    private $newsRepository;
    private $districtRepository;
    private $fileRepository;

    private $minRand = 100;
    private $maxRand = 500000;

    public function __construct()
    {
        require_once '../app/Repository/NewsRepository.php';
        require_once '../app/Repository/DistrictsectionRepository.php';
        require_once '../app/Repository/FileRepository.php';
        $this->setAuth(new AuthenticationController());
        $this->newsRepository = new NewsRepository();
        $this->districtRepository = new DistrictSectionRepository();
        $this->fileRepository = new FileRepository();
    }

    public function create()
    {
        if ($this->getAuth()->loggedIn() && ($_SESSION['userGroupId'] == 1 || $_SESSION['userGroupId'] == 2)) {
            $this->header('Nieuw artikel');
            $this->menu();
            $this->view('news/create', $this->districtRepository->getAll());
            $this->footer();
        } else {
            global $Base_URI;
            header('Location: ' . $Base_URI . 'Shared/noPermission');
        }
    }

    public function edit($newsId)
    {
        if ($this->getAuth()->loggedIn() && ($_SESSION['userGroupId'] == 1 || $_SESSION['userGroupId'] == 2)) {
            $this->header('Wijzig artikel');
            $this->menu();
            $this->view('news/edit', array('news' => $this->newsRepository->getById($newsId), 'sections' => $this->districtRepository->getAll(), 'files' => $this->fileRepository->getAllByNewsId($newsId)));
            $this->footer();
        } else {
            global $Base_URI;
            header('Location: ' . $Base_URI . 'Shared/noPermission');
        }
    }
}


