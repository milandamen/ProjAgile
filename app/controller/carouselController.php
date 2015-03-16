<?php

class CarouselController extends Shared
{

    private $minRand = 1000;
    private $maxRand = 500000;
    private $carouselRepository;

    public function __construct()
    {
        require_once 'AuthenticationController.php';
        require_once '../app/repository/carouselRepository.php';
        $this->setAuth(new AuthenticationController());
        $this->carouselRepository = new CarouselRepository();
    }


    public function DemoView()
    {
        $this->header('carousel upload demo');
        $this->menu();
        $this->view('home/carouselUploadDemo');
        $this->footer();
    }

    public function add()
    {
        $target = '../public/uploads/';
        $temp = '../public/uploads/tijdelijk/';
        $filepaths = array();
        $allowed =  array('pdf','png' ,'jpg');
        $count = 0;

        foreach($_FILES['file']['name'] as $filename)
        {
            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            #if there are no files selected you will get an empty '' string therefore the !empty check
            if(!empty($filename) && in_array($ext, $allowed))
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

        foreach($filepaths as $path)
        {
            $this->carouselRepository->add($path);
        }

        $this->deleteFile(4);

    }

    private function deleteFile($carouselId)
    {
        $file = $this->carouselRepository->getById($carouselId);
        $path = '../public/uploads/';

        unlink($path . $file[0]->path);

        #delete also from db
        $this->carouselRepository->delete($carouselId);
    }
}