<?php
class FooterController extends Shared
{
    public function footerUpdate()
    {
        require_once "../app/repository/footerRepository.php";
        require_once '../app/model/Footer.php';
        $footerdb = new FooterRepository();
        if($_POST)
        {
            echo "ok!";
            var_dump($_POST);
            return;
        }
        else
        {
            $footer = $footerdb->getAll();
            $numColumns = 0;
            foreach($footer as $item)
            {
                if($item->getCol() >= $numColumns)
                {
                    $numColumns = $item->getCol()+1;
                }
            }
            $footerColumns = [];
            for($i = 0; $i < $numColumns; $i++)
            {
                $footerColumns[] = [];
            }
            foreach($footer as $item)
            {
                $footerColumns[$item->getCol()][] = $item;
            }
            $this->header("Update Footer");
            $this->menu();
            $this->view('footer/footerUpdate', ['footerColumns' => $footerColumns]);
        }
    }
}