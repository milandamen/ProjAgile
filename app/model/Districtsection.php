<?php

class Districtsection
{
    private $id;
    private $name;
    private $generalInfo;

    public function __construct($id, $name, $generalInfo)
    {
        $this->id = $id;
        $this->name = $name;
        $this->generalInfo = $generalInfo;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getGeneralInfo()
    {
        return $this->generalInfo;
    }

    public function setGeneralInfo($generalInfo)
    {
        $this->generalInfo = $generalInfo;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}