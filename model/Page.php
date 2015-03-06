<?php
/**
 * Created by PhpStorm.
 * User: Ron
 * Date: 5-3-2015
 * Time: 21:44
 */

class Page
{
    private $id;
    private $title;
    private $filename;
    private $nrInMenu;
    private $nrInFooter;

    public function __construct($id, $title, $filename, $nrInMenu, $nrInFooter)
    {
        $this->id = $id;
        $this->$title = $title;
        $this->$filename = $filename;
        $this->$nrInMenu = $nrInMenu;
        $this->$nrInFooter = $nrInFooter;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function getNrInMenu()
    {
        return $this->nrInMenu;
    }

    public function getNrInFooter()
    {
        return $this->nrInFooter;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setFileName($filename)
    {
        $this->filename = $filename;
    }

    public function setNrInMenu($nrInMenu)
    {
        $this->nrInMenu = $nrInMenu;
    }

    public function setNrInFooter($nrInFooter)
    {
        $this->nrInFooter = $nrInFooter;
    }
}
?>