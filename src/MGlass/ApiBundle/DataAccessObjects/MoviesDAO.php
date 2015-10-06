<?php

namespace MGlass\ApiBundle\DataAccessObjects;

use PDO;
use PDOException;
use MGlass\ApiBundle\DataAccessObjects\MGlassDAO;
use MGlass\ApiBundle\Entity\Movies;

class MoviesDAO extends MGlassDAO {
  private $dbnode = 'mglass_movies';
  private $enginenode = 'mglass_movies';

  public function __construct() {}

  public function getDetails(Movies $movie) {
    try {
      $result = array("status"=>false);
      $connection = $this->getConnection($this->dbnode);
      $query = "SELECT title, year, genre
                FROM MOVIES
                WHERE movieId = :movieId";
      $statement = $connection->prepare($query);
      $statement->bindValue('movieId', $movie->getMovieId(), PDO::PARAM_INT);
      $statement->execute();
      $cnt=0;
      while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $result["status"] = true;
        $result["data"][$cnt]['title'] = $row['title'];
        $result["data"][$cnt]['year'] = $row['year'];
        $result["data"][$cnt]['genre'] = $row['genre'];
        $cnt++;
      }
      $statement->closeCursor();
      return $result;
    } catch (PDOException $e) {
      throw new MovieNotFoundException('Movie Not Found', $e);
    } catch (Exception $e) {
      throw new MovieNotFoundException('Movie Not Found', $e);
    }
  }

  public function addDetails(Movies $movie) {
    try {
      $connection = $this->getConnection($this->dbnode);
      $query = "INSERT INTO MOVIES (title, genre, year)
                VALUES (:title, :genre, :year)";
      $statement = $connection->prepare($query);
      $statement->bindValue(':title', $movie->getTitle(), PDO::PARAM_STR);
      $statement->bindValue(':genre', $movie->getGenre(), PDO::PARAM_STR);
      $statement->bindValue(':year', $movie->getYear(), PDO::PARAM_STR);
      $statement->execute();
      if($statement->rowCount() > 0) {
        $return = true;
      } else {
        $return = false;
      }
      $statement->closeCursor();
      return array("status"=>$return);
    } catch (PDOException $e) {
      throw new MovieEntryFailedException('Movie Entry Failed', $e);
    } catch (Exception $e) {
      throw new MovieEntryFailedException('Movie Entry Failed', $e);
    }
  }

  public function getRating(Movies $movie) {
    try {
      $connection = $this->getConnection($this->enginenode, 'engine', 'ratings');
      $query = '{
                  "query": {
                    "match": {
                      "movieid": "3193"
                    }
                  },
                  "aggs": {
                    "avg_grade": {
                      "avg": {
                        "field": "rating"
                      }
                    }
                  }
                }';
      $response = $connection->request('_search', \Elastica\Request::POST, json_decode($query, true));
      $rating = $response->getData()['aggregations']['avg_grade']['value'];
      return array("status" => true, "id" => $movie->getMovieId(), "rating" => round($rating, 1));
    } catch (Exception $e) {
      throw new MovieRatingComputationFailed('Unable to compute movie rating', $e);
    }
  }

  public function getRecommendations(Movies $movie) {
    try {
      $connection = $this->getConnection($this->enginenode, 'engine', 'movies');
      $query = '{
                  "size": "10",
                  "query": {
                    "filtered": {
                      "filter": {
                        "and": [
                          {
                            "has_child": {
                              "type": "recommendations",
                              "filter": {
                                "and": [
                                  {
                                    "terms": {
                                      "recommendedid": [
                                        "'.$movie->getMovieId().'"
                                      ]
                                    }
                                  },
                                  {
                                    "range": {
                                      "score": {
                                        "gte": 0.95
                                      }
                                    }
                                  }
                                ]
                              }
                            }
                          }
                        ]
                      }
                    }
                  }
                }';
      $response = $connection->request('_search', \Elastica\Request::POST, json_decode($query, true));
      $result = array();
      $recommendations = $response->getData()['hits']['hits'];
      if(count($recommendations) > 0) {
        for ($idx = 0; $idx < count($recommendations[$idx]); $idx++) {
          array_push($result, $recommendations[$idx]['_source']);
        }
      }
      return $result;
    } catch (Exception $e) {
      throw new MovieRecommedationFailedException('Failed to recommend movies', $e);
    }
  }
}