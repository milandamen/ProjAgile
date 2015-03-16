<?php

require_once 'AuthenticationController.php';

class CarouselController extends Shared
{

    public function updateCarousel(){
        $this->header('Carouseledit');
        $this->menu();
        $data = [];
        $this->view('carousel/updateCarousel', $data);
        $this->footer();
    }

}