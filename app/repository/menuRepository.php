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

    public function move($menuId, $upOrDown = "up")
    {
        $query = ' SELECT * FROM ' . $this->name . ' WHERE menuId = :menuId';
        $parameters = array (':menuId' => $menuId);
        $result = $this->db->getQuery($query, $parameters);
        $menuItem = new Page($result[0]->menuId, $result[0]->parentId, $result[0]->name, $result[0]->relativeUrl, $result[0]->menuOrder, $result[0]->publish);

        $menuOrder = $menuItem->getMenuOrder();
        $parentId = $menuItem->getParentId();


        if($upOrDown == "down")
        {
            $query = ' SELECT * FROM ' . $this->name . ' WHERE parentId = :parentId AND menuOrder = :menuOrder ';
            $parameters = array(':parentId' => $parentId, ':menuOrder' => $menuOrder + 1);
            $result = $this->db->getQuery($query, $parameters);
            $child = new Page($result[0]->menuId, $result[0]->parentId, $result[0]->name, $result[0]->relativeUrl, $result[0]->menuOrder, $result[0]->publish);

            $child->setMenuOrder($menuOrder);
            $menuItem->setMenuOrder($menuOrder + 1);
            $this->update($child);
            $this->update($menuItem);
        }
        else
        {
            $query = ' SELECT * FROM ' . $this->name . ' WHERE parentId = :parentId AND menuOrder = :menuOrder ';
            $parameters = array(':parentId' => $parentId, ':menuOrder' => $menuOrder - 1);
            $result = $this->db->getQuery($query, $parameters);
            $child = new Page($result[0]->menuId, $result[0]->parentId, $result[0]->name, $result[0]->relativeUrl, $result[0]->menuOrder, $result[0]->publish);

            $child->setMenuOrder($menuOrder);
            $menuItem->setMenuOrder($menuOrder - 1);
            $this->update($child);
            $this->update($menuItem);

        }
    }

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