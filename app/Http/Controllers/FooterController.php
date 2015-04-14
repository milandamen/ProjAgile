<?php namespace App\Http\Controllers;

use App\Models\Footer;
use App\Models\Menu;
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
            echo 'U moet ingelogd zijn.';
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
            echo 'U moet ingelogd zijn als admin om de footer te wijzigen.';
        }

    }

    public function autocomplete()
    {
        //prevent direct access (check if ajax request)
        $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
        if(!$isAjax) {
            $user_error = 'Access denied - not an AJAX request...';
            trigger_error($user_error, E_USER_ERROR);
        }

        //get what user typed in autocomplete input
        $term = trim(Input::get('term'));

        $a_json = array();
        $a_json_row = array();

        // replace multiple spaces with one
        $term = preg_replace('/\s+/', ' ', $term);

        $items = Menu::where('name', 'LIKE', '%' . $term . '%')->get();

        foreach($items as $item)
        {
            $a_json_row["label"] = $item->name;
            $a_json_row["value"] = $item->relativeUrl;
            array_push($a_json, $a_json_row);
        }

        $json = json_encode($a_json);
        print $json;
    }
}