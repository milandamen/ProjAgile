<?php
class FooterController extends Shared
{
    public function footerUpdate()
    {
        //require db, create it and get the footer
        require_once "../app/repository/footerRepository.php";
        require_once '../app/model/Footer.php';
        $footerdb = new FooterRepository();
        $footer = $footerdb->getAll();
        if($_POST)
        {
            //create new footer array from $_POST
            $newFooter = [];
            for($colN = 0; $colN < count($_POST['footer']); $colN++)
            {
                $column = $_POST['footer'][$colN];
                for($rowN = 0; $rowN < count($column['text']); $rowN++)
                {
                    //check if text has been filled in
                    if($column['text'][$rowN] != null)
                    {
                        $newFooter[] = new Footer($colN, $rowN, filter_var($column['text'][$rowN], FILTER_SANITIZE_STRING), filter_var($column['link'][$rowN], FILTER_SANITIZE_STRING));
                    }
                    else
                    {
                        echo "Vul a.u.b. alle verplichte velden in";
                        return;
                    }
                }
            }

            //loop through new entries, adding or updating them
            foreach($newFooter as $entry)
            {
                //loop through old footer
                $isNew = 1;
                foreach($footer as $item)
                {
                    if($item->getCol() == $entry->getCol() && $item->getRow() == $entry->getRow())
                    {
                        $isNew = 0;
                        break;
                    }
                }
                if($isNew == 1)
                {
                    $footerdb->add($entry);
                }
                else
                {
                    $footerdb->update($entry);
                }
            }

            //delete removed items
            foreach($footer as $item)
            {
                $canDelete = 1;
                foreach($newFooter as $entry)
                {
                    if($item->getCol() == $entry->getCol() && $item->getRow() == $entry->getRow())
                    {
                        $canDelete = 0;
                        break;
                    }
                }
                if($canDelete == 1)
                {
                    $footerdb->remove($item);
                }
            }
            header("Location: ../../public");
            return;
        }
        else
        {
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
            $this->footer();
        }
    }
}