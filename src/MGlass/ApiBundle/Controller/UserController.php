<?php

namespace MGlass\ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;

use MGlass\ApiBundle\Controller\MGlassController;
use MGlass\ApiBundle\Libraries\factory\MGlassFactory;

/**
 * @Route("/api")
 */
class UserController extends MGlassController
{

    /**
     * @Route("/user/{id}", requirements={"id" = "\d+"})
     * @Method({"GET"})
     */
    public function getUserAction($id) {
        $userManager = MGlassFactory::getInstance()->getUserManager();
        $result = $userManager->getDetails($id);
        $response = new JsonResponse();
        $response->setData($movies);
        return $response;
    }
    /**
     * @Route("/user")
     * @Method({"POST"})
     */
    public function addUserAction() {
        $parameters = $this->getParameters();
        $userManager = MGlassFactory::getInstance()->getUserManager();
        $result = $userManager->addDetails($parameters);
        $response = new JsonResponse();
        $response->setData($movies);
        return $response;
    }

}
