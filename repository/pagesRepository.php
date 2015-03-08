<?php
/**
 * Created by PhpStorm.
 * User: Ron
 * Date: 5-3-2015
 * Time: 21:35
 */
require_once 'repositoryBase.php';
class pagesRepository extends RepositoryBase
{

    private $name = 'pages';

    public function __construct()
    {
        #call to base constructor
        parent::__construct();
        $this->tableName = $this->name;
    }

    public function getAll()
    {
        #call to base method getAll
        $objects = parent::getAll();
        $pagesArray = array();

        #convert result objects to news objects
        foreach($objects as $var)
        {
            $pagesArray[] = new Page($var->id, $var->title, $var->filename, $var->nrInMenu, $var->menuParent, $var->nrInFooter);
        }
        return $pagesArray;
    }

    public function getById($id)
    {
        $result = parent::getById($id);

        if (count($result) == 1)
        {
            $pages = new Page($result[0]->id, $result[0]->title, $result[0]->filename, $result[0]->nrInMenu, $result[0]->menuParent, $result[0]->nrInFooter);
        }

        return $pages;
    }

    public function move($title, $menuOrFooter = "menu", $upOrDown = "up")
    {
        $query = ' SELECT * FROM ' . $this->name . ' WHERE title = :title LIMIT 1';
        $parameters = array ( ':title' => $title);

        $result = $this->db->getQuery($query, $parameters);

        if(count($result) == 1)
        {
            $page = new Page($result[0]->id, $result[0]->title, $result[0]->filename, $result[0]->nrInMenu, $result[0]->menuParent, $result[0]->nrInFooter);

            $query;
            $parameters;
            if($upOrDown == "up" && $menuOrFooter == "menu")
            {
                $query = ' SELECT * FROM ' . $this->name . ' WHERE nrInMenu = :nrInMenuPageAbove LIMIT 1';
                $parameters = array(':nrInMenuPageAbove' => $page->getNrInMenu() - 1);
            }
            elseif($upOrDown == "down" && $menuOrFooter == "menu")
            {
                $query = ' SELECT * FROM ' . $this->name . ' WHERE nrInMenu = :nrInMenuPageBelow LIMIT 1';
                $parameters = array(':nrInMenuPageBelow' => $page->getNrInMenu() + 1);
            }
            elseif($upOrDown == "up" && $menuOrFooter == "footer")
            {
                $query = ' SELECT * FROM ' . $this->name . ' WHERE nrInFooter = :nrInFooterPageAbove LIMIT 1';
                $parameters = array(':nrInFooterPageAbove' => $page->getNrInFooter() - 1);
            }
            elseif($upOrDown == "down" && $menuOrFooter == "footer")
            {
                $query = ' SELECT * FROM ' . $this->name . ' WHERE nrInFooter = :nrInFooterPageBelow LIMIT 1';
                $parameters = array(':nrInFooterPageBelow' => $page->getNrInFooter() + 1);
            }

            $result = $this->db->getQuery($query,$parameters);

            if(count($result == 1))
            {
                $pageAbove = new Page($result[0]->id, $result[0]->title, $result[0]->filename, $result[0]->nrInMenu, $result[0]->menuParent, $result[0]->nrInFooter);

                if($upOrDown == "up" && $menuOrFooter == "menu")
                {
                    $page->setNrInMenu($page->getNrInMenu() -1);
                    $pageAbove->setNrInMenu($pageAbove->getNrInMenu() +1);
                }
                elseif($upOrDown == "down" && $menuOrFooter == "menu")
                {
                    $page->setNrInMenu($page->getNrInMenu() +1);
                    $pageAbove->setNrInMenu($pageAbove->getNrInMenu() -1);
                }
                elseif($upOrDown == "up" && $menuOrFooter == "footer")
                {
                    $page->setNrInFooter($page->getNrInFooter() -1);
                    $pageAbove->setNrInFooter($pageAbove->getNrInFooter() +1);
                }
                elseif($upOrDown == "down" && $menuOrFooter == "footer")
                {
                    $page->setNrInFooter($page->getNrInFooter() +1);
                    $pageAbove->setNrInFooter($pageAbove->getNrInFooter() -1);
                }

                $this->update($page);
                $this->update($pageAbove);
                return true;
            }
        }
        return false;
    }

