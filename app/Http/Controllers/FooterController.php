<?php namespace App\Http\Controllers;

use App\Models\Footer;
use App\Repositories\RepositoryInterfaces\IMenuRepository;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\RepositoryInterfaces\IFooterRepository;
use Input;
use Auth;

class FooterController extends Controller
{

    public function __construct(IFooterRepository $footerRepository, IMenuRepository $menuRepository)
    {
        $this->footerRepository = $footerRepository;
        $this->menuRepository = $menuRepository;
    }

    public function edit()
    {
        if (Auth::check() && Auth::user()->usergroup->name === 'Administrator')
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

            return view('footer/edit', array('footer' => $footerColumns));
        }
        else
        {
            return view('errors.401');
        }

    }

    public function postEdit()
    {
        if (Auth::check() && Auth::user()->usergroup->name === 'Administrator')
        {
            $footer = $this->footerRepository->getAll();
            $maxCols = 3;

            if(count($_POST['footer']) > 0)
            {
                //create new footer array from $_POST
                $newFooter = [];

                for($colN = 0; $colN < $maxCols; $colN++)
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
                            //check if text or link have changed, if not do nothing, else update item
                            if($item->text != $entry->text || $item->link != $entry->link)
                            {
                                $item->text = $entry->text;
                                $item->link = $entry->link;
                                $this->footerRepository->update($item);
                            }

                            $isNew = 0;
                            break;
                        }
                    }

                    if($isNew == 1)
                    {
                        //create
                        $this->footerRepository->update($entry);
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
                        $this->footerRepository->destroy($item->footerId);
                    }
                }
            }
            else
            {
                //if footer is not set (everything is removed) delete all items
                foreach($footer as $item)
                {
                    $this->footerRepository->destroy($item->footerId);
                }
            }

            return Redirect::action('FooterController@edit');
        }
        else
        {
            return view('errors.401');
        }

    }
}