<?php

namespace MGlass\ApiBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Users {
  private $userId;
  /**
   * @Assert\NotBlank("message"="Please specify the name of the user")
   */
  private $name;
  private $created;

  public function setUserId($userId) {
   $this->userId = $userId;
  }

  public function getUserId() {
    return $this->userId;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function getName() {
    return $this->name;
  }

  public function setCreated($created) {
    $this->created = $created;
  }

  public function getCreated() {
    return $this->created;
  }
}