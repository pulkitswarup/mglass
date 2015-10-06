<?php

namespace MGlass\ApiBundle\DataAccessObjects\Exception;

use MGlass\ApiBundle\DataAccessObjects\Exception\MGlassDAOException;

class MovieNotFoundException extends MGlassDAOException {
  public function __construct($message = null, $code = 0, \Exception $previous = null) {
      parent::__construct($message, $e, $code);
  }
}