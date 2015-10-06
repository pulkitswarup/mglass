<?php

namespace MGlass\ApiBundle\DataAccessObjects;

use PDO;
use PDOException;
use MGlass\ApiBundle\DataAccessObjects\MGlassDAO;
use MGlass\ApiBundle\Entity\Users;

class UsersDAO extends MGlassDAO {

  private $dbnode = 'mglass_users';

  public function __construct() {}

  public function getDetails(Users $user) {
    try {
      $result = array("status"=>false);
      $connection = $this->getConnection($this->dbnode);
      $query = "SELECT name, created
                FROM USERS
                WHERE userId = :userId";
      $statement = $connection->prepare($query);
      $statement->bindValue(':userId', $user->getUserId(), PDO::PARAM_INT);
      $statement->execute();
      $cnt = 0;
      while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $result["status"] = true;
        $result["data"][$cnt]['name'] = $row['name'];
        $result["data"][$cnt]['created'] = $row['created'];
        $cnt++;
      }
      $statement->closeCursor();
      return $result;
    } catch (PDOException $e) {
      throw new UserNotFoundException('User Not Found', $e);
    } catch (Exception $e) {
      throw new UserNotFoundException('User Not Found', $e);
    }
  }

  public function addDetails(Users $user) {
    try {
      $connection = $this->getConnection($this->dbnode);
      $query = "INSERT INTO USERS (name, created)
                VALUES (:name, :created)";
      $statement = $connection->prepare($query);
      $statement->bindValue(':name', $user->getName(), PDO::PARAM_STR);
      $statement->bindValue(':created', date("Y-m-d H:i:s"), PDO::PARAM_STR);
      $statement->execute();
      if($statement->rowCount() > 0) {
        $return = true;
      } else {
        $return = false;
      }
      $statement->closeCursor();
      return array("status"=>$return);
    } catch (PDOException $e) {
      throw new UserEntryFailedException('User Entry Failed', $e);
    } catch (Exception $e) {
      throw new UserEntryFailedException('User Entry Failed', $e);
    }
  }
}