<?php
/**
 * Created by PhpStorm.
 * User: Ron
 * Date: 5-3-2015
 * Time: 21:44
 */

class Page
{
    private $menuId;
    private $parentId;
    private $name;
    private $relativeUrl;
    private $menuOrder;
    private $publish;

    public function __construct($menuId, $parentId, $name, $relativeUrl, $menuOrder,$publish)
    {
        $this->menuId = $menuId;
        $this->parentId = $parentId;
        $this->name = $name;
        $this->relativeUrl = $relativeUrl;
        $this->menuOrder = $menuOrder;
        $this->publish = $publish;
    }

    public function getMenuId()
    {
        return $this->menuId;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getRelativeUrl()
    {
        return $this->relativeUrl;
    }

    public function getMenuOrder()
    {
        return $this->menuOrder;
    }

    public function getPublish()
    {
        return $this->publish;
    }

    public function setMenuId($menuId)
    {
        $this->menuId = $menuId;
    }

    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setMenuOrder($menuOrder)
    {
        $this->menuOrder = $menuOrder;
    }

    public function setPublish($publish)
    {
        $this->publish = $publish;
    }
}
?>