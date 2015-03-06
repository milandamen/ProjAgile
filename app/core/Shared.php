<?php
/**
 * Created by PhpStorm.
 * User: SysAdmin
 * Date: 3/2/2015
 * Time: 8:49 PM
 */

class Shared extends Controller
{
    public function header($title)
    {
        $this->view('shared/header', ['title' => $title]);
    }

    public function menu()
    {
        $this->view('shared/menu');
    }

    public function footer()
    {
        $this->view('shared/footer');
    }
}