<?php

class Cms extends Shared
{
    public function createNews()
    {
        require_once '../app/repository/districtsectionRepository.php';

        $districtdb = new DistrictSectionRepository();

        $this->header('Nieuw artikel');
        $this->menu();
        $this->view('cms/createNews', $districtdb->getAll());
        $this->footer();
    }

    public function createNewsSave()
    {
        require_once '../app/repository/newsRepository.php';
        require_once '../app/model/News.php';

        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
        $hidden = $_POST['hidden'];
        $districtsectionId = filter_var($_POST['district'], FILTER_VALIDATE_INT);

        if($hidden === true)
        {
            $hidden = 1;
        }
        else
        {
            $hidden = 0;
        }

        $news = new News(4, $districtsectionId, 1, $title, $content, new DateTime(), $hidden);
        $newsrepo = new NewsRepository();
        $newsrepo->add($news);

        $this->header('Home');
        $this->menu();
        $this->view('home/index');
        $this->footer();
    }

}