<?php

require_once 'AuthenticationController.php';

class CarouselController extends Shared
{

    public function __construct(){
        parent::__construct();
    }

    public function updateCarousel(){
        $this->header('CarouselEdit');
        $this->menu();
        $data = [];
        $this->view('carousel/updateCarousel', $data);
        $this->footer();
    }

}