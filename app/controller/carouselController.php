<?php
require_once 'AuthenticationController.php';
class CarouselController extends Shared
{
    public function __construct(){
        parent::__construct();
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

    }
}