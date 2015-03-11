<?php
    require_once 'RepositoryBase.php';

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

        public function getByUsername($username)
        {
            $query = $this->selectAll . $this->tableName . ' WHERE ' . $this->tableName . 'username = :' . $this->tableName .'username';
            $parameter = array(':' . $this->tableName . 'username' => $username);

            $result = $this->db->getQuery($query, $parameter);

            if (count($result) == 1)
            {
                $user = new User($result[0]->userId, $result[0]->username, $result[0]->districtSectionId, $result[0]->userGroupId, $result[0]->postal, $result[0]->housenumber, $result[0]->password, $result[0]->name, $result[0]->surname, $result[0]->email, $result[0]->active);
            }
            return $user;
        }

        public function add($object)
        {
            $query = 'INSERT INTO ' . $this->name . '(userId, username, districtSectionId, userGroupId, postal, housenumber, password, name, surname, email, active) VALUES(:userId, :username,:districtSectionId, :userGroupId, :postal, :housenumber, :password, :name, :surname, :email, :active)';

            $parameters = array(
                ':userId' => $object->getUserId(),
                ':userGroupId' => $object->getUserGroupId(),
                ':districtSectionId' => $object->getDistrictSectionId(),
                ':username' => $object->getUsername(),
                ':password' => $object->getPassword(),
                ':salt' => $object->getSalt(),
                ':name' => $object->getFirstName(),
                ':surname' => $object->getSurname(),
                ':postal' => $object->getPostal(),
                ':houseNumber' => $object->getHouseNumber(),
                ':email' => $object->getEmail(),
                ':active' => $object->getActive()
            );
            $this->db->execQuery($query, $parameters);
        }

        public function update($object)
        {
            $query = 'UPDATE ' . $this->tableName . '
                SET userGroupId = :userGroupId,
                districtSectionId = :districtSectionId,
                username = :username,
                password = :password,
                salt = :salt,
                firstName = :firstName,
                surname = :surname,
                postal = :postal,
                houseNumber = :houseNumber,
                email = :email,
                active = :active
            WHERE ' . $this->tableName .'Id = :' . $this->tableName .'Id';

            $parameters = array(
                ':userId' => $object->getUserId(),
                ':userGroupId' => $object->getUserGroupId(),
                ':districtSectionId' => $object->getDistrictSectionId(),
                ':username' => $object->getUsername(),
                ':password' => $object->getPassword(),
                ':firstName' => $object->getFirstName(),
                ':surname' => $object->getSurname(),
                ':postal' => $object->getPostal(),
                ':houseNumber' => $object->getHouseNumber(),
                ':email' => $object->getEmail(),
                ':active' => $object->getActive()
            );
            $this->db->execQuery($query, $parameters);
        }
    }
?>