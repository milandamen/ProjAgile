<?php
/**
 * Created by PhpStorm.
 * User: SysAdmin
 * Date: 3/2/2015
 * Time: 7:58 PM
 */

class Controller
{
    protected function model($model)
    {
        require_once '../app/model/' . $model . '.php';
        return new $model();
    }

    protected function view($view, $data = [])
    {
        require_once '../app/view/' . $view . '.php';
    }
}