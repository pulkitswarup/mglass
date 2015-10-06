<?php

namespace MGlass\ApiBundle\Resources\datamodel;

use Symfony\Component\Validator\Constraints as Assert;

class Ratings {
  private $ratingId;
  private $userId;
  private $movieId;
  /**
   * @Assert\NotBlank(message="Please specify the rating of the movie")
   * @Assert\Range(
   *      min = 1,
   *      max = 10,
   *      minMessage = "Rating must be at least {{ limit }}",
   *      maxMessage = "Rating cannot be greater than {{ limit }}"
   *      )
   */
  private $rating;
}