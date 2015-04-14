<?php namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Routing\Controller;
use Input;

class AutocompleteController extends Controller
{
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