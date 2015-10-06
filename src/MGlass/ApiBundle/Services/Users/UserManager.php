<?php

namespace MGlass\ApiBundle\Services\Users;

use MGlass\ApiBundle\Libraries\factory\DataFactory;
use MGlass\ApiBundle\Entity\Users;
use MGlass\ApiBundle\DataAccessObjects\UsersDAO;

class UserManager {
  public function __construct() {
  }

  public function getDetails($id) {
    $user = new Users();
    $user->setUserId($id);
    $usersDAO = new UsersDAO();
    $results = $usersDAO->getDetails($user);
    return $results;
  }

  public function addDetails($parameters) {
    $user = new Users();
    $user->setName($parameters['name']);
    $usersDAO = new UsersDAO();
    return $usersDAO->addDetails($user);
  }
}