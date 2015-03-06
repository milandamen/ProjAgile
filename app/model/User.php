<?php

class User
{
    private $id;
    private $username;
    private $districtSectionId;
    private $userGroupId;
    private $postal;
    private $houseNumber;
    private $password;
    private $name;
    private $surname;
    private $email;
    private $active;

    public function __construct($id, $username,$districtSectionId, $userGroupId, $postal, $houseNumber, $password, $name, $surname, $email, $active)
    {
        $this->id = $id;
        $this->username = $username;
        $this->districtSectionId = $districtSectionId;
        $this->userGroupId = $userGroupId;
        $this->postal = $postal;
        $this->houseNumber = $houseNumber;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->active = $active;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getDistrictSectionId()
    {
        return $this->districtSectionId;
    }

    public function getUserGroupId()
    {
        return $this->userGroupId;
    }

    public function getPostal()
    {
        return $this->postal;
    }

    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    public function getPassword()
    {
        return $this->name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getActive()
    {
        return $this->active;
    }
}