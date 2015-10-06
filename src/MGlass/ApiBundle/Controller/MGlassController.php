<?php

namespace MGlass\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MGlassController extends Controller {
  protected function getParameters() {
        $parameters = array();
        if ($this->getRequest()->getMethod() == "GET") {
            $parameters = $this->getRequest()->query->all();
        } else {
            $parameters = $this->getRequest()->request->all();
        }
        return $parameters;
    }
}