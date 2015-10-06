<?php

namespace MGlass\ApiBundle\DataAccessObjects\Exception;

use MGlass\ApiBundle\Exception\MGlassException;

class MGlassDAOException extends MGlassException {
  public function __construct($message = null, $code = 0, \Exception $previous = null) {
      parent::__construct($message, $e, $code);
  }
}