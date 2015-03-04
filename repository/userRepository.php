<?php
require_once 'repositoryBase.php';
class UserRepository extends RepositoryBase
{

    private $name = 'user';

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
        $userArray = array();

        #convert result objects to user objects
        foreach($objects as $var)
        {
            $userArray[] = new User($var->userId, $var->username, $var->districtSectionId, $var->userGroupId, $var->postal, $var->housenumber, $var->password, $var->name, $var->surname, $var->email, $var->active);
        }
        return $userArray;
    }

    public function getById($id)
    {
        $result = parent::getById($id);

        if (count($result) == 1)
        {
            $user = new User($result[0]->userId, $result[0]->username, $result[0]->districtSectionId, $result[0]->userGroupId, $result[0]->postal, $result[0]->housenumber, $result[0]->password, $result[0]->name, $result[0]->surname, $result[0]->email, $result[0]->active);
        }

        return $user;
    }

    #change to user
    public function add($object)
    {
        $query = 'INSERT INTO ' . $this->name . '(userId, username, districtSectionId, userGroupId, postal, housenumber, password, name, surname, email, active) VALUES(:userId, :username,:districtSectionId, :userGroupId, :postal, :housenumber, :password, :name, :surname, :email, :active)';

        $parameters = array(
            ':userId' => $object->getId(),
            ':username' => $object->getUsername(),
            ':districtSectionId' => $object->getDistrictSectionId(),
            ':userGroupId' => $object->getUserGroupId(),
            ':postal' => $object->getPostal(),
            ':housenumber' => $object->getHouseNumber(),
            ':password' => $object->getPassword(),
            ':name' => $object->getName(),
            ':surname' => $object->getSurname(),
            ':email' => $object->getEmail(),
            ':active' => $object->getActive()
        );

        $this->db->execQuery($query, $parameters);
    }

    #change to user
    public function update($object)
    {
        $query = 'UPDATE ' . $this->tableName . ' SET districtSectionId = :districtSectionId, userId = :userId, title = :title, content = :content, date = :date, hidden= :hidden
        WHERE ' . $this->tableName .'Id = :' . $this->tableName .'Id';

        $parameters = array(
            ':newsId' => $object->getId(),
            ':districtSectionId' => $object->getDistrictSectionId(),
            ':userId' => $object->getUserId(),
            ':title' => $object->getTitle(),
            ':content' => $object->getContent(),
            ':date' => $object->getDate(),
            ':hidden' => $object->getHidden()
        );

        $this->db->execQuery($query, $parameters);
    }

}