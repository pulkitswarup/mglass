<?php

namespace MGlass\ApiBundle\Services\Movies;

use MGlass\ApiBundle\Libraries\factory\DataFactory;
use MGlass\ApiBundle\Entity\Movies;
use MGlass\ApiBundle\DataAccessObjects\MoviesDAO;

class MovieManager {
  public function __construct() {
  }

  public function getMovie($id, $uid) {
    $result = $this->getMovieDetails($id);
    $result['recommendations'] = $this->getMovieRecommendations($id);
    if(count($result['recommendations'])>0)
      $result['status'] = true;
    return $result;
  }

  private function getMovieDetails($id) {
    $movie = new Movies();
    $movie->setMovieId($id);
    $moviesDAO = new MoviesDAO();
    $result = $moviesDAO->getDetails($movie);
    return $result;
  }

  private function getMovieRecommendations($id) {
    $movie = new Movies();
    $movie->setMovieId($id);
    $moviesDAO = new MoviesDAO();
    $result = $moviesDAO->getRecommendations($movie);
    return $result;
  }

  public function getMovieRating($id) {
    $movie = new Movies();
    $movie->setMovieId($id);
    $moviesDAO = new MoviesDAO();
    $rating = $moviesDAO->getRating($movie);
    return $rating;
  }

  public function addMovie($parameters) {
    $movie = new Movies();
    $movie->setTitle($parameters['title']);
    $movie->setGenre($parameters['genre']);
    $movie->setYear($parameters['year']);
    $moviesDAO = new MoviesDAO();
    $result = $moviesDAO->addDetails($movie);
    return $result;
  }
}