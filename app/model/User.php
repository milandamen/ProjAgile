<?php
    class User
    {
        private $userId;
        private $userGroupId;
        private $districtSectionId;
        private $username;
        private $password;
        private $salt;
        private $firstName;
        private $surname;
        private $postal;
        private $houseNumber;
        private $email;
        private $active;

        public function __construct($userId, $userGroupId, $districtSectionId, $username, $password, $salt, $firstName, $surname, $postal, $houseNumber, $email, $active)
        {
            $this->userId = $userId;
            $this->userGroupId = $userGroupId;
            $this->districtSectionId = $districtSectionId;
            $this->username = $username;
            $this->password = $password;
            $this->salt = $salt;
            $this->firstName = $firstName;
            $this->surname = $surname;
            $this->postal = $postal;
            $this->houseNumber = $houseNumber;
            $this->email = $email;
            $this->active = $active;
        }

        public function getUserId()
        {
            return $this->userId;
        }

        public function getUserGroupId()
        {
            return $this->userGroupId;
        }

        public function getDistrictSectionId()
        {
            return $this->districtSectionId;
        }

        public function getUsername()
        {
            return $this->username;
        }

        public function getPassword()
        {
            return $this->name;
        }

        public function getSalt()
        {
            return $this->salt;
        }

        public function getFirstName()
        {
            return $this->firstName;
        }

        public function getSurname()
        {
            return $this->surname;
        }

        public function getPostal()
        {
            return $this->postal;
        }

        public function getHouseNumber()
        {
            return $this->houseNumber;
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
?>