    public function update($object)
    {
        //$query = 'UPDATE ' . $this->tableName . ' SET id = :id, title = :title, filename = :filename, nrInMenu = :nrInMenu, nrInFooter = :nrInFooter
        //WHERE ' . $this->tableName .'id = :' . $this->tableName .'id';

        $query = 'UPDATE ' . $this->tableName . ' SET id = :id, title = :title, filename = :filename, nrInMenu = :nrInMenu, menuParent = :menuParent, nrInFooter = :nrInFooter
        WHERE id = :id';

        $parameters = array(
            ':id' => $object->getId(),
            ':title' => $object->getTitle(),
            ':filename' => $object->getFilename(),
            ':nrInMenu' => $object->getNrInMenu(),
            ':menuParent' => $object->getMenuParent(),
            ':nrInFooter' => $object->getNrInFooter()
        );

        $this->db->execQuery($query, $parameters);
    }

    public function setParentPage($parentID, $childID)
    {
        $child = $this->getById($childID);
        $parent = $this->getById($parentID);

        if($child != null && $parent != null)
        {
            $child->setMenuParent($parentID);
            $this->update($child);
            return true;
        }

        return false;
    }

    public function removeParentPage($childID)
    {
        $child = $this->getById($childID);

        if($child != null)
        {
            $child->setMenuParent(0);
            $this->update($child);
            return true;
        }

        return false;
    }

    public function removeFromMenu($pageID)
    {
        $page = $this->getById($pageID);

        if($page != null)
        {
            $page->setNrInMenu(0);
            $this->update($page);
        }
    }

    public function removeFromFooter($pageID)
    {
        $page = $this->getById($pageID);

        if($page != null)
        {
            $page->setNrInFooter(0);
            $this->update($page);
        }
    }

    public function RemoveFromMenuAndFooter($pageID)
    {
        $this->removeFromMenu($pageID);
        $this->removeFromFooter($pageID);
    }

    public function addToMenu($pageID)
    {
        $query = ' SELECT * FROM ' . $this->name . ' ORDER BY nrInMenu DESC LIMIT 1';
        $pageWithHighestMenuNr = $this->db->getQuery($query);
        $menuNr = 0;

        if($pageWithHighestMenuNr != null)
        {
            $menuNr = $pageWithHighestMenuNr->getNrInMenu() + 1;
        }

        $page = $this->getById($pageID);
        if($page != null && $menuNr != 0)
        {
            $page->setNrInMenu($menuNr);
            $this->update($page);
            return true;
        }
        else
        {
            return false;
        }
    }

    public function addToFooter($pageID)
    {
        $query = ' SELECT * FROM ' . $this->name . ' ORDER BY nrInFooter DESC LIMIT 1';
        $pageWithHighestFooterNr = $this->db->getQuery($query);
        $footerNr = 0;

        if($pageWithHighestFooterNr != null)
        {
            $footerNr = $pageWithHighestFooterNr->getNrInFooter() + 1;
        }

        $page = $this->getById($pageID);
        if($page != null && $footerNr != 0)
        {
            $page->setNrInFooter($footerNr);
            $this->update($page);
            return true;
        }
        else
        {
            return false;
        }
    }

    public function changePageTitle($pageID, $newPageTitle)
    {
        $page = $this->getById($pageID);

        if($page != null)
        {
            $page->setTitle($newPageTitle);
            $this->update($page);
        }
    }

    public function changePageFileName($pageID, $newPageFileName)
    {
        $page = $this->getById($pageID);

        if($page != null)
        {
            $page->setFileName($newPageFileName);
            $this->update($page);
        }
    }
}