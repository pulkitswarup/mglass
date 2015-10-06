<?php

namespace MGlass\ApiBundle\DataAccessObjects\factory;

class ElasticSearchDAOFactory {
  private static $instance;
  
  private static function __construct() {}

  public static function getInstance() {
     if (!isset(self::$instance)) {
            $class = __CLASS__;
            self::$instance = new $class();
        }
        return self::$instance;
  } 

  public function getElasticSearchDAO() {
    
  }
}