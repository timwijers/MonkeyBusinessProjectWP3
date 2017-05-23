<?php
/**
 * Created by PhpStorm.
 * User: kimprzybylski
 * Date: 17/05/17
 * Time: 18:22
 * bron:excercise2
 */

namespace model;

class PDOEventRepository implements EventRepository
{
    private $connection = null;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findAllEvents()
    {
        try{
            $statement = $this->connection->prepare('SELECT * FROM Events');
            $statement->execute();
            $events = array();

            while($result = $statement->fetch()) {
                $event = new Event($result["Id"], $result["Name"], $result["StartDate"], $result["EndDate"], $result["PersonId"]);
                array_push($events, $event);
            }

            return $events;

        } catch (PDOException $exception) {
            echo 'can not connect to database';
        }
    }

    public function findEventById($id)
    {
        try{
            $statement = $this->connection->prepare('SELECT * FROM Events WHERE Id=?');
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

            if (count($result) > 0) {
                $event = new Event($result[0]['Id'], $result[0]['Name'], $result[0]['StartDate'], $result[0]['EndDate'], $result[0]['PersonId']);
                return $event;
            } else {
                return null;
            }
        } catch (\PDOException $exception) {
            echo 'can not connect to database';
        }
    }

    public function findEventByPersonId($personId)
    {
        try{
            $statement = $this->connection->prepare('SELECT * FROM Events WHERE PersonId=?');
            $statement->bindParam(1, $personId, \PDO::PARAM_INT);
            $statement->execute();
            $events = array();

            while($result = $statement->fetch()) {
                $event = new Event($result["Id"], $result["Name"], $result["StartDate"], $result["EndDate"], $result["PersonId"]);
                array_push($events, $event);
            }

            return $events;

        } catch (\PDOException $exception) {
            echo 'can not connect to database';
        }
    }

    public function findEventByDate($startDate, $endDate) {
        try{
            $statement = $this->connection->prepare('SELECT * FROM Events WHERE StartDate=? AND EndDate=?');
            $statement->bindParam(1, $startDate, \PDO::PARAM_STR);
            $statement->bindParam(2, $endDate, \PDO::PARAM_STR);
            $statement->execute();
            $events = array();

            while($result = $statement->fetch()) {
                $event = new Event($result["Id"], $result["Name"], $result["StartDate"], $result["EndDate"], $result["PersonId"]);
                array_push($events, $event);
            }

            return $events;

        } catch (\PDOException $exception) {
            echo 'can not connect to database';
        }
    }

    public function findEventByPersonIdAndDate($personId, $startDate, $endDate) {
        try{
            $statement = $this->connection->prepare('SELECT * FROM Events WHERE StartDate=? AND EndDate=? AND PersonId=?');
            $statement->bindParam(1, $startDate, \PDO::PARAM_STR);
            $statement->bindParam(2, $endDate, \PDO::PARAM_STR);
            $statement->bindParam(3, $personId, \PDO::PARAM_INT);
            $statement->execute();
            $events = array();

            while($result = $statement->fetch()) {
                $event = new Event($result["Id"], $result["Name"], $result["StartDate"], $result["EndDate"], $result["PersonId"]);
                array_push($events, $event);
            }

            return $events;

        } catch (\PDOException $exception) {
            echo 'can not connect to database';
        }
    }

    public function addEvent($name, $startDate, $endDate, $personId)
    {
        try {
            $statement = $this->connection->prepare('INSERT INTO Events (Name, StartDate, EndDate, PersonId) VALUES (?, ?, ?, ?)');

            $statement->bindParam(1, $name, \PDO::PARAM_STR);
            $statement->bindParam(2, $startDate, \PDO::PARAM_STR);
            $statement->bindParam(3, $endDate, \PDO::PARAM_STR);
            $statement->bindParam(4, $personId, \PDO::PARAM_INT);
            $result = $statement->execute();

        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function updateEvent($id, $name, $startDate, $endDate, $personId)
    {
        try {
            $statement = $this->connection->prepare('UPDATE Events Set Name = ?, StartDate = ?, EndDate = ?, PersonId = ? WHERE Id = ?;');

            $statement->bindParam(1, $name, \PDO::PARAM_STR);
            $statement->bindParam(2, $startDate, \PDO::PARAM_STR);
            $statement->bindParam(3, $endDate, \PDO::PARAM_STR);
            $statement->bindParam(4, $personId, \PDO::PARAM_INT);
            $statement->bindParam(5, $id, \PDO::PARAM_INT);
            $statement->execute();

        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function deleteEvent($id)
    {
        try {
            $statement = $this->connection->prepare("DELETE FROM Events WHERE Id = :id");
            $statement->bindParam(':id', $id, \PDO::PARAM_INT);
            return $statement->execute();
        } catch (\PDOException $e) {
            print 'Exception!: ' . $e->getMessage();
        }
    }
}