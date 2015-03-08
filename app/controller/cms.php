<?php

class Cms extends Shared
{
    public function createNews()
    {
        $this->header('Home');
        $this->menu();

        $this->view('cms/createNews');

        $this->footer();
    }

}