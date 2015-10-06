<?php

namespace MGlass\ApiBundle\Resources\datamodel;

use Symfony\Component\Validator\Constraints as Assert;

class Reviews {
  private $reviewId;
  private $userId;
  private $movieId;
  /**
   * @Assert\NotBlank(message="Please specify review of the movie")
   * @Assert\Length(max="500", maxMessage="Review cannot be greater than {{ limit }} characters")
   */
  private $review;
}