<?php namespace App\Http\Controllers;

use App\Models\Footer;
use App\Repository\FooterRepository;
use Illuminate\Support\Facades\Redirect;

class FooterController extends Controller
{

    public function __construct(FooterRepository $footerRepository)
    {
        $this->footerRepository = $footerRepository;
    }

    public function getEdit()
    {
        $footer = $this->footerRepository->getAll();

        $numColumns = 0;
        foreach($footer as $item)
        {
            if($item->col >= $numColumns)
            {
                $numColumns = $item->col + 1;
            }
        }

        $footerColumns = [];

        for($i = 0; $i < $numColumns; $i++)
        {
            $footerColumns[] = [];
        }
        foreach($footer as $item)
        {
            $footerColumns[$item->col][$item->row] = $item;
        }

        return view('footer/edit', $footerColumns);
    }

    public function postEdit()
    {
        $footer = $this->footerRepository->getAll();

        if(isset($_POST['footer']))
        {
            //create new footer array from $_POST
            $newFooter = [];

            for($colN = 0; $colN < count($_POST['footer']); $colN++)
            {
                if(isset($_POST['footer'][$colN])) {

                    $column = $_POST['footer'][$colN];

                    for ($rowN = 0; $rowN < count($column['text']); $rowN++) {
                        //check if text has been filled in
                        if ($column['text'][$rowN] != null) {
                            $newFooterItem = new Footer();
                            $newFooterItem->col = $colN;
                            $newFooterItem->row = $rowN;
                            $newFooterItem->text = filter_var($column['text'][$rowN], FILTER_SANITIZE_STRING);
                            $newFooterItem->link = filter_var($column['link'][$rowN], FILTER_SANITIZE_STRING);
                            $newFooter[] = $newFooterItem;
                        } else {
                            echo "Vul a.u.b. alle verplichte velden in";
                            return;
                        }
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
                    if($item->col == $entry->col && $item->row == $entry->row)
                    {
                        //check if text or link have changed, if not do nothing else update it!
                        $isNew = 0;
                        break;
                    }
                }

                if($isNew == 1)
                {
                    //create
                    $this->footerRepository->save($entry);
                }

            }

            //delete removed items
            foreach($footer as $item)
            {
                $canDelete = 1;
                foreach($newFooter as $entry)
                {
                    //if the item from the db matches the item in new footer do not delete it
                    if($item->col == $entry->col && $item->row == $entry->row)
                    {
                        $canDelete = 0;
                        break;
                    }
                }
                if($canDelete == 1)
                {
                    $this->footerRepository->delete($item);
                }
            }
        }
        else
        {
            //if footer is not set (everything is removed) delete all items
            foreach($footer as $item)
            {
                $this->footerRepository->delete($item);
            }
        }

        return Redirect::action('FooterController@getEdit');
    }

    public function footerUpdate()
    {
        if($this->getAuth()->loggedIn() && $_SESSION['userGroupId'] == 1){
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
                global $Base_URI;
                header('Location: ' . $Base_URI);
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
        }  else {
            global $Base_URI;
            header('Location: ' . $Base_URI . 'Shared/noPermission');
        }
    }
}