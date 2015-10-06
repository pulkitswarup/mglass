<?php

namespace MGlass\ApiBundle\Libraries\factory;

use MGlass\ApiBundle\Libraries\database\DatabaseManager;
use MGlass\ApiBundle\Libraries\searchengine\SearchEngineManager;

class DataFactory {
  private static $instance;

  protected function __construct() {}

  public static function getInstance() {
    if(!isset(self::$instance)) {
      $class = __CLASS__;
      self::$instance = new $class();
    }
    return self::$instance;
  }

  public function getDatabaseConnection($tag) {
      return DatabaseManager::getInstance($tag)->getConnection();
  }

  public function getSearchEngineConnection($engine, $type) {
      return SearchEngineManager::getInstance($engine)->getConnection($type);
  }
}