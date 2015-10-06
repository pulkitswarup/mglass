<?php

namespace MGlass\ApiBundle\Libraries\factory;

use MGlass\ApiBundle\Services\Movies\MovieManager;
use MGlass\ApiBundle\Services\Users\UserManager;

class MGlassFactory {
  private static $instance;

  protected function __construct() {}

  public static function getInstance() {
    if(!isset(self::$instance)) {
      $class = __CLASS__;
      self::$instance = new $class();
    }
    return self::$instance;
  }

  public function getMovieManager() {
    $movieManager = new MovieManager();
    return $movieManager;
  }

  public function getUserManager() {
    $userManager = new UserManager();
    return $userManager;
  }
}