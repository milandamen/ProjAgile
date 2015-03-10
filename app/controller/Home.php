<?php
/**
 * Created by PhpStorm.
 * User: SysAdmin
 * Date: 3/2/2015
 * Time: 8:00 PM
 */

class Home extends Shared
{
    public function index()
    {
        $this->header('Home');
        $this->menu();

        $this->view('home/index');

        $this->footer();
    }

    public function indextest($name = '')
    {
        $this->header('indextest');
        $this->menu();

        $user = $this->model('UserTest');
        $user->name = $name;

        $this->view('home/indextest', ['name' => $user->name]);

        $this->footer();
    }

    public function error()
    {
        $this->header('Home');
        $this->menu();

        $this->view('home/error');

        $this->footer();
    }

}