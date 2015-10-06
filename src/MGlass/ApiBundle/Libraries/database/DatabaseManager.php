<?php

namespace MGlass\ApiBundle\Libraries\database;

use PDO;
use PDOException;
use Symfony\Component\Yaml\Yaml;

class DatabaseManager {
  private static $instances;
  private $driver;
  private $host;
  private $username;
  private $password;

  protected function __construct($config) {
    $this->driver = $config['driver'];
    $this->host = $config['host'];
    $this->username = $config['username'];
    $this->password = $config['password'];
    $this->dbname = $config['dbname'];
  }

  public static function getInstance($tag) {
    if(!isset(self::$instances[$tag])) {
      $yaml = Yaml::parse(file_get_contents(__DIR__."/../../../../../app/config/database/database.yml"));
      $class = __CLASS__;
      self::$instances[$tag] = new $class($yaml[$tag]);
    }
    return self::$instances[$tag];
  }

  public function getConnection() {
    switch($this->driver) {
    case 'pdo_mysql':
    default:
      try {
        $connection = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->username, $this->password);
        return $connection;
      } catch (PDOException $e) {
        throw new DatabaseConnectionFailedException('Failed to connect to database', $e);
      } catch (Exception $e) {
        throw new DatabaseConnectionFailedException('Failed to connect to database', $e);
      }
  }
}
}