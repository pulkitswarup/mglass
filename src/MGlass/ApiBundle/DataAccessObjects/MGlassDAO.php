<?php
namespace MGlass\ApiBundle\DataAccessObjects;

use PDO;
use MGlass\ApiBundle\DataAccessObjects\Exception\MGlassDAOException;
use MGlass\ApiBundle\Libraries\factory\DataFactory;

abstract class MGlassDAO {
  public function getConnection($node, $target='db', $type='') {
    switch ($target) {
      case 'engine':
        return DataFactory::getInstance()->getSearchEngineConnection($node, $type);
      case 'db':
      default:
        return DataFactory::getInstance()->getDatabaseConnection($node);

    }
  }
}