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

    private $name = 'menu';

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
            $pagesArray[] = new Page($var->menuId, $var->parentId, $var->name, $var->relativeUrl, $var->menuOrder, $var->publish);
        }
        return $pagesArray;
    }

    public function getById($id)
    {
        $result = parent::getById($id);

        if (count($result) == 1)
        {
            $pages = new Page($result[0]->menuId, $result[0]->parentId, $result[0]->name, $result[0]->relativeUrl, $result[0]->menuOrder, $result[0]->publish);
        }

        return $pages;
    }
/*
    public function move($title, $upOrDown = "up")
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
*/
    public function update($object)
    {
        $query = 'UPDATE ' . $this->tableName . ' SET menuId = :menuId, parentId = :parentId, name = :name, relativeUrl = :relativeUrl, menuOrder = :menuOrder, publish =:publish
        WHERE id = :id';

        $parameters = array(
            ':menuId' => $object->getMenuId(),
            ':parentId' => $object->getParentId(),
            ':name' => $object->getName(),
            ':relativeUrl' => $object->getRelativeUrl(),
            ':menuOrder' => $object->getMenuOrder(),
            ':publish'=> $object-> getPublish()
        );

        $this->db->execQuery($query, $parameters);
    }

    public function setParentPage($parentId, $menuId)
    {
        $child = $this->getById($menuId);
        $parent = $this->getById($parentId);

        if($child != null && $parent != null)
        {
            $child->setMenuParent($parentId);
            $this->update($child);
            return true;
        }

        return false;
    }

    public function removeParentPage($menuId)
    {
        $child = $this->getById($menuId);

        if($child != null)
        {
            $child->setMenuParent(0);
            $this->update($child);
            return true;
        }

        return false;
    }

    public function removeFromMenu($menuId)
    {
        parent::delete($menuId);
    }

    public function addToMenu($menuId)
    {
        $query = ' SELECT * FROM ' . $this->name . ' WHERE parentId IS NULL ORDER BY menuorder DESC LIMIT 1';
        $pageWithHighestMenuOrder = $this->db->getQuery($query);
        $menuOrder = 0;

        if($pageWithHighestMenuOrder != null)
        {
            $menuOrder = $pageWithHighestMenuOrder->getNrInMenu() + 1;
        }

        $menu = $this->getById($menuId);
        if($menu != null )
        {
            $menu->setMenuOrder($menuOrder);
            $this->update($menu);
            return true;
        }
        else
        {
            return false;
        }
    }

    public function changeMenuTitle($menuId, $newMenuTitle)
    {
        $page = $this->getById($menuId);

        if($page != null)
        {
            $page->setTitle($newMenuTitle);
            $this->update($page);
        }
    }

    public function changePageFileName($menuId, $newPageFileName)
    {
        $page = $this->getById($menuId);

        if($page != null)
        {
            $page->setFileName($newPageFileName);
            $this->update($page);
        }
    }
}