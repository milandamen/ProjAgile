<?php
require_once 'userRepository.php';
require_once '../model/user.php';

$userRepository = new UserRepository();


/* ADD user
$user = new User('3', 'username', '1', '1', '3333AA', '2', 'password', 'name', 'surname', 'email', '1' );
$userRepository->add($user);
*/

$users = $userRepository->getAll();

echo 'GetAll: <br/><br/>';

foreach($users as $var)
{
    echo 'Username: ' . $var->getUsername() . '<br/>';
    echo 'Id: ' . $var->getId() . '<br/>';
    echo 'DistrictSectionId: ' . $var->getDistrictSectionId() . '<br/>';
    echo 'UserGroupId: ' . $var->getUserGroupId() . '<br/><br/>';
}

echo  'getbyid: <br/><br/>';

$var = $userRepository->getById(2);

echo 'Username: ' . $var->getUsername() . '<br/>';
echo 'Id: ' . $var->getId() . '<br/>';
echo 'DistrictSectionId: ' . $var->getDistrictSectionId() . '<br/>';
echo 'UserGroupId: ' . $var->getUserGroupId() . '<br/><br/>';