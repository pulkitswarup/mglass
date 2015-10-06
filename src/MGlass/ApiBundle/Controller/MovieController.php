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
class MovieController extends MGlassController
{
    /**
     * @Route("/movies", defaults={"id" = -1})
     * @Route("/movies/{id}", requirements={"id" = "\d+"}, defaults={"uid" = -1})
     * @Route("/movies/{id}/uid/{uid}", requirements={"id" = "\d+", "uid" = "\d+"})
     * @Method({"GET"})
     */
    public function getMoviesAction($id, $uid) {
        $movieManager = MGlassFactory::getInstance()->getMovieManager();
        $movies = $movieManager->getMovie($id, $uid);
        $response = new JsonResponse();
        $response->setData($movies);
        return $response;
    }

    /**
     * @Route("/movies/{id}", requirements={"id" = "\d+"})
     * @Method({"PUT"})
     */
    public function updateMovieAction($id) {
        $parameters = $this->getParameters();
        $movieManager = MGlassFactory::getInstance()->getMovieManager();
        $result = $movieManager->updateMovie($parameters);
        $response = new JsonResponse();
        $response->setData($result);
        return $response;
    }

    /**
     * @Route("/movies/{id}", requirements={"id" = "\d+"})
     * @Method({"DELETE"})
     */
    public function deleteMovieAction($id) {
        $movieManager = MGlassFactory::getInstance()->getMovieManager();
        $result = $movieManager->deleteMovie($id);
        $response = new JsonResponse();
        $response->setData($result);
        return $response;
    }

    /**
     * @Route("/movies")
     * @Method({"POST"})
     */
    public function addMovieAction() {
        $parameters = $this->getParameters();
        $movieManager = MGlassFactory::getInstance()->getMovieManager();
        $result = $movieManager->addMovie($parameters);
        $response = new JsonResponse();
        $response->setData($result);
        return $response;
    }

    /**
     * @Route("/movies/search/{query}")
     * @Method({"GET"})
     */
    public function searchMoviesAction($query) {

    }

    /**
     * @Route("/movies/{id}/reviews", requirements={"id" = "\d+"}, defaults = {"page" = -1})
     * @Route("/movies/{id}/reviews/{page}", requirements={"id" = "\d+", "page" = "\d+"})
     * @Method({"GET"})
     */
    public function getMovieReviews($id, $page) {

    }

    /**
     * @Route("/movies/{id}/ratings", requirements={"id" = "\d+"})
     * @Method({"GET"})
     */
    public function getMovieRatings($id) {
        $movieManager = MGlassFactory::getInstance()->getMovieManager();
        $movies = $movieManager->getMovieRating($id);
        $response = new JsonResponse();
        $response->setData($movies);
        return $response;
    }

}
