<?php
/**
 * Created by PhpStorm.
 * User: kimprzybylski
 * Date: 17/05/17
 * Time: 18:21
 * bron:excercise2
 */

namespace model;


interface EventRepository
{
    public function findAllEvents();
    public function findEventById($id);
    public function findEventByPersonId($personId);
    public function findEventByDate($startDate, $endDate);
    public function findEventByPersonIdAndDate($personId, $startDate, $endDate);
    public function addEvent($name, $startDate, $endDate, $personId);
    public function updateEvent($id, $name, $startDate, $endDate, $personId);
    public function deleteEvent($id);
}