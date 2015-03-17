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
        require_once '../app/model/CarouselItem.php';
        $this->setAuth(new AuthenticationController());
        $this->carouselRepository = new CarouselRepository();
    }
	
	public function updateCarousel(){
		// $id, $newsId, $imgpath, $title)

		if($this->getAuth()->loggedIn() && $_SESSION['userGroupId'] == 1){



	        if($_POST){

	        	$this->carouselRepository->deleteAll();
	        	var_dump($_POST);
				
				for ($i = 0; $i < count($_POST['artikel']); $i++) {
					$item = $_POST['artikel'][$i];
					$newsId = $item;
					
					
					//$path = $this->saveFile($i);

	        		$carousel = new CarouselItem(null,$newsId,null,null);

	        		echo 'test 1  <br/>';

	        		$this->carouselRepository->saveCarousel($carousel);


	        		echo 'test 2  <br/>';
	        	}



	        	var_dump($_FILES);


	         } else {
				$this->header('Carouseledit');
				$this->menu();
				$data = $this->carouselRepository->getAll();
				$this->view('carousel/updateCarousel', $data);
				$this->footer();
	    	}
	    } else {
	    	global $Base_URI;
			header('Location: ' . $Base_URI . 'Shared/noPermission');
	    }
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
        $allowed =  array('png' ,'jpg');
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

    }

    private function deleteFile($carouselId)
    {
        $file = $this->carouselRepository->getById($carouselId);
        $path = '../public/uploads/';

        unlink($path . $file[0]->path);

        #delete also from db
        $this->carouselRepository->delete($carouselId);
    }
	
	private function saveFile($count) {
		$target = '../public/uploads/';
        $temp = '../public/uploads/tijdelijk/';
        $filepath = '';
        $allowed =  array('png' ,'jpg');
		
		$filename = $file['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		
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
			$filepath = $nameToCheck;
			move_uploaded_file($tmp,$temp);
			#change the name of the file in a temporary folder and move it to the uploads folder
			rename($temp, $target . $nameToCheck);
		}
		
		return $filepath;
	}
	
	public function testRepo() {
		$carousel = $this->carouselRepository->getAll();
		var_dump($carousel);
	}
	
}