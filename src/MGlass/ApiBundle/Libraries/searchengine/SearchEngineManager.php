<?php

namespace MGlass\ApiBundle\Libraries\searchengine;

use Symfony\Component\Yaml\Yaml;

class SearchEngineManager {
  private static $instances;
  private $driver;
  private $host;
  private $port;
  private $index;
  private $types;
  private $elasticClient;

  protected function __construct($config) {
    $this->driver = $config['driver'];
    $this->host = $config['host'];
    $this->port = $config['port'];
    $this->index = $config['index'];
    $this->types = $config['types'];
  }

  public static function getInstance($node) {
    if(!isset(self::$instances[$node])) {
      $yaml = Yaml::parse(file_get_contents(__DIR__."/../../../../../app/config/engine/engine.yml"));
      $class = __CLASS__;
      self::$instances[$node] = new $class($yaml[$node]);
    }
    return self::$instances[$node];
  }

  public function getConnection($type) {
    switch ($this->driver) {
      case 'elastic':
      default:
        try {
          $this->elasticClient = new \Elastica\Client(
              [
              'host' => $this->host,
              'port' => $this->port
              ]
            );
          $elasticaIndex = $this->elasticClient->getIndex($this->index);
          $elasticaType = $elasticaIndex->getType($this->types[$type]);
          return $elasticaType;
        } catch (Exception $e) {
          throw new SearchEngineConnectionFailed('Unable to connect to search engine', $e);
        }
    }
  }
}