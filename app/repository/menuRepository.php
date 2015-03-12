<?php
/**
 * Created by PhpStorm.
 * User: Ron
 * Date: 5-3-2015
 * Time: 21:35
 */
require_once 'repositoryBase.php';
require_once '../app/model/Menu.php';
class menuRepository extends RepositoryBase
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
        $MenuItemsArray = array();

        #convert result objects to news objects
        foreach($objects as $var)
        {
            $MenuItemsArray[] = new Menu($var->menuId, $var->parentId, $var->name, $var->relativeUrl, $var->menuOrder, $var->publish);
        }
        return $MenuItemsArray;
    }

    public function getAllPublic()
    {
        #call to base method getAll
        $query = ' SELECT * FROM ' . $this->name . ' WHERE publish = 1';
        $menuItemsResult = $this->db->getQuery($query);

        $MenuItemsArray = array();

        #convert result objects to news objects
        foreach($menuItemsResult as $var)
        {
            $MenuItemsArray[] = new Menu($var->menuId, $var->parentId, $var->name, $var->relativeUrl, $var->menuOrder, $var->publish);
        }
        return $MenuItemsArray;
    }


    public function getById($id)
    {
        $result = parent::getById($id);

        if (count($result) == 1)
        {
            $MenuItems = new Menu($result[0]->menuId, $result[0]->parentId, $result[0]->name, $result[0]->relativeUrl, $result[0]->menuOrder, $result[0]->publish);
        }

        return $MenuItems;
    }

    public function move($menuId, $upOrDown = "up")
    {
        $query = ' SELECT * FROM ' . $this->name . ' WHERE menuId = :menuId';
        $parameters = array (':menuId' => $menuId);
        $result = $this->db->getQuery($query, $parameters);
        $menuItem = new Menu($result[0]->menuId, $result[0]->parentId, $result[0]->name, $result[0]->relativeUrl, $result[0]->menuOrder, $result[0]->publish);

        $menuOrder = $menuItem->getMenuOrder();
        $parentId = $menuItem->getParentId();


        if($upOrDown == "down")
        {
            $query = ' SELECT * FROM ' . $this->name . ' WHERE parentId = :parentId AND menuOrder = :menuOrder ';
            $parameters = array(':parentId' => $parentId, ':menuOrder' => $menuOrder + 1);
            $result = $this->db->getQuery($query, $parameters);
            $child = new Menu($result[0]->menuId, $result[0]->parentId, $result[0]->name, $result[0]->relativeUrl, $result[0]->menuOrder, $result[0]->publish);

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
            $child = new Menu($result[0]->menuId, $result[0]->parentId, $result[0]->name, $result[0]->relativeUrl, $result[0]->menuOrder, $result[0]->publish);

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

    public function setParentMenuItem($parentId, $menuId)
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

    public function removeParentMenuItem($menuId)
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
        $MenuItemWithHighestMenuOrder = $this->db->getQuery($query);
        $menuOrder = 0;

        if($MenuItemWithHighestMenuOrder != null)
        {
            $menuOrder = $MenuItemWithHighestMenuOrder->getNrInMenu() + 1;
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
        $MenuItem = $this->getById($menuId);

        if($MenuItem != null)
        {
            $MenuItem->setTitle($newMenuTitle);
            $this->update($MenuItem);
        }
    }

    public function changeMenuItemFileName($menuId, $newMenuItemFileName)
    {
        $MenuItem = $this->getById($menuId);

        if($MenuItem != null)
        {
            $MenuItem->setFileName($newMenuItemFileName);
            $this->update($MenuItem);
        }
    }
}