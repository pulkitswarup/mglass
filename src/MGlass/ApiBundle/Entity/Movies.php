<?php

namespace MGlass\ApiBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Movies {
  private $movieId;
  /**
   * @Assert\NotBlank(message="Please specify the title of the movie")
   */
  private $title;
  /**
   * @Assert\NotBlank("message"="Please specify the year of the movie release")
   * @Assert\Regexp("^\d{4}$", "message"="Please specify valid year of the movie release")
   */
  private $year;
  /**
   * @Assert\NotBlank("message"="Please specify the genre of the movie")
   */
  private $genre;

  public function setMovieId($movieId) {
    $this->movieId = $movieId;
  }

  public function getMovieId() {
    return $this->movieId;
  }

  public function setTitle($title) {
    $this->title = $title;
  }

  public function getTitle() {
    return $this->title;
  }

  public function setYear($year) {
    $this->year = $year;
  }

  public function getYear() {
    return $this->year;
  }

  public function setGenre($genre) {
    $this->genre = $genre;
  }

  public function getGenre() {
    return $this->genre;
  }
